
<!-- Page Content -->
<!-- <div class="container"> -->

<!-- Jumbotron Header -->
<section>
  <div class="container">
   <header class="jumbotron my-4">
    <h1 class="display-3">SMA N 1 PAJANGAN</h1>
    <p class="lead">Selamat datang di website E-Learning SMA N 1 PAJANGAN</p>
    <?php if($this->session->userdata('is_login')){ ?>

    <?php if($this->session->userdata('level') == 'siswa'){ ?>
    <a href="<?php echo base_url('siswa'); ?>" class="btn btn-primary btn-xs">
      <i class="fa fa-dashboard"></i> 
      Anda telah login (Manage Siswa) 
    </a>
    <?php }?>

    <?php if($this->session->userdata('level') == 'guru'){ ?>
    <a href="<?php echo base_url('guru'); ?>" class="btn btn-primary btn-xs">
      <i class="fa fa-dashboard"></i> 
      Anda telah login (Manage Guru)
    </a>
    <?php }?>

    <?php if($this->session->userdata('level') == 'admin'){ ?>
    <a href="<?php echo base_url('admin'); ?>" class="btn btn-primary btn-xs">
      <i class="fa fa-dashboard"></i> 
      Anda telah login (Manage Admin)
    </a>
    <?php }?>


    
    <?php } else{ ?>

    <a href="<?php echo base_url('admin'); ?>" class="btn btn-success btn-xs"><i class="fa fa-user"></i> Authentikasi</a>

    <?php } ?>
  </header>
</div>
</section>


<!-- Page Features -->
<section class="bg-darkcyan">
  <div class="container">
   <div class="row">

    <div class="col-lg-12">
      <h2 class="my-4 txt-color-goldenrod"><i class="fa fa-newspaper-o"></i> <small>INFORMASI TERBARU</small></h2>
    </div>

    <?php foreach ($informasi as $info) { ?>
    <div class="col-lg-3 col-md-6 mb-4">
      <div class="card">
       <!--  <img class="card-img-top" src="http://placehold.it/500x325" alt=""> -->
       <div class="card-body">
        <h4 class="card-title"><?php echo substr($info->title,0,30); ?></h4>
        <p class="card-text"><?php echo substr($info->isi,0,60); ?></p>
      </div>
      <div class="card-footer">
        <?php if($this->session->userdata('level') == 'siswa'){?>
        <a href="<?php echo site_url('main/show_informasi/')?><?php echo $info->id ?>" class="btn btn-primary btn-sm">Selengkapnya</a>
        <?php }else{ ?>
        <code> <i class="fa fa-warning"></i> Siswa wajib login</code>
        <?php } ?>
      </div>
    </div>
  </div>

  <?php } ?>
</div>
<!-- /.row -->
</div>
</section>

<section class="bg-ghostwhite">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h2 class="my-4"><small>E-Learning Materi</small></h2>
      </div>

      <?php foreach ($materi as $row) { ?>
      <div class="col-lg-4 col-sm-6 text-center mb-4">
        <img class="rounded-circle img-fluid d-block mx-auto" src="https://cdn3.iconfinder.com/data/icons/dental-blue-icons/512/Untitled-6.png" width="100" height="100" alt="">
        <h3>
          <small><?php echo $row->nama_guru; ?></small>
        </h3>
        <p><a href="<?php echo site_url('main/show_materi/')?><?php echo $row->idmateri ?>"><?php echo $row->nama_materi; ?></a></p>

      </div>

      <?php } ?>
    </div>
  </div>
</section>



<section class="bg-darkcyan">
  <div class="container">
    <div class="row">

     <div class="col-lg-12">
      <h2 class="my-4 txt-color-goldenrod"><i class="fa fa-bar-chart"></i> <small>E-Learning Nilai</small></h2>
    </div>

    <?php foreach ($nilai as $row) { ?>
    <div class="col-lg-4 mb-4">
      <div class="card h-100">
        <h4 class="card-header"><i class="fa fa-graduation-cap"></i> <?php echo $row->nama; ?></h4>
        <div class="card-body">
          <p><?php echo $row->title; ?></p>
        </div>
        <div class="card-footer">
          <?php if($this->session->userdata('level') == 'siswa'){?>

          <?php if(is_null($row->file)){ ?>

          <?php echo '<code>Belum upload file nilai</code>'; ?>

          <?php } else { ?>

          <a href="<?php echo site_url("main/download_nilai/$row->file"); ?>" class="btn btn-primary btn-sm"><i class="fa fa-download"></i> Download Nilai</a>

          <?php } ?>
          
          <?php }else{ ?>
          
          <code> <i class="fa fa-warning"></i> Siswa wajib login.</code>
          
          <?php }?>
        </div>
      </div>
    </div>

    <?php } ?>

  </div>
  <!-- /.row -->
</div>
</section>

<!-- </div> -->
          <!-- /.container -->