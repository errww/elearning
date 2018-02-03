<div class="row">
  <div class="col-md-6">
    <ol class="breadcrumb">
      <li><a href="<?php echo site_url('admin');?>">Dashboard</a></li>
      <li class="active">Data Guru</li>
    </ol>
  </div>
</div>

<br />
<button class="btn btn-success btn-sm" onclick="add_guru()"><i class="fa fa-plus"></i> Tambah guru</button>
<br />
<br />
<table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th>No</th>
      <th>NIK guru</th>
      <th>Nama guru</th>
      <th>Manage</th>
      <th style="width:125px;">Action</p></th>
    </tr>
  </thead>
  <tbody>
    <?php $i = 1; foreach($guru as $gurus){?>
    <tr>
     <td><?php echo $i++;?></td>
     <td><?php echo $gurus->nik;?></td>
     <td><?php echo $gurus->nama;?></td>
     <td>

       <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown">Manage
          <span class="caret"></span></button>
          <ul class="dropdown-menu">
            <?php if(is_null($gurus->foto)){?>
            <li><a href="#" onclick="uploadFile('<?php echo $gurus->id ;?>','<?php echo $gurus->foto ;?>')">Upload Foto <i class="fa fa-upload"></i></a></li>
            <?php }else{ ?>
            <li><a href="#" onclick="uploadFile('<?php echo $gurus->id ;?>','<?php echo $gurus->foto ;?>')">Update Foto <i class="fa fa-edit"></i></a></li>
            <?php } ?>
            <li role="separator" class="divider"></li>
            <li><a href="#" onclick="addMapel('<?php echo $gurus->id ;?>','<?php echo $gurus->nama ;?>')"> Mengajar Mapel <i class="fa fa-book"></i></a></li>
          </ul>
        </div>

      </td>
      <td>
        <button class="btn btn-warning btn-sm" onclick="edit(<?php echo $gurus->id;?>)"><i class="fa fa-pencil"></i></button>
        <button class="btn btn-danger btn-sm" onclick="destroy('<?php echo $gurus->id;?>','<?php echo $gurus->nama;?>')"><i class="fa fa-remove"></i></button>
      </td>
    </tr>
    <?php }?>
  </tbody>
</table>

  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Guru Form</h4>
        </div>
        <div class="modal-body form bg-primary">

          <div class="alert alert-danger" style="display: none;">

            <div class="form-group">
              <h4 class="alert-heading"><i class="fa fa-warning"></i> Warning</h4>
              <hr>
              <span></span>
            </div>
          </div>

          <form action="#" id="form" class="form-horizontal">
            <input type="hidden" value="" name="id_guru"/>
            <div class="form-body">

              <div class="form-group">
                <label class="control-label col-md-3">NIK Guru</label>
                <div class="col-md-9">
                  <input name="nik" placeholder="nik guru" value="" class="form-control" type="number" id="Nisguru" >
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">Nama Guru</label>
                <div class="col-md-9">
                  <input name="nama" placeholder="nama guru" class="form-control" type="text">
                </div>
              </div>
              
              <div class="form-group">
                <label class="control-label col-md-3">Password Guru</label>
                <div class="col-md-9">
                  <!-- <code>* jika password kosong,otomatis password adalah nik</code>
                  <br>
                  <br> -->
                  <input name="pass" placeholder="password guru" class="form-control" type="password">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3">Level</label>
                <div class="col-md-9">
                  <select name="level" class="form-control">
                    <option value="guru">Guru</option>
                    <option value="admin">Admin</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3">No telp</label>
                <div class="col-md-9">
                  <input name="telp" placeholder="no telp" class="form-control" type="text">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3">Email</label>
                <div class="col-md-9">
                  <input name="email" placeholder="email" class="form-control" type="text">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3">Alamat</label>
                <div class="col-md-9">
                  <textarea class="form-control" name="alamat"></textarea> 
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3">Tgl Lahir</label>
                <div class="col-md-3">
                  <input name="tgl" placeholder="11" class="form-control" type="text">
                </div>
                <div class="col-md-3">
                  <input name="bln" placeholder="02" class="form-control" type="text">
                </div>
                <div class="col-md-3">
                  <input name="thn" placeholder="1990" class="form-control" type="text">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3">Jenis Kelamin</label>
                <div class="col-md-9">
                  <select name="jenis_kelamin" class="form-control">
                    <option value="L">Laki-Laki</option>
                    <option value="P">Perempuan</option>
                  </select>
                </div>
              </div>

            </div>
          </form>
        </div>
        <div class="modal-footer bg-primary">
          <button type="button" id="btnSave" onclick="save()" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!-- End Bootstrap modal -->

  <div class="modal fade" id="modal_file_upload" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Foto: Upload File </h4>
        </div>
        <div class="modal-body form bg-primary">

          <div class="alert alert-danger" style="display: none;"></div>
          <div class="alert alert-success" style="display: none;"></div>

          <form action="#" id="formUpload" class="form-horizontal" enctype="multipart/form-data">
            <input type="hidden"  name="id_guru"/>
            <div class="form-body">

              <center>
                <img src="" id="img-src" class="img img-responsive img-thumbnail" width="200px" height="auto">
              </center>
              
              <br>
              
              <div class="form-group">
                <label class="col-md-4">File</label>
                <div class="col-md-8">
                  <input type="file" name="file" id="file">
                </div>
              </div>

            </div>
          </form>
        </div>
        <div class="modal-footer bg-primary">
          <button type="button" id="btnSaveUpload" onclick="saveUpload()" class="btn btn-success"><i class="fa fa-upload"></i> Save</button>
          <img id="loadingUpload" src="<?php echo base_url() ?>/assets/img/spinner.gif"" style="display: none;">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>

  <!-- Bootstrap modal -->
