<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Alokasi_relawan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            $this->session->set_flashdata('message', 'You must login.');
            return redirect('/');
        }
    }

    public function get_by_kecakapan($id_kecakapan) {
        if (!$id_kecakapan) {
            echo json_encode([
                'status' => 'error',
                'message' => 'ID kecakapan tidak ditemukan.'
            ]);
            return;
        }

        $relawan = $this->db
            ->select('relawan.id, relawan.nama')
            ->join('kecakapan_relawan', 'kecakapan_relawan.id_relawan = relawan.id')
            ->where('kecakapan_relawan.id_kecakapan', $id_kecakapan)
            ->where('relawan.disetujui', 1)
            ->where('relawan.tersedia', 1)
            ->order_by('relawan.nama', 'asc')
            ->get('relawan')
            ->result();

        if (empty($relawan)) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Tidak ada relawan ditemukan untuk kecakapan ini.'
            ]);
            return;
        }

        echo json_encode([
            'status' => 'success',
            'data' => $relawan
        ]);
    }


    public function index()
    {
        $data_ = [
            'title' => 'Data Bencana untuk Alokasi Relawan',
            'bencana' => $this->db->get('bencana')->result()
        ];

            // Tambahkan data jumlah relawan yang dialokasikan dan dibutuhkan per bencana
        foreach ($data_['bencana'] as $key => $bencana) {
            // Menghitung jumlah relawan yang sudah dialokasikan untuk bencana ini
            $total_relawan = $this->db->where('id_bencana', $bencana->id)
                                    ->count_all_results('alokasi_relawan');

            // Menghitung jumlah relawan yang dibutuhkan untuk bencana ini
            $jumlah_dibutuhkan = $this->db->select_sum('jumlah')
                                        ->where('id_bencana', $bencana->id)
                                        ->get('relawan_banyak')
                                        ->row()
                                        ->jumlah;

            if (is_null($jumlah_dibutuhkan)) {
            $jumlah_dibutuhkan = 0;
            }

            // Menambahkan hasil ke data bencana
            $data_['bencana'][$key]->total_relawan = $total_relawan;
            $data_['bencana'][$key]->jumlah_dibutuhkan = $jumlah_dibutuhkan;
        }
        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('alokasi_relawan/bencana');
        $this->load->view('template/footer');
    }

    public function list($id_bencana, $id_wilayah = 0, $id_kelurahan = 0)
    {
        $bencana = $this->db->get_where('bencana', ['id' => $id_bencana])->row();
        if (!$bencana) {
            show_error('Data bencana tidak ditemukan.', 404, 'Terjadi Kesalahan');
        }
    
        $title = 'Data Alokasi Relawan untuk ' . $bencana->jenis_bencana . 
                 ' pada ' . date('Y-m-d', strtotime($bencana->tanggal_kejadian)) . 
                 ' di ' . $bencana->lokasi;

        // Fetch all relawan data with necessary fields
        $relawan = $this->db
            ->select('
                alokasi_relawan.*, 
                relawan.nama, 
                relawan.tgl_lahir, 
                relawan.jenis_kelamin, 
                relawan.no_kontak,
                relawan.institusi, 
                relawan.pengalaman_kerelawanan, 
                relawan.pengalaman, 
                alokasi_relawan.tanggal_mulai,
                alokasi_relawan.tanggal_selesai,
                shelter.nama as lokasi_penugasan
            ')
            ->join('relawan', 'relawan.id = alokasi_relawan.id_relawan')
            ->join('shelter', 'shelter.id = alokasi_relawan.id_shelter', 'left')
            ->where('alokasi_relawan.id_bencana', $id_bencana)
            ->get('alokasi_relawan')
            ->result();

        foreach ($relawan as $key => $v) {
            // Calculate age if `tgl_lahir` is not null
            $usia = $v->tgl_lahir ? (new DateTime($v->tgl_lahir))->diff(new DateTime())->y : 'Tidak diketahui';
            $relawan[$key]->usia = $usia;
        }

        $data_ = [
            'title' => $title,
            'relawan' => $relawan,
            'id_bencana' => $id_bencana,
            'kecakapan' => $this->db->get('kecakapan')->result(),
            'jumlah' => $this->db->get_where('relawan_banyak', ['id_bencana' => $id_bencana])->result()
        ];

        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('alokasi_relawan/index');
        $this->load->view('template/footer');
    }

    public function tambah($id_bencana)
    {
        $approved_relawan = $this->db->where('disetujui', 1)->get('relawan')->result();
        $data_ = [
            'title' => 'Tambah Bangunan rusak bencana',
            'id_bencana' => $id_bencana,
            'kecakapan' => $this->db->get('kecakapan')->result(),
            'shelters' => $this->db->get_where('shelter', ['id_bencana' => $id_bencana])->result(),
            'approved_relawan' => $approved_relawan
        ];
        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('alokasi_relawan/tambah');
        $this->load->view('template/footer');
    }

    function insert()
    {

            // Validasi input tanggal_mulai
    if (empty($_POST['tanggal_mulai'])) {
        $this->session->set_flashdata([
            'message' => 'Tanggal mulai harus diisi.',
            'type' => 'error'
        ]);
        redirect('alokasi_relawan/tambah/' . $_POST['id_bencana']);
    }

        $tanggal_mulai = $_POST['tanggal_mulai'];
        $lama = $_POST['lama'];
    
        // Hitung tanggal selesai
        $tanggal_selesai = date('Y-m-d', strtotime($tanggal_mulai . " + $lama days"));

        $data_insert = [
            'id_bencana' => $_POST['id_bencana'],
            'id_relawan' => $_POST['id_relawan'],
            'id_kecakapan' => $_POST['id_kecakapan'],
            'lama' => $_POST['lama'],
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai,
        ];

        // Tambahkan id_shelter jika ada input
        if (!empty($_POST['id_shelter'])) {
            $data_insert['id_shelter'] = $_POST['id_shelter'];
        }

        $this->db->insert('alokasi_relawan', $data_insert);

        $this->db->where('id', $_POST['id_relawan'])->update('relawan', ['tersedia' => 0]);

        $this->session->set_flashdata([
            'message' => 'Data alokasi_relawan berhasil ditambahkan.',
            'type' => 'success'
        ]);
        redirect('alokasi_relawan/list/' . $_POST['id_bencana']);
    }

    function update()
    {
        $tanggal_mulai = $_POST['tanggal_mulai'];
        $lama = $_POST['lama'];
    
        $tanggal_selesai = date('Y-m-d', strtotime($tanggal_mulai . " + $lama days"));
    
        $data_update = [
            'id_bencana' => $_POST['id_bencana'],
            'id_relawan' => $_POST['id_relawan'],
            'id_kecakapan' => $_POST['id_kecakapan'],
            'lama' => $lama,
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai,
        ];
        
        $this->db->where('id', $_POST['id'])->update('alokasi_relawan', $data_update);
        $this->session->set_flashdata([
            'message' => 'Data alokasi_relawan berhasil update.',
            'type' => 'success'
        ]);
        redirect('alokasi_relawan/edit/' . $_POST['id']);
    }

    function hapus()
    {
        foreach ($_POST['id'] as $key => $v) {
            $alokasi_relawan = $this->db->get_where('alokasi_relawan', ['id' => $v])->row();
            $this->db->where(['id' => $alokasi_relawan->id_relawan])->update('relawan', ['tersedia' => 1]);
            $this->db->delete('alokasi_relawan', ['id' => $v]);
        }

        $this->session->set_flashdata([
            'message' => 'Berhasil menghapus ' . count($_POST['id']) . ' data.',
            'type' => 'success'
        ]);
        redirect($_SERVER['HTTP_REFERER']);
    }

    function edit($id)
    {
        $alokasi_relawan = $this->db->get_where('alokasi_relawan', ['id' => $id])->row();
        $data_ = [
            'title' => 'Edit Bangunan rusak bencana',
            'alokasi_relawan' => $alokasi_relawan,
            'id_bencana' => $alokasi_relawan->id_bencana,
            'relawan' => $this->db->get('relawan')->result(),
            'shelters' => $this->db->get_where('shelter', ['id_bencana' => $alokasi_relawan->id_bencana])->result() // Add shelters
        ];
        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('alokasi_relawan/tambah');
        $this->load->view('template/footer');
    }
}
