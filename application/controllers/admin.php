<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'application/controllers/base/base.php';
class admin extends base {
	public function __construct(){
		parent::__construct();
		$this->load->model('m_admin');
	}
	public function index(){
		$data['title'] = 'Login Sistem';
		$this->baseView('admin/login',$data);
	}
	public function login(){
		$this->load->library('form_validation');//form validation untuk siswa
		//validasi 
		$this->form_validation->set_rules('input-email', 'Email', 'required|trim|xss_clean|callback_validate_credentials');
		$this->form_validation->set_rules('input-password', 'Password', 'required|md5|trim|xss_clean');
		//check valid
		if($this->form_validation->run()) {
			//ambil data
			$email = $this->input->post('input-email');
			$password = $this->input->post('input-password');
			//cek apakah nis dan password sesuai
			$userdata = $this->m_admin->can_log_in($email, $password);
			if(!empty($userdata)) { //jika siswa ditemukan
				//set session
				$sessionData = $userdata;
				$sql = "UPDATE admin SET log = CURTIME() WHERE id_admin = ?"; //tambah log time
				$this->db->query($sql,$userdata['id_admin']);
				
				$sessionData['admin_logged_in'] = 1;
				$sessionData['kasir_logged_in'] = 0;
				$sessionData['gudang_logged_in'] = 0;
				$redirect = site_url('dashboard');
				
				$this->session->set_userdata($sessionData);
				//alert login berhasil
				echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('Anda Login Sebagai admin');
					window.location.href='".$redirect."';
				</SCRIPT>");
			} else { //jika siswa tidak ditemukan
				echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('Terjadi kesalahan, silahkan ulangi lagi');
					window.location.href='".$redirect."';
				</SCRIPT>");
			}
		} else { //jika form validasi tidak jalan
			$data['title'] = 'Error Login';
			echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('email dan password tidak cocok');
			</SCRIPT>");
			$this->baseView('admin/login',$data);
		}
	}

	//validasi login siswa
	public function validate_credentials(){
		$NIS = $this->input->post('input-email'); 
		$password = md5($this->input->post('input-password'));
		//struktur kendali untuk cek bisa login atau tidak
		if ($this->m_admin->can_log_in($NIS, $password)){
			return true;
		} else {
			//memberikan pesan jika login tidak berhasil
			$this->form_validation->set_message('validate_credentials', 'anu email/password tidak cocok');
			return false;
		}
	}
	/////////////////////////////////////
	//tentang pemasukan dan pengeluaran//
	///////////////////////////////////
	// tambah pengeluaran
	public function tambah_pengeluaran(){
		$this->load->library('user_agent');
		$keterangan = $this->input->post('inputKeterangan');
		$kategori = $this->input->post('inputKategori');
		$jumlah = $this->input->post('inputJumlah');
		$status = $this->input->post('inputStatus');
		$oleh = $this->session->userdata('id_pegawai');//untuk mengetahui siapa yang memasukan
		$data = array(
			'keterangan'=>$keterangan,
			'kategori'=>$kategori,
			'rp'=>$jumlah,
			'status'=>$status,
			'oleh'=>$oleh
			);
		if($this->db->insert('pengeluaran',$data)){//memasukan ke database pengeluaran
			//memasukan ke tabel laporan pegawai
			$data = array (
				'id_pegawai'=>$oleh,
				'catatan'=>'Pembelian '.$kategori.' : '.$keterangan,
				); //laporan pegawai
			if($this->db->insert('kasir_activity', $data)){
				echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('berhasil tambah data');
					window.location.href='".$this->agent->referrer()."';
				</SCRIPT>");
			}else{	
				echo 'gagal memasukan data ke kasir activity';
			}
		} else{
			// gagal memasukan ke tabel pengeluaran
			echo 'gagal memasukan pengeluaran';
		}
	}
	// tambah pemasukan
	public function tambah_pemasukan(){

	}
	//logout
	public function logout(){
		$this->session->sess_destroy();//membersihkan session
		redirect('admin');//kembali ke halaman admin
	}
}