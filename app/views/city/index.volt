{{ content() }}

<section class="content-header">
    <h1>
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li>City</li>
    </ol>
</section>

<section class="content">
    <div class="box">
        <div class="box-body">
            <div class="box-header with-border">
                <div>
                    <span style="font-size: 30px;position: absolute;bottom: 12px;">City</span>
                    <a href='{{url('city/new')}}' class="btn tomboladd pull-right"><i class="fa fa-plus"></i> Add City</a>

                </div>
            </div>

            <table id="table" class="table table-hover table-mc-light-blue">
                <thead>
                    <tr style="font-weight:bold;">
                        <!--<td>ID </td>-->
                        <td>Nama Kota</td>
                        <!--<td>is Removed</td>-->
                        <td colspan="2"></td>
                    </tr>
                    <tr class="alert-head"></tr>
                </thead>
                <tbody>
                    {% for row in cities %}
                        <tr>
                            <td data-title="Nama Kota">{{row.getName()}}</td>
                            <td data-title="Action">
                                <a href="{{url('city/edit/')}}{{row.getId()}}" class="btn tomboledit">Edit</a> <br/>
                            </td>
                            <td>
                                <a href="#" class="btn tombolremove confirm-delete" data-id="{{row.getId()}}">Remove</a>
                            </td>
                        </tr>
                    {% endfor %}


                </tbody>
            </table>

            <!-- Modal -->
            <div class="modal fade" id="myModalcity" role="dialog">
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
        <div class="box-footer">

        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-2.2.0.min.js"
        integrity="sha256-ihAoc6M/JPfrIiIeayPE9xjin4UWjsx2mjW/rtmxLM4="
crossorigin="anonymous"></script>
<script src="{{url('public/js/bootstrap-notify.min.js')}}"></script>

<script>
    $('#cityMenu').addClass('active');
</script>

<script>
    $('#myModalcity').on('show', function () {
        var id = $(this).data('id'),
                removeBtn = $(this).find('.danger');
    })

    $('.confirm-delete').on('click', function (e) {
        e.preventDefault();

        var id = $(this).data('id');
        $('#myModalcity').data('id', id).modal('show');
    });

    $('#btnYes').click(function () {

        var id = $('#myModalcity').data('id');
        //sending to php the row to be deleted from the db
        // alert (id);
        $.ajax({
            url: '{{url('city/remove/')}}' + id,
            // type: POST,
            data: 'id=' + id,
            success: function (html) {


                // $('[data-id='+id+']').remove();
                // $('#myModalcity').modal('hide');

                //removing entire row
                $('[data-id=' + id + ']').parents('tr').remove();
                $('#myModalcity').modal('hide');

                $(document).ready(function () {
                    $('.alert-head').notify({
                        message: {
                            text: 'City Removed!'
                        }
                    }).show();
                    $('.box-footer').notify({
                        message: {
                            text: 'City Removed!'
                        }
                    }).show();
                });

            },
        });
        return false;
    });

</script>