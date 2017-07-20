{{ content() }}

<section class="content-header">
    <h1>
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li>Skill</li>
    </ol>
</section>

<section class="content">
    <div class="box">
        <div class="box-body">
            <div class="box-header with-border">
                <div>
                    <span style="font-size: 30px;position: absolute;bottom: 12px;">Skill</span>
                    <a href="{{url('skill/new')}}" class="btn tomboladd pull-right"><i class="fa fa-plus"></i> Add Skill</a>

                </div>
            </div>

            <table id="table" class="table table-hover table-mc-light-blue">
                <div class="alert-head"></div>
                <thead>
                    <tr style="font-weight:bold;">
                        <!--<td>ID </td>-->
                        <td>Nama Skill</td>
                        <td>Type</td>
                        <td colspan="2"></td>
                    </tr>
                </thead>
                <tbody>
                    {% for row in skillRdos %}
                        <tr>
                            <td data-title="Nama Skill"> {{row.getName()}}</td>
                            <td data-title="Type"> {{row.getType()}} </td>
                            <td data-title="Action">
                                <a href={{url('skill/edit/')}}{{row.getId()}} class="btn tomboledit">Edit</a>
                            </td>
                            <td>
                                <a href={{url('skill/remove')}} class="btn tombolremove confirm-delete" data-id={{row.getId()}}> Remove</a>
                            </td>
                        </tr>
                    {%endfor%}


                </tbody>
            </table>

            <!-- Modal -->
            <div class="modal fade" id="myModalskill" role="dialog">
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
</section>

<script src="https://code.jquery.com/jquery-2.2.0.min.js"
        integrity="sha256-ihAoc6M/JPfrIiIeayPE9xjin4UWjsx2mjW/rtmxLM4="
crossorigin="anonymous"></script>
<script src="{{url('public/js/bootstrap-notify.min.js')}}"></script>

<script>
    $('#skillMenu').addClass('active');
</script>

<script>
    $('#myModalskill').on('show', function () {
        var id = $(this).data('id'),
                removeBtn = $(this).find('.danger');
    })

    $('.confirm-delete').on('click', function (e) {
        e.preventDefault();

        var id = $(this).data('id');
        $('#myModalskill').data('id', id).modal('show');
    });

    $('#btnYes').click(function () {

        var id = $('#myModalskill').data('id');
        //sending to php the row to be deleted from the db
        // alert (id);
        $.ajax({
            url: '{{url('skill/remove/')}}' + id,
            // type: POST,
            data: 'id=' + id,
            success: function (html) {


                // $('[data-id='+id+']').remove();
                // $('#myModalskill').modal('hide');

                //removing entire row
                $('[data-id=' + id + ']').parents('tr').remove();
                $('#myModalskill').modal('hide');

                $(document).ready(function () {
                    $('.alert-head').notify({
                        message: {
                            text: 'Skill Removed!'
                        }
                    }).show();
                });

            },
        });
        return false;
    });

</script>