{{ content() }}

<div>
    <a href={{url('programme/new')}}> new rogramme </a>
</div>
<div class="box">
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
            {% for rdo in programmeRdos %}
                <tr>
                    <td data-title="programme"> {{rdo.getName()}}</td>
                    <td data-title="registration_start_date"> {{rdo.getRegistrationStartDate()}}</td>
                    <td data-title="registration_end_date"> {{rdo.getRegistrationEndDate()}}</td>
                    <td data-title="operation_start_date"> {{rdo.getOperationStartDate()}}</td>
                    <td data-title="operation_end_date"> {{rdo.getOperationEndDate()}}</td>
                    <td data-title="Action">
                        <a href="{{url('programme/edit/')}}{{rdo.getId()}}" class="btn tomboledit">Edit</a>
                    </td>
                    <td>
                        <a href="{{url('programme/remove/')}}{{rdo.getId()}}" class="btn tomboledit">Remove</a>
                    </td>
                </tr>
            {% endfor %}
        </tbody>
    </table>
</div>