<?php use Phalcon\Tag; ?>

{{ content() }}

<section class="content-header">
    <h1>
        <a href={{url('skill')}} class="btn tomboladd"><i class="fa fa-reply" aria-hidden="true"></i> back</a>
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li>Skill</li>
        <li>Edit Skill</li>
    </ol>
</section>

<section class="content">

    <div class="box">
        <div class="box-body">

            <div class="box-header with-border">
                <div style="font-size: 30px;">
                    Edit Skill
                </div>
            </div>

            <div class="box-body">
                <form action={{url('skill/update')}} method="POST">
                      <div class="row">
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                {{hidden_field("id")}}
                            </div>
                            <div class="form-group">
                                <label class="control-label">Status</label>
                                {{select_static("class": "form-control", "track_id", trackList)}}
                            </div>
                            <div class="form-group">
                                <label for="name">Name:</label>
                                {{ text_field("name", "class": "form-control", "required": "required") }}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-default">Update</button>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>

</section>

<script src="<?php echo $this->url->get('public'); ?>/js/jQuery-2.2.0.min.js"></script>

<script>
    $('#skillMenu').addClass('active');
</script>