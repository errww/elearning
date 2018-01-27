
<center><h3>Data Tahun Ajaran</h3></center>
<br />
<button class="btn btn-success" onclick="add()"><i class="glyphicon glyphicon-plus"></i> Add Tahun Ajaran</button>
<br />
<br />
<table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th>ID Tahun Ajaran</th>
      <th>Nama Tahun Ajaran</th>

      
      <th style="width:125px;">Action
      </p></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($thajaran as $thajarans){?>
    <tr>
     <td><?php echo $thajarans->id;?></td>
     <td><?php echo $thajarans->thajaran;?></td>
     <td>
      <button class="btn btn-warning" onclick="edit(<?php echo $thajarans->id;?>)"><i class="glyphicon glyphicon-pencil"></i></button>
      <button class="btn btn-danger" onclick="destroy(<?php echo $thajarans->id;?>)"><i class="glyphicon glyphicon-remove"></i></button>
      
      
    </td>
  </tr>
  <?php }?>
  
  
  
</tbody>

<tfoot>
  <tr>
    <th>ID Tahun Ajaran</th>
    <th>Nama Tahun Ajaran</th>
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
        url : "<?php echo site_url('index.php/admin/ajax_thajaran_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          $('[name="id_thajaran"]').val(data.id);
          $('[name="nama_thajaran"]').val(data.thajaran);
          
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Tahun Ajaran'); // Set title to Bootstrap modal title
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
        url = "<?php echo site_url('index.php/admin/thajaran_add')?>";
      }
      else
      {
        url = "<?php echo site_url('index.php/admin/thajaran_update')?>";
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
          url : "<?php echo site_url('index.php/admin/thajaran_delete')?>/"+id,
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
          <h3 class="modal-title">Tahun Ajaran Form</h3>
        </div>
        <div class="modal-body form">
          <form action="#" id="form" class="form-horizontal">
            <input type="hidden" value="" name="id_thajaran"/>
            <div class="form-body">
              
              <div class="form-group">
                <label class="control-label col-md-3">Tahun Ajaran</label>
                <div class="col-md-9">
                  <input name="nama_thajaran" placeholder="Nama Tahun Ajaran" class="form-control" type="text">
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