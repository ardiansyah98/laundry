<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('DbCore');
		 $this->load->helper('string');
       
	}
	public function index()
	{
		$this->login();
	}
	function login(){
		$user=$this->input->post('user');
			// $pass=md5($this->input->post('pass'));
			$pass=$this->input->post('password');
			
		$this->form_validation->set_rules('user', 'User', 'trim|required', array('required'=>'%s harus diisi'));
		$this->form_validation->set_rules('password', 'Password', 'trim|required', array('required'=>'%s harus diisi'));
		if($this->form_validation->run() == FALSE){
			echo $user.":".$pass;
			// echo "<script>alert('error');</script>";
			// printr(validation_errors());
			$this->load->view('login');
		}else{
			$user=$this->input->post('user');
			// $pass=md5($this->input->post('pass'));
			$pass=$this->input->post('password');
			
			$data=$this->DbCore->get_data_2param("user","username",$user,"password",$pass)->row();
			
			if($data == null){
				echo "<script>alert('akun atau password salah');</script>";
				$this->load->view('login');
			}else{
				$this->session->set_userdata("user",$data);
				// print_r($data);
				$cabang=$this->DbCore->get_data_1param("cabang","id_cabang",$data->id_cabang)->row();
				$this->session->set_userdata("cabang",$cabang);
				switch ($data->level) {
					case 1:
						redirect("Kios","refresh");
						break;
						case 2:
							redirect('Workshop');
							break;
							case 3:
								redirect('Mkios');
								break;
								case 4:
									redirect("Mwork");
									break;
									case 5:
										redirect("Owner");
										break;
					
					default:
						$this->logout();
						break;
				}
			}
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect("User/login");
	}			
	
	function check_user(){
		$user=$this->input->get("username");
		$data=$this->DbCore->get_data_1param("user","username",$user)->num_rows();
		if($data>=1){
			echo "true";
		}else{
			echo "false";
		}

	}







}
