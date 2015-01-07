<script type="text/javascript">
	function checkBayar(){ //auto cek kembalian ketika proses pembayaran
		var total = <?php echo $this->cart->total();?>;
		var bayar = $('#txtbayar').val();
		var kembali = bayar - total;
		$('#txtkembali').val(kembali);
	}
	function checkBarang(){//cek stok barang digudang
		$('#resultbarang').html('<i>cek ketersediaan...</i>');
		var kode = $('#inputKode').val();//kode barang yang dimasukan
		//alert(kode);
		$.ajax({
			type:'GET',
			url:'<?php echo site_url("gudang/cekBarang?kode=")?>'+kode,
			success:function(response){
				$('#resultbarang').html('<p> Stok = '+response+'</p>');
				$('#inputJumlah').max(response); //set max value on input jumlah [not working]
			}
		});
	}
</script>
<div class="container">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="#">Kasir</a></li>
			<li class="active">Tambah Pasokan</li>
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
			<form method="post" action="<?php echo site_url('gudang/tambah_pasokan')?>" class="form-horizontal" role="form">
				<div class="form-group">
					<p style="color:red">Jika kode barang belum terdaftar, silahkan masukan datanya di menu barang</p>
					<label for="inputKode" class="col-lg-2 control-label">Kode Barang :</label>
					<div class="col-lg-5">
						<input onkeyup="checkBarang()" name="inputKode" type="text" class="form-control" id="inputKode" placeholder="Kode barang" required>
					</div>
					<span id="resultbarang"></span>
				</div>
				<div class="form-group">
					<label for="inputJumlah" class="col-lg-2 control-label">Jumlah :</label>
					<div class="col-lg-5">
						<input name="inputJumlah" min="1" max="" type="number" class="form-control" id="inputJumlah" placeholder="Jumlah barang" required>
					</div>
				</div>
				<div class="form-group">
					<label for="inputJumlah" class="col-lg-2 control-label">Harga Beli/u :</label>
					<div class="col-lg-5">
						<input name="inputHargaBeli" min="1" max="" type="number" class="form-control" id="inputJumlah" placeholder="Jumlah barang" required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-offset-2 col-lg-9">
						<button type="submit" class="btn-sm btn btn-default">+ Tambah</button>
					</div>
				</div>
			</form>
		</div>
		<div class="col-md-12">
			<hr>
			<table style="font-size:12px" class="table table-striped">
				<tr>
					<th>#</th>
					<th>Kode</th>
					<th>Nama</th>
					<th>q</th>
					<th>Harga Beli/unit</th>
					<th>Subtotal </th>
					<th>Harga Jual/unit</th>
					<th></th>
				</tr>
				<?php $i=1;foreach($this->cart->contents() as $item):?>
				<tr>
					<td><?php echo $i;?></td>
					<td><?php echo $item['id'];?></td>
					<td><?php echo $item['name'];?></td>
					<td><?php echo $item['qty'];?></td>
					<td>Rp <?php echo $this->cart->format_number($item['price']);?> ,-</td>
					<td>Rp <?php echo $this->cart->format_number($item['subtotal']);?> ,-</td>
					<td>Rp <?php echo $this->cart->format_number($item['price'] + ($item['price'] * 0.01)).',-'; ?></td>
					<td><a title="hapus list" class="btn btn-default btn-xs" href="<?php echo site_url('gudang/hapusCart?id='.$item['rowid'])?>">x</a></td>
					
				</tr>
				<?php $totalbayar = $item['subtotal'] + $item['subtotal'];$i++;endforeach;?>
			</table>
			<hr>
		</div>
		<div class="col-md-6">
			<strong>Total Bayar</strong>
			<h2 style="margin-top:0px">Rp <?php echo $this->cart->format_number($this->cart->total());?> ,-</h2>
		</div>
		<div class="col-md-6">
			<form method="POST" action="<?php echo site_url('gudang/proses_tambah_stok')?>" class="form-horizontal" role="form">
				<div class="form-group">
					<label for="inputKode" class="col-lg-3 control-label">Pemasok : </label>
					<div class="col-lg-8">
						<select name="inputPemasok" id="inputPemasok" class="form-control" required>
							<option value="">Pemasok</option>
							<?php foreach($pemasok as $p):?>
								<option value="<?php echo $p['id_pemasok']?>"><?php echo $p['nama']?></option>							
							<?php endforeach;?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="inputKode" class="col-lg-3 control-label">Cash :</label>
					<div class="col-lg-8">
						<input name="inputBayar" onkeyup="checkBayar()" id="txtbayar" type="number" class="form-control" id="inputKode" placeholder="Bayar Rp." required>
					</div>
				</div>
				<div class="form-group">
					<label for="inputJumlah" class="col-lg-3 control-label">Kembali :</label>
					<div class="col-lg-8">
						<input name="inputKembali" id="txtkembali" type="number" class="form-control" id="inputJumlah" placeholder="Kembali Rp." required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-offset-3 col-lg-9">
						<button name="btn_bayar" type="submit" class="btn-sm btn btn-default">Bayar</button>
						<button name="btn_hutang" type="submit" class="btn-sm btn btn-default">Hutang</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
