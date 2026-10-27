<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bangunan_rusak_bencana extends CI_Controller
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
            'title' => 'Data Bencana untuk Pendataan Bangunan Rusak',
            'bencana' => $this->db->get('bencana')->result()
        ];
        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('bangunan_rusak_bencana/bencana');
        $this->load->view('template/footer');
    }

    public function list($id_bencana, $id_wilayah = 0, $id_kelurahan = 0)
    {
        // Ambil data jenis bencana berdasarkan id_bencana
        $bencana = $this->db->get_where('bencana', ['id' => $id_bencana])->row();
    
        // Pastikan data jenis bencana ada
        if ($bencana) {
            $title = 'Data Bangunan Rusak untuk ' . $bencana->jenis_bencana . 
                 ' pada ' . date('Y-m-d', strtotime($bencana->tanggal_kejadian)) . 
                 ' di ' . $bencana->lokasi;
        } else {
            $title = 'Data Bangunan Rusak';
        }

        $kj = $this->db
            ->select('id_wilayah, id_kelurahan')
            ->join('kaji_cepat_nw as kc', 'kc.id = korban_jiwa.id_kaji_cepat_nw')
            ->where('kc.id_bencana', $id_bencana)
            ->get('korban_jiwa')->result();
        $kb = $this->db
            ->select('id_wilayah, id_kelurahan')
            ->join('kaji_cepat_nw as kc', 'kc.id = kerusakan_bangunan.id_kaji_cepat_nw')
            ->where('kc.id_bencana', $id_bencana)
            ->get('kerusakan_bangunan')->result();

        $arr_wilayah = [];
        foreach ($kj as $value) {
            $arr_wilayah[] = $value->id_wilayah;
        }
        foreach ($kb as $value) {
            $arr_wilayah[] = $value->id_wilayah;
        }
        $kecamatan = $this->db->order_by('nama', 'asc')->get('wilayah')->result();
        $kecamatan_new = [];
        foreach ($kecamatan as $value) {
            if (in_array($value->id, $arr_wilayah)) {
                $kecamatan_new[] = $value;
            }
        }

        $arr_kelurahan = [];
        if (isset($id_wilayah)) {
            foreach ($kj as $value) {
                $arr_kelurahan[] = $value->id_kelurahan;
            }
            foreach ($kb as $value) {
                $arr_kelurahan[] = $value->id_kelurahan;
            }
            $kelurahan = $this->db->where('id_wilayah', $id_wilayah)->order_by('nama', 'asc')->get('wilayah_kelurahan')->result();
            $kelurahan_new = [];
            foreach ($kelurahan as $value) {
                if (in_array($value->id, $arr_kelurahan)) {
                    $kelurahan_new[] = $value;
                }
            }
        }

        $data_ = [
            'title' => $title,
            'bangunan_rusak_bencana' => $this->db
                ->select('bangunan_rusak_bencana.*, wilayah.nama as kecamatan, wilayah_kelurahan.nama as kelurahan')
                ->join('wilayah', 'id_kecamatan = wilayah.id')
                ->join('wilayah_kelurahan', 'id_kelurahan = wilayah_kelurahan.id')
                ->where([
                    'id_kecamatan' => $id_wilayah,
                    'id_kelurahan' => $id_kelurahan,
                ])
                ->get_where('bangunan_rusak_bencana', ['id_bencana' => $id_bencana])->result(),
            'id_bencana' => $id_bencana,
            'kecamatan' => $kecamatan_new,
            'id_wilayah' => $id_wilayah,
            'id_kelurahan' => $id_kelurahan,
            'kelurahan' => $kelurahan_new,
        ];
        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('bangunan_rusak_bencana/index');
        $this->load->view('template/footer');
    }

    function get_kelurahan_by_kecamatan($id_kecamatan, $id_bencana)
    {
        $kj = $this->db
            ->select('id_wilayah, id_kelurahan')
            ->join('kaji_cepat_nw as kc', 'kc.id = korban_jiwa.id_kaji_cepat_nw')
            ->where('kc.id_bencana', $id_bencana)
            ->get('korban_jiwa')->result();
        $kb = $this->db
            ->select('id_wilayah, id_kelurahan')
            ->join('kaji_cepat_nw as kc', 'kc.id = kerusakan_bangunan.id_kaji_cepat_nw')
            ->where('kc.id_bencana', $id_bencana)
            ->get('kerusakan_bangunan')->result();

        $arr_kelurahan = [];
        foreach ($kj as $value) {
            $arr_kelurahan[] = $value->id_kelurahan;
        }
        foreach ($kb as $value) {
            $arr_kelurahan[] = $value->id_kelurahan;
        }
        $kelurahan = $this->db->where('id_wilayah', $id_kecamatan)->order_by('nama', 'asc')->get('wilayah_kelurahan')->result();
        $kelurahan_new = [];
        foreach ($kelurahan as $value) {
            if (in_array($value->id, $arr_kelurahan)) {
                $kelurahan_new[] = $value;
            }
        }

        echo json_encode($kelurahan_new);
    }

    public function tambah($id_bencana)
    {
        $kj = $this->db
            ->select('id_wilayah, id_kelurahan')
            ->join('kaji_cepat_nw as kc', 'kc.id = korban_jiwa.id_kaji_cepat_nw')
            ->where('kc.id_bencana', $id_bencana)
            ->get('korban_jiwa')->result();
        $kb = $this->db
            ->select('id_wilayah, id_kelurahan')
            ->join('kaji_cepat_nw as kc', 'kc.id = kerusakan_bangunan.id_kaji_cepat_nw')
            ->where('kc.id_bencana', $id_bencana)
            ->get('kerusakan_bangunan')->result();

        $arr_wilayah = [];
        foreach ($kj as $value) {
            $arr_wilayah[] = $value->id_wilayah;
        }
        foreach ($kb as $value) {
            $arr_wilayah[] = $value->id_wilayah;
        }
        $kecamatan = $this->db->get('wilayah')->result();
        $kecamatan_new = [];
        foreach ($kecamatan as $value) {
            if (in_array($value->id, $arr_wilayah)) {
                $kecamatan_new[] = $value;
            }
        }

        $data_ = [
            'title' => 'Tambah Bangunan rusak bencana',
            'kecamatan' => $kecamatan_new,
            'id_bencana' => $id_bencana
        ];
        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('bangunan_rusak_bencana/tambah');
        $this->load->view('template/footer');
    }

    function insert()
    {
        $id_bencana = $_POST['id_bencana'];
        $id_kecamatan = $_POST['id_wilayah'];
        $id_kelurahan = $_POST['id_kelurahan'];

        foreach ($_POST['nama'] as $key => $value) {
            $data_insert = [
                'id_bencana' => $id_bencana,
                'id_kecamatan' => $id_kecamatan,
                'id_kelurahan' => $id_kelurahan,
                'pemilik' => $value,
                'alamat' => $_POST['alamat'][$key],
                'jenis_kerusakan' => $_POST['jenis_kerusakan'][$key],
                'seng' => $_POST['seng'][$key],
                'kayu' => $_POST['kayu'][$key],
                'dinding' => $_POST['dinding'][$key],
            ];
            $this->db->insert('bangunan_rusak_bencana', $data_insert);
        }

        $this->session->set_flashdata([
            'message' => 'Data bangunan_rusak_bencana berhasil ditambahkan.',
            'type' => 'success'
        ]);
        redirect('bangunan_rusak_bencana/list/' . $_POST['id_bencana']);
    }

    function update()
    {

        $data_update = [
            'pemilik' => $_POST['nama'],
            'alamat' => $_POST['alamat'],
            'jenis_kerusakan' => $_POST['jenis_kerusakan'],
            'seng' => $_POST['seng'],
            'kayu' => $_POST['kayu'],
            'dinding' => $_POST['dinding'],
            'id_bencana' => $_POST['id_bencana'],
            'id_kecamatan' => $_POST['id_wilayah'],
            'id_kelurahan' => $_POST['id_kelurahan'],
        ];


        $this->db->where('id', $_POST['id'])->update('bangunan_rusak_bencana', $data_update);
        $this->session->set_flashdata([
            'message' => 'Data bangunan_rusak_bencana berhasil update.',
            'type' => 'success'
        ]);
        redirect('bangunan_rusak_bencana/edit/' . $_POST['id']);
    }

    function hapus()
    {
        foreach ($_POST['id'] as $key => $v) {
            $this->db->delete('bangunan_rusak_bencana', ['id' => $v]);
        }

        $this->session->set_flashdata([
            'message' => 'Berhasil menghapus ' . count($_POST['id']) . ' data.',
            'type' => 'success'
        ]);
        redirect($_SERVER['HTTP_REFERER']);
    }

    function edit($id)
    {
        $bangunan_rusak_bencana = $this->db->get_where('bangunan_rusak_bencana', ['id' => $id])->row();
        $data_ = [
            'title' => 'Edit Bangunan rusak bencana',
            'bangunan_rusak_bencana' => $bangunan_rusak_bencana,
            'id_bencana' => $bangunan_rusak_bencana->id_bencana,
            'kecamatan' => $this->db->get('wilayah')->result(),
            'kelurahan' => $this->db->get_where('wilayah_kelurahan', ['id_wilayah' => $bangunan_rusak_bencana->id_kecamatan])->result(),
            'bencana' => $this->db->get_where('bencana', ['id' => $bangunan_rusak_bencana->id_bencana])->row(),
        ];
        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('bangunan_rusak_bencana/tambah');
        $this->load->view('template/footer');
    }
}
