<?php use Phalcon\Tag as Tag; ?>

<head>
    <title>Sign Up Form</title>
    <link href='http://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{url('public')}}/css/register/register.css"  />
    <link rel="stylesheet" href="{{url('public')}}/css/datepicker.css"  />

</head>
<body>

    <form method="post" action={{url('bekupregister/signupstart')}}>

        <h1 style="margin-top: 17px;font-weight: bold;">Pre - Registrasi</h1>
        <div class="row" style="margin-bottom: 35px;">
            <div class="col-md-4">
                <a class="prehome" href={{url('index/index')}}><i class="fa fa-home" aria-hidden="true"></i> Home</a>
            </div>
        </div>

        {{ content() }}
		{{ flash.output() }}
        <fieldset>
            <legend><span class="number">1</span>Your basic info</legend>
            {{text_field("name", "id": "name", "placeholder": "name", "required": "required")}}
            {{text_field("user_name", "id": "name", "placeholder": "username", "required": "required")}}
            {{email_field("email", "id": "email", "placeholder": "email", "required": "required")}}
            {{password_field("password", "id": "password", "placeholder": "password", "required": "required")}}
            {{password_field("repassword", "id": "confirm_password", "placeholder": "retype password", "required": "required")}}
            {{text_field("phone", "id": "phone", "placeholder": "phone", "required": "required")}}
            {{text_area("motivation", "id": "motivation", "placeholder": "motivasi ikut program bekup", "required": "required")}}
            <div id="birthdate">
                {{text_field("birth_date", "class": "form-control", "placeholder": "birth date", "required": "required")}}
            </div>
            {{text_field("city_of_origin", "id": "domisili", "placeholder": "Kota Domisili", "required": "required")}}
            <div id="city">
                <label for="city">City :</label>
                {{select_static("city_id", cityList)}}
            </div>
			<div id="track" style="margin-bottom:30px;">
                <label for="track">Gender :</label>
				{{select_static("gender", genderList)}}
            </div>
            <div class="g-recaptcha" data-sitekey="6LfhvBYUAAAAAMTzotjfhChjCevXeVLE_25b6ePV"></div>
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

