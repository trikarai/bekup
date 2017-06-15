<?php 
use Phalcon\Tag; 
use Talent\Application\Service\Team\DTO\QueryTeamDTO;

/**
 * @param QueryTeamDTO $dto
 */
function _hinted(QueryTeamDTO $dto){
    return $dto;
}

?>
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

	<!-- tabs -->
<div class="row">
	<div class="col-md-12">
	<div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
			  <li class="pull-left header"><span style="margin-right: 20px;"><a style="margin-bottom: 7px;" class="btn tomboledit" href="{{url('team/editTeam/')}}">edit </a></span><i class="fa fa-th"></i> Team name:<span class="team-name">{{teamActiveDTO.name}}</span></li>
              <li><a href="#tab_1-1" data-toggle="tab">Founder Agreement</a></li>
              <li><a href="#tab_2-2" data-toggle="tab">Vision</a></li>
              <li><a href="#tab_3-2" data-toggle="tab">Mission</a></li>
              <li  class="active"><a href="#tab_4-2" data-toggle="tab">Culture</a></li>
              
              
            </ul>
            <div class="tab-content">
              <div class="tab-pane fade" id="tab_1-1">
                <p>
                    
                    {% if teamActiveDTO.founderAgreement != "" %}
                        <a class="fa fa-file-pdf-o" target="_blank" href="{{url('public/uploads/')}}{{teamActiveDTO.founderAgreement}}"> {{teamActiveDTO.founderAgreement}}</a> 
                        {%else%}
                        There is no founder agreement file
                    {%endif%}          
                </p>
				
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane fade" id="tab_2-2">
                
					<p>{{teamActiveDTO.vision}}</p>
				
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane fade" id="tab_3-2">
               
			        <p>{{teamActiveDTO.mission}}</p>
			   
              </div>
              <!-- /.tab-pane -->
			  <div class="tab-pane fade in active" id="tab_4-2">
                
					<p>{{teamActiveDTO.culture}}</p>
				
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
	 </div>
