
<center>
  <h3>
    <?php echo $th ;?> Data Siswa
  </h3>
</center>
<br>
<div class="panel-group">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" href="#collapse1"><i class="fa fa-chevron-right"></i>Tahun Ajaran</a>
      </h4>
    </div>
    <div id="collapse1" class="panel-collapse collapse">
      <div class="panel-body">


       <div class="container-fluid">
         <div class="row">
           <br>

           <div class="col-md-2">
             <ul>
               <li><a href="<?php echo site_url('admin/siswa')?>"><span class="label label-primary">Semua Siswa</span></a></li>
             </ul>
           </div>

           <?php foreach($thajaran as $row):?>
            <div class="col-md-2">
             <ul>
               <li><a href="<?php echo site_url('admin/siswa/'.$row->id_tahunajaran)?>"><span class="label label-primary"><?php echo $row->tahun;?></span></a></li>
             </ul>
           </div>
         <?php endforeach;?>


       </div>
     </div>

   </div>
 </div>
</div>
</div> 

<br />
<button class="btn btn-success btn-sm" onclick="add_siswa()"><i class="fa fa-plus"></i> Tambah siswa</button>
<br />
<br />
<table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th>No</th>
      <th>NIS Siswa</th>
      <th>Nama Siswa</th>
      <th>Kelas</th>
      <th>Thajaran</th> 
      <th style="width:125px;">Action
      </p></th>
    </tr>
  </thead>
  <tbody>
    <?php $i = 1;  foreach($siswa as $siswas){?>
    <tr>
     <td><?php echo $i++;?></td>
     <td><?php echo $siswas->nis_siswa;?></td>
     <td><?php echo $siswas->nama_siswa;?></td>
     <td><?php echo $siswas->nama_kelas;?></td>
     <td><?php echo $siswas->tahun;?></td>
     <td>
      <button class="btn btn-warning btn-sm" onclick="edit_siswa(<?php echo $siswas->id_siswa;?>)"><i class="fa fa-pencil"></i></button>
      <button class="btn btn-danger btn-sm" onclick="delete_siswa('<?php echo $siswas->id_siswa;?>','<?php echo $siswas->nama_siswa;?>')"><i class="fa fa-trash"></i></button>
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
        <h4 class="modal-title"><i class="fa fa-user"></i> Tambah Siswa</h4>
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
          <input type="hidden" value="" name="id_siswa"/>
          <div class="form-body">

            <div class="form-group">
              <label class="control-label col-md-3">NIS Siswa</label>
              <div class="col-md-9">
                <input name="nis_siswa" placeholder="NIS Siswa" value="" class="form-control" type="number" id="NisSiswa" >
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3">Nama Siswa</label>
              <div class="col-md-9">
                <input name="nama_siswa" placeholder="Nama Siswa" class="form-control" type="text">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3">Password Siswa</label>
              <div class="col-md-9">
                <input name="pass_siswa" placeholder="Password Siswa" class="form-control" type="password">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3">Kelas Siswa</label>
              <div class="col-md-9">
               <select name="kelas_siswa" class="form-control">
                <?php foreach($kelas as $row):?>
                 <option value="<?php echo $row->id_kelas ?>"><?php echo $row->nama_kelas ?></option>
               <?php endforeach;?>
             </select> 
           </div>
         </div>

         <div class="form-group">
          <label class="control-label col-md-3">Tahun Ajaran</label>
          <div class="col-md-9">
           <select name="th_siswa" class="form-control">
            <?php foreach($thajaran as $row):?>
             <option value="<?php echo $row->id_tahunajaran ?>"><?php echo $row->tahun ?></option>
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
            <p>Yakin hapus data siswa <strong id="nmsiswa"></strong> ? </p>
            <br>
            <strong>Data akan dihapus secara permanen.</strong>
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


    function add_siswa()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
    //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
  }

  function edit_siswa(id)
  {
    save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('admin/ajax_siswa_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        { 
          $('[name="id_siswa"]').val(data.id_siswa);
          $('[name="nis_siswa"]').val(data.nis_siswa);
          $('[name="nis_siswa"]').val(data.nis_siswa);
          $('[name="nama_siswa"]').val(data.nama_siswa);

            //$('[name="nis_siswa"]').attr('disabled','disabled');
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').html('<i class="fa fa-edit"></i> Edit Siswa'); // Set title to Bootstrap modal title

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
        url = "<?php echo site_url('admin/siswa_add')?>";
      }
      else
      {
        url = "<?php echo site_url('admin/siswa_update')?>";
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

     function delete_siswa(id_siswa,nama_siswa)
     {


      $('#modal_form_delete').modal('show'); // show bootstrap modal
      $('#nmsiswa').html(nama_siswa);

      $('#btnDelete').click(function(event){

        // ajax delete data from database
        $.ajax({
          url : "<?php echo site_url('admin/siswa_delete')?>/"+ id_siswa,
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
