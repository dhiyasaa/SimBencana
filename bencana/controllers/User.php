<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
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
            'title' => 'Data Bencana',
            'users' => $this->db->get('users')->result()
        ];
		$this->load->view('template/header', $data_);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('user/index');
		$this->load->view('template/footer');
	}

	public function tambah()
	{
        $data_ = [
            'title' => 'Tambah User',
        ];
		$this->load->view('template/header', $data_);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('user/tambah');
		$this->load->view('template/footer');
	}

    function insert() {

        $data_insert = [
            'username' => $_POST['username'],
            'role' => $_POST['role'],
            'password' => password_hash('12345678', PASSWORD_BCRYPT)
        ];

        $this->db->insert('users', $data_insert);
        $this->session->set_flashdata([
            'message' => 'User berhasil ditambahkan.',
            'type' => 'success',
        ]);
        redirect('user');
    }

    function update() {
        
        $data_update = [
            'username' => $_POST['username'],
            'role' => $_POST['role'],
        ];


        $this->db->where('id', $_POST['id'])->update('users', $data_update);
        $this->session->set_flashdata([
            'message' => 'Data user berhasil update.',
            'type' => 'success'
        ]);
        redirect('user/edit/'.$_POST['id']);
    }

    function reset() {
        
        $data_update = [
            'password' => password_hash('12345678', PASSWORD_BCRYPT)
        ];


        $this->db->where('id', $_POST['id'])->update('users', $data_update);
        $this->session->set_flashdata([
            'message' => 'Password berhasil direset.',
            'type' => 'success'
        ]);
        redirect('user');
    }

    function hapus() {
        foreach ($_POST['id'] as $key => $v) {
            $this->db->delete('users', ['id' => $v]);
        }

        $this->session->set_flashdata([
            'message' => 'Berhasil menghapus '.count($_POST['id']).' data.',
            'type' => 'success'
        ]);
        redirect('user');
    }

    function edit($id) {
        $data_ = [
            'title' => 'Edit User',
            'user' => $this->db->get_where('users', ['id' => $id])->row()
        ];
		$this->load->view('template/header', $data_);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('user/tambah');
		$this->load->view('template/footer');
    }
}
