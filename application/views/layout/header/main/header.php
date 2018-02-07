<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- font awesome -->
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Oxygen" rel="stylesheet"> 
	<!-- bootstrap v4 -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap-4.0.0/css/bootstrapmin.css">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/heroic-features.css">
</head>
<body>

	<!-- Navigation -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-darkcyan fixed-top">
		<div class="container">
			<img class="navbar-brand" href="<?php site_url();?>" src="<?= site_url('assets/img/E-LEARN.png')?>">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ml-auto">

					<?php 
					$active = '';
					if(is_null($this->uri->segment(2))){
						$active = 'active';
					}
					?>
					
					<li class="nav-item <?= $active ?>">
						<a class="nav-link" href="<?= site_url();?>"><i class="fa fa-home"></i> Home</a>
					</li>

					<?php if(($this->session->userdata('is_login') && $this->session->userdata('level') == 'siswa'  )){ ?>

					<?php 
					$active = '';
					if($this->uri->segment(2) == 'informasi'){
						$active = 'active';
					}
					?>
					<li class="nav-item <?= $active ?>">
						<a class="nav-link" href="<?= site_url('main/informasi');?>"><i class="fa fa-info-circle"></i> Informasi</a>
					</li>
					
					<?php 
					$active = '';
					if($this->uri->segment(2) == 'materi'){
						$active = 'active';
					}
					?>

					<li class="nav-item <?= $active ?>">
						<a class="nav-link" href="<?= site_url('main/materi');?>"><i class="fa fa-book"></i> Materi</a>
					</li>

					<?php 
					$active = '';
					if($this->uri->segment(2) == 'nilai'){
						$active = 'active';
					}
					?>
					<li class="nav-item <?= $active ?>">
						<a class="nav-link" href="<?= site_url('main/nilai');?>"><i class="fa fa-bar-chart-o"></i> Nilai</a>
					</li>

					<?php 
					$active = '';
					if($this->uri->segment(2) == 'guru'){
						$active = 'active';
					}
					?>
					<li class="nav-item <?= $active ?>">
						<a class="nav-link" href="<?= site_url('main/guru');?>"><i class="fa fa-graduation-cap"></i> Guru</a>
					</li>

					<?php } ?>


					<?php if($this->session->userdata('is_login')){ 

						$link = '';
						if($this->session->userdata('level') == 'siswa'){
							$link = site_url('siswa');
						}

						if($this->session->userdata('level') == 'guru'){
							$link = site_url('guru');
						}

						if($this->session->userdata('level') == 'admin'){
							$link = site_url('admin');
						}
						?>


						<li class="nav-item">
							<a class="nav-link" href="<?= $link ?>"><i class="fa fa-dashboard"></i> Manage</a>
						</li>

						<?php }else{ ?>

						<li class="nav-item">
							<a class="nav-link" href="<?= site_url('admin/login')?>"><i class="fa fa-lock"></i> Login</a>
						</li>
						<?php } ?>

					</ul>
				</div>
			</div>
		</nav>