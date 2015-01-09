<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_pengeluaran extends CI_Model{
	//show new request
	public function tambahBarangGudang($params){
		if($this->db->insert('pengeluaran',$params)) {
			return true;
		} else {
			return false;
		}
	}
	//show pengeluaran
	public function showPengeluaran($params){//bln , tahun
		$sql = "SELECT pengeluaran.id_pengeluaran AS  'id_pengeluaran', pengeluaran.tanggal AS  'tanggal', pengeluaran.rp AS  'rp', kategori_pengeluaran.det_kat_pengeluaran AS 'kategori', 
		pengeluaran.status AS  'status',pengeluaran.keterangan AS 'keterangan'
		FROM pengeluaran
		INNER JOIN kategori_pengeluaran ON kategori_pengeluaran.id_kat_pengeluaran = pengeluaran.kategori
		WHERE DAY(pengeluaran.tanggal ) = ?
		AND MONTH(pengeluaran.tanggal ) =  ?
		AND YEAR(pengeluaran.tanggal ) =  ?" ;
		$query = $this->db->query($sql,$params);
		if($query->num_rows()>0){return $query-> result_array();}else{return array();}
	}
	//show pengeluaran bln ini
	public function showPengeluaran_blnini($params){//bln , tahun
		if($params[0]=='00'){//menampilkan pertahun
			$sql = "SELECT pengeluaran.id_pengeluaran AS  'id_pengeluaran', pengeluaran.tanggal AS  'tanggal', pengeluaran.rp AS  'rp', kategori_pengeluaran.det_kat_pengeluaran AS 'kategori', 
			pengeluaran.status AS  'status',pengeluaran.keterangan AS 'keterangan',det,status,id_pasokan
			FROM pengeluaran
			INNER JOIN kategori_pengeluaran ON kategori_pengeluaran.id_kat_pengeluaran = pengeluaran.kategori
			WHERE YEAR(pengeluaran.tanggal ) =  ?" ;
			$query = $this->db->query($sql,$params[1]);
		}else{
			$sql = "SELECT pengeluaran.id_pengeluaran AS  'id_pengeluaran', pengeluaran.tanggal AS  'tanggal', pengeluaran.rp AS  'rp', kategori_pengeluaran.det_kat_pengeluaran AS 'kategori', 
			pengeluaran.status AS  'status',pengeluaran.keterangan AS 'keterangan',det,status,id_pasokan
			FROM pengeluaran
			INNER JOIN kategori_pengeluaran ON kategori_pengeluaran.id_kat_pengeluaran = pengeluaran.kategori
			WHERE MONTH(pengeluaran.tanggal ) =  ?
			AND YEAR(pengeluaran.tanggal ) =  ?" ;
			$query = $this->db->query($sql,$params);
		}		
		if($query->num_rows()>0){return $query-> result_array();}else{return array();}
	}

	//semua kategori pengeluaran
	public function show_all_kategori_keluar(){
		$query = $this->db->get('kategori_pengeluaran');
		return $query->result_array();
	}

	//menampilkan pengeluaran berdasarkan kategori, bulan dan tahun : untuk buku besar
	public function show_keluar_bukubesar($params){ //kat | bln |tahun
		$sql = 'SELECT * FROM pengeluaran WHERE kategori = ? AND MONTH(tanggal) = ? AND YEAR(tanggal) = ?';
		$query = $this->db->query($sql,$params);
		if($query->num_rows<0){
			return array();
		} else {
			return $query->result_array();
		}
	}
}