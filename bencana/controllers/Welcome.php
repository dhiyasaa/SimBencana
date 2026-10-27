<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->view('login');
	}

	function login() {
		$user = $this->db->where('username', $_POST['username'])->get('users')->row();
		if ($user == null || !password_verify($_POST['password'], $user->password)) {
			$this->session->set_flashdata('message', 'Username or password is incorrect');
            return redirect('/');
		}

		$this->session->set_userdata([
			'id' => $user->id,
            'username' => $user->username,
            'login' => true,
            'role' => $user->role,
		]);

		    // Redirect berdasarkan role
			switch ($user->role) {
				case 'admin':
				case 'bidang kedaruratan & logistik':
				case 'bidang rehabilitasi & rekontruksi':
					return redirect('/dashboard'); // Halaman Dashboard untuk admin dan bidang terkait
				case 'tim reaksi cepat':
					return redirect('/kaji_cepat'); // Halaman Kaji Cepat
				case 'petugas pengungsian':
					return redirect('/pengungsi'); // Halaman Pengungsi
				case 'tim rekonstruksi':
					return redirect('bangunan_rusak_bencana'); // Halaman Bangunan Rusak
				case 'kepala bidang':
					return redirect('trc'); // Halaman Laporan TRC
				default:
					$this->session->set_flashdata('message', 'You do not have access to the system.');
					return redirect('/');
			}
		}

	function logout() {
		$this->session->sess_destroy();
		return redirect('/');
	}

	function profil() {
		if (!$this->session->userdata('login')) {
            $this->session->set_flashdata('message', 'You must login.');
            return redirect('/');
        }
		$data_ = [
            'title' => 'Profil',
            'user' => $this->db->where('id', $this->session->userdata('id'))->get('users')->row()
        ];
		$this->load->view('template/header', $data_);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('profil');
		$this->load->view('template/footer');
	}

	function update_profil() {
		if (!$this->session->userdata('login')) {
            $this->session->set_flashdata('message', 'You must login.');
            return redirect('/');
        }

		$data_update = [
            'username' => $_POST['username'],
        ];


        $this->db->where('id', $this->session->userdata('id'))->update('users', $data_update);
		$this->session->set_userdata([
            'username' => $_POST['username'],
		]);
        $this->session->set_flashdata([
            'message' => 'Data user berhasil update.',
            'type' => 'success'
        ]);
        redirect('welcome/profil/');
	}
	
	function update_pass() {
		if (!$this->session->userdata('login')) {
            $this->session->set_flashdata('message', 'You must login.');
            return redirect('/');
        }

		if ($_POST['password'] != $_POST['konf_password']) {
			$this->session->set_flashdata([
				'message' => 'Konfirmasi password salah.',
				'type' => 'warning'
			]);
			return redirect('welcome/profil/');
		}

		$data_update = [
            'password' => password_hash($_POST['password'], PASSWORD_BCRYPT)
        ];


        $this->db->where('id', $this->session->userdata('id'))->update('users', $data_update);
        $this->session->set_flashdata([
            'message' => 'Password berhasil update.',
            'type' => 'success'
        ]);
        redirect('welcome/profil/');
	}
}
