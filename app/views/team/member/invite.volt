<?php
use Phalcon\Tag;
use Talent\Application\Service\AsTeamMember\DTO\QueryTalentAsTeamMemberProfileDTO;
/**
* @param QueryTalentAsTeamMemberProfileDTO $availableTalentDTOs
* @return QueryTalentAsTeamMemberProfileDTO
*/
function _hinter(QueryTalentAsTeamMemberProfileDTO $row){
return $row;
}
?>
<style>

    .controls a{
        padding:3px;
        cursor: pointer;
        margin:2px;
        color:black;
        text-decoration:none
    }
    .active-team{
        background:#80ce51;
        color:white !important;
        padding: 10px !important;
        border-radius: 3px;
    }

    .pagina {
        line-height:29px;
    }

</style>

{{ content() }}
<!-- Content Header (Page header) -->
<section class="content-header">

    <h1>
        <a href={{ url('team/dashboard/index') }} class="btn tomboladd"><i class="fa fa-reply" aria-hidden="true"></i> back</a> List
        <small>member</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li>Team Invitation</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <div class="pagina pull-right"></div>
            <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="keyword" class="form-control input-sm" placeholder="Search...">
                <div class="input-group-btn">
                    <button id="refresh-button" onClick="refresh()" class="btn btn-default"><i class="fa fa-refresh"></i></button>
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="tab-pane" id="settings">
                <div class="">
                    <!--                 <div class="panel-heading">Team Invitation</div>-->
                    <div class="panel-body">
                        <table id="table" class="table table-hover table-mc-light-blue">
                            <thead style="font-weight:bold;">
                                <tr>
                                    <td>Name</td>
                                    <td>Email</td>
                                    <td ></td>
                                </tr>
                            </thead>
                            <tbody id="teampagination">
                            {% if inviteeList is empty %}
                                <tr>
                                    <td colspan="2" align="center">No Talent to Invite</td>
                                </tr>
                            {% endif %}
                            {% for talent in inviteeList %}
                                <tr>
                                    <td data-title="Company Name"> {{ talent.getName()}} </td>

                                    <td data-title="Email"> {{ talent.getEmail() }} </td>

                                    <td data-title="Action">
                                        <a href={{ url('team/member/profile/') }}{{ talent.getId() }} class="btn tomboladd">Profile Info</a>
                                    </td>
                                </tr>
                            {% endfor %}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->

<!-- jQuery 2.2.0 -->
<script src="<?php echo $this->url->get('public'); ?>/js/jQuery-2.2.0.min.js"></script>

<!-- search-->
<script src="https://cdn.jsdelivr.net/g/jquery@2.2.4,bootstrap@3.3.6,mark.js@8.6.0(jquery.mark.min.js)"></script>


<script>
                        $('#teamMenu').addClass('active');
</script>

<script>
    $(function () {
        var $input = $("input[name='keyword']"),
                $context = $("table tbody tr");
        $input.on("input", function () {
            var term = $(this).val();
            $context.show().unmark();
            if (term) {
                $context.mark(term, {
                    done: function () {
                        $context.not(":has(mark)").hide();
                    }
                });
            }
        });
    });
</script>

<script>

    $(document).ready(function () {

        var show_per_page = 7;
        var number_of_items = $('#teampagination').children('tr').size();
        var number_of_pages = Math.ceil(number_of_items / show_per_page);

        $('.pagina').append('<div class=controls></div><input id=current_page type=hidden><input id=show_per_page type=hidden>');
        $('#current_page').val(0);
        $('#show_per_page').val(show_per_page);

        var navigation_html = '<a class="prev" onclick="previous()">&laquo;</a>';
        var current_link = 0;
        while (number_of_pages > current_link) {
            navigation_html += '<a class="page" onclick="go_to_page(' + current_link + ')" longdesc="' + current_link + '">' + (current_link + 1) + '</a>';
            current_link++;
        }
        navigation_html += '<a class="next" onclick="next()">&raquo;</a>';

        $('.controls').html(navigation_html);
        $('.controls .page:first').addClass('active-team');

        $('#teampagination').children().css('display', 'none');
        $('#teampagination').children().slice(0, show_per_page).css('display', '');

    });



    function go_to_page(page_num) {
        var show_per_page = parseInt($('#show_per_page').val(), 0);

        start_from = page_num * show_per_page;

        end_on = start_from + show_per_page;

        $('#teampagination').children().css('display', 'none').slice(start_from, end_on).css('display', '');

        $('.page[longdesc=' + page_num + ']').addClass('active-team').siblings('.active-team').removeClass('active-team');

        $('#current_page').val(page_num);
    }



    function previous() {

        new_page = parseInt($('#current_page').val(), 0) - 1;
        //if there is an item before the current active-team link run the function
        if ($('.active-team').prev('.page').length == true) {
            go_to_page(new_page);
        }

    }

    function next() {
        new_page = parseInt($('#current_page').val(), 0) + 1;
        //if there is an item after the current active-team link run the function
        if ($('.active-team').next('.page').length == true) {
            go_to_page(new_page);
        }

    }

</script>


<script>
    function refresh() {
        location.reload();
    }
</script>


