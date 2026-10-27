<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Alokasi_bantuan extends CI_Controller
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
            'title' => 'Data Bencana untuk Alokasi Bantuan',
            'bencana' => $this->db->get('bencana')->result()
        ];
        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('alokasi_bantuan/bencana');
        $this->load->view('template/footer');
    }

    public function list($id_bencana)
    {
        // Ambil data jenis bencana berdasarkan id_bencana
        $bencana = $this->db->get_where('bencana', ['id' => $id_bencana])->row();
    
        // Pastikan data jenis bencana ada
        if ($bencana) {
            $title = 'Data Alokasi Bantuan untuk ' . $bencana->jenis_bencana . 
                 ' pada ' . date('Y-m-d', strtotime($bencana->tanggal_kejadian)) . 
                 ' di ' . $bencana->lokasi;
        } else {
            $title = 'Data Alokasi Bantuan';
        }

        $shelter = $this->db
            ->select('id_shelter')
            ->group_by('id_shelter')
            ->get_where('alokasi_bantuan', ['alokasi_bantuan.id_bencana' => $id_bencana])->result();

        $shelter2 = $this->db
            ->select('id_shelter')
            ->group_by('id_shelter')
            ->get_where('alokasi_bantuan_lainnya', ['id_bencana' => $id_bencana])->result();

        $arr = [];
        foreach ($shelter as $key => $value) {
            $arr[] = $value->id_shelter;
        }
        foreach ($shelter2 as $key => $value) {
            $arr[] = $value->id_shelter;
        }

        $arr_shelter = [];
        foreach (array_unique($arr) as $key => $value) {
            $arr_shelter[] = $this->db->get_where('shelter', ['id' => $value])->row();
        }

        $data_ = [
            'title' => $title,
            'shelter' => $arr_shelter,
            'id_bencana' => $id_bencana,
        ];
        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('alokasi_bantuan/index');
        $this->load->view('template/footer');
    }

    function detail($id_shelter)
    {
        $bantuan = $this->db
            ->select('alokasi_bantuan.*, jenis_logistik, spesifikasi, satuan, jenis_bantuan, keterangan, foto_bukti')
            ->join('bantuan', 'bantuan.id =  id_bantuan')
            ->get_where('alokasi_bantuan', array('id_shelter' => $id_shelter))->result();

        $bantuan_lainnya = $this->db->get_where('alokasi_bantuan_lainnya', array('id_shelter' => $id_shelter))->result();
        $shelter = $this->db->get_where('shelter', array('id' => $id_shelter))->row();
        $bencana = $this->db->get_where('bencana', array('id' => $shelter->id_bencana))->row();

        $data_ = [
            'bantuan' => $bantuan,
            'bantuan_lainnya' => $bantuan_lainnya,
            'shelter' => $shelter,
            'bencana' => $bencana,
        ];

        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('alokasi_bantuan/detail');
        $this->load->view('template/footer');
    }

    public function tambah($id_bencana)
    {
        $data_ = [
            'title' => 'Tambah Perkiraan Bantuan Shelter',
            'shelter' => $this->db->get_where('shelter', ['id_bencana' => $id_bencana])->result(),
            'bantuan' => $this->db->get('bantuan')->result(),
            'id_bencana' => $id_bencana
        ];

        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('alokasi_bantuan/tambah');
        $this->load->view('template/footer');
    }

    function get_pengungsi($id_shelter) {
        $pengungsi = $this->db->get_where('pengungsi', ['id_shelter' => $id_shelter])->row();
        $panduan_bantuan = $this->db->get('panduan_bantuan')->result();
        $bantuan = $this->db->get('bantuan')->result();

        foreach ($bantuan as $key => $value) {
            $value->butuh = 0;
            
            // Laki laki
            $dasar = $this->db->get_where('panduan_bantuan',[
                'kriteria_penerima' => 'Laki-laki',
                'id_bantuan' => $value->id
            ])->row();
            if ($dasar) {
                $value->butuh += $pengungsi->laki_laki * $dasar->qt;
            }

            // Perempuan
            $dasar = $this->db->get_where('panduan_bantuan',[
                'kriteria_penerima' => 'Perempuan',
                'id_bantuan' => $value->id
            ])->row();
            if ($dasar) {
                $value->butuh += $pengungsi->perempuan * $dasar->qt;
            }

            // Rumah Tangga
            $dasar = $this->db->get_where('panduan_bantuan',[
                'kriteria_penerima' => 'Rumah Tangga',
                'id_bantuan' => $value->id
            ])->row();
            if ($dasar) {
                $value->butuh += $pengungsi->rumah_tangga * $dasar->qt;
            }

            // Anak-anak
            $dasar = $this->db->get_where('panduan_bantuan',[
                'kriteria_penerima' => 'Anak-anak',
                'id_bantuan' => $value->id
            ])->row();
            if ($dasar) {
                $value->butuh += $pengungsi->anak * $dasar->qt;
            }

            // Ibu Hamil/Menyusui
            $dasar = $this->db->get_where('panduan_bantuan',[
                'kriteria_penerima' => 'Ibu Hamil/Menyusui',
                'id_bantuan' => $value->id
            ])->row();
            if ($dasar) {
                $value->butuh += $pengungsi->bumil * $dasar->qt;
            }
            
            // Cacat
            $dasar = $this->db->get_where('panduan_bantuan',[
                'kriteria_penerima' => 'Cacat',
                'id_bantuan' => $value->id
            ])->row();
            if ($dasar) {
                $value->butuh += $pengungsi->cacat * $dasar->qt;
            }
            
            // Lansia
            $dasar = $this->db->get_where('panduan_bantuan',[
                'kriteria_penerima' => 'Lansia',
                'id_bantuan' => $value->id
            ])->row();
            if ($dasar) {
                $value->butuh += $pengungsi->lansia * $dasar->qt;
            }

            // Bayi
            $dasar = $this->db->get_where('panduan_bantuan',[
                'kriteria_penerima' => 'Bayi',
                'id_bantuan' => $value->id
            ])->row();
            if ($dasar) {
                $value->butuh += $pengungsi->bayi * $dasar->qt;
            }
        }

        echo json_encode([
            'pengungsi' => $pengungsi,
            'bantuan' => $bantuan
        ]);
    }

    function insert()
    {

        $this->load->library('upload'); // Pastikan library upload diload

        foreach ($_POST['id_bantuan'] as $key => $value) {
            
            $data_insert = [
                'id_bencana' => $_POST['id_bencana'],
                'jumlah' => $_POST['jumlah_' . $value],
                'alokasi' => $_POST['alokasi_' . $value],
                'diterima' => $_POST['diterima_' . $value],
                'id_bantuan' => $value,
                'id_shelter' => $_POST['id_shelter'],
                'disetujui' => isset($_POST['disetujui_' . $value]) ? 1 : 0 // Simpan status centang
                
            ];

            // Upload foto_bukti jika ada
            if (!empty($_FILES['foto_bukti_' . $value]['name'])) {
                $config['upload_path'] = './assets/uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 5000; // 5 MB
                $config['file_name'] = 'bukti_' . time() . '_' . $value;

                $this->upload->initialize($config);

                if ($this->upload->do_upload('foto_bukti_' . $value)) {
                    $data_insert['foto_bukti'] = $this->upload->data('file_name');
                } else {
                    $error = $this->upload->display_errors();
                    log_message('error', 'Upload Error: ' . $error); // Debugging log jika upload gagal
                }
            }

            $bantuan = $this->db->get_where('bantuan', ['id' => $value])->row();
            $jumlah = $bantuan->jumlah;
            $this->db->where(['id' => $value])->update('bantuan', [
                'jumlah' => $jumlah - $_POST['jumlah_' . $value]
            ]);
            
            $this->db->insert('alokasi_bantuan', $data_insert);
        }

        foreach ($_POST['pengendalian_penyakit'] as $key => $value) {
            $data_insert = [
                'id_bencana' => $_POST['id_bencana'],
                'id_shelter' => $_POST['id_shelter'],
                'pengendalian_penyakit' => $value,
                'kebutuhan_lainnya' => $_POST['kebutuhan_lainnya'][$key],
            ];

            $this->db->insert('alokasi_bantuan_lainnya', $data_insert);
        }

        $this->session->set_flashdata([
            'message' => 'Data alokasi_bantuan berhasil ditambahkan.',
            'type' => 'success'
        ]);

        redirect('alokasi_bantuan/list/' . $_POST['id_bencana']);
    }

   

    function update()
    {
        $this->load->library('upload'); // Pastikan library upload diload

        $this->db->delete('alokasi_bantuan', ['id_shelter' => $_POST['id_shelter']]);

        foreach ($_POST['id_bantuan'] as $key => $value) {
            $data_insert = [
                'id_bencana' => $_POST['id_bencana'],
                'jumlah' => $_POST['jumlah_' . $value],
                'alokasi' => $_POST['alokasi_' . $value],
                'diterima' => $_POST['diterima_' . $value],
                'id_bantuan' => $value,
                'id_shelter' => $_POST['id_shelter'],
                'disetujui' => isset($_POST['disetujui_' . $value]) ? 1 : 0 // Simpan status centang

            ];

            // Upload foto_bukti jika ada
            if (!empty($_FILES['foto_bukti_' . $value]['name'])) {
                $config['upload_path'] = './assets/uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 5000; // 5 MB
                $config['file_name'] = 'bukti_' . time() . '_' . $value;

                $this->upload->initialize($config);

                if ($this->upload->do_upload('foto_bukti_' . $value)) {
                    $data_insert['foto_bukti'] = $this->upload->data('file_name');
                } else {
                    $error = $this->upload->display_errors();
                    log_message('error', 'Upload Error: ' . $error); // Debugging log jika upload gagal
                }
            }

            $this->db->insert('alokasi_bantuan', $data_insert);
        }

        $this->db->delete('alokasi_bantuan_lainnya', ['id_shelter' => $_POST['id_shelter']]);
        foreach ($_POST['pengendalian_penyakit'] as $key => $value) {
            $data_insert = [
                'id_bencana' => $_POST['id_bencana'],
                'id_shelter' => $_POST['id_shelter'],
                'pengendalian_penyakit' => $value,
                'kebutuhan_lainnya' => $_POST['kebutuhan_lainnya'][$key],
            ];

            $this->db->insert('alokasi_bantuan_lainnya', $data_insert);
        }

        $this->session->set_flashdata([
            'message' => 'Data alokasi_bantuan berhasil update.',
            'type' => 'success'
        ]);
        redirect('alokasi_bantuan/edit/' . $_POST['id_shelter']);
    }

    function hapus()
    {
        foreach ($_POST['id'] as $key => $v) {
            $this->db->delete('alokasi_bantuan', ['id_shelter' => $v]);
            $this->db->delete('alokasi_bantuan_lainnya', ['id_shelter' => $v]);
        }

        $this->session->set_flashdata([
            'message' => 'Berhasil menghapus ' . count($_POST['id']) . ' data.',
            'type' => 'success'
        ]);
        redirect($_SERVER['HTTP_REFERER']);
    }

    function edit($id_shelter)
    {
        $bantuan = $this->db
            ->select('alokasi_bantuan.*, alokasi_bantuan.jumlah as jml, jenis_logistik, spesifikasi, satuan, jenis_bantuan, keterangan')
            ->join('bantuan', 'bantuan.id =  id_bantuan')
            ->get_where('alokasi_bantuan', array('id_shelter' => $id_shelter))->result();

        $bantuan_lainnya = $this->db->get_where('alokasi_bantuan_lainnya', array('id_shelter' => $id_shelter))->result();
        $shelter = $this->db->get_where('shelter', array('id' => $id_shelter))->row();
        $bencana = $this->db->get_where('bencana', array('id' => $shelter->id_bencana))->row();
        $alokasi_bantuan_arr = [];
        $alokasi_bantuan_arr_id_bantuan = [];
        foreach ($bantuan as $key => $value) {
            $alokasi_bantuan_arr[] = $value->id_bantuan;
            $alokasi_bantuan_arr_id_bantuan[$value->id_bantuan] = $value;
            $alokasi_bantuan_arr_id_bantuan[$value->id_bantuan]->jml = $value->jml;
        }

        $data_ = [
            'title' => 'Edit Bangunan rusak bencana',
            'alokasi_bantuan' => $bantuan,
            'alokasi_bantuan_lainnya' => $bantuan_lainnya,
            // 'shelter' => $shelter,
            'shelter' => $this->db->get_where('shelter', array('id' => $id_shelter))->result(),
            'bencana' => $bencana,
            'id_shelter' => $id_shelter,
            'id_bencana' => $bencana->id,
            'pengungsi' => $this->db->get_where('pengungsi', [
                'id_shelter' => $id_shelter
            ])->row(),
            'bantuan' => $this->db
                ->get('bantuan')->result(),
            'alokasi_bantuan_arr' => $alokasi_bantuan_arr,
            'alokasi_bantuan_arr_id_bantuan' => $alokasi_bantuan_arr_id_bantuan,
        ];
        $this->load->view('template/header', $data_);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('alokasi_bantuan/tambah');
        $this->load->view('template/footer');
    }
}
