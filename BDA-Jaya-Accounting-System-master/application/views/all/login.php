<script type="text/javascript">
	function kasirlogin(){
		$('#kasir-login').toggle('fast');
		$('#gudang-login').hide('fast');
	}
	function gudanglogin(){
		$('#gudang-login').toggle('fast');
		$('#kasir-login').hide('fast');
	}
</script>

<div class="container">
	<div class="col-md-offset-4 col-md-4">
		<a onclick="pegawailogin()" class="lc" href="#"><div class="login-choose choose-kasir"><center> Login Kasir / Gudang</center></div></a>
		<div style="" id="kasir-login">
			<form method="POST" action="<?php echo site_url('login/pegawaiLogin') ?>" class="form-horizontal" role="form">
				<div class="form-group">
					<label for="inputusername1" class="col-lg-3 control-label">Username</label>
					<div class="col-lg-9">
						<input type="text" name="input-username" class="form-control" id="inputusername1" placeholder="username">
					</div>
				</div>
				<div class="form-group">
					<label for="inputPassword1" class="col-lg-3 control-label">Password</label>
					<div class="col-lg-9">
						<input type="password" name="input-password" class="form-control" id="inputPassword1" placeholder="Password">
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-offset-3 col-lg-9">
						<div class="checkbox">
							<label>
								<input type="checkbox"> Remember me
							</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-offset-3 col-lg-9">
						<button type="submit" class="btn btn-default">Sign in</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="container">	
	<!-- login place -->
	
</div>