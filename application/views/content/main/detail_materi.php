
<!-- Page Features -->
<section>
	<div class="container">
		<div class="row">

			<div class="col-lg-12">
				<h2 class="my-4 txt-color-goldenrod"><i class="fa fa-newspaper-o"></i> <small>Detail Materi</small></h2>
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
							<p class="mb-0"><a href="<?php echo site_url()?>" class="btn btn-info"><i class="fa fa-home"></i> Kembali ke Home</a></p>
						</center>
					</div>
				</div>

				<div class="well col-md-8">

					<?php if($this->session->flashdata('error')){?>
					<div class="alert alert-danger">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<p><?php echo $this->session->flashdata('error');?></p>
					</div>
					<?php } ?>

					<?php if(is_null($materi)){ ?>

					<div class="alert alert-warning">
						<h5 class="alert-heading"><i class="fa fa-warning fa-2x"></i>  DATA CORRUPT!</h5>
						<hr>
						<p>Terjadi <code>ERROR</code>, kemungkinan disebabkan kehilangan data pada <strong>foreign_key</strong></p>
					</div>


					<?php }else{ ?>

					<ol class="breadcrumb">
						<li class="breadcrumb-item active"><i class="fa fa-calendar"></i> <code>Post On :<?php echo $materi->tgl_upload ?></code></li>
					</ol>

					<table class="table">
						<tbody>
							<tr>
								<td><strong>Nama Materi </strong></td>
								<td>:</td>
								<td><?php echo $materi->nama_materi ?></td>
							</tr>
							<tr>
								<td><strong>Guru Upload </strong></td>
								<td>:</td>
								<td><?php echo $materi->guru_nama ?></td>
							</tr>
							<tr>
								<td><strong>Mata Pelajaran</strong></td>
								<td>:</td>
								<td><?php echo $materi->nama_mapel ?></td>
							</tr>
							<tr>
								<td><strong>Tahun Ajaran</strong></td>
								<td>:</td>
								<td><code><?php echo $materi->tahun ?></code></td>
							</tr>
							<tr>
								<td><strong>Kelas</strong></td>
								<td>:</td>
								<td><div class="badge badge-success"><?php echo $materi->nama_kelas ?></div></td>
							</tr>
							<tr>
								<td><strong>Semester</strong></td>
								<td>:</td>
								<td><div class="badge badge-primary"><?php echo $materi->semester ?></div></td>
							</tr>
						</tbody>
					</table>

					<ol class="breadcrumb">
						<li class="breadcrumb-item active"><i class="fa fa-pencil-square"></i> Other</li>
					</ol>

					<table class="table">
						<tbody>
							<tr>
								<td><strong>Tipe Materi </strong></td>
								<td>:</td>
								<td><?php echo $materi->tipe_materi ?></td>
							</tr>
							<tr>
								<td><strong>Download</strong></td>
								<td>:</td>
								<td>
									<i class="fa fa-download"></i> 
									<?php if(is_null($materi->file_materi)){ ?>

									<?php echo '<code>Belum upload file materi</code>' ;?>

									<?php }else{ ?> 
									<a href="<?php echo site_url('main/download_materi/');?><?php echo $materi->file_materi;?>/<?php echo $materi->id_materi;?>">
										<?php echo $materi->file_materi ?>
									</a>
									<?php } ?>
								</td>
							</tr>
							
						</tbody>
					</table>

					<?php } ?>

				</div>

			</div>
			<!-- /.row -->
		</div>
	</section>