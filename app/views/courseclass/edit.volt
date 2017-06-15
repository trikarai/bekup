<?php use Phalcon\Tag; ?>

{{ content() }}

<h1> Add Subject Course</h1>

<form action="<?php echo $this->url->get('courseclass/update'); ?>" method="post">
<?php echo Tag::hiddenField(array("id")); ?>
<?php echo Tag::hiddenField(array("subject_id")); ?>
  <div class="form-group">
    <label for="name">Name:</label>
    <?php echo Tag::textField(array("name", "maxlength" => 70, "class" => "form-control")) ?>
  </div>
  
  <div class="form-group">
    <label for="startdatereg">Start Registration:</label>
    <?php echo Tag::dateField(array("start_registration_date", "class" => "form-control")) ?>
  </div>
  
  <div class="form-group">
    <label for="enddatereg">End Registration:</label>
        <?php echo Tag::dateField(array("end_registration_date", "class" => "form-control")) ?>
  </div>
  
  <div class="form-group">
    <label for="startdateop">Start Operational:</label>
            <?php echo Tag::dateField(array("start_operational_date", "class" => "form-control")) ?>
  </div>
  
  <div class="form-group">
    <label for="enddaterop">End Operational:</label>
                <?php echo Tag::dateField(array("end_operational_date", "class" => "form-control")) ?>
  </div>
  
  
  
   
  <button type="submit" class="btn btn-default">Submit</button>

</form>
</body>
</html>