<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir extends CI_Controller {

	function __construct(){
		parent::__construct();
	}
	
	function index(){
		if($this->session->userdata('status')!='login'){
			redirect(base_url('index.php/login'));
		} else {

			if($this->session->userdata('level')=='admin'){
				redirect(base_url('index.php/admin'));
			} else if($this->session->userdata('level')=='kasir'){
				$where = array("id_user" => $this->session->userdata('id'));
				$res = $this->m_login->cek('identitas', $where)->result();

				foreach($res as $r){
					$nama = $r->nama;
				}

				$data['title'] = "KSS Laundry";
				$data['subtitle'] = "Kasir";
				$data['nama'] = $nama;
				$data['view_sidebar'] = "layout/sidebar_kasir";
				$data['view_isi'] = "kasir/v_home";
				$this->load->view('layout/template',$data);
				
			} else if($this->session->userdata('level')=='customer'){
				redirect(base_url('index.php/customer'));
			}

		}
	}

	function transaksi(){
		if($this->session->userdata('status')!='login'){
			redirect(base_url('index.php/login'));
		} else {

			if($this->session->userdata('level')=='admin'){
				redirect(base_url('index.php/admin'));
			} else if($this->session->userdata('level')=='kasir'){
				$where = array("id_user" => $this->session->userdata('id'));
				$res = $this->m_login->cek('identitas', $where)->result();

				foreach($res as $r){
					$nama = $r->nama;
				}

				$data['title'] = "KSS Laundry";
				$data['subtitle'] = "Kasir";
				$data['nama'] = $nama;
				$data['view_sidebar'] = "layout/sidebar_kasir";
				$data['view_isi'] = "kasir/v_transaksi";
				
				
				$this->load->view('layout/template',$data);
			} else if($this->session->userdata('level')=='customer'){
				redirect(base_url('index.php/customer'));
			}

		}

	}

	function ajax_list(){
		$list = $this->m_kasir->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $trans) {
			$no++;
			$row = array();

			$row[] = $no;
			$row[] = $trans->kode_transaksi;

			$get1 = $this->m_login->cek('identitas', array('id_user' => $trans->id_customer))->result();

			foreach ($get1 as $x) {
				$nama = $x->nama;
			}
			
			$row[] = $nama;

			$row[] = $trans->nama_paket;
			$row[] = $trans->harga_paket;
			$row[] = $trans->berat;
			$row[] = $trans->diskon;

			$get2 = $this->m_login->cek('identitas', array('id_user' => $trans->id_kasir))->result();

			foreach ($get2 as $x) {
				$nama = $x->nama;
			}

			$row[] = $nama;

			$get3 = $this->m_login->cek('cabang', array('id_cabang' => $trans->id_cabang))->result();

			foreach ($get3 as $x) {
				$cabang = $x->alamat;
			}

			$row[] = $cabang;

			$status_cucian = $trans->status_cucian;
			if($status_cucian=='Diterima')
				$status = '<span style="width:75px" class="label label-default">Diterima</span>';
			else if($status_cucian=="Proses")
				$status = '<span style="width:75px" class="label label-primary">Proses</span>';
			else if($status_cucian=="Selesai")
				$status = '<span style="width:75px" class="label label-warning">Selesai</span>';
			else if($status_cucian=="Diambil")
				$status = '<span style="width:75px" class="label label-success">Diambil</span>';

			$row[] = $status;
			$row[] = $trans->tgl_diterima;
			$row[] = $trans->tgl_diambil;

			$status_pembayaran = $trans->status_pembayaran;
			if($status_pembayaran=='Belum')
				$status = '<span style="width:75px" class="label label-danger">Belum</span>';
			else if($status_pembayaran=='Sudah') 
				$status = '<span style="width:75px" class="label label-success">Sudah</span>';
			
			$row[] = $status;
			$row[] = $trans->tgl_bayar;
			$row[] = $trans->harga_paket*$trans->berat-$trans->diskon;


			//add html for action

			if($status_pembayaran=="Sudah" && $status_cucian=="Diambil"){
				$row[] = '<span class="label label-danger">Complete</span>';
			} else if($status_pembayaran=="Sudah" && $status_cucian!="Diambil"){
				$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit Status Cucian" onclick="edit_status_cucian('."'".$trans->kode_transaksi."'".')"><i class="glyphicon glyphicon-pencil"></i> Status Cucian</a>';
			} else if($status_pembayaran!="Sudah" && $status_cucian=="Diambil"){
				$row[] = '<a class="btn btn-sm btn-success" href="javascript:void(0)" title="Edit Status Pembayaran" onclick="edit_status_pembayaran('."'".$trans->kode_transaksi."'".')"><i class="glyphicon glyphicon-pencil"></i> Status Pembayaran</a>';
			} else {
				$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit Status Cucian" onclick="edit_status_cucian('."'".$trans->kode_transaksi."'".')"><i class="glyphicon glyphicon-pencil"></i> Status Cucian</a>
				  <a class="btn btn-sm btn-success" href="javascript:void(0)" title="Edit Status Pembayaran" onclick="edit_status_pembayaran('."'".$trans->kode_transaksi."'".')"><i class="glyphicon glyphicon-pencil"></i> Status Pembayaran</a>';
			}

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->m_kasir->count_all(),
						"recordsFiltered" => $this->m_kasir->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($kode_transaksi)
	{
		$data = $this->m_kasir->get_by_kode($kode_transaksi);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$data = array(
				'firstName' => $this->input->post('firstName'),
				'lastName' => $this->input->post('lastName'),
				'gender' => $this->input->post('gender'),
				'address' => $this->input->post('address'),
				'dob' => $this->input->post('dob'),
			);
		$insert = $this->m_kasir->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update_cucian()
	{
		$data = array(
				'status_cucian' => $this->input->post('status_cucian')
			);
		$where = array(
			'kode_transaksi' => $this->input->post('kode_transaksi')
		);

		if($this->input->post('status_cucian')=="Diambil"){
			date_default_timezone_set("Asia/Jakarta");
			$now = date('Y-m-d H:i:s');

			$this->m_kasir->update($where, array("tgl_diambil" => $now));
		}

		$this->m_kasir->update($where, $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update_pembayaran()
	{
		$data = array(
				'status_pembayaran' => $this->input->post('status_pembayaran')
			);
		

		$where = array(
			'kode_transaksi' => $this->input->post('kode_transaksi')
		);

		if($this->input->post('status_pembayaran')=="Sudah"){
			date_default_timezone_set("Asia/Jakarta");
			$now = date('Y-m-d H:i:s');

			$this->m_kasir->update($where, array("tgl_bayar" => $now));
		}

		$this->m_kasir->update($where, $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($kode_transaksi)
	{
		$this->m_kasir->delete_by_kode($kode_transaksi);
		echo json_encode(array("status" => TRUE));
	}
}
