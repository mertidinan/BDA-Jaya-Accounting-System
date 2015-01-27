<script type="text/javascript">
	$(function(){
		$('#selectbln').val('<?php echo $bulan;?>');
		$('#selectthn').val('<?php echo $tahun;?>');
	});	
	function addPengeluaran(){
		$('#addpengeluaran').toggle('fast');
	}
	function addPemasukan(){
		$('#addpemasukan').toggle('fast');
	}
</script>
<div class="container">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="#">Admin</a></li>
			<li class="active">Penjurnalan</li>
		</ol>
	</div>
</div>
<div class="container">
	<?php $this->load->view('admin/menu')?>
	<?php //print_r($this->session->userdata('neraca'));?>
	<div class="col-md-10">
		<center>
			<?php 
			switch ($_GET['bln']) {
				case '1':
				$bln = 'Januari';
				break;
				case '2':
				$bln = 'Februari';
				break;
				case '3':
				$bln = 'Maret';
				break;
				case '4':
				$bln = 'April';
				break;
				case '5':
				$bln = 'Mei';
				break;
				case '6':
				$bln = 'Juni';
				break;
				case '7':
				$bln = 'Juli';
				break;
				case '8':
				$bln = 'Agustus';
				break;
				case '9':
				$bln = 'September';
				break;
				case '10':
				$bln = 'Oktober';
				break;
				case '11':
				$bln = 'November';
				break;
				case '12':
				$bln = 'Desember';
				break;
			}
			?>
			<h4>
				Laporan Raba Lugi <br/>
				"BDA-JAYA" <br/>
				Bulan <?php echo $bln;?> Tahun <?php echo $_GET['thn'];?>
			</h4>

		</center>
		<br/>
		<h5>Pendapatan</h5>
		<table class="table">
			<?php 
			//mencari nilai pendapatan
			$beban = array('beban','Beban');
			$tot_beban = 0;
			$tot_pendapatan = 0;
			foreach ($this->session->userdata('neraca') as $data) {
				//jika pendapatan
				if($data['tipe']=='pendapatan'){
					$tot_pendapatan = $tot_pendapatan + $data['value'];
				} else if(strpos($data['value'],$beban == 1)){ //jika beban
					$tot_beban = $tot_beban + $data['value'];
				}
			}
			?>
			<tr>
				<td>Pendapatan</td>
				<td>
					<?php 
					echo 'Rp '.number_format($tot_pendapatan).',-';
					?>
				</td>
			</tr>
			<tr>
				<td><strong>Total</strong></td>
				<td><strong><?php 
					echo 'Rp '.number_format($tot_pendapatan).',-';
					?></strong></td>
				</tr>
			</table>
			<br/>
			<h5>Beban</h5>
			<table class="table">
				<?php 
				foreach ($this->session->userdata('neraca') as $data) {
					$tipe = $data['tipe'];
					$pencarian = strpos($tipe, 'Beban');
					if($pencarian !== false){ ?>
					<tr>
						<td><?php echo $data['tipe'];?></td>
						<td><?php echo 'Rp '.number_format($data['value']).',-';$tot_beban = $tot_beban + $data['value'];?></td>
					</tr>
					<?php
				}
			} ?>
			<tr>
				<td><strong>Total</strong></td>
				<td><strong>Rp <?php echo number_format($tot_beban);?>,-</strong></td>
			</tr>
		</table>
		<br/>
		<h5 style="float:right">
			<?php
			$labrug = $tot_pendapatan - $tot_beban;
		//cek rugi ataukah laba
			if($labrug > 0){
				$status = 'laba';
				echo 'Laba Rp '.number_format($labrug).',-';
			} else {
				$status = 'Rugi';
				$labrug = abs($labrug);
				echo 'Rugi Rp '.number_format($labrug).',-';
			}
			?>
		</h5>
		<br><br><br>
		<center>
		<h4>
			Laporan Perubahan <br/>
			"BDA-JAYA" <br/>
			Bulan <?php echo $bln;?> Tahun <?php echo $_GET['thn'];?>
		</h4>
		<table class="table">
			<?php 
			foreach($this->session->userdata('neraca') as $n):
			if($n['tipe'] == 'Modal'){ ?>
			<tr>				
				<td><?php echo $n['tipe']?></td>
				<td><?php echo 'Rp '.number_format($n['value']).',-';$modal = $n['value'];?></td>
			</tr>
			<?php } endforeach;?>
			<tr>
				<td><?php echo $status;?></td>
				<td>Rp <?php echo number_format($labrug);?>,-</td>
			</tr>
			<tr style="display:none">
				<td><strong>Model Akhir</strong></td>
				<td><strong>
					<?php if($status == 'laba'){
						echo 'Rp '.number_format($modal = $modal+$labrug).',-';
						}else{
							echo 'Rp '.number_format($modal = $modal-$labrug).',-';
							}?>					
				</strong></td>
			</tr>
		</table>
		<h5 style="float:right">
		Model Akhir Rp <?php echo 'Rp '.number_format($modal).',-'?>
		</h5>		
	</center>

	</div>
	
</div>
