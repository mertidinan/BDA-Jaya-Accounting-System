<script type="text/javascript">
	function cekAngsuran(x){ //x = id transaksi
		$('#modalAngsuran').modal('show');
		$('#isiAngsuran').html('Loading....');
		$.ajax({
			url:'<?php echo site_url("ajax/show_all_angsuran?id=")?>'+x,
			success:function(data){
				$('#isiAngsuran').html(data);
			},
			error:function(){
				$('#isiAngsuran').html('Pemanggilan data bermasalah <br/> silahkan <strong>Refresh</strong> halaman');
			}
		});
	}
	function detailTransaksi(x){ //x = id transaksi
		$('#modalDetailTransaksi').modal('show');
		$('#isiDetail').html('Loading....');
		$.ajax({
			url:'<?php echo site_url("ajax/detail_transaksi?id=")?>'+x,
			success:function(data){
				$('#isiDetail').html(data);
			},
			error:function(){
				$('#isiDetail').html('Pemanggilan data bermasalah <br/> silahkan <strong>Refresh</strong> halaman');
			}
		});
	}
	function deleteAngsuran(x,y){ //x=id angsuran , y = id transaksi
		sure = confirm('Anda yakin!');
		if(sure){
			$.ajax({
				url:'<?php echo site_url("ajax/hapus_angsuran?id=")?>'+x,
				success:function(data){
					alert('berhasil hapus data angsuran');
					cekAngsuran(y);
				},
				error:function(data){
					alert('gagal hapus data angsuran, silahkan coba lagi');
				}
			});
		}
	}
	function tambahAngsuran(x){//x = id transaksi [WORKED]
		jumlah = $('#jumlahAngsuran').val();
		// alert(jumlah);
		//proses tambah  ke table (angsuran piutang, transaksi, pemasukan)
		$.ajax({
			url:'<?php echo site_url("ajax/tambah_angsuran?idtransaksi=");?>'+x+'&jumlah='+jumlah,
			success:function(response){
				//alert(response);
				detailTransaksi(x);
			},
			error:function(response){
				//alert(response);
			}
		});
	}
</script>
<div class="container">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="#">Kasir</a></li>
			<li class="active">Transaksi</li>
		</ol>
	</div>
</div>
<div class="container">
	<?php 
	if($this->session->userdata('kasir_logged_in')){
		$this->load->view('kasir/menu');
	}else if($this->session->userdata('admin_logged_in')){
		$this->load->view('admin/menu');
	}
	?>
	<div class="col-md-10">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Barang</h3>
				</div>
				<div class="panel-body">
					<!-- menu -->
					<div class="col-md-6">
						<a href="<?php echo site_url('kasir/transaksiBaru')?>" class="btn btn-primary btn-xs">+ Transaksi baru</a>
						<a href="<?php echo site_url('kasir/transaksi?status=lunas')?>" class="btn btn-default btn-xs" href="">Transaksi Lunas</a>
						<a href="<?php echo site_url('kasir/transaksi?status=piutang')?>" class="btn btn-default btn-xs" href="">Transaksi Piutang</a>
						<!-- <a onclick="closeAll()" href="#" class="btn btn-default btn-xs" href="">x</a> -->
						<!-- modal tambah barang -->
						
					</div>
					<!-- search -->
					<div class="col-md-6">
						<form class="form" method="get" action="<?php echo site_url('kasir/transaksi')?>">
							<div class="input-group">

								<input type="text" name="q" class="form-control" placeholder="masukan id transaksi atau nama pelanggan">
								<span class="input-group-btn">
									<button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
								</span>
							</div><!-- /input-group -->
						</form>
						<br/>
					</div>
					<br/>
					<br/>
					<table style="font-size:11px" class="table table-striped">
						<tr>
							<th>#</th>
							<th>id_transaksi</th>
							<th>Nama</th>
							<th>Tanggal</th>
							<th>Total</th>
							<th>Status</th>
							<th>Bayar</th>
							<!-- <th>Kembali</th> -->
							<!-- <th>Update terakhir</th> -->
							<th style="width:200px"></th>
						</tr>						
						<?php $i=1;foreach($transaksi AS $t):?>
						<tr>
							<?php
							//status pembayaran
							if(($t['total_bayar']-$t['bayar'])<=0){//jika pembayaran telah lunas
								$status = 'lunas';
								//jika status tidak sesuai maka update status
								if($t['status']!=$status){
									//update database
									$data = array('status'=>'lunas');
									$this->db->where('id_transaksi',$t['id_transaksi']);
									$this->db->update('transaksi',$data);
								}
							}
							?>
							<td><?php echo $i;?></td>
							<td><?php echo $t['id_transaksi']?></td>
							<td><?php echo $t['nama_lengkap']?></td>
							<td><?php echo $t['tgl_transaksi']?></td>
							<td>Rp<?php echo $t['total_bayar']?>,-</td>
							<td><?php echo $t['status']?></td>
							<td>Rp<?php echo $t['bayar']?>,-</td>
							<!-- <td>Rp<?php echo $t['kembali']?>,-</td> -->
							<!-- <td>herman 12/08/2014 18:00</td> -->
							<td>
								<div class="btn-group">
									<!-- <a onclick="return confirm('Anda yakin!')" href="<?php echo site_url('kasir/transaksiUbahStatus?status=lunas&id='.$t['id_transaksi']);?>" class="btn btn-xs btn-primary">lunas</a>
									<a onclick="return confirm('Anda yakin!')" href="<?php echo site_url('kasir/transaksiUbahStatus?status=piutang&id='.$t['id_transaksi']);?>" class="btn btn-xs btn-primary">piutang</a>
								--><a title="Hapus Transaksi" onclick="return confirm('Anda yakin!')" href="<?php echo site_url('kasir/deleteTransaksi?id='.$t['id_transaksi'])?>" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-trash"></span></a>
								<a onclick="detailTransaksi(<?php echo $t['id_transaksi'];?>)" href="#detail" title="Detail Transaksi" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-list"></span></a>
								<a onclick="cekAngsuran(<?php echo $t['id_transaksi'];?>)" href="#angsuran" title="Angsuran" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-chevron-right"></span></a>
							</div>
						</td>
					</tr>
					<?php $i++;endforeach;?>
				</table>
				<?php if(empty($transaksi)){
					echo '<tr><center><h4>Data transaksi tidak ditemukan</h4></center></tr>';
				}?>
			</div>
		</div>

	</div>
</div>
</div>

<!-- Modal Angsuran-->
<div class="modal fade" id="modalAngsuran" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Cek Angsuran</h4>
			</div>
			<div id="isiAngsuran" class="modal-body">
			</div>
			<br/>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal Detail Transaksi-->
<div class="modal fade" id="modalDetailTransaksi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Detail Transaksi</h4>
			</div>
			<div id="isiDetail" class="modal-body">
			</div>
			<br/>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->