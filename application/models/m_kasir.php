<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_kasir extends CI_Model{
	//lihat aktifitas kasir
	public function activityKasir($limit,$offset){
		$sql = "SELECT kasir_activity.catatan AS 'activity',kasir_activity.tgl AS 'tanggal',pegawai.nama AS 'pegawai'
		FROM kasir_activity INNER JOIN pegawai ON kasir_activity.id_pegawai = pegawai.id_pegawai ORDER BY id_activity DESC LIMIT ".$offset.",".$limit;
		$query = $this->db->query($sql);
		if($query->num_rows()){
			return $query->result_array();
		} else { return array();}
	}
	//lihat semua transaksi
	public function showTransaksi($limit,$offset){
		$sql = "SELECT transaksi.id_transaksi AS 'id_transaksi',transaksi.tgl_transaksi AS 'tgl_transaksi',transaksi.total_bayar AS 'total_bayar',
		transaksi.bayar AS 'bayar',transaksi.kembali AS 'kembali', transaksi.status AS 'status', pelanggan.nama_lengkap AS 'nama_lengkap'
		FROM transaksi
		INNER JOIN pelanggan ON pelanggan.id_pelanggan = transaksi.id_pelanggan
		ORDER BY transaksi.id_transaksi DESC
		LIMIT ".$limit." OFFSET ".$offset;
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	//lihat transaksi berdasarkan status(limit,offset)
	public function showTransaksiByStatus($limit,$offset,$status){
		$sql = "SELECT transaksi.id_transaksi AS 'id_transaksi',transaksi.tgl_transaksi AS 'tgl_transaksi',transaksi.total_bayar AS 'total_bayar',
		transaksi.bayar AS 'bayar',transaksi.kembali AS 'kembali', transaksi.status AS 'status', pelanggan.nama_lengkap AS 'nama_lengkap'
		FROM transaksi
		INNER JOIN pelanggan ON pelanggan.id_pelanggan = transaksi.id_pelanggan
		WHERE transaksi.status = '".$status."'
		ORDER BY transaksi.id_transaksi DESC
		LIMIT ".$limit." OFFSET ".$offset;
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	//lihat transaksi berdasarkan pencarian
	public function showTransaksiByKeyword($limit,$offset,$keyword){
		$sql = "SELECT transaksi.id_transaksi AS 'id_transaksi',transaksi.tgl_transaksi AS 'tgl_transaksi',transaksi.total_bayar AS 'total_bayar',
		transaksi.bayar AS 'bayar',transaksi.kembali AS 'kembali', transaksi.status AS 'status', pelanggan.nama_lengkap AS 'nama_lengkap'
		FROM transaksi
		INNER JOIN pelanggan ON pelanggan.id_pelanggan = transaksi.id_pelanggan
		WHERE pelanggan.nama_lengkap LIKE '%".$keyword."%' OR transaksi.id_transaksi = '".$keyword."'
		LIMIT ".$limit." OFFSET ".$offset;
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	//lihat total transaksi hari ini
	public function totPiutang(){
		$this->db->where('status','piutang');
		return $this->db->count_all('transaksi');
	}
	//lihat total piutang
	public function totTransaksiHariIni(){
		$sql = "SELECT * FROM transaksi WHERE tgl_transaksi = NOW()";
		$result = $this->db->query($sql);
		return $result->num_rows();
	}
}