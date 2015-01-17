<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'application/controllers/base/base.php';
class ajax extends base {
	//show detail tranksaksi
	public function detail_transaksi(){
		$idtransaksi = $this->input->get('id');//get id transaksi
		$detail = $this->m_transaksi->detail_transaksi($idtransaksi);
		$item = $this->m_transaksi->show_transaksi_item($idtransaksi);
		//show detail transaksi;
		echo '
		<p>Id: '.$detail['id_transaksi'].'</p>
		<p>Tanggal : '.$detail['tgl_transaksi'].'</p>
		<p>Rp.Total : '.$detail['total_bayar'].',-</p>
		<p>Status : '.$detail['status'].'</p>
		<p><a href="'.site_url('kasir/cetaknota?id='.$idtransaksi).'"><span class="glypichon glypichon-print">print</span></a></p>
		<hr/>
		<h5>Barang Yang Dibeli</h5>
		<table class="table table-striped">
			<tr>
				<th>#</th>
				<th>Id Barang</th>
				<th>Q</th>
				<th>Rp/unit</th>
				<th>Total Rp</th>
			</tr>
			';
		//show transaksi item;
			$x = 1;
			foreach($item as $i):
				echo '
			<tr>
				<td>'.$x.'</td>
				<td>'.$i['id_barang'].'</td>
				<td>'.$i['jumlah'].'</td>
				<td>Rp.'.number_format($i['subtotal'] / $i['jumlah']).',-</td>
				<td>Rp.'.number_format($i['subtotal']).',-</td>
			</tr>
			';
			$x++;
			endforeach;
			echo '</table><br/>';	
		}
		//show angsuran
		public function show_all_angsuran(){
			$idtransaksi = $this->input->get('id');//get id transaksi
			$detail = $this->m_transaksi->detail_transaksi($idtransaksi);//detail transaksi
			$angsuran = $this->m_transaksi->show_angsuran($idtransaksi);//detail angsuran
			echo '
			<form class="form-inline" role="form">
				Rp.<div class="form-group">
				<label class="sr-only" for="exampleInputEmail2">Rupiah</label>
				<input id="jumlahAngsuran" type="number" min="0" class="form-control" id="exampleInputEmail2" placeholder="masukan jumlah tanpa titik "."">

			</div>				
			<button type="submit" onclick="tambahAngsuran('.$idtransaksi.')" class="btn btn-default">Tambah Angsuran</button>
		</form>
		<hr/>
		<h5>Angsuran Terbayar</h5>
		<table class="table table-striped">
			<tr>
				<th>#</th>
				<th>Tanggal</th>
				<th>Oleh</th>
				<th>Jumlah</th>
				<th></th>
			</tr>
			';
			$x=1;
			$total_angsuran = $detail['bayar'];//total yang telah dibayar
			foreach($angsuran as $a):			
				echo '	
			<tr>
				<td>'.$x.'</td>
				<td>'.$a['tgl'].'</td>						
				<td>'.$a['oleh'].'</td>
				<td>Rp.'.number_format($a['rp']).',-</td>
				<td><a href="#" onclick="deleteAngsuran('.$a['id_angsuran'].','.$idtransaksi.')"><span class="glyphicon glyphicon-trash"></span></a></td>
			</tr>
			';	
			$x++;
			
			endforeach;	
			//jika sudah lunas
			if($detail['status']=='lunas'){
				$total_angsuran = $detail['total_bayar'];//cek total angsuran
			} else {
				$total_angsuran = $detail['bayar'];//cek total angsuran
			}
			$sisa_piutang = $detail['total_bayar'] - $total_angsuran;
			echo '
			<hr/>
			<strong>Total Angsuran : </strong> Rp.'.number_format($total_angsuran).',-<br/>
			<strong>Total Piutang : </strong> Rp.'.number_format($detail['total_bayar']).',-<br/>
			<strong>Sisa Piutang : </strong> Rp.'.number_format($sisa_piutang).',-<br/>
			';
		}

		//tambah angsuran + update transaksi.bayar + update transaksi.status
		public function tambah_angsuran(){
			$idtransaksi = $this->input->get('idtransaksi');
			$jumlah =$this->input->get('jumlah');
			//proses ke tabel angsuran piutang
			$dataangsuran = array(
				'id_transaksi'=>$idtransaksi,
				'oleh'=>$this->session->userdata('id_pegawai'),
				'rp'=>$jumlah
				);
			if($this->db->insert('angsuran_piutang',$dataangsuran)){
				//update tabel transaksi
				$params = array($jumlah,$idtransaksi);
				$updatetransaksi = "UPDATE transaksi SET bayar = bayar + ? WHERE id_transaksi = ?";
				if($this->db->query($updatetransaksi,$params)){ //ekse update tabel transaksi
					//tambah ke tabel pemasukan
					$datapemasukan = array(
						'oleh'=>$this->session->userdata('id_pegawai'),
						'Keterangan' => 'Angsuran puitang untuk transaksi dengan id = '.$idtransaksi,
						'rp'=>$jumlah,
						'kategori'=>2,
						'id_transaksi'=>$idtransaksi,
						);
					// $this->db->insert('pemasukan',$datapemasukan
					$error = false;
					if(!$error){//ekse memasukan ke tabel pemasukan
						//memasukan data ke kasir activity
						$dataactivity = array(
							'id_pegawai'=>$this->session->userdata('id_pegawai'),
							'id_transaksi'=>$idtransaksi,
							'catatan'=>'melayani pembayaran angsuran piutang dengan id : '.$idtransaksi,
							);
						//ekse ke tabel activity
						if($this->db->insert('kasir_activity',$dataactivity)){
							echo 'Data angsuran berhasil dimasukan';
						}else{
							//gagal memasukan ke tabel activity
							echo 'Gagal proses update tabel kasir_activity';
						}
					}else{
						//gagal memasukan ke tabel pemasukan
						echo 'Gagal proses update tabel pemasukan';
					}
				} else {
					// gagal update bayar transaksi
					echo 'Gagal proses update tabel transaksi';
				}
			} else {
				// gagal memasukan ke tabel angsuran piutang
				echo 'Gagal proses update tabel angsuran_piutang';
			}
		}

