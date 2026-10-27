<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kaji_cepat extends CI_Controller {
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
            'title' => 'Data Bencana untuk Kaji Cepat',
            'bencana' => $this->db->get('bencana')->result()
        ];
		$this->load->view('template/header', $data_);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('kaji_cepat/bencana');
		$this->load->view('template/footer');
	}

	public function list($id_bencana)
	{
        // Ambil data jenis bencana berdasarkan id_bencana
        $bencana = $this->db->get_where('bencana', ['id' => $id_bencana])->row();
    
        // Pastikan data jenis bencana ada
        if ($bencana) {
            $title = 'Data Kaji Cepat untuk ' . $bencana->jenis_bencana . 
                 ' pada ' . date('Y-m-d', strtotime($bencana->tanggal_kejadian)) . 
                 ' di ' . $bencana->lokasi;
        } else {
            $title = 'Data Kaji Cepat';
        }

        $data_ = [
            'title' => $title,
            'kaji_cepat' => $this->db
                ->select('kaji_cepat_nw.*')
                ->where('id_bencana', $id_bencana)
                ->get('kaji_cepat_nw')->result(),
            'id_bencana' => $id_bencana
        ];
		$this->load->view('template/header', $data_);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('kaji_cepat/index');
		$this->load->view('template/footer');
	}

	public function tambah($id_bencana)
	{
        $data_ = [
            'title' => 'Tambah Kaji cepat',
            'id_bencana' => $id_bencana,
            'bencana' => $this->db->get_where('bencana', ['id' => $id_bencana])->row(),
            'kecamatan' => $this->db->get('wilayah')->result(),
        ];
		$this->load->view('template/header', $data_);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('kaji_cepat/tambah');
		$this->load->view('template/footer');
	}

    function add($id = 0) {
        $data_ = [
            'title' => 'Tambah Kaji cepat',
            'kecamatan' => $this->db->get('wilayah')->result(),
        ];

        if ($id != 0) {
            $data_['bencana'] = $this->db->get_where('bencana', ['id' => $id])->row();
        }

		$this->load->view('template/header', $data_);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('kaji_cepat/tambah2');
		$this->load->view('template/footer');
    }

    function get_kelurahan_by_kecamatan($id_kecamatan) {
        $kelurahan = $this->db->get_where('wilayah_kelurahan', ['id_wilayah' => $id_kecamatan])->result();

        echo json_encode($kelurahan);
    }

    function insert() {
        $this->db->insert('kaji_cepat', $_POST);
        $this->session->set_flashdata([
            'message' => 'Data kaji cepat berhasil ditambahkan.',
            'type' => 'success'
        ]);
        redirect('kaji_cepat/list/'.$_POST['id_bencana']);
    }

    function update() {
        $this->db->where('id', $_POST['id'])->update('kaji_cepat', $_POST);
        $this->session->set_flashdata([
            'message' => 'Data kaji_cepat berhasil update.',
            'type' => 'success'
        ]);
        redirect('kaji_cepat/edit/'.$_POST['id']);
    }

    function hapus() {
        foreach ($_POST['id'] as $key => $v) {
            $this->db->delete('kaji_cepat_nw', ['id' => $v]);
        }

        $this->session->set_flashdata([
            'message' => 'Berhasil menghapus '.count($_POST['id']).' data.',
            'type' => 'success'
        ]);
        redirect($_SERVER['HTTP_REFERER']);
    }

    function edit($id) {
        $kaji_cepat = $this->db->get_where('kaji_cepat', ['id' => $id])->row();
        $data_ = [
            'title' => 'Edit Kaji_cepat',
            'kaji_cepat' => $kaji_cepat,
            'id_bencana' => $kaji_cepat->id_bencana,
            'kecamatan' => $this->db->get('wilayah')->result(),
            'kelurahan' => $this->db->get_where('wilayah_kelurahan', ['id_wilayah' => $kaji_cepat->id_wilayah])->result(),
            'bencana' => $this->db->get_where('bencana', ['id' => $kaji_cepat->id_bencana])->row(),
        ];
		$this->load->view('template/header', $data_);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('kaji_cepat/tambah');
		$this->load->view('template/footer');
    }

    function detail($id) {
        $kc = $this->db
        ->select('kaji_cepat_nw.*')
        ->get_where('kaji_cepat_nw', ['id' => $id])->row();

        $kc->korban_jiwa = $this->db
            ->select('korban_jiwa.*, wilayah.nama as kecamatan, wilayah_kelurahan.nama as kelurahan')
            ->join('wilayah', 'wilayah.id = korban_jiwa.id_wilayah')
            ->join('wilayah_kelurahan', 'wilayah_kelurahan.id = korban_jiwa.id_kelurahan')
            ->get_where('korban_jiwa', ['id_kaji_cepat_nw' => $id])->result();
        $kc->kerusakan_bangunan = $this->db
            ->select('kerusakan_bangunan.*, wilayah.nama as kecamatan, wilayah_kelurahan.nama as kelurahan')
            ->join('wilayah', 'wilayah.id = kerusakan_bangunan.id_wilayah')
            ->join('wilayah_kelurahan', 'wilayah_kelurahan.id = kerusakan_bangunan.id_kelurahan')
            ->get_where('kerusakan_bangunan', ['id_kaji_cepat_nw' => $id])->result();

        $kc->bencana = $this->db->get_where('bencana', ['id' => $kc->id_bencana])->row();

        echo json_encode($kc);
    }

    function insert2() {
        $bencana = $this->db->get_where('bencana', [
            'jenis_bencana' => $_POST['jenis'],
            'tanggal_kejadian' => $_POST['tanggal'],
            'lokasi' => $_POST['lokasi'],
        ])->row();

        $id_bencana = null;
        if ($bencana == null) {
            $this->db->insert('bencana', [
                'jenis_bencana' => $_POST['jenis'],
                'tanggal_kejadian' => $_POST['tanggal'],
                'selesai_tanggap_darurat' => date('Y-m-d', strtotime($_POST['tanggal'] . ' +14 days')),
                'selesai_rekontruksi' => date('Y-m-d', strtotime($_POST['tanggal'] . ' +3 years')),
                'lokasi' => $_POST['lokasi'],
                'keterangan' => $_POST['keterangan_bencana'],
            ]);
            $id_bencana = $this->db->insert_id();
        } else {
            $id_bencana = $bencana->id;
        }

        $this->db->insert('kaji_cepat_nw', [
            'id_bencana' => $id_bencana,
            'laporan_hari_ke' => $_POST['laporan_hari_ke'],
            'keterangan' => $_POST['keterangan'],
            'upaya_penanganan_meninggal' => $_POST['upaya_penanganan_meninggal'],
            'upaya_penanganan_luka_berat' => $_POST['upaya_penanganan_luka_berat'],
            'upaya_penanganan_luka_ringan' => $_POST['upaya_penanganan_luka_ringan'],
            'upaya_penanganan_hilang' => $_POST['upaya_penanganan_hilang'],
            'upaya_penanganan_pengungsi' => $_POST['upaya_penanganan_pengungsi'],
            'upaya_penanganan_kerusakan_bangunan' => $_POST['upaya_penanganan_kerusakan_bangunan'],
            'kendala' => $_POST['kendala'],
            'potensi_susulan' => $_POST['potensi_susulan'],
            'rencana_aksi' => $_POST['rencana_aksi'],
            'kesimpulan' => $_POST['kesimpulan'],
            'rekomendasi' => $_POST['rekomendasi'],
        ]);
        $id_kaji_cepat = $this->db->insert_id();

        foreach ($_POST['id_wilayah'] as $key => $value) {
            $this->db->insert('korban_jiwa', [
                'id_kaji_cepat_nw' => $id_kaji_cepat,
                'id_wilayah' => $value,
                'id_kelurahan' => $_POST['id_kelurahan'][$key],
                'hilang' => $_POST['hilang'][$key],
                'luka_berat' => $_POST['luka_berat'][$key],
                'luka_ringan' => $_POST['luka_ringan'][$key],
                'pengungsi' => $_POST['pengungsi'][$key],
                'meninggal_dunia' => $_POST['meninggal_dunia'][$key],
            ]);
        }

        foreach ($_POST['id_wilayah2'] as $key => $value) {
            $this->db->insert('kerusakan_bangunan', [
                'id_kaji_cepat_nw' => $id_kaji_cepat,
                'id_wilayah' => $value,
                'id_kelurahan' => $_POST['id_kelurahan2'][$key],
                'kerusakan_ringan' => $_POST['kerusakan_ringan'][$key],
                'kerusakan_sedang' => $_POST['kerusakan_sedang'][$key],
                'kerusakan_kuat' => $_POST['kerusakan_kuat'][$key],
                'taksiran_kerugian' => $_POST['taksiran_kerugian'][$key],
            ]);
        }

        $this->session->set_flashdata([
            'message' => 'Data kaji cepat berhasil ditambahkan.',
            'type' => 'success'
        ]);
        redirect('kaji_cepat/list/'.$id_bencana);
    }
}
