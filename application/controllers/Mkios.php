<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mkios extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('DbCore');
		$this->load->model('DbKios');
		$this->load->model('DbAdmin');
		 $this->load->helper('string');
       
	}

	public function index()
	{
		$this->home();
	}

	function check_user(){
		$user=$this->session->userdata("user");
		if($user->level == 1 || $user->level == 3){
			return $user;
		}else{
			redirect("User/logout");
		}
	}

	function home(){
		// $user=$this->check_user();
		// $cabang=$this->session->userdata("cabang");
		$this->load->view("kios/home-manager");
	}

	function data_bulanan(){
		// $data=$this->DbAdmin->get_bulanan()->num_rows();
		$data = array();
		$year=date("Y-");
		
		for ($i=0; $i <12 ; $i++) { 
			$bulan=date("Y-m",strtotime($year.$i));
			$jumlah=$this->DbAdmin->get_by_date("transaksi","tgl_diterima","'%Y-%m'",$bulan)->num_rows();
			$data[]=$jumlah;
		}
		echo json_encode($data);
	}

	function data_jenis_laundry(){
		$data = array();
		$year=date("Y-");
	}
	
	
	


	











}
