
<div class="row">
  <div class="col-md-6">
    <ol class="breadcrumb">
      <li><a href="<?php echo site_url('admin');?>">Dashboard</a></li>
      <li class="active">Data Kelas</li>
    </ol>
  </div>
</div>
<br />
<button class="btn btn-success btn-sm" onclick="add_kelas()"><i class="fa fa-plus"></i> Tambah Kelas</button>
<br />
<br />
<table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th style="width: 50px;">No</th>
      <th>Nama Kelas</th>
      <th style="width: 70px;">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php $i = 1; foreach($kelas as $kelass){?>
    <tr>
     <td><strong><?php echo $i++;?></strong></td>
     <td><?php echo $kelass->nama_kelas;?></td>
     <td>
      <button class="btn btn-warning btn-sm" onclick="edit_kelas(<?php echo $kelass->id_kelas;?>)"><i class="fa fa-pencil"></i></button>
      <button class="btn btn-danger btn-sm" onclick="delete_kelas('<?php echo $kelass->id_kelas;?>','<?php echo $kelass->nama_kelas;?>')"><i class="fa fa-trash"></i></button>
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
        <h4 class="modal-title">Kelas Form</h4>
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
          <input type="hidden" value="" name="id_kelas"/>
          <div class="form-body">

            <div class="form-group">
              <label class="control-label col-md-3">Nama Kelas</label>
              <div class="col-md-9">
                <input name="nama_kelas" placeholder="Nama Kelas" class="form-control" type="text">
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
            <p>Menghapus <strong>data kelas</strong> akan menyebabkan anda <strong>kehilangan data</strong> pada relasi <strong>data jadwal</strong>, <strong>data materi</strong>, <strong>data nilai</strong>, <strong>data siswa</strong> yang memiliki kelas <strong id="nmkelas"></strong>. 
            <br>
            <br>
            <strong>Sehingga data diatas tidak dapat ditampilkan.</strong>
            </p>
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


<script type="text/javascript">
  $(document).ready( function () {
    $('#table_id').DataTable();
  } );
    var save_method; //for save method string
    var table;


    function add_kelas()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
      $('.modal-title').html('<i class="fa fa-edit"></i>  Tambah Kelas');
    }

    function edit_kelas(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('admin/ajax_kelas_edit/')?>" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          $('[name="id_kelas"]').val(data.id_kelas);
          $('[name="nama_kelas"]').val(data.nama_kelas);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').html('<i class="fa fa-edit"></i>  Edit Kelas'); // Set title to Bootstrap modal title

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
        url = "<?php echo site_url('admin/kelas_add')?>";
      }
      else
      {
        url = "<?php echo site_url('admin/kelas_update')?>";
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

     function delete_kelas(id,nama_kelas)
     {

      $('#modal_form_delete').modal('show'); // show bootstrap modal
      $('#nmkelas').html(nama_kelas);

      $('#btnDelete').click(function(event){

        // ajax delete data from database
        $.ajax({
          url : "<?php echo site_url('admin/kelas_delete')?>/"+ id,
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

  </script>