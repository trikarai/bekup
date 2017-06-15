{{ content() }}

<h2>Add Subject</h2>

<form action="<?php echo $this->url->get('subject/add'); ?>" method="post">
	
  <div class="form-group">
    <label for="name">Name:</label>
    <input type="text" class="form-control" id="name" name="name">
  </div>
     
  <button type="submit" class="btn btn-default">Submit</button>

</form>
</body>
</html>
