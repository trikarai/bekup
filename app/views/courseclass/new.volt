<?php use Phalcon\Tag; ?>

{{ content() }}

<h1> Add Subject Course</h1>

<form action="<?php echo $this->url->get('courseclass/add'); ?>" method="post">
<?php echo Tag::hiddenField(array("subject_id")); ?>
  <div class="form-group">
    <label for="name">Name:</label>
    <input type="text" class="form-control" id="name" name="name" required="required" />
  </div>
  
  <div class="form-group">
    <label for="startdatereg">Start Registration:</label>
    <input type="date" class="form-control" id="startdatereg" name="start_registration_date" required="required" />
  </div>
  
  <div class="form-group">
    <label for="enddatereg">End Registration:</label>
    <input type="date" class="form-control" id="enddatereg" name="end_registration_date" required="required" />
  </div>
  
  <div class="form-group">
    <label for="startdateop">Start Operational:</label>
    <input type="date" class="form-control" id="startdateop" name="start_operational_date" required="required" />
  </div>
  
  <div class="form-group">
    <label for="enddaterop">End Operational:</label>
    <input type="date" class="form-control" id="enddaterop" name="end_operational_date" required="required" />
  </div>
  
  
  
   
  <button type="submit" class="btn btn-default">Submit</button>

</form>
</body>
</html>