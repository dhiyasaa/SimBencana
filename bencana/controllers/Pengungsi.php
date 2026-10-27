<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengungsi extends CI_Controller
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
            'title' => 'Data Bencana untuk Pendataan Pengungsi',
            'bencana' => $this->db->get('bencana')->result()
        ];
        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('pengungsi/bencana');
        $this->load->view('template/footer');
    }

    public function list($id_bencana)
    {
        // Ambil data jenis bencana berdasarkan id_bencana
        $bencana = $this->db->get_where('bencana', ['id' => $id_bencana])->row();
    
        // Pastikan data jenis bencana ada
        if ($bencana) {
            $title = 'Data Pengungsi untuk ' . $bencana->jenis_bencana . 
                 ' pada ' . date('Y-m-d', strtotime($bencana->tanggal_kejadian)) . 
                 ' di ' . $bencana->lokasi;
        } else {
            $title = 'Data Pengungsi';
        }

        $data_ = [
            'title' => $title,
            'pengungsi' => $this->db
                ->select('pengungsi.*, shelter.nama as shelter')
                ->join('shelter', 'shelter.id = pengungsi.id_shelter')
                ->where('id_bencana', $id_bencana)
                ->get('pengungsi')->result(),
            'id_bencana' => $id_bencana,
        ];
        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('pengungsi/index');
        $this->load->view('template/footer');
    }

    public function tambah($id_bencana)
    {
        $data_ = [
            'title' => 'Tambah Pengungsi',
            'kecamatan' => $this->db->get('wilayah')->result(),
            'id_bencana' => $id_bencana,
            'shelter' => $this->db->get_where('shelter', ['id_bencana' => $id_bencana])->result()
        ];
        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('pengungsi/tambah');
        $this->load->view('template/footer');
    }

    function insert()
    {

        $data_insert = [
            'id_shelter' => $_POST['id_shelter'],
            'laki_laki' => $_POST['laki_laki'],
            'perempuan' => $_POST['perempuan'],
            'rumah_tangga' => $_POST['rumah_tangga'],
            'anak' => $_POST['anak'],
            'bayi' => $_POST['bayi'],
            'bumil' => $_POST['bumil'],
            'cacat' => $_POST['cacat'],
            'lansia' => $_POST['lansia'],
            'pengendalian_penyakit' => $_POST['pengendalian_penyakit'],
            'kebutuhan_lainnya' => $_POST['kebutuhan_lainnya'],
        ];

        $this->db->insert('pengungsi', $data_insert);
        $this->session->set_flashdata([
            'message' => 'Data pengungsi berhasil ditambahkan.',
            'type' => 'success'
        ]);
        redirect('pengungsi/list/' . $_POST['id_bencana']);
    }

    function update()
    {

        $data_update = [
            'id_shelter' => $_POST['id_shelter'],
            'laki_laki' => $_POST['laki_laki'],
            'perempuan' => $_POST['perempuan'],
            'rumah_tangga' => $_POST['rumah_tangga'],
            'anak' => $_POST['anak'],
            'bayi' => $_POST['bayi'],
            'bumil' => $_POST['bumil'],
            'cacat' => $_POST['cacat'],
            'lansia' => $_POST['lansia'],
            'pengendalian_penyakit' => $_POST['pengendalian_penyakit'],
            'kebutuhan_lainnya' => $_POST['kebutuhan_lainnya'],
        ];


        $this->db->where('id', $_POST['id'])->update('pengungsi', $data_update);
        $this->session->set_flashdata([
            'message' => 'Data pengungsi berhasil update.',
            'type' => 'success'
        ]);
        redirect('pengungsi/edit/' . $_POST['id']);
    }

    function hapus()
    {
        foreach ($_POST['id'] as $key => $v) {
            $this->db->delete('pengungsi', ['id' => $v]);
        }

        $this->session->set_flashdata([
            'message' => 'Berhasil menghapus ' . count($_POST['id']) . ' data.',
            'type' => 'success'
        ]);
        redirect($_SERVER['HTTP_REFERER']);
    }

    function edit($id)
    {
        $pengungsi = $this->db
            ->select('pengungsi.*, shelter.nama as shelter, id_bencana')
            ->join('shelter', 'shelter.id = pengungsi.id_shelter')
            ->get_where('pengungsi', ['pengungsi.id' => $id])->row();
        $data_ = [
            'title' => 'Edit Pengungsi',
            'pengungsi' => $pengungsi,
            'shelter' => $this->db->get_where('shelter', ['id_bencana' => $pengungsi->id_bencana])->result(),
            'id_shelter' => $pengungsi->id_shelter,
            'id_bencana' => $pengungsi->id_bencana
        ];
        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('pengungsi/tambah');
        $this->load->view('template/footer');
    }

    public function detail($id_bencana)
    {
        $data_ = [
            'title' => 'Detail Pengungsi',
            'id_bencana' => $id_bencana,
            'shelter' => $this->db->get_where('shelter', ['id_bencana' => $id_bencana])->result(),
            'pengungsi_detail' => $this->db
                ->select('detail_pengungsi.*, shelter.nama as shelter')
                ->from('detail_pengungsi')
                ->join('shelter', 'shelter.id = detail_pengungsi.id_shelter')
                ->where('detail_pengungsi.id_bencana', $id_bencana) // Specify the table here
                ->get()->result()
        ];
        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('pengungsi/detail');
        $this->load->view('template/footer');
    }
    

    public function insert_detail()
    {
        $data = [
            'id_bencana' => $this->input->post('id_bencana'),
            'id_shelter' => $this->input->post('id_shelter'),
            'nama' => $this->input->post('nama'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'umur' => $this->input->post('umur'),
            'alamat' => $this->input->post('alamat'),
            'kelompok_rentan' => implode(', ', $this->input->post('kelompok_rentan'))
        ];
        $this->db->insert('detail_pengungsi', $data);
        redirect('pengungsi/detail/' . $this->input->post('id_bencana'));
    }

    public function hapus_detail($id)
    {
        $this->db->delete('detail_pengungsi', ['id' => $id]);
        redirect($_SERVER['HTTP_REFERER']);
    }

}
