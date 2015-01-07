<script type="text/javascript">
	function checkBayar(){ //auto cek kembalian ketika proses pembayaran
		var total = <?php echo $this->cart->total();?>;
		var bayar = $('#txtbayar').val();
		var kembali = bayar - total;
		$('#txtkembali').val(kembali);
	}
	function checkBarang(){//cek stok barang digudang
		$('#resultbarang').show();//show
		$('#resultbarang').html('<i>cek ketersediaan...</i>');
		var kode = $('#inputKode').val();//kode barang yang dimasukan
		//alert(kode);
		$.ajax({
			type:'GET',
			url:'<?php echo site_url("kasir/cekBarang?kode=")?>'+kode,
			success:function(response){
				$('#resultbarang').html(response);
				// $('#inputJumlah').max(); //set max value on input jumlah [not working]
			}
		});
	}
	//add barang
	function addBarang(x){
		$('#resultbarang').hide();//hide result barang
		$('#inputKode').val(x);//new value
	}
	//check pelanggan
	function checkPelanggan(){
		$('#pilihannama').show();//show pilihan nama tag
		nama = $('#txtpelanggan').val();//ambil nama pelanggan yang diinputkan
		if(nama == ''){
			$('#txtpelanggan').val() = '';
			$('#pilihannama').hide();//show pilihan nama tag
		}else{
			$.ajax({
				type:'GET',
				url:'<?php echo site_url("kasir/cek_pelanggan")?>',
				data:{nama:nama},
				success:function(response){
					$('#pilihannama').html(response);
				},
				error:function(response){
					alert('sistem bermasalah, silahkan refresh halaman');
				}
			});
		}		
	}
	//add pelanggan to input
	function addPelanggan(x,y){//x = id pelanggan y = nama pelanggan
		$('#pilihannama').hide();//hide pilihan nama tag
		$('#txtpelanggan').val(y);
		$('#txtIdPelanggan').val(x);
	}
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
	<?php 
	if($this->session->userdata('kasir_logged_in')){
		$this->load->view('kasir/menu');
	}else if($this->session->userdata('admin_logged_in')){
		$this->load->view('admin/menu');
	}
	?>
	<div class="col-md-10">
		<div class="col-md-12">
			<form method="post" action="<?php echo site_url('kasir/transaksiBaru')?>" class="form-horizontal" role="form">
				<div class="form-group">
					<label for="inputKode" class="col-lg-2 control-label">Kode Barang :</label>
					<div class="col-lg-5">
						<input name="inputKode" onkeyup="checkBarang()" type="text" class="form-control" id="inputKode" placeholder="masukan kode atau nama barang" required><span class="col-md-2"></span>
					</div>
					<button class="btn btn-default" onclick="checkBarang()">cari</button>
				</div>
				<div style="display:none;height:200px;overflow-y:auto" id="resultbarang" class="col-md-12"></div>
				<div class="form-group">
					<label for="inputJumlah" class="col-lg-2 control-label">Jumlah :</label>
					<div class="col-lg-5">
						<input name="inputJumlah" min="1" max="" type="number" class="form-control" id="inputJumlah" placeholder="Jumlah barang" required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-offset-2 col-lg-9">
						<button type="submit" class="btn-sm btn btn-default">Order</button>
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
					<th>Harga</th>
					<th>Subtotal</th>
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
					<td><a title="hapus list" class="btn btn-default btn-xs" href="<?php echo site_url('kasir/hapusCart?id='.$item['rowid'])?>">x</a></td>
					
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
			<form method="POST" action="<?php echo site_url('kasir/prosesTransaksi')?>" class="form-horizontal" role="form">
				<div class="form-group">
					<label for="inputKode" class="col-lg-3 control-label">Pelanggan :</label>
					<div class="col-lg-8">
						<input name="inputPelanggan" onkeyup="checkPelanggan()" id="txtpelanggan" type="text" class="form-control" placeholder="nama pelanggan" required>
						<input type="hidden" name="inputIdPelanggan" id="txtIdPelanggan" type="number" class="form-control" required>
						<div id="pilihannama"></div>
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
