<div class="container">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="#">Admin</a></li>
			<li class="active">Stats</li>
		</ol>
	</div>
</div>
<div class="container">
	<?php $this->load->view('admin/menu')?>
	<div class="col-md-10">
		<!-- <ul class="nav nav-tabs">
				<li class="active"><a href="#">Home</a></li>
				<li><a href="#">Profile</a></li>
				<li><a href="#">Messages</a></li>
			</ul> -->
			<br/>
			<div class="col-md-6">
				<h4 class="stats-number"><div class="col-md-3"><span style="font-size:30px" class="glyphicon glyphicon-user"></span></div><div class="col-md-9">Barang<br/><?php echo $this->db->count_all('barang');?></div></h4>
			</div>
		<!-- 	<div class="col-md-4">
				<h4 class="stats-number"><div class="col-md-3"><span style="font-size:30px" class="glyphicon glyphicon-user"></span></div><div class="col-md-9">Kategori<br/><?php echo $this->db->count_all('kategori_barang');?></div></h4>
			</div> -->
			<div class="col-md-6">
				<h4 class="stats-number"><div class="col-md-3"><span style="font-size:30px" class="glyphicon glyphicon-user"></span></div><div class="col-md-9">Pemasok<br/><?php echo $this->db->count_all('pemasok');?></div></h4>
				<br/>
			</div>
			<div class="col-md-6">
				<h4 class="stats-number"><div class="col-md-3"><span style="font-size:30px" class="glyphicon glyphicon-user"></span></div><div class="col-md-9">Transaksi Hari Ini<br/><?php echo $today;?></div></h4>
			</div>
			<div class="col-md-6">
				<h4 class="stats-number"><div class="col-md-3"><span style="font-size:30px" class="glyphicon glyphicon-user"></span></div><div class="col-md-9">Total Piutang<br/><?php echo $piutang;?></div></h4>
			</div>	

			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">Aktifitas Gudang</div>
					<div class="panel-body">
						<?php foreach($gudang as $g):?>
							<p><strong><?php echo $g['activity']?></strong> Oleh <?php echo $g['pegawai']?> <span style="color:gray"><?php echo $g['tanggal'];?></span></p>
							<hr/>
						<?php endforeach;?>						
					</div>

				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">Aktifitas Kasir</div>
					<div class="panel-body">
						<?php foreach($kasir as $k):?>
							<p><strong><?php echo $k['activity']?></strong> Oleh <?php echo $k['pegawai']?> <span style="color:gray"><?php echo $k['tanggal'];?></span></p>
							<hr/>
						<?php endforeach;?>						
					</div>

				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">Terkakhir Login</div>
					<div class="panel-body">
						<?php foreach($login as $l):?>
							<div class="media">
								<!-- <a class="pull-left" href="#">
									<img style="width:40px;height:" class="media-object" src="..." alt="...">
								</a> -->
								<div class="media-body">
								<h4 class="media-heading"><?php echo $l['nama']?> </h4>
									<span color="gray">di <?php echo $l['bagian']?> pada <?php echo $l['login_log']?></span>
								</div>
							</div>
							<hr/>
						<?php endforeach;?>
					</div>
					
				</div>
			</div>
		</div>
	</div>
