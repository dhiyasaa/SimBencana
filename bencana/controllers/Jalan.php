<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jalan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            $this->session->set_flashdata('message', 'You must login.');
            return redirect('/');
        }
        $this->load->helper(array('form', 'url'));
    }

    public function index()
    {
        $data_ = [
            'title' => 'Data Bencana untuk Pendataan Infrastruktur',
            'bencana' => $this->db->get('bencana')->result()
        ];
        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('jalan/bencana');
        $this->load->view('template/footer');
    }

    public function list($id_bencana)
    {
        // Ambil data jenis bencana berdasarkan id_bencana
        $bencana = $this->db->get_where('bencana', ['id' => $id_bencana])->row();
    
        // Pastikan data jenis bencana ada
        if ($bencana) {
            $title = 'Data Infrastruktur untuk ' . $bencana->jenis_bencana . 
                 ' pada ' . date('Y-m-d', strtotime($bencana->tanggal_kejadian)) . 
                 ' di ' . $bencana->lokasi;
        } else {
            $title = 'Data Jalan';
        }

        $data_ = [
            'title' => $title,
            'jalan' => $this->db
                ->select('jalan.*')
                ->get_where('jalan', ['id_bencana' => $id_bencana])->result(),
            'id_bencana' => $id_bencana
        ];
        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('jalan/index');
        $this->load->view('template/footer');
    }

    public function tambah($id_bencana)
    {
        $data_ = [
            'title' => 'Tambah Jalan',
            'id_bencana' => $id_bencana
        ];
        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('jalan/tambah');
        $this->load->view('template/footer');
    }

    function insert()
    {

        $data_insert = [
            'nama' => $_POST['nama'],
            'keterangan' => $_POST['keterangan'],
            'id_bencana' => $_POST['id_bencana'],
            'lokasi' => $_POST['lokasi'],
            'maps' => "$_POST[latitude],$_POST[longitude]"
        ];

        if ($_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $fileExtension = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
            $randomName = bin2hex(random_bytes(16));
            $uploadFile = 'assets/uploads/' . $randomName . '.' . $fileExtension;
            $file_name = $randomName . '.' . $fileExtension;

            if (move_uploaded_file($_FILES['foto']['tmp_name'], $uploadFile)) {
                $data_insert['foto'] = $file_name;
            }
        }

        $this->db->insert('jalan', $data_insert);
        $this->session->set_flashdata([
            'message' => 'Data jalan berhasil ditambahkan.',
            'type' => 'success'
        ]);
        redirect('jalan/list/' . $_POST['id_bencana']);
    }

    function update()
    {

        $data_update = [
            'nama' => $_POST['nama'],
            'keterangan' => $_POST['keterangan'],
            'id_bencana' => $_POST['id_bencana'],
            'lokasi' => $_POST['lokasi'],
            'maps' => "$_POST[latitude],$_POST[longitude]"
        ];

        if ($_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $fileExtension = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
            $randomName = bin2hex(random_bytes(16));
            $uploadFile = 'assets/uploads/' . $randomName . '.' . $fileExtension;
            $file_name = $randomName . '.' . $fileExtension;

            if (move_uploaded_file($_FILES['foto']['tmp_name'], $uploadFile)) {
                $data_update['foto'] = $file_name;
            }
        }


        $this->db->where('id', $_POST['id'])->update('jalan', $data_update);
        $this->session->set_flashdata([
            'message' => 'Data jalan berhasil update.',
            'type' => 'success'
        ]);
        redirect('jalan/edit/' . $_POST['id']);
    }

    function hapus()
    {
        foreach ($_POST['id'] as $key => $v) {
            $this->db->delete('jalan', ['id' => $v]);
        }

        $this->session->set_flashdata([
            'message' => 'Berhasil menghapus ' . count($_POST['id']) . ' data.',
            'type' => 'success'
        ]);
        redirect($_SERVER['HTTP_REFERER']);
    }

    function edit($id)
    {
        $jalan = $this->db->get_where('jalan', ['id' => $id])->row();
        $data_ = [
            'title' => 'Edit Jalan',
            'jalan' => $jalan,
            'id_bencana' => $jalan->id_bencana,
            'bencana' => $this->db->get_where('bencana', ['id' => $jalan->id_bencana])->row(),
        ];
        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('jalan/tambah');
        $this->load->view('template/footer');
    }
}
