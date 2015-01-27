<script type="text/javascript">
	function detailPasokan(x){ //x = id transaksi
		$('#modalPasokan').modal('show');
		$('#isiPasokan').html('Loading....');
		$.ajax({
			url:'<?php echo site_url("ajax/detail_pasokan?id=")?>'+x,
			success:function(data){
				$('#isiPasokan').html(data);
			},
			error:function(){
				$('#isiPasokan').html('Pemanggilan data bermasalah <br/> silahkan <strong>Refresh</strong> halaman');
			}
		});
	}
	function cekBayar(x){
		$('#modalBayar').modal('show');
		$('#isiBayar').html('Loading....');
		$.ajax({
			url:'<?php echo site_url("ajax/hutang_pasokan?id=")?>'+x,
			success:function(data){
				$('#isiBayar').html(data);
			},
			error:function(){
				$('#isiBayar').html('Pemanggilan data bermasalah <br/> silahkan <strong>Refresh</strong> halaman');
			}
		});
	}
	function bayarHutang(x){ //id_pasokan
		nominal = $('#nilai_angsuran').val();
		$.ajax({
			url:'<?php echo site_url("ajax/tambahbayar")?>',
			data:{id:x,nominal:nominal},
			success:function(data){
				cekBayar(x);
				//alert(data);
			},
			error:function(){
				alert('sistem bermasalah silahkan ulangi lagi');
			}
		});
	}
	function cetakLaporan(){//detail cetak laporan
		$('#cetakFilter').toggle('fast');
	}
</script>
<div class="container">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="#">Gudang</a></li>
			<li class="active">Pasokan</li>
		</ol>
	</div>
</div>
<div class="container">
	<?php 
	if($this->session->userdata('gudang_logged_in')){
		$this->load->view('gudang/menu');
	}else if($this->session->userdata('admin_logged_in')){
		$this->load->view('admin/menu');
	}
	?>
	<div class="col-md-10">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Pasokan</h3>
				</div>
				<div class="panel-body">
					<!-- menu -->
					<div class="col-md-6">
						<a href="<?php echo site_url('gudang/tambah_pasokan')?>" class="btn btn-primary btn-xs">+ Tambah Pasokan</a>
						<a onclick="cetakLaporan()" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-print"></span></a>
						<form action="<?php echo site_url('gudang/cetakpasokan')?>" id="cetakFilter" style="display:none;padding:5px 0" class="form-inline" role="form">
							<div class="form-group">
							<select name="tgl" class="input-sm" required>
								<option value="">Tgl</option>
								<option value="0">semua</option>
								<?php for($i=1;$i<=31;$i++){
									echo '<option value="'.$i.'">'.$i.'</option>';
								}
								?>
							</select>
							<select name="bln" class="input-sm" required>
								<option value="">Bln</option>
								<option value="0">semua</option>
								<?php for($i=1;$i<=12;$i++){
									echo '<option value="'.$i.'">'.$i.'</option>';
								}
								?>
							</select>
							<select name="thn" class="input-sm" required>
								<option value="">Thn</option>
								<?php for($i=2014;$i<=date('Y');$i++){
									echo '<option value="'.$i.'">'.$i.'</option>';
								}
								?>
							</select>
							</div>
							<button type="submit" class="btn btn-default btn-xs">cetak</button>
						</form>
						<!-- modal tambah barang -->
						<div class="col-md-12">
							<!-- form untuk tambah barang -->
							<div style="display:none" id="form-tambahbarang">
								<br/>
								<h4>Tambah Pemasok Baru</h4>
								<form method="POST" action="<?php echo site_url('gudang/tambahPemasok');?>" class="form-horizontal" role="form">
									<div class="form-group">
										<label for="inputKategori" class="col-lg-2 control-label"><small>Pemasok</small></label>
										<div class="col-lg-10">
											<input name="inputPemasok" type="text" class="input-sm form-control" id="inputKategori" placeholder="Nama Kategori Barang">
										</div>
									</div>
									<div class="form-group">
										<label for="inputKategori" class="col-lg-2 control-label"><small>Alamat dan Kontak</small></label>
										<div class="col-lg-10">
											<textarea name="inputAlamat" type="text" class="input-sm form-control" id="inputKategori" placeholder="Alamat dan kontak pemasok"></textarea>
										</div>
									</div>
									<div class="form-group">
										<div class="col-lg-offset-2 col-lg-10">
											<button name="btnTambah" type="submit" class="btn btn-primary">+ Tambah</button>
										</div>
									</div>
									<br/>
								</form>
							</div>
							<!-- end of form untuk tambah barang -->							
						</div>
					</div>
					<!-- search -->
					<div class="col-md-6">

					</div>
					<br/>
					<br/>
					<table style="font-size:11px" class="table table-striped">
						<tr>
							<th>#</th>
							<th>Id Pasokan</th>
							<th>Tanggal</th>
							<th>Pemasok</th>
							<th>Oleh</th>
							<th>Total Harga Beli</th>
							<th>Dibayar</th>
							<th>Status</th>
							<!-- <th>Update terakhir</th> -->
							<th style="width:150px"></th>
						</tr>
						<?php $i=1;foreach($pasokan AS $p):?>
						<tr>
							<td><?php echo $i;?></td>
							<td><?php echo $p['id_pasokan'];?></td>					
							<td><?php echo $p['tgl'];?></td>
							<td><?php echo $p['pemasok'];?></td>
							<td><?php echo $p['oleh'];?></td>
							<td>Rp<?php echo $p['rp'];?>,-</td>
							<td>Rp<?php echo $p['rp_bayar']?>,-</td>
							<td><?php echo $p['status'];?></td>
							<td>
								<div class="btn-group">
									<button onclick="detailPasokan(<?php echo $p['id_pasokan'];?>)" class="btn btn-xs btn-primary">Detail</button>
									<button onclick="cekBayar(<?php echo $p['id_pasokan']?>)" class="btn btn-xs btn-primary">Bayar</button>
									<a onclick="return confirm('anda yakin!')" href="<?php echo site_url('gudang/hapus_pasokan?id='.$p['id_pasokan'])?>" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-trash"></span></a>
								</div>
							</td>
						</tr>
						<?php $i++;endforeach;?>
					</table>
				</div>
			</div>

		</div>
	</div>
</div>
<!-- modal pasokan -->
<!-- Modal -->
<div class="modal fade" id="modalPasokan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Detail Pasokan</h4>
			</div>
			<div id="isiPasokan" class="modal-body">
				
				<br/>
				<br/>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="modalBayar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Detail Bayar Hutang</h4>
			</div>
			<div  id="isiBayar" class="modal-body">
				
				<br/>
				<br/>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
  </div><!-- /.modal -->