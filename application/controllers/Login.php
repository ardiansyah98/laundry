<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	public function index()
	{
		$level = $this->session->userdata('level');
		if($this->session->userdata('status')=='login'){
			if($level=='admin')
				redirect(base_url('index.php/admin'));
			else if($level=='kasir')
				redirect(base_url('index.php/kasir'));
			else if($level=='customer')
				redirect(base_url('index.php/customer'));
		} else {
			$this->load->view('v_login');
		}
	}

	//aksi untuk logout
	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url('index.php/login'));
	}

	//aksi ketika button login diklik
	public function aksi_login(){
		$username = $this->input->post("username");
		$password = $this->input->post("password");

		$where = array(
				'username' => $username,
				'password' => md5($password)
			);

		$cek = $this->m_login->cek('user', $where);

		if($cek->num_rows() > 0){

			$get = $cek->result();

			foreach ($get as $g) {
				$level = $g->level;
				$id = $g->id_user;
			}

			$data_session = array(
					'id' => $id,
					'level' => $level,
					'status' => 'login'
				);
			
			$this->session->set_userdata($data_session);

			if($level=="admin"){
				redirect(base_url('index.php/admin'));
			} else if($level=="kasir"){
				redirect(base_url('index.php/kasir'));
			} else if($level=="customer"){
				redirect(base_url('index.php/customer'));
			}

		} else {
			echo "<script>
				alert('Username dan password salah!');
				window.location.href='http://localhost/laundry/index.php/login';
			</script>";
		}
	}
}
