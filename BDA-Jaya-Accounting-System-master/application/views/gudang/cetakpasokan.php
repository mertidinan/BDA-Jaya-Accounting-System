<!DOCTYPE html>
<html>
<head>
	<title>Cetak Detail Pasokan</title>
	<style type="text/css">
	.mytable {
		width: 100%;border:1px solid #000;padding:5px;
	}
	.mytable2 {
		width: 100%;border:1px solid #000;padding:5px;
	}
	.mytable td,.mytable th{
		width: 50%;padding:5px;
	}
	.mytable2 td{
		padding: 5px;
	}
	</style>
</head>
<body>
<h2>DATA PASOKAN BDA-JAYA</h2>
<p>dicetak pada <?php echo date('d-m-Y h:i:s')?></p>
<hr/>
<p>laporan per 
<?php
	if($_GET['tgl']==0 && $_GET['bln']!=0 && $_GET['thn']!=0){
		echo 'Bulan '.$_GET['bln'].' Tahun : '.$_GET['thn'];
	}else if($_GET['tgl']==0 && $_GET['bln']==0 && $_GET['thn']!=0){
		echo 'Tahun : '.$_GET['thn'];
	}else{
		echo $_GET['tgl'].'/'.$_GET['bln'].'/'.$_GET['thn'];
	}
?>
</p>
<h3>Item :</h3>
<table class="mytable2">
<tr>
	<th>Nama Pemasok</th><th>Tanggal</th><th>Barang</th><th>Jumlah</th><th>Harga</th><th>Subtotal</th>
</tr>
<?php foreach($pasokan as $p):?>
	<tr><td><?php echo $p['pemasok']?></td><td><?php echo $p['tgl']?></td><td><?php echo $p['barang']?></td><td><?php echo $p['jumlah']?></td><td>Rp <?php echo  number_format($p['harga'])?></td><td>Rp <?php echo number_format($p['subtotal'])?></td></tr>
<?php endforeach;?>
</table>
</body>
</html>