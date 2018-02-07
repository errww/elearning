
<!-- Page Features -->
<section>
	<div class="container">
		<div class="row">

			<div class="col-lg-12">
				<h2 class="my-4 txt-color-goldenrod"><i class="fa fa-newspaper-o"></i> <small>INFORMASI</small></h2>
			</div>

			<!-- <div class="col-md-4">
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
				</div> -->

				<div class="col-md-12">
					<div class="row">
						<div class="container">
							<ol class="breadcrumb breadcrumb-arrow">
								<li><a href="<?= site_url()?>">Home</a></li>
								<li class="active"><span><i class="fa fa-info-circle"></i> Semua Informasi</span></li>
							</ol>
						</div>

						<?php foreach ($informasi as $info) { ?>
						<div class="col-lg-3 col-md-6 mb-4">
							<div class="card ">
								<img class="card-img-top" src="<?= base_url('assets/img/01123df.png')?>" alt="">
								<div class="card-body">
									
									<p class="card-title"><span class="badge badge-primary"><i class="fa fa-user"></i> <?php echo $info->nama ;?></span></p>

									<h5 class="card-title"><?php echo substr($info->title,0,30); ?></h5>
									<p class="card-text"><?php echo substr($info->isi,0,60); ?></p>
								</div>
								<div class="card-footer bg-warning">
									<?php if($this->session->userdata('level') == 'siswa'){?>
									<a href="<?php echo site_url('main/show_informasi/')?><?php echo $info->id ?>" class="btn btn-primary btn-sm">  <i class="fa fa-share-square"></i> Selengkapnya
									</a>
									<?php }else{ ?>
									<button type="button" class="btn btn-danger btn-block"><i class="fa fa-lock"></i> LOCKED </button>
									<?php } ?>
								</div>
							</div>
						</div>

						<?php } ?>
					</div>
				</div>

			</div>
			<!-- /.row -->
		</div>
	</section>