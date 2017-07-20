
{{ content() }}

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <a href="{{url('talent/profile/index')}}" class="btn tomboladd"><i class="fa fa-reply" aria-hidden="true"></i> back</a> Talent
        <small>profile</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Profile</a></li>
        <li>Add Organizational Experience</li>
    </ol>

</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Add Organizational Experience</h3>
        </div>
        <div class="box-body">

            <div class="col-md-6">
                <form action={{url('talent/organizational/add')}} method='post'>
					<div class='form-group'>
						<label>Name</label>
						{{text_field('name',"class":"form-control", 'required': 'required')}}
					</div>
					<div class='form-group'>
						<label>Position</label>
						{{text_field('position',"class":"form-control", 'required': 'required')}}
					</div>
					<div class='form-group'>
						<label>Start Year</label>
						{{numeric_field('start_year',"class":"form-control", 'required': 'required')}}
					</div>
					<div class='form-group'>
						<label>End Year</label>
						{{numeric_field('end_year',"class":"form-control")}}
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
</script>