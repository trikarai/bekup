

  <head>
<style>
.alert {
	text-align: justify !important;
    border-radius: 0 !important;
    border-color: transparent !important;
}
</style>
    

    <title>BEKUP - Login Page</title>
            
    <!-- Custom styles for this template -->
    <link href="<?php echo $this->url->get('public'); ?>/css/login/style.css" rel="stylesheet">
    <link href="<?php echo $this->url->get('public'); ?>/css/login/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page">
	  
	  	<div class="container">
	  	
		      <form class="form-login" action=<?php echo $this->url->get('login/login'); ?> method="post">
		        <h2 class="form-login-heading">login</h2>
				{{content()}}
		        <div class="login-wrap">
		            <input class="form-control" type="text" name="username" placeholder="Username" autofocus required/>
		            <br>
		            <input type="password" name="password" class="form-control" placeholder="Password" required/>
					
		            <label class="checkbox">
		                <span class="pull-right">
		                    <!-- <a data-toggle="modal" href="login.html#myModal"> Forgot Password?</a> -->
		
		                </span>
		            </label>
					<br>
		            <button class="btn btn-theme btn-block btn-add" href="index.html" type="submit"><i class="ion ion-android-checkbox"></i> SIGN IN</button>
			  </form>
		            <hr>
		            
		            <!-- <div class="login-social-link centered"> -->
		            <!-- <p>or you can sign in via your social network</p> -->
		                <!-- <button class="btn btn-facebook" type="submit"><i class="fa fa-facebook"></i> Facebook</button> -->
		                <!-- <button class="btn btn-twitter" type="submit"><i class="fa fa-twitter"></i> Twitter</button> -->
		            <!-- </div> -->
		            <div class="registration">
		                Don't have an account yet?<br/>
		                <a class="" href="/../bekup/register">
		                    Register Here
		                </a>
		            </div>
		
		        </div>
				
		
		          <!-- Modal -->
		          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Forgot Password ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Enter your e-mail address below to reset your password.</p>
		                          <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
		
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <button class="btn btn-theme" type="submit">Submit</button>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
		
		      	  	
	  	
	  	</div>
	  </div>

 

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->url->get('public'); ?>/login/jquery.backstretch.min.js"></script>
    <script>
        <!-- $.backstretch("assets/img/login-bg.jpg", {speed: 500}); -->
    </script>


        

