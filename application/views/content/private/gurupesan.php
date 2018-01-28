
<center><h3>Data Pesan Informasi</h3></center>
<br />
<script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>

<button type="button" class="btn btn-success btn-lg" id="btn-toggle"><i id="icon-toggle" class="fa fa-plus-square"></i> Tambah Informasi</button>

<br>
<br>

<div class="panel panel-primary" id="form-informasi" style="display: none;">
  <form action="#" id="formInformasi" class="form-horizontal" enctype="multipart/form-data">
   <div class="panel-footer">
    <div class="container-fluid">

      <div class="alert alert-danger" style="display: none;"></div>
      <div class="alert alert-success" style="display: none;"></div>
      
      <input name="id" class="form-control" type="hidden">
      
      <div class="form-group">
       <div class="col-md-8">
        <label>Title</label>
        <input name="title" class="form-control" type="text">
      </div>
    </div>
    <div class="form-group">
      <textarea name="isi" class="form-control"></textarea>
      <script>
        CKEDITOR.replace( 'isi' );
      </script>
    </div>
  </div>
</div>
<div class="panel-footer">
  <button type="submit" id="btnSave" class="btn btn-primary">Simpan</button>
  <button type="button" id="btnUpdate" class="btn btn-primary" style="display: none;" onclick="update()">Update Data</button>
  <button type="button" id="btnCancel" class="btn btn-primary" style="display: none;" onclick="exit()">Close</button>

  <img id="loadingAdmin" src="<?php echo base_url() ?>/assets/img/spinner.gif"" style="display: none;">
</div>
</form>
</div>


<table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th style="width:50px;"">No</th>
      <th>Judul</th>
      <th style="width:50px;">
        Action
      </th>
    </tr>
  </thead>
  <tbody>

    <?php $i = 1; foreach($pesan as $pesan):?>
    <tr>
      <td><?php echo $i++ ?></td>
      <td><strong><?php echo $pesan['title'];?></strong></td>
      <td>
        <button class="btn btn-warning btn-sm" onclick="edit(<?php echo $pesan['id'];?>)">
          <i class="fa fa-pencil"></i>
        </button>
        <button class="btn btn-danger btn-sm" onclick="destroy(<?php echo $pesan['id'];?>)">
          <i class="fa fa-trash"></i>
        </button>
      </td>
    </tr>
  <?php endforeach;?>

</tbody>

<tfoot>
  <tr>
    <th>No</th>
    <th>Judul</th>
    <th>Action</th>
  </tr>
</tfoot>
</table>



<script type="text/javascript">

  $(document).ready( function () {

    //datatable
    $('#table_id').DataTable();

    //toogling button
    $("#btn-toggle").click(function(){
      $("#form-informasi").toggle();
      $("#icon-toggle", this).toggleClass("fa fa-plus-square  fa fa-minus-square");
    });


    //save informasi
    $('#form-informasi').submit(function(event){
      event.preventDefault();

    //hide the submit button
    $('button[type=submit]').hide();
    //show the loading gif
    $('#loadingAdmin').show();

    var postData = {
      'title': $('input[name=title]').val(),
      'isi': $('textarea[name=isi]').val(),
    }

    $.ajax({
      type: 'POST',
      url: 'pesan_save/',
      dataType: "JSON",
      data: postData,
      success: function(response){

        //window.location.href = response.redirect ;
        location.reload();
      },
      error: function(response){
        //console.log(response.responseJSON.error);
        $('.alert-danger').html(response.responseJSON.error); //add response error
        $('.alert-danger').show().delay(1000).fadeOut(); //show the alert
        $('button[type=submit]').show(); // show the button submit
        $('#loadingAdmin').hide(); //hide the loading gif

      }
    });
  });


  });

  

  // var save_method; //for save method string
  // var table;


  //edit data
  function edit(id)
  {
    
    $('html, body').animate({scrollTop:0}, 'slow');
    $("#form-informasi").show();

    $('#btnSave').hide();
    $('#btnUpdate').show();
    $('#btnCancel').show();


      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('/guru/pesan_get_edit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          $('[name="id"]').val(data.id);
          $('[name="title"]').val(data.title);
          CKEDITOR.instances.isi.setData(data.isi);
          
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
          alert('Error get data from ajax');
        }
      });

    }

  //update data
  function update(){

    //event.preventDefault();
   
   //i dont know
   for (instance in CKEDITOR.instances) {
      CKEDITOR.instances[instance].updateElement();
    }
  

    //hide the submit button
    $('button[id=btnUpdate]').hide();
    $('button[id=btnCancel]').hide();
    //show the loading gif
    $('#loadingAdmin').show();

    $.ajax({
      url : "<?php echo site_url('/guru/pesan_update')?>",
      type: "POST",
      data: $('#formInformasi').serialize(),
      dataType: "JSON",
      success: function(response)
      {

        //location.reload();
        console.log(response.success);
        $('.alert-success').html(response.success); //add response 
        $('.alert-success').show().delay(2000).fadeOut(); //show the alert
        $('#loadingAdmin').hide(); //hide the loading gif
        $('button[id=btnUpdate]').show();
        $('button[id=btnCancel]').show();
      },
      error: function (response)
      {
       //console.log(response.responseJSON.error);
        $('.alert-danger').html(response.responseJSON.error); //add response error
        $('.alert-danger').show().delay(1000).fadeOut(); //show the alert
        $('button[id=btnUpdate]').show();
        $('button[id=btnCancel]').show();
        $('#loadingAdmin').hide(); //hide the loading gif
      }
    });


  }

  //destroy data
  function destroy(id)
  {
    if(confirm('Yakin hapus data?'))
    {
        // ajax delete data from database
        $.ajax({
          url : "<?php echo site_url('guru/pesan_hapus')?>/"+id,
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

  //close form
  function exit(){
   
    $('#formInformasi')[0].reset(); 
    CKEDITOR.instances.isi.setData();
    
    
    $('button[id=btnUpdate]').hide();
    $('button[id=btnCancel]').hide();
    $('button[id=btnSave]').show();
    $('#form-informasi').hide();

  }

  </script>
