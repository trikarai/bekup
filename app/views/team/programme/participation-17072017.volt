{{ content() }}
<!-- Content Header (Page header) -->
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

    <div class="box" style="overflow-x: auto;">
		<div class="box-header with-border">
            <h3 class="box-title">Participated Programme</h3>
        </div>
		<div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover">
                    <thead style="font-weight:900">
                        <tr>
                            <td>Programme</td>
                            <td>Registration Start Date</td>
                            <td>Registration End Date</td>
                            <td>Operation Start Date</td>
                            <td>Operation End Date</td>
                            <td>Status</td>
                            <td colspan="2">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        {% for participatedRdo in participatedProgrammeRdos %}
                            <?php $referenceProgrammeRdo = $participatedRdo->referenceCityProgrammeRdo()->referenceProgrammeRDO(); ?>
                            <tr>
                                <td data-title="programme"> {{referenceProgrammeRdo.getName()}}</td>
                                <td data-title="registration_start_date"> {{referenceProgrammeRdo.getRegistrationStartDate()}}</td>
                                <td data-title="registration_end_date"> {{referenceProgrammeRdo.getRegistrationEndDate()}}</td>
                                <td data-title="operation_start_date"> {{referenceProgrammeRdo.getOperationStartDate()}}</td>
                                <td data-title="operation_end_date"> {{referenceProgrammeRdo.getOperationEndDate()}}</td>
                                <td data-title="status"> {{participatedRdo.getStatus()}}</td>
                                <td data-title="Action">
                                    {%if(participatedRdo.getStatus())=='apply'%}
                                    <a href="{{url('team/programme/cancelApplication/')}}{{participatedRdo.getId()}}" class="btn tomboledit">Cancel</a>
                                    {%else%}
                                    {%endif%}
                                    </td>
                            </tr>
                        {% endfor %}
                    </tbody>
                </table>
            </div>
        </div>
		</div>
    </div>

    <div class="box" style="overflow-x: auto;">
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
                            <td>Registration Start Date</td>
                            <td>Registration End Date</td>
                            <td>Operation Start Date</td>
                            <td>Operation End Date</td>
                            <td colspan="2">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        {% for availableRdo in availableProgrammeRdos %}
                            <?php $referenceProgrammeRdo = $availableRdo->referenceProgrammeRDO(); ?>
                            <tr>
                                <td data-title="programme"> {{referenceProgrammeRdo.getName()}}</td>
                                <td data-title="registration_start_date"> {{referenceProgrammeRdo.getRegistrationStartDate()}}</td>
                                <td data-title="registration_end_date"> {{referenceProgrammeRdo.getRegistrationEndDate()}}</td>
                                <td data-title="operation_start_date"> {{referenceProgrammeRdo.getOperationStartDate()}}</td>
                                <td data-title="operation_end_date"> {{referenceProgrammeRdo.getOperationEndDate()}}</td>
                                <td data-title="Action">
                                    <a href="{{url('team/programme/apply/')}}{{availableRdo.getId()}}" class="btn tomboledit">Apply</a>
                                </td>
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
</script>