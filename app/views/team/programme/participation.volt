{{ content() }}
<!-- Content Header (Page header) -->

<style>
.statuspro {
	background: #80ce51;
    display: inline-block;
    color: #fff;
    padding-left: 14px;
    padding-right: 14px;
    border-radius: 20px;
    padding-top: 3px;
    padding-bottom: 4px;
}

.statusnone {
	visibility: hidden;
}

</style>


<section class="content-header">
    <h1>
        <!-- <a href={{ url('team/programme/index') }} class="btn tomboladd"><i class="fa fa-reply" aria-hidden="true"></i> back</a> List -->
		List
        <small>Programme</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li>List Programme</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

	<div class="box" style="">
		<div class="box-header with-border">
            <h3 class="box-title">Available Programme</h3>
        </div>
		<div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover">
                    <thead style="font-weight:900">
                        <tr>
                            <td>Programme</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Status</td>
                            <td colspan="2">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        {% for availableRdo in availableProgrammeRdos %}
                            <?php $referenceProgrammeRdo = $availableRdo->referenceProgrammeRDO(); ?>
                            <tr>
                                <td data-title="programme"> {{referenceProgrammeRdo.getName()}}</td>
                                <td data-title="registration_start_date"></td>
                                <td data-title="registration_end_date"></td>
                                <td data-title="operation_start_date"></td>
								<?php $appliedStatus = "" ?>
								<?php $canApply = true ?>
							{% for participatedRdo in participatedProgrammeRdos %}
								<?php $referenceParticipatedProgrammeRdo = $participatedRdo->referenceCityProgrammeRdo()->referenceProgrammeRDO(); ?>
								{%if(referenceParticipatedProgrammeRdo.getId()) == referenceProgrammeRdo.getId() and ((participatedRdo.getStatus()) == "apply" or (participatedRdo.getStatus()) == "active") %}
									<?php $appliedStatus = $participatedRdo->getStatus() ?>
									<?php $canApply = false ?>
								{%endif%}
								
							{% endfor %}
								<td data-title="status" id="stspro"><span class="statuspro"> {{appliedStatus}} </span></td>
							{% if(canApply) %}
								<td data-title="Action">
									<a href="{{url('team/programme/apply/')}}{{availableRdo.getId()}}" class="btn tomboledit">Apply</a>
								</td>
							{% elseif(appliedStatus == "apply") %}
								<td data-title="Action">
									<a href="{{url('team/programme/cancelApplication/')}}{{participatedRdo.getId()}}" class="btn tomboledit">Cancel</a>
								</td>
							{% else %}
								<td data-title="Action"></td>
							{% endif %}
                            </tr>
                        {% endfor %}
                    </tbody>
                </table>
            </div>        
        </div>
		</div>
    </div>

</section>



<!-- jQuery 2.2.0 -->
<script src="https://code.jquery.com/jquery-2.2.0.min.js"
        integrity="sha256-ihAoc6M/JPfrIiIeayPE9xjin4UWjsx2mjW/rtmxLM4="
crossorigin="anonymous"></script>

<script>
    $('#programMenu').addClass('active');
	
	var statusclass = $("#stspro");
	
		$('#stspro').each(function () {
			if(statusclass.val() == "") {				
				statusclass.removeClass("statuspro");											
			}
		
		});
</script>