
{{ content() }}

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <a href="{{url('team/idea/index')}}" class="btn tomboladd"><i class="fa fa-reply" aria-hidden="true"></i> back</a> Team
        <small>Idea</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li>Idea</li>
        <li>Propose Idea</li>
    </ol>

</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Propose Idea</h3>
        </div>
        <div class="box-body">

            <div class="col-md-6">
                <form action={{url('team/idea/add')}} method='post'>
					<div class='form-group'>
						<label>Name</label>
						{{text_field('name', 'class':'form-control','required': 'required')}}
					</div>
					<div class='form-group'>
						<label>Description</label>
						{{text_area('description', 'class':'form-control','required': 'required')}}
					</div>
					<div class='form-group'>
						<label>Target Customer</label>
						{{text_area('target_customer','class':'form-control', 'required': 'required')}}
					</div>
					<div class='form-group'>
						<label>Problem Faced</label>
						{{text_area('problem_faced', 'class':'form-control','required': 'required')}}
					</div>
					<div class='form-group'>
						<label>Value Proposed</label>
						{{text_area('value_proposed', 'class':'form-control','required': 'required')}}
					</div>
					<div class='form-group'>
						<label>Revenue Model</label>
						{{text_area('revenue_model', 'class':'form-control','required': 'required')}}
					</div>
					<div class='form-group' style="display:none">
						<label>Superhero</label>
						{{select_static('superhero_id','class':'form-control', superheroList)}}
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
    $('#ideaMenu').addClass('active');
</script>