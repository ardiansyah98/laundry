<?php
defined('BASEPATH') OR exit('No direct script access allowed');


	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('db_restoran');
		 $this->load->helper('string');
        $this->load->helper('file');
        $this->load->helper('download');
        $this->load->library('upload');
        // $this->load->helper('session');
	}
	public function index()
	{
		$this->login();
	}

	function login(){
		$this->form_validation->set_rules('user', 'User', 'trim|required', array('required'=>'%s harus diisi'));
		$this->form_validation->set_rules('pass', 'Password', 'trim|required', array('required'=>'%s harus diisi'));
		if($this->form_validation->run() == FALSE){
			$this->load->view('login');
		}else{
			$user=$this->input->post('user');
			$pass=md5($this->input->post('pass'));
			$akun=$this->db_restoran->get_user($user);
			if(!$akun || $akun->pass!=$pass){
				echo "<script>alert('akun atau password salah');</script>";
				$this->load->view('login');
			}else{
				$this->session->set_userdata('user',$user);
                redirect('Admin/home');
			}			
		}
	}
	function logout(){
		$this->session->unset_userdata('user');
		$this->load->view('login');
	}

	function cek_online(){
		$user=$this->session->userdata('user');
		if(!$user)
			redirect('Admin/logout');
		else
			return $user;
	}

	function home(){
		$user=$this->cek_online();
		$send['restoran']=$this->db_restoran->get_all_data('restoran');
		$send['kategori']=$this->db_restoran->get_all_data('kategori');
		$send['menu']=$this->db_restoran->get_all_data('menu');
		$send['kat']=$this->db_restoran->get_array_data('kategori','id_kategori','nama_kategori');
		$send['res']=$this->db_restoran->get_array_data('restoran','id_restoran','nama_restoran');
		$send['jum_menu']=$this->db_restoran->jumlah_menu();
		$send['error_restoran']='';
		$send['error_menu']='';
		$this->load->view('admin/home',$send);
	}

	function tambah_restoran(){
		$user=$this->cek_online();
		$send['restoran']=$this->db_restoran->get_all_data('restoran');
		$send['kategori']=$this->db_restoran->get_all_data('kategori');
		$send['kat']=$this->db_restoran->get_array_data('kategori','id_kategori','nama_kategori');
		$send['res']=$this->db_restoran->get_array_data('restoran','id_restoran','nama_restoran');
		$send['menu']=$this->db_restoran->get_all_data('menu');
		$send['error_restoran']='';
		$send['error_menu']='';

		$this->form_validation->set_rules('id_restoran', 'Id restoran', 'trim|required', array('required'=>'%s harus diisi'));
        $this->form_validation->set_rules('nama_restoran', 'Nama Restoran', 'trim|required', array('required'=>'%s harus diisi'));
        $this->form_validation->set_rules('kategori_restoran');
        $this->form_validation->set_rules('rating', 'Rating', 'trim|required', array('required'=>'%s harus diisi'));
        $this->form_validation->set_rules('keterangan_restoran', 'Keterangan', 'trim|required', array('required'=>'%s harus diisi'));

        if ($this->form_validation->run()==false) {
        	// $send['form_error']=form_errors();
            $this->load->view('admin/home',$send);
        }else{
        	$id=$this->input->post('id_restoran');
        	$check=$this->db_restoran->get_row_data('restoran','id_restoran',$id);
        	if(!$check){
	            $nama=$this->input->post('nama_restoran');
	            $kategori=$this->input->post('kategori_restoran');
	            $rating=$this->input->post('rating')*2;
	            $keterangan=$this->input->post('keterangan_restoran');

	            $config['upload_path']          = './assets/image/restoran/';
	            $config['allowed_types']        = 'gif|jpg|png';
	            $config['max_size']             = 1000;
	            $config['max_width']            = 1024;
	            $config['max_height']           = 768;
	            $config['file_name']            = str_replace(' ', '_', $nama);
	            $this->upload->initialize($config);

	            if (!$this->upload->do_upload('foto_restoran')){
	                        $send['error_restoran'] =  $this->upload->display_errors();
	                        $this->load->view('admin/home',$send);

	                }else{
	                        $file=$this->upload->data('file_name');


	                        $data = array('id_restoran'=>$id,
	                        				'nama_restoran' => $nama,
	                                        'kategori'=>$kategori,
	                                        'rating'=>$rating,
	                                        'keterangan'=>$keterangan,
	                                        'foto'=>$file
	                                        );
	                         $this->db_restoran->insert_data('restoran',$data);
	                         redirect('Admin/home/');   
	                }
	        }else{
	        	echo "<script>alert('Id Sudah Ada, Tolong Masukan Id yang Berbeda');</script>";
	        	redirect('Admin/home/');
	        }         
        }
	}

