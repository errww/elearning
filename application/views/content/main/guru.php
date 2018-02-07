
<!-- Page Features -->
<section>
	<div class="container">
		<div class="row">

			<div class="col-lg-12">
				<h2 class="my-4 txt-color-goldenrod"><i class="fa fa-graduation-cap"></i> <small>GURU	</small></h2>
			</div>

			<div class="col-md-12">
				<!-- <div class="team-section padding80"> -->
					<div class="container">
						<div class="row text-center">
						 <?php foreach($guru as $guru):?>
							<div class="col-md-4 mb-4">
								<div class="team-box">
									<div class="team-img">
										<img src="<?php echo base_url('assets/avatar/')?><?php echo $guru->foto ;?>">
									</div>
									<div class="team-title">
										<br>
										<h3><?= $guru->nama ?></h3>
										<h4>NIP <?= $guru->nik ?></h4>
										<p>
											<a href="<?= site_url('main/guru_informasi/')?><?= $guru->id ?>" class="btn btn-primary btn-sm"><i class="fa fa-info-circle"></i> Informasi</a>

											<a href="<?= site_url('main/guru_materi/')?><?= $guru->id ?>" class="btn btn-primary btn-sm"><i class="fa fa-book"></i> Materi</a>

											<a href="<?= site_url('main/guru_nilai/')?><?= $guru->id ?>" class="btn btn-primary btn-sm"><i class="fa fa-bar-chart-o"></i> Nilai</a>

											<br>
											<br>

											<a href="<?= site_url('main/guru_jadwal/')?><?= $guru->id ?>" class="btn btn-primary btn-sm"><i class="fa fa-calendar"></i> Jadwal Mengajar</a>
										</p>
									</div>
								</div>
							</div>
						<?php endforeach;?>

						</div>
					</div>
				<!-- </div> -->
			</div>

		</div>
		<!-- /.row -->
	</div>
</section>