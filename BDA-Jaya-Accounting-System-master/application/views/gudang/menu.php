<div class="col-md-2">
	<ul class="nav nav-pills nav-stacked">
		<li id="stats" class="">
			<a href="<?php echo site_url('gudang')?>">
				Stats
			</a>
		</li>
		<li id="barang" class="">
			<a href="<?php echo site_url('gudang/barang')?>">
				<span class="badge pull-right"><?php echo $this->db->count_all('barang');?></span>
				Barang
			</a>
		</li>
		<li id="kategori" class="">
			<a href="<?php echo site_url('gudang/kategori')?>">
				<span class="badge pull-right"><?php echo $this->db->count_all('kategori_barang');?></span>
				Kategori
			</a>
		</li>
		<li id="pemasok" class="">
			<a href="<?php echo site_url('gudang/pemasok')?>">
				<span class="badge pull-right"><?php echo $this->db->count_all('pemasok');?></span>
				Pemasok
			</a>
		</li>
		<li id="pemasok" class="">
			<a href="<?php echo site_url('gudang/pasokan')?>">
				Pasokan
			</a>
		</li>
	</ul>
</div>