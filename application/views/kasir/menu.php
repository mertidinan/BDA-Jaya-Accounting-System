<div class="col-md-2">
	<ul class="nav nav-pills nav-stacked">
		<li id="stats" class="">
			<a href="<?php echo site_url('kasir')?>">
				Stats
			</a>
		</li>
		<li id="transaksiBaru" class="">
			<a href="<?php echo site_url('kasir/transaksiBaru')?>">				
				Transaksi Baru
			</a>
		</li>
		<li id="transaksi" class="">
			<a href="<?php echo site_url('kasir/transaksi')?>">
				<span class="badge pull-right"><?php echo $this->db->count_all('transaksi');?></span>
				Transaksi
			</a>
		</li>
		<li id="tambahkeluar" class="">
			<a href="<?php echo site_url('kasir/tambahkeluar')?>">
				Tambah Pengeluaran
			</a>
		</li>
		<!-- <li id="piutang" class="">
			<a href="<?php echo site_url('kasir/piutang')?>">
				<span class="badge pull-right"><?php $this->db->where('status','piutang');echo $this->db->count_all('transaksi');?></span>
				Piutang
			</a>
		</li>	 -->
	</ul>
</div>