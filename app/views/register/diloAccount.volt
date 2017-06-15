<?php
	use Phalcon\Tag as Tag;
	use Phalcon\Flash\Direct as FlashDirect;
    use Phalcon\Flash\Session as FlashSession;
?>

<head>
        <title>Sign Up Form</title>
        <link href='http://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="../css/register/register.css"  />
		<link rel="stylesheet" href="../css/datepicker.css"  />
		
</head>
    <body>

      <form method="post" action="<?php echo $this->url->get('register/diloRegister'); ?>">
      
        <h1 style="margin-top: 17px;font-weight: bold;">Register</h1>
        {{ content() }}
        <fieldset>
          <legend><span class="number"></span>Your basic info</legend>
          <!-- <label for="name">Name:</label> -->
          <input type="text" id="name" name="name" placeholder="name" required/>
		  
		  <!-- <label for="username">Username:</label> -->
          <input type="text" id="username" name="user_name" placeholder="username" required/>
          
          <!-- <label for="password">Password:</label> -->
          <input type="password" id="password" name="password" placeholder="password" required/>
		  
		  <input type="password" id="confirm_password" placeholder="confirm password"  required>
		  
		  <!-- <label for="username">Phone:</label> -->
          <input type="text" id="phone" name="phone" placeholder="phone" required/>
		  
		  <div id="birthdate">
			<input type="text" type="text" name="birth_date" class="form-control" placeholder="birth date" required/>
		  </div>
          
		<div id="city">	
		<label for="city">City:</label>
			<?php 
				$cityList = [];
				foreach ($cities as $city)
					$cityList[$city->id()] =  $city->name();
				echo Phalcon\Tag::selectStatic(
						array('city_id', $cityList,)
						); 
			?>					
		</div>
		
		<div id="track">	
		<label for="track">Track:</label>
			<?php 
				foreach ($tracks as $track){
					echo "<br>" . Phalcon\Tag::radioField(array("track_id", "value" => $track->id())) . " {$track->name()} <br> {$track->description()}" ; 
				}
			?>					
		</div>
		
		<div class="g-recaptcha" data-sitekey="6LdEWBkUAAAAAPJg4GIPDCDdFX5YOGzGpHiH6Zue"></div>		
		</fieldset>
		
        <button type="submit">SIGN UP</button>
      </form>
	  

	 	  
	<script src='https://www.google.com/recaptcha/api.js'></script>  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("http://bekup.info/public/img/register-bg2.jpg", {speed: 500});
    </script>	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="../js/validatepassword.js"></script>	
	<script src="../js/bootstrap-datepicker.js"></script>
	<script src="../js/birthdate.js"></script>
    </body>
</html>

