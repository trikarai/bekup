<?php use Phalcon\Tag; ?>

{{ content() }}

<section class="content-header">
    <h1>
        <a href="{{url('city')}}" class="btn tomboladd"><i class="fa fa-reply" aria-hidden="true"></i> back</a>
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li>City</li>
        <li>Add New City</li>
    </ol>
</section>

<section class="content">

    <div class="box">

        <div class="box-header with-border">
            <div style="font-size: 30px;">
                Add New City									
            </div>
        </div>

        <div class="box-body">
            <form action="{{url('city/add')}}" method="POST">
                  <div class="row">
                    <div class="form-group col-md-6">
                        <label for="name">Name:</label>
                        {{ text_field("name", "maxlength": 20, "class": "form-control", "required": "required") }}
{#                        <?php echo Tag::textField(array("name", "maxlength" => 20, "class" => "form-control","required"=>"required")) ?>#}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <input type="submit" class="btn btn-default" value="Submit"/>
                    </div>
                </div>
            </form>
        </div>
    </div>

</section>

<script src="<?php echo $this->url->get('public'); ?>/js/jQuery-2.2.0.min.js"></script>

<script>
    $('#cityMenu').addClass('active');
</script>