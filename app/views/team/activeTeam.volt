<style>
.vision {
	float: left;
    margin-right: 10px;
    height: 68px;
    width: 68px;
    color: #8c8c8c;
    background-color: #e4e4e4;
    border-radius: 10%;
    text-align: center;
    vertical-align: middle;
    padding-top: 20px;
    font-size: 26px;
}
</style>

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

<div class="row">
	<div class="col-md-12">
		<div class="box">
					<div class="box-header with-border">
						<div class="row">
							<div class="col-md-10">
								<h3 class="box-title" style="vertical-align: -webkit-baseline-middle;">My Team Member | x <i class="fa fa-th"></i> Team name:<span class="team-name"> <?php echo $teamActiveDTO->name(); ?></span></h3>
							</div>						  
						  <div class="col-md-2">
								<a href="{{url('team/inviteMember')}}" class="btn tomboladd" style="float:right;"><i class="fa fa-plus"></i> Add new member</a>
						  </div>
						</div>
					</div>	
				
				<div class="box-body">
				<div class="alert-teammember"></div>
				  
												
							<section>
								<?php if($teamActiveDTO):?>
						<?php foreach ($teamActiveDTO->queryActiveTeamMemberDTOs() as $row) :?>
								<div id="{{row.id()}}" style="float:left;
																padding:10px;
																margin:10px;
																text-align:center;
																width:30%;">
								
									<div class="img-circle" style="text-transform:uppercase;text-transform: uppercase;
																	text-transform: uppercase;
																	background: #6f6f6f;
																	display: inline-block;
																	padding: 22px;
																	color: #fff;
																	
																	font-size: 26px;
																	margin-bottom: 10px;
																	width: 80px;
																	height: 80px;">
										<?php 									
											$name = $row->queryTalentAsTeamMemberProfileDTO()->name();
											preg_match_all('~\b(\S){1}~', $name, $i); 
											echo @$i[1][0].@$i[1][1]; 
										?>
									</div>
									<div style="font-size: 16px;">
	                                     <a style="color: #6f6f6f !important;" data-toggle="tooltip" title="Click for Profile Talent" href='<?php echo $this->url->get('team/profileTalent/'. $row->queryTalentAsTeamMemberProfileDTO()->id());?>'>
										<?php echo $row->queryTalentAsTeamMemberProfileDTO()->name(); ?></a></div>
									<div style="color: #b1b1b1;
												font-size: 12px;
												font-style: italic;
												margin-bottom: 5px;">
										 <?php echo $row->position(); ?></a>
									</div>
								<div>
								
								<?php 
								if($myId == $row->queryTalentAsTeamMemberProfileDTO()->id()){
									echo <<<_end
									<a href="{$this->url->get('team/resignTeam/'.$row->id())}" class="btn tomboladd confirm-delete" 
									data-id="{$row->id()}"><i class="fa fa-external-link"></i> Resign</a>
_end;
								}else{
									echo <<<_end
									<a href="{$this->url->get('team/kickMember/'.$row->id())}" class="btn tomboladd confirm-delete-kick" data-id="{$row->id()}"><i class="fa fa-exclamation-circle"></i> Kick</a>
_end;
								}
														
						 
								?>
													
								
								</div>
								</div>
								
							<?php	
							echo	"<div class='modal fade' id='myModalTeam' role='dialog'>";
							echo		"<div class='modal-dialog modal-sm'>";
									

							echo	      "<div class='modal-content'>"	;		
							echo			"<div class='modal-body'>";
							echo			  "<p>Do you want to resign ?</p>";
							echo			"</div>";
							echo			"<div class='modal-footer'>";
							echo			  "<a href='#' type='button' class='btn tombolmodal' id='btnYes' data-dismiss='modal'>Yes</a>";
							echo			  "<button type='button' class='btn btn-default' data-dismiss='modal'>No</button>";
							echo			"</div>";
							echo		  "</div>";
							echo		"</div>";
							echo    "</div>";
							?>	
							
						<?php endforeach ?>
								<?php else:?>
							
								<div colspan="3" align="center">No Team Member</div>
							
						<?php endif; ?>
								
							</section>
						  
						 
					
					
					
					
				    
					<!-- tab pane-->
						
				</div>
				<!-- /.box-body -->
				
				<!-- /.box-footer-->
		</div>
	</div>	
</div>

