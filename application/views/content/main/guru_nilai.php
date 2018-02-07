
<!-- Page Features -->
<section>
	<div class="container">
		<div class="row">

			<div class="col-lg-12">
				<h2 class="my-4 txt-color-goldenrod"><i class="fa fa-newspaper-o"></i> <small>Guru Nilai</small></h2>
			</div>

			<div class="col-md-4">
				<div class="alert alert-default" role="alert">
					<center>
						<p><strong>Profil Guru </strong></p>
						<hr>
						<img src="<?php echo base_url('assets/avatar/')?><?php echo $guru->foto ;?>" class="img-fluid ratio" >
						<hr>
						<p><span class="badge badge-primary">Nama Guru : <?= $guru->nama ?></span></strong></p>
						<p><span class="badge badge-primary">No Induk : <?= $guru->nik ?></span></p>
						<p><span class="badge badge-primary">Email : <?= $guru->email ?></span></p>
						<p><span class="badge badge-primary">Telp : <?= $guru->telp ?></span></p>
						<p><span class="badge badge-primary">Tgl Lahir : <?= $guru->tgl_lahir ?></span></p>
						<?php
						$k = '';

						if($guru->jenis_kelamin == 'p'){
							$k = 'Perempuan';
						}else{
							$k = 'Laki-Laki';
						}

						?>

						<p><span class="badge badge-primary">Jenis Kelamin : <?= $k ?></span></p>
						<hr>
						<p>Alamat : <?= $guru->alamat ?></p>
						<hr>
					</center>
				</div>
			</div>

			<div class="col-md-8">
				<div class="row">
					<div class="container">
						<ol class="breadcrumb breadcrumb-arrow">
							<li><a href="<?= site_url()?>">Home</a></li>
							<li class="active"><span><i class="fa fa-info-circle"></i> Nilai Guru <?= $guru->nama ?> </span></li>
						</ol>
					</div>

					<?php if(!empty($nilai)){ ?>

					<?php foreach ($nilai as $row) { ?>
					<div class="col-lg-4 col-md-6 mb-4">
						<div class="card">
							<img class="card-img-top" src="<?= base_url('assets/img/yellowcd.png')?>" alt="">
							<div class="card-body">
								<p class="card-title">
									<span class="badge badge-primary"><i class="fa fa-user"></i> <?php echo $row->nama; ?></span> 
								</p>
								<p class="card-title">
									<span class="badge badge-primary"><i class="fa fa-clock-o"></i> <?php echo $row->tanggal; ?></span>
								</p>
								<p class="card-text"><?php echo $row->title; ?></p>
							</div>
							<div class="card-footer bg-warning">


								<?php if(is_null($row->file)){ ?>

								<?php echo '<code>Belum upload file nilai</code>'; ?>

								<?php } else { ?>

								<a href="<?php echo site_url("main/download_nilai/$row->file"); ?>" class="btn btn-primary btn-sm"><i class="fa fa-download"></i> Download Nilai</a>

								<?php } ?>
							</div>
						</div>
					</div>

					<?php } ?>

					<?php }else{ ?>

					<div class="container">
						<code>Maaf, Guru belum memiliki data nilai.</code>
					</div>
					<?php } ?>


				</div>
			</div>

		</div>
		<!-- /.row -->
	</div>
</section>