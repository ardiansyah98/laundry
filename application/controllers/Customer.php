<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

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
				redirect(base_url('index.php/kasir'));
			} else if($this->session->userdata('level')=='customer'){
				$data['title'] = "KSS Laundry";
				$data['subtitle'] = "Customer";
				$data['view_sidebar'] = "layout/sidebar_customer";
				$data['view_isi'] = "customer/v_home";
				$this->load->view('layout/template',$data);
			}		
		}
	}
}
