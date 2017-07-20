{{ content() }}

<Head>
<style>
    .box-about {
		background: #efefef;
		padding: 50px;
		-webkit-box-shadow: 0 2px 2px 0 rgba(0,0,0,0.14), 0 3px 1px -2px rgba(0,0,0,0.12), 0 1px 5px 0 rgba(0,0,0,0.2);
		box-shadow: 0 2px 2px 0 rgba(0,0,0,0.14), 0 3px 1px -2px rgba(0,0,0,0.12), 0 1px 5px 0 rgba(0,0,0,0.2);
		height: 394px;
		margin-top:20px;
		border-radius:3px;
	}
	#intro {
	    background-attachment: fixed !important;
	}

	.buttontrack {
		height: 6rem !important;
		line-height: 2rem !important;
		color:#fff;
		background:#d9534f;
	}

</style>

	<title>BEKUP</title>
	<!-- CSS main Page
	================================================== -->
	<link rel="stylesheet" href={{url('public/css/base.css')}}>
	<link rel="stylesheet" href={{url('public/css/main.css')}}>
	<link rel="stylesheet" href={{url('public/css/vendor.css')}}>
	<link rel="stylesheet" href={{url('public/css/slider.css')}}>


</Head>

<Body id="top">

	<!-- header
   ================================================== -->
   <header>

   	<div class="row">

   		<div class="logo">
	         <a href="http://bekup.web.id">BEKUP 2.0</a>
	      </div>
	   	<nav id="main-nav-wrap">
				<ul class="main-navigation">
					<li class="current"><a href="http://bekup.web.id" title="">Home</a></li>
					<li><a class="smoothscroll"  href="#process" title="">About</a></li>
					<li><a class="smoothscroll"  href="#features" title="">Partners</a></li>
					<li><a href="http://bekup.web.id/faq" title="">FAQ</a></li>
					<!-- <li class="highlight with-sep" style="font-weight:900;"><a href="{{url('register/start')}}" title="">Registration</a></li> -->
                    <!--<li class="highlight with-sep" style="font-weight:900;"><a href="{{url('login')}}" title="">Log In</a></li>-->
					
					
					
					<?php
						if($this->session->get('auth')['name']==""){
							echo '<li class="highlight with-sep" style="font-weight:900;"><a href="http://bekup.web.id/login" title="">Log In</a></li>';
						}else{
							echo '<li class="highlight with-sep" style="font-weight:900;"><a href="http://bekup.web.id/talent/dashboard/index" title="">';
							echo $this->session->get('auth')['name'];
							echo '</a></li>';
						}
					?>
					
					
				</ul>
			</nav>

			<a class="menu-toggle" href="#"><span>Menu</span></a>

   	</div>

   </header>

    <!-- /header -->

	<!-- intro section
   ================================================== -->
   <section id="intro">
		<div class="intro-content">
			<div class="row">

				<div class="col-twelve">
					<img style="padding-top:65px;" class="img-responsive" src={{url('public/img/intro-bg1a4.png')}}></img>

					<h2 style="position: relative;top: 35px;"> Have a Team & Idea ? Register BEKUP-Start Now</h2>

					<div style="padding-top:28px;">
						<a href="{{url('register/start')}}">
						<button class="btn btn-danger" style="font-size:large"><span style="font-weight:900">BEKUP - Start</span> | Registration</button>
						</a>
					</div>
				</div>

			</div>
		</div>

   </section>
   <!-- /intro -->


   <!-- Process Section
   ================================================== -->
   <section id="process">

   	<div class="row section-intro">
   		<div class="col-twelve with-bottom-line">

   			<h1>About Bekup</h1>
   			<!-- <h1>What is BEKUP?</h1> -->

   			<p class="lead">BEKUP adalah ekosistem yang dibangun untuk mendukung pertumbuhan startup digital di Indonesia.</p>

   		</div>
   	</div>


   	<div class="row process-content">

   		<div class="col-md-4">

   			<div class="item box-about" data-item="1">

   				<h5>BEKUP Basic</h5>

   				<p>Program peningkatan kapasitas calon pendiri Startup di Track Teknis (advance programming) dan Kreatif (UX design).</p>
				<a href="{{url('register/basic')}}"><button>Click to Register</button></a>
   			</div>
   		</div>

   		<div class="col-md-4">

			<div class="item box-about" data-item="2">
	   			<h5>BEKUP Start</h5>

	   			<p>Program Pra-Akselerasi 15 minggu untuk tim Startup baru. Batch 2017 akan dimulai MInggu ke-3 Juli 2017.</p>
				<a href="{{url('register/start')}}"><button>Click to Register</button></a>
   			</div>
   		</div>



   		<div class="col-md-4">

   			<div class="item box-about" data-item="3">

   				<h5>BEKUP Journey</h5>

   				<p>Program pendampingan Startup tahap lanjut. Hanya untuk Startup yang produknya sudah teruji.<p>
				<a href="{{url('register/journey')}}"><button>Click to Register</button></a>
   			</div>
   		</div>

   			<!-- <div class="item" data-item="4"> -->

   				<!-- <h5>Talent Development</h5> -->

   				<!-- <p>Pelatihan intensif untuk meningkatkan pengetahuan dan keterampilan inti yang dibutuhkan oleh calon pendiri startup. Peserta di fase ini dapat memilih apakah akan mengikuti program talent development untuk jalur Bisnis / Management, Teknis atau Desain / Creative, sesuai dengan rencana peran yang akan diambil pada startup yang didirikan.</p> -->

   			<!-- </div> -->

   		 <!-- /right-side -->

   		<!-- <div class="image-part"></div>  			 -->

   	</div> <!-- /process-content -->

   </section> <!-- /process-->


   <!-- features Section
   ================================================== -->
	<section id="features">

		<div class="row section-intro">
   		<div class="col-twelve with-bottom-line">

   			<h1>Partners</h1>
   			<!-- <h1>Cooperate to advance</h1> -->

   			<!-- <p class="lead">Partners yang dikenal sebagai mitra, sepakat untuk bekerja sama untuk memajukan kepentingan bersama</p> -->

   		</div>
   	</div>

   	<div class="row features-content">

   		<div class="features-list block-1-3 block-s-1-2 block-tab-full group">

	      	<div class="bgrid feature">

	      		<!-- <span class="icon"><i class="icon-window"></i></span>             -->

	            <div class="service-content">

	            	 <h3 class="h05">Hosted By</h3>

		            <img src={{url("public/img/bekraf-small2.png")}}></img>

	         	</div>

				</div> <!-- /bgrid -->

				<div class="bgrid feature">

					<!-- <span class="icon"><i class="icon-eye"></i></span>                           -->

	            <div class="service-content">
	            	<h3 class="h05">Organized By</h3>

		            <img src={{url('public/img/mikti2.png')}}></img>


	            </div>

			   </div> <!-- /bgrid -->

			   <div class="bgrid feature">

			   	<!-- <span class="icon"><i class="icon-paint-brush"></i></span>		             -->

	            <div class="service-content">
	            	<h3 class="h05">Supported By</h3>

		            <img src={{url('public/img/dilotelkom2a.png')}}></img>


	            </div>

			   </div>
			   <!-- /bgrid -->



	      </div> <!-- features-list -->

   	</div> <!-- features-content -->

	</section> <!-- /features -->


	<!-- pricing
   ================================================== -->

   <section id="pricing">

   	<div class="row section-intro">
   		<div class="col-twelve with-bottom-line">

   			<h2 class="h01">Community Partners</h2>

   		</div>
   	</div>
	<div id="logos">
	  <ul>
		<li><img src={{url('public/img/adm-medan.png')}} width="auto" height="135" /></li>
		<li><img src={{url('public/img/su-makassar.png')}} width="auto" height="135" /></li>
		<li><img src={{url('public/img/startup-medan.png')}} width="auto" height="135" /></li>
		<li><img src={{url('public/img/rs-makassar.png')}} width="auto" height="135" /></li>
		<li><img src={{url('public/img/msu-malang.png')}} width="auto" height="135" /></li>
		<li><img src={{url('public/img/mocap.png')}} width="auto" height="135" /></li></li>
		<li><img src={{url('public/img/mcf-malang.png')}} width="auto" height="135" /></li>
		<li><img src={{url('public/img/iibf.png')}} width="auto" height="135" /></li>
	  </ul>
	</div>


