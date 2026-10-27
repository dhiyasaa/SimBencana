<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Relawan_banyak extends CI_Controller {
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
            'title' => 'Data Bencana untuk Pendataan Relawan',
            'bencana' => $this->db->get('bencana')->result()
        ];
		$this->load->view('template/header', $data_);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('relawan_banyak/bencana');
		$this->load->view('template/footer');
	}

    public function list($id_bencana)
    {
        // Ambil data jenis bencana berdasarkan id_bencana
        $bencana = $this->db->get_where('bencana', ['id' => $id_bencana])->row();
    
        // Pastikan data jenis bencana ada
        if ($bencana) {
            $title = 'Data Relawan untuk ' . $bencana->jenis_bencana . 
                 ' pada ' . date('Y-m-d', strtotime($bencana->tanggal_kejadian)) . 
                 ' di ' . $bencana->lokasi;
        } else {
            $title = 'Data Relawan';
        }

        $data_ = [
            'title' => $title,
            'relawan_banyak' => $this->db
                ->select('relawan_banyak.*, kecakapan.kelompok')
                ->join('kecakapan', 'kecakapan.id = relawan_banyak.id_kecakapan_relawan')
                ->where('id_bencana', $id_bencana)
                ->get('relawan_banyak')->result(),
            'id_bencana' => $id_bencana,
        ];
        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('relawan_banyak/index');
        $this->load->view('template/footer');
    }

    public function tambah($id_bencana)
	{

        // Hitung total pengungsi berdasarkan shelter terkait bencana
        $total_pengungsi = $this->db->select('SUM(pengungsi.laki_laki + pengungsi.perempuan + pengungsi.anak + pengungsi.bayi) as total')
            ->join('pengungsi', 'pengungsi.id_shelter = shelter.id')
            ->where('shelter.id_bencana', $id_bencana)
            ->get('shelter')
            ->row()
            ->total;

        if (!$total_pengungsi) {
            $total_pengungsi = 0; // Pastikan nilai default 0 jika tidak ada data
        }

        // Logika perhitungan kebutuhan relawan berdasarkan total pengungsi
        $relawan_otomatis = [
            ['id_kecakapan_relawan' => 27, 'kecakapan' => 'Dokter', 'jumlah' => ceil($total_pengungsi / 1000)],
            ['id_kecakapan_relawan' => 28, 'kecakapan' => 'Perawat', 'jumlah' => ceil(($total_pengungsi * 2.4) / 1000)],
            ['id_kecakapan_relawan' => 29, 'kecakapan' => 'Bidan', 'jumlah' => ceil(($total_pengungsi * 2) / 1000)],
            ['id_kecakapan_relawan' => 30, 'kecakapan' => 'Tenaga Kefarmasian', 'jumlah' => ceil($total_pengungsi / 1000)],
            ['id_kecakapan_relawan' => 31, 'kecakapan' => 'Tenaga Kesehatan Masyarakat', 'jumlah' => 1],
            ['id_kecakapan_relawan' => 32, 'kecakapan' => 'Tenaga Kesehatan Lingkungan', 'jumlah' => ceil(($total_pengungsi * 0.21) / 1000)],
            ['id_kecakapan_relawan' => 33, 'kecakapan' => 'Tenaga Gizi', 'jumlah' => ceil(($total_pengungsi * 0.35) / 1000)],
            ['id_kecakapan_relawan' => 34, 'kecakapan' => 'Tenaga Kesehatan Jiwa', 'jumlah' => ceil($total_pengungsi / 20000)]
        ];


        $data_ = [
            'title' => 'Pendataan Kecakapan Relawan',
            'kecakapan' => $this->db->get('kecakapan')->result(),
            'relawan_otomatis' => $relawan_otomatis, // Kirim data otomatis ke view
            'id_bencana' => $id_bencana
        ];
		$this->load->view('template/header', $data_);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('relawan_banyak/tambah');
		$this->load->view('template/footer');
	}

    function insert() {
        $id_bencana = $_POST['id_bencana'];

        // Proses semua data yang dikirim dari form
        if (isset($_POST['kecakapan']) && isset($_POST['jumlah'])) {
            foreach ($_POST['kecakapan'] as $key => $value) {
                $this->db->insert('relawan_banyak', [
                    'id_bencana' => $id_bencana,
                    'id_kecakapan_relawan' => $value,
                    'jumlah' => $_POST['jumlah'][$key]
                ]);
            }
        }
    

        $this->session->set_flashdata([
            'message' => 'Data relawan berhasil ditambahkan.',
            'type' => 'success'
        ]);
        redirect('relawan_banyak/list/'.$_POST['id_bencana']);
    }

    function hapus() {
        $rb = $this->db->get_where('relawan_banyak', ['id' => $_POST['id'][0]])->row();
        foreach ($_POST['id'] as $key => $v) {
            $this->db->delete('relawan_banyak', ['id' => $v]);
        }

        $this->session->set_flashdata([
            'message' => 'Berhasil menghapus '.count($_POST['id']).' data.',
            'type' => 'success'
        ]);
        redirect('relawan_banyak/list/'.$rb->id_bencana);
    }
}