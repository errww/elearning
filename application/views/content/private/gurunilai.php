
<<<<<<< HEAD
<center><h3>Data Nilai</h3></center>
<br />
<br />
<button class="btn btn-success" onclick="add_guru()"><i class="glyphicon glyphicon-plus"></i> Add nilai</button>
<br />
<br />
<table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th>No</th>
      <th>Title</th>
      <!-- <th>Tahun Ajar</th> -->
      <th>Mapel</th>
      <!-- <th>Semester</th> -->
      <!-- <th>Guru</th> -->
      <th>File</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php $i = 1; foreach($nilai as $nilai):?>
    <tr>
     <td><?php echo $i++;?></td>
     <td><?php echo $nilai->title;?></td>
     <!-- <td><?php echo $nilai->thajaran;?></td> -->
     <td><?php echo $nilai->mapel;?></td>
     <!-- <td><?php echo $nilai->semester;?></td> -->
     <!-- <td><?php echo $nilai->nama;?></td> -->
     <td>
       <?php $txt_file =(is_null($nilai->file)) ? 'Belum ada file' : $nilai->file ;?>
       <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><?php echo $txt_file ?>
          <span class="caret"></span></button>
          <ul class="dropdown-menu">
            <?php if(is_null($nilai->file)){?>
            <li><a href="#" onclick="uploadFile(<?php echo $nilai->id;?>)">Upload File <i class="fa fa-upload"></i></a></li>
            <li role="separator" class="divider"></li>
            <?php }else{ ?>
            <li><a href="#" onclick="uploadFile(<?php echo $nilai->id;?>)">Update File <i class="fa fa-edit"></i></a></li>
            <li role="separator" class="divider"></li>
            <li><a href="<?php echo site_url('guru/download_file_nilai/');?><?php echo $nilai->file ;?>">Download File <i class="fa fa-download"></i></a></li>
            <?php } ?>
          </ul>
        </div>  
      </td>
      <td>
        <button class="btn btn-warning btn-sm" onclick="edit(<?php echo $nilai->id;?>)"><i class="fa fa-pencil"></i></button>
        <button class="btn btn-danger btn-sm" onclick="destroy(<?php echo $nilai->id;?>)"><i class="fa fa-trash"></i></button>
      </td>
    </tr>
  <?php endforeach; ?>
</tbody>

<tfoot>
  <tr>
    <th>No</th>
    <th>Title</th>
    <!-- <th>Tahun Ajar</th> -->
    <th>Mapel</th>
    <!-- <th>Semester</th> -->
    <!-- <th>Guru</th> -->
    <th>File</th>
    <th>Action</th>
  </tr>
</tfoot>
</table>

<script type="text/javascript">
=======
    <center><h3>Data Nilai</h3></center>
    <br />
    <br />
    <button class="btn btn-success" onclick="add_guru()"><i class="glyphicon glyphicon-plus"></i> Add Nilai</button>
    <br />
    <br />
    <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>Judul</th>
          <th>Kelas</th>
          <th>Mapel</th>
          <th style="width:125px;">Action</p></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($nilai as $nilais){?>
        <tr>
         <td><?php echo $nilais->judul;?></td>
         <td><?php echo $nilais->nama_kelas;?></td>
         <td><?php echo $nilais->mapel;?></td>
         <td>
          <button class="btn btn-warning" onclick="edit(<?php echo $nilais->idnilai;?>)"><i class="glyphicon glyphicon-pencil"></i></button>
          <button class="btn btn-danger" onclick="destroy(<?php echo $nilais->idnilai;?>)"><i class="glyphicon glyphicon-remove"></i></button>
        </td>
      </tr>
      <?php }?>
    </tbody>

    <tfoot>
      <tr>
          <th>Judul</th>
          <th>Kelas</th>
          <th>Mapel</th>
        <th>Action</th>
      </tr>
    </tfoot>
  </table>
 
  <script type="text/javascript">
