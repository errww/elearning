
<header class="masthead text-white text-center">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-xl-9 mx-auto">
        <h1 class="mb-5 g-fnt"><strong>SELAMAT DATANG DI SISTEM E-LEARN SMAN 1 PAJANGAN </strong></h1>
      </div>
      <?php if($this->session->userdata('is_login')){?>

      <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
        <button type="submit" class="btn btn-block btn-lg btn-success"><i class="fa fa-lock"></i> WELCOME, ANDA LOGIN SEBAGAI <?= strtoupper($this->session->userdata('level'));?></button>
      </div>

      <?php } else{ ?>

      <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
        <button type="submit" class="btn btn-block btn-lg btn-success"><i class="fa fa-lock"></i> Anda harus login untuk mengakses fitur E-LEARN </button>
      </div>

      <?php } ?>
    </div>
  </div>
</header>



<!-- Page Features -->
<section class="bg-darkcyan">
  <div class="container">
   <div class="row">

    <div class="col-lg-12">
      <h2 class="my-4 txt-color-goldenrod"><i class="fa fa-newspaper-o"></i> <small>INFORMASI TERBARU</small></h2>
    </div>

    <?php foreach ($informasi as $info) { ?>
    <div class="col-lg-3 col-md-6 mb-4">
      <div class="card ">
        <img class="card-img-top" src="<?= base_url('assets/img/01123df.png')?>" alt="">
        <div class="card-body">

          <p class="card-title"><span class="badge badge-primary"><i class="fa fa-user"></i> <?php echo $info->nama ;?></span></p>
          <p class="card-title"><span class="badge badge-primary"><i class="fa fa-clock-o"></i> <?php echo $info->created_at ;?></span></p>

          <h4 class="card-title"><?php echo substr($info->title,0,30); ?></h4>
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
  <!-- /.row -->
  <div class="row">

    <div class="col-md-12 col-lg-8 col-xl-7 mx-auto">
      <center>
        <?php if($this->session->userdata('level') == 'siswa'){?>
        <a href="<?= site_url('main/informasi')?>" class="btn btn-sm btn-warning outline">
          <i class="fa fa-chevron-right"></i> INFORMASI SELENGKAPNYA
        </a>
        <?php }else{ ?>

        <button class="btn btn-sm btn-warning outline">
          <i class="fa fa-lock"></i> LOCKED
        </button>      
        <?php } ?>
      </center>

    </div>
  </div>
  <br>

</div>
</section>

<section class="bg-ghostwhite">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h2 class="my-4"><small>E-Learning Materi</small></h2>
      </div>

      <?php foreach ($materi as $row) { ?>

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card ">
          <img class="card-img-top" src="<?= base_url('assets/img/01124AC.png')?>" alt="">
          <div class="card-body">
            <p class="card-title"><span class="badge badge-warning"><i class="fa fa-user"></i> <?php echo $row->nama_guru ;?></span></p>
            <p class="card-title"><span class="badge badge-warning"><i class="fa fa-clock-o"></i> <?php echo $row->tgl_upload ;?></span></p>
            <p class="card-text"><?php echo $row->nama_materi;?></p>
          </div>
          <div class="card-footer">
            <?php if($this->session->userdata('level') == 'siswa'){?>
            <a href="<?php echo site_url('main/show_materi/')?><?php echo $row->idmateri ?>" class="btn btn-primary btn-sm">  <i class="fa fa-share-square"></i> Detail Materi
            </a>
            <?php }else{ ?>
            <button type="button" class="btn btn-danger btn-block"><i class="fa fa-lock"></i> LOCKED </button>
            <?php } ?>
          </div>
        </div>
      </div>

      <?php } ?>
    </div>
    <div class="row">
      <div class="col-md-12 col-lg-8 col-xl-7 mx-auto">

       <center>
        <?php if($this->session->userdata('level') == 'siswa'){?>
        <a href="<?= site_url('main/materi')?>" class="btn btn-sm btn-primary outline">
          <i class="fa fa-chevron-right"></i> MATERI SELENGKAPNYA
        </a>
        <?php }else{ ?>

        <button class="btn btn-sm btn-primary outline">
          <i class="fa fa-lock"></i> LOCKED
        </button>      
        <?php } ?>
      </center>

    </div>
  </div>
  <br>

</div>
</section>



<section class="bg-darkcyan">
  <div class="container">
    <div class="row">

     <div class="col-lg-12">
      <h2 class="my-4 txt-color-goldenrod"><i class="fa fa-bar-chart"></i> <small>E-Learning Nilai</small></h2>
    </div>

    <?php foreach ($nilai as $row) { ?>
    <div class="col-lg-3 col-md-6 mb-4">
      <div class="card">
        <!-- <h4 class="card-header "><i class="fa fa-graduation-cap"></i> <?php echo $row->nama; ?></h4> -->
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
          <?php if($this->session->userdata('level') == 'siswa'){?>

          <?php if(is_null($row->file)){ ?>

          <?php echo '<code>Belum upload file nilai</code>'; ?>

          <?php } else { ?>

          <a href="<?php echo site_url("main/download_nilai/$row->file"); ?>" class="btn btn-primary btn-sm"><i class="fa fa-download"></i> Download Nilai</a>

          <?php } ?>

          <?php }else{ ?>

          <button type="button" class="btn btn-danger btn-block"><i class="fa fa-lock"></i> LOCKED </button>

          <?php }?>
        </div>
      </div>
    </div>

    <?php } ?>
  </div>
</div>

<div class="row">
  <div class="col-md-12 col-lg-8 col-xl-7 mx-auto">
    <center>
      <?php if($this->session->userdata('level') == 'siswa'){?>
      <a href="<?= site_url('main/nilai')?>" class="btn btn-sm btn-warning outline">
        <i class="fa fa-chevron-right"></i> NILAI SELENGKAPNYA
      </a>
      <?php }else{ ?>

      <button class="btn btn-sm btn-warning outline">
        <i class="fa fa-lock"></i> LOCKED
      </button>      
      <?php } ?>
    </center>
  </div>
</div>
<br>
<!-- /.row -->
</div>
</section>

<!-- </div> -->
          <!-- /.container -->