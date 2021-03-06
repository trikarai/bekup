<?php use Phalcon\Tag; ?>

<style>

#filefa {
	border: 1px solid transparent;
    border-color: #cccccc;
    padding: 17px;
    padding-top: 8px;
    border-radius: 4px;
}


</style>

{{ content() }}
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <a href="<?php echo $this->url->get('team/index');?>" class="btn tomboladd"><i class="fa fa-reply" aria-hidden="true"></i> back</a> Team
        <small>profile</small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li>Edit Team</li>
      </ol>
   </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title">Edit Team</h3>
		</div>
        
        <div class="box-body" style="width:50%; margin:10px">
            
           
            <div class="tab-pane" id="settings">
           
                
                <form action="<?php echo $this->url->get('team/updateTeam'); ?>" method="post" enctype="multipart/form-data">
                
                
                    <div class="form-group">
                        <label for="name">Name</label>
                        <?php echo Tag::textField(array('name','class'=>'form-control', 'required'=>'required')); ?>
                    </div>
                
                    <div class="form-group">
                        <label for="vision">vision</label>
                        <?php echo Tag::textArea(array('vision','class'=>'form-control', 'required'=>'required')); ?>
                    </div>
                
                    <div class="form-group">
                        <label for="mission">mission</label>
                        <?php echo Tag::textArea(array('mission','class'=>'form-control', 'required'=>'required')); ?>
                    </div>
                    <div class="form-group">
                        <label for="culture">culture</label>
                        <?php echo Tag::textArea(array('culture','class'=>'form-control', 'required'=>'required')); ?>
                    </div>
                    <div class="form-group">
                        <label for="founderAgreement">Founder Agreement</label>
                        <div id="filefa">
                            <?php if($fileactive!=""){
                               echo '<p class="form-control-static">'. $fileactive . '</p>' ; 
                               echo Tag::hiddenField(array('founderAgreementFile2','class'=>'','value'=>$fileactive));
                               echo '<text onclick="" class="btn tomboladd"><span class="glyphicon glyphicon-remove-circle confirm-delete" data-id="founderAgreementFile"> Remove</span></text>';
                               echo Tag::fileField(array('founderAgreementFile','class'=>'','accept'=>'application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document','style'=>'display:none'));
                            }else{
                               echo Tag::fileField(array('founderAgreementFile','class'=>'','accept'=>'application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document'));
                            }?>
                            </div>
                        
                    </div>
                    <div class="form-group">
                        <label for="position">Position</label>
                        <?php echo Tag::textField(array('position','class'=>'form-control', 'required'=>'required')); ?>
                    </div>
                
                    <button type="submit" class="btn btn-default" >Update </button>
                
                </form>
                
                </div>
            </div>
                 	     
            <!-- tab pane-->
                
        
		<!-- Modal -->
					  <div class="modal fade" id="myModalremovefile" role="dialog">
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
    
    // function removeFile(){
        // $("#filefa").empty();
        // $("#filefa").append("<input type='file' id='founderAgreementFile' name='founderAgreementFile' class='form-control' accept='application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document'>");
    // };


</script>
	
<script>
	$('#teamMenu').addClass('active');
	$('#teamMenu').css('color','#fff');
</script> 

<script>
$('#myModalremovefile').on('show', function() {
    var id = $(this).data('id'),
        removeBtn = $(this).find('.danger');
})

$('.confirm-delete').on('click', function(e) {
    e.preventDefault();

    var id = $(this).data('id');
    $('#myModalremovefile').data('id', id).modal('show');
});

$('#btnYes').click(function() {
	
var id = $('#myModalremovefile').data('id');
    //sending to php the row to be deleted from the db
	// alert (id);
 $.ajax({

	  data: 'id',
	  success: function(){
		$("#filefa").empty();
        $("#filefa").append("<input type='file' id='founderAgreementFile' name='founderAgreementFile' class='form-control' accept='application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document'>");
		
		
		 $('#myModalremovefile').modal('hide');
		 
		 $(document).ready(function () {
				$('.box-footer').notify({
					message: {
						text: 'Item Removed!'
					}
				}).show();
			});
		 		 
	   },
	 
	 
 });
return false;
});

</script>