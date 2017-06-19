{{ content() }}
<?php 
use Phalcon\Tag as Tag;
use Phalcon\Flash\Direct as FlashDirect;
use Phalcon\Flash\Session as FlashSession;
?>

<h2>Bekup Start Registration for existing DILo member</h2>
<div class="col-md-4">
    <form method="POST" action={{url('register/signupstartdilomember')}} >
        {{text_field("name", "id": "name", "class": "form-control", "placeholder": "name", "required": "required")}}
        {{text_field("user_name", "id": "name", "class": "form-control", "placeholder": "username", "required": "required")}}
        {{password_field("password", "id": "password", "class": "form-control", "placeholder": "password", "required": "required")}}
        {{text_field("phone", "id": "phone", "class": "form-control", "placeholder": "phone", "required": "required")}}
        {{text_area("motivation", "id": "motivation", "class": "form-control", "placeholder": "motivation", "required": "required")}}
        <div id="gender">
            <label for="gender">Gender :</label>
            {{select_static("gender", "class": "form-control", genderList)}}
        </div>
        <div id="birthdate">
            {{text_field("birth_date", "class": "form-control", "placeholder": "birth date", "required": "required")}}
        </div>
        {{text_field("domicile", "id": "domisili", "class": "form-control", "placeholder": "Kota Domisili", "required": "required")}}
        <div id="city">
            <label for="city">City :</label>
            {{select_static("city_id", "class": "form-control", cityList)}}
        </div>
        <div class="g-recaptcha" data-sitekey="6LfhvBYUAAAAAMTzotjfhChjCevXeVLE_25b6ePV"></div>
        <input style="margin-top:20px" type='submit' value='Sign in'/>
    </form>
</div>

<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="<?php echo $this->url->get('public'); ?>/js/bootstrap-datepicker.js"></script>
<script src="<?php echo $this->url->get('public'); ?>/js/birthdate.js"></script>