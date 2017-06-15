{{ content() }}
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Talent
        <small>profile</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li>Profile</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">


    <div class="row">
        <!-- kolom pertama -->
        <div class="col-md-6">
            <!-- Default box -->
            <div class="box">

                <div class="box-header with-border">
                    <div class="row">
                        <div class="col-md-4">
                            <h3 class="box-title" style="vertical-align: -webkit-baseline-middle;">Basic Info</h3>
                        </div>
                        <div class="col-md-8">
                            <a href="{{url('talent/profile/edit')}}" class="btn tomboledit" style="float:right;">Edit</a>
                        </div>
                    </div>
                </div>

                <div class="box-body">
                    <div class="tab-pane" id="settings">
                        <div class="row">
                            <label class="col-sm-4 control-label">Name</label>
                            <div class="col-sm-8">
                                <div>{{profileRdo.getName()}}</div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 control-label">Email</label>

                            <div class="col-sm-8">
                                <div>{{profileRdo.getEmail()}}</div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 control-label">Phone</label>

                            <div class="col-sm-8">
                                <div>{{profileRdo.getPhone()}}</div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 control-label">City</label>

                            <div class="col-sm-8">
                                <div>{{profileRdo.cityRdo().getName()}}</div>
                            </div>
                        </div>
                        <div class="row">
                            <label  class="col-sm-4 control-label">Track</label>

                            <div class="col-sm-8">
                                <div>{{profileRdo.trackRdo().getName()}}</div>
                            </div>
                        </div>
                        <div class="row">
                            <label  class="col-sm-4 control-label">Birth Date</label>

                            <div class="col-sm-8">
                                <div>{{profileRdo.getBirthDate()}}</div>
                            </div>
                        </div>
                        <div class="row">
                            <label  class="col-sm-4 control-label">City of Origin</label>
                            <div class="col-sm-8">
                                <div>{{profileRdo.getCityOfOrigin()}}</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title" style="margin-top:5px;">Work Experience</h3>

                    <a href="{{url('talentworkexperience/new')}}" class="btn tomboladd pull-right"><i class="fa fa-plus"></i> Add Work Experience</a>

                </div>
                <div class="alert-work"></div>
                <div class="box-body">


                    <div>
                        {% if(workingExperienceRdos) %}
                            {% for row in workingExperienceRdos %}
                                <div id="{{row.getId()}}" class="row edu">
                                    <div class="col-md-6">
                                        <div style="font-weight:bold;"> {{row.getCompanyName()}}</div>
                                        <div style="font-style:italic;"> {{row.getRole()}}</div>
                                        <div> {{row.getPosition()}} ( {{row.getStartYear()}} - {{row.getEndYear()}} )</div>
                                    </div>

                                    <div class="col-xs-2">
                                        <a href="{{url('talentworkexperience/edit/')}}{{row.getId()}}" class="btn tomboledit">Edit</a>
                                    </div>
                                    <div class="col-xs-2">
                                        <a href="#" class="btn tombolremove confirm-delete-work" data-id="{{row.getId()}}">Remove</a>
                                    </div>
                                </div>
                            {%endfor%}
                        {%else%}

                            <div colspan="6" align="center" style="font-style:italic;">No Job History Data</div>

                        {%endif%}
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="myModalJobRemove" role="dialog">
                        <div class="modal-dialog modal-sm">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <!-- <div class="modal-header"> -->
                                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                                <!-- <h4 class="modal-title"></h4> -->
                                <!-- </div> -->
                                <div class="modal-body">
                                    <p>Do you want to remove ?</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="#" type="button" class="btn tombolmodal" id="btnYesWork" data-dismiss="modal">Yes</a>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Modal -->
                </div>

            </div>
            <!-- /.box-body -->


            <!-- /.box-footer-->
        </div>
        <!-- kolom kedua -->
        <div class="col-md-6">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title" style="margin-top:5px;">Education History</h3>


                    <a href="{{url('talenteducation/new')}}" class="btn tomboladd pull-right"><i class="fa fa-plus"></i> Add Education History</a>


                </div>
                <div class="alert-edu"></div>
                <div class="box-body">

                    <div>
                        {% if(educationRdos) %}
                            {% for row in educationRdos %}
                                <div id="{{row.getId()}}" class="row edu">
                                    <div class="col-md-6">
                                        <div style="font-weight:bold;"> {{row.getPhase()}} {{row.getInstitution()}} </div>
                                        <div> {{row.getMajor()}} ({{row.getStartYear()}} - {{row.getEndYear()}})</div>
                                        <div> {{row.getNote()}}</div>
                                    </div>

                                    <div class="col-xs-2">
                                        <a href="{{url('talenteducation/edit/')}}{{row.getId()}}" class="btn tomboledit">Edit</a>
                                    </div>
                                    <div class="col-xs-2">
                                        <a href="#" class="btn tombolremove confirm-delete-edu" data-id="{{row.getId()}}">Remove</a>
                                    </div>
                                </div>
                            {% endfor %}
                        {% else %}
                            <div colspan="7" align="center" style="font-style:italic;">No Education History Data</div>
                        {% endif %}

                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="myModalEducationRemove" role="dialog">
                        <div class="modal-dialog modal-sm">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <!-- <div class="modal-header"> -->
                                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                                <!-- <h4 class="modal-title"></h4> -->
                                <!-- </div> -->
                                <div class="modal-body">
                                    <p>Do you want to remove ?</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="#" type="button" class="btn tombolmodal" id="btnYesEducation" data-dismiss="modal">Yes</a>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Modal -->


                </div>
                <!-- /.box-body -->
                <!-- <div class="box-footer"> -->

                <!-- </div> -->
            </div>
            <!-- /.box-footer-->

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title" style="margin-top:5px;">Training Experience</h3>

                    <a href="{{url('talenttraining/new')}}" class="btn tomboladd pull-right"><i class="fa fa-plus"></i> Add Training Experience</a>

                </div>
                <div class="alert-training"></div>
                <div class="box-body">


                    <div>
                        {% if(trainingRdos) %}
                            {% for row in trainingRdos %}
                                <div id="{{row.getId()}}" class="row edu">
                                    <div class="col-md-6">
                                        <div style="font-weight:bold;"> {{row.getName()}} </div>
                                        <div> {{row.getOrganizer()}} - {{row.getYear()}}</div>
                                    </div>
                                    <div class="col-xs-2">
                                        <a href="{{url('talenttraining/edit/')}}{{row.getId()}}" class="btn tomboledit">Edit</a>
                                    </div>
                                    <div class="col-xs-2">
                                        <a href="#" class="btn tombolremove confirm-delete-training" data-id="{{row.getId()}}">Remove</a>
                                    </div>
                                </div>
                        {%endfor%}{%else%}
                            <div colspan="5" align="center" style="font-style:italic;">No Training Data</div>
                        {%endif%}
                    </div>
                    </table>

                    <!-- Modal -->
                    <div class="modal fade" id="myModalTrainingRemove" role="dialog">
                        <div class="modal-dialog modal-sm">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <!-- <div class="modal-header"> -->
                                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                                <!-- <h4 class="modal-title"></h4> -->
                                <!-- </div> -->
                                <div class="modal-body">
                                    <p>Do you want to remove ?</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="#" type="button" class="btn tombolmodal" id="btnYesTraining" data-dismiss="modal">Yes</a>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Modal -->
                </div>

            </div>
            <!-- /.box-body -->
            <!-- <div class="box-footer"> -->

            <!-- </div> -->
            <!-- /.box-footer-->
        </div>
    </div>
    <!-- /.box -->

