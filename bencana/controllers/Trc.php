<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Trc extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            $this->session->set_flashdata('message', 'You must login.');
            return redirect('/');
        }
    }

    public function index()
    {
        $data_ = [
            'title' => 'Data Bencana untuk Laporan TRC',
            'bencana' => $this->db->get('bencana')->result()
        ];
        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('trc/bencana');
        $this->load->view('template/footer');
    }

    public function list($id_bencana)
    {
        $data_ = [
            'title' => 'Laporan TRC',
            'kaji_cepat' => $this->db
                ->get_where('kaji_cepat_nw', ['id_bencana' => $id_bencana])->result(),
            'id_bencana' => $id_bencana,
            'bencana' => $this->db->get_where('bencana', ['id' => $id_bencana])->row()
        ];
        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('trc/index');
        $this->load->view('template/footer');
    }

    function get_laporan_hari($id_bencana, $hari)
    {
        $kaji_cepat = $this->db
            ->select('kaji_cepat_nw.*')
            ->where('id_bencana', $id_bencana)
            ->get('kaji_cepat_nw', ['laporan_hari_ke' => $hari])->row();

        $bencana = $this->db->get_where('bencana', ['id' => $id_bencana])->row();

        $korban_jiwa = $this->db
            ->select('korban_jiwa.*, wilayah.nama as kecamatan, wilayah_kelurahan.nama as kelurahan')
            ->join('wilayah', 'wilayah.id = korban_jiwa.id_wilayah')
            ->join('wilayah_kelurahan', 'wilayah_kelurahan.id = korban_jiwa.id_kelurahan')
            ->get_where('korban_jiwa', ['id_kaji_cepat_nw' => $kaji_cepat->id])->result();
        
        $kerusakan_bangunan = $this->db
            ->select('kerusakan_bangunan.*, wilayah.nama as kecamatan, wilayah_kelurahan.nama as kelurahan')
            ->join('wilayah', 'wilayah.id = kerusakan_bangunan.id_wilayah')
            ->join('wilayah_kelurahan', 'wilayah_kelurahan.id = kerusakan_bangunan.id_kelurahan')
            ->get_where('kerusakan_bangunan', ['id_kaji_cepat_nw' => $kaji_cepat->id])->result();

        

        $date = new DateTime($bencana->tanggal_kejadian);

        $date->modify('+' . $hari . ' days');

        $namaHari = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
        ];

        $hariInggris = $date->format('l');
        $hariIndonesia = $namaHari[$hariInggris];

        echo json_encode([
            'kaji_cepat' => $kaji_cepat,
            'hari' => $hariIndonesia,
            'tgl' => $date->format('Y/m/d'),
            'korban_jiwa' => $korban_jiwa,
            'kerusakan_bangunan' => $kerusakan_bangunan,
        ]);
    }
}
