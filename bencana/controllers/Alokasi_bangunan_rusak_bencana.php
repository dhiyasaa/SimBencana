<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Alokasi_bangunan_rusak_bencana extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('bencana_model');
        if (!$this->session->userdata('login')) {
            $this->session->set_flashdata('message', 'You must login.');
            return redirect('/');
        }
    }

    public function index()
    {       
        $data_ = [
            'title' => 'Data Bencana untuk Alokasi Bangunan Rusak',
            'bencana' => $this->bencana_model->getBencanaWithTotalKerugian()
        ];
        
        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('alokasi_bangunan_rusak_bencana/bencana');
        $this->load->view('template/footer');
    }

    public function list($id_bencana, $id_wilayah = 0, $id_kelurahan = 0)
    {
        // Ambil data jenis bencana berdasarkan id_bencana
        $bencana = $this->db->get_where('bencana', ['id' => $id_bencana])->row();
    
        // Pastikan data jenis bencana ada
        if ($bencana) {
            $title = 'Alokasi Bangunan Rusak untuk ' . $bencana->jenis_bencana . 
                 ' pada ' . date('Y-m-d', strtotime($bencana->tanggal_kejadian)) . 
                 ' di ' . $bencana->lokasi;
        } else {
            $title = 'Alokasi Bangunan Rusak';
        }

        $alokasi_bangunan_rusak_bencana = $this->db
        ->select('alokasi_bangunan_rusak_bencana.*, bangunan_rusak_bencana.id as id_bangunan_rusak_bencana, bangunan_rusak_bencana.jenis_kerusakan, bangunan_rusak_bencana.pemilik, bangunan_rusak_bencana.alamat,  seng, kayu, dinding, wilayah.nama as kecamatan, wilayah_kelurahan.nama as kelurahan')
        ->join('bangunan_rusak_bencana', 'bangunan_rusak_bencana.id = id_bangunan_rusak_bencana', 'right')
        ->join('wilayah', 'id_kecamatan = wilayah.id')
        ->join('wilayah_kelurahan', 'id_kelurahan = wilayah_kelurahan.id')
        ->where([
            'id_kecamatan' => $id_wilayah,
            'id_kelurahan' => $id_kelurahan,
            'id_bencana' => $id_bencana
        ])
        ->order_by('bangunan_rusak_bencana.id', 'asc')
        ->get('alokasi_bangunan_rusak_bencana')->result();

        $data_ = [
            'title' => $title,
            'alokasi_bangunan_rusak_bencana' => $alokasi_bangunan_rusak_bencana,
            'id_bencana' => $id_bencana,
            'kecamatan' => $this->db->order_by('nama', 'asc')->get('wilayah')->result(),
            'id_wilayah' => $id_wilayah,
            'id_kelurahan' => $id_kelurahan,
            'kelurahan' => $this->db->order_by('nama', 'asc')->get_where('wilayah_kelurahan', ['id_wilayah' => $id_wilayah])->result(),
            'harga' => $this->db->order_by('tanggal', 'desc')->get('bangunan_rusak')->row()
        ];
        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('alokasi_bangunan_rusak_bencana/index');
        $this->load->view('template/footer');
    }

    public function tambah($id_bencana)
    {
        $data_ = [
            'title' => 'Tambah Bangunan rusak bencana',
            'kecamatan' => $this->db->get('wilayah')->result(),
            'id_bencana' => $id_bencana
        ];
        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('alokasi_bangunan_rusak_bencana/tambah');
        $this->load->view('template/footer');
    }

    function insert()
    {
        $id_bencana = $_POST['id_bencana'];
        $id_kecamatan = $_POST['id_wilayah'];
        $id_kelurahan = $_POST['id_kelurahan'];

        foreach ($_POST['nama'] as $key => $value) {
            $data_insert = [
                'id_bencana' => $id_bencana,
                'id_kecamatan' => $id_kecamatan,
                'id_kelurahan' => $id_kelurahan,
                'pemilik' => $value,
                'alamat' => $_POST['alamat'][$key],
                'seng' => $_POST['seng'][$key],
                'kayu' => $_POST['kayu'][$key],
                'dinding' => $_POST['dinding'][$key],
            ];
            $this->db->insert('alokasi_bangunan_rusak_bencana', $data_insert);
        }

        $this->session->set_flashdata([
            'message' => 'Data alokasi_bangunan_rusak_bencana berhasil ditambahkan.',
            'type' => 'success'
        ]);
        redirect('alokasi_bangunan_rusak_bencana/list/' . $_POST['id_bencana']);
    }

    function update()
    {

        $data_update = [
            'pemilik' => $_POST['nama'],
            'alamat' => $_POST['alamat'],
            'seng' => $_POST['seng'],
            'kayu' => $_POST['kayu'],
            'dinding' => $_POST['dinding'],
            'id_bencana' => $_POST['id_bencana'],
            'id_kecamatan' => $_POST['id_wilayah'],
            'id_kelurahan' => $_POST['id_kelurahan'],
        ];


        $this->db->where('id', $_POST['id'])->update('alokasi_bangunan_rusak_bencana', $data_update);
        $this->session->set_flashdata([
            'message' => 'Data alokasi_bangunan_rusak_bencana berhasil update.',
            'type' => 'success'
        ]);
        redirect('alokasi_bangunan_rusak_bencana/edit/' . $_POST['id']);
    }

    function hapus()
    {
        foreach ($_POST['id'] as $key => $v) {
            $this->db->delete('alokasi_bangunan_rusak_bencana', ['id' => $v]);
        }

        $this->session->set_flashdata([
            'message' => 'Berhasil menghapus ' . count($_POST['id']) . ' data.',
            'type' => 'success'
        ]);
        redirect($_SERVER['HTTP_REFERER']);
    }

    function edit()
    {
        $this->db->delete('alokasi_bangunan_rusak_bencana', ['id_bangunan_rusak_bencana' => $_POST['id_bangunan_rusak_bencana']]);
        $this->db->insert('alokasi_bangunan_rusak_bencana', [
            'id_bangunan_rusak_bencana' => $_POST['id_bangunan_rusak_bencana'],
            'kerugian' => $_POST['perkiraan_kerugian'],
            'jenis_kerusakan' => $_POST['jenis_kerusakan'],
        ]);

        redirect($_SERVER['HTTP_REFERER']);
    }
}
