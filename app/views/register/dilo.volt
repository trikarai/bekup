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
	
	<form method="POST" action="<?php echo $this->url->get('register/diloRegister'); ?>">
		<div class="dilologin">
		<a class="menuatas" href="<?php echo $this->url->get('index/index');?>"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
			<div class="loginframe">
			  
			  <h2 class="DML">Pre-Registration for DILo member</h2>
			  </br>
			  {{ content() }}
				  <input type="text" id="name" name="name" placeholder="name" autocomplete="off" required/>
		  
				  <!-- <label for="username">Username:</label> -->
				  <input type="text" id="username" name="user_name" placeholder="username DILo Anda" autocomplete="off" required/>
				  
				  <!-- <label for="mail">Email:</label> -->
				  <!-- <input type="email" id="email" name="email" placeholder="email" required/> -->
				  
				  <!-- <label for="password">Password:</label> -->
				  <input type="password" id="password" name="password" placeholder="password DILo Anda" autocomplete="off" required/>
		  
				  <!-- <label for="username">Username:</label> -->
				  <input type="text" id="phone" name="phone" placeholder="phone" autocomplete="off" required/>
				  
				  <!-- <label for="username">Username:</label> -->
				  <input type="text" id="domisili" name="domicile" placeholder="kota domisili" autocomplete="off" required/>
				  
				  <div id="birthdate">
					<input type="text" type="text" name="birth_date" class="form-control" placeholder="birth date" style="height:70px !important;" autocomplete="off" required/>
				  </div>
				  
				<div id="city">	
				<div class="labeltag">City</div>
					</br>
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
				<label for="track" class="labeltag">Track</label>
					<?php 
						foreach ($tracks as $track){
							echo "<br>" . Phalcon\Tag::radioField(array("class" => "trackbutton" , "track_id", "value" => $track->id())) . " {$track->name()} 
						  <div class='trackdesc'> {$track->description()} </div>" ; 
						}
					?>					
				</div>
		
				{#<div class="g-recaptcha" data-sitekey="6LfhvBYUAAAAAMTzotjfhChjCevXeVLE_25b6ePV"></div>#}
                                <div class="g-recaptcha" data-sitekey="6LcJtSUUAAAAAJfDDzKlhP5CI4oOGC70MhJ_398r"></div>
				
				<input style="margin-top:20px" type='submit' value='Sign in'/>
			  
			  
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
