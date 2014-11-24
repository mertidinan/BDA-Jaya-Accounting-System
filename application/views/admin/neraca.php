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
	<div class="col-md-10">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Neraca</h3>
				</div>
				<div class="panel-body">
				<h4>Neraca</h4>
				<!-- <pre>
				<?php print_r($this->session->userdata('neraca')); ?>
				</pre> -->
				<table class="table table-striped">
					<tr>
						
						<th>Nama Akun</th>
						<th>Debet</th>
						<th>Kredit</th>
					</tr>
					<?php $totaldebet=0;$totalkredit=0;
					foreach($this->session->userdata('neraca') as $n):?>
						<tr>						
							<td><?php echo $n['tipe'];?></td>
							<td>
							<?php
							if($n['pos'] == 'debit'){
								echo number_format($n['value']);
								$totaldebet = $totaldebet + $n['value'];
							}
							?>
							</td>
							<td>
							<?php
							if($n['pos'] == 'kredit'){
								echo number_format($n['value']);
								$totalkredit = $totalkredit + $n['value'];
							}
							?>
							</td>
						</tr>
					<?php endforeach;?>
					<tr>
						<td></td>
						<td><strong><?php echo number_format($totaldebet);?></strong></td>
						<td><strong><?php echo number_format($totalkredit);?></strong></td>
					</tr>
				</table>
				</div>
			</div>

		</div>
	</div>
</div>
