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
        <a href="<?php echo $this->url->get('team/index');?>" class="btn tomboladd"><i class="fa fa-home" aria-hidden="true"></i> Team Profile</a> Team
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
                        <?php if(@$notificationDTOs):?>
                        <?php foreach ($notificationDTOs as $row): ?>
                        <tr>
                            <td><span class="teamname"><?php echo $row->queryTeamProfileDTO()->name() ?></span> invited you to join as <span class="positionname"><?php echo $row->position(); ?></span></td>
                            <td><a href="<?php echo $this->url->get('team/rejectInvitation/'.$row->id()); ?>" class="btn btn-danger">Reject</a></td>
                            <td>
                            <?php 
                                if(!$hasActive){ 
                                   echo "<a href='";
                                   echo $this->url->get('team/acceptInvitation/'.$row->id());
                                   echo " 'class='btn btn-default'>Accept</a>";
                                }else{
                                    
                                }
                            ?>
                                </a>
                            </td>
                        </tr>

                        <?php endforeach?>
                        <?php else: ?>
					   
                       <tr>
                            <td colspan="3" class="text-center" style="font-style:italic;">No Invitation Request</td>
							<td colspan="3"> </td>
                        </tr>
                        <?php endif;?>
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
	
<script src="<?php echo $this->url->get('public'); ?>/js/jQuery-2.2.0.min.js"></script>

	
<script>
	$('#teamMenu').addClass('active');
	$('#teamMenu').css('color','#fff');
</script> 