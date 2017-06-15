<?php use Phalcon\Tag; ?>

{{ content() }}

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       <a href="<?php echo $this->url->get('teamclass/index');?>" class="btn tomboladd"><i class="fa fa-reply" aria-hidden="true"></i> back</a> 
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> </a></li>
        <li>Add Team Class</li>
      </ol>
        
        
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Add Team Class</h3>
        </div>
        <div class="box-body">
            
       <div style="width:50%; margin:10px">
           
           <form action="<?php echo $this->url->get('teamclass/add'); ?>" method="post">
            <div class="form-group">
              <label for="teamclassname">Name:</label>
              <?php echo Tag::textField(array("teamclassname", "maxlength" => 70, "class" => "form-control", "required"=>"required")) ?>
            </div>

            <div class="form-group">
              <label for="start_registration_date">Start Registration:</label>
              <?php echo Tag::dateField(array("start_registration_date", "class" => "form-control", "required"=>"required")) ?>
            </div>

            <div class="form-group">
              <label for="end_registration_date">End Registration:</label>
                  <?php echo Tag::dateField(array("end_registration_date", "class" => "form-control", "required"=>"required")) ?>
            </div>

            <div class="form-group">
              <label for="start_operational_date">Start Operational:</label>
                      <?php echo Tag::dateField(array("start_operational_date", "class" => "form-control", "required"=>"required")) ?>
            </div>

            <div class="form-group">
              <label for="end_operational_date">End Operational:</label>
                          <?php echo Tag::dateField(array("end_operational_date", "class" => "form-control", "required"=>"required")) ?>
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
<script src="/bekup/public/js/jQuery-2.2.0.min.js"></script>

	
<script>
	$('#profileMenu').addClass('active');
	$('#skillMenu').css('color','#fff');
</script>