<div class="modal fade" id="modal_form_delete" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body form bg-danger">

        <div class="alert alert-danger">
          <div class="form-group">
            <h4 class="alert-heading"><i class="fa fa-warning"></i> Peringatan !</h4>
            <hr>
            <p>Menghapus data <strong>guru</strong> akan menyebabkan anda <strong>kehilangan data</strong> pada relasi <strong>data pesan informasi</strong>, <strong>data jam mapel</strong>, <strong> data materi</strong>, <strong>data nilai</strong>  yang dimiliki oleh guru <strong id="nmguru"></strong> ! </p>
            <br>
            <strong>Sehingga data diatas tidak dapat ditampilkan.</strong>
            <hr>
            <p class="text-small">Dengan meng-klik tombol hapus berarti anda telah mengetahui peringatan diatas.</p>
          </div>
        </div>
        
      </div>
      <div class="modal-footer bg-danger">
        <button type="button" id="btnDelete" class="btn btn-warning btn-sm">
          <i class="fa fa-trash"></i> Hapus
        </button>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
          <i class="fa fa-close"></i> Cancel
        </button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->


  <!-- bootstrap for mata pelajar -->
  <div class="modal fade" id="modal_mapel" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Guru: Mapel </h4>
        </div>
        <div class="modal-body form bg-primary">

          <div class="alert alert-danger" style="display: none;"></div>
          <div class="alert alert-success" style="display: none;"></div>


          <div class="alert alert-warning">

            <div class="form-group">
              <h4 class="alert-heading"><i class="fa fa-info-circle"></i> <span id="namaguru"></span></h4>
              <hr>
              <p> <strong>Mengajar Mapel :</strong></p>
              <div id="guru_ajr_mapel"> </div>
            </div>
          </div>

          <form action="#" id="formMapel" class="form-horizontal" enctype="multipart/form-data">
            <input type="hidden"  name="id_guru"/>
            <div class="form-body">


              <div class="form-group">
                <label class="control-label col-md-3">Mengajar </label>
                <div class="col-md-9">
                  <code>* ctrl + click untuk memilih</code>
                  <br>
                  <br>
                  <select name="mapel[]" id="mapelss" class="form-control" multiple>

                    <?php foreach($mapel as $mapels):?>
                      <option value="<?php echo $mapels->id_mapel;?>"><?php echo $mapels->nama_mapel;?></option>
                    <?php endforeach;?>

                  </select>
                </div>
              </div>

            </div>
          </form>
        </div>
        <div class="modal-footer bg-primary">
          <button type="button" id="btnSaveMapel" onclick="saveMapel()" class="btn btn-success"><i class="fa fa-upload"></i> Save</button>
          <img id="loadingUpload" src="<?php echo base_url() ?>/assets/img/spinner.gif"" style="display: none;">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>