</section>
<!-- /.content -->

<!-- jQuery 2.2.0 -->
<script src="https://code.jquery.com/jquery-2.2.0.min.js"
        integrity="sha256-ihAoc6M/JPfrIiIeayPE9xjin4UWjsx2mjW/rtmxLM4="
crossorigin="anonymous"></script>
<script src="{{url('public/js/bootstrap-notify.min.js')}}"></script>


<script>
    $('#profileMenu').addClass('active');
</script>

<script>
    $('#myModalEducationRemove').on('show', function () {
        var id = $(this).data('id'),
                removeBtn = $(this).find('.danger');
    });
    $('.confirm-delete-edu').on('click', function (e) {
        e.preventDefault();

        var id = $(this).data('id');
        $('#myModalEducationRemove').data('id', id).modal('show');
    });

    $('#btnYesEducation').click(function () {

        var id = $('#myModalEducationRemove').data('id');
        //sending to php the row to be deleted from the db
        // alert (id);
        $.ajax({
            url: '{{url('talenteducation/remove/')}}' + id,
            // type: POST,
            data: 'id=' + id,
            success: function (html) {
                // $('[data-id='+id+']').remove();
                // $('#myModalEducationRemove').modal('hide');

                //removing entire row
                $('#' + id + '').remove();
                $('#myModalEducationRemove').modal('hide');

                $(document).ready(function () {
                    $('.alert-edu').notify({
                        message: {
                            text: 'Item Removed!'
                        }
                    }).show();
                });
            }
        });
        return false;
    });
</script>

<script>
    $('#myModalJobRemove').on('show', function () {
        var id = $(this).data('id'),
                removeBtn = $(this).find('.danger');
    });
    $('.confirm-delete-work').on('click', function (e) {
        e.preventDefault();

        var id = $(this).data('id');
        $('#myModalJobRemove').data('id', id).modal('show');
    });
    $('#btnYesWork').click(function () {
        var id = $('#myModalJobRemove').data('id');
        //sending to php the row to be deleted from the db
        // alert (id);
        $.ajax({
            url: '{{url('talentworkexperience/remove/')}}' + id,
            // type: POST,
            data: 'id=' + id,
            success: function (html) {


                // $('[data-id='+id+']').remove();
                // $('#myModalJobRemove').modal('hide');

                //removing entire row
                $('#' + id + '').remove();
                $('#myModalJobRemove').modal('hide');

                $(document).ready(function () {
                    $('.alert-work').notify({
                        message: {
                            text: 'Item Removed!'
                        }
                    }).show();
                });

            }
        });
        return false;
    });
</script>

<script>
    $('#myModalTrainingRemove').on('show', function () {
        var id = $(this).data('id'),
                removeBtn = $(this).find('.danger');
    });

    $('.confirm-delete-training').on('click', function (e) {
        e.preventDefault();

        var id = $(this).data('id');
        $('#myModalTrainingRemove').data('id', id).modal('show');
    });

    $('#btnYesTraining').click(function () {

        var id = $('#myModalTrainingRemove').data('id');
        //sending to php the row to be deleted from the db
        // alert (id);
        $.ajax({
            url: '{{url('talenttraining/remove/')}}' + id,
            // type: POST,
            data: 'id=' + id,
            success: function (html) {
                // $('[data-id='+id+']').remove();
                // $('#myModalTrainingRemove').modal('hide');
                //removing entire row
                $('#' + id + '').remove();
                $('#myModalTrainingRemove').modal('hide');

                $(document).ready(function () {
                    $('.alert-training').notify({
                        message: {
                            text: 'Item Removed!'
                        }
                    }).show();
                });
            }
        });
        return false;
    });

</script>