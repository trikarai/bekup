<?php
	use Phalcon\Tag as Tag;
	use Phalcon\Flash\Direct as FlashDirect;
    use Phalcon\Flash\Session as FlashSession;
?>

<head>
        <title>Sign Up Form</title>
        <link href='http://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="<?php echo $this->url->get('public'); ?>/css/register/register.css"  />
		<link rel="stylesheet" href="<?php echo $this->url->get('public'); ?>/css/datepicker.css"  />
		
</head>
    <body>

	  <form method="POST" action={{url('register/signupJourney')}} >	
      
        <h1 style="margin-top: 17px;font-weight: bold;">Bekup Journey Registration</h1>
		
		
		<div class="row" style="margin-bottom: 35px;">
			<div class="col-md-4">
				<a class="prehome" href="<?php echo $this->url->get('index');?>"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
			</div>
			<div class="col-md-8">
				<a class="preregis" href="<?php echo $this->url->get('register/journeyDiloMember');?>"><i class="ion ion-compose"></i> Journey Registration member DILo</a>
				
			</div>
		</div>
		
		
		
		{{flash.output()}}
        {{ content() }}
        <fieldset>
          <legend><span class="number">1</span>Your basic info</legend>
          <!-- <label for="name">Name:</label> -->
          {{text_field("name", "id": "name", "class": "form-control", "placeholder": "name", "required": "required")}}
		  
		  <!-- <label for="username">Username:</label> -->
          {{text_field("user_name", "id": "name", "class": "form-control", "placeholder": "username", "required": "required")}}
          
          <!-- <label for="mail">Email:</label> -->
          {{email_field("email", "id": "email", "class": "form-control", "placeholder": "email", "required": "required")}}
          
          <!-- <label for="password">Password:</label> -->
          {{password_field("password", "id": "password", "class": "form-control", "placeholder": "password", "required": "required")}}
		  
		  {{password_field("repassword", "id": "confirm_password", "class": "form-control", "placeholder": "retype password", "required": "required")}}
		  
		  <!-- <label for="username">Username:</label> -->
          <!-- <input type="text" id="address" name="address" placeholder="address" required/> -->
		  
		  <!-- <label for="username">Username:</label> -->
          {{text_field("phone", "id": "phone", "class": "form-control", "placeholder": "phone", "required": "required")}}
		  
		  {{text_area("motivation", "id": "motivation", "class": "form-control", "placeholder": "motivation", "required": "required")}}
		  
		  <div id="gender">
            <label for="gender">Gender :</label>
            {{select_static("gender", "class": "form-control", genderList)}}
          </div>
		  
		  <div id="birthdate">
			{{text_field("birth_date", "class": "form-control", "placeholder": "birth date", "required": "required")}}
		  </div>
		  
		  <!-- <label for="username">Domicile:</label> -->
          {{text_field("city_of_origin", "id": "domisili", "class": "form-control", "placeholder": "Kota Domisili", "required": "required")}}
		  
		  <div id="city">
            <label for="city">City :</label>
            {{select_static("city_id", "class": "form-control", cityList)}}
          </div>
         						
		<div class="g-recaptcha" data-sitekey="6LcJtSUUAAAAAJfDDzKlhP5CI4oOGC70MhJ_398r"></div>
		
		</fieldset>
			
		
        <button type="submit">SIGN UP</button>
      </form>
	  

	 	  
	<script src='https://www.google.com/recaptcha/api.js'></script>  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->url->get('public'); ?>/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("<?php echo $this->url->get('public'); ?>/img/register-bg2.jpg", {speed: 500});
    </script>	
	<script src="<?php echo $this->url->get('public'); ?>/js/validatepassword.js"></script>	
	<script src="<?php echo $this->url->get('public'); ?>/js/bootstrap-datepicker.js"></script>
	<script src="<?php echo $this->url->get('public'); ?>/js/birthdate.js"></script>
	
	
    </body>
</html>

