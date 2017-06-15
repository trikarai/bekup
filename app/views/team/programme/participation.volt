{{ content() }}

<div class="box">
    <h2>Participated Programme</h2>
    <table class="table table-hover">
        <thead>
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
                        <a href="{{url('team/programme/cancelApplication/')}}{{participatedRdo.getId()}}" class="btn tomboledit">Cancel</a>
                    </td>
                </tr>
            {% endfor %}
        </tbody>
    </table>
</div>
        
<div class="box">
    <h2>Available Programme</h2>
    <table class="table table-hover">
        <thead>
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
