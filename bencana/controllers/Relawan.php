<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Relawan extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            $this->session->set_flashdata('message', 'You must login.');
            return redirect('/');
        }
    }

	public function index()
	{
        $relawan = $this->db->where('tersedia', 1)->get('relawan')->result();
        foreach ($relawan as $key => $value) {
            $kecakapan = $this->db->select('kecakapan.kelompok')
            ->join('kecakapan', 'kecakapan_relawan.id_kecakapan = kecakapan.id')
            ->where('kecakapan_relawan.id_relawan', $value->id)
            ->get('kecakapan_relawan')->result_array();
            $kelompok_list = array_column($kecakapan, 'kelompok');
            $value->kecakapan = implode(', ', $kelompok_list);
        }

        $relawan_alokasi = $this->db->where('tersedia', 0)->get('relawan')->result();
        foreach ($relawan_alokasi as $key => $value) {
            $kecakapan = $this->db->select('kecakapan.kelompok')
            ->join('kecakapan', 'kecakapan_relawan.id_kecakapan = kecakapan.id')
            ->where('kecakapan_relawan.id_relawan', $value->id)
            ->get('kecakapan_relawan')->result_array();
            $kelompok_list = array_column($kecakapan, 'kelompok');
            $value->kecakapan = implode(', ', $kelompok_list);
        }

        $data_ = [
            'title' => 'Data Relawan',
            'relawan' => $relawan,
            'relawan_alokasi' => $relawan_alokasi,
        ];
		$this->load->view('template/header', $data_);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('relawan/index');
		$this->load->view('template/footer');
	}

	public function tambah()
	{
        $data_ = [
            'title' => 'Tambah Relawan',
            'kecakapan' => $this->db->get('kecakapan')->result(),
        ];
		$this->load->view('template/header', $data_);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('relawan/tambah');
		$this->load->view('template/footer');
	}

    function insert() {
        $config['upload_path']   = './assets/foto_relawan/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size']      = 5000; // 5MB
        $config['file_name'] = uniqid('img_') . '.' . pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $this->upload->initialize($config);
        
        if (!$this->upload->do_upload('foto')) {
            echo $this->upload->display_errors();
            exit();
        }

        $data_insert = [
            'foto' => $this->upload->data()['file_name'],
            'nama' => $_POST['nama'],
            'tgl_lahir' => $_POST['tgl_lahir'],
            'jenis_kelamin' => $_POST['jenis_kelamin'],
            'no_kontak' => $_POST['no_kontak'],
            'institusi' => $_POST['institusi'],
            'pengalaman_kerelawanan' => $_POST['pengalaman_kerelawanan'],
            'pengalaman' => $_POST['pengalaman'],
        ];

        $this->db->insert('relawan', $data_insert);
        $id_relawan = $this->db->insert_id();

        foreach ($_POST['kecakapan'] as $key => $value) {
            $this->db->insert('kecakapan_relawan', [
                'id_relawan' => $id_relawan,
                'id_kecakapan' => $value
            ]);
        }

        $this->session->set_flashdata([
            'message' => 'Data relawan berhasil ditambahkan.',
            'type' => 'success'
        ]);
        redirect('relawan');
    }

    function update() {
        $config['upload_path']   = './assets/foto_relawan/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size']      = 5000; // 5MB
        $config['file_name'] = uniqid('img_') . '.' . pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $this->upload->initialize($config);
        
        $data_update = [
            'nama' => $_POST['nama'],
            'tgl_lahir' => $_POST['tgl_lahir'],
            'jenis_kelamin' => $_POST['jenis_kelamin'],
            'no_kontak' => $_POST['no_kontak'],
            'institusi' => $_POST['institusi'],
            'pengalaman_kerelawanan' => $_POST['pengalaman_kerelawanan'],
            'pengalaman' => $_POST['pengalaman'],
        ];

        if ($this->upload->do_upload('foto')) {
            $data_update['foto'] = $this->upload->data()['file_name'];
        }


        $this->db->where('id', $_POST['id'])->update('relawan', $data_update);

        $this->db->where('id_relawan', $_POST['id'])->delete('kecakapan_relawan');

        foreach ($_POST['kecakapan'] as $key => $value) {
            $this->db->insert('kecakapan_relawan', [
                'id_relawan' => $_POST['id'],
                'id_kecakapan' => $value
            ]);
        }

        $this->session->set_flashdata([
            'message' => 'Data relawan berhasil update.',
            'type' => 'success'
        ]);
        redirect('relawan/edit/'.$_POST['id']);
    }

    function hapus() {
        foreach ($_POST['id'] as $key => $v) {
            $this->db->delete('relawan', ['id' => $v]);
        }

        $this->session->set_flashdata([
            'message' => 'Berhasil menghapus '.count($_POST['id']).' data.',
            'type' => 'success'
        ]);
        redirect('relawan');
    }

    function edit($id) {
        $kecakapan = $this->db->select('kecakapan.id')
        ->join('kecakapan', 'kecakapan_relawan.id_kecakapan = kecakapan.id')
        ->where('kecakapan_relawan.id_relawan', $id)
        ->get('kecakapan_relawan')->result_array();
        $kelompok_list = array_column($kecakapan, 'id');

        $data_ = [
            'title' => 'Edit Relawan',
            'relawan' => $this->db->get_where('relawan', ['id' => $id])->row(),
            'kecakapan' => $this->db->get('kecakapan')->result(),
            'kecakapan_relawan' => $kelompok_list
        ];
		$this->load->view('template/header', $data_);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('relawan/tambah');
		$this->load->view('template/footer');
    }

    public function get_by_kecakapan($id_kecakapan) {
        if (!$id_kecakapan) {
            echo json_encode([
                'status' => 'error',
                'message' => 'ID kecakapan tidak ditemukan.'
            ]);
            return;
        }
    
        $relawan = $this->db
            ->select('relawan.id, relawan.nama')
            ->join('kecakapan_relawan', 'kecakapan_relawan.id_relawan = relawan.id')
            ->where('kecakapan_relawan.id_kecakapan', $id_kecakapan)
            ->where('relawan.disetujui', 1)
            ->where('relawan.tersedia', 1)
            ->order_by('relawan.nama', 'asc')
            ->get('relawan')
            ->result();
    
        if (empty($relawan)) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Tidak ada relawan ditemukan untuk kecakapan ini.'
            ]);
            return;
        }
    
        echo json_encode([
            'status' => 'success',
            'data' => $relawan
        ]);
    }
    

    public function simpan_relawan_disetujui() {
        $approved_relawan = $this->input->post('approved_relawan');
    
        if (empty($approved_relawan)) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Tidak ada relawan yang dipilih.'
            ]);
            return;
        }
    
        // Reset semua relawan ke status tidak disetujui
        $this->db->update('relawan', ['disetujui' => 0]);
    
        // Perbarui status untuk relawan yang disetujui
        $this->db->where_in('id', $approved_relawan)
                 ->update('relawan', ['disetujui' => 1]);
    
        echo json_encode([
            'status' => 'success',
            'message' => 'Status relawan berhasil diperbarui.'
        ]);
    }
      

}
