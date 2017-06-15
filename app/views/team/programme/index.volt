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

<div>
    <a href={{url('programme/new')}}> new programme </a>
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
        
        </section>
        
<!-- jQuery 2.2.0 -->
<script src="https://code.jquery.com/jquery-2.2.0.min.js"
        integrity="sha256-ihAoc6M/JPfrIiIeayPE9xjin4UWjsx2mjW/rtmxLM4="
crossorigin="anonymous"></script>
<script src="{{url('public/js/bootstrap-notify.min.js')}}"></script>