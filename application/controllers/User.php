<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('DbCore');
		 $this->load->helper('string');
       
	}
	public function index()
	{
		$this->login();
	}
	function login(){
		$user=$this->input->post('user');
			// $pass=md5($this->input->post('pass'));
			$pass=$this->input->post('password');
			
		$this->form_validation->set_rules('user', 'User', 'trim|required', array('required'=>'%s harus diisi'));
		$this->form_validation->set_rules('password', 'Password', 'trim|required', array('required'=>'%s harus diisi'));
		if($this->form_validation->run() == FALSE){
			echo $user.":".$pass;
			echo "<script>alert('error');</script>";
			// printr(validation_errors());
			$this->load->view('login');
		}else{
			$user=$this->input->post('user');
			// $pass=md5($this->input->post('pass'));
			$pass=$this->input->post('password');
			
			$data=$this->DbCore->get_data_2param("user","username",$user,"password",$pass)->row();
			
			if(count($data) != 1){
				echo "<script>alert('akun atau password salah');</script>";
				$this->load->view('login');
			}else{
				$this->session->set_userdata("user",$data);
				// print_r($data);
				$cabang=$this->DbCore->get_data_1param("cabang","id_cabang",$data->id_cabang)->row();
				$this->session->set_userdata("cabang",$cabang);
				switch ($data->level) {
					case '1':
						redirect("Pkios","refresh");
						break;
						case '2':
							redirect('Pwork');
							break;
							case '3':
								redirect('Mkios');
								break;
								case '4':
									redirect("Mwork");
									break;
									case '5':
										redirect("Owner");
										break;
					
					default:
						// $this->logout();
						break;
				}
			}
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect("User/login");
	}			
	

	function detail_restoran(){
		$id=$this->input->get('nama');
		$restoran=$this->db_restoran->get_row_data('restoran','id_restoran',$id);
		$rating=$restoran->rating;
		$star='<span style="float: right;color:#ec3253;" class="fa fa-star"></span>';
		$star2='<span style="float: right;color:#ec3253;" class="fa fa-star-half-o"></span>';
		$star3='<span style="float: right;color:#ec3253;" class="fa fa-star-o "></span>';
		$rat=str_repeat($star3, 5-ceil($rating/2)).str_repeat($star2, $rating%2).str_repeat($star, floor($rating/2));
		// echo "bisa";
		echo ' 
		<div class="well">
            <h3 class="well-header">'.$restoran->nama_restoran.' <small>'.$rat.'</small> </h3>
            <div class="well-body">
            <p>'.$restoran->keterangan.'</p>
            	<button style="float: right;bottom: 5px; margin-top: 10px;" class="btn btn-defult" onclick="close_detail()">Close</button>
            </div>
        </div>
		';
	}
	function menu_restoran(){
		$id=$this->input->get('nama');
		$menu=$this->db_restoran->get_result_data('menu','restoran',$id);
		$html=' ';
		foreach ($menu as $m) {
			$kat='menu-'.$m->kategori;
			$html=$html.'
			<div class="col-xs-6  col-md-4 col-xl-4 list menu '.$kat.'">
			          <figure class="mbr-figure" style="margin-bottom: 10px;">
			               <div class="detail-info" style="background-image: url('.base_url("assets/image/menu/$m->foto").')">
			              </div>
			              <a style="cursor:pointer" data-toggle="modal" data-target="#modal-menu" id="id_menu_'.$m->id_menu.'" onclick="detail_menu(this.id)">
			                <figcaption class="mbr-figure-caption mbr-figure-caption-over ">
			                    <div class="row detail-img">'.$m->nama_menu.'</div>
			                </figcaption>
			              </a>
			          </figure>
			        </div>
			';
		}
		echo $html;
	}
	function kategori_menu(){
		$id=$this->input->get('nama');
		$menu=$this->db_restoran->get_result_data('menu','restoran',$id);
		$k=array();
		$data = array();
		$kategori=$this->db_restoran->get_array_data('kategori','id_kategori','nama_kategori');
		$html='<option class="kategori" value="semua">Semua</option>';
		foreach ($menu as $m) {
			$kat=$m->kategori;
			if(!in_array($kat, $k)){
				$html=$html.'
					<option class="kategori" value="menu-'.$kat.'">'.$kategori[$kat].'</option>
					';
				$data[]=$kat;
			} 
		}
		$send = array('html' =>$html, 'd'=>$data );
		echo  json_encode($send,JSON_PRETTY_PRINT);
	}
	function detail_menu(){
		$id_menu=$this->input->get('id_menu');
		$id=str_replace('id_menu_', '', $id_menu);
		$menu=$this->db_restoran->get_row_data('menu','id_menu',$id);
		$data = array('nama' => $menu->nama_menu,
						'img'=> $menu->foto,
						'keterangan'=> $menu->keterangan );

		echo  json_encode($data,JSON_PRETTY_PRINT);
	}








}
