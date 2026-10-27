<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dasar_perkiraan extends CI_Controller {
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
            'title' => 'Dasar Perkiraan',
        ];
		$this->load->view('template/header', $data_);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('dasar_perkiraan/index');
		$this->load->view('template/footer');
	}

    function edit() {
        $data_ = [
            'title' => 'Edit Dasar Perkiraan',
            'bantuan' => $this->db->order_by('jenis_logistik')->get('bantuan')->result(),
            'kriteria' => $_POST['kriteria'],
            'perkiraan' => $this->db->get_where('panduan_bantuan', ['kriteria_penerima' => $_POST['kriteria']])->result(),
        ];
		$this->load->view('template/header', $data_);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('dasar_perkiraan/edit');
		$this->load->view('template/footer');
    }

    function update() {
        $this->db->where([
            'kriteria_penerima' => $_POST['kriteria']
        ])->delete('panduan_bantuan');

        foreach ($_POST['id_bantuan'] as $key => $value) {
            if ($_POST['jumlah'][$key] <= 0) {
                continue;
            }
            $this->db->insert('panduan_bantuan', [
                'id_bantuan' => $value,
                'qt' => $_POST['jumlah'][$key],
                'kriteria_penerima' => $_POST['kriteria']
            ]);
        }

        $this->session->set_flashdata([
            'message' => 'Berhasil mengupdate dasar bantuan untuk '. $_POST['kriteria'],
            'type' => 'success'
        ]);
        redirect('dasar_perkiraan');
    }

    function list() {
        $data_ = [
            'title' => 'Detail Dasar Perkiraan',
            // 'bantuan' => $this->db->order_by('jenis_logistik')->get('bantuan')->result(),
            'kriteria' => $_POST['kriteria'],
            'bantuan' => $this->db
                ->join('bantuan', 'bantuan.id = panduan_bantuan.id_bantuan')
                ->get_where('panduan_bantuan', ['kriteria_penerima' => $_POST['kriteria']])->result(),
        ];
		$this->load->view('template/header', $data_);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('dasar_perkiraan/detail');
		$this->load->view('template/footer');
    }
}
