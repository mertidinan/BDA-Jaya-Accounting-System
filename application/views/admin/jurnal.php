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
						<table class="table table-striped">
							<tr>
								<th>Tgl</th>
								<th>Keterangan</th>
								<th>Ref</th>
								<th>Debit</th>
								<th>Kredit</th>
							</tr>
							<?php $totaldebit=0;$totalkredit=0;?>
							<?php $jurnal = array('masuk'=>$pemasukan_bln_ini,'keluar'=>$pengeluaran_bln_ini);print_r($jurnal);?>
							<?php foreach($pemasukan_bln_ini as $masuk):?>
								<?php foreach($pengeluaran_bln_ini as $keluar):?>
									<tr>
										<td><?php echo date('d',strtotime($masuk['tanggal']));?></td>
										<td><?php echo 'kas<br/><span style="padding-left:2em"></span>'.$masuk['keterangan'];?></td>
										<td></td>
										<td><?php echo 'Rp '.$masuk['rp'].'<br/>'?></td>
										<td><?php echo '<br/>'.'Rp '.$masuk['rp'].',-'?></td>
									</tr>
									
									<tr>
										<td><?php echo date('d',strtotime($keluar['tanggal']));?></td>
										<td><?php echo $keluar['keterangan'].'<br/><span style="padding-left:2em"></span>kas';?></td>
										<td></td>										
										<td><?php echo '<br/>'.'Rp '.$keluar['rp']?></td>
										<td><?php echo 'Rp '.$keluar['rp'].',-<br/>'?></td>
									</tr>	
																									
								<?php endforeach;?>								
							<?php endforeach;?> 
							<tr>
									<td></td>
									<td></td>
									<td></td>
									<td><strong>Rp <?php echo $totaldebit;?> </strong></td>
									<td><strong>Rp <?php echo $totalkredit;?> </strong></td>
								</tr>
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
