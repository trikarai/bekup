<!DOCTYPE html>
<html>
    <head>
		
		<!--- basic page needs
	   ================================================== -->
		<meta charset="utf-8">
		<meta name="description" content="">  
		<meta name="author" content="">

	   <!-- mobile specific metas
	   ================================================== -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        
		
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		
		<link rel="stylesheet" href="<?php echo $this->url->get('public'); ?>/css/normalize.css"  />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"  />
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
		
		
		<!-- favicons
		================================================== -->
		<link rel="icon" type="image/png" href="<?php echo $this->url->get('public'); ?>/img/faviconbekup.png">
		
    </head>
    <body>
	
        <div>
            {{ content() }}
        </div>
		
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> -->
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
<Html>
