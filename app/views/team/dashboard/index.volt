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

    <!-- My Team Member -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="row">
                        <div class="col-md-10">
                            <h3 class="box-title" style="vertical-align: -webkit-baseline-middle;">My Team Member | <i class="fa fa-th"></i> Team name:<span class="team-name"> {{teamRdo.getName()}}</span></h3>
                        </div>
                        <div class="col-md-2">
                            <a href="{{url('team/member/invite')}}" class="btn tomboladd" style="float:right;"><i class="fa fa-plus"></i> invite member</a>
                        
                            <a href="{{url('team/programme/index')}}" class="btn tomboladd" style="float:right;"><i class="fa fa-plus"></i> Team Programme</a>
                        </div>
                    </div>
                </div>

                <div class="box-body">
                    <div class="alert-teammember"></div>

                    <section>
                        <div id="{{selfMemberRdo.getId()}}" class="ateam">
                            <div class="img-circle bteam">
                                {{'You'}}
                            </div>
                            <div style="color: #b1b1b1;
                                 font-size: 12px;
                                 font-style: italic;
                                 margin-bottom: 5px;">
                                {{selfMemberRdo.getPosition()}}
                            </div>
                            <div>
                                <a href={{url('team/member/resign')}} class="btn tomboladd confirm-delete"
                                data-id={{selfMemberRdo.getId()}}><i class="fa fa-external-link"></i> Resign</a>
                            </div>
                        </div>
                        {% for member in otherMemberList %}
                            <div id="{{selfMember[id]}}" class="ateam">
                                <div class="img-circle bteam">
                                    {{member[initial]}}
                                </div>
                                <div style="font-size: 16px;">
                                    <a style="color: #6f6f6f !important;" data-toggle="tooltip" title="Click for Profile Talent" href={{url('team/member/profile')}}{{selfMember[talent_id]}}>
                                       {{member[name]}}
                                    </a></div>
                                <div style="color: #b1b1b1;
                                     font-size: 12px;
                                     font-style: italic;
                                     margin-bottom: 5px;">
                                    {{member[position]}}
                                </div>
                                <div>
                                    {% if selfMember[is_admin] %}
                                    <a href={{url('team/member/remove')}} class="btn tomboladd confirm-delete"
                                    data-id={{member[id]}}><i class="fa fa-external-link"></i> Resign</a>
                                    {% endif %}
                                </div>
                            </div>
                        {% endfor %}
                    </section>
                    <!-- tab pane-->
                </div>
                <!-- /.box-body -->
                <!-- /.box-footer-->
            </div>
        </div>
    </div>
    <!-- My Team Member -->


    <!-- Vision & Mision -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="row">
                        <div class="col-md-4">
                            <h3 class="box-title" style="vertical-align: -webkit-baseline-middle;">Vision & Mission</h3>
                        </div>
                        <div class="col-md-8">
                            <a style="margin-bottom: 7px;" class="btn tomboledit pull-right" href="{{url('team/profile/edit')}}">edit </a>
                        </div>
                    </div>
                </div>

                <div class="box-body">

                    <div>
                        <i class="fa fa-eye vision"></i>
                        <h2 style="color: #676767;">Vision</h2>
                        <p style="word-wrap: break-word;color: #ababab;">{{teamRdo.getVision()}}</p>
                    </div>
                    <div>
                        <i class="fa fa-rocket vision"></i>
                        <h2 style="color: #676767;">Mission</h3>
                            <p style="word-wrap: break-word;color: #ababab;">{{teamRdo.getMission()}}</p>
                    </div>
                    <div>
                        <i class="fa fa-ravelry vision"></i>
                        <h2 style="color: #676767;">Culture</h3>
                            <p style="word-wrap: break-word;color: #ababab;">{{teamRdo.getCulture()}}</p>
                    </div>
                    <div>
                        <i class="fa fa-wpforms vision"></i>
                        <h2 style="color: #676767;">Founder Agreement</h3>
                            <p style="word-wrap: break-word;color: #ababab;">
                                {% if teamRdo.getFounderAgreement() != "" %}
                                    <a class="fa fa-file-pdf-o" style="margin-top: 15px;" target="_blank" href="{{url('public/uploads/')}}{{teamRdo.getFounderAgreement()}}"> {{teamRdo.getFounderAgreement()}}</a>
                                {%else%}
                                    There is no founder agreement file
                                {%endif%}
                            </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Vision & Mision -->