>>>>>>> 169892635b040823da7f2349a2a35947e0ef8e70
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
    //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
  }

  function edit(id)
  {
    save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('index.php/guru/ajax_nilai_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        { 
          $('[name="id_nilai"]').val(data.id);
          $('[name="title"]').val(data.title);
          $('[name="mapel"]').val(data.id_mapel);
          $('[name="thajaran"]').val(data.id_tahunajaran);
          $('[name="semester"]').val(data.semester);

          $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
          $('.modal-title').text('Edit Nilai'); // Set title to Bootstrap modal title

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
        url = "<?php echo site_url('guru/nilai_add')?>";
      }
      else
      {
        url = "<?php echo site_url('index.php/guru/nilai_update')?>";
      }
<<<<<<< HEAD

      var postData = {
        'id_nilai' : $('input[name=id_nilai]').val(),
        'title': $('input[name=title]').val(),
        'mapel': $('[name=mapel]').val(),
        'thajaran': $('[name=thajaran]').val(),
        'semester': $('[name=semester]').val()
      }
      

       //hide the submit button
       $('button[id=btnSave]').hide();
      //show the loading gif
      $('#loadingAdmin').show();

       // ajax adding data to database
       $.ajax({
        url : url,
        type: "POST",
        data: postData,
        dataType: "JSON",
        success: function(response)
        {
            //if success close modal and reload ajax table
            $('#modal_form').modal('hide');
=======
        var form = $('form')[0];
         var formData = new FormData(form);
       // ajax adding data to database
          $.ajax({
            url : url,
            type: "POST",
            //data: $('#form').serialize(),
            data : formData,
            dataType: "JSON",
            cache: false,
            contentType: false,
            processData: false,
            success: function(data)
            {
               //if success close modal and reload ajax table
               $('#modal_form').modal('hide');
>>>>>>> 169892635b040823da7f2349a2a35947e0ef8e70
              location.reload();// for reload a page
           //console.log(data.status);
           //console.log(data.msg);
            },
<<<<<<< HEAD
            error: function (response,textStatus, jqXHR)
            {
            //console.log(response.responseJSON.error);
            $('.alert-danger').html(response.responseJSON.error); //add response error
            $('.alert-danger').show().delay(4000).fadeOut(); //show the alert
            $('button[id=btnSave]').show(); // show the button submit
            $('#loadingAdmin').hide(); //hide the loading gif
          }
=======
            error: function (jqXHR, textStatus, errorThrown,status)
            {
                alert('Error adding / update data');
                
            }
>>>>>>> 169892635b040823da7f2349a2a35947e0ef8e70
        });
     }

     function destroy(id)
     {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data from database
        $.ajax({
          url : "<?php echo site_url('guru/nilai_delete')?>/" +id,
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

      }
    }

    //show modal upload file
    function uploadFile(id){

      $('#formUpload')[0].reset(); // reset form on modals
      $('#modal_file_upload').modal('show'); // show bootstrap modal
      $('[name="id_nilai"]').val(id);

    }

    //save upload
    function saveUpload(){

      var id_nilai = $('input[name=id_nilai]').val()
      var url;

      url = "<?php echo site_url('guru/nilai_file_add/')?>" + id_nilai ;

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
<<<<<<< HEAD

     }


   </script>



   <!-- Bootstrap modal for add nilai -->
   <div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title">Nilai </h3>
        </div>
        <div class="modal-body form">

          <div class="alert alert-danger" style="display: none;"></div>
          <div class="alert alert-success" style="display: none;"></div>

          <form action="#" id="form" class="form-horizontal" enctype="multipart/form-data">
            <input type="hidden" value="" name="id_nilai"/>
            <div class="form-body">

              <div class="form-group">
                <label class="col-md-2">Title</label>
                <div class="col-md-9">
                  <input type="text" name="title" class="form-control" placeholder="Title">
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-2">Mapel</label>
                <div class="col-md-9">
                  <select class="form-control" name="mapel">
                    <?php foreach($mapel as $mapel):?>
                      <option value="<?php echo $mapel['id']?>"><?php echo $mapel['mapel']?></option>
                    <?php endforeach;?>
                  </select>
                </div>
              </div>  
              
              <div class="form-group">
                <label class="col-md-2">Tahun Ajaran</label>
                <div class="col-md-9">
                  <select class="form-control" name="thajaran">
                    <?php foreach($thajaran as $thajaran):?>
                      <option value="<?php echo $thajaran['id']?>"><?php echo $thajaran['thajaran']?></option>
                    <?php endforeach;?>
                  </select>
                </div>
              </div> 

              <div class="form-group">
                <label class="col-md-2">Semester</label>
                <div class="col-md-9">
                  <select class="form-control" name="semester">
                    <?php foreach($semester as $semester):?>
                      <option value="<?php echo $semester['id']?>"><?php echo $semester['semester']?></option>
                    <?php endforeach;?>
                  </select>
                </div>
              </div> 

            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          <img id="loadingAdmin" src="<?php echo base_url() ?>/assets/img/spinner.gif"" style="display: none;">
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
=======
 
      }
    }
 
  </script>
 


  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Nilai Form</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal"  enctype="multipart/form-data">
          <input type="hidden" value="<?php echo $id; ?>" name="id_guru"/>
          <div class="form-body">

          <div class="form-group">
              <label class="control-label col-md-3">Kelas Siswa</label>
              <div class="col-md-9">
                 <select name="kelas_id" class="form-control">
                    <?php foreach($kelas as $row):?>
                     <option value="<?php echo $row->id_kelas ?>"><?php echo $row->nama_kelas ?></option>
                    <?php endforeach;?>
                  </select> 
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3">Mapel</label>
              <div class="col-md-9">
                 <select name="mapel_id" class="form-control">
                    <?php foreach($mapel as $row):?>
                     <option value="<?php echo $row->id ?>"><?php echo $row->mapel ?></option>
                    <?php endforeach;?>
                  </select> 
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3">Nilai</label>
              <div class="col-md-9">
                <input name="userfile" placeholder="Nilai"  class="form-control" type="file" id="userfile" required="" />
              </div>
            </div> 

              <div class="form-group">
              <label class="control-label col-md-3">Judul</label>
              <div class="col-md-9">
                <input name="judul" placeholder="Judul"  class="form-control" type="text" required="" />
              </div>
            </div> 

          </div>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
>>>>>>> 169892635b040823da7f2349a2a35947e0ef8e70
  <!-- End Bootstrap modal -->

  <div class="modal fade" id="modal_file_upload" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title">Nilai: Upload File </h3>
        </div>
        <div class="modal-body form">

          <div class="alert alert-danger" style="display: none;"></div>
          <div class="alert alert-success" style="display: none;"></div>

          <form action="#" id="formUpload" class="form-horizontal" enctype="multipart/form-data">
            <input type="hidden"  name="id_nilai"/>
            <div class="form-body">

              <div class="form-group">
                <label class="col-md-2">File</label>
                <div class="col-md-9">
                  <input type="file" name="file" class="form-control" id="file">
                </div>
              </div>

            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" id="btnSaveUpload" onclick="saveUpload()" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          <img id="loadingUpload" src="<?php echo base_url() ?>/assets/img/spinner.gif"" style="display: none;">
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>

