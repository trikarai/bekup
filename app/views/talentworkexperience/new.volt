
{{ content() }}

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <a href="{{url('talentprofile/index')}}" class="btn tomboladd"><i class="fa fa-reply" aria-hidden="true"></i> back</a> Talent
        <small>profile</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Profile</li>
        <li>Add Work Experience</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Add Work Experience</h3>
        </div>
        <div class="box-body">
            <div class="col-md-6">
                <form action="{{url('talentworkexperience/save')}}" method="post">
                    <div class="form-group">
                        <label for="companyName">Company Name:</label>
                        {{text_field("companyName","max-length":70, "class":"form-control", "placeholder":"Compay Name" , "required":"required")}}
                    </div>

                    <div class="form-group">
                        <label for="position">Position:</label>
                        {{text_field("position","max-length":70, "class":"form-control", "placeholder":"Positione" , "required":"required")}}
                    </div>
                    <!-- Regex year validation:
                    1950 - 2050: /^(19[5-9]\d|20[0-4]\d|2050)$/
                    -->
                    <div class="form-group">
                        <label for="startYear">Start Year:</label>
                        {{text_field("startYear","max-length":4, "pattern":"^(19[5-9]\d|20[0-4]\d|2050)$","class":"form-control", "placeholder":"Start Working Year" , "required":"required")}}
                    </div>

                    <div class="form-group">
                        <label for="endYear">End Year:</label>
                        {{text_field("endYear","max-length":4, "pattern":"^(19[5-9]\d|20[0-4]\d|2050)$","class":"form-control", "placeholder":"End Working Year" , "required":"required")}}
                    </div>
                    <div class="form-group">
                        <label for="role">Role:</label>
                        {{text_field("role","max-length":70, "class":"form-control", "placeholder":"Role" , "required":"required")}}
                    </div>

                    <button type="submit" class="btn btn-default">Submit</button>

                </form>
            </div>

        </div>
        <!-- /.box-body -->
        <div class="box-footer">

        </div>
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
    $('#jobMenu').css('color', '#fff');
</script>