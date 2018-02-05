<div class="panel-group" id="accordion">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseDashboard"><i class="fa fa-dashboard"></i> Dashboard</a>
            </h4>
        </div>
        <div id="collapseDashboard" class="panel-collapse collapse">
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <td>
                            <a href="<?php echo base_url('siswa')?>">Dashboard</a>
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
                            <a href="<?php echo base_url('siswa/profile')?>">My Profile</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapsePesan"><i class="fa fa-calendar"></i> Jadwal</a>
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