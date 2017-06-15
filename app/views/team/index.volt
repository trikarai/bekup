<?php use Phalcon\Tag; ?>

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

      <!-- Default box -->
      <div class="box">
        
        <div class="box-body">
            
            <?php 
            
            if($teamActiveDTO!=null){
                $style2 = 'style="display: none"';
                $style1 = '';
            }else{
                $style1 = 'style="display: none"';
                $style2 = '';
            }
            ?>
            
            <div class="tab-pane" id="settings">
            <div class="panel panel-default" <?php echo $style1 ?>>
            <div class="panel-heading">No Active Team</div>
            <div class="panel-body">
            <div align="left">
                <a href='<?php echo $this->url->get('team/createTeam');?>' class="btn btn-default"><i class="fa fa-plus"></i> Create Team</a>
            </div>
            </div>
            </div>
                       <hr/>             
            <div class="panel panel-default" <?php echo $style2 ?>>
                 <div class="panel-heading">My Team</div>
                <div class="panel-body">
                    <div align="right">
                        <a href='<?php echo $this->url->get('team/resignTeam');?>' class="btn btn-danger"><i class="fa fa-plus"></i> Resign Team</a>
                        <a href='<?php echo $this->url->get('team/notification');?>' class="btn btn-danger"><i class="fa fa-plus"></i> Notification</a>
                    
                    </div> 
                    
                    
                    <div class="row">
                    <label class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <div><?php echo $teamActiveDTO->name(); ?></div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 control-label">founderAgreement</label>

                    <div class="col-sm-10">
                       <div><?php echo $teamActiveDTO->founderAgreement(); ?></div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 control-label">culture</label>

                    <div class="col-sm-10">
                      <div>{{ teamActiveDTO.culture() }}</div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 control-label">vision</label>

                    <div class="col-sm-10">
                      <div><?php echo $teamActiveDTO->vision(); ?></div>
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
                        <tr>
                            <td><a href='<?php echo $this->url->get('team/profileTalent');?>'>Tri Sutrisno</a></td>
                        <td></td>
                        <td><a href="#" class="btn btn-info">Kick</a></td>
                        </tr>
                         <tr>
                        <td>Arief Maulana</td>
                        <td></td>
                        <td><a href="#" class="btn btn-info">Kick</a></td>
                         </tr>
                    </tbody>
                    </table>
                    
                    
<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home">Vision</a></li>
  <li><a data-toggle="tab" href="#menu1">Mision</a></li>
  <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
</ul>

<div class="tab-content">
  <div id="home" class="tab-pane fade in active">
    <h3>Vision</h3>
    <p>Some content.</p>
  </div>
  <div id="menu1" class="tab-pane fade">
    <h3>Mission</h3>
    <p>Some content in menu 1.</p>
  </div>
  <div id="menu2" class="tab-pane fade">
    <h3>Menu 2</h3>
    <p>Some content in menu 2.</p>
  </div>
</div>
                    
                   
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
<script src="{{ url("public/js/jQuery-2.2.0.min.js") }}"></script>
<script src="<?php echo $this->url->get('public'); ?>/js/bootstrap-notify.min.js"></script>

	
<script>
	$('#profileMenu').addClass('active');
	$('#jobMenu').css('color','#fff');
</script> 