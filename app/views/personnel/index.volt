{{ content() }}

<style>
    .box {
        overflow-y: overlay;
    }
</style>

<section class="content-header">
    <h1>
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li>Personnel</li>
    </ol>
</section>

<section class="content">
    <div class="box">
        <div class="box-body">
            <div class="box-header with-border">
                <div>
                    <span style="font-size: 30px;position: absolute;bottom: 12px;">Personnel</span>
                    <a href='{{url('personnel/new')}}' class="btn tomboladd pull-right"><i class="fa fa-plus"></i> Add Personnel</a>
                </div>
            </div>

            <table id="table" class="table table-hover table-mc-light-blue">
                <div class="alert-head"></div>
                <thead>
                    <tr style="font-weight:bold;">
                        <!--<td>ID </td>-->
                        <td>Nama</td>
                        <td>Email</td>
                        <td>Role</td>
                        <td>Track</td>
                        <td>City</td>
                        <td colspan="2"></td>
                    </tr>
                </thead>
                <tbody>
                    {%for row in personnelRdos %}
                        <tr>
                            <td data-title="Nama"> {{row.getName()}} </td>
                            <td data-title="Email">{{row.getEmail()}} </td>
                            <td data-title="Role"> {{row.getRole()}} </td>
                                {% set trackRDO = row.trackRDO() %}
                                {% set cityRDO = row.cityRDO() %}

                                {% if trackRDO is not empty %}
                                    <td data-title="Track">{{trackRDO.getName()}}</td>
                                {% else %}
                                    <td data-title="Track">-</td>
                                {% endif %}

                                {% if cityRDO is not empty %}
                                    <td data-title="City">{{cityRDO.getName()}}</td>
                                {% else %}
                                    <td data-title="City">-</td>
                                {% endif %}

                            <td data-title="Action">
                                <a href="{{url('personnel/edit/')}}{{row.getId()}}" class="btn tomboledit">Edit</a> <br/>
                            </td>
                            <td>
                                {% if sessionId != row.getId() %}
                                    <a href="#" class="btn tombolremove confirm-delete" data-id="{{row.getId()}}">Remove</a>
                                {%else%}
                                {%endif%}

                            </td>
                        </tr>
                    {% endfor %}
                </tbody>
            </table>
                
            <!-- Modal -->
            <div class="modal fade" id="myModalpersonnel" role="dialog">
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
    $('#personelMenu').addClass('active');
</script>

<script>
    $('#myModalpersonnel').on('show', function () {
        var id = $(this).data('id'),
                removeBtn = $(this).find('.danger');
    })

    $('.confirm-delete').on('click', function (e) {
        e.preventDefault();

        var id = $(this).data('id');
        $('#myModalpersonnel').data('id', id).modal('show');
    });

    $('#btnYes').click(function () {

        var id = $('#myModalpersonnel').data('id');
        //sending to php the row to be deleted from the db
        // alert (id);
        $.ajax({
            url: '{{url('personnel/remove/')}}' + id,
            // type: POST,
            data: 'id=' + id,
            success: function (html) {


                // $('[data-id='+id+']').remove();
                // $('#myModalpersonnel').modal('hide');

                //removing entire row
                $('[data-id=' + id + ']').parents('tr').remove();
                $('#myModalpersonnel').modal('hide');

                $(document).ready(function () {
                    $('.alert-head').notify({
                        message: {
                            text: 'Personnel Removed!'
                        }
                    }).show();
                });

            },
        });
        return false;
    });

</script>