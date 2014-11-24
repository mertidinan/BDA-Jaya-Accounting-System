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
				<?php print_r($this->session->userdata); ?>
				<table class="table table-striped">
					<tr>
						<th>No Akun</th>
						<th>Nama Akun</th>
						<th>Debet</th>
						<th>Kredit</th>
					</tr>
				</table>
				</div>
			</div>

		</div>
	</div>
</div>
