<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transportasi extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            $this->session->set_flashdata('message', 'You must login.');
            return redirect('/');
        }
    }

	public function index()
	{
        $data_ = [
            'title' => 'Data Transportasi',
            'transportasi' => $this->db->get('transportasi')->result()
        ];
		$this->load->view('template/header', $data_);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('transportasi/index');
		$this->load->view('template/footer');
	}

	public function tambah()
	{
        $data_ = [
            'title' => 'Tambah Transportasi',
        ];
		$this->load->view('template/header', $data_);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('transportasi/tambah');
		$this->load->view('template/footer');
	}

    function insert() {

        $data_insert = [
            'jenis_kendaraan' => $_POST['jenis_kendaraan'],
            'jumlah' => $_POST['jumlah'],
            'tersedia' => $_POST['jumlah'],
            'instansi' => $_POST['instansi'],
            'tahun_pengadaan' => $_POST['tahun_pengadaan'],
            'kondisi' => $_POST['kondisi'],
            'keterangan' => $_POST['keterangan'],
            'jumlah_renkon' => $_POST['jumlah_renkon'],
            'kapasitas' => $_POST['kapasitas'],
        ];

        $this->db->insert('transportasi', $data_insert);
        $this->session->set_flashdata([
            'message' => 'Data transportasi berhasil ditambahkan.',
            'type' => 'success'
        ]);
        redirect('transportasi');
    }

    function update() {
        
        $data_update = [
            'jenis_kendaraan' => $_POST['jenis_kendaraan'],
            'jumlah' => $_POST['jumlah'],
            'tersedia' => $_POST['jumlah'],
            'instansi' => $_POST['instansi'],
            'tahun_pengadaan' => $_POST['tahun_pengadaan'],
            'kondisi' => $_POST['kondisi'],
            'keterangan' => $_POST['keterangan'],
            'jumlah_renkon' => $_POST['jumlah_renkon'],
            'kapasitas' => $_POST['kapasitas'],
        ];


        $this->db->where('id', $_POST['id'])->update('transportasi', $data_update);
        $this->session->set_flashdata([
            'message' => 'Data transportasi berhasil update.',
            'type' => 'success'
        ]);
        redirect('transportasi/edit/'.$_POST['id']);
    }

    function hapus() {
        foreach ($_POST['id'] as $key => $v) {
            $this->db->delete('transportasi', ['id' => $v]);
        }

        $this->session->set_flashdata([
            'message' => 'Berhasil menghapus '.count($_POST['id']).' data.',
            'type' => 'success'
        ]);
        redirect('transportasi');
    }

    function edit($id) {
        $data_ = [
            'title' => 'Edit Transportasi',
            'transportasi' => $this->db->get_where('transportasi', ['id' => $id])->row()
        ];
		$this->load->view('template/header', $data_);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('transportasi/tambah');
		$this->load->view('template/footer');
    }

    function get_jumlah($id_transportasi) {
        $transportasi = $this->db->get_where('transportasi', ['id' => $id_transportasi])->row();

        echo $transportasi->tersedia;
    }
}
