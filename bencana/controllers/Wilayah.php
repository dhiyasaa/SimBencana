<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wilayah extends CI_Controller {
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
            'title' => 'Data Wilayah',
            'wilayah' => $this->db
                ->select('wilayah.*, , (SELECT GROUP_CONCAT(nama SEPARATOR ", ") FROM wilayah_kelurahan WHERE wilayah_kelurahan.id_wilayah = wilayah.id) AS kelurahan')
                ->get('wilayah')->result()
        ];

		$this->load->view('template/header', $data_);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('wilayah/index');
		$this->load->view('template/footer');
	}

	public function tambah()
	{
        $data_ = [
            'title' => 'Tambah Wilayah',
        ];
		$this->load->view('template/header', $data_);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('wilayah/tambah');
		$this->load->view('template/footer');
	}

    function insert() {

        $this->db->insert('wilayah', ['nama' => $_POST['nama']]);
        $id_kecamatan = $this->db->insert_id();
        foreach ($_POST['nama_kelurahan'] as $key => $value) {
            $this->db->insert('wilayah_kelurahan', [
                'id_wilayah' => $id_kecamatan,
                'nama' => $_POST['nama_kelurahan'][$key],
                'total_penduduk' => $_POST['total_penduduk'][$key],
            ]);
        }

        $this->session->set_flashdata([
            'message' => 'Data wilayah berhasil ditambahkan.',
            'type' => 'success'
        ]);
        redirect('wilayah');
    }

    function update() {
        $data_update = [
            'nama' => $_POST['nama'],
        ];
        
        $this->db->where('id', $_POST['id'])->update('wilayah', $data_update);
        $id_kelurahan = $_POST['id_kelurahan'];

        // ambil kelurahan lama
        $kelurahan = $this->db->where('id_wilayah', $_POST['id'])->get('wilayah_kelurahan')->result();

        // hapus kelurahan
        foreach ($kelurahan as $key => $value) {
            if (!in_array($value->id, $id_kelurahan)) {
                $this->db->where('id', $value->id)->delete('wilayah_kelurahan');
            }
        }

        // update dan insert
        foreach ($id_kelurahan as $key => $value) {
            if ($value != 0) {
                $this->db->where('id', $value)->update('wilayah_kelurahan', [
                    'nama' => $_POST['nama_kelurahan'][$key],
                    'total_penduduk' => $_POST['total_penduduk'][$key],
                ]);
            } else {
                $this->db->insert('wilayah_kelurahan', [
                    'nama' => $_POST['nama_kelurahan'][$key],
                    'total_penduduk' => $_POST['total_penduduk'][$key],
                    'id_wilayah' => $_POST['id'],
                ]);
            }
        }
        
        $this->session->set_flashdata([
            'message' => 'Data wilayah berhasil update.',
            'type' => 'success'
        ]);
        redirect('wilayah/edit/'.$_POST['id']);
    }

    function hapus() {
        foreach ($_POST['id'] as $key => $v) {
            $this->db->delete('wilayah', ['id' => $v]);
        }

        $this->session->set_flashdata([
            'message' => 'Berhasil menghapus '.count($_POST['id']).' data.',
            'type' => 'success'
        ]);
        redirect('wilayah');
    }

    function edit($id) {
        $data_ = [
            'title' => 'Edit Wilayah',
            'wilayah' => $this->db->get_where('wilayah', ['id' => $id])->row(),
            'kelurahan' => $this->db->get_where('wilayah_kelurahan', ['id_wilayah' => $id])->result()
        ];
		$this->load->view('template/header', $data_);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('wilayah/tambah');
		$this->load->view('template/footer');
    }
}