</section>
<div class='modal fade' id='myModalTeam' role='dialog'>
    <div class='modal-dialog modal-sm'>
        <div class='modal-content'>
            <div class='modal-body'>
                <p>Do you want to resign ?</p>
            </div>
            <div class='modal-footer'>
                <a href='#' type='button' class='btn tombolmodal' id='btnYes' data-dismiss='modal'>Yes</a>
                <button type='button' class='btn btn-default' data-dismiss='modal'>No</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModalTeamKick" role="dialog">
    <div class="modal-dialog modal-sm">

        <!-- Modal content-->
        <div class="modal-content">
            <!-- <div class="modal-header"> -->
            <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
            <!-- <h4 class="modal-title"></h4> -->
            <!-- </div> -->
            <div class="modal-body">
                <p>Do you want to Kick this member ?</p>
            </div>
            <div class="modal-footer">
                <a href="#" type="button" class="btn tombolmodal" id="btnKick" data-dismiss="modal">Yes</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
<!-- main content -->

<!-- jQuery 2.2.0 -->
<script src="https://code.jquery.com/jquery-2.2.0.min.js"
        integrity="sha256-ihAoc6M/JPfrIiIeayPE9xjin4UWjsx2mjW/rtmxLM4="
crossorigin="anonymous"></script>
<script src="{{url('public/js/bootstrap-notify.min.js')}}"></script>


<script>
    $('#teamMenu').addClass('active');</script>

<script>
    $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    });</script>

<script>
    $('#myModalTeam').on('show', function() {
    var id = $(this).data('id'),
            removeBtn = $(this).find('.danger');
    })

            $('.confirm-delete').on('click', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('#myModalTeam').data('id', id).modal('show');
    });
    $('#btnYes').click(function() {

    var id = $('#myModalTeam').data('id');
    //sending to php the row to be deleted from the db
    // alert (id);
    $.ajax({
    url: '<?php echo $this->url->get('team / resignTeam / ');?>' + id,
            // type: POST,
            data: 'id=' + id,
            success: function(html){


            // $('[data-id='+id+']').remove();
            // $('#myModalTeam').modal('hide');

            //removing entire row
            $('[data-id=' + id + ']').parents('tr').remove();
            $('#myModalTeam').modal('hide');
            $(document).ready(function () {
            $('.alert-teammember').notify({
            message: {
            text: 'You have resigned!'
            }
            }).show();
            setTimeout(function () {
            window.location.href = "{{url('team/index')}}"; }, 4500);
            });
            },
    });
    return false;
    });</script>

<script>
    $('#myModalTeamCancel').on('show', function() {
    var id = $(this).data('id'),
            removeBtn = $(this).find('.danger');
    })

            $('.confirm-cancel').on('click', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('#myModalTeamCancel').data('id', id).modal('show');
    });
    $('#btnCancel').click(function() {

    var id = $('#myModalTeamCancel').data('id');
    //sending to php the row to be deleted from the db
    // alert (id);
    $.ajax({
    url: '<?php echo $this->url->get('team / cancelInvitation / ');?>' + id,
            // type: POST,
            data: 'id=' + id,
            success: function(html){


            // $('[data-id='+id+']').remove();
            // $('#myModalTeamCancel').modal('hide');

            //removing entire row
            $('[data-id=' + id + ']').parents('tr').remove();
            $('#myModalTeamCancel').modal('hide');
            $(document).ready(function () {
            $('table .mylistinvitee').notify({
            message: {
            text: 'Invitation Canceled'
            }
            }).show();
            });
            },
    });
    return false;
    });</script>

<script>
    $('#myModalTeamKick').on('show', function() {
    var id = $(this).data('id'),
            removeBtn = $(this).find('.danger');
    })

            $('.confirm-delete-kick').on('click', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('#myModalTeamKick').data('id', id).modal('show');
    });
    $('#btnKick').click(function() {

    var id = $('#myModalTeamKick').data('id');
    //sending to php the row to be deleted from the db
    // alert (id);
    $.ajax({
    url: '<?php echo $this->url->get('team / kickMember / ');?>' + id,
            // type: POST,
            data: 'id=' + id,
            success: function(html){


            // $('[data-id='+id+']').remove();
            // $('#myModalTeamCancel').modal('hide');

            //removing entire row
            $('#' + id + '').remove();
            alert(id);
            $('#myModalTeamKick').modal('hide');
            $(document).ready(function () {
            $('.alert-teammember').notify({
            message: {
            text: 'Member removed'
            }
            }).show();
            });
            },
    });
    return false;
    });

</script>


