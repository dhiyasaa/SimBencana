<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bangunan_rusak extends CI_Controller {
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
            'title' => 'Data Bangunan rusak',
            'bangunan_rusak' => $this->db->get('bangunan_rusak')->result()
        ];
		$this->load->view('template/header', $data_);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('bangunan_rusak/index');
		$this->load->view('template/footer');
	}

	public function tambah()
	{
        $data_ = [
            'title' => 'Tambah Bangunan_rusak',
        ];
		$this->load->view('template/header', $data_);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('bangunan_rusak/tambah');
		$this->load->view('template/footer');
	}

    function insert() {

        $data_insert = [
            'tanggal' => $_POST['tanggal'],
            'seng' => $_POST['seng'],
            'kayu' => $_POST['kayu'],
            'dinding' => $_POST['dinding'],
        ];

        $this->db->insert('bangunan_rusak', $data_insert);
        $this->session->set_flashdata([
            'message' => 'Data bangunan_rusak berhasil ditambahkan.',
            'type' => 'success'
        ]);
        redirect('bangunan_rusak');
    }

    function update() {
        
        $data_update = [
            'tanggal' => $_POST['tanggal'],
            'seng' => $_POST['seng'],
            'kayu' => $_POST['kayu'],
            'dinding' => $_POST['dinding'],
        ];


        $this->db->where('id', $_POST['id'])->update('bangunan_rusak', $data_update);
        $this->session->set_flashdata([
            'message' => 'Data bangunan_rusak berhasil update.',
            'type' => 'success'
        ]);
        redirect('bangunan_rusak/edit/'.$_POST['id']);
    }

    function hapus() {
        foreach ($_POST['id'] as $key => $v) {
            $this->db->delete('bangunan_rusak', ['id' => $v]);
        }

        $this->session->set_flashdata([
            'message' => 'Berhasil menghapus '.count($_POST['id']).' data.',
            'type' => 'success'
        ]);
        redirect('bangunan_rusak');
    }

    function edit($id) {
        $data_ = [
            'title' => 'Edit Bangunan_rusak',
            'bangunan_rusak' => $this->db->get_where('bangunan_rusak', ['id' => $id])->row()
        ];
		$this->load->view('template/header', $data_);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('bangunan_rusak/tambah');
		$this->load->view('template/footer');
    }
}
