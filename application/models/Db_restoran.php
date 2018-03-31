<?php
/**
* 
*/
class Db_restoran extends CI_Model
{
	function get_restoran_limit($jumlah){
		$this->db->order_by('rating',"desc");
		$this->db->limit($jumlah);
		return $this->db->get('restoran')->result();
	}
	function get_row_data($jenis,$by,$nama){
		$this->db->where($by,$nama);
		return $this->db->get($jenis)->row(); 
	}
	function get_result_data($jenis,$by,$nama){
		$this->db->where($by,$nama);
		return $this->db->get($jenis)->result(); 
	}
	function get_kategori(){
		return $this->db->get('kategori')->result();
	}
	function get_user($user){
		$this->db->where('user',$user);
		return $this->db->get('akun')->row(); 
	}
	function get_all_data($jenis){
		return $this->db->get($jenis)->result(); 
	}
	function insert_data($jenis,$data){
		$this->db->insert($jenis,$data);
	}
	function get_array_data($jenis,$param,$data){
		$k= $this->db->get($jenis)->result();
		$array = array();
		foreach ($k as $k) {
		 	$array[$k->$param]=$k->$data;
		 }
		 return $array; 
	}
	function jumlah_menu(){
		$res=$this->db->get('restoran')->result();
		$jumlah = array();
		foreach ($res as $r) {
			$jum_menu=$this->db->where('restoran',$r->id_restoran);
			$jumlah[$r->id_restoran]=$this->db->get('menu')->num_rows();
		}
		return $jumlah;

	}
	function delete_data($jenis,$by,$data){
		$this->db->where($by,$data);
		return $this->db->delete($jenis);
	}

	function ubah_data($jenis,$by,$inx,$data){
		$this->db->where($by,$inx);
		$this->db->update($jenis,$data);
	}


}
?>