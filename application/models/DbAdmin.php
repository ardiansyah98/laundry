<?php
/**
* 
*/
class DbAdmin extends CI_Model
{
	
	function get_prioritas($jenis_laundry,$id_cabang,$status){
		$this->db->where("jenis_laundry",$jenis_laundry);
		$this->db->where("status_cucian",$status);
		$this->db->order_by("tgl_diterima","asc");
		$this->db->select("*");
		$this->db->from("transaksi");
		$this->db->join("paket","transaksi.id_paket=paket.id_paket");
		$this->db->where("paket.id_cabang",$id_cabang);
		return $this->db->get();
	}

	function get_semua($id_cabang,$status){
		$this->db->where("status_cucian",$status);
		$this->db->select("*");
		$this->db->from("transaksi");
		$this->db->join("paket","transaksi.id_paket=paket.id_paket");
		$this->db->where("paket.id_cabang",$id_cabang);
		$this->db->order_by("tgl_diterima","asc");
		$this->db->join("jenis_laundry","transaksi.jenis_laundry=jenis_laundry.id");
		$this->db->join("cabang","transaksi.id_cabang=cabang.id_cabang");
		return $this->db->get();
	}

	function get_transaksi_paket($kolomtb1,$datatb1,$kolomtb2,$datatb2){
		$this->db->select("*");
		$this->db->where($kolomtb1,$datatb1);
		$this->db->from("transaksi");
		$this->db->join("paket","transaksi.id_paket=paket.id_paket");
		$this->db->where($kolomtb2,$datatb2);
		return $this->db->get();
	}

	function get_bulanan(){
		$this->db->where("DATE_FORMAT(tgl_diterima,'%Y-%m')", "2018-3");
		return $this->db->get("transaksi");

	}

	function get_by_date($table,$cabang,$kolom,$format,$data){
		$this->db->where("id_cabang",$cabang);
		$this->db->where("DATE_FORMAT($kolom,$format)", "$data");
		return $this->db->get($table);
	}

	function get_by_date_kolom($table,$cabang,$kolom,$format,$data,$kolom2,$data2){
		$this->db->where("id_cabang",$cabang);
		$this->db->where("DATE_FORMAT($kolom,$format)", "$data");
		$this->db->where($kolom2,$data2);
		return $this->db->get($table);
	}

	function get_pemasukan($cabang,$kolom,$format,$data){
		$this->db->where("id_cabang",$cabang);
		$this->db->where("DATE_FORMAT($kolom,$format)", "$data");
		$this->db->select("*");
		$this->db->from("transaksi");
		$this->db->join("jenis_laundry","transaksi.jenis_laundry=jenis_laundry.id");
		return $this->db->get();
	}
	function get_pengeluaran($cabang,$kolom,$format,$data){
		$this->db->where("id_cabang",$cabang);
		$this->db->where("DATE_FORMAT($kolom,$format)", "$data");
		return $this->db->get("pengeluaran");
	}



}
?>