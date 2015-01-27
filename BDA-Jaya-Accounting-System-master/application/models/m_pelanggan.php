<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_pelanggan extends CI_Model{
	//show all pelanggan
	public function show_all_pelanggan(){		
		$query = $this->db->get('pelanggan');
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return array();
		}
	}
	//show pelanggan by id
	public function show_pelanggan_by_id($id){
		$this->db->where('id_pelanggan',$id);
		$query = $this->db->get('pelanggan');
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return array();
		}
	}
	//search pelanggan by nama
	public function search_pelanggan_by_name($nama){
		$this->db->like('nama_lengkap',$nama);
		$query = $this->db->get('pelanggan');
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return array();
		}
	}
}