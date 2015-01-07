<div class="container">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="#">Kasir</a></li>
			<li class="active">Tambah Pengeluaran</li>
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
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Daftar Pelanggan</h3>
				</div>
				<div class="panel-body">
					<a href="#tambah" data-toggle="modal" class="btn btn-primary">Tambah Pelanggan</a><br/><br/>
					<?php
					if(!empty($_GET['act'])){
						switch ($_GET['act']) {
							case 'edit':
							?>
							<form action="<?php echo site_url('kasir/editpelanggan?act=procedit')?>" method="POST" class="form-horizontal" role="form">
								<div class="form-group">
									<label for="inputEmail1" class="col-lg-2 control-label">Nama Lengkap</label>
									<div class="col-lg-10">
									<input type="text" value="<?php echo $editpelanggan['nama_lengkap']?>" name="input_nama" class="form-control" id="inputEmail1">
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail1" class="col-lg-2 control-label">alamat</label>
									<div class="col-lg-10">
										<input type="text" value="<?php echo $editpelanggan['alamat']?>" name="input_alamat" class="form-control" id="inputEmail1">
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail1" class="col-lg-2 control-label">kontak</label>
									<div class="col-lg-10">
										<input type="number" value="<?php echo $editpelanggan['kontak']?>" name="input_kontak" class="form-control" id="inputEmail1">
									</div>
								</div>
								<input type="hidden" name="input_id" value="<?php echo $editpelanggan['id_pelanggan']?>">
								<div class="form-group">
									<label for="inputEmail1" class="col-lg-2 control-label"></label>
									<div class="col-lg-10">
										<button class="btn" type="submit" >Update</button>
									</div>
								</div>
							</form>
							<?php
							break;
							
							default:
							echo 'get out hacker!';
							break;
						}
					}
					?>
					<table class="table">
						<tr>
							<th>id</th>
							<th>Nama Lengkap</th>
							<th>Alamat</th>
							<th>No telp/hp</th>
							<th>tgl daftar</th>
							<th></th>
						</tr>
						<?php 
						if(empty($pelanggan)){
							echo '<tr><td colspan="6"><center><h3>haha gak punya pelangan</h3></center></td></tr>';
						}else{
							foreach($pelanggan as $p):?>
							<tr>
								<td><?php echo $p['id_pelanggan']?></td>
								<td><?php echo $p['nama_lengkap']?></td>
								<td><?php echo $p['alamat']?></td>
								<td><?php echo $p['kontak']?></td>
								<td><?php echo $p['tgl_daftar']?></td>
								<td><a onclick="return confirm('yakinkah!')" class="btn btn-xs" href="<?php echo site_url('kasir/hapuspelanggan?id='.$p['id_pelanggan'])?>">delete</a><a class="btn btn-xs" href="<?php echo site_url('kasir/editpelanggan?act=edit&id='.$p['id_pelanggan'])?>">update</a></td>
							</tr>
						<?php endforeach;
					}?>
				</table>
			</div>
		</div>

	</div>
</div>
</div>
<!-- modal tambah pelanggan -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah Pelanggan</h4>
			</div>
			<div class="modal-body">
				<form action="<?php echo site_url('kasir/tambahpelanggan')?>" method="POST" class="form-horizontal" role="form">
					<div class="form-group">
						<label for="inputEmail1" class="col-lg-2 control-label">Nama Lengkap</label>
						<div class="col-lg-10">
							<input type="text" name="input_nama" class="form-control" id="inputEmail1">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail1" class="col-lg-2 control-label">alamat</label>
						<div class="col-lg-10">
							<input type="text" name="input_alamat" class="form-control" id="inputEmail1">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail1" class="col-lg-2 control-label">kontak</label>
						<div class="col-lg-10">
							<input type="number" name="input_kontak" class="form-control" id="inputEmail1">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">tambah</button>
				</form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
  </div><!-- /.modal -->