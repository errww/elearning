<div class="panel-group" id="accordion">
                <?php echo 'nama :'.$nama; ?>
                <?php echo 'nik :'.$nik; ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseProfile"><i class="fa fa-building"></i> Profile</a>
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
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapsePesan"><i class="fa fa-building"></i> Pesan Informasi</a>
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
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseNilai"><i class="fa fa-building"></i> Kelola Nilai</a>
                        </h4>
                    </div>
                    <div id="collapseNilai" class="panel-collapse collapse <?php if ($this->uri->segment(2) =='nilai') { echo 'in'; }?>">
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
                            <a href="<?php echo base_url('guru/logout')?>"><span class="glyphicon glyphicon-file">
                            </span>Log Out</a>
                        </h4>
                    </div>
                
                </div>

            </div>