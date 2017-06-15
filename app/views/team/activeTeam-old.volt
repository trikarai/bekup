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
      </ol>
   </section>

    <!-- Main content -->
    <section class="content">

	<!-- tabs -->
<div class="row">	
	<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1-1" data-toggle="tab">Founder Agreement</a></li>
              <li><a href="#tab_2-2" data-toggle="tab">Vision</a></li>
              <li><a href="#tab_3-2" data-toggle="tab">Mission</a></li>
			  <li><a href="#tab_4-2" data-toggle="tab">Culture</a></li>
              
              <li class="pull-right header"><i class="fa fa-th"></i> Team name:<span class="team-name"> <?php echo $teamActiveDTO->name(); ?></span></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane fade in active" id="tab_1-1">
                
					<p><?php echo $teamActiveDTO->founderAgreement(); ?></p>
				
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane fade" id="tab_2-2">
                
					<p><?php echo $teamActiveDTO->vision(); ?></p>
				
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane fade" id="tab_3-2">
               
			        <p><?php echo $teamActiveDTO->mission(); ?></p>
			   
              </div>
              <!-- /.tab-pane -->
			  <div class="tab-pane fade" id="tab_4-2">
                
					<p><?php echo $teamActiveDTO->culture(); ?></p>
				
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
</div>
	
	<!-- tabs -->
	
      <!-- Default box -->
      <div class="box">
        
        <div class="box-body">
          
            
            <div class="tab-pane" id="settings">
                      
            <div class="panel panel-default">
                 <div class="panel-heading">My Team</div>
                <div class="panel-body">
                    <div align="right">
                        <a href='<?php echo $this->url->get('team/notification');?>' class="btn btn-danger"><i class="fa fa-plus"></i> Notification</a>
                    <a href='<?php echo $this->url->get('team/inviteMember');?>' class="btn btn-danger"><i class="fa fa-plus"></i> Invite Talent</a>
                    
                    </div> 
                    
                    
                    <div class="row">
                    <label class="col-sm-2 control-label">Team Name</label>

                    <div class="col-sm-10">
                      <div><?php echo $teamActiveDTO->name(); ?></div>
                    </div>
                  </div>
                                  
<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home">Founder Agreement</a></li>
  <li><a data-toggle="tab" href="#menu1">Vision</a></li>
  <li><a data-toggle="tab" href="#menu2">Mission </a></li>
  <li><a data-toggle="tab" href="#menu3">Culture </a></li>
</ul>

<div class="tab-content">
  <div id="home" class="tab-pane fade in active">
    
    <p><?php echo $teamActiveDTO->founderAgreement(); ?></p>
  </div>
  <div id="menu1" class="tab-pane fade">
    
    <p><?php echo $teamActiveDTO->vision(); ?></p>
  </div>
  <div id="menu2" class="tab-pane fade">
    <p><?php echo $teamActiveDTO->mission(); ?></p>
  </div>
    <div id="menu3" class="tab-pane fade">
    <p><?php echo $teamActiveDTO->culture(); ?></p>
  </div>
</div>
                  
		  
                    <table class="table table-hover table-mc-light-blue">
                    <thead>
                        <tr>
                        <td>Nama</td>
                        <td></td>
                        <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
				<?php foreach ($teamActiveDTO->queryActiveTeamMemberDTOs() as $row) :?>
                        <tr>
                            <td><a href='<?php echo $this->url->get('team/profileTalent/'. $row->queryTalentAsTeamMemberProfileDTO()->id());?>'>
                                <?php echo $row->queryTalentAsTeamMemberProfileDTO()->name(); ?></a></td>
                        <td></td>
                        <td>
                        
                        <?php 
                        if($myId == $row->queryTalentAsTeamMemberProfileDTO()->id()){
                            echo <<<_end
                            <a href="{$this->url->get('team/resignTeam/'.$row->id())}" class="btn btn-danger">Resign</a>
_end;
                        }else{
                            echo <<<_end
                            <a href="{$this->url->get('team/kickMember/'.$row->id())}" class="btn btn-danger">Kick</a>
_end;
                        }
                           
                 
                        ?>
                        
                        </td>
                        </tr>
                        <?php $i++; ?>
                <?php endforeach?>
                    </tbody>
                    </table>
                    
                    

                    <table class="table table-hover table-mc-light-blue">
                    <thead>
                        <tr>
                        <td>Nama</td>
                        <td></td>
                        <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $j = 0; ?>
				<?php foreach ($invitedDTOs as $row2) :?>
                        <tr>
                            <td><a href='<?php echo $this->url->get('team/profileTalent/'. $row2->queryTalentAsTeamMemberProfileDTO()->id());?>'>
                                <?php echo $row2->queryTalentAsTeamMemberProfileDTO()->name(); ?></a></td>
                        <td></td>
                        <td><a href="<?php echo $this->url->get('team/cancelInvitation/'.$row2->id()); ?>" class="btn btn-info">Cancel Invitation</a>
                        
                        
                        
                        </td>
                        </tr>
                        <?php $j++; ?>
                <?php endforeach?>
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

    </section>
    <!-- /.content -->
	
<!-- jQuery 2.2.0 -->
<script src="<?php echo $this->url->get('public'); ?>/js/jQuery-2.2.0.min.js"></script>
<script src="<?php echo $this->url->get('public'); ?>/js/bootstrap-notify.min.js"></script>

	
<script>
	$('#profileMenu').addClass('active');
	$('#jobMenu').css('color','#fff');
</script> 