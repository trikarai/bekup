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
	<button type="button" style="border-radius: 0 !important;position: fixed;z-index: 99;" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"><i class="fa fa-exclamation" aria-hidden="true"></i>Info : Registration Process</button><br/>

	
      <form style="margin-top:45px;" method="POST" action={{url('register/signupBasic')}} >
      
        <h1 style="margin-top: 17px;font-weight: bold;">Bekup Basic Registration</h1>
		
		
		<div class="row" style="margin-bottom: 35px;">
			<div class="row">
				<a class="prehome" href="<?php echo $this->url->get('index');?>"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
			</div>
			<div class="row">
				<a class="preregis" href="<?php echo $this->url->get('register/basicDiloMember');?>"><i class="ion ion-compose"></i>  Click Here if you have registered as DILo Member</a>				
			</div>
			<div style="text-align: center;margin-left: 45px;margin-right: 45px;margin-top: 15px;">
				* Apabila anda berhasil registrasi di form ini, maka anda secara otomatis terdaftar menjadi member DILo
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
         		
		
		<div id="track" style="margin-bottom:30px;">
            <label for="track">Track :</label>
            {{select_static("track_id", "class": "form-control", trackList)}}
        </div>
			
				
		<!-- <div class="g-recaptcha" data-sitekey="6LfhvBYUAAAAAMTzotjfhChjCevXeVLE_25b6ePV"></div> -->
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

<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">	
	
	<!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">PROSEDUR REGISTRASI
CALON PESERTA PROGRAM BEKUP 2017</h4>
        </div>
        <div class="modal-body">
          
          <h4>1. Calon Peserta Baru (Belum terdaftar di Bekup 2017 dan Dilo)</h4>
          	<ul>
            	<li>Calon peserta melakukan registrasi di website Bekup (<a href="bekup.web.id">bekup.web.id</a>). Terdapat tiga jalur yang dapat dipilih oleh peserta, yaitu Bekup Basic, Bekup Start, dan Bekup Journey.</li>
                <li>Apabila peserta telah mendaftar di salah satu program, maka untuk mengikuti program lain tidak perlu melakukan registrasi ulang.</li>
				<li>Setelah pengisian data registrasi, calon peserta melakukan aktivasi akun dengan cara mengklik email aktivasi yang dikirim ke email calon peserta.</li>
				<li>Apabila email aktivasi tidak terdapat di Inbox, mohon untuk memeriksa folder <text style="color:red;">Spam/Junk/Promotions</text>, kemudian lakukan proses aktivasi akun.</li>
				<li>Setelah proses aktivasi berhasil, maka otomatis calon peserta telah terdaftar sebagai peserta Bekup 2017 dan member Dilo.</li>
				<li>Akun yang telah dibuat dapat digunakan untuk login di website Bekup (<a href="bekup.web.id">bekup.web.id</a>) serta website Dilo (<a href="dilo.id">dilo.id</a>).</li>
				<li>Selanjutnya, peserta login ke web Bekup dengan username dan password yang dimasukkan ketika proses registrasi, kemudian mengisi Profil Peserta.</li>
				<li>Apabila peserta merasa proses registrasi telah berhasil dilakukan namun tidak menerima email aktivasi, mohon untuk mengirimkan email ke <a href="mailto:support@bekup.web.id">support@bekup.web.id</a>, sambil mencantumkan alamat email yang digunakan untuk mendaftar ke program Bekup. Aktivasi akan dibantu secara backend melalui tim support teknis.</li>
            </ul>
            
		<h4>2. Calon Peserta Lama (Belum terdaftar di Bekup 2017 namun telah terdaftar sebagai member Dilo)</h4>
          <ul>
			<li>Calon peserta yang telah terdaftar sebagai member Dilo, namun belum mendaftar di program Bekup 2017, dapat melakukan pendaftaran di program Bekup dengan cara mengakses URL <a href="http://bekup.web.id/register/startDiloMember">http://bekup.web.id/register/startDiloMember</a>, atau dengan cara mengklik link “Clik here if you have registered as Dilo Member” di halaman registrasi program Bekup.</li>
			<li>Selanjutnya, calon peserta memasukkan data-data yang dibutuhkan untuk registrasi. Khusus data username dan password, diisi dengan username dan password yang sama persis dengan username dan password di website Dilo.</li>
			<li>Apabila calon peserta lupa dengan username dan password akun website Dilo, dapat melakukan recovery username dan password dengan cara mengakses website Dilo (dilo.id), kemudian masuk ke menu Login.</li>
			<li>Setelah proses registrasi selesai, maka calon peserta telah terdaftar sebagai peserta program Bekup 2017.</li>
			<li>Untuk dapat login ke website Bekup, peserta memasukkan username dan password yang sama dengan username dan password website Dilo.</li>
			<li>Pastikan akun di website Dilo telah aktif (dapat melakukan login di website Dilo), agar dapat login ke website Bekup.</li>
			<li>Apabila akun Dilo belum diaktivasi dan link aktivasi via email telah expired, mohon untuk mengirimkan email ke <a href="mailto:support@bekup.web.id">support@bekup.web.id</a>	 beserta email yang digunakan ketika mendaftar sebagai member Dilo, untuk dibantu diaktivasi via backend oleh tim teknis.</li>
			<li>Selanjutnya, apabila proses registrasi telah selesai dilakukan, peserta login ke web Bekup untuk mengisi data profil pribadi.</li>
		</ul>
					  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
	
    </body>
</html>

