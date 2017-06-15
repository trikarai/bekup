<?php use Phalcon\Tag as Tag; ?>

{{ content() }}

<h2>Add Course</h2>

<form action="<?php echo $this->url->get('course/add'); ?>" method="post">
	
  <div class="form-group">
    <label for="name">Name:</label>
    <?php echo Tag::textField(array('name',"class" => "form-control","required"=>"required")); ?> 
  </div>
     
  <button type="submit" class="btn btn-default">Submit</button>

</form>
</body>
</html>
