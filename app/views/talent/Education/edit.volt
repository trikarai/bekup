
{{ content() }}

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <a href="{{url('talent/profile/index')}}" class="btn tomboladd"><i class="fa fa-reply" aria-hidden="true"></i> back</a> Talent
        <small>profile</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Profile</a></li>
        <li>Edit Education History</li>
    </ol>

</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Education History</h3>
        </div>
        <div class="box-body">

            <div class="col-md-6">
                <form action="{{url('talent/education/update')}}" method="post">
                    {{hidden_field("id","max-length":70, "class":"form-control")}}
                    <div class="form-group">
                        <label for="phase">Phase:</label>
                        {{text_field("phase", "class":"form-control", "readonly": "readonly")}}
                    </div>
                    <div class="form-group">
                        <label for="institution">Institution:</label>
                        {{text_field("institution","max-length":70, "class":"form-control", "placeholder":"Institution" , "required":"required")}}
                    </div>
                    <div class="form-group">
                        <label for="major">Major:</label>
                        {{text_field("major","max-length":70, "class":"form-control", "placeholder":"Major" , "required":"required")}}
                    </div>
                    <!-- Regex year validation:
                    1950 - 2050: /^(19[5-9]\d|20[0-4]\d|2050)$/
                    -->
                    <div class="form-group">
                        <label for="startyear">Start Year:</label>
                        {{text_field("start_year","max-length":4, "pattern":"^(19[5-9]\d|20[0-4]\d|2050)$","class":"form-control", "placeholder":"Start Year" , "required":"required")}}
                    </div>
                    <div class="form-group">
                        <label for="endyear">End Year:</label>
                        {{text_field("end_year","max-length":4, "pattern":"^(19[5-9]\d|20[0-4]\d|2050)$","class":"form-control", "placeholder":"End Year")}}
                    </div>
                    <div class="form-group">
                        <label for="note">Note:</label>
                        {{text_field("note","max-length":256, "class":"form-control", "placeholder":"Note [optional]")}}
                    </div>

                    <button type="submit" class="btn btn-default">Submit</button>

                    <!-- /.box-body -->
                    <div class="box-footer">

                    </div>
                </form>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->

            </section>
            <!-- /.content -->

            <!-- jQuery 2.2.0 -->
            <script src="https://code.jquery.com/jquery-2.2.0.min.js"
                    integrity="sha256-ihAoc6M/JPfrIiIeayPE9xjin4UWjsx2mjW/rtmxLM4="
            crossorigin="anonymous"></script>

            <script>
                $('#profileMenu').addClass('active');
                $('#educationMenu').css('color', '#fff');
            </script>