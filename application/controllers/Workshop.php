<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Workshop extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('DbCore');
		$this->load->model('DbWorkshop');
		 $this->load->helper('string');
       
	}

	public function index()
	{
		$this->home();
	}

	function check_user(){
		$user=$this->session->userdata("user");
		if($user->level == 2 || $user->level == 4){
			return $user;
		}else{
			redirect("User/logout");
		}
	}

	function home(){
		$user=$this->check_user();
		$cabang=$this->session->userdata("cabang");
		$this->load->view("workshop/home");
	}
	function selesai_cuci(){
		$user=$this->check_user();
		$cabang=$this->session->userdata("cabang");
		$this->load->view("workshop/selesai_cuci");
	}
	function ready(){
		$user=$this->check_user();
		$cabang=$this->session->userdata("cabang");
		$this->load->view("workshop/ready");
	}

	function spesial_list($jenis){
		$user=$this->check_user();
		$cabang=$this->session->userdata("cabang");
		$index=explode("=", $jenis);
		// $laundry=$this->DbCore->get_data_1param("jenis_laundry","nama",$jenis)->row();
		$data=$this->DbWorkshop->get_prioritas($index[1],$cabang->id_cabang,$index[0])->result();
		$list=array();
		foreach ($data as $no => $row) {
			$row->no=$no+1;
			$list[]=(array)$row;
		}
		echo json_encode($list,JSON_PRETTY_PRINT);
	}

	function semua_kecuali($jenis){
		$user=$this->check_user();
		$cabang=$this->session->userdata("cabang");
		$index=explode("=", $jenis);
		$kecuali=explode("-", $index[1]);
		$data=$this->DbWorkshop->get_semua($cabang->id_cabang,$index[0])->result();
		$list=array();
		foreach ($data as $no => $row) {
			if(!in_array($row->jenis_laundry, $kecuali)){
				$row->no=$no+1;
				$list[]=(array)$row;
			}
			
		}
		echo json_encode($list,JSON_PRETTY_PRINT);
	}


	function set_dicuci($id){
		$user=$this->check_user();
		$cabang=$this->session->userdata("cabang");
		$update["status_cucian"]="Proses";
		$this->DbCore->update_data("transaksi","id_transaksi",$id,$update);
		$this->set_log_transaksi("status_cucian","Proses",$id);
	}

	function set_selesai($id){
		$user=$this->check_user();
		$cabang=$this->session->userdata("cabang");
		$update["status_cucian"]="Selesai";
		$this->DbCore->update_data("transaksi","id_transaksi",$id,$update);
		$this->set_log_transaksi("status_cucian","Selesai",$id);
	}

	function jumlah_cucian(){
		$cabang=$this->session->userdata("cabang");
		$cuci=$this->DbWorkshop->get_transaksi_paket("status_cucian","Proses","paket.id_cabang",$cabang->id_cabang)->num_rows();
		$nunggu=$this->DbWorkshop->get_transaksi_paket("status_cucian","Diterima","paket.id_cabang",$cabang->id_cabang)->num_rows();
		$selesai=$this->DbWorkshop->get_transaksi_paket("status_cucian","Selesai","paket.id_cabang",$cabang->id_cabang)->num_rows();
		$data["cucian"]=$nunggu;
		$data["proses"]=$cuci;
		$data["selesai"]=$selesai;
		echo json_encode($data);
	}


	function set_log_transaksi($jenis,$status,$id_transaksi){
		$user=$this->check_user();
		$data_log["id_transaksi"]=$id_transaksi;
		$data_log["jenis_update"]=$jenis;
		$data_log["status"]=$status;
		$data_log["id_user"]=$user->id_user;
		$this->DbCore->insert_data("log_transaksi",$data_log);

	}

	function test(){
		$data=$this->DbWorkshop->get_prioritas("3","1")->result();
		echo count($data)."<br>";
		print_r($data);
	}

	


	

	


	











}
