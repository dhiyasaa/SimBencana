<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekonstruksi extends CI_Controller
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
            'title' => 'Data Bencana untuk Laporan Bangunan Rusak',
            'bencana' => $this->db->get('bencana')->result()
        ];
        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('rekonstruksi/bencana');
        $this->load->view('template/footer');
    }

    public function list($id_bencana)
    {
        $data_ = [
            'title' => 'Laporan Bangunan Rusak',
            'id_bencana' => $id_bencana,
            'bencana' => $this->db->get_where('bencana', ['id' => $id_bencana])->row(),
            'kecamatan' => $this->db
                ->select('wilayah.nama as nama, wilayah.id as id')
                ->join('wilayah', 'wilayah.id = id_kecamatan')
                ->group_by('id_kecamatan')
                ->get_where('bangunan_rusak_bencana', ['id_bencana' => $id_bencana])->result(),
        ];

        // var_dump($data_['kecamatan']);exit();
        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('rekonstruksi/index');
        $this->load->view('template/footer');
    }

    function get_kelurahan($id_bencana, $id_kecamatan)
    {
        $kelurahan = $this->db
            ->select('wilayah_kelurahan.nama as nama, wilayah_kelurahan.id as id')
            ->join('wilayah_kelurahan', 'wilayah_kelurahan.id = id_kelurahan')
            ->group_by('id_kelurahan')
            ->get_where('bangunan_rusak_bencana', ['id_bencana' => $id_bencana, 'id_kecamatan' => $id_kecamatan])->result();
        echo json_encode($kelurahan);
    }

    function get_bangunan_rusak($id_bencana, $id_kecamatan, $id_kelurahan)
    {
        $alokasi = $this->db
            ->select('alokasi_bangunan_rusak_bencana.*, bangunan_rusak_bencana.*, wilayah.nama as kecamatan, wilayah_kelurahan.nama as kelurahan')
            ->join('bangunan_rusak_bencana', 'bangunan_rusak_bencana.id = id_bangunan_rusak_bencana', 'right')
            ->join('wilayah_kelurahan', 'wilayah_kelurahan.id = id_kelurahan')
            ->join('wilayah', 'wilayah.id = id_kecamatan')
            ->where([
                'id_bencana' => $id_bencana,
                'id_kecamatan' => $id_kecamatan,
                'id_kelurahan' => $id_kelurahan
            ])
            ->get('alokasi_bangunan_rusak_bencana')->result();

        $harga = $this->db->order_by('tanggal', 'desc')->get('bangunan_rusak')->row();

        foreach ($alokasi as $key => $value) {
            $value->kerugian = number_format(($harga->seng * $value->seng + $harga->kayu * $value->kayu + $harga->dinding * $value->dinding ?? 0), 2, ',', '.');
        }

        $date = new DateTime(date('Y-m-d'));

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
            'alokasi' => $alokasi,
            'hari' => $hariIndonesia,
            'tgl' => $date->format('Y/m/d')
        ]);
    }
}
