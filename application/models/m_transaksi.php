<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_transaksi extends CI_Model{
	//detail transaksi
	public function detail_transaksi($id){ //id transaksi
		$this->db->where('id_transaksi',$id);
		$query = $this->db->get('transaksi');
		if($query->num_rows>0){
			return $query->row_array();
		} else {
			return array();
		}
	}
	//show transaksi item
	public function show_transaksi_item($id){//parameter adalah id transaksi
		$this->db->where('id_transaksi',$id);
		$this->db->join('barang','barang.id_barang=transaksi_item.id_barang');
		$query = $this->db->get('transaksi_item');
		if($query->num_rows()>0){
			return $query->result_array();
		}else{return array();}
	}
	//hapus transaksi 
	public function delete_transaksi($id){//id transaksi
		return $this->db->delete('transaksi',array('id_transaksi'=>$id));
	}
	//menampilkan angsuran
	public function show_angsuran($id){//id transaksi
		$sql = "SELECT id_angsuran AS 'id_angsuran',id_transaksi AS 'id_transaksi',tgl AS 'tgl',pegawai.nama AS 'oleh',rp as 'rp'
		FROM angsuran_piutang INNER JOIN pegawai ON pegawai.id_pegawai = angsuran_piutang.oleh
		WHERE id_transaksi = ?";
		$query = $this->db->query($sql,$id);
		if($query->num_rows>0){
			return $query->result_array();
		} else {
			return array();
		}
	}
}