
<!-- Page Features -->
<section>
	<div class="container">
		<div class="row">

			<div class="col-lg-12">
				<h2 class="my-4 txt-color-goldenrod"><i class="fa fa-newspaper-o"></i> <small>Jadwal Guru</small></h2>
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
							<li class="active"><span><i class="fa fa-info-circle"></i> Jadwal Guru <?= $guru->nama ?> </span></li> </ol>
						</div>

						<?php if(!empty($jadwal)){ ?>

						<table class="table table-striped">
							<thead>
								<tr>
									<th>Hari</th>
									<th>Mapel</th>
									<th>Kelas</th>
									<th>Jam Mulai</th>
									<th>Jam Selesai</th>
									<th>Guru</th>
								</tr>
							</thead>
							<tbody>

								<?php foreach ($jadwal as $jadwal) { ?>

								<tr>
									<td><?= $jadwal->nama_hari ?></td>
									<td><?= $jadwal->nama_mapel ?></td>
									<td><?= $jadwal->nama_kelas ?></td>
									<td><?= $jadwal->jam_mulai ?></td>
									<td><?= $jadwal->jam_selesai ?></td>
									<td><?= $jadwal->nama ?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>

						<?php }else{ ?>

						<div class="container">
							<code>Maaf, Guru belum memiliki jadwal.</code>
						</div>
						<?php } ?>


					</div>
				</div>

			</div>
			<!-- /.row -->
		</div>
	</section>