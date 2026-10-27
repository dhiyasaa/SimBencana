<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bantuan extends CI_Controller {
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
            'title' => 'Data Bantuan',
            'bantuan' => $this->db->get('bantuan')->result()
        ];
		$this->load->view('template/header', $data_);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('bantuan/index');
		$this->load->view('template/footer');
	}

	public function tambah()
	{
        $data_ = [
            'title' => 'Tambah Bantuan',
        ];
		$this->load->view('template/header', $data_);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('bantuan/tambah');
		$this->load->view('template/footer');
	}

    function insert() {

        $data_insert = [
            'jenis_logistik' => $_POST['jenis_logistik'],
            'spesifikasi' => $_POST['spesifikasi'],
            'jumlah' => $_POST['jumlah'],
            'satuan' => $_POST['satuan'],
            'jenis_bantuan' => $_POST['jenis_bantuan'],
            'keterangan' => $_POST['keterangan'],
        ];

        $this->db->insert('bantuan', $data_insert);
        $this->session->set_flashdata([
            'message' => 'Data bantuan berhasil ditambahkan.',
            'type' => 'success'
        ]);
        redirect('bantuan');
    }

    function update() {
        
        $data_update = [
            'jenis_logistik' => $_POST['jenis_logistik'],
            'spesifikasi' => $_POST['spesifikasi'],
            'jumlah' => $_POST['jumlah'],
            'satuan' => $_POST['satuan'],
            'jenis_bantuan' => $_POST['jenis_bantuan'],
            'keterangan' => $_POST['keterangan'],
        ];


        $this->db->where('id', $_POST['id'])->update('bantuan', $data_update);
        $this->session->set_flashdata([
            'message' => 'Data bantuan berhasil update.',
            'type' => 'success'
        ]);
        redirect('bantuan/edit/'.$_POST['id']);
    }

    function hapus() {
        foreach ($_POST['id'] as $key => $v) {
            $this->db->delete('bantuan', ['id' => $v]);
        }

        $this->session->set_flashdata([
            'message' => 'Berhasil menghapus '.count($_POST['id']).' data.',
            'type' => 'success'
        ]);
        redirect('bantuan');
    }

    function edit($id) {
        $data_ = [
            'title' => 'Edit Bantuan',
            'bantuan' => $this->db->get_where('bantuan', ['id' => $id])->row()
        ];
		$this->load->view('template/header', $data_);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('bantuan/tambah');
		$this->load->view('template/footer');
    }
}
