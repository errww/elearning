
    <center><h3>Jam Mata Pelajaran</h3></center>
    <br />
    <button class="btn btn-success" onclick="add()"><i class="glyphicon glyphicon-plus"></i> Add Jam Mata Pelajaran</button>
    <br />
    <br />
    <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
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
                <?php foreach($jammapel as $jammapels){?>
                     <tr>
                         <td><?php echo $jammapels->nama_kelas;?></td>
                         <td><?php echo $jammapels->nama_hari;?></td>
                         <td><?php echo $jammapels->jam_mulai;?></td>
                         <td><?php echo $jammapels->jam_selesai;?></td>
                         <td><?php echo $jammapels->mapel;?></td>
                         <td><?php echo $jammapels->nama;?></td>
                                <td>
                                    <button class="btn btn-warning" onclick="edit(<?php echo $jammapels->idmp;?>)"><i class="glyphicon glyphicon-pencil"></i></button>
                                    <button class="btn btn-danger" onclick="destroy(<?php echo $jammapels->idmp;?>)"><i class="glyphicon glyphicon-remove"></i></button>
 
 
                                </td>
                      </tr>
                     <?php }?>
 
 
 
      </tbody>
 
      <tfoot>
        <tr>
          <th>Kelas</th>
          <th>Hari</th>
          <th>Jam Mulai</th>
          <th>Jam Selesai</th>
          <th>Mata Pelajaran</th>
           <th>Guru</th>
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
 
 
    function add()
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
        url : "<?php echo site_url('index.php/admin/ajax_jammapel_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",

        success: function(data)
        {
            $('[name="id_jammapel"]').val(data.idmp);
            $('[name="start"]').val(data.jam_mulai);
            $('[name="end"]').val(data.jam_selesai);
            $('[name="mapel_id"]').val(data.idmp);
            $('[name="hari_id"]').val(data.id_hari);
            $('[name="guru_id"]').val(data.grid);
            $('[name="kelas_id"]').val(data.id_kelas);

  console.log(data.id_kelas);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Jam Pelajaran'); // Set title to Bootstrap modal title
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
          url = "<?php echo site_url('index.php/admin/jammapel_add')?>";
      }
      else
      {
        url = "<?php echo site_url('index.php/admin/jammapel_update')?>";
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
            error: function (jqXHR, textStatus, errorThrown)
            {
                //console.log(jqXHR);
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
            url : "<?php echo site_url('index.php/admin/mapel_delete')?>/"+id,
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
 
  </script>

  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Jam Mata Pelajaran Form</h3>
      </div>
      <div class="modal-body form">
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

            <script type="text/javascript">
            $('.start').clockpicker({
               donetext: 'Done',
            });
            $('.end').clockpicker({
               donetext: 'Done',
            });
            </script>

            <div class="form-group">
              <label class="control-label col-md-4">Mata Pelajaran</label>
              <div class="col-md-8">
                  <select name="mapel_id" class="form-control">
                    <?php foreach($mapel as $row):?>
                     <option value="<?php echo $row->id ?>"><?php echo $row->mapel ?></option>
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
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->