<script type="text/javascript">

</script>
<div class="container">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="#">Kasir</a></li>
			<li class="active">Transaksi Baru</li>
		</ol>
	</div>
</div>
<div class="container">
	<?php $this->load->view('kasir/menu')?>
	<center>
	<div class="col-md-10">
		<div class="col-md-12"><center><h3>Transaksi Tersimpan</h3></center></div>
		<div class="col-md-offset-3 col-md-3">
			<a class="btn btn-primary btn-lg" href="<?php echo site_url('kasir/transaksiBaru')?>">Transaksi Baru</a>
		</div>
		<div class="col-md-3">
			<a class="btn btn-primary btn-lg" href="#">Cetak Bukti</a>
		</div>
	</div>
	</center>
</div>
