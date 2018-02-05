<center><h3>Detail Jadwal</h3></center>
<br />

<div class="container-fluid">
	
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Jam Mulai</th>
				<th>Jam Selesai</th>
				<th>Hari</th>
				<th>Kelas</th>
				<th>Mapel</th>
				<th>Guru</th>
			</tr>
		</thead>
		<tbody>

		<?php foreach($jadwal as $jadwal):?>
			<tr>
				<td><strong><?= $jadwal->jam_mulai;?></strong></td>
				<td><strong><?= $jadwal->jam_selesai;?></strong></td>
				<td><span class="label label-warning"><?= $jadwal->nama_hari;?></span></td>
				<td><span class="label label-default"><?= $jadwal->nama_kelas;?></span></td>
				<td><span class="label label-success"><?= $jadwal->nama_mapel;?></span></td>
				<td><strong><?= $jadwal->nama;?></strong></td>
			</tr>
		<?php endforeach;?>

		</tbody>
	</table>
	
	<a href="<?= site_url('siswa/jadwal');?>" class="btn btn-primary"><i class="fa fa-backward"></i> Kembali</a>

</div>