<?php
echo '
<p>Id: '.$detail['id_transaksi'].'</p>
<p>Tanggal : '.$detail['tgl_transaksi'].'</p>
<p>Rp.Total : '.number_format($detail['total_bayar']).',-</p>
<p>Status : '.$detail['status'].'</p>
<hr/>
<h5>Barang Yang Dibeli</h5>
<table style="width:500px;text-align:left" class="table table-striped">
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
	?>