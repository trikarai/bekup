<?php use Phalcon\Tag; ?>

{{ content() }}

<head>
<style>
.yearp {
    background: #80ce51;
    padding: 4px;
    color: #fff;
}
</style>
</head>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Team
        <small>Programme</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li>Active Programme</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

<div class="box" style="text-align:center">
	<div class="box-body">
		<h3>Active Programme : </h3>
		<h2>{{rdo.referenceCityProgrammeRdo().referenceProgrammeRDO().getName()}}</h2>		
		<h4 style="font-size:12px;"><span class="yearp">{{rdo.referenceCityProgrammeRdo().referenceProgrammeRDO().getOperationStartDate()}}</span> - <span class="yearp">{{rdo.referenceCityProgrammeRdo().referenceProgrammeRDO().getOperationEndDate()}}</span></h2>
		<a href={{url('team/programme/resign/')}}{{rdo.getId()}}><button class="btn btn-warning" style="margin-top:20px;"><i class="fa fa-external-link"></i> Resign</button></a>
	</div>
</div>
        
</section>


        
<!-- jQuery 2.2.0 -->
<script src="https://code.jquery.com/jquery-2.2.0.min.js"
        integrity="sha256-ihAoc6M/JPfrIiIeayPE9xjin4UWjsx2mjW/rtmxLM4="
crossorigin="anonymous"></script>
<script src="{{url('public/js/bootstrap-notify.min.js')}}"></script>

<script>
    $('#programMenu').addClass('active');
</script>