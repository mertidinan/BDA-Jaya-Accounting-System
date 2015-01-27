<div class="container">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="#">Kasir</a></li>
			<li class="active">Stats</li>
		</ol>
	</div>
</div>
<div class="container">
	<?php $this->load->view('kasir/menu')?>
	<div class="col-md-10">
		<!-- <ul class="nav nav-tabs">
				<li class="active"><a href="#">Home</a></li>
				<li><a href="#">Profile</a></li>
				<li><a href="#">Messages</a></li>
			</ul> -->
			<br/>
			<div class="col-md-6">
				<h4 class="stats-number"><div class="col-md-3"><span style="font-size:30px" class="glyphicon glyphicon-user"></span></div><div class="col-md-9">Transaksi Hari Ini<br/><?php echo $today;?></div></h4>
			</div>
			<div class="col-md-6">
				<h4 class="stats-number"><div class="col-md-3"><span style="font-size:30px" class="glyphicon glyphicon-user"></span></div><div class="col-md-9">Total Piutang<br/><?php echo $piutang;?></div></h4>
			</div>			
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">Aktifitas Kasir</div>
					<div class="panel-body">
						<?php foreach($activity as $a):?>
							<p><strong><?php echo $a['activity']?></strong> Oleh <?php echo $a['pegawai']?> <span style="color:gray"><?php echo $a['tanggal'];?></span></p>
							<hr/>
						<?php endforeach;?>						
					</div>

				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">Terkakhir Login</div>
					<div class="panel-body">
						<?php foreach($log as $l):?>
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
