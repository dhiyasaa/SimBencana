<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Alokasi_transportasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            $this->session->set_flashdata('message', 'You must login.');
            return redirect('/');
        }
    }

    public function index()
    {
        // Mengambil data bencana
        $bencana = $this->db->get('bencana')->result();
    
        // Menambahkan kolom total kendaraan pada setiap bencana
        foreach ($bencana as $key => $v) {
            // Menghitung total kendaraan untuk setiap bencana
            $total_kendaraan = $this->db->select_sum('jumlah')
                ->get_where('alokasi_transportasi', ['id_bencana' => $v->id])
                ->row()
                ->jumlah;
    
            // Menambahkan total kendaraan ke data bencana
            $v->total_kendaraan = $total_kendaraan; 
        }

        $data_ = [
            'title' => 'Data Bencana Untuk Alokasi Kendaraan',
            'bencana' => $bencana
        ];
        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('alokasi_transportasi/bencana');
        $this->load->view('template/footer');
    }

    public function list($id_bencana, $id_wilayah = 0, $id_kelurahan = 0)
    {
        // Ambil data jenis bencana berdasarkan id_bencana
        $bencana = $this->db->get_where('bencana', ['id' => $id_bencana])->row();
    
        // Pastikan data jenis bencana ada
        if ($bencana) {
            $title = 'Data Alokasi Kendaraan untuk ' . $bencana->jenis_bencana . 
                 ' pada ' . date('Y-m-d', strtotime($bencana->tanggal_kejadian)) . 
                 ' di ' . $bencana->lokasi;
        } else {
            $title = 'Data Alokasi Kendaraan';
        }

        $data_ = [
            'title' => $title,
            'transportasi' => $this->db
                ->select('alokasi_transportasi.*,
                transportasi.jenis_kendaraan,
                transportasi.kondisi,
                alokasi_transportasi.jumlah
                ')
                ->join('transportasi', 'transportasi.id = id_transportasi')
                ->get_where('alokasi_transportasi', ['id_bencana' => $id_bencana])->result(),
            'id_bencana' => $id_bencana,
            'kecakapan' => $this->db->get('kecakapan')->result(),
        ];
        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('alokasi_transportasi/index');
        $this->load->view('template/footer');
    }

    public function tambah($id_bencana)
    {
        $data_ = [
            'title' => 'Tambah Bangunan rusak bencana',
            'id_bencana' => $id_bencana,
            'transportasi' => $this->db->get('transportasi')->result(),
        ];
        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('alokasi_transportasi/tambah');
        $this->load->view('template/footer');
    }

    function insert()
    {
        $data_insert = [
            'id_bencana' => $_POST['id_bencana'],
            'id_transportasi' => $_POST['id_transportasi'],
            'jumlah' => $_POST['jumlah'],
        ];
        $this->db->insert('alokasi_transportasi', $data_insert);

        $transportasi = $this->db->get_where('transportasi', ['id' => $_POST['id_transportasi']])->row();
        $this->db->where('id', $_POST['id_transportasi'])->update('transportasi', ['tersedia' => $transportasi->tersedia - $_POST['jumlah']]);

        $this->session->set_flashdata([
            'message' => 'Data alokasi transportasi berhasil ditambahkan.',
            'type' => 'success'
        ]);
        redirect('alokasi_transportasi/list/' . $_POST['id_bencana']);
    }

    function update()
    {

        $data_update = [
            'id_bencana' => $_POST['id_bencana'],
            'id_transportasi' => $_POST['id_transportasi'],
            'kecakapan' => $_POST['kecakapan'],
            'lama' => $_POST['lama'],
        ];


        $this->db->where('id', $_POST['id'])->update('alokasi_transportasi', $data_update);
        $this->session->set_flashdata([
            'message' => 'Data alokasi_transportasi berhasil update.',
            'type' => 'success'
        ]);
        redirect('alokasi_transportasi/edit/' . $_POST['id']);
    }

    function hapus()
    {
        foreach ($_POST['id'] as $key => $v) {
            $alokasi_transportasi = $this->db->get_where('alokasi_transportasi', ['id' => $v])->row();
            $transportasi = $this->db->get_where('transportasi', ['id' => $alokasi_transportasi->id_transportasi])->row();
            $this->db->where(['id' => $alokasi_transportasi->id_transportasi])->update('transportasi', ['tersedia' => $alokasi_transportasi->jumlah + $transportasi->tersedia]);
            $this->db->delete('alokasi_transportasi', ['id' => $v]);
        }

        $this->session->set_flashdata([
            'message' => 'Berhasil menghapus ' . count($_POST['id']) . ' data.',
            'type' => 'success'
        ]);
        redirect($_SERVER['HTTP_REFERER']);
    }

    function edit($id)
    {
        $alokasi_transportasi = $this->db->get_where('alokasi_transportasi', ['id' => $id])->row();
        $data_ = [
            'title' => 'Edit Bangunan rusak bencana',
            'alokasi_transportasi' => $alokasi_transportasi,
            'id_bencana' => $alokasi_transportasi->id_bencana,
            'transportasi' => $this->db->get('transportasi')->result(),
        ];
        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('alokasi_transportasi/tambah');
        $this->load->view('template/footer');
    }
}
