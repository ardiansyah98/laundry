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

	// gw lagi males ketemu error jadi data mkios masih statis blm pake session

	function data_bulanan(){
		// $data=$this->DbAdmin->get_bulanan()->num_rows();
		$data = array();
		$year=date("Y-");
		
		for ($i=0; $i <12 ; $i++) { 
			$bulan=date("Y-m",strtotime($year.$i));
			$jumlah=$this->DbAdmin->get_by_date("transaksi","1","tgl_diterima","'%Y-%m'",$bulan)->num_rows();
			$data[]=$jumlah;
		}
		echo json_encode($data);
	}

	function data_jenis_laundry(){
		$data = array();
		// $bulan=date("Y-m");
		$bulan="2018-03";
		$jenis=$this->DbCore->get_data_table("jenis_laundry")->result();
		foreach ($jenis as $row) {
			$jumlah=$this->DbAdmin->get_by_date_kolom("transaksi","1","tgl_diterima","'%Y-%m'",$bulan,"jenis_laundry",$row->id)->num_rows();
			$item=array(
					'value' 	=>$jumlah,
			        'color'     => '#d2d6de',
			        'highlight' => '#d2d6de',
			        'label'    =>  $row->nama
			      );
			$data[]=(object)$item;	
		}
		echo json_encode($data);
	}

	function get_data_pegawai(){
		$data=array();
		$pegawai=$this->DbCore->get_data_1param("user","id_cabang","1")->result();
		foreach ($pegawai as $row) {
			$item=array();
		$item['terima']=$this->DbCore->get_data_2param("transaksi","status_cucian","Diterima","id_user",$row->id_user)->num_rows();
		$item['kasir']=$this->DbCore->get_data_2param("log_transaksi","id_user",$row->id_user,"jenis_update","status_pembayaran")->num_rows();
		$index = array('id_user' =>$row->id_user,
						'jenis_update'=>"status_cucian",
						'status'=>"Distrika" );
		$item['strika']=$this->DbCore->get_data_by_array("log_transaksi",$index)->num_rows();
		$data[$row->username]=(object)$item;
		}
		echo json_encode($data);
	}

	function data_keuangan(){
		$data = array();
		$year=date("Y-");
		$pemasukan=array();
		for ($i=0; $i <12 ; $i++) { 
			$bulan=date("Y-m",strtotime($year.$i));
			$transaksi=$this->DbAdmin->get_pemasukan("1","tgl_diterima","'%Y-%m'",$bulan)->result();
			$jumlah=0;
			foreach ($transaksi as $row) {
				$harga=$row->berat*$row->harga;
				$jumlah+=$harga;
			}
			$pemasukan[]=$jumlah;
		}
		$data['pemasukan']=$pemasukan;
		echo json_encode((object)$data);
	}
	
	
	


	











}
