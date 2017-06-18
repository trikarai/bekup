<style>
.teamname {
	background: #80ce51;
    padding: 6px;
    color: #fff;
    border-left: 2px solid #67bb34;
    border-top-right-radius: 3px;
    border-bottom-right-radius: 3px;
}

.positionname {
	font-weight: bold;
    font-style: italic;
}
</style>


<?php use Phalcon\Tag; ?>

{{ content() }}
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <a href="{{url('team/dashboard/index')}}" class="btn tomboladd"><i class="fa fa-home" aria-hidden="true"></i> Team Profile</a> Team
        <small>Invitation</small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li>Team Notification</li>
      </ol>
   </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        
        <div class="box-body">
            
	<div class="tab-pane" id="settings">
                 
            <div class="">
<!--                 <div class="panel-heading">Team Invitation</div>-->
                <div class="panel-body">
                              
                    <table class="table table-hover table-mc-light-blue">
                    <thead>
                        <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        {% if notificationDTOs is empty %}
                            <tr>
                                <td colspan="3" class="text-center" style="font-style:italic;">No Invitation Request</td>
                                                            <td colspan="3"> </td>
                            </tr>
                        {% endif %}
                        {% for row in notificationDTOs %}
                        <tr>
                            <td><span class="teamname">{{row.teamRDO().getName()}}</span> invited you to join as <span class="positionname">{{row.getPosition()}}</span></td>
                            <td><a href={{url('team/member/reject/')}}{{row.teamRDO().getId()}}/{{row.getId()}} class="btn btn-danger">Reject</a></td>
                            <td><a href={{url('team/member/accept/')}}{{row.teamRDO().getId()}}/{{row.getId()}} class="btn btn-success">Accept</a></td>
                        </tr>
                       {% endfor %}
                    </tbody>
                    </table>
                            
                </div>
            </div>
      	</div>       
                
        </div>
        <!-- /.box-body -->
        
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
	$('#teamMenu').addClass('active');
	$('#teamMenu').css('color','#fff');
</script> 