<?php use Phalcon\Tag as Tag; ?>

{{ content() }}

<h2>Edit Subject</h2>

<form action="<?php echo $this->url->get('course/update'); ?>" method="post">
	
  <?php echo Tag::hiddenField(array('id',"class" => "form-control")); ?>  
   	 
  <div class="form-group">
    <label for="name">Name:</label>
    <?php echo Tag::textField(array('name',"class" => "form-control","required"=>"required")); ?> 
  </div>
     
  <button type="submit" class="btn btn-default">Submit</button>

</form>
</body>
</html>
