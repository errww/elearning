<div class="container">
	<div class="row">


		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-login">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-6">
							<a href="#" class="active" id="login-form-link"><i class="fa fa-users" aria-hidden="true"></i> Siswa</a>
						</div>
						<div class="col-xs-6">
							<a href="#" id="register-form-link"><i class="fa fa-user-plus" aria-hidden="true"></i> Guru</a>
						</div>
					</div>
					<hr>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							
							<div class="alert alert-danger" style="display: none;"></div>

							<form id="login-form" method="post" role="form" style="display: block;">
								<div class="form-group">
									<input type="text" name="nis" id="nis" tabindex="1" class="form-control" placeholder="NIS">
								</div>
								<div class="form-group">
									<input type="password" name="password" id="passwordSiswa" tabindex="2" class="form-control" placeholder="Password">
									<input type="hidden" name="role" value="siswa">
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-sm-6 col-sm-offset-3">
											<input type="submit" name="login-siswa" id="login-siswa" tabindex="4" class="form-control btn btn-login siswa" value="Masuk Sebagai Siswa">
											<img id="loadingAdmin" src="<?php echo base_url() ?>/assets/img/spinner.gif"" style="display: none;">
										</div>
									</div>
								</div>
								
							</form>

							<form id="register-form" action="<?php echo base_url('guru/cek') ?>" method="post" role="form" style="display: none;">
								<div class="form-group">
									<input type="text" name="nik" id="nipGuru" tabindex="1" class="form-control" placeholder="NIK" value="">
								</div>
								<div class="form-group">
									<input type="password" name="password" id="passwordGuru" tabindex="2" class="form-control" placeholder="Password">
									<input type="hidden" name="role" value="guru">
								</div>
								
								<div class="form-group">
									<div class="row">
										<div class="col-sm-6 col-sm-offset-3">
											<input type="submit" name="login-guru" id="login-guru" tabindex="4" class="form-control btn btn-login guru" value="Masuk Sebagai Guru">
											<img id="loadingGuru" src="<?php echo base_url() ?>/assets/img/spinner.gif" style="display:none">
										</div>
									</div>
								</div>
								
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		
	</div>
</div>

<script type="text/javascript" src="<?php echo base_url()?>assets/js/login.js"></script>

<script type="text/javascript">
	$(function() {

		$('#login-form-link').click(function(e) {
			$("#login-form").delay(100).fadeIn(100);
			$("#register-form").fadeOut(100);
			$('#register-form-link').removeClass('active');
			$(this).addClass('active');
			e.preventDefault();
		});
		$('#register-form-link').click(function(e) {
			$("#register-form").delay(100).fadeIn(100);
			$("#login-form").fadeOut(100);
			$('#login-form-link').removeClass('active');
			$(this).addClass('active');
			e.preventDefault();
		});

	});

</script>