
<div class="panel-group" id="accordion">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseDashboard"><i class="fa fa-dashboard"></i> Dashboard</a>
            </h4>
        </div>
        <div id="collapseDashboard" class="panel-collapse collapse <?php if ($this->uri->segment(1) =='guru' && $this->uri->segment(2) =='' ) { echo 'in'; }?>">
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <td>
                            <a href="<?php echo base_url('guru')?>">Dashboard</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseProfile"><i class="fa fa-user"></i> Profile</a>
            </h4>
        </div>
        <div id="collapseProfile" class="panel-collapse collapse <?php if ($this->uri->segment(2) =='profile') { echo 'in'; }?>">
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <td>
                            <a href="<?php echo base_url('guru/profile')?>">Data Profile</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapsePesan"><i class="fa fa-envelope-square"></i> Pesan Informasi</a>
            </h4>
        </div>
        <div id="collapsePesan" class="panel-collapse collapse <?php if ($this->uri->segment(2) =='pesan') { echo 'in'; }?>">
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <td>
                            <a href="<?php echo base_url('guru/pesan')?>">Data Pesan Informasi</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseNilai"><i class="fa fa-newspaper-o"></i> Kelola Materi</a>
            </h4>
        </div>
        <div id="collapseNilai" class="panel-collapse collapse <?php if ($this->uri->segment(2) =='materi') { echo 'in'; }?>">
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <td>
                            <a href="<?php echo base_url('guru/materi')?>">Data Materi</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>


    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseMateri"><i class="fa fa-book"></i> Kelola Nilai</a>
            </h4>
        </div>
        <div id="collapseMateri" class="panel-collapse collapse <?php if ($this->uri->segment(2) =='nilai') { echo 'in'; }?>">
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <td>
                            <a href="<?php echo base_url('guru/nilai')?>">Data Nilai</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a href="<?php echo base_url('guru/logout')?>"><span class="fa fa-power-off">
                </span> Log Out</a>
            </h4>
        </div>

    </div>

</div>