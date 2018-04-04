<?php
/**
* 
*/
class DbWorkshop extends CI_Model
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

}
?>