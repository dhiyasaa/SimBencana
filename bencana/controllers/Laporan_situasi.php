<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_situasi extends CI_Controller
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
            'title' => 'Data Bencana untuk Laporan Situasi',
            'bencana' => $this->db->get('bencana')->result()
        ];
        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('laporan_situasi/bencana');
        $this->load->view('template/footer');
    }

    public function list($id_bencana)
    {
        $data_ = [
            'title' => 'Laporan Situasi',
            'kaji_cepat' => $this->db
                ->get_where('kaji_cepat', ['id_bencana' => $id_bencana])->result(),
            'id_bencana' => $id_bencana,
            'bencana' => $this->db->get_where('bencana', ['id' => $id_bencana])->row()
        ];
        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('laporan_situasi/index');
        $this->load->view('template/footer');
    }

    function get_laporan_hari($id_bencana)
    {

        // Ambil daftar kecamatan yang terdampak
        $kecamatan_terdampak = $this->db->query("
            SELECT DISTINCT wilayah.nama AS nama_kecamatan
            FROM (
                SELECT id_wilayah, id_kaji_cepat_nw 
                FROM kerusakan_bangunan 
                UNION ALL 
                SELECT id_wilayah, id_kaji_cepat_nw 
                FROM korban_jiwa
            ) AS combined
            JOIN kaji_cepat_nw ON combined.id_kaji_cepat_nw = kaji_cepat_nw.id
            JOIN wilayah ON wilayah.id = combined.id_wilayah
            WHERE kaji_cepat_nw.id_bencana = ?
            ORDER BY wilayah.nama
        ", [$id_bencana])->result_array();

        // Ambil daftar kelurahan yang terdampak
        $kelurahan_terdampak = $this->db->query("
            SELECT DISTINCT wilayah_kelurahan.nama AS nama_kelurahan
            FROM (
                SELECT id_kelurahan, id_kaji_cepat_nw 
                FROM kerusakan_bangunan 
                UNION ALL 
                SELECT id_kelurahan, id_kaji_cepat_nw 
                FROM korban_jiwa
            ) AS combined
            JOIN kaji_cepat_nw ON combined.id_kaji_cepat_nw = kaji_cepat_nw.id
            JOIN wilayah_kelurahan ON wilayah_kelurahan.id = combined.id_kelurahan
            WHERE kaji_cepat_nw.id_bencana = ?
            ORDER BY wilayah_kelurahan.nama
        ", [$id_bencana])->result_array();

        // Ambil daftar shelter berdasarkan bencana
        $shelter_list = $this->db
        ->get_where('shelter', ['id_bencana' => $id_bencana])
        ->result_array();

        $kebutuhan_per_shelter = []; // Menyimpan kebutuhan bantuan per shelter

        foreach ($shelter_list as $shelter) {
            // Ambil kebutuhan bantuan untuk setiap shelter
            $kebutuhan_bantuan = $this->db
                ->select('alokasi_bantuan.jumlah AS kebutuhan, 
                        alokasi_bantuan.alokasi, 
                        alokasi_bantuan.diterima, 
                        (alokasi_bantuan.jumlah - alokasi_bantuan.diterima) AS kekurangan, 
                        bantuan.jenis_logistik, 
                        bantuan.spesifikasi, 
                        bantuan.satuan, 
                        bantuan.jenis_bantuan, 
                        bantuan.keterangan')
                ->join('bantuan', 'bantuan.id = alokasi_bantuan.id_bantuan')
                ->where('alokasi_bantuan.id_shelter', $shelter['id'])
                ->get('alokasi_bantuan')
                ->result_array();

        // Ambil bantuan lainnya untuk setiap shelter
        $bantuan_lainnya = $this->db
        ->select('pengendalian_penyakit, kebutuhan_lainnya')
        ->get_where('alokasi_bantuan_lainnya', ['id_shelter' => $shelter['id']])
        ->result_array();

            $kebutuhan_per_shelter[] = [
                'shelter' => $shelter,              // Informasi shelter
                'kebutuhan_bantuan' => $kebutuhan_bantuan, // Data kebutuhan bantuan shelter
                'bantuan_lainnya' => $bantuan_lainnya
            ];
        }

        $kebutuhan_relawan = $this->db
        ->select('kecakapan.kelompok AS kecakapan, relawan_banyak.jumlah')
        ->join('kecakapan', 'kecakapan.id = relawan_banyak.id_kecakapan_relawan')
        ->where('relawan_banyak.id_bencana', $id_bencana)
        ->get('relawan_banyak')
        ->result();

        $jml_kecamatan = count(
            $this->db->query("SELECT *
                FROM (
                    SELECT id_wilayah, id_kaji_cepat_nw 
                    FROM kerusakan_bangunan 
                    UNION ALL 
                    SELECT id_wilayah, id_kaji_cepat_nw 
                    FROM korban_jiwa
                ) AS combined
                JOIN kaji_cepat_nw ON combined.id_kaji_cepat_nw = kaji_cepat_nw.id
                WHERE kaji_cepat_nw.id_bencana = ?
                GROUP BY combined.id_wilayah", [$id_bencana])->result_array());
        
        $jml_kelurahan = count($this->db->query("SELECT *
        FROM (
            SELECT id_kelurahan, id_kaji_cepat_nw 
            FROM kerusakan_bangunan 
            UNION ALL 
            SELECT id_kelurahan, id_kaji_cepat_nw 
            FROM korban_jiwa
        ) AS combined
        JOIN kaji_cepat_nw ON combined.id_kaji_cepat_nw = kaji_cepat_nw.id
        WHERE kaji_cepat_nw.id_bencana = ?
        GROUP BY combined.id_kelurahan", [$id_bencana])->result_array());
        
        $bencana = $this->db->get_where('bencana', ['id' => $id_bencana])->row();
        $relawan = $this->db
            ->select('relawan.*, alokasi_relawan.kecakapan as kecakapan, relawan.nama as nama, alokasi_relawan.lama')
            ->join('relawan', 'relawan.id = id_relawan')
            ->get_where('alokasi_relawan', ['id_bencana' => $id_bencana])->result();
        $kelompok_kecakapan = $this->db
            ->select('kecakapan')
            ->group_by('kecakapan')
            ->get_where('alokasi_relawan', ['id_bencana' => $id_bencana])->result();
        $bantuan = $this->db
            ->join('shelter', 'shelter.id = id_shelter')
            ->join('bantuan', 'bantuan.id = id_bantuan')
            ->get_where('alokasi_bantuan', ['alokasi_bantuan.id_bencana' => $id_bencana])->result();
        $kendaraan = $this->db
            ->select('alokasi_transportasi.*,
                transportasi.jenis_kendaraan,
                transportasi.kondisi,
                alokasi_transportasi.jumlah
                ')
            ->join('transportasi', 'transportasi.id = id_transportasi')
            ->get_where('alokasi_transportasi', ['id_bencana' => $id_bencana])->result();
        $shelter = $this->db
            ->get_where('shelter', ['shelter.id_bencana' => $id_bencana])->result();
        $jalan = $this->db
            ->get_where('jalan', ['jalan.id_bencana' => $id_bencana])->result();

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
            'id_bencana' => $id_bencana,
            'jml_kecamatan' => $jml_kecamatan,
            'jml_kelurahan' => $jml_kelurahan,
            'kebutuhan_relawan' => $kebutuhan_relawan,
            'kebutuhan_per_shelter' => $kebutuhan_per_shelter,
            'kecamatan_terdampak' => $kecamatan_terdampak,
            'kelurahan_terdampak' => $kelurahan_terdampak, 
            'hari' => $hariIndonesia,
            'relawan' => $relawan,
            'bantuan' => $bantuan,
            'kendaraan' => $kendaraan,
            'shelter' => $shelter,
            'jalan' => $jalan,
            'kelompok_kecakapan' => $kelompok_kecakapan,
            'tgl' => $date->format('Y/m/d')
        ]);
    }
}
