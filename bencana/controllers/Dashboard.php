<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            $this->session->set_flashdata('message', 'You must login.');
            return redirect('/');
        }
    }

	public function index()
	{
		$relawan_kecakapan = $this->db->select('kecakapan.kelompok, COUNT(relawan.id) as jml')
		->join('kecakapan_relawan', 'kecakapan_relawan.id_kecakapan = kecakapan.id')
		->join('relawan', 'relawan.id = kecakapan_relawan.id_relawan')
		->group_by('kecakapan.kelompok')
		->get('kecakapan')->result();

		$bantuan = $this->db->select('jenis_bantuan')->group_by('jenis_bantuan')->get('bantuan')->result();
		foreach ($bantuan as $key => $value) {
			$value->data = $this->db->where(['jenis_bantuan' => $value->jenis_bantuan])->get('bantuan')->result();
		}
		$transportasi = $this->db->get('transportasi')->result();
		$data = [
			'relawan_kecakapan' => $relawan_kecakapan,
			'bantuan' => $bantuan,
			'transportasi' => $transportasi,
		];

		// var_dump($data['relawan']);exit();
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('dashboard');
		$this->load->view('template/footer');
	}
}
