<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_gudang extends CI_Model{
	//show new request
	public function tambahActivity($params){
		if($this->db->insert('gudang_activity',$params)) {
			return true;
		} else {
			return false;
		}
	}
	//semua pemasok
	public function semuaPemasok(){
		$pemasok = $this->db->get('pemasok');
		return $pemasok->result_array();
	}

	//semua aktifitas
	public function gudang_activity($limit,$offset){
		$sql = "SELECT gudang_activity.activity AS 'activity',gudang_activity.tgl AS 'tanggal',pegawai.nama AS 'pegawai'
		FROM gudang_activity INNER JOIN pegawai ON gudang_activity.id_pegawai = pegawai.id_pegawai ORDER BY id_activity DESC LIMIT ".$offset.",".$limit;
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result_array();
		} else { return array();}
	}

	//lihat semua pasokan
	public function semua_pasokan(){
		$sql = "SELECT id_pasokan, pemasok.nama AS 'pemasok',tgl, pegawai.nama AS oleh, rp, rp_bayar,rp + rp_kembali AS 'dibayar', status 
		FROM pasokan
		INNER JOIN pegawai ON pegawai.id_pegawai = pasokan.oleh
		INNER JOIN pemasok ON pasokan.pemasok = pemasok.id_pemasok
		ORDER BY pasokan.id_pasokan DESC";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result_array();
		} else {return array();}
	}
	//pasokan by id pasokan
	public function pasokan_by_id($id){
		$this->db->where('id_pasokan',$id);
		$query = $this->db->get('pasokan');
		return $query->row_array();
	}
}