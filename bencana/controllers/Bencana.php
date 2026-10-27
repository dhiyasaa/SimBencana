<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bencana extends CI_Controller {
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
            'bencana' => $this->db->get('bencana')->result()
        ];
		$this->load->view('template/header', $data_);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('bencana/index');
		$this->load->view('template/footer');
	}

	public function tambah()
	{
        $data_ = [
            'title' => 'Tambah Bencana',
        ];
		$this->load->view('template/header', $data_);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('bencana/tambah');
		$this->load->view('template/footer');
	}

    public function insert() {

        $config['upload_path'] = './assets/uploads/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 2048; 
        $this->load->library('upload');
        $this->upload->initialize($config);
    
        if (!$this->upload->do_upload('dokumen')) {
            $this->session->set_flashdata([
                'message' => $this->upload->display_errors(),
                'type' => 'danger'
            ]);
            redirect('bencana/tambah');
        }
    
        $upload_data = $this->upload->data();

        $data_insert = [
            'jenis_bencana' => $_POST['jenis_bencana'],
            'tanggal_kejadian' => $_POST['tanggal_kejadian'],
            'lokasi' => $_POST['lokasi'],
            'selesai_tanggap_darurat' => $_POST['selesai_tanggap_darurat'],
            'selesai_rehabilitas' => $_POST['selesai_rehabilitas'],
            'status' => $_POST['status'],
            'keterangan' => $_POST['keterangan'],
            'dokumen' => 'assets/uploads/' . $upload_data['file_name'],
        ];

        $this->db->insert('bencana', $data_insert);
        $this->session->set_flashdata([
            'message' => 'Data bencana berhasil ditambahkan.',
            'type' => 'success'
        ]);
        redirect('bencana');
    }

    public function update() {

        $config['upload_path'] = './assets/uploads/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 2048; 
        $this->load->library('upload');
        $this->upload->initialize($config);

        $data_update = [
            'jenis_bencana' => $_POST['jenis_bencana'],
            'tanggal_kejadian' => $_POST['tanggal_kejadian'],
            'lokasi' => $_POST['lokasi'],
            'selesai_tanggap_darurat' => $_POST['selesai_tanggap_darurat'],
            'selesai_rekontruksi' => $_POST['selesai_rekontruksi'],
            'status' => $_POST['status'],
            'keterangan' => $_POST['keterangan'],
        ];

        if ($_FILES['dokumen']['name']) {
            if (!$this->upload->do_upload('dokumen')) {
                $this->session->set_flashdata([
                    'message' => $this->upload->display_errors(),
                    'type' => 'danger'
                ]);
                redirect('bencana/edit/' . $_POST['id']);
            }
            $upload_data = $this->upload->data();
            $data_update['dokumen'] = 'assets/uploads/' . $upload_data['file_name'];
        }
    
        $this->db->where('id', $_POST['id'])->update('bencana', $data_update);
        $this->session->set_flashdata([
            'message' => 'Data bencana berhasil diupdate.',
            'type' => 'success'
        ]);
        redirect('bencana/edit/' . $_POST['id']);
    }

    function hapus() {
        foreach ($_POST['id'] as $key => $v) {
            $this->db->delete('bencana', ['id' => $v]);
        }

        $this->session->set_flashdata([
            'message' => 'Berhasil menghapus '.count($_POST['id']).' data.',
            'type' => 'success'
        ]);
        redirect('bencana');
    }

    function edit($id) {
        $data_ = [
            'title' => 'Edit Bencana',
            'bencana' => $this->db->get_where('bencana', ['id' => $id])->row()
        ];
		$this->load->view('template/header', $data_);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('bencana/tambah');
		$this->load->view('template/footer');
    }
}
