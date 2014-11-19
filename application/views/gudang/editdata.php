<div class="container">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="#">Gudang</a></li>
			<li><?php echo $act;?></li>
			<li class="active">Edit</li>
		</ol>
	</div>
</div>
<div class="container">
	<?php $this->load->view('gudang/menu')?>
	<div class="col-md-5">
		<!-- form edit data -->
		
		<?php if(!empty($kategori)){?>
		<h4>Edit Kategori</h4>
		<form action="<?php echo site_url('gudang/proses_editdata');?>" method="POST" role="form">
			<input name="id" type="hidden" value="<?php echo $item['id_kat_barang'];?>">
			<div class="form-group">
				<label for="exampleInputEmail1">Nama :</label>
				<input name="nama" type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $item['des_kat_barang'];?>" placeholder="Masukan Nama Baru">
			</div>
			<button name="btn_kategori" type="submit" class="btn btn-default">Update</button>
		</form>
		<?php } else { ?>
		<h4>Edit Pemasok</h4>
		<form action="<?php echo site_url('gudang/proses_editdata');?>" method="POST"  role="form">
			<input name="id" type="hidden" value="<?php echo $item['id_pemasok'];?>">
			<div class="form-group">
				<label for="exampleInputEmail1">Nama :</label>
				<input name="nama" type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $item['nama'];?>" placeholder="Masukan Nama Baru">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Alamat :</label>
				<input name="alamat" type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $item['alamat'];?>" placeholder="Masukan Nama Baru">
			</div>
			<button name="btn_pemasok" type="submit" class="btn btn-default">Update</button>
		</form>
		<?php } ?>
	</div>
</div>
