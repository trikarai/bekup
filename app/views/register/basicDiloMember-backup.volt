<?php
	use Phalcon\Tag as Tag;
	use Phalcon\Flash\Direct as FlashDirect;
    use Phalcon\Flash\Session as FlashSession;
?>

<title>DILo Member Registration</title>

<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Sofia' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href='<?php echo $this->url->get('public'); ?>/css/dilologin.css' rel='stylesheet' />
<link rel="stylesheet" href='<?php echo $this->url->get('public'); ?>/css/datepicker.css'  />
	

<div class="row">
	<div class="col-md-4 hidden-xs hidden-sm">
		<img class="img-responsive dilobekup" src="<?php echo $this->url->get('public'); ?>/img/leftdilobekuplogo.png"></img>
	</div>
	<div class="col-md-4">
	
	<form method="POST" action={{url('register/signupBasicDiloMember')}} >
		<div class="dilologin">
		<a class="menuatas" href="<?php echo $this->url->get('index');?>"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
			<div class="loginframe">
			  
			  <h2 class="DML">Basic Registration for DILo member</h2>
			  </br>
			  {{ content() }}
			  {{flash.output()}}
				  {{text_field("name", "id": "name" , "placeholder": "name", "required": "required", "autocomplete":"off")}}
		  
				  <!-- <label for="username">Username:</label> -->
				  {{text_field("user_name", "id": "name", "placeholder": "username", "required": "required", "autocomplete":"off")}}
				  
				  <!-- <label for="mail">Email:</label> -->
				  <!-- <input type="email" id="email" name="email" placeholder="email" required/> -->
				  
				  <!-- <label for="password">Password:</label> -->
				  {{password_field("password", "id": "password", "placeholder": "password", "required": "required", "autocomplete":"off")}}
		  
				  <!-- <label for="username">Username:</label> -->
				  {{text_field("phone", "id": "phone", "placeholder": "phone", "required": "required", "autocomplete":"off")}}
				  
				  <div style="margin-top:20px">
					{{text_area("motivation", "id": "motivation", "class":"form-control", "placeholder": "motivation", "required": "required", "autocomplete":"off")}}
				  </div>
				  
				  <div id="gender" style="margin-top:20px">
					<label for="gender">Gender :</label>
						{{select_static("gender","class":"form-control", genderList, "autocomplete":"off")}}
				  </div>
				  
				  <!-- <label for="username">Username:</label> -->
				   {{text_field("city_of_origin", "id": "domisili", "placeholder": "Kota Domisili", "required": "required", "autocomplete":"off")}}
				  
				  <div id="birthdate">
					{{text_field("birth_date", "placeholder": "birth date", "required": "required", "autocomplete":"off")}}
				  </div>
				  
				<div id="city">	
				<div class="labeltag">City</div>
					</br>
					{{select_static("city_id", cityList)}}			
				</div>
				
				<div id="track">	
				<label for="track" class="labeltag">Track</label>
					{{select_static("track_id","class":"form-control", trackList)}}			
				</div>
		
				<div class="g-recaptcha" data-sitekey="6LcJtSUUAAAAAJfDDzKlhP5CI4oOGC70MhJ_398r"></div>
				
				<input style="margin-top:20px" type='submit' value='Sign Up'/>
			  
			  
			</div>
		</div>
	</form>
	</div>
	<div class="col-md-4">
	</div>
</div>

<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="<?php echo $this->url->get('public'); ?>/js/bootstrap-datepicker.js"></script>
<script src="<?php echo $this->url->get('public'); ?>/js/birthdate.js"></script>
