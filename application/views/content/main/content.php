
<!-- Page Content -->
<!-- <div class="container"> -->

<!-- Jumbotron Header -->
<section>
  <div class="container">
   <header class="jumbotron my-4">
    <h1 class="display-3">SMA N 1 PAJANGAN</h1>
    <p class="lead">Selamat datang di website E-Learning SMA N 1 PAJANGAN</p>
    <a href="<?php echo base_url('admin'); ?>" class="btn btn-success btn-xs"><i class="fa fa-user"></i> Login Siswa</a>
    <a href="<?php echo base_url('admin'); ?>" class="btn btn-success btn-xs"><i class="fa fa-user"></i> Login Admin/Guru</a>
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
          <a href="#" class="btn btn-primary btn-sm">Selengkapnya</a>
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

      <div class="col-lg-4 col-sm-6 text-center mb-4">
        <img class="rounded-circle img-fluid d-block mx-auto" src="http://placehold.it/100x100" alt="">
        <h3>
          <small>Title</small>
        </h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt</p>
        </div>

        <div class="col-lg-4 col-sm-6 text-center mb-4">
          <img class="rounded-circle img-fluid d-block mx-auto" src="http://placehold.it/100x100" alt="">
          <h3>
            <small>Title</small>
          </h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt</p>
          </div>

          <div class="col-lg-4 col-sm-6 text-center mb-4">
            <img class="rounded-circle img-fluid d-block mx-auto" src="http://placehold.it/100x100" alt="">
            <h3>
              <small>Title</small>
            </h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt</p>
            </div>

            <div class="col-lg-4 col-sm-6 text-center mb-4">
              <img class="rounded-circle img-fluid d-block mx-auto" src="http://placehold.it/100x100" alt="">
              <h3>
                <small>Title</small>
              </h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt</p>
              </div>

              <div class="col-lg-4 col-sm-6 text-center mb-4">
                <img class="rounded-circle img-fluid d-block mx-auto" src="http://placehold.it/100x100" alt="">
                <h3>
                  <small>Title</small>
                </h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                  tempor incididunt</p>
                </div>

                <div class="col-lg-4 col-sm-6 text-center mb-4">
                  <img class="rounded-circle img-fluid d-block mx-auto" src="http://placehold.it/100x100" alt="">
                  <h3>
                    <small>Title</small>
                  </h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt</p>
                  </div>

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
                    <h4 class="card-header"><?php echo $row->nama; ?></h4>
                    <div class="card-body">
                      <p><?php echo $row->judul; ?></p>
                    </div>
                    <div class="card-footer">
                      <a href="<?php echo base_url("uploads/$row->file"); ?>" class="btn btn-primary btn-sm"><i class="fa fa-download"></i> Download Nilai</a>
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

          <!-- Footer -->
          <footer class="py-5 bg-dark">
            <div class="container">
              <p class="m-0 text-center text-white">Copyright &copy; E-learning 2018</p>
            </div>
            <!-- /.container -->
          </footer>