		//hapus angsuran
		public function hapus_angsuran(){
			$id_angsuran = $this->input->get('id');
			//cek total transaksi
			$angsuran = $this->db->get_where('angsuran_piutang',array('id_angsuran'=>$id_angsuran));
			$angsuran = $angsuran->row_array();
			$nilaiangsuran = $angsuran['rp'];
			$idtransaksi = $angsuran['id_transaksi'];
			$params = array($nilaiangsuran,$nilaiangsuran,$idtransaksi);
			//update dibayar di tabel transaksi
			$sqldibayar = "UPDATE transaksi SET bayar = bayar - ?, kembali = kembali - ? WHERE id_transaksi = ?";
			//hapus di tabel angsuran_piutang
			if($this->db->query($sqldibayar,$params)) {
				$this->db->delete('angsuran_piutang',array('id_angsuran'=>$id_angsuran));
			}			
		}

		//////////////////////////
		//// SEMUA TENTANG PASOKAN
		//////////////////////////

		//lihat detail pasokan
		public function detail_pasokan(){
			$idPasokan = $this->input->get('id');//id pasokan
			$sql = "SELECT barang.no_seri as 'no_seri',barang.nama as 'barang', jumlah, pasokan_item.harga_beli AS 'harga_beli', subtotal_beli
			FROM pasokan_item 
			INNER JOIN barang ON barang.id_barang = pasokan_item.id_barang
			WHERE id_pasokan = ?";
			$query = $this->db->query($sql,$idPasokan);
			$pasokan_item = $query->result_array();
			foreach($pasokan_item as $p):
			echo '<table class="table table-striped">';
			echo '<tr>';
			echo '<td>'.$p['no_seri'].'</td>';
			echo '<td>'.$p['barang'].'</td>';
			echo '<td>'.$p['jumlah'].',</td>';
			echo '<td>Rp'.$p['harga_beli'].',-/unit</td>';
			echo '<td>Rp'.$p['subtotal_beli'].',-</td>';
			echo '<tr>';
			echo '</table><br/>';
			endforeach;
		}

		//lihat pembayaran hutang ke pamasok
		public function hutang_pasokan(){
			$id_pasokan = $this->input->get('id');//id pasokan
			$pasokan = $this->m_gudang->pasokan_by_id($id_pasokan);	
			$totalbayar = $pasokan['rp'];
			$totaldibayar = $pasokan["rp_bayar"];
			$sisahutang = $totalbayar - $totaldibayar;
			echo '<div class="row form-group">
			<label for="angsuran" class="col-lg-2 control-label">angsur hutang</label>
			<div class="col-lg-10">
				<input type="number" class="form-control" id="nilai_angsuran" placeholder="masukan nominal">
			</div>
			<div class="form-group">
				<div class="col-lg-offset-2 col-lg-10">
					<button onclick="bayarHutang('.$id_pasokan.')" class="btn btn-default">Bayar</button>
				</div>
			</div>
		</div>
		<br/>';
		echo '
		<p><strong>Total Bayar : </strong> Rp'.$totalbayar.',- </p>
		<p><strong>Total Dibayar : </strong> Rp'.$totaldibayar.',- </p>
		<p><strong>Sisa Hutang : </strong> Rp'.$sisahutang.',-</p>
		<p><strong>Status : </strong> '.$pasokan["status"].'</p>
		';
			$sql = "SELECT rp, pegawai.nama AS nama, tgl FROM pasokan_angsuran 
			INNER JOIN pegawai ON pegawai.id_pegawai = pasokan_angsuran.oleh 
			WHERE id_pasokan = ?";
			$query = $this->db->query($sql,$id_pasokan);
			$bayar = $query->result_array();
			foreach ($bayar as $b):
			echo '<table class="table table-striped">';
			echo '<tr>';
			echo '<td>'.$b["tgl"].'</td>';
			echo '<td>'.$b["nama"].'</td>';
			echo '<td>Rp'.$b["rp"].',-</td>';
			echo '</tr>';
			echo '</table>';
			endforeach;			
		}

		//tambah bayar hutam
		public function tambahbayar(){
			$idpasokan = $this->input->get('id');
			$nominal = $this->input->get('nominal');
			$sqldibayar = "SELECT rp AS 'total',rp_bayar FROM pasokan WHERE id_pasokan = ?";
			$query = $this->db->query($sqldibayar,$idpasokan);
			$result = $query->row_array();
			$dibayar = $result['rp_bayar'];
			$total= $result['total'];
			//dibayar terbaru
			$dibayar = $dibayar + $nominal;
			if($total == $dibayar) {
				$status = 'lunas';
			} else {
				$status = 'hutang';
			}
			//update ke data dibayarkan pada pasokan
			$params = array($nominal,$status,$idpasokan);
			$sqlupdatedibayar = "UPDATE pasokan SET rp_bayar = rp_bayar + ?, status = ? WHERE id_pasokan = ?";
			$this->db->query($sqlupdatedibayar,$params);//eksekusi
			//masukan ke list pembayaran hutang
			$angsuran = array(
				'rp'=>$nominal,
				'oleh'=>$this->session->userdata('id_pegawai'),
				'id_pasokan' =>$idpasokan
				);
			$this->db->insert('pasokan_angsuran',$angsuran);
		}
	}