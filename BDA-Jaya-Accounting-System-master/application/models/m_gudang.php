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
	//cetak pasokan//
	public function cetakPasokan($d,$m,$y){
		//get data form db
		if($d==0&&$m!=0&&$y!=0){//menampilkan semua tanggal
			
			$params = array($m,$y);
			$sql = "SELECT pasokan.id_pasokan AS 'id_pasokan', pemasok.nama AS 'pemasok',tgl, pegawai.nama AS oleh, 
			rp, rp_bayar,rp + rp_kembali AS 'dibayar', status,
			barang.nama AS 'barang',
			pasokan_item.jumlah AS 'jumlah',
			pasokan_item.harga_beli AS 'harga',pasokan_item.subtotal_beli AS 'subtotal'
			FROM pasokan
			INNER JOIN pegawai ON pegawai.id_pegawai = pasokan.oleh
			INNER JOIN pemasok ON pasokan.pemasok = pemasok.id_pemasok
			INNER JOIN pasokan_item ON pasokan_item.id_pasokan = pasokan.id_pasokan
			INNER JOIN barang ON pasokan_item.id_barang = barang.id_barang
			WHERE 
			MONTH(pasokan.tgl) = ? AND YEAR(pasokan.tgl) = ?
			ORDER BY pasokan.id_pasokan DESC";
			$query = $this->db->query($sql,$params);
		}else if($d!=0&&$m==0&&$y!=0){//menampilkan semua bulan
			
			$params = array($d,$y);
			$sql = "SELECT pasokan.id_pasokan AS 'id_pasokan', pemasok.nama AS 'pemasok',tgl, pegawai.nama AS oleh, rp, rp_bayar,rp + rp_kembali AS 'dibayar', status,
			barang.nama AS 'barang',
			pasokan_item.jumlah AS 'jumlah',
			pasokan_item.harga_beli AS 'harga',pasokan_item.subtotal_beli AS 'subtotal'
			FROM pasokan
			INNER JOIN pegawai ON pegawai.id_pegawai = pasokan.oleh
			INNER JOIN pemasok ON pasokan.pemasok = pemasok.id_pemasok
			INNER JOIN pasokan_item ON pasokan_item.id_pasokan = pasokan.id_pasokan
			INNER JOIN barang ON pasokan_item.id_barang = barang.id_barang
			WHERE 
			DAY(pasokan.tgl) = ? AND YEAR(pasokan.tgl) = ?
			ORDER BY pasokan.id_pasokan DESC";
			$query = $this->db->query($sql,$params);
		}else if($d==0&&$m==0&&$y!=0){//menampilkan semua tahun
			$params = array($y);
			$sql = "SELECT pasokan.id_pasokan AS 'id_pasokan', pemasok.nama AS 'pemasok',tgl, pegawai.nama AS oleh, rp, rp_bayar,rp + rp_kembali AS 'dibayar', status,
			barang.nama AS 'barang',
			pasokan_item.jumlah AS 'jumlah',
			pasokan_item.harga_beli AS 'harga',pasokan_item.subtotal_beli AS 'subtotal' 
			FROM pasokan
			INNER JOIN pegawai ON pegawai.id_pegawai = pasokan.oleh
			INNER JOIN pemasok ON pasokan.pemasok = pemasok.id_pemasok
			INNER JOIN pasokan_item ON pasokan_item.id_pasokan = pasokan.id_pasokan
			INNER JOIN barang ON pasokan_item.id_barang = barang.id_barang
			WHERE 
			YEAR(pasokan.tgl) = ?
			ORDER BY pasokan.id_pasokan DESC";
			$query = $this->db->query($sql,$params);
		}else{//berdasarkan tanggal bulan dan tahun
			
			$params = array($d,$m,$y);
			$sql = "SELECT pasokan.id_pasokan AS 'id_pasokan', pemasok.nama AS 'pemasok',tgl, pegawai.nama AS oleh, rp, rp_bayar,rp + rp_kembali AS 'dibayar', status,
			barang.nama AS 'barang',
			pasokan_item.jumlah AS 'jumlah',
			pasokan_item.harga_beli AS 'harga',pasokan_item.subtotal_beli AS 'subtotal'
			FROM pasokan
			INNER JOIN pegawai ON pegawai.id_pegawai = pasokan.oleh
			INNER JOIN pemasok ON pasokan.pemasok = pemasok.id_pemasok
			INNER JOIN pasokan_item ON pasokan_item.id_pasokan = pasokan.id_pasokan
			INNER JOIN barang ON pasokan_item.id_barang = barang.id_barang
			WHERE 
			DAY(pasokan.tgl) = ? AND MONTH(pasokan.tgl) = ? AND YEAR(pasokan.tgl) = ?
			ORDER BY pasokan.id_pasokan DESC";
			$query = $this->db->query($sql,$params);
		}
		//exe query
		if($query->num_rows()>0){
			return $query->result_array();
		} else {return array();}
	}

	//end of cetak pasokan//
	//lihat semua pasokan berdasarkan waktu
	public function semua_pasokan_by_time(){
		$sql = "SELECT ";
		$query = $this->db->query($sql,$params);
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return array();
		}
	}
	//pasokan by id pasokan
	public function pasokan_by_id($id){
		$this->db->where('id_pasokan',$id);
		$query = $this->db->get('pasokan');
		return $query->row_array();
	}
	//pasokan item
	public function pasokan_item($id){
		$this->db->where('id_pasokan',$id);
		$query = $this->db->get('pasokan_item');
		$sql = "SELECT barang.nama AS 'barang', barang.no_seri AS 'noseri',pasokan_item.harga_beli AS 'harga_beli',pasokan_item.jumlah AS 'jumlah',pasokan_item.subtotal_beli AS 'subtotal_beli'
		FROM pasokan_item INNER JOIN barang
		ON barang.id_barang = pasokan_item.id_barang
		WHERE pasokan_item.id_pasokan = ?;
		";
		$query = $this->db->query($sql,$id);
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return array();
		}
	}
}