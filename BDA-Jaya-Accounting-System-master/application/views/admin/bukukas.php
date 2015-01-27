<script type="text/javascript">
	$(function(){
		$('#selectbln').val('<?php echo $bulan;?>');
		$('#selectthn').val('<?php echo $tahun;?>');
		$('#selecttgl').val('<?php echo $tanggal;?>');
	});	
	function addPengeluaran(){
		$('#addpengeluaran').toggle('fast');
	}
	function addPemasukan(){
		$('#addpemasukan').toggle('fast');
	}
	function changedate(x){
		$('#selecttgl').val('00');
	}
</script>
<div class="container">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="#">Admin</a></li>
			<li class="active">Kas</li>
		</ol>
	</div>
</div>
<div class="container">
	<?php $this->load->view('admin/menu')?>
	<div class="col-md-10">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">kategori Kas</h3>
				</div>
				<div class="panel-body">
					<!-- menu -->
					<div class="col-md-6">
						<!-- <strong>Buku Kas per : <?php echo $bulan.'/'.$tahun;?></strong> -->
						<a title="menampilkan buku kas untuk bulan ini" href="<?php echo site_url('dashboard/bukukas')?>" class="btn btn-primary btn-sm">Hari Ini</a>
					</div>
					<div class="col-md-6">
						<span><form style="float:right" class="form-inline" action="<?php echo site_url('dashboard/bukukas?act=sort')?>" method="get">

							<div class="form-group">
								<label class="sr-only" for="exampleInputEmail2">Email address</label>
								<select id="selecttgl" name="tgl" class="input-sm form-control">
									<option value='00'>Semua Tanggal</option>
									<?php for($x=1;$x<=31;$x++){
									if($x<10){
										$x = '0'.$x;
									}
									?>
									<option value="<?php echo $x;?>"><?php echo $x;?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label class="sr-only" for="exampleInputEmail2">Email address</label>
								<select id="selectbln" name="bln" class="input-sm form-control">
									<option onchange="changedate(00)" value="00">Semua Bulan</option>
									<option value="01">Januari</option>
									<option value="02">Februari</option>
									<option value="03">Maret</option>
									<option value="04">April</option>
									<option value="05">Mei</option>
									<option value="06">Juni</option>
									<option value="07">Juli</option>
									<option value="08">Agustus</option>
									<option value="09">September</option>
									<option value="10">Oktober</option>
									<option value="11">November</option>
									<option value="12">Desember</option>
								</select>
							</div>
							<div class="form-group">
								<label class="sr-only" for="exampleInputPassword2">Password</label>
								<select id="selectthn" name="thn" class="input-sm form-control">
									<option value="2014">2014</option>
									<option value="2015">2015</option>
									<option value="2016">2016</option>
									<option value="2017">2017</option>
									<option value="2018">2018</option>
								</select>
							</div>
							<button type="submit" class="btn btn-sm btn-default">show</button>
						</form></span>
					</div>
					<br/>
					<br/>
					<div class="row">
						<div class="col-md-6">
							<h5>Pemasukan <a href="#" onclick="addPemasukan()" class="btn-xs btn btn-default">+</a></h5>
							<div style="display:none" id="addpemasukan" class"adduang">
								<form method="POST" action="<?php echo site_url('admin/admin_tambah_pemasukan');?>" class="formkas form-horizontal" role="form">
									<div class="form-group">
										<label for="inputEmail1" class="col-lg-2 control-label">Ket</label>
										<div class="col-lg-10">
											<textarea name="inputKet" class="form-control"></textarea>
										</div>
									</div>
									<div class="form-group">
										<label for="inputPassword1" class="col-lg-2 control-label">Kategori</label>
										<div class="col-lg-10">
											<select name="inputKat" class="form-control">
												<?php foreach($kategori_pemasukan as $km):?>
												<option value="<?php echo $km['id_kat_masuk']?>"><?php echo $km['det_kat_masuk']?></option>
												<?php endforeach;?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="inputPassword1" class="col-lg-2 control-label">Rp</label>
										<div class="col-lg-10">
											<input name="inputRp" type="number" class="form-control" id="inputPassword1" placeholder="Jumlah, masukan angka tanpa '.'">
										</div>
									</div>
									<div class="form-group">
										<div class="col-lg-offset-2 col-lg-10">
											<button type="submit" class="btn btn-default">Tambah</button>
										</div>
									</div>
								</form>
							</div>
							<table class="table table-striped">
								<tr>
									<th>Tgl</th>
									<th>Keterangan</th>
									<th>Kategori</th>
									<th>Status</th>
									<th>Rp</th>
								</tr>
								<?php $totmasuk = 0;foreach($pemasukan as $masuk):?>
								<tr>
									<td><?php echo $masuk['tanggal']?></td>
									<td><?php echo $masuk['keterangan']?></td>
									<td><?php echo $masuk['kategori']?></td>
									<td><?php echo $masuk['status']?></td>
									<td>Rp<?php echo $masuk['rp']?>,-</td>
								</tr>
								<?php $totmasuk = $totmasuk+$masuk['rp'];endforeach;?>
							</table>
						</div>
						<div class="tabel-pengeluaran col-md-6">
							<h5>Pengeluaran <a onclick="addPengeluaran()" href="#" class="btn-xs btn btn-default">+</a></h5>
							<div style="display:none" id="addpengeluaran" class"adduang">
								<form method="POST" action="<?php echo site_url('admin/admin_tambah_pengeluaran');?>" class="formkas form-horizontal" role="form">
									<div class="form-group">
										<label for="inputEmail1" class="col-lg-2 control-label">Ket</label>
										<div class="col-lg-10">
											<textarea name="inputKet" class="form-control"></textarea>
										</div>
									</div>
									<div class="form-group">
										<label for="inputPassword1" class="col-lg-2 control-label">Kategori</label>
										<div class="col-lg-10">
											<select name="inputKat" class="form-control">
												<?php foreach($kategori_pengeluaran as $kk):?>
												<option value="<?php echo $kk['id_kat_pengeluaran']?>"><?php echo $kk['det_kat_pengeluaran']?></option>
												<?php endforeach;?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="inputPassword1" class="col-lg-2 control-label">Rp</label>
										<div class="col-lg-10">
											<input name="inputRp" type="number" class="form-control" id="inputPassword1" placeholder="Jumlah, masukan angka tanpa '.'">
										</div>
									</div>
									<div class="form-group">
										<div class="col-lg-offset-2 col-lg-10">
											<button type="submit" class="btn btn-default">Tambah</button>
										</div>
									</div>
								</form>
							</div>
							<table class="table table-striped">
								<tr>
									<th>Tgl</th>
									<th>Keterangan</th>
									<th>Kategori</th>
									<th>Status</th>
									<th>Rp</th>
								</tr>
								<?php $totkeluar = 0;foreach($pengeluaran as $keluar):?>
								<tr>
									<td><?php echo $keluar['tanggal']?></td>
									<td><?php echo $keluar['keterangan']?></td>
									<td><?php echo $keluar['kategori']?></td>
									<td><?php echo $keluar['status']?></td>
									<td>Rp<?php echo $keluar['rp']?>,-</td>
								</tr>								
								<?php
								//total pengeluaran bln ini
								?>
								<?php $totkeluar = $totkeluar+$keluar['rp'];endforeach;?>
							</table>
						</div>
						<?php
						$totMasukBlnIni = 0;
						$totKeluarBlnIni = 0;
						//total pengeluaran bulan ini
						foreach($pengeluaran_bln_ini as $kb):
							$totKeluarBlnIni = $totKeluarBlnIni+$kb['rp'];
						endforeach;
						//total pemasukann bulan ini
						foreach($pemasukan_bln_ini as $mb):
							$totMasukBlnIni = $totMasukBlnIni+$mb['rp'];
						endforeach;
						?>
					</div>
					<div style="text-align:right" class="col-md-6"><strong>Total : Rp<?php echo $totmasuk;?>,-</strong></div>	
					<div style="text-align:right" class="col-md-6"><strong>Total : Rp<?php echo $totkeluar;?>,-</strong></div>	

					<div class="col-md-12">
						<br/><br/>
						<hr/>
						<h4>Saldo Hari Ini : Rp<?php echo $totmasuk - $totkeluar?>,-</h4>
						<h4>Saldo Bulan Ini : Rp<?php echo $totMasukBlnIni - $totKeluarBlnIni;?>,-</h4>
					</div>				
				</div>
			</div>

		</div>
	</div>
</div>
