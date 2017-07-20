<?php use Phalcon\Tag; ?>

{{ content() }}


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Team
        <small>Idea</small> <a href={{url('team/idea/new')}}><button class="btn tomboladd"><i class="fa fa-lightbulb-o"></i> Propose Idea</button></a>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li>Idea</li>
    </ol>
</section>

<!-- Main content -->

<section class="content">

    <div class="box">
		<div class="box-header with-border">
            <h3 class="box-title">Idea</h3>
        </div>
        <div class="box-body">
		{% if(ideaRdos)%}
            <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                {%for row in ideaRdos%}
                    <div class="panel box box-success">
                        <div class="box-header with-border">
                            <h4 class="row">
                                <a class="col-md-6" data-toggle="collapse" href="#{{row.getId()}}" style="font-size:16px;">{{row.getName()}}<br>
                                                               
                                </a>
                                <div class="col-md-4">								
                                    <a href="{{url('team/idea/remove/')}}{{row.getId()}}" class="btn tombolremove pull-right" style="margin-left:5px;">Remove</a>
                                    <a href="{{url('team/idea/edit/')}}{{row.getId()}}" class="btn tomboledit pull-right">Edit</a>
                                </div>
                            </h4>
                        </div>
                        <div id="{{row.getId()}}" class="panel-collapse collapse in">
                            <div class="box-body">
									<div class='form-group'>
										<label>Description</label><br>
										{{row.getDescription()}}
									</div class='form-group'>
									<div class='form-group'>
										<label>Target Customer</label><br>
										{{row.getTargetCustomer()}}
									</div>
									<div class='form-group'>
										<label>Problem Faced</label><br>
										{{row.getProblemFaced()}}
									</div> 
									<div class='form-group'>
										<label>Value Proposed</label><br>
										{{row.getValueProposed()}} 
									</div>
									<div class='form-group'>
										<label>Revenue Model</label><br>
										{{row.getRevenueModel()}}
									</div> 

                            </div>
                        </div>
                    </div>
                {%endfor%}
				{%else%}
					<div style="font-style:italic;text-align:center;padding:30px;">No Idea Added</div>
				{%endif%}
            </div>


        </div>
    </div>

</section>



<!-- jQuery 2.2.0 -->
<script src="https://code.jquery.com/jquery-2.2.0.min.js"
        integrity="sha256-ihAoc6M/JPfrIiIeayPE9xjin4UWjsx2mjW/rtmxLM4="
crossorigin="anonymous"></script>
<script src="{{url('public/js/bootstrap-notify.min.js')}}"></script>

<script>
    $('#ideaMenu').addClass('active');
</script>