{{ content() }}
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Talent
        <small>profile</small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Profile</a></li>
        <li>Job History</li>
      </ol>
             
        
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Job History</h3>
          
          <div align="right">
            <a href="{{url('talent/addJob')}}" class="btn tomboladd"><i class="fa fa-plus"></i> Add job History</a>
</div>
          
        </div>
        <div class="box-body">
            
			<div class="tab-pane" id="settings">
                
                  <table id="table" class="table table-hover table-mc-light-blue">
                <thead style="font-weight:bold;">
                <tr>
                    <td>Company Name</td> 
                    <td>Position</td> 
                    <td>Working Time</td>  
                    <td>Role</td> 
                    <td colspan="2"></td>
                </tr>
                </thead>
                <tbody>
                    {% if(jobHistoryDTOs) %}
                        {% for row in jobHistoryDTOs %}
                <tr>
                <td data-title="Company Name"> {{row.companyName}}</td>
                <td data-title="Position"> {{row.position}} </td>
                <td data-title="Working Time"> {{row.startWorkingTime}} - {{row.endWorkingTime}} </td>
                <td data-title="Role"> {{row.role}}</td>
                        
                <td data-title="Action">
			<a href="{{url('talent/editJob/')}}{{row.id}}" class="btn tomboledit">Edit</a>
                        </td>
                        <td>
			<a href="#" class="btn tombolremove confirm-delete" data-id="{{row.id}}">Remove</a>                      
                        </td>
                    </tr>
{%endfor%}
{%else%}

                    <tr>
                        <td colspan="6" align="center" style="font-style:italic;">No Job History Data</td>
                    </tr>
{%endif%}
</tbody>
</table>
                            
                            
                            <!-- Modal -->
					  <div class="modal fade" id="myModalJobRemove" role="dialog">
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
<script src="https://code.jquery.com/jquery-2.2.0.min.js"
  integrity="sha256-ihAoc6M/JPfrIiIeayPE9xjin4UWjsx2mjW/rtmxLM4="
  crossorigin="anonymous"></script>
<script src="{{url('public/js/bootstrap-notify.min.js')}}"></script>

	
<script>
	$('#profileMenu').addClass('active');
	$('#jobMenu').css('color','#fff');
</script>

<script>
$('#myModalJobRemove').on('show', function() {
    var id = $(this).data('id'),
        removeBtn = $(this).find('.danger');
})

$('.confirm-delete').on('click', function(e) {
    e.preventDefault();

    var id = $(this).data('id');
    $('#myModalJobRemove').data('id', id).modal('show');
});

$('#btnYes').click(function() {
	
var id = $('#myModalJobRemove').data('id');
    //sending to php the row to be deleted from the db
	// alert (id);
 $.ajax({
	  url: '{{url('talent/removeJob/')}}'+id,
	  // type: POST,
	  data: 'id='+id,
	  success: function(html){
		
		
		// $('[data-id='+id+']').remove();
		// $('#myModalJobRemove').modal('hide');
	 
		 //removing entire row
		 $('[data-id='+id+']').parents('tr').remove();
		 $('#myModalJobRemove').modal('hide');
		 
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
 