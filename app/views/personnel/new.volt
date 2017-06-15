<?php use Phalcon\Tag; ?>

{{ content() }}

<section class="content-header">
    <h1>
        <a href={{url('personnel')}} class="btn tomboladd"><i class="fa fa-reply" aria-hidden="true"></i> back</a>
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li>Personnel</li>
        <li>Add New Personnel</li>
    </ol>
</section>

<section class="content">

    <div class="box">

        <div class="box-header with-border">
            <div style="font-size: 30px;">
                Add New Personnel
            </div>
        </div>

        <div class="box-body">
            <form action="{{url('personnel/add')}}" method="post">
                <div class="row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            {{text_field("name", "class": "form-control", "required": "required")}}
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            {{email_field("email", "class": "form-control", "required": "required")}}
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            {{password_field("password", "class": "form-control", "placeholder": "password", "required": "required")}}
                        </div>

                        <div class="form-group">
                            <label for="repassword">Retype Password:</label>
                            {{password_field("repassword", "class": "form-control", "placeholder": "retype password", "required": "required")}}
                        </div>

                        <div class="form-group">
                            <label for="role">Role:</label>
                            {{select_static("class": "form-control", "role", roles)}}
                        </div>

                        <div class="form-group">
                            <label class="control-label">Track</label>
                            {{select_static("class": "form-control", "track_id", trackList)}}
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="city_id">City</label>
                            {{select_static("class": "form-control", "city_id", cityList)}}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <button type="submit" class="btn btn-default">Submit</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

</section>

<script src="https://code.jquery.com/jquery-2.2.0.min.js"
        integrity="sha256-ihAoc6M/JPfrIiIeayPE9xjin4UWjsx2mjW/rtmxLM4="
crossorigin="anonymous"></script>
<script src="{{url('public/js/validatepassword.js')}}"></script>

<script>
    $('#personelMenu').addClass('active');
</script>