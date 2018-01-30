
    <center><h3>Data Materi</h3></center>
    <br />
    <br />
    <button class="btn btn-success" onclick="add_guru()"><i class="glyphicon glyphicon-plus"></i> Add Materi</button>
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
        <?php foreach($materi as $materis){?>
        <tr>
         <td><?php echo $materis->judul;?></td>
         <td><?php echo $materis->nama_kelas;?></td>
         <td><?php echo $materis->mapel;?></td>
         <td>
          <button class="btn btn-warning" onclick="edit(<?php echo $materis->idmateri;?>)"><i class="glyphicon glyphicon-pencil"></i></button>
          <button class="btn btn-danger" onclick="destroy(<?php echo $materis->idmateri;?>)"><i class="glyphicon glyphicon-remove"></i></button>
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
            $('[name="id_guru"]').val(data.id);
            $('[name="nik"]').val(data.nik);
            $('[name="nama"]').val(data.nama);
 
            $('[name="nis_guru"]').attr('disabled','disabled');
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
          url = "<?php echo site_url('index.php/guru/materi_add')?>";
      }
      else
      {
        url = "<?php echo site_url('index.php/guru/materi_update')?>";
      }
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
              location.reload();// for reload a page
           //console.log(data.status);
           //console.log(data.msg);
            },
            error: function (jqXHR, textStatus, errorThrown,status)
            {
                alert('Error adding / update data');
                
            }
        });
    }
 
    function destroy(id)
    { 
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data from database
          $.ajax({
             url : "<?php echo site_url('index.php/guru/materi_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
               //console.log(id);
               location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
      }
    }
 
  </script>
 


  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Materi Form</h3>
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
              <label class="control-label col-md-3">Materi</label>
              <div class="col-md-9">
                <input name="userfile" placeholder="Materi"  class="form-control" type="file" id="userfile" required="" />
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
  <!-- End Bootstrap modal -->
 
