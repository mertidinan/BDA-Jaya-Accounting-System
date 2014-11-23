<script type="text/javascript">
	$(function(){
		$('#selectbln').val('<?php echo $bulan;?>');
		$('#selectthn').val('<?php echo $tahun;?>');
	});	
	function addPengeluaran(){
		$('#addpengeluaran').toggle('fast');
	}
	function addPemasukan(){
		$('#addpemasukan').toggle('fast');
	}
</script>
<div class="container">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="#">Admin</a></li>
			<li class="active">Penjurnalan</li>
		</ol>
	</div>
</div>
<div class="container">
	<?php $this->load->view('admin/menu')?>
	<div class="col-md-10">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Barang</h3>
				</div>
				<div class="panel-body">
					<!-- menu -->
					<div class="col-md-6">
						<!-- <strong>Buku Kas per : <?php echo $bulan.'/'.$tahun;?></strong> -->
						<a title="menampilkan buku kas untuk bulan ini" href="<?php echo site_url('dashboard/jurnal')?>" class="btn btn-primary btn-sm">Hari Ini</a>
					</div>
					<div class="col-md-6">
						<span><form style="float:right" class="form-inline" action="<?php echo site_url('dashboard/jurnal?act=sort')?>" method="get">

							<div class="form-group">
								<label class="sr-only" for="exampleInputEmail2">Email address</label>
								<select id="selectbln" name="bln" class="input-sm form-control">
									<option value="1">Januari</option>
									<option value="2">Februari</option>
									<option value="3">Maret</option>
									<option value="4">April</option>
									<option value="5">Mei</option>
									<option value="6">Juni</option>
									<option value="7">Juli</option>
									<option value="8">Agustus</option>
									<option value="9">September</option>
									<option value="10">Oktober</option>
									<option value="11">Nopember</option>
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
						<div class="col-md-12">
							<?php $jurnalmerge = array_merge($pemasukan_bln_ini,$pengeluaran_bln_ini);
						//sortir berdasarkan tanggal
							function sort_array_by_value($key, &$array) {
								$sorter = array();
								$ret = array();
								reset($array);
								foreach($array as $ii => $value) {
									$sorter[$ii] = $value[$key];
								}
								asort($sorter);
								foreach($sorter as $ii => $value) {
									$ret[$ii] = $array[$ii];
								}
								$array = $ret;
							}
							sort_array_by_value('tanggal',$jurnalmerge);
							?>
							<strong>Akun : Kas</strong>
							<table class="table table-striped">
							<tr>
								<th>Tanggal</th>
								<th>Keterangan</th>
								<th>Ref</th>
								<th>Debet (Rp)</th>
								<th>Kredit (Rp)</th>
								<th>D/K</th>
								<th>Saldo (Rp)</th>
							</tr>
							<?php $saldo = 0;foreach($jurnalmerge as $jurnal):?>
								<tr>
									<td><?php echo date('d',strtotime($jurnal['tanggal']))?></td>
									<td><?php echo $jurnal['keterangan']?></td>
									<td></td>
									<td><?php if($jurnal['det']=='masuk'){echo $this->cart->format_number($jurnal['rp']);$saldo=$saldo+$jurnal['rp'];}?></td>
									<td><?php if($jurnal['det']=='keluar'){echo $this->cart->format_number($jurnal['rp']);$saldo=$saldo-$jurnal['rp'];}?></td>
									<td>D</td>
									<td><?php echo number_format($saldo);?></td>
								</tr>
							<?php endforeach;?>
							<?php
							$akhir31 = array(1,3,5,7,8,10,12);
							//perhitungan gaji pegawai
							if($bulan == 2 && $tahun%4 == 0) {
								$tgl = 29;
							} else if($bulan == 2 && $tahun%4 != 0) {
								$tgl = 28;
							} else if(in_array($bulan, $akhir31)) {
								$tgl = 31;
							} else {
								$tgl = 30;
							} 
							?>
							<?php if($total_gaji != 0){
							$totalgaji = $total_gaji * 30000;?>
							<tr>
								<td><?php echo $tgl?></td>
								<td><?php echo 'Pemberian gaji';?></td>
								<td></td>
								<td></td>
								<td><?php echo $this->cart->format_number($totalgaji);?></td>
								<td>D</td>
								<td><?php echo number_format($saldo-$totalgaji)?></td>
							</tr>
							<?php }?>
							</table>
							</div>
						</div>
						<div class="col-md-12">
							<br/><br/>
							<hr/>
						</div>				
					</div>
				</div>

			</div>
		</div>
	</div>
