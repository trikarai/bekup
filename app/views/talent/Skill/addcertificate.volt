{{ content() }}

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <a href="{{url('talent/skill/index')}}" class="btn tomboladd"><i class="fa fa-reply" aria-hidden="true"></i> back</a> Talent
        <small>skill</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Skill</a></li>
        <li>Add Skill Score</li>
    </ol>    
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Add Skill Score</h3>
        </div>
        <div class="box-body">

            <div class="col-md-6">
                <form action="{{url('talent/skill/saveCertificate')}}" method="post">
                    {{hidden_field("skill_id", "maxlength":70,"placeholder":"", "class":"form-control","required":"required","value":skill_id)}}                   

                    <div class="form-group">
                        <label for="name">Certificate's Name:</label>
                        {{text_field("name", "maxlength":70,"placeholder":"Certificate's Name", "class":"form-control","required":"required")}}
                    </div>

                    <div class="form-group">
                        <label for="organizer">Organizer:</label>
                        {{text_field("organizer", "maxlength":70,"placeholder":"Organizer's Name", "class":"form-control","required":"required")}}
                    </div>

                    <div class="form-group">
                        <label for="year">Year:</label>
                        {{text_field("year", "pattern":"^(19[5-9]\d|20[0-4]\d|2050)$" , "maxlength":4,"placeholder":"Year", "class":"form-control","required":"required")}}
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
    $('#skillMenu').css('color', '#fff');
</script>