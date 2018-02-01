<div class="panel-group" id="accordion">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a  href="<?php echo base_url('admin')?>"><i class="fa fa-home"></i> Beranda</a>
            </h4>
        </div>
    </div>



    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThajaran"><i class="fa fa-globe"></i> Tahun Ajaran</a>
            </h4>
        </div>
        <div id="collapseThajaran" class="panel-collapse collapse <?php if ($this->uri->segment(2) =='thajaran') { echo 'in'; }?>">
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <td>
                            <a href="<?php echo base_url('admin/thajaran')?>">Data Tahun Ajaran</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseKelas"><i class="fa fa-building"></i> Kelas</a>
            </h4>
        </div>
        <div id="collapseKelas" class="panel-collapse collapse <?php if ($this->uri->segment(2) =='kelas') { echo 'in'; }?>">
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <td>
                            <a href="<?php echo base_url('admin/kelas')?>">Data Kelas</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseGuru"><i class="fa fa-user-circle-o"></i> Guru</a>
            </h4>
        </div>
        <div id="collapseGuru" class="panel-collapse collapse <?php if ($this->uri->segment(2) =='guru') { echo 'in'; }?>">
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <td>
                            <a href="<?php echo base_url('admin/guru')?>">Data Guru</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseMapel"><i class="fa fa-book"></i> Mata Pelajaran</a>
            </h4>
        </div>
        <div id="collapseMapel" class="panel-collapse collapse <?php if ($this->uri->segment(2) =='mapel') { echo 'in'; }?>">
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <td>
                            <a href="<?php echo base_url('admin/mapel')?>">Data Mata Pelajaran</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="<?php echo base_url('admin/jammapel')?>">Jam Mata Pelajaran</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"><i class="fa fa-users"></i> Siswa</a>
            </h4>
        </div>
        <div id="collapseThree" class="panel-collapse collapse <?php if ($this->uri->segment(2) =='siswa') { echo 'in'; }?>">
            <div class="panel-body">
                <ul>
                    <li><a href="<?php echo base_url('admin/siswa')?>">Semua Data Siswa</a></li>
                    <?php
                    foreach($thajaran as $row)
                        { ?>
                    <li><a href="<?php echo base_url('admin/siswa/'.$row->id_tahunajaran)?>"><?php echo $row->tahun;?></a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
</div>



<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a href="<?php echo base_url('admin/logout')?>"><span class="glyphicon glyphicon-file">
            </span>Log Out</a>
        </h4>
    </div>

</div>

</div>