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
                        <td><div style="font-style:italic;">No Idea Data</div></td>
                    </tr>
                {% endif %}
                </tbody>
            </table>
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