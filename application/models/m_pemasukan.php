<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_pemasukan extends CI_Model{
	//show pengeluaran
	public function showPemasukan($params){//bln , tahun
		$sql = "SELECT pemasukan.id_pemasukan AS  'id_pemasukan', pemasukan.tanggal AS  'tanggal', pemasukan.rp AS  'rp', kategori_pemasukan.det_kat_masuk AS 'kategori', 
		pemasukan.status AS  'status',pemasukan.keterangan AS 'keterangan'
		FROM pemasukan
		INNER JOIN kategori_pemasukan ON kategori_pemasukan.id_kat_masuk = pemasukan.kategori
		WHERE DAY(pemasukan.tanggal) = ? 
		AND MONTH( pemasukan.tanggal ) =  ?
		AND YEAR( pemasukan.tanggal ) =  ?" ;
		$query = $this->db->query($sql,$params);
		if($query->num_rows()>0){return $query->result_array();}else{return array();}
	}
	//menampilkan pemasukan bulan ini
	public function showPemasukan_blnini($params){//bln , tahun
		$sql = "SELECT pemasukan.id_pemasukan AS  'id_pemasukan', pemasukan.tanggal AS  'tanggal', pemasukan.rp AS  'rp', kategori_pemasukan.det_kat_masuk AS 'kategori', 
		pemasukan.status AS  'status',pemasukan.keterangan AS 'keterangan',det,id_transaksi
		FROM pemasukan
		INNER JOIN kategori_pemasukan ON kategori_pemasukan.id_kat_masuk = pemasukan.kategori
		AND MONTH( pemasukan.tanggal ) =  ?
		AND YEAR( pemasukan.tanggal ) =  ?" ;
		$query = $this->db->query($sql,$params);
		if($query->num_rows()>0){return $query->result_array();}else{return array();}
	}
	//menampilkan semua kategori keluar
	public function show_all_kategori_masuk(){
		$query = $this->db->get('kategori_pemasukan');
		return $query->result_array();
	}
}