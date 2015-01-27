<div class="container">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="#">Admin</a></li>
			<li class="active">kategori Masuk/Keluar</li>
		</ol>
	</div>
</div>
<div class="container">
	<?php $this->load->view('admin/menu')?>
	<div class="col-md-10">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Kategori Kas</h3>
				</div>
				<div class="panel-body">
					<?php if($this->input->get('act') == 'editmasuk') { ?>
					<h4>Edit Kategori Pemasukan</h4>
					<form method="POST" action="<?php echo $action;?>" class="col-md-6 form-horizontal" role="form">
						<input type="hidden" name="id" value="<?php echo $edit['id_kat_masuk']?>">
						<div class="form-group">
							<label for="inputPassword1" class="col-lg-2 control-label">Nama Kategori</label>
							<div class="col-lg-10">
								<input type="text" name="nama" class="form-control" value="<?php echo $edit['det_kat_masuk']?>">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-offset-1 col-lg-10">
							<button type="submit" class="btn btn-default">Update</button>
						</div>
					</div>
				</form>
				<?php } else if($this->input->get('act') == 'editkeluar') { ?>
				<h4>Edit Kategori Pengeluaran</h4>
				<form method="POST" action="<?php echo $action;?>" class="col-md-6 form-horizontal" role="form">
				<input type="hidden" name="id" value="<?php echo $edit['id_kat_pengeluaran']?>">
					<div class="form-group">
						<label for="inputPassword1" class="col-lg-2 control-label">Nama Kategori</label>
						<div class="col-lg-10">
							<input type="text" name="nama" class="form-control" value="<?php echo $edit['det_kat_pengeluaran'] ?>">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-offset-1 col-lg-10">
						<button type="submit" class="btn btn-default">Update</button>
					</div>
				</div>
			</form>
			<?php } else { ?>
			<h4>Tambah Kategori Baru</h4>
			<form method="POST" action="<?php echo site_url('dashboard/kategori_kas?act=tambahkategori');?>" class="col-md-6 form-horizontal" role="form">
				<div class="form-group">
					<label for="inputPassword1" class="col-lg-2 control-label">Kategori Untuk</label>
					<div class="col-lg-10">
						<select class="form-control" name="kategori_untuk">
							<option value="masuk">Pemasukan</option>
							<option value="keluar">Pengeluaran</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="inputPassword1" class="col-lg-2 control-label">Nama Kategori</label>
					<div class="col-lg-10">
						<input type="text" name="input_nama" class="form-control">
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-offset-1 col-lg-10">
					<button type="submit" class="btn btn-default">+ Tambah</button>
				</div>
			</div>
		</form>
		<?php } ?>					
		<br/>
		<hr/>
		<div class="row">
			<div class="col-md-6">
				<strong>Kategori Pemasukan</strong><br/>
				<table class="table table-striped">
					<tr>
						<th>Id</th>
						<th>Kategori</th>
						<th></th>
					</tr>
					<?php foreach($katMasuk as $km):?>
						<tr>
							<td><?php echo $km['id_kat_masuk'];?></td>
							<td><?php echo $km['det_kat_masuk'];?></td>
							<td>
								<?php if($km['id_kat_masuk'] != 2){?>
								<a onclick="return confirm('yakin!')" href="<?php echo site_url('dashboard/kategori_kas?act=hapusmasuk&id='.$km['id_kat_masuk'])?>">hapus</a> | <a href="<?php echo site_url('dashboard/kategori_kas?act=editmasuk&id='.$km['id_kat_masuk'])?>">edit</a>
								<?php } ?>	
							</td>
						</tr>
					<?php endforeach;?>
				</table>
			</div>
			<div class="col-md-6">
				<strong>Kategori Pengeluaran</strong><br/>
				<table class="table table-striped">
					<tr>
						<th>Id</th>
						<th>Kategori</th>
						<th></th>
					</tr>
					<?php foreach($katKeluar as $kk):?>
						<tr>
							<td><?php echo $kk['id_kat_pengeluaran'];?></td>
							<td><?php echo $kk['det_kat_pengeluaran'];?></td>
							<td>
								<?php if($kk['id_kat_pengeluaran'] != 6){?>
								<a onclick="return confirm('yakin!')" href="<?php echo site_url('dashboard/kategori_kas?act=hapuskeluar&id='.$kk['id_kat_pengeluaran'])?>">hapus</a> | <a href="<?php echo site_url('dashboard/kategori_kas?act=editkeluar&id='.$kk['id_kat_pengeluaran'])?>">edit</a>
								<?php } ?>
							</td>									
						<?php endforeach;?>
					</table>
				</div>
			</div>								
		</div>
	</div>

</div>
</div>
</div>
