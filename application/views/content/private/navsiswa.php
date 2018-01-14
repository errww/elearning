<div class="panel-group" id="accordion">
    <?php echo 'nama :'.$nama; ?>
    <?php echo 'nik :'.$nik; ?>


    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapsePesan"><i class="fa fa-building"></i> Jadwal</a>
            </h4>
        </div>
        <div id="collapsePesan" class="panel-collapse collapse <?php if ($this->uri->segment(2) =='jadwal') { echo 'in'; }?>">
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <td>
                            <a href="<?php echo base_url('siswa/jadwal')?>">Jadwal Siswa</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a href="<?php echo base_url('siswa/logout')?>"><span class="glyphicon glyphicon-file">
                </span>Log Out</a>
            </h4>
        </div>
        
    </div>

</div>