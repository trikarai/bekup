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
        <div class="box-body">
            <table class="table table-hover">
                <thead style="font-weight:900;">
                    <tr>
                        <td>Idea</td>
                        <td>Description</td>
                        <td></td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    {%if(ideaRdos)%}
                        {% for rdo in ideaRdos %}
                            <tr>
                                <td style="width:40%"> {{rdo.getName()}}</td>
                                <td style="width:40%"> {{rdo.getDescription()}}</td>
                                <td data-title="Action">

                                </td>
                                <td style="width:20%">
                                    <a href="{{url('team/idea/edit/')}}{{rdo.getId()}}" class="btn tomboledit">Edit</a>
                                    <a href="{{url('team/idea/remove/')}}{{rdo.getId()}}" class="btn tomboledit">Remove</a>
                                </td>
                            </tr>
                        {% endfor %}
                    {% else %}

                        <tr>
                            <td><div style="font-style:italic;text-ali">No Idea Data</div></td>
                        </tr>
                    {% endif %}
                </tbody>
            </table>
        </div>
    </div>

</section>

<section class="content">

    <div class="box">
        <div class="box-body">



           {# <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" href="#collapse1">Collapsible panel</a>
                        </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse">
                        <div class="panel-body">Panel Body</div>
                    </div>
                </div>
            </div>#}

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
{{row.getDescription()}} 
{{row.getTargetCustomer()}} 
{{row.getProblemFaced()}} 
{{row.getValueProposed()}} 
{{row.getRevenueModel()}} 

                            </div>
                        </div>
                    </div>
                {%endfor%}              
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