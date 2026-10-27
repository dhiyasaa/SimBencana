<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kendaraan extends CI_Controller
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
            'title' => 'Data Kendaraan',
            'bencana' => $this->db->get('bencana')->result()
        ];
        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('kendaraan/bencana');
        $this->load->view('template/footer');
    }

    public function list($id_bencana)
    {
        $data_ = [
            'title' => 'Data Bencana',
            'kendaraan' => $this->db
                ->select('kendaraan.*, transportasi.jenis_kendaraan')
                ->join('transportasi', 'transportasi.id = id_transportasi')
                ->get_where('kendaraan', ['id_bencana' => $id_bencana])->result(),
            'id_bencana' => $id_bencana
        ];
        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('kendaraan/index');
        $this->load->view('template/footer');
    }

    public function tambah($id_bencana)
    {
        $data_ = [
            'title' => 'Tambah Kendaraan',
            'transportasi' => $this->db->get('transportasi')->result(),
            'id_bencana' => $id_bencana
        ];
        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('kendaraan/tambah');
        $this->load->view('template/footer');
    }

    function insert()
    {

        $data_insert = [
            'id_bencana' => $_POST['id_bencana'],
            'id_transportasi' => $_POST['id_transportasi'],
            'jumlah' => $_POST['jumlah'],
        ];

        $this->db->insert('kendaraan', $data_insert);
        $this->session->set_flashdata([
            'message' => 'Data kendaraan berhasil ditambahkan.',
            'type' => 'success'
        ]);
        redirect('kendaraan/list/' . $_POST['id_bencana']);
    }

    function update()
    {

        $data_update = [
            'id_bencana' => $_POST['id_bencana'],
            'id_transportasi' => $_POST['id_transportasi'],
            'jumlah' => $_POST['jumlah'],
        ];


        $this->db->where('id', $_POST['id'])->update('kendaraan', $data_update);
        $this->session->set_flashdata([
            'message' => 'Data kendaraan berhasil update.',
            'type' => 'success'
        ]);
        redirect('kendaraan/edit/' . $_POST['id']);
    }

    function hapus()
    {
        foreach ($_POST['id'] as $key => $v) {
            $this->db->delete('kendaraan', ['id' => $v]);
        }

        $this->session->set_flashdata([
            'message' => 'Berhasil menghapus ' . count($_POST['id']) . ' data.',
            'type' => 'success'
        ]);
        redirect($_SERVER['HTTP_REFERER']);
    }

    function edit($id)
    {
        $kendaraan = $this->db->get_where('kendaraan', ['id' => $id])->row();
        $data_ = [
            'title' => 'Edit Kendaraan',
            'kendaraan' => $kendaraan,
            'transportasi' => $this->db->get('transportasi')->result(),
            'id_bencana' => $kendaraan->id_bencana,
        ];
        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('kendaraan/tambah');
        $this->load->view('template/footer');
    }
}