</section>



   <!-- cta
   ================================================== -->



   <!-- footer
   ================================================== -->
   <footer>

   	<!-- <div class="footer-main"> -->

   		<!-- <div class="row">   -->

	      	<!-- <div class="col-four tab-full mob-full footer-info">             -->

	            <!-- <div class="footer-logo"></div> -->

	            <!-- <p> -->

		        	<!-- </p> -->

		      <!-- </div> <!-- /footer-info -->

	      	<!-- <div class="col-two tab-1-3 mob-1-2 site-links"> -->

	      		<!-- <h4>Site Links</h4> -->

	      		<!-- <ul> -->
	      			<!-- <li><a href="#">About Us</a></li> -->
						<!-- <li><a href="#">Blog</a></li> -->
						<!-- <li><a href="#">FAQ</a></li> -->
						<!-- <li><a href="#">Terms</a></li> -->
						<!-- <li><a href="#">Privacy Policy</a></li> -->
					<!-- </ul> -->

	      	<!-- </div> <!-- /site-links -->

	      	<!-- <div class="col-two tab-1-3 mob-1-2 social-links"> -->

	      		<!-- <h4>Social</h4> -->

	      		<!-- <ul> -->
	      			<!-- <li><a href="#">Twitter</a></li> -->
						<!-- <li><a href="#">Facebook</a></li> -->
						<!-- <li><a href="#">Dribbble</a></li> -->
						<!-- <li><a href="#">Google+</a></li> -->
						<!-- <li><a href="#">Skype</a></li> -->
					<!-- </ul> -->

	      	<!-- </div> <!-- /social -->

	      	<!-- <div class="col-four tab-1-3 mob-full footer-subscribe"> -->

	      		<!-- <h4>Subscribe</h4> -->

	      		<!-- <p>Keep yourself updated. Subscribe to our newsletter.</p> -->

	      		<!-- <div class="subscribe-form"> -->

	      			<!-- <form id="mc-form" class="group" novalidate="true"> -->

							<!-- <input type="email" value="" name="dEmail" class="email" id="mc-email" placeholder="type email &amp; hit enter" required="">  -->

			   			<!-- <input type="submit" name="subscribe" > -->

		   				<!-- <label for="mc-email" class="subscribe-message"></label> -->

						<!-- </form> -->

	      		<!-- </div>	      		 -->

	      	<!-- </div> <!-- /subscribe -->

	      <!-- </div> <!-- /row -->

   	<!-- </div> <!-- /footer-main -->


      <div class="footer-bottom">

      	<div class="row">

      		<div class="col-twelve">
	      		<div class="copyright">
		         	<span>© Copyright BEKUP 2017.</span>
		         	<span>Design by <a href="#">BEKUP</a></span>
		         </div>

		         <div id="go-top" style="display: block;">
		            <a class="smoothscroll" title="Back to Top" href="#top"><i class="icon ion-android-arrow-up"></i></a>
		         </div>
	      	</div>

      	</div> <!-- /footer-bottom -->

      </div>

   </footer>

   <div id="preloader">
    	<div id="loader"></div>
   </div>

   <!-- Java Script
   ================================================== -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src={{url('public/js/modernizr.js')}}></script>
	<script src={{url('public/js/jquery-1.11.3.min.js')}}></script>
	<script src={{url('public/js/jquery-migrate-1.2.1.min.js')}}></script>
	<script src={{url('public/js/plugins.js')}}></script>
	<script src={{url('public/js/main.js')}}></script>
	<script src={{url('public/js/slider.js')}}></script>


</Body>

</html>
