<?php use Phalcon\Tag; ?>
{{ content() }}
<p>au ah</p>
<section class="content-header">
    <h1>
        <a href={{url('city')}} class="btn tomboladd"><i class="fa fa-reply" aria-hidden="true"></i> back</a>
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li>City</li>
        <li>Edit City</li>
    </ol>
</section>

<section class="content">

    <div class="box">
        <div class="box-body">

            <div class="box-header with-border">
                <div style="font-size: 30px;">
                    Edit City
                </div>
            </div>

            <div class="box-body">
                <form action=<?php echo $this->url->get('city/update'); ?> method="POST">
                      {{hidden_field("id", "maxlength": 70, "class": "form-control")}}
                      <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name">Name:</label>
                            {{text_field("name", "maxlength": 20, "class": "form-control", "required": "required")}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>
                    </div>


                </form>
            </div>

        </div>
    </div>

</section>

<script src="<?php echo $this->url->get('public'); ?>/js/jQuery-2.2.0.min.js"></script>

<script>
    $('#cityMenu').addClass('active');
</script>