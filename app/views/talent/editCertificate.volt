{{ content() }}

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Talent
        <small>profile</small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Profile</li>
        <li>Edit Certificate</li>
      </ol>
        
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Certificate</h3>
        </div>
        <div class="box-body">
            
        <div style="width:50%; margin:10px">
            <form action="{{url('talent/updateCertificate')}}" method="post">
                {{hidden_field("id")}}        
        <div class="form-group">
        	<label for="name">Certificate's Name:</label>
                {{text_field("name","placeholder":"Certificate's Name", "class":"form-control", "max-length":70,"required":"required")}}
        </div>
        
        <div class="form-group">
        	<label for="organizer">Organizer:</label>
                {{text_field("organizer","placeholder":"Organizer", "class":"form-control", "max-length":70,"required":"required")}}
        </div>
        
        <div class="form-group">
        	<label for="validUntil">Valid Until:</label>
                {{text_field("validUntil","maxlength":4, "placeholder":"Valid Until (yyyy)", "class":"form-control","pattern":"^(19[5-9]\d|20[0-4]\d|2050)$" , "required":"required")}}
        </div>
                
        <button type="submit" class="btn btn-default">Submit</button>
        
        </form>
        </div>
          
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          
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

	
<script>
	$('#profileMenu').addClass('active');
	$('#certificateMenu').css('color','#fff');
</script>