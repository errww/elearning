<style type="text/css">
.glyphicon { margin-right:10px; }
.panel-body { padding:0px; }
.panel-body table tr td { padding-left: 15px }
.panel-body .table {margin-bottom: 0px; }
.container { margin-top: 15px; }
</style>
<div class="container">
    <div class="row">

        <div class="col-sm-3 col-md-3">
        <?php
	        if(empty($navigation)){
	        	$this->load->view('content/private/nav');
	        }elseif($navigation == 'guru'){
	        	$this->load->view('content/private/navguru');
	        }elseif($navigation == 'siswa'){
                $this->load->view('content/private/navsiswa');
            }
	        ?>    
        </div>

        <div class="col-sm-9 col-md-9">    
            <?php  if($content){ $this->load->view($content); } ?>
        </div>

    </div>
</div>


