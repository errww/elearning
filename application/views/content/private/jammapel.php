<div class="row">
  <div class="col-md-6">
    <ol class="breadcrumb">
      <li><a href="<?php echo site_url('admin');?>">Dashboard</a></li>
      <li class="active">Jam Mapel</li>
    </ol>
  </div>
</div>

<br />
<button class="btn btn-success btn-sm" onclick="add()"><i class="fa fa-plus"></i> Tambah Jam</button>
<br />
<br />
<table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th>No</th>
      <th>Kelas</th>
      <th>Hari</th>
      <th>Jam Mulai</th>
      <th>Jam Selesai</th>
      <th>Mata Pelajaran</th>
      <th>Guru</th>
      <th style="width:125px;">Action
      </p></th>
    </tr>
  </thead>
  <tbody>
    <?php $i = 1; foreach($jammapel as $jammapels){?>
    <tr>
     <td><?php echo $i++ ;?></td>
     <td><?php echo $jammapels->nama_kelas;?></td>
     <td><?php echo $jammapels->nama_hari;?></td>
     <td><?php echo $jammapels->jam_mulai;?></td>
     <td><?php echo $jammapels->jam_selesai;?></td>
     <td><?php echo $jammapels->nama_mapel;?></td>
     <td><?php echo $jammapels->nama;?></td>
     <td>
      <button class="btn btn-warning btn-sm" onclick="edit(<?php echo $jammapels->idmp;?>)"><i class="fa fa-pencil"></i></button>
      <button class="btn btn-danger btn-sm" onclick="destroy(<?php echo $jammapels->idmp;?>)"><i class="fa fa-trash"></i></button>


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
          <h4 class="modal-title">Jam Mata Pelajaran Form</h4>
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
            <input type="hidden" value="" name="id_jammapel"/>
            <div class="form-body">

              <div class="form-group">
                <label class="control-label col-md-4">Kelas</label>
                <div class="col-md-8">
                  <select name="kelas_id" class="form-control">
                    <?php foreach($kelas as $row):?>
                     <option value="<?php echo $row->id_kelas ?>"><?php echo $row->nama_kelas ?></option>
                   <?php endforeach;?>
                 </select> 
               </div>
             </div>

             <div class="form-group">
              <label class="control-label col-md-4">Hari</label>
              <div class="col-md-8">
                <select name="hari_id" class="form-control">
                  <?php foreach($hari as $row):?>
                   <option value="<?php echo $row->id_hari ?>"><?php echo $row->nama_hari ?></option>
                 <?php endforeach;?>
               </select> 
             </div>
           </div>

           <div class="form-group">
            <div class="col-md-4">
              <label class="control-label pull-right">Jam</label>
            </div>
            <div class="col-md-4 start">
              <input name="start" placeholder="Start" class="form-control" type="text">
            </div>
            <div class="col-md-4 end">
              <input name="end" placeholder="End" class="form-control" type="text">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-4">Mata Pelajaran</label>
            <div class="col-md-8">
              <select name="mapel_id" class="form-control">
                <?php foreach($mapel as $row):?>
                  <option value="<?php echo $row->id_mapel ?>"><?php echo $row->nama_mapel ?></option>
                <?php endforeach;?>
              </select> 
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-4">Guru</label>
            <div class="col-md-8">
              <select name="guru_id" class="form-control">
                <?php foreach($guru as $row):?>
                 <option value="<?php echo $row->id ?>"><?php echo $row->nama ?></option>
               <?php endforeach;?>
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
            <p>Apakah anda yakin akan <strong>menghapus data jam mata pelajaran ini ?</strong>  </p>
            <hr>
            <p class="text-small">Denga meng-klik tombol <strong>hapus</strong> anda akan kehilangan data ini secara permanen.</p>
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

    $('.start').clockpicker({
     donetext: 'Done',
   });
    $('.end').clockpicker({
     donetext: 'Done',
   });

  });
    var save_method; //for save method string
    var table;


    function add()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
      $('.modal-title').html('<i class="fa fa-calendar"></i>Jam Mapel'); // Set Title to Bootstrap modal title
    }

    function edit(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('admin/ajax_jammapel_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",

        success: function(data)
        {
          $('[name="id_jammapel"]').val(data.id);
          $('[name="start"]').val(data.jam_mulai);
          $('[name="end"]').val(data.jam_selesai);
          $('[name="mapel_id"]').val(data.idmp);
          $('[name="hari_id"]').val(data.id_hari);
          $('[name="guru_id"]').val(data.grid);
          $('[name="kelas_id"]').val(data.id_kelas);

          //console.log(data.id_kelas);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').html('<i class="fa fa-calendar"></i> Edit Jam Mapel'); // Set title to Bootstrap modal title
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
        url = "<?php echo site_url('admin/jammapel_add')?>";
      }
      else
      {
        url = "<?php echo site_url('admin/jammapel_update')?>";
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

     function destroy(id_jammapel)
     {

      $('#modal_form_delete').modal('show'); // show bootstrap modal

      $('#btnDelete').click(function(event){

        // ajax delete data from database
        $.ajax({
          url : "<?php echo site_url('admin/jammapel_delete')?>/"+ id_jammapel,
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


