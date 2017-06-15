<?php use Phalcon\Tag; ?>

{{ content() }}
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Team
        <small>profile</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li>Team</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">

        <div class="box-body">


            <div class="tab-pane" id="settings">
                <div class="panel panel-default">
                    <div class="panel-heading">No Active Team</div>
                    <div class="panel-body" style="background-color: #ececec">
                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <a href={{url('team/profile/new')}}></i>
                                    <div class="info-box">
                                        <span class="info-box-icon bg-bekup" style="color:#fff;"><i class="ion ion-plus-round"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-team">Create Team</span>
                                            <!-- <span class="info-box-number">90<small>%</small></span> -->
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <a href={{url('team/notification/index')}}></i>
                                    <div class="info-box">
                                        <span class="info-box-icon bg-bekup" style="color:#fff;"><i class="ion ion-alert"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-team">Notification</span>
                                            <!-- <span class="info-box-number">90<small>%</small></span> -->
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- <div align="left"> -->
                        <!-- <a href='<?php echo $this->url->get('team/createTeam');?>' class="btn btn-default"><i class="fa fa-plus"></i> Create Team</a> -->
                        <!-- <a href='<?php echo $this->url->get('team/notification');?>' class="btn btn-default"><i class="fa fa-plus"></i> Notification</a> -->
                        <!-- </div> -->
                    </div>
                </div>

            </div>
        </div>

        <!-- tab pane-->


        <!-- /.box-body -->
        <div class="box-footer">
            <div class="col-sm-offset-2 col-sm-10">
            </div>
        </div>
        <!-- /.box-footer-->

        <!-- /.box -->
    </div>
</section>
<!-- /.content -->

<!-- jQuery 2.2.0 -->
<script src="<?php echo $this->url->get('public'); ?>/js/jQuery-2.2.0.min.js"></script>
<script src="<?php echo $this->url->get('public'); ?>/js/bootstrap-notify.min.js"></script>


<script>
    $('#teamMenu').addClass('active');
    $('#teamMenu').css('color', '#fff');
</script>