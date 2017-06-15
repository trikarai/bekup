
{{ content() }}
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Talent
        <small>profile</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Profile</a></li>
        <li>Skill</li>
    </ol>


</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Skill</h3>

            <div align="right">
                <a href="{{url('talentskill/new')}}" class="btn tomboladd"><i class="fa fa-plus"></i> Add Skill Set</a>
            </div>

        </div>
        <div class="box-body">

            <div class="tab-pane" id="settings">

                <table id="table" class="table table-hover table-mc-light-blue">
                    <thead style="font-weight:bold;">
                        <tr>
                            <td>Skill</td>
                            <td>Score</td>
                            <td colspan="2"></td>
                        </tr>
                    </thead>
                    <tbody>
                        {%if(skillScoreRdos)%}
                            {%for row in skillScoreRdos%}
                                <tr>
                                    <td data-title="Skill"> {{row.skillRDO().trackReadDataObject().getName()}}  -  {{row.skillRDO().getName()}} </td>
                                    <td data-title="Score"> {{row.getScoreValue()}} </td>

                                    <td data-title="Action">
                                        <a href="{{url('talentskill/edit/')}}{{row.getId()}}" class="btn tomboledit">Edit</a>
                                    </td>
                                    <td>
                                        <a href="#" class="btn tombolremove confirm-delete" data-id="{{row.getId()}}">Remove</a>
                                    </td>
                                </tr>
                            {%endfor%}
                        {%else%}
                            <tr>
                                <td colspan="4" align="center" style="font-style:italic;">No Skill Data</td>
                            </tr>
                        {%endif%}
                    </tbody>
                </table>

                <!-- Modal -->
                <div class="modal fade" id="myModalSkillRemove" role="dialog">
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
                                <a href="#" type="button" class="btn tombolmodal" id="btnYes" data-dismiss="modal">Yes</a>
                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Modal -->
            </div>

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <div class="col-sm-offset-2 col-sm-10">
            </div>
        </div>
        <!-- /.box-footer-->
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
    $('#skillMenu').css('color', '#fff');
</script>

<script>
    $('#myModalSkillRemove').on('show', function () {
        var id = $(this).data('id'),
                removeBtn = $(this).find('.danger');
    });

    $('.confirm-delete').on('click', function (e) {
        e.preventDefault();

        var id = $(this).data('id');
        $('#myModalSkillRemove').data('id', id).modal('show');
    });

    $('#btnYes').click(function () {

        var id = $('#myModalSkillRemove').data('id');
        //sending to php the row to be deleted from the db
        // alert (id);
        $.ajax({
            url: '{{url('talentskill/remove/')}}' + id,
            // type: POST,
            data: 'id=' + id,
            success: function (html) {

                // $('[data-id='+id+']').remove();
                // $('#myModalSkillRemove').modal('hide');

                //removing entire row
                $('[data-id=' + id + ']').parents('tr').remove();
                $('#myModalSkillRemove').modal('hide');

                $(document).ready(function () {
                    $('.box-footer').notify({
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
