<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model {
	
	function cek($tableName, $where){
		return $this->db->get_where($tableName, $where);
	}
}
