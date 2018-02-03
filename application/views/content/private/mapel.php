
<div class="row">
  <div class="col-md-6">
    <ol class="breadcrumb">
      <li><a href="<?php echo site_url('admin');?>">Dashboard</a></li>
      <li class="active">Data Mata Pelajaran</li>
    </ol>
  </div>
</div>
<br />
<button class="btn btn-success btn-sm" onclick="add()"><i class="fa fa-plus"></i> Tambah Mapel</button>
<br />
<br />
<table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama Mapel</th>
      <th style="width:125px;">Action
      </p></th>
    </tr>
  </thead>
  <tbody>
    <?php $i =1 ; foreach($mapel as $mapels){?>
    <tr>
      <td><?php echo $i++ ;?></td>
      <td><?php echo $mapels->nama_mapel;?></td>
      <td>
        <button class="btn btn-warning btn-sm" onclick="edit(<?php echo $mapels->id_mapel;?>)"><i class="fa fa-pencil"></i></button>
        <button class="btn btn-danger btn-sm" onclick="destroy('<?php echo $mapels->id_mapel;?>','<?php echo $mapels->nama_mapel;?>')"><i class="fa fa-trash"></i></button>

      </td>
    </tr>
    <?php }?>
  </tbody>
</table>




<script type="text/javascript">
  $(document).ready( function () {
    $('#table_id').DataTable();
  } );
    var save_method; //for save method string
    var table;


    function add()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
      $('.modal-title').html('<i class="fa fa-book"></i> Tambah Mapel'); // Set Title to Bootstrap modal title
  }

  function edit(id)
  {
    save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('admin/ajax_mapel_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          $('[name="id_mapel"]').val(data.id_mapel);
          $('[name="nama_mapel"]').val(data.nama_mapel);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').html('<i class="fa fa-book"></i> Edit Mapel'); // Set title to Bootstrap modal title
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
        url = "<?php echo site_url('admin/mapel_add')?>";
      }
      else
      {
        url = "<?php echo site_url('admin/mapel_update')?>";
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
               $('.alert-danger span').html(response.responseJSON.error); //add response error
               $('.alert-danger').show().delay(4000).fadeOut(); //show the alert
            }
          });
     }

    function destroy(id_mapel,nama_mapel)
     {
     

      $('#modal_form_delete').modal('show'); // show bootstrap modal
      $('#nmmapel').html(nama_mapel);

      $('#btnDelete').click(function(event){

        // ajax delete data from database
        $.ajax({
          url : "<?php echo site_url('admin/mapel_delete')?>/"+ id_mapel,
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

  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Mata Pelajaran Form</h4>
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
            <input type="hidden" value="" name="id_mapel"/>
            <div class="form-body">
              <div class="form-group">
                <label class="control-label col-md-3">Mata Pelajaran</label>
                <div class="col-md-9">
                  <input name="nama_mapel" placeholder="Nama Mapel" class="form-control" type="text">
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
            <p>Menghapus data <strong>mapel</strong> akan menyebabkan anda <strong>kehilangan data</strong> pada relasi <strong>data jam mapel</strong>, <strong> data materi</strong>, <strong>data nilai</strong>  yang dimiliki oleh mapel <strong id="nmmapel"></strong> ! </p>
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