<script type="text/javascript">
  $(document).ready( function () {
    $('#table_id').DataTable();
  } );
    var save_method; //for save method string
    var table;
    
    
    function add_guru()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
      $('.modal-title').html('<i class="fa fa-plus"></i> Tambah Guru'); // Set Title to Bootstrap modal title
    }

    function edit(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals
      
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('index.php/admin/ajax_guru_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        { 
          $('[name="id_guru"]').val(data.id);
          $('[name="nik"]').val(data.nik);
          $('[name="nama"]').val(data.nama);
          $('[name="level"]').val(data.level);
          $('[name="telp"]').val(data.telp);
          $('[name="email"]').val(data.email);
          $('[name="alamat"]').val(data.alamat);


          $('[name="tgl"]').val(data.tgl_lahir.substr(0,2));
          $('[name="bln"]').val(data.tgl_lahir.substr(3,2));
          $('[name="thn"]').val(data.tgl_lahir.substr(6,4));

          $('[name="jenis_kelamin"]').val(data.jenis_kelamin);
          
    
          $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
          $('.modal-title').text('Edit guru'); // Set title to Bootstrap modal title
            
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
            alert('Error get data from ajax');
          }
        });
    }
    
    function save()
    {

      var url;
      if(save_method == 'add')
      {
        url = "<?php echo site_url('admin/guru_add')?>";
      }
      else
      {
        url = "<?php echo site_url('admin/guru_update')?>";
      }

       // ajax adding data to database
       $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
              //if success close modal and reload ajax table
              $('#modal_form').modal('hide');
              location.reload();// for reload a page
            },
            error: function (response,jqXHR, textStatus, errorThrown)
            {
              //console.log(response.responseJSON.error);
               $('.alert-danger span').html(response.responseJSON.error); //add response error
               $('.alert-danger').show().delay(4000).fadeOut(); //show the alert
             }

           });
     }
     
     function destroy(id_guru,nama_guru)
     {
     

      $('#modal_form_delete').modal('show'); // show bootstrap modal
      $('#nmguru').html(nama_guru);

      $('#btnDelete').click(function(event){

        // ajax delete data from database
        $.ajax({
          url : "<?php echo site_url('admin/guru_delete')?>/"+ id_guru,
          type: "POST",
          dataType: "JSON",
          success: function(data)
          {

           location.reload();
         },
         error: function (jqXHR, textStatus, errorThrown)
         {
          alert('Error deleting data');
        }
      });

      });
    }


    //show modal upload file
    function uploadFile(id,nama_image){

      $('#formUpload')[0].reset(); // reset form on modals
      $('#modal_file_upload').modal('show'); // show bootstrap modal
      $('.modal-title').html('<i class="fa fa-upload"></i> Upload Foto'); // Set title to Bootstrap modal title
      $('[name="id_guru"]').val(id);

      if(nama_image != ''){
        var src1 = '<?php echo base_url('assets/avatar/')?>' + nama_image;
      }else{
        var src1 = '<?php echo base_url('assets/img/NoAvatar.jpg')?>';
      }

      $("#img-src").attr("src", src1);


    }

    //save upload
    function saveUpload(){

      var id_guru = $('input[name=id_guru]').val()
      var url;

      url = "<?php echo site_url('admin/guru_file_add/')?>" + id_guru ;

      //hide the submit button
      $('button[id=btnSaveUpload]').hide();
      //show the loading gif
      $('#loadingUpload').show();

      var file_data = $('#file').prop('files')[0];
      var form_data = new FormData();
      form_data.append('file', file_data);

       // ajax adding data to database
       $.ajax({
        url : url,
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        dataType: "JSON",
        success: function(response)
        {
            //if success close modal and reload ajax table
            $('#modal_file_upload').modal('hide');
              location.reload();// for reload a page
            },
            error: function (response,textStatus, jqXHR)
            {
            //console.log(response.responseJSON.error);
            $('.alert-danger').html(response.responseJSON.error); //add response error
            $('.alert-danger').show().delay(4000).fadeOut(); //show the alert
            $('button[id=btnSaveUpload]').show(); // show the button submit
            $('#loadingUpload').hide(); //hide the loading gif
          }
        });

     }


    //show modal upload maper
    function addMapel(id_guru,nama_guru){

      $('#formMapel')[0].reset(); // reset form on modals
      $('#modal_mapel').modal('show'); // show bootstrap modal
      $('.modal-title').html('<i class="fa fa-plus"></i> Guru: Mapel'); // Set title to Bootstrap modal title
      $('[name="id_guru"]').val(id_guru);
      $('#namaguru').text(nama_guru);


      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('admin/ajax_guru_mapel/')?>/" + id_guru,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        { 

          console.log(data);
          //looping to option value
          $.each(data, function(i,e){
            $("#mapelss option[value='" + e.id_mapel + "']").prop("selected", true);
          });

          if(data == ''){

             $("#guru_ajr_mapel").html('Belum mengampu mata pelajaran apapun.');

          }else{

            $("#guru_ajr_mapel").html('');
            $.each(data, function(i,e){
              $("#guru_ajr_mapel").append('<p>'+ e.nama_mapel + '</p>');
            });

          }

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
          alert('Error get data from ajax');
        }
      });

    }

    function saveMapel(){

      var url;
      
      url = "<?php echo site_url('admin/guru_mapel_update')?>";
      

       // ajax adding data to database
       $.ajax({
        url : url,
        type: "POST",
        data: $('#formMapel').serialize(),
        dataType: "JSON",
        success: function(data)
        {
              //if success close modal and reload ajax table
              $('#modal_form').modal('hide');
              location.reload();// for reload a page
            },
            error: function (response,jqXHR, textStatus, errorThrown)
            {
              //console.log(response.responseJSON.error);
               $('.alert-danger span').html(response.responseJSON.error); //add response error
               $('.alert-danger').show().delay(4000).fadeOut(); //show the alert
             }

           });

    }
    
  </script>
  


