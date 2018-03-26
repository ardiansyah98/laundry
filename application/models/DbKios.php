<?php
/**
* 
*/
class DbKios extends CI_Model
{
	
	function get_transaksi_join_3table($kolom, $data){
		$this->db->select("*");
		$this->db->where($kolom,$data);
		$this->db->from("transaksi");
		$this->db->join("jenis_laundry","transaksi.jenis_laundry=jenis_laundry.id");
		return $this->db->get();
	}

}
?>