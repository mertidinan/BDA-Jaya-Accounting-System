<div class="container">

	<div class="col-md-offset-3 col-md-6 col-md-offset-1">
		<h1>Absensi Karyawan</h1>
		<h5>Absensi untuk tanggal : <?php echo date('d-m-Y')?></h5>
		<hr/>
		<form method="POST" action="<?php echo site_url('absensi?act=absen');?>" class="form-inline" role="form">
			<?php if(!empty($_GET['note'])){
				echo '<div class="alert alert-success">'.$_GET['note'].'</div>';	
			} else if(!empty($_GET['error'])){
				echo '<div class="alert alert-danger">'.$_GET['error'].'</div>';	; 
			}?>
			<small> *)Satu karyawan dalam satu hari hanya diperbolehkan untuk absensi sebanyak satu kali</small>
			<br/>
			<small> *)Salah memasukan data, silahkan hapus dengan memasukan username dan klik hapus absen</small>
			<br/>
			<div class="form-group">
				<label class="sr-only" for="inputUsername">Email address</label>
				<input type="text" class="form-control" name="inputUsername" id="inputUsername" placeholder="masukan username">
			</div>
			<button type="submit" name="btnAbsen" class="btn btn-default">Absen</button>
			<button onclick="return confirm('Yakin lo!')" type="submit" name="btnHapus" class="btn btn-alert">Hapus Absen</button>
		</form>
		<br/>
		<hr/>
		<h4>Data Absensi</h4>
		<table class="table table-striped">
		<?php foreach($absenToday as $a):?>
		<tr>
		<td><?php echo $a['name']?></td>
		<td><?php echo $a['tgl']?></td>
		</tr>
		<tr>
		<?php endforeach;?>
		</table>
	</div>
</div>