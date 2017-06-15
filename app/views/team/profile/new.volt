<?php use Phalcon\Tag; ?>

{{ content() }}
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <a href={{url('team/dashboard/index')}} class="btn tomboladd"><i class="fa fa-reply" aria-hidden="true"></i> back</a> Team
        <small>profile</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li>Create Team</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Create Team</h3>
        </div>
       <div class="box-body" style="width:50%; margin:10px">
            <div class="tab-pane" id="settings">
                <form action={{url('team/profile/save')}} method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Name</label>
                        {{text_field("name", "class": "form-control", "required": "required")}}
                    </div>
                    <div class="form-group">
                        <label for="vision">vision</label>
                        {{text_area("vision", "class": "form-control", "required": "required")}}
                    </div>
                    <div class="form-group">
                        <label for="mission">mission</label>
                        {{text_area("mission", "class": "form-control", "required": "required")}}
                    </div>
                    <div class="form-group">
                        <label for="culture">culture</label>
                        {{text_area("culture", "class": "form-control", "required": "required")}}
                    </div>
                    <div class="form-group">
                        <label for="founderAgreement">Founder Agreement</label>
                        {{file_field("founder_agreement", "class": "form-control", "accept": "application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document")}}
{#                        <?php echo Tag::fileField(array('founderAgreementFile','class'=>'form-control','accept'=>'application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document')); ?>#}
                    </div>
                    <div class="form-group">
                        <label for="position">Position</label>
                        {{text_field("position", "class": "form-control", "required": "required")}}
                    </div>
                    <button type="submit" class="btn btn-default" >Save </button>
                </form>
            </div>
        </div>
        <!-- tab pane-->
        <!-- /.box-body -->
        <div class="box-footer">
            <div class="col-sm-offset-2 col-sm-10">
            </div>
        </div>
        <!-- /.box-footer-->
    </div>
    <!-- /.box -->

</section>
<!-- /.content -->

<!-- jQuery 2.2.0 -->
<script src="<?php echo $this->url->get('public'); ?>/js/jQuery-2.2.0.min.js"></script>
<script src="<?php echo $this->url->get('public'); ?>/js/bootstrap-notify.min.js"></script>


<script>
    $('#teamMenu').addClass('active');
    $('#teamMenu').css('color', '#fff');
</script>