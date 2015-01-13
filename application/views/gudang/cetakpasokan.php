<!DOCTYPE html>
<html>
<head>
	<title>Cetak Detail Pasokan</title>
	<style type="text/css">
	.mytable {
		width: 400px;border:1px solid #000;padding:5px;
	}
	.mytable2 {
		width: 600px;border:1px solid #000;padding:5px;
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
<h3>Detail :</h3>
<table class="mytable">
<tr><td><strong>tanggal pasokan</strong></td><td><?php echo $detpasokan['tgl'];?></td></tr>
<tr><td><strong>id pemasok</strong></td><td><?php echo $detpasokan['pemasok'];?></td></tr>
<tr><td><strong>Total Harga</strong></td><td>Rp <?php echo number_format($detpasokan['rp']);?></td></tr>
<tr><td><strong>Total Bayar</strong></td><td>Rp<?php echo number_format($detpasokan['rp_bayar']);?></td></tr>
<tr><td><strong>Status</strong></td><td><?php if($detpasokan['rp_bayar']>$detpasokan['rp']){echo 'lunas';}else{echo 'hutang';}?></td></tr>
</table>
<br/>
<h3>Item :</h3>
<table class="mytable2">
<tr>
	<th>Barang</th><th>Jumlah</th><th>Harga Beli</th><th>Total Harga Beli</th>
</tr>
<?php foreach($pasokanitem as $pa):?>
	<tr><td><?php echo $pa['barang']?></td><td><?php echo $pa['jumlah']?></td><td><?php echo $pa['harga_beli']?></td><td><?php echo $pa['subtotal_beli']?></td></tr>
<?php endforeach;?>
</table>
</body>
</html>