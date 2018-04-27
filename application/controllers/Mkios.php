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
		if($user->level == 3 || $user->level == 5){
			return $user;
		}else{
			redirect("User/logout");
		}
	}

	function home(){
		$user=$this->check_user();
		$cabang=$this->session->userdata("cabang");
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
			        'color'     => $this->get_random_color(),
			        'highlight' => $this->get_random_color(),
			        'label'    =>  $row->nama
			      );
			$data[]=(object)$item;	
		}
		echo json_encode($data);
	}

	function get_random_color(){
		$color="#";
		for ($i=0; $i <3 ; $i++) { 
			$color .= str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
		}
		return $color;
	}

	function get_data_pegawai(){
		$data=array();
		$pegawai=$this->DbCore->get_data_2param("user","id_cabang","1","level","1")->result();
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
		$user=$this->check_user();
		$cabang=$this->session->userdata("cabang");
		$data = array();
		$year=date("Y-");
		$pemasukan=array();
		// $pengeluaran=array();
		for ($i=1; $i <13 ; $i++) { 
			$bulan=date("Y-m",strtotime($year.$i));
			$transaksi=$this->DbAdmin->get_pemasukan($cabang->id_cabang,"tgl_diterima","'%Y-%m'",$bulan)->result();
			$belanja=$this->DbAdmin->get_pengeluaran($cabang->id_cabang,"tanggal","'%Y-%m'",$bulan)->result();
			$jum_keluar=0;
			$jum_masuk=0;
			foreach ($transaksi as $row) {
				$harga=$row->berat*$row->harga;
				$jum_masuk+=$harga;
			}
			
			foreach ($belanja as $row2) {
				$cum=$row2->jumlah_pengeluaran;
				$jum_keluar+=$cum;
			}
			$pengeluaran[]=$jum_keluar;
			$pemasukan[]=$jum_masuk;
			
		}

		$data['pemasukan']=$pemasukan;
		$data['pengeluaran']=$pengeluaran;

		echo json_encode((object)$data);
	}

	function pengeluaran(){
		$user=$this->check_user();
		$cabang=$this->session->userdata("cabang");
		$this->load->view("kios/pengeluaran");
	}

	function list_pengeluaran(){
		$user=$this->check_user();
		$cabang=$this->session->userdata("cabang");
		
		$filter=$this->input->get("filter");
		if($filter!="all"){
			$year=date("Y-");
			$bulan=date("Y-m",strtotime($year.$filter));

			$data=$this->DbAdmin->get_by_date("pengeluaran",$cabang->id_cabang,"tanggal","'%Y-%M'",$bulan)->result();
			echo json_encode($data);
			// echo $bulan;
		}else{
			$data=$this->DbCore->get_data_1param("pengeluaran","id_cabang",$cabang->id_cabang)->result();
			echo json_encode($data);
		}
		
	}

	function input_pengeluaran(){
		$user=$this->check_user();
		$cabang=$this->session->userdata("cabang");
		$data['nama_pengeluaran']=$this->input->post("pengeluaran");
		$data['tanggal']=$this->input->post("tanggal");
		$data['jumlah_pengeluaran']=$this->input->post("jumlah");
		$data['keterangan']=$this->input->post("keterangan");
		$data['id_cabang']=$cabang->id_cabang;
		$data['id_user']=$user->id_user;
		$this->DbCore->insert_data("pengeluaran",$data);
		echo "<script>alert('data berhasil ditambahkan')</script>";
		redirect("Mkios/pengeluaran");
	}

	function list_akun(){
		$user=$this->check_user();
		$cabang=$this->session->userdata("cabang");
		$index= array('id_cabang' => $cabang->id_cabang,
						'level'=>'1',
						'status'=>'hidup' );
		$list=$this->DbCore->get_data_by_array("user",$index)->result();
		$data['users']=$list;
		$this->load->view("kios/list-akun",$data);
	}

	function tambah_akun(){
		$user=$this->check_user();
		$cabang=$this->session->userdata("cabang");
		$data['username']=$this->input->post("username");
		$data['password']=$this->input->post("password");
		$data['id_cabang']=$cabang->id_cabang;
		$data['level']='1';
		$this->DbCore->insert_data("user",$data);
		redirect("Mkios/list_akun");
	}


	
	


	











}
