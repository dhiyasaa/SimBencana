<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Shelter extends CI_Controller
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
        $data_ = [
            'title' => 'Data Bencana untuk Pendataan Shelter',
            'bencana' => $this->db->get('bencana')->result()
        ];
        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('shelter/bencana');
        $this->load->view('template/footer');
    }

    public function list($id_bencana)
    {
        // Ambil data jenis bencana berdasarkan id_bencana
        $bencana = $this->db->get_where('bencana', ['id' => $id_bencana])->row();
    
        // Pastikan data jenis bencana ada
        if ($bencana) {
            $title = 'Data Shelter untuk ' . $bencana->jenis_bencana . 
                 ' pada ' . date('Y-m-d', strtotime($bencana->tanggal_kejadian)) . 
                 ' di ' . $bencana->lokasi;
        } else {
            $title = 'Data Shelter';
        }

        $data_ = [
            'title' => $title,
            'shelter' => $this->db
                ->select('shelter.*, wilayah.nama as kecamatan, wilayah_kelurahan.nama as kelurahan')
                ->join('wilayah', 'id_kecamatan = wilayah.id')
                ->join('wilayah_kelurahan', 'id_kelurahan = wilayah_kelurahan.id')
                ->get_where('shelter', ['id_bencana' => $id_bencana])->result(),
            'id_bencana' => $id_bencana
        ];
        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('shelter/index');
        $this->load->view('template/footer');
    }

    public function tambah($id_bencana)
    {
        $kj = $this->db
            ->select('id_wilayah, id_kelurahan')
            ->join('kaji_cepat_nw as kc', 'kc.id = korban_jiwa.id_kaji_cepat_nw')
            ->where('kc.id_bencana', $id_bencana)
            ->get('korban_jiwa')->result();
        $kb = $this->db
            ->select('id_wilayah, id_kelurahan')
            ->join('kaji_cepat_nw as kc', 'kc.id = kerusakan_bangunan.id_kaji_cepat_nw')
            ->where('kc.id_bencana', $id_bencana)
            ->get('kerusakan_bangunan')->result();

        $arr_wilayah = [];
        foreach ($kj as $value) {
            $arr_wilayah[] = $value->id_wilayah;
        }
        foreach ($kb as $value) {
            $arr_wilayah[] = $value->id_wilayah;
        }
        $kecamatan = $this->db->order_by('nama', 'asc')->get('wilayah')->result();
        $kecamatan_new = [];
        foreach ($kecamatan as $value) {
            if (in_array($value->id, $arr_wilayah)) {
                $kecamatan_new[] = $value;
            }
        }

        $data_ = [
            'title' => 'Tambah Shelter',
            'kecamatan' => $kecamatan_new,
            'id_bencana' => $id_bencana
        ];
        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('shelter/tambah');
        $this->load->view('template/footer');
    }

    function insert()
    {

        $data_insert = [
            'nama' => $_POST['nama'],
            'keterangan' => $_POST['keterangan'],
            'id_bencana' => $_POST['id_bencana'],
            'id_kecamatan' => $_POST['id_wilayah'],
            'id_kelurahan' => $_POST['id_kelurahan'],
            'maps' => "$_POST[latitude],$_POST[longitude]"
        ];

        $this->db->insert('shelter', $data_insert);
        $this->session->set_flashdata([
            'message' => 'Data shelter berhasil ditambahkan.',
            'type' => 'success'
        ]);
        redirect('shelter/list/' . $_POST['id_bencana']);
    }

    function update()
    {

        $data_update = [
            'nama' => $_POST['nama'],
            'keterangan' => $_POST['keterangan'],
            'id_bencana' => $_POST['id_bencana'],
            'id_kecamatan' => $_POST['id_wilayah'],
            'id_kelurahan' => $_POST['id_kelurahan'],
            'maps' => "$_POST[latitude],$_POST[longitude]"
        ];


        $this->db->where('id', $_POST['id'])->update('shelter', $data_update);
        $this->session->set_flashdata([
            'message' => 'Data shelter berhasil update.',
            'type' => 'success'
        ]);
        redirect('shelter/edit/' . $_POST['id']);
    }

    function hapus()
    {
        foreach ($_POST['id'] as $key => $v) {
            $this->db->delete('shelter', ['id' => $v]);
        }

        $this->session->set_flashdata([
            'message' => 'Berhasil menghapus ' . count($_POST['id']) . ' data.',
            'type' => 'success'
        ]);
        redirect($_SERVER['HTTP_REFERER']);
    }

    function edit($id)
    {
        $shelter = $this->db->get_where('shelter', ['id' => $id])->row();
        $data_ = [
            'title' => 'Edit Shelter',
            'shelter' => $shelter,
            'id_bencana' => $shelter->id_bencana,
            'kecamatan' => $this->db->get('wilayah')->result(),
            'kelurahan' => $this->db->get_where('wilayah_kelurahan', ['id_wilayah' => $shelter->id_kecamatan])->result(),
            'bencana' => $this->db->get_where('bencana', ['id' => $shelter->id_bencana])->row(),
        ];
        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('shelter/tambah');
        $this->load->view('template/footer');
    }
}
