<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	function index(){
		$data['title'] = "KSS Laundry";
		$data['subtitle'] = "Kasir";
		$data['view_sidebar'] = "layout/sidebar_kasir";
		$data['view_isi'] = "kasir/v_home";
		$this->load->view('layout/template',$data);
	}
}
