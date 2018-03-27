<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pkios extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('DbCore');
		$this->load->model('DbKios');
		 $this->load->helper('string');
       
	}

	public function index()
	{
		$this->input_transaksi();
	}

	function check_user(){
		$user=$this->session->userdata("user");
		if($user->level == 1){
			return $user;
		}else{
			redirect("User/logout");
		}
	}

	function home(){
		$user=$this->check_user();
		$cabang=$this->session->userdata("cabang");
		$this->load->view("tes");
	}
	
	function input_transaksi(){

		$user=$this->check_user();
		$cabang=$this->session->userdata("cabang");

		$this->form_validation->set_rules('nama_pelanggan', 'Nama', 'trim|required', array('required'=>'%s harus diisi'));
		$this->form_validation->set_rules('tlp', 'No Telpon', 'trim|required', array('required'=>'%s harus diisi'));
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required', array('required'=>'%s harus diisi'));

		$pilihan_cucian=$this->DbCore->get_data_1param("jenis_laundry","status","1")->result();
		$send_to_view["pilihan_cucian"]=$pilihan_cucian;

		if($this->form_validation->run() == FALSE){
			$this->load->view("kios/form-transaksi",$send_to_view);
		}else{
			$nama=$this->input->post("nama_pelanggan");
			$tlp=$this->input->post("tlp");
			$tanggal=$this->input->post("tanggal");
			$jenis_cucian=$this->input->post("jenis_cucian");
			$jumlah_cucian=$this->input->post("jumlah_cucian");
			$kode_paket=$this->generate_kode_paket($nama);

			$data_paket=array("nama_pelanggan"=>$nama,
						"kode_paket" => $kode_paket,
						"tgl_masuk"=>$tanggal,
						"tlp_pelanggan"=>$tlp);
			$id_paket=$this->DbCore->insert_get_id("paket",$data_paket);
			$total_harga=0;
			for ($i=0; $i <count($jenis_cucian); $i++) { 
				$data_transaksi["id_paket"]=$id_paket;
				$data_transaksi["berat"]=$jumlah_cucian[$i];
				$data_transaksi["id_user"]=$user->id_user;
				$data_transaksi["id_cabang"]=$cabang->id_cabang;
				$data_transaksi["status_cucian"]="Diterima";
				$data_transaksi["tgl_diterima"]=$tanggal;
				$data_transaksi["status_pembayaran"]="Belum";

				$data_jenis_cucian=$this->DbCore->get_data_1param("jenis_laundry","nama",$jenis_cucian[$i])->row();
				$data_transaksi["jenis_laundry"]=$data_jenis_cucian->id;


				//check diskon
				$sub_harga=$data_jenis_cucian->harga*$jumlah_cucian[$i];
				// $total_harga+=$sub_harga;
				$diskon=$this->check_diskon($data_transaksi,$sub_harga);
				$sub_harga=$sub_harga-$diskon[1];
				$total_harga += $sub_harga;
				$data_transaksi["diskon"]=$diskon[0];

				$this->DbCore->insert_data("transaksi",$data_transaksi);
			}
			$update_harga["harga"]=$total_harga;
			$this->DbCore->update_data("paket","id_paket",$id_paket,$update_harga);
			redirect("Pkios/transaksi/$id_paket","refresh");		
		}
	}

	function generate_kode_paket($nama){
		$cabang=$this->session->userdata("cabang");
		$time=date("ymjs");
		$cab=$cabang->kode_cabang;
		$kode=$cab.$time.substr($nama,4);
		return $kode;
	}

	function check_diskon($data,$sub_harga){
		$diskon=array("0",0);
		$list_diskon=$this->DbCore->get_data_range("diskon","awal_diskon","akhir_diskon",$data["tgl_diterima"])->result();
		
		foreach ($list_diskon as $row) {
			$syarat=explode("/", $row->syarat);
			$kondisi=explode("/", $row->kondisi);
			$lolos=0;
			foreach ($syarat as $sy) {
				if(in_array($data[$sy], $kondisi)){
					$lolos++;
				}
			}
			if($lolos>=count($syarat)){
				$diskon[0]=$row->id_diskon;
				$operasi=explode("/", $row->potongan_diskon);
				if($operasi[0]=="persen"){
					$diskon[1]=$sub_harga*($operasi[1]/100);
				}elseif ($operasi[0]=="potong") {
					$diskon[1]=$operasi[1];
				}
				return $diskon;
				break;
			}
		}
		return $diskon;		
	}


	function set_log_transaksi($jenis,$status,$id_transaksi){
		$user=$this->check_user();
		$data_log["id_transaksi"]=$id_transaksi;
		$data_log["jenis_update"]=$jenis;
		$data_log["status"]=$status;
		$data_log["id_user"]=$user->id_user;
		$this->DbCore->insert_data("log_transaksi",$data_log);

	}

	function transaksi($id_paket){
		$user=$this->check_user();
		$cabang=$this->session->userdata("cabang");

		$paket=$this->DbCore->get_data_1param("paket","id_paket",$id_paket)->row();
		$cucian=$this->DbKios->get_transaksi_join_3table("id_paket",$id_paket)->result();
		$list_cucian=array();
		$sudah_dibayar=0;
		foreach ($cucian as $row) {
			$sub_harga=$row->harga*$row->berat;
			if($row->diskon != 0){
				$diskon=$this->check_diskon((array)$row,$sub_harga);
				$row->jumlah_diskon=$diskon[1];
				$row->jumlah_harga=$sub_harga-$diskon[1];
			}else{
				$row->jumlah_diskon=0;
				$row->jumlah_harga=$sub_harga;
			}
			$list_cucian[]=$row;
			if($row->status_pembayaran=="Sudah"){
				$sudah_dibayar+=$sub_harga;
			}

		}
		$paket->sudah_dibayar=$sudah_dibayar;
		$send_to_view["paket"]=$paket;
		$send_to_view["cucian"]=$list_cucian;
		$send_to_view["user"]=$user;
		$this->load->view("kios/bon-transaksi",$send_to_view);
	}


	//set pembayaran single/all
	function pembayaran_transaksi($index){
		$jenis=explode("-", $index);
		$tanggal=date("Y-m-d");
		if($jenis[0]=="single"){
			$update["status_pembayaran"]="Sudah";
			$this->DbCore->update_data("transaksi","id_transaksi",$jenis[1],$update);
			$this->set_log_transaksi("status_pembayaran","Sudah",$jenis[1]);
			$transaksi=$this->DbCore->get_data_1param("transaksi","id_transaksi",$jenis[1])->row();
			$paket=$this->DbCore->get_data_1param("paket","id_paket",$jenis[1])->row();
		}elseif($jenis[0]=="all"){
			$paket=$this->DbCore->get_data_1param("paket","kode_paket",$jenis[1])->row();
			$transaksi=$this->DbCore->get_data_1param("transaksi","id_paket",$paket->id_paket)->result();
			foreach ($transaksi as $row) {
				if($row->status_pembayaran=="Belum"){
					$update["status_pembayaran"]="Sudah";
					$this->DbCore->update_data("transaksi","id_transaksi",$row->id_transaksi,$update);
					$this->set_log_transaksi("status_pembayaran","Sudah",$row->id_transaksi);
				}
			}
		}
		$update_paket_pembayaran["status_pembayaran_paket"]="Sudah";
		$this->update_paket_by_chcek_transaksi($paket->id_paket,"status_pembayaran","Sudah",$update_paket_pembayaran);

		redirect("Pkios/transaksi/$paket->id_paket");
	}

	// buat ngchek udah bayar/ambil semua di transaksi, kalo udah di upload sudah di table paket
	//(id paket, kolom yg bakal di check, status kolomnya, updatannya)
	function update_paket_by_chcek_transaksi($id_paket,$kolom,$status,$update){
		$transaksi=$this->DbCore->get_data_1param("transaksi","id_paket",$id_paket)->result();
		$jumlah_true=0;
		foreach ($transaksi as $row) {
			if($row->$kolom==$status){
				$jumlah_true++;
			}
		}
		$this->DbCore->update_data("paket","id_paket",$id_paket,$update);
	}



	function ambil_transaksi($index){

	}


	function list_transaksi(){
		$user=$this->check_user();
		$cabang=$this->session->userdata("cabang");
		$this->load->view("kios/list-transaksi");
	}

	function ajax_list(){
		$list = $this->DbKios->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $trans) {
			$no++;
			$row = array();

			$row[] = $no;
			$row[] = $trans->id_transaksi;
			$row[] = $trans->id_paket;
			$row[] = $trans->jenis_laundry;
			$row[] = $trans->berat;
			$row[] = $trans->diskon;
			$row[] = $trans->id_user;
			$row[] = $trans->id_cabang;
			$row[] = $trans->status_cucian;
			$row[] = $trans->tgl_diterima;
			$row[] = $trans->tgl_diambil;
			$row[] = $trans->status_pembayaran;
			$row[] = $trans->tgl_bayar;
			$row[] = $trans->keterangan;

			

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->DbKios->count_all(),
						"recordsFiltered" => $this->DbKios->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
}
