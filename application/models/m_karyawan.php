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
    //show by username
    public function show_by_username($x){//$x = username
        $this->db->where('username',$x);
        $query = $this->db->get('pegawai');
        return $query->row_array();
    }
    //cek absen hari ini
    public function cek_absen_hari_ini($id_karyawan){
        $sql = "SELECT * FROM absensi WHERE id_karyawan = ? AND DATE(tgl_terakhir) = CURDATE()";
        $query = $this->db->query($sql,$id_karyawan);
        if($query->num_rows()>0){
            return true;
        } else {
            return false;
        }
    }
    //cek absen bulan dan tahun ini
    public function cek_absen_bulan_tahun_ini($id_karyawan){
        $month = date('m');
        $year = date('Y');
        $this->db->where('bulan',$month);
        $this->db->where('tahun',$year);
        $this->db->where('id_karyawan',$id_karyawan);
        $query = $this->db->get('absensi');
        if($query->num_rows()>0){
            return true;
        } else {
            return false;
        }
    }
    //absen hari ini
    public function absenToday(){//absen hari ini
     $sql = "SELECT pegawai.nama AS 'name', absensi.tgl_terakhir AS 'tgl' FROM absensi 
     INNER JOIN pegawai ON pegawai.id_pegawai = absensi.id_karyawan
     WHERE DATE(absensi.tgl_terakhir) = CURDATE() ";
     $query = $this->db->query($sql);
     if($query->num_rows()>0){
        return $query->result_array();
    } else {
        return array();
    }
}

    //tentang penggajian
    public function total_gaji_bln_ini($params){
        $sql = "SELECT total  FROM absensi WHERE bulan = ? AND tahun = ?";
        $query = $this->db->query($sql,$params);
        $query = $query->result_array();
        $total = 0;
        foreach($query as $q):
            $total = $total + $q['total'];
        endforeach;
        return $total;
    }
}