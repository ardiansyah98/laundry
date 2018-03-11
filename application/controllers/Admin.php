<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	function index(){
		$data['title'] = "KSS Laundry";
		$data['subtitle'] = "Admin";
		$data['view_sidebar'] = "layout/sidebar_admin";
		$data['view_isi'] = "admin/v_home";
		$this->load->view('layout/template',$data);
	}
}
