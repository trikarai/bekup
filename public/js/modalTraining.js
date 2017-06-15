$('#myModalTrainingRemove').on('show', function() {
    var id = $(this).data('id'),
        removeBtn = $(this).find('.danger');
})

$('.confirm-delete').on('click', function(e) {
    e.preventDefault();

    var id = $(this).data('id');
    $('#myModalTrainingRemove').data('id', id).modal('show');
});

$('#btnYes').click(function() {
	
var id = $('#myModalTrainingRemove').data('id');
    //sending to php the row to be deleted from the db
	// alert (id);
	
 $.ajax({
	  url: '<?php echo $this->url->get("talent/removeTraining/");?>'+id,
	  // type: POST,
	  data: 'id='+id,
	  success: function(html){
		// $('[data-id='+id+']').remove();
		// $('#myModalTrainingRemove').modal('hide');
	 
		 //removing entire row
		 $('[data-id='+id+']').parents('tr').remove();
		 $('#myModalTrainingRemove').modal('hide');
		 
		 $(document).ready(function () {
				$('.box-footer').notify({
					message: {
						text: 'Item Removed!'
					}
				}).show();
			});
		 		 
	   } 
 });
return false;
});