<?php use Phalcon\Tag; ?>
{{ content() }}
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Team
        <small>profile</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li>Team Profile</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

<div class="box">
	<h2>Active Programme Name: {{rdo.referenceCityProgrammeRdo().referenceProgrammeRDO().getName()}}</h2>
	<h4>{{rdo.referenceCityProgrammeRdo().referenceProgrammeRDO().getOperationStartDate()}} - {{rdo.referenceCityProgrammeRdo().referenceProgrammeRDO().getOperationEndDate()}}</h2>
</div>
        
        </section>
        
<!-- jQuery 2.2.0 -->
<script src="https://code.jquery.com/jquery-2.2.0.min.js"
        integrity="sha256-ihAoc6M/JPfrIiIeayPE9xjin4UWjsx2mjW/rtmxLM4="
crossorigin="anonymous"></script>
<script src="{{url('public/js/bootstrap-notify.min.js')}}"></script>