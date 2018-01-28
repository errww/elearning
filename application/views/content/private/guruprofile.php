

<center><h3>PROFILE</h3></center>
<br />

<div class="panel panel-primary">

  <form action="<?php echo site_url('guru/profile_update')?>" id="form" class="form-horizontal" enctype="multipart/form-data" method="post">
    <div class="panel-footer">
      <div class="container-fluid">

        <center>
<<<<<<< HEAD
          <img src="<?php echo base_url()?>assets/img/NoAvatar.jpg" class="img img-thumbnail img-responsive" alt="Cinque Terre" width="200" height="auto">  
          <br>
          <br>
=======

          <?php if(empty($profile->foto)){?>
          <img src="<?php echo base_url()?>assets/img/NoAvatar.jpg" class="img img-thumbnail img-responsive" alt=" " width="200" height="auto">
          <?php }else{ ?>
            <img src="<?php echo base_url()?>assets/avatar/<?php echo $profile->foto ?> " class="img img-thumbnail img-responsive" alt="">
          <?php } ?>

          <br>
          <br>
          <code>*max file image 2048kb</code>
>>>>>>> fb6901d8cbb83435e0caade11c6bff0fcf4a5e73
          <input type="file" name="foto" class="col-md-offset-1">

          <br>
        </center>


<<<<<<< HEAD
=======
        <!-- success -->
        <?php if($this->session->flashdata('success')){?>
        <div class="alert alert-success">
          <?php echo $this->session->flashdata('success'); ?>
        </div>
        <?php } ?>

        <!-- error  -->
        <?php if($this->session->flashdata('error')){?>
        <div class="alert alert-danger">
          <?php echo $this->session->flashdata('error'); ?>
        </div>
        <?php } ?>



>>>>>>> fb6901d8cbb83435e0caade11c6bff0fcf4a5e73
        <div class="form-group">

          <input type="hidden" name="id" class="form-control"  value="<?php echo $profile->id;?>">

          <div class="col-md-6">
            <label><small>NIP</small></label>
            <?php echo (form_error('nik') == '') ? '' : form_error('nik', '<p class="text-danger">*', '</p>') ; ?>
            <input type="text" name="nik" class="form-control"  value="<?php echo $profile->nik;?>">
          </div>

          <div class="col-md-6 ">
            <label><small>Nama</small></label>
            <?php echo (form_error('nama') == '') ? '' : form_error('nama', '<p class="text-danger">*', '</p>') ; ?>
            <input type="text" name="nama" class="form-control"  value="<?php echo $profile->nama;?>">
          </div>

          <div class="col-md-3 ">
            <label><small>Email</small></label>
            <?php echo (form_error('email') == '') ? '' : form_error('email', '<p class="text-danger">*', '</p>') ; ?>
            <input type="email" name="email" class="form-control" value="<?php echo $profile->email;?>">
          </div>

          <div class="col-md-3 ">
            <label><small>Telp</small></label>
            <?php echo (form_error('telp') == '') ? '' : form_error('telp', '<p class="text-danger">*', '</p>') ; ?>
            <input type="text" name="telp" class="form-control"  value="<?php echo $profile->telp;?>">
          </div>

          <div class="col-md-6">
            <label><small>Jenis Kelamin</small></label>
            <?php echo (form_error('jenis_kelamin') == '') ? '' : form_error('jenis_kelamin', '<p class="text-danger">*', '</p>') ; ?>
            <select class="form-control" name="jenis_kelamin">
              <option value="L" <?php if($profile->jenis_kelamin === 'L' ){ echo 'selected'; } ?> >Laki-Laki</option>
              <option value="P" <?php if($profile->jenis_kelamin === 'P' ){ echo 'selected'; } ?>>Perempuan</option>
            </select>
          </div>

          <div class="col-md-6 ">
            <label><small>Alamat</small></label>
            <?php echo (form_error('alamat') == '') ? '' : form_error('alamat', '<p class="text-danger">*', '</p>') ; ?>
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
            <?php echo (form_error('tgl') == '') ? '' : form_error('tgl', '<p class="text-danger">*', '</p>') ; ?>
            <input type="number" name="tgl" class="form-control"  value="<?php echo $tanggal;?>">
          </div>

          <div class="col-md-2 ">
            <label><small>Bulan</small></label>
            <?php echo (form_error('bulan') == '') ? '' : form_error('bulan', '<p class="text-danger">*', '</p>') ; ?>
            <input type="number" name="bulan" class="form-control"  value="<?php echo $bulan;?>">
          </div>

          <div class="col-md-2 ">
            <label><small>Tahun</small></label>
            <?php echo (form_error('tahun') == '') ? '' : form_error('tahun', '<p class="text-danger">*', '</p>') ; ?>
            <input type="number" name="tahun" class="form-control"  value="<?php echo $tahun;?>">
          </div>

        </div>

      </div>
<<<<<<< HEAD
    </div>
    <div class="panel-footer">

      <input type="submit" class="btn btn-primary" value="Update">

    </div>
  </form>
</div>


<div class="panel panel-primary">

  <form action="<?php echo site_url('guru/profile_update_password')?>" id="form" class="form-horizontal" enctype="multipart/form-data" method="post">
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
=======
    </div>
    <div class="panel-footer">

      <input type="submit" class="btn btn-primary" value="Update">

    </div>
  </form>
</div>


<div class="panel panel-primary">

  <form action="<?php echo site_url('guru/profile_update_password')?>" id="form" class="form-horizontal" enctype="multipart/form-data" method="post">
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
>>>>>>> fb6901d8cbb83435e0caade11c6bff0fcf4a5e73

    <div class="panel-footer">
      <input type="submit" class="btn btn-success" value="Ubah Password">
    </div>
  </form>

</div>


