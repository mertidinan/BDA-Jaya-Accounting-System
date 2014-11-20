<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'application/controllers/base/base.php';
class absensi extends base{
	//class absensi, untuk absensi karyawan
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$data['title'] = 'Absensi Karyawan';
		$month = date('m');
		$year = date('Y');
		if(!empty($_GET['act']) && $_GET['act']=='absen'){
			$username = $_POST['inputUsername'];
			//ambil id karyawan
			$karyawan = $this->m_karyawan->show_by_username($username);
			$id_karyawan = $karyawan['id_pegawai'];
		}
		if(isset($_POST['btnAbsen'])) { //tambah absen baru
			if(empty($id_karyawan)){redirect(site_url('absensi?error=Username tidak ditemukan'));}
			//cek apakah sudah ada data didatabase
			if($this->m_karyawan->cek_absen_hari_ini($id_karyawan)){ 
				//jika ditemukan
				redirect('absensi?error=Anda sudah absen');
			} else { 
				//jika tidak ditemukan
				//cek apakah id-karyawan-bulan-tahun-sekarang ditemukan
				if($this->m_karyawan->cek_absen_bulan_tahun_ini($id_karyawan)){
					//ditemukan, update data total
					$params = array($id_karyawan,$month,$year);
					$sqlupdate = "UPDATE absensi SET total = total + 1 
					WHERE id_karyawan = ? AND bulan = ? AND tahun = ? ";
					$this->db->query($sqlupdate,$params);
					redirect(site_url('absensi?note=Absen berhasil'));
				} else { 
					//tidak ditemukan, buat row baru
					$data = array(
						'id_karyawan'=>$id_karyawan,
						'bulan'=>$month,
						'tahun'=>$year,
						'total'=>1);
					$this->db->insert('absensi',$data);
					redirect(site_url('absensi?note=Absen bulan baru berhasil'));
				}
			}
		} else if(isset($_POST['btnHapus'])){ //hapus absen
			$params = array($id_karyawan,$month,$year);
			$sql = "UPDATE absensi SET total = total - 1, tgl_terakhir = '1111-11-11 11:11:11' 
			WHERE id_karyawan = ? AND bulan = ? AND tahun = ? ";
			if($this->db->query($sql,$params)){
			redirect(site_url('absensi?note=Absen berhasil dihapus'));
			}else{
			redirect(site_url('absensi?error=Hapus gagal, silahkan coba lagi'));
			}
		}	
		$data['absenToday'] = $this->m_karyawan->absenToday();
		$this->baseView('absensi',$data);
	}
}

/* End of file absensi.php */
/* Location: ./application/controllers/absensi.php */