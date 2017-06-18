<?php
use Phalcon\Tag as Tag;
use Phalcon\Flash\Direct as FlashDirect;
use Phalcon\Flash\Session as FlashSession;
?>
<?php ?>
<head>
    <title>Sign Up Form</title>
    <link href='http://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo $this->url->get('public'); ?>/css/register/register.css"  />
    <link rel="stylesheet" href="<?php echo $this->url->get('public'); ?>/css/datepicker.css"  />

</head>
<body>

    <form method="post" action={{url('register/register')}}>

        <h1 style="margin-top: 17px;font-weight: bold;">Pre - Registrasi</h1>


        <div class="row" style="margin-bottom: 35px;">
            <div class="col-md-4">
                <a class="prehome" href={{url('index/index')}}><i class="fa fa-home" aria-hidden="true"></i> Home</a>
            </div>
            <div class="col-md-8">
                <a class="preregis" href={{url('register/dilo')}}><i class="ion ion-compose"></i> Pre-Registrasi untuk member DILo</a>
            </div>
        </div>

        {{ content() }}
        <fieldset>
            <legend><span class="number">1</span>Your basic info</legend>
            {{text_field("name", "id": "name", "placeholder": "name", "required": "required")}}
            {{text_field("user_name", "id": "name", "placeholder": "username", "required": "required")}}
            {{email_field("email", "id": "email", "placeholder": "email", "required": "required")}}
            {{password_field("password", "id": "password", "placeholder": "password", "required": "required")}}
            {{password_field("repassword", "id": "confirm_password", "placeholder": "retype password", "required": "required")}}
            {{text_field("phone", "id": "phone", "placeholder": "phone", "required": "required")}}
            <div id="birthdate">
                {{text_field("birth_date", "class": "form-control", "placeholder": "birth date", "required": "required")}}
            </div>
            {{text_field("domicile", "id": "domisili", "placeholder": "Kota Domisili", "required": "required")}}
            <div id="city">
                <label for="city">City :</label>
                {{select_static("city_id", cityList)}}
            </div>
            <div id="track" style="margin-bottom:30px;">
                <label for="track">Track :</label>
                {{select_static("track_id", trackList)}}
            </div>
            {#<div class="g-recaptcha" data-sitekey="6LfhvBYUAAAAAMTzotjfhChjCevXeVLE_25b6ePV"></div>#}
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

