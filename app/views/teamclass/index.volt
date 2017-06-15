<?php use Phalcon\Tag; ?>

{{ content() }}
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> </a></li>
        <li></li>
      </ol>
             
        
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Team Class</h3>
          
          <div align="right">
            <a href="<?php echo $this->url->get('teamclass/new');?>" class="btn tomboladd"><i class="fa fa-plus"></i> Add Team Class</a>
</div>
          
        </div>
        <div class="box-body">
            
			<div class="tab-pane" id="settings">
                
                  <table id="table" class="table table-hover table-mc-light-blue">
                <thead>
                <tr>
                    <!--<td>ID </td>-->
                    <td>Nama Course</td> 
                    <td>Registration </td> 
                    <td>Operational </td> 	
                    <td colspan="2">Action</td>
                </tr>
                </thead>
                <tbody>
                    <?php if($teamClassDTOs):?>
				<?php $i = 0; ?>
				<?php foreach ($teamClassDTOs as $row) :?>
                <tr>
                <td data-title="Skill"> <?php echo $row->name(); ?> </td>
               <td data-title="Registration Course"> <?php echo $row->startRegistrationDate(); ?> - <?php echo $row->endRegistrationDate(); ?></td>
                <td data-title="Operational Course"> <?php echo $row->startOperationDate(); ?> - <?php echo $row->endOperationDate(); ?></td>
                        
                <td data-title="Action">
                            <!--{{ link_to("city/edit", "Edit", "class": "btn") }}-->
			<a href='<?php echo $this->url->get('teamclass/edit/'.$row->id());?>' class="btn tomboledit">Edit</a>
                        </td>
                        <td>
                        <a href="#" class="btn tombolremove confirm-delete" data-id="<?php echo $row->id(); ?>">Remove</a>
                        </td>
                    </tr>
					
					<!-- Modal -->
					  <div class="modal fade" id="myModalSkillRemove" role="dialog">
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
					  
					<?php $i++; ?>
                <?php endforeach?>
                                          <?php else:?>
                    <tr>
                        <td colspan="4" align="center" style="font-style:italic;">No Team Class Data</td>
                    </tr>
                <?php endif; ?>
                   </tbody>
</table>
                            
                            
                            
			</div>       
                
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
<script src="/bekup/public/js/jQuery-2.2.0.min.js"></script>
<script src="/bekup/public/js/bootstrap-notify.min.js"></script>

	
<script>
	$('#profileMenu').addClass('active');
	$('#skillMenu').css('color','#fff');
</script>

<script>
$('#myModalSkillRemove').on('show', function() {
    var id = $(this).data('id'),
        removeBtn = $(this).find('.danger');
})

$('.confirm-delete').on('click', function(e) {
    e.preventDefault();

    var id = $(this).data('id');
    $('#myModalSkillRemove').data('id', id).modal('show');
});

$('#btnYes').click(function() {
	
var id = $('#myModalSkillRemove').data('id');
    //sending to php the row to be deleted from the db
	// alert (id);
 $.ajax({
	  url: '<?php echo $this->url->get('teamclass/remove/');?>'+id,
	  // type: POST,
	  data: 'id='+id,
	  success: function(html){
		
		
		// $('[data-id='+id+']').remove();
		// $('#myModalSkillRemove').modal('hide');
	 
		 //removing entire row
		 $('[data-id='+id+']').parents('tr').remove();
		 $('#myModalSkillRemove').modal('hide');
		 
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
 