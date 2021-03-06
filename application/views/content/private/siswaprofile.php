

<center><h3>PROFILE SISWA</h3></center>
<br />

<div class="panel panel-primary">

  <form action="<?php echo site_url('siswa/profile_update')?>" id="form" class="form-horizontal" enctype="multipart/form-data" method="post">
    <div class="panel-footer">
      <div class="container-fluid">

        <center>

          <?php if(empty($profile->foto)){?>
          <img src="<?php echo base_url()?>assets/img/NoAvatar.jpg" class="img img-thumbnail img-responsive" alt=" " width="200" height="auto">
          <?php }else{ ?>
          <img src="<?php echo base_url()?>assets/avatar/<?php echo $profile->foto ?> " class="img img-thumbnail img-responsive" alt="">
          <?php } ?>

          <br>
          <br>
          <code>*max file image 2048kb</code>
          <input type="file" name="foto" class="col-md-offset-1">

          <br>
        </center>


        <!-- success -->
        <?php if($this->session->flashdata('success')){?>
        <div class="alert alert-success">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
         <?php echo $this->session->flashdata('success'); ?>
       </div>
       <?php } ?>

       <!-- error  -->
       <?php if($this->session->flashdata('error')){?>
       <div class="alert alert-danger">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
         <?php echo $this->session->flashdata('error'); ?>
       </div>
       <?php } ?>

       <?php if(validation_errors()){?>
       <div class="alert alert-danger">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
         <h4 class="alert-heading"><i class="fa fa-warning"></i> Warning</h4>
         <?php echo validation_errors();?>
       </div>
       <?php } ?>



       <div class="form-group">

        <input type="hidden" name="id" class="form-control"  value="<?php echo $profile->id_siswa;?>">

        <div class="col-md-6">
          <label><small>KELAS</small></label>
          <input type="text" name="kelas" class="form-control"  value="<?php echo $profile->nama_kelas;?>" disabled>
        </div>

        <div class="col-md-6">
          <label><small>TAHUN AJAR</small></label>
          <input type="text" name="tahunajaran" class="form-control"  value="<?php echo $profile->tahun;?>" disabled>
        </div>

        <div class="col-md-6">
          <label><small>NIS</small></label>
          <!--  <?php echo (form_error('nis_siswa') == '') ? '' : form_error('nis_siswa', '<p class="text-danger">*', '</p>') ; ?> -->
          <input type="text" name="nis_siswa" class="form-control"  value="<?php echo $profile->nis_siswa;?>">
        </div>

        <div class="col-md-6 ">
          <label><small>Nama</small></label>
          <!--   <?php echo (form_error('nama_siswa') == '') ? '' : form_error('nama_siswa', '<p class="text-danger">*', '</p>') ; ?> -->
          <input type="text" name="nama_siswa" class="form-control"  value="<?php echo $profile->nama_siswa;?>">
        </div>

        <div class="col-md-3 ">
          <label><small>Email</small></label>
          <!-- <?php echo (form_error('email') == '') ? '' : form_error('email', '<p class="text-danger">*', '</p>') ; ?> -->
          <input type="email" name="email" class="form-control" value="<?php echo $profile->email;?>">
        </div>

        <div class="col-md-3 ">
          <label><small>Telp</small></label>
          <!-- <?php echo (form_error('telp') == '') ? '' : form_error('telp', '<p class="text-danger">*', '</p>') ; ?> -->
          <input type="text" name="telp" class="form-control"  value="<?php echo $profile->telp;?>">
        </div>

        <div class="col-md-6">
          <label><small>Jenis Kelamin</small></label>
          <!-- <?php echo (form_error('jenis_kelamin') == '') ? '' : form_error('jenis_kelamin', '<p class="text-danger">*', '</p>') ; ?> -->
          <select class="form-control" name="jenis_kelamin">
            <option value="L" <?php if($profile->jenis_kelamin === 'L' ){ echo 'selected'; } ?> >Laki-Laki</option>
            <option value="P" <?php if($profile->jenis_kelamin === 'P' ){ echo 'selected'; } ?>>Perempuan</option>
          </select>
        </div>

        <div class="col-md-6 ">
          <label><small>Alamat</small></label>
          <!-- <?php echo (form_error('alamat') == '') ? '' : form_error('alamat', '<p class="text-danger">*', '</p>') ; ?> -->
          <textarea name="alamat" class="form-control"><?php echo $profile->alamat;?></textarea>
        </div>

        <?php 

        $str_tgl = $profile->tgl_lahir ;
        $res = explode("-", $str_tgl);

        if(array_key_exists('0', $res)){

          $tanggal = $res[0];
        }else{
          $tanggal = '';
        }

        if(array_key_exists('1', $res)){

          $bulan   = $res[1];
        }else{
          $bulan = '';
        }

        if(array_key_exists('2', $res)){

          $tahun = $res[2];
        }else{
          $tahun = '';
        }

        ?>
        <div class="col-md-2 ">
          <label><small>Lahir</small></label>
          <label><small>Tanggal</small></label>
          <!-- <?php echo (form_error('tgl') == '') ? '' : form_error('tgl', '<p class="text-danger">*', '</p>') ; ?> -->
          <input type="text" name="tgl" class="form-control"  value="<?php echo $tanggal;?>">
        </div>

        <div class="col-md-2 ">
          <label><small>Bulan</small></label>
          <!-- <?php echo (form_error('bulan') == '') ? '' : form_error('bulan', '<p class="text-danger">*', '</p>') ; ?> -->
          <input type="text" name="bulan" class="form-control"  value="<?php echo $bulan;?>">
        </div>

        <div class="col-md-2 ">
          <label><small>Tahun</small></label>
          <!-- <?php echo (form_error('tahun') == '') ? '' : form_error('tahun', '<p class="text-danger">*', '</p>') ; ?> -->
          <input type="text" name="tahun" class="form-control"  value="<?php echo $tahun;?>">
        </div>

      </div>

    </div>
  </div>
  <div class="panel-footer">

    <input type="submit" class="btn btn-primary" value="Update">

  </div>
</form>
</div>


<div class="panel panel-primary">

  <form action="<?php echo site_url('siswa/profile_update_password')?>" id="form" class="form-horizontal" enctype="multipart/form-data" method="post">
    <div class="panel-footer">
      <div class="container-fluid">

        <!-- success updating password message -->
        <?php if($this->session->flashdata('success_update_password')){?>
        <div class="alert alert-success">
          <?php echo $this->session->flashdata('success_update_password'); ?>
        </div>
        <?php } ?>

        <!-- error updating password  -->
        <?php if($this->session->flashdata('error_update_password')){?>
        <div class="alert alert-danger">
          <?php echo $this->session->flashdata('error_update_password'); ?>
        </div>
        <?php } ?>

        <div class="form-group">
          <div class="col-md-6">
            <label><small>Password Lama</small></label>
            <?php echo (form_error('old_password') == '') ? '' : form_error('old_password', '<p class="text-danger">*', '</p>') ; ?>
            <input type="password" name="old_password" class="form-control">
          </div>

          <div class="col-md-6">
            <label><small>Password Baru</small></label>
            <?php echo (form_error('new_password') == '') ? '' : form_error('new_password', '<p class="text-danger">*', '</p>') ; ?>
            <input type="password" name="new_password" class="form-control">
          </div>

        </div>

      </div>
    </div>

    <div class="panel-footer">
      <input type="submit" class="btn btn-success" value="Ubah Password">
    </div>
  </form>

</div>


