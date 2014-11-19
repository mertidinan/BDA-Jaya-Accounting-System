<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_karyawan extends CI_Model{
	//all karyawan data
	public function can_log_in($username, $password){
		//membuat perintah sql dengan menggunakan fungsi bawaan ci
        //untuk perintah SELECT
        $this->db->select('*');
        //untuk perintah WHERE
        $this->db->where('username', $username);
        //untuk perintah WHEREegawai
        $this->db->where('password', $password);
        //eksekusi peritah sql
        $query = $this->db->get('pegawai');
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
        $this->db->order_by('login_log','DESC');
        $query = $this->db->get('pegawai');
        return $query->result_array();
    }
    //lihat semua karyawan
    public function show_all_karyawan(){
        $query = $this->db->get('pegawai');
        $data = $query->result_array();
        return $data;
    }
}