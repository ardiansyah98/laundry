<?php
/**
* 
*/
class DbCore extends CI_Model
{
	public function get_data_1param($table,$kolom,$data){
		$this->db->where($kolom,$data);
		return $this->db->get($table);
	}

	public function get_data_2param($table,$kolom1,$data1,$kolom2,$data2){
		$this->db->where($kolom1,$data1);
		$this->db->where($kolom2,$data2);
		return $this->db->get($table);
	}

	public function get_like_data_1param($table,$kolom,$data){
		$this->db->like($kolom,$data);
		return $this->db->get($table);
	}

	public function get_like_data_2param($table,$kolom1,$data1,$kolom2,$data2){
		$this->db->like($kolom1,$data1);
		$this->db->or_like($kolom2,$data2);
		return $this->db->get($table);
	}

	public function get_data_biger($table,$kolom,$data){
		$this->db->order_by("desc",$kolom);
		$this->db->where("$kolom > $data");
		return $this->db->get($table);
	}

	public function get_data_lower($table,$kolom,$data){
		$this->db->order_by("desc",$kolom);
		$this->db->where("$kolom < $data");
		return $this->db->get($table);
	}

	public function get_data_range($table,$kolom1,$kolom2,$data){
		$this->db->order_by($kolom1,"desc");
		$this->db->where("$kolom1 <=", $data);
		$this->db->where("$kolom2 >=" ,$data);
		return $this->db->get($table);
	}

	public function insert_data($table,$data){
		$this->db->insert($table,$data);

	}
	public function insert_get_id($table,$data){
		$this->db->insert($table,$data);
		return $this->db->insert_id();
	}

	public function update_data($table,$kolom,$id,$data){
		$this->db->where($kolom, $id);
		$this->db->update($table,$data);
	}

	public function delete_data($table,$kolom,$id){
		$this->db->where($kolom, $id);
		$this->db->delete($table);
	}





}
?>