</div>
	
	
<div class="row">
	<div class="col-md-6">
	
      <!-- Default box -->
      <div class="box">
        
        <div class="box-body">
          
            
            <div class="tab-pane" id="settings">
                      
            <div class="panel panel-default">
                 <div class="panel-heading">My Team Member</div>
                <div class="panel-body">
                    
                    <table class="table table-hover table-mc-light-blue">
                    <thead>
                        <tr class="myteammember"></tr>
						<tr>
                        <td style="font-weight:900;">Name</td>
                        <td style="font-weight:900;">Position</td>
                        <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($teamActiveDTO):?>
                        <?php $i = 0; ?>
				<?php foreach ($teamActiveDTO->queryActiveTeamMemberDTOs() as $row) :?>
                        <tr>
                            <td><a href='<?php echo $this->url->get('team/profileTalent/'. $row->queryTalentAsTeamMemberProfileDTO()->id());?>'>
                                <?php echo $row->queryTalentAsTeamMemberProfileDTO()->name(); ?></a></td>
                            <td>
                                 <?php echo $row->position(); ?></a>
                            </td>
                        <td>
                        
                        <?php 
                        if($myId == $row->queryTalentAsTeamMemberProfileDTO()->id()){
                            echo <<<_end
                            <a href="{$this->url->get('team/resignTeam/'.$row->id())}" class="btn tomboladd pull-right confirm-delete" 
							data-id="{$row->id()}"><i class="fa fa-external-link"></i> Resign</a>
_end;
                        }else{
                            echo <<<_end
                            <a href="{$this->url->get('team/kickMember/'.$row->id())}" class="btn tomboladd pull-right"><i class="fa fa-exclamation-circle"></i> Kick</a>
_end;
                        }
                        						
                 
                        ?>
											
                        
                        </td>
                        </tr>
	                        <?php $i++; ?>
                <?php endforeach ?>
                        <?php else:?>
                    <tr>
                        <td colspan="3" align="center">No Team Member</td>
                    </tr>
                <?php endif; ?>                       
                    </tbody>
                    </table>
                 
                                        <!--Modal-->
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
					<!--End Modal-->
                    
                </div>
            </div>
      	</div>     
            <!-- tab pane-->
                
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <div align="right">
                <a href='{{url('team/notification')}}' class="btn tomboladd"><i class="fa fa-exclamation-circle"></i> Notification</a>
                <a href='{{url('team/inviteMember')}}' class="btn tomboladd"><i class="fa fa-plus"></i> Invite Talent</a>
			</div> 
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
	</div>
	
	<div class="col-md-6">
	
      <!-- Default box 2 -->
      <div class="box">
        
        <div class="box-body">
          
            
            <div class="tab-pane" id="settings">
                      
            <div class="panel panel-default">
                 <div class="panel-heading">My List Invitee</div>
                <div class="panel-body">
                    <table class="table table-mc-light-blue">
                    <thead>
			<tr class="mylistinvitee"></tr>
                        <tr>
                        <td style="font-weight:900;">Name</td>
                        <td></td>
                        <td></td>
                        </tr>
                    </thead>
                    <tbody>
                         <?php if($invitedDTOs):?>
                        <?php $j = 0; ?>
				<?php foreach ($invitedDTOs as $row2) :?>
                        <tr>
                            <td><a data-toggle="tooltip" title="Click for Profile Talent" href='<?php echo $this->url->get('team/profileTalent/'. $row2->queryTalentAsTeamMemberProfileDTO()->id());?>'>
                                <?php echo $row2->queryTalentAsTeamMemberProfileDTO()->name(); ?></a></td>
                        <td></td>
                        <td><a href="#" class="btn tomboladd pull-right confirm-cancel-inv" data-id="<?php echo $row2->id(); ?>"><i class="fa fa-times"></i> Cancel Invitation</a>
                         </td>
                        </tr>
						
						<!-- Modal -->
							  <div class="modal fade" id="myModalTeamCancel" role="dialog">
								<div class="modal-dialog modal-sm">
								
								  <!-- Modal content-->
								  <div class="modal-content">
									<!-- <div class="modal-header"> -->
									  <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
									  <!-- <h4 class="modal-title"></h4> -->
									<!-- </div> -->
									<div class="modal-body">
									  <p>Do you want to cancel invitation ?</p>
									</div>
									<div class="modal-footer">
									  <a href="#" type="button" class="btn tombolmodal" id="btnCancel" data-dismiss="modal">Yes</a>
									  <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
									</div>
								  </div>								  
								</div>
							  </div>                            
					   <!-- Modal -->
						
	                 <?php $j++; ?>
                <?php endforeach?>
                         <?php else:?>
                    <tr>
                        <td colspan="3" class="center-status">No Invited Talent</td>
                    </tr>
                <?php endif; ?>
                    </tbody>
                    </table>
                    
                   
                </div>
            </div>
       	</div>     
            <!-- tab pane-->
                
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <div class="col-sm-offset-2 col-sm-10">
			</div>
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
	</div>
	
</div>
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

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>

<script>
$('#myModalTeam').on('show', function() {
    var id = $(this).data('id'),
        removeBtn = $(this).find('.danger');
});

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
	  url: '{{url('team/resignTeam/')}}'+id,
	  // type: POST,
	  data: 'id='+id,
	  success: function(html){
		
		
		// $('[data-id='+id+']').remove();
		// $('#myModalTeam').modal('hide');
	 
		 //removing entire row
		 $('[data-id='+id+']').parents('tr').remove();
		 $('#myModalTeam').modal('hide');
		 
		 $(document).ready(function () {
				$('table .myteammember').notify({
					message: {
						text: 'You have resigned!'
					}
				}).show();
				
				setTimeout(function () {
				window.location.href = "../team/index"; }, 4500); 
				});
		 		 
	   }
 });
return false;
});

</script>

<script>
$('#myModalTeamCancel').on('show', function() {
    var id = $(this).data('id'),
        removeBtn = $(this).find('.danger');
});

$('.confirm-cancel-inv').on('click', function(e) {
    e.preventDefault();

    var id = $(this).data('id');
    $('#myModalTeamCancel').data('id', id).modal('show');
});

$('#btnCancel').click(function() {
	
var id = $('#myModalTeamCancel').data('id');
    //sending to php the row to be deleted from the db
	// alert (id);
 $.ajax({
	  url: '{{url('team/cancelInvitation/')}}'+id,
	  // type: POST,
	  data: 'id='+id,
	  success: function(html){
		// $('[data-id='+id+']').remove();
		// $('#myModalTeamCancel').modal('hide');
	 
		 //removing entire row
		 $('[data-id='+id+']').parents('tr').remove();
		 $('#myModalTeamCancel').modal('hide');
		 
		 $(document).ready(function () {
				$('table .mylistinvitee').notify({
					message: {
						text: 'Invitation Canceled'
					}
				}).show();
			});
		 		 
	   }; 
 });
return false;
});

</script>