function tambah_menu(){
		$user=$this->cek_online();
		$send['restoran']=$this->db_restoran->get_all_data('restoran');
		$send['kategori']=$this->db_restoran->get_all_data('kategori');
		$send['kat']=$this->db_restoran->get_array_data('kategori','id_kategori','nama_kategori');
		$send['res']=$this->db_restoran->get_array_data('restoran','id_restoran','nama_restoran');
		$send['menu']=$this->db_restoran->get_all_data('menu');
		$send['error_menu']='';
		$send['error_restoran']='';
		$this->form_validation->set_rules('id_menu', 'Id Menu', 'trim|required', array('required'=>'%s harus diisi'));
        $this->form_validation->set_rules('nama_menu', 'Nama Menu', 'trim|required', array('required'=>'%s harus diisi'));
        $this->form_validation->set_rules('keterangan_menu', 'Keterangan', 'trim|required', array('required'=>'%s harus diisi'));

        if ($this->form_validation->run()==false) {
        	// $send['form_error']=form_errors();
            $this->load->view('admin/home',$send);
        }else{
        	$id=$this->input->post('id_menu');
        	$check=$this->db_restoran->get_row_data('menu','id_menu',$id);
        	if(!$check){
	            $nama=$this->input->post('nama_menu');
	            $kategori=$this->input->post('kategori_menu');
	            $restoran=$this->input->post('restoran_menu');
	            $keterangan=$this->input->post('keterangan_menu');

	            $config['upload_path']          = './assets/image/menu/';
	            $config['allowed_types']        = 'gif|jpg|png';
	            $config['max_size']             = 1000;
	            $config['max_width']            = 1024;
	            $config['max_height']           = 768;
	            $config['file_name']            = str_replace(' ', '_', $nama).'_'.str_replace(' ', '_', $restoran);
	            $this->upload->initialize($config);

	            if (!$this->upload->do_upload('foto_menu')){
	                        $send['error_menu'] =  $this->upload->display_errors();
	                        $this->load->view('admin/home',$send);

	                }else{
	                        $file=$this->upload->data('file_name');
	                        $data = array('id_menu'=>$id,
	                        				'nama_menu' => $nama,
	                                        'kategori'=>$kategori,
	                                        'restoran'=>$restoran,
	                                        'keterangan'=>$keterangan,
	                                        'foto'=>$file
	                                        );
	                         $this->db_restoran->insert_data('menu',$data); 
	                         redirect('Admin/home/');  
	                    
	                }
	        }else{
	        	echo "<script>alert('Id Sudah Ada, Tolong Masukan Id yang Berbeda');</script>";
	        	redirect('Admin/home/');
	        }        
        }
	}

	function tambah_kategori(){
		$user=$this->cek_online();
		$send['restoran']=$this->db_restoran->get_all_data('restoran');
		$send['kategori']=$this->db_restoran->get_all_data('kategori');
		$send['kat']=$this->db_restoran->get_array_data('kategori','id_kategori','nama_kategori');
		$send['res']=$this->db_restoran->get_array_data('restoran','id_restoran','nama_restoran');
		$send['menu']=$this->db_restoran->get_all_data('menu');
		$send['error_menu']='';
		$send['error_restoran']='';
        $this->form_validation->set_rules('id_kategori', 'Nama Restoran', 'trim|required', array('required'=>'%s harus diisi'));
        $this->form_validation->set_rules('nama_kategori', 'Keterangan', 'trim|required', array('required'=>'%s harus diisi'));

        if ($this->form_validation->run()==false) {
        	// $send['form_error']=form_errors();
            $this->load->view('admin/home',$send);
        }else{
        	$id=$this->input->post('id_kategori');
        	$check=$this->db_restoran->get_row_data('kategori','id_kategori',$id);
        	if(!$check){
		        $nama=$this->input->post('nama_kategori');
		        $data = array('id_kategori' => $id,
		                        'nama_kategori'=>$nama
		                        );
		         $this->db_restoran->insert_data('kategori',$data);
		    }else{
		    	echo "<script>alert('Id Sudah Ada, Tolong Masukan Id yang Berbeda');</script>";
	        	
		    }
		    redirect('Admin/home/');
		}     
	}

	function hapus_restoran(){
		$user=$this->cek_online();
		$id=$this->input->post('hapus_id_restoran');
        $jenis=$this->input->post('pilihan_hapus_restoran');
        $this->db_restoran->delete_data('restoran','id_restoran',$id);
        if($jenis=='allmenu'){
        	$menu=$this->db_restoran->get_result_data('menu','restoran',$id);
        	foreach ($menu as $m) {
        		$this->db_restoran->delete_data('menu','id_menu',$m->id_menu);
        	}
        }
        redirect('Admin/home/');
	}

	function hapus_menu(){
		$user=$this->cek_online();
		$id=$this->input->post('hapus_id_menu');
        $this->db_restoran->delete_data('menu','id_menu',$id);
        redirect('Admin/home/');
	}
	function edit_kategori(){
		$user=$this->cek_online();
		$id=$this->input->post('edit_id_kategori');
		$data=$this->db_restoran->get_row_data('kategori','id_kategori',$id);
		$kat=($this->input->post('edit_nama_kategori')!='')?$this->input->post('edit_nama_kategori'):$data->nama_kategori;
		$ubah=array('nama_kategori'=>$kat);
        $this->db_restoran->ubah_data('kategori','id_kategori',$id,$ubah);  
        redirect('Admin/home/');
	}

	function ubah_restoran(){
		$user=$this->cek_online();
		$id=$this->input->post('edit_id_restoran');
		$nama_input=$this->input->post('edit_nama_restoran');
		$kategori_input=$this->input->post('edit_kategori_restoran');
		$rat_input=$this->input->post('edit_rating');
		$ket_input=$this->input->post('edit_keterangan_restoran');
		$data=$this->db_restoran->get_row_data('restoran','id_restoran',$id);

		$ubah['nama_restoran']=($nama_input != '')?$this->input->post('edit_nama_restoran'):$data->nama_restoran;
		$ubah['kategori']=($kategori_input!='')?$this->input->post('edit_kategori_restoran'):$data->kategori;
		$ubah['rating']=($rat_input!='')?$this->input->post('edit_rating')*2:$data->rating;
		$ubah['keterangan']=($ket_input!='')?$this->input->post('edit_keterangan_restoran'):$data->keterangan;
		
		$foto=$this->input->post('ubah_restoran');
		if($foto=='ubah'){
			$config['upload_path']          = './assets/image/restoran/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1000;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;
            $config['file_name']            = str_replace(' ', '_', $nama).'_'.str_replace(' ', '_', $restoran);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('edit_foto_restoran')){
            			echo "<script>alert(".$this->upload->display_errors().");</script>";
                       redirect('Admin/home/');
                }else{
                        $file=$this->upload->data('file_name');
                        $ubah['foto']=$file;
                         $this->db_restoran->ubah_data('restoran','id_restoran',$id,$ubah);  
                } 
		}else{

			$this->db_restoran->ubah_data('restoran','id_restoran',$id,$ubah);  
		}
		redirect('Admin/home/');
	}

	function ubah_menu(){
		$user=$this->cek_online();
		$id=$this->input->post('edit_id_menu');
		$nama_input=$this->input->post('edit_nama_menu');
		$kategori_input=$this->input->post('edit_kategori_menu');
		$res_input=$this->input->post('edit_restoran_menu');
		$ket_input=$this->input->post('edit_keterangan_menu');
		$data=$this->db_restoran->get_row_data('menu','id_menu',$id);

		$ubah['nama_menu']=($nama_input != '')?$this->input->post('edit_nama_menu'):$data->nama_menu;
		$ubah['kategori']=($kategori_input!='')?$this->input->post('edit_kategori_menu'):$data->kategori;
		$ubah['restoran']=($res_input!='')?$this->input->post('edit_restoran_menu'):$data->rating;
		$ubah['keterangan']=($ket_input!='')?$this->input->post('edit_keterangan_menu'):$data->keterangan;
		
		$foto=$this->input->post('ubah_menu');
		if($foto=='ubah'){
			$config['upload_path']          = './assets/image/menu/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1000;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;
            $config['file_name']            = str_replace(' ', '_', $nama).'_'.str_replace(' ', '_', $menu);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('edit_foto_menu')){
            			echo "<script>alert(".$this->upload->display_errors().");</script>";
                       redirect('Admin/home/');
                }else{
                        $file=$this->upload->data('file_name');
                        $ubah['foto']=$file;
                         $this->db_restoran->ubah_data('menu','id_menu',$id,$ubah);  
                } 
		}else{

			$this->db_restoran->ubah_data('menu','id_menu',$id,$ubah);  
		}
		redirect('Admin/home/');
	}







}
