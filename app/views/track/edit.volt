<?php use Phalcon\Tag; ?>

{{ content() }}

<section class="content-header">
    <h1>
        <a href={{url('track')}} class="btn tomboladd"><i class="fa fa-reply" aria-hidden="true"></i> back</a>
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li>Track</li>
        <li>Edit Track</li>
    </ol>
</section>

<section class="content">

    <div class="box">

        <div class="box-header with-border">
            <div style="font-size: 30px;">
                Edit Track
            </div>
        </div>

        <div class="box-body">
            <form action={{url('track/update')}} method="post">
                {{hidden_field("id", "class": "form-control")}}
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="name">Name:</label>
                        {{text_field("name", "maxlength": 30, "class": "form-control", "required": "required")}}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="description">Description:</label>
                        {{text_area("description", "maxlength": 140, "class": "form-control", "required": "required")}}
                    </div>
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
    </div>

</section>

<script src="<?php echo $this->url->get('public'); ?>/js/jQuery-2.2.0.min.js"></script>

<script>
    $('#trackMenu').addClass('active');
</script>