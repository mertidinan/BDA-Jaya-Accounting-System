<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_admin extends CI_Model{
	//all data admin
	public function can_log_in($username, $password){
		//membuat perintah sql dengan menggunakan fungsi bawaan ci
        //untuk perintah SELECT
        $this->db->select('*');
        //untuk perintah WHERE
        $this->db->where('username', $username);
        //untuk perintah WHEREegawai
        $this->db->where('password', $password);
        //eksekusi peritah sql
        $query = $this->db->get('admin');
        //struktur kendali untuk cek apakah data ada atau tidak
        if($query->num_rows() > 0){
            //memasukkan hasil eksekusi query kedalam row_array
            return $query->row_array();
        } else {
            return array();
        }
    }
	//login terakhir
    public function loginTerakhir(){
        $this->db->order_by('log','DESC');
        $query = $this->db->get('admin');
        return $query->result_array();
    }
    /////////////////////////////////////////////////
    ///////////////////////////// KATEGORI MANAGEMENT
    //lihat semua kategori pemasukan
    public function show_all_kategoripemasukan(){
        $query = $this->db->get('kategori_pemasukan');
        if($query->num_rows()>0){return $query->result_array();}else{return array();}
    }
    //lihat semua kategori pengeluaran
    public function show_all_kategoripengeluaran(){
        $query = $this->db->get('kategori_pengeluaran');
        if($query->num_rows()>0){return $query->result_array();}else{return array();}
    }
    //lihat kategori masuk berdasarkan id
    public function get_kategori_masuk_by_id($id){
        $this->db->where('id_kat_masuk',$id);
        $query = $this->db->get('kategori_pemasukan');
        return $query->row_array();
    }
    //lihat kategori keluar berdasarkan id
    public function get_kategori_keluar_by_id($id){
        $this->db->where('id_kat_pengeluaran',$id);
        $query = $this->db->get('kategori_pengeluaran');
        return $query->row_array();
    }
    /////////////////////////////////////////////////
    ///////////////////////////// KARYAWAN
    public function show_all_pegawai(){
        $query = $this->db->get('pegawai');
        return $query->result_array();
    }
    public function pegawai_by_id($id){
        $this->db->where('id_pegawai',$id);
        $karyawan = $this->db->get('pegawai');
        return $karyawan->row_array();
    }
}
