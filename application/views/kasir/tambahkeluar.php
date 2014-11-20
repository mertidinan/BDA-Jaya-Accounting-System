<div class="container">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="#">Kasir</a></li>
			<li class="active">Tambah Pengeluaran</li>
		</ol>
	</div>
</div>
<div class="container">
	<?php $this->load->view('kasir/menu')?>
	<div class="col-md-10">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Tambah Pengeluaran</h3>
				</div>
				<div class="panel-body">
					<!-- form untuk tambah pegeluaran -->
					<form method="POST" action="<?php echo site_url('admin/tambah_pengeluaran');?>" role="form" class="col-md-4 form">
						<div class="form-group">
							<label for="inputketerangan">Keterangan</label>
							<textarea name="inputKeterangan" class="form-control" id="inputketerangan" placeholder="Masukan Keterangan"></textarea>
						</div>
						<div class="form-group">
							<label for="inputkategori">Kategori</label>
							<select name="inputKategori" class="form-control" id="inputkategori">
								<?php foreach($kategorikeluar as $kk):?>
									<?php if($kk['id_kat_pengeluaran'] == 7 || $kk['id_kat_pengeluaran'] == 9){ ?>
										<option value="<?php echo $kk['id_kat_pengeluaran'];?>"><?php echo $kk['det_kat_pengeluaran'];?></option>
									<?php } ?>
								<?php endforeach;?>								
							</select>
						</div>
						<div class="form-group">
							<label for="inputjumlah">Jumlah</label>
							<div class="input-group">
								<span class="input-group-addon">Rp</span><input name="inputJumlah" type="number" class="form-control" id="inputjumlah" placeholder="Jumlah tanpa titik" required><span class="input-group-addon">.00</span>
							</div>
						</div>
						<div class="form-group">
							<label for="inputstatus">Status</label>
							<select name="inputStatus" class="form-control" id="inputstatus" required>
								<option value="lunas">Lunas</option>
							</select>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Tambah Pengluaran</button>
						</div>
					</form>
				</div>
			</div>

		</div>
	</div>
</div>
