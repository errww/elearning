<center><h3>Jadwal Anda</h3></center>
<br />

<div class="panel panel-primary">
	<div class="panel-heading">
		Jadwal : <?php echo $this->session->userdata('name');?>
	</div>

	<div class="panel-body">
		<div class="container-fluid">
			<br>

			<form action="<?php echo site_url('siswa/jadwal_detail')?>" method="get" class="form-horizontal">
				<div class="form-group">
					<label class="control-label col-sm-2">Pilih Hari:</label>
					<div class="col-sm-6">
						<select class="form-control" name="hari">
							<?php foreach($hari as $hari):?>
							<option value="<?= $hari->id_hari;?>"><?= $hari->nama_hari ;?></option>
						    <?php endforeach?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2"></label>
					<div class="col-sm-6">
						<input type="submit" class="btn btn-success btn-sm pull-right" value="Submit">
					</div>
				</div>

			</form>

		</div>
	</div>

</div>