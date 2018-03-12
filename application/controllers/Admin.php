<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	function index(){
		if($this->session->userdata('status')!='login'){
			redirect(base_url('index.php/login'));
		} else {

			if($this->session->userdata('level')=='admin'){
				$data['title'] = "KSS Laundry";
				$data['subtitle'] = "Admin";
				$data['view_sidebar'] = "layout/sidebar_admin";
				$data['view_isi'] = "admin/v_home";
				$this->load->view('layout/template',$data);
			} else if($this->session->userdata('level')=='kasir'){
				redirect(base_url('index.php/kasir'));
			}
		}
	}
}