<div class="row">
	<div class="col-md-12">
		<div class="box">
					<div class="box-header with-border">
						<div class="row">
							<div class="col-md-4">
								<h3 class="box-title" style="vertical-align: -webkit-baseline-middle;">Vision & Mission</h3>
							</div>						  
						  <div class="col-md-8">
								<a style="margin-bottom: 7px;" class="btn tomboledit pull-right" href="{{url('team/editTeam')}}">edit </a>
						  </div>
						</div>
					</div>	
				
				<div class="box-body">
				
				<div>
						<i class="fa fa-eye vision"></i>
						<h2 style="color: #676767;">Vision</h2>
						<p style="word-wrap: break-word;color: #ababab;">{{teamActiveDTO.vision}}</p>					
				</div> 
				<div>
					<i class="fa fa-rocket vision"></i>
					<h2 style="color: #676767;">Mission</h3>
					<p style="word-wrap: break-word;color: #ababab;">{{teamActiveDTO.mission}}</p>
				</div>
				<div>
					<i class="fa fa-ravelry vision"></i>
					<h2 style="color: #676767;">Culture</h3>
					<p style="word-wrap: break-word;color: #ababab;">{{teamActiveDTO.culture}}</p>
				</div>
				<div>
					<i class="fa fa-wpforms vision"></i>
					<h2 style="color: #676767;">Founder Agreement</h3>
					<p style="word-wrap: break-word;color: #ababab;">						
						{% if teamActiveDTO.founderAgreement != "" %}
							<a class="fa fa-file-pdf-o" style="margin-top: 15px;" target="_blank" href="{{url('public/uploads/')}}{{teamActiveDTO.founderAgreement}}"> {{teamActiveDTO.founderAgreement}}</a> 
							{%else%}
							There is no founder agreement file
						{%endif%}          
					</p>
				</div>
				
				</div>
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
                    
                    
                    <section>
                        <?php if($teamActiveDTO):?>
                        <?php $i = 0; ?>
				<?php foreach ($teamActiveDTO->queryActiveTeamMemberDTOs() as $row) :?>
                        <div id="{{row.id()}}" style="float:left;padding:10px;margin:10px;text-align:center;">
                            <div><a href='<?php echo $this->url->get('team/profileTalent/'. $row->queryTalentAsTeamMemberProfileDTO()->id());?>'>
                                <?php echo $row->queryTalentAsTeamMemberProfileDTO()->name(); ?></a></div>
                            <div>
                                 <?php echo $row->position(); ?></a>
                            </div>
							<div>
							
							<?php 
							if($myId == $row->queryTalentAsTeamMemberProfileDTO()->id()){
								echo <<<_end
								<a href="{$this->url->get('team/resignTeam/'.$row->id())}" class="btn tomboladd confirm-delete" 
								data-id="{$row->id()}"><i class="fa fa-external-link"></i> Resign</a>
_end;
							}else{
								echo <<<_end
								<a href="{$this->url->get('team/kickMember/'.$row->id())}" class="btn tomboladd confirm-delete-kick" data-id="{$row->id()}"><i class="fa fa-exclamation-circle"></i> Kick</a>
_end;
							}
												 
 				?>
												
				<!-- modal -->
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
						   <!-- Modal -->			
							
							
							</div>
                        </div>
						
					<?php	
					echo	"<div class='modal fade' id='myModalTeam' role='dialog'>";
					echo		"<div class='modal-dialog modal-sm'>";
							

					echo	      "<div class='modal-content'>"	;		
					echo			"<div class='modal-body'>";
					echo			  "<p>Do you want to resign ?</p>";
					echo			"</div>";
					echo			"<div class='modal-footer'>";
					echo			  "<a href='#' type='button' class='btn tombolmodal' id='btnYes' data-dismiss='modal'>Yes</a>";
					echo			  "<button type='button' class='btn btn-default' data-dismiss='modal'>No</button>";
					echo			"</div>";
					echo		  "</div>";
					echo		"</div>";
					echo    "</div>";
					?>	
					
                        <?php $i++; ?>
                <?php endforeach ?>
                        <?php else:?>
                    
                        <div colspan="3" align="center">No Team Member</div>
                    
                <?php endif; ?>
                        
                    </section>
                  
                 
                </div>
            </div>
            
            
            
     	</div>     
            <!-- tab pane-->
                
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <div align="right">
                <a href='<?php echo $this->url->get('team/notification');?>' class="btn tomboladd"><i class="fa fa-exclamation-circle"></i> Notification</a>
                <a href='<?php echo $this->url->get('team/inviteMember');?>' class="btn tomboladd"><i class="fa fa-plus"></i> Invite Talent</a>
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
                        <td><a href="<?php echo $this->url->get('team/cancelInvitation/'.$row2->id()); ?>" class="btn tomboladd pull-right confirm-cancel" data-id="<?php echo $row2->id(); ?>"><i class="fa fa-times"></i> Cancel Invitation</a>
                        
                        
                        
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
	  url: '<?php echo $this->url->get('team/resignTeam/');?>'+id,
	  // type: POST,
	  data: 'id='+id,
	  success: function(html){
		
		
		// $('[data-id='+id+']').remove();
		// $('#myModalTeam').modal('hide');
	 
		 //removing entire row
		 $('[data-id='+id+']').parents('tr').remove();
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
});

</script>

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
	  url: '<?php echo $this->url->get('team/cancelInvitation/');?>'+id,
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
		 		 
	   },
	 
	 
 });
return false;
});

</script>

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
	  url: '<?php echo $this->url->get('team/kickMember/');?>'+id,
	  // type: POST,
	  data: 'id='+id,
	  success: function(html){
		
		
		// $('[data-id='+id+']').remove();
		// $('#myModalTeamCancel').modal('hide');
	 
		 //removing entire row
		 $('#'+id+'').remove();
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


