
{{ content() }}
<link rel="stylesheet" href="{{url('public/css/datepicker.css')}}"  />

	<section class="content-header">
      <h1>
        <a href="{{url('talent/index')}}" class="btn tomboladd"><i class="fa fa-reply" aria-hidden="true"></i> back</a> Talent
        <small>profile</small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Profile</li>
        <li>Edit Profile</li>
      </ol>
        
        
        
    </section>

<section class="content">
	<div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Profile</h3>
        </div>
        <div class="box-body" style="width:50%; margin:10px">
	
			<form action="{{url('talent/update')}}" method="post">
					 
			  <div class="form-group">
				<label for="name">Name:</label>
                                {{text_field('name','class':'form-control')}}
			  </div>
				
			  <div class="form-group">
				<label for="phone">Phone:</label>
                                {{text_field('phone','class':'form-control')}}
			  </div>
				
			  <div class="form-group">
				<label for="email">Email:</label>
                                {{email_field('email','class':'form-control')}}
			  </div>
				
			  <div class="form-group">
				<label for="birthdate">Birth date:</label>
                                {{text_field('birthdate','class':'form-control')}}
			  </div>
				
				<div class="form-group">
				<label for="domicile">City of Origin:</label>
                                {{text_field('domicile','class':'form-control')}}
			  </div>
                                {{hidden_field('cityId','class':'form-control')}}
                                {{hidden_field('trackId','class':'form-control')}}
				
			  <button type="submit" class="btn btn-default">Submit</button>

			</form>
		</div>
		<div class="box-footer">
            <div class="col-sm-offset-2 col-sm-10">
			</div>
        </div>
	</div>

</section>


    <!-- jQuery 2.2.0 
<script src="<?php echo $this->url->get('public'); ?>/js/jQuery-2.2.0.min.js"></script>-->
<script src="https://code.jquery.com/jquery-2.2.0.min.js"
  integrity="sha256-ihAoc6M/JPfrIiIeayPE9xjin4UWjsx2mjW/rtmxLM4="
  crossorigin="anonymous"></script>
<script src="{{url('public/js/bootstrap-datepicker.js')}}"></script>

<script>
$('#birthdate input').on('show', function(e){
    console.debug('show', e.date, $(this).data('stickyDate'));
    
    if ( e.date ) {
         $(this).data('stickyDate', e.date);
    }
    else {
         $(this).data('stickyDate', null);
    }
});

$('#birthdate input').on('hide', function(e){
    console.debug('hide', e.date, $(this).data('stickyDate'));
    var stickyDate = $(this).data('stickyDate');
    
    if ( !e.date && stickyDate ) {
        console.debug('restore stickyDate', stickyDate);
        $(this).datepicker('setDate', stickyDate);
        $(this).data('stickyDate', null);
    }
});

</script>

<script>

$(function(){
   $('#birthdate').datepicker({
      format: 'yyyy-mm-dd',
	  autoclose: true
    });
});


</script>

	
<script>
	$('#profileMenu').addClass('active');
	$('#basicinfoMenu').css('color','#fff');
</script>