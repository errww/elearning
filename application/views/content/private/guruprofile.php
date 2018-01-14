
    <center><h3>Profile guru</h3></center>
    <br />
  <script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
  <script type="text/javascript">
  $(document).ready( function () {
      $('#table_id').DataTable();
  } );
    var save_method; //for save method string
    var table;
  
    function save()
    {
      for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }

      var url;
        url = "<?php echo site_url('index.php/guru/profile_update')?>";
       // ajax adding data to database
          $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               //if success close modal and reload ajax table
              location.reload();// for reload a page
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
    }
  </script>

  <form action="#" id="form" class="form-horizontal">
  <div class="form-group">
  <textarea name="txt1" class="form-control" type="text"><?php echo $profile; ?></textarea>
    <script>
      CKEDITOR.replace( 'txt1' );
    </script>
    </div>
  <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
  </form>