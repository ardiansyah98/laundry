<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kasir extends CI_Model {

	var $table = 'transaksi';
	//set column field database for datatable orderable
	var $column_order = array(null, 'kode_transaksi','nama_paket','harga_paket','nama_customer','berat','diskon','id_kasir','id_cabang','status_cucian','tgl_diterima','tgl_diambil','status_pembayaran','tgl_bayar'); 
	//set column field database for datatable searchable 
	var $column_search = array('kode_transaksi','nama_paket','harga_paket','nama_customer','berat','diskon','id_kasir','id_cabang','status_cucian','tgl_diterima','tgl_diambil','status_pembayaran','tgl_bayar'); 
	// default order 
	var $order = array('id_transaksi' => 'asc'); 

	private function _get_datatables_query()
	{	
		$this->db->from($this->table);

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_by_kode($kode_transaksi)
	{
		$this->db->from($this->table);
		$this->db->where('kode_transaksi',$kode_transaksi);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_kode($kode_transaksi)
	{
		$this->db->where('kode_transaksi', $kode_transaksi);
		$this->db->delete($this->table);
	}

	function get_paket(){
		$hasil=$this->db->query("SELECT * FROM paket");
		return $hasil;
	}

	function get_harga_paket($id){
		$hasil=$this->db->query("SELECT * FROM paket WHERE id_paket='$id'");
		return $hasil->result();
	}

}
