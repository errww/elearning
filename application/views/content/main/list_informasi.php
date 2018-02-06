
<!-- Page Features -->
<section>
	<div class="container">
		<div class="row">

			<div class="col-lg-12">
				<h2 class="my-4 txt-color-goldenrod"><i class="fa fa-newspaper-o"></i> <small>Detail Informasi</small></h2>
			</div>

			<div class="col-md-4">
				<div class="alert alert-default" role="alert">
					<center>
						<p><strong>Profil Anda</strong></p>
						<hr>
						<img src="<?php echo base_url('assets/avatar/')?><?php echo $foto_avatar->foto ;?>" class="img-fluid ratio" >
						<hr>
						<p>
							<i class="fa fa-user"></i> 
							login as : <span class="badge badge-pill badge-warning"><?php echo $this->session->userdata('name');?></span></p>
							<hr>
						</center>
					</div>
				</div>

				<div class="col-md-8">

					<!-- Title -->
					<h2 class="font-cst mt-4"><?php echo $informasi->title ?></h2>

					<!-- Author -->
					<p class="lead">
						by
						<a href="#"><?php echo $informasi->nama ?></a>
					</p>

					<hr>

					<p>Posted on <span class="badge badge-pill badge-primary"><?php echo $informasi->created_at ?></span></p>
					<!-- Date/Time -->

					<hr>

					<hr>

					<!-- Post Content -->
					<?php echo $informasi->isi ?>

					<hr>


				</div>

			</div>
			<!-- /.row -->
		</div>
	</section>