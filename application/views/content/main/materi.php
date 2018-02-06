
<!-- Page Features -->
<section>
	<div class="container">
		<div class="row">

			<div class="col-lg-12">
				<h2 class="my-4 txt-color-goldenrod"><i class="fa fa-newspaper-o"></i> <small>MATERI</small></h2>
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
					<div class="row">
						
						<div class="container">
							<ol class="breadcrumb breadcrumb-arrow">
								<li><a href="<?= site_url()?>">Home</a></li>
								<li class="active"><span><i class="fa fa-book"></i> Semua Materi</span></li>
							</ol>
						</div>

						<?php foreach ($materi as $info) { ?>
						<div class="col-lg-4 col-md-6 mb-4">
							<div class="card ">
								<img class="card-img-top" src="<?= base_url('assets/img/01124AC.png')?>" alt="">
								<div class="card-body">
									
									<p class="card-title"><span class="badge badge-warning"><i class="fa fa-user"></i> <?php echo $info->nama_guru ;?></span></p>
									<p class="card-title"><span class="badge badge-warning"><i class="fa fa-user"></i> <?php echo $info->tgl_upload ;?></span></p>

									<p class="card-text"><?php echo $info->nama_materi; ?></p>
								</div>
								<div class="card-footer bg-default">
									<?php if($this->session->userdata('level') == 'siswa'){?>
									<a href="<?php echo site_url('main/show_materi/')?><?php echo $info->idmateri ?>" class="btn btn-primary btn-sm">  <i class="fa fa-share-square"></i> Detail Materi
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