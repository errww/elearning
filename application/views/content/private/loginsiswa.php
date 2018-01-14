<div id="fullscreen_bg" class="fullscreen_bg"/>

<div class="container">
	<form action="<?php echo base_url('siswa/cek') ?>" method="post" class="form-signin">
		<h1 class="form-signin-heading text-muted">Sign In</h1>
		<input type="text" name="nis" class="form-control" placeholder="NIS Siswa" required="" autofocus="">
		<input type="password" name="password" class="form-control" placeholder="Password" required="">
		<button class="btn btn-lg btn-primary btn-block" type="submit">
			Login
		</button>
	</form>

</div>