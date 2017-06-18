{{ content() }}

<Head>

	<title>BEKUP</title>
	<!-- CSS main Page
	================================================== -->
	<link rel="stylesheet" href="<?php echo $this->url->get('public'); ?>/css/base.css">  
	<link rel="stylesheet" href="<?php echo $this->url->get('public'); ?>/css/main.css">
	<link rel="stylesheet" href="<?php echo $this->url->get('public'); ?>/css/vendor.css">
	<link rel="stylesheet" href="<?php echo $this->url->get('public'); ?>/css/slider.css">
	
	
</Head>

<Body id="top">

	<!-- header 
   ================================================== -->
   <header>

   	<div class="row">

   		<div class="logo">
	         <a href="#">BEKUP 2.0</a>
	      </div>

	   	<nav id="main-nav-wrap">
				<ul class="main-navigation">
					<li class="current"><a class="smoothscroll"  href="#intro" title="">Home</a></li>
					<li><a class="smoothscroll"  href="#process" title="">About Us</a></li>
					<li><a class="smoothscroll"  href="#features" title="">Partners</a></li>
					<li><a class="smoothscroll"  href="#faq" title="">FAQ</a></li>					
					<li class="highlight with-sep" style="font-weight:900;"><a href="<?php echo $this->url->get(''); ?>register" title="">Pre-Registration</a></li>
                    <li class="highlight with-sep" style="font-weight:900;"><a href="<?php echo $this->url->get(''); ?>login" title="">Log In</a></li>					
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
					<img class="img-responsive" src="<?php echo $this->url->get('public'); ?>/img/intro-bg1.png"></img>				
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

   			<h5>About Us</h5>
   			<h1>What is BEKUP?</h1>

   			<p class="lead">BEKUP adalah ekosistem yang dibangun untuk mendukung pertumbuhan startup digital di Indonesia. BEKUP diinisiasi dan dikelola oleh BEKRAF RI (Badan Ekonomi Kreatif Republik Indonesia) bekerja sama dengan PT. Telekomunikasi Indonesia, Tbk dan MIKTI (Masyarakat Industri Kreatif TIK Indonesia).</br></br>
			
			BEKRAF mendukung startup melalui 3 kelompok program utama, yaitu:</p>

   		</div>   		
   	</div>

   	<div class="row process-content">

   		<div class="col-md-4">

   			<div class="item" data-item="1">

   				<h5>BEKUP Basic</h5>

   				<p>BEKUP Basic terdiri atas track-track yang dapat dipilih peserta sesuai peran yang akan diambilnya di startup yang akan didirikan, antara lain adalah Track Technical Android dan Track Technical PHP (untuk Calon Co-Founder Teknis) serta Track Creative / Design (untuk Calon Co-Founder Kreatif). Track untuk Calon Co-Founder Bisnis tidak tersedia di BEKUP Basic.</p>
   			</div>	
   		</div>

   		<div class="col-md-4">
			
			<div class="item" data-item="2">
	   			<h5>BEKUP Start</h5>

	   			<p>Ditujukan bagi Tim Startup (bukan perorangan) yang sudah memiliki ide awal. Tim setidaknya terdiri atas 1 orang Co-Founder Teknis dan 1 orang Co-Founder Bisnis atau Kreatif. Program BEKUP Start terdiri atas Ideation Workshop, Talent Development, Founder Preparation dan Pre-Incubation. Seluruh Program dilaksanakan selama kurang lebih 10 Minggu.
</p>
   			</div>		
   		</div>
   				
   		
   		
   		<div class="col-md-4">
   				
   			<div class="item" data-item="3">

   				<h5>BEKUP Journey</h5>

   				<p>Ditujukan bagi Startup yang sudah meluncurkan produknya ke pasar dan menunjukkan respon positif dari penggunanya. BEKUP Journey mendampingi Startup melalui kerjasama dengan Incubator, Accelerator dan Investor pihak ketiga.<p>
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

   			<h5>Partners</h5>
   			<h1>Cooperate to advance</h1>

   			<p class="lead">Partners yang dikenal sebagai mitra, sepakat untuk bekerja sama untuk memajukan kepentingan bersama</p>

   		</div>   		
   	</div>

   	<div class="row features-content">

   		<div class="features-list block-1-3 block-s-1-2 block-tab-full group">

	      	<div class="bgrid feature">	

	      		<!-- <span class="icon"><i class="icon-window"></i></span>             -->

	            <div class="service-content">	

	            	 <h3 class="h05">Hosted By</h3>

		            <img src="<?php echo $this->url->get('public'); ?>/img/bekraf-small2.png"></img>
	         		
	         	</div> 	         	 

				</div> <!-- /bgrid -->

				<div class="bgrid feature">	

					<!-- <span class="icon"><i class="icon-eye"></i></span>                           -->

	            <div class="service-content">	
	            	<h3 class="h05">Organized By</h3>  

		            <img src="<?php echo $this->url->get('public'); ?>/img/mikti2.png"></img>

	         		
	            </div>	                          

			   </div> <!-- /bgrid -->

			   <div class="bgrid feature">

			   	<!-- <span class="icon"><i class="icon-paint-brush"></i></span>		             -->

	            <div class="service-content">
	            	<h3 class="h05">Supported By</h3>

		            <img src="<?php echo $this->url->get('public'); ?>/img/dilotelkom2a.png"></img>

	        			
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
		<li><img src="<?php echo $this->url->get('public'); ?>/img/adm-medan.png" width="auto" height="135" /></li>
		<li><img src="<?php echo $this->url->get('public'); ?>/img/su-makassar.png" width="auto" height="135" /></li>
		<li><img src="<?php echo $this->url->get('public'); ?>/img/startup-medan.png" width="auto" height="135" /></li>
		<li><img src="<?php echo $this->url->get('public'); ?>/img/rs-makassar.png" width="auto" height="135" /></li>
		<li><img src="<?php echo $this->url->get('public'); ?>/img/msu-malang.png" width="auto" height="135" /></li>
		<li><img src="<?php echo $this->url->get('public'); ?>/img/mocap.png" width="auto" height="135" /></li></li>
		<li><img src="<?php echo $this->url->get('public'); ?>/img/mcf-malang.png" width="auto" height="135" /></li>
		<li><img src="<?php echo $this->url->get('public'); ?>/img/iibf.png" width="auto" height="135" /></li>	
	  </ul>
	</div>
   	

</section>  


   <!-- Testimonials Section
   ================================================== -->
   <!-- <section id="testimonials"> -->


   <!-- </section> <!-- /testimonials --> 


   <!-- faq
   ================================================== -->
   <section id="faq">

   	<div class="row section-intro">
   		<div class="col-twelve with-bottom-line">

   			<h5>Faq</h5>
   			<h1>Questions and Answers.</h1>

   			<p class="lead">format daftar informasi seputar BEKUP berisi pertanyaan yang sering diajukan, dengan jawaban yang telah disediakan.</p>

   		</div>   		
   	</div>

   	<div class="row faq-content">

   		<div class="q-and-a block-1-2 block-tab-full group">

   			<div class="bgrid">

   				<h3>Apa keuntungan mengikuti BEKUP?</h3>

   				<p>BEKUP akan membantu para calon startup untuk dapat jauh lebih siap membangun startup dan menuju ke level selanjutnya baik mengikuti inkubasi, akselersi maupun menjadi startup yang siap untuk diinvestasi.</p>

   			</div>

   			<div class="bgrid">

   				<h3>Apakah mengikuti BEKUP berbayar?</h3>

   				<p>Semua kegiatan BEKUP tidak dikenakan biaya. Terbuka bagi siapapun yang ingin mendaftar dan memenuhi kriteria.</p>

   			</div>

   			<div class="bgrid">

   				<h3>Apakah ada seleksi terlebih dahulu sebelum mengikuti BEKUP?</h3>

   				<p>Ada. Tidak diterapkan mekanisme first come first served pada proses pendaftaran program. Melainkan, kami akan melakukan kualifikasi berdasarkan form pendaftaran yang diisi oleh calon peserta. Proses seleksi dan kualifikasi tidak hanya diterapkan di awal, namun juga akan diterapkan ketika peserta akan masuk ke tahap berikutnya (workshop berikutnya, talent development berikutnya maupun masuk ke tahap founder preparation dan pre-incubation).</p>

   			</div>

   			<div class="bgrid">

   				<h3>Maksud dan tujuan dari BEKUP?</h3>

   				<p>Startup bidang Digital merupakan salah satu harapan Indonesia di masa yang akan datang, khususnya karena didukung oleh aspek inovasi yang tinggi sehingga memiliki peluang skalabilitas yang tinggi pula. Namun di lain sisi jumlah startup di Indonesia masih sedikit, dan tingkat keberhasilannya masih relatif lebih rendah dibandingkan negara lain yang memiliki kultur inovasi lebih maju. Dengan demikian diperlukan suatu upaya yang terstruktur dan sistematis untuk meningkatkan jumlah startup dan di saat yang bersamaan mengurangi tingkat kegagalannya. BEKUP dijalankan untuk tujuan tersebut.</p>

   			</div>


   		</div> <!-- /q-and-a --> 
   		
   	</div> <!-- /faq-content --> 

   	


   </section> <!-- /faq --> 

   <!-- cta
   ================================================== -->
   


   <!-- footer
   ================================================== -->
   <footer>

   	


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
	<script src="<?php echo $this->url->get('public'); ?>/js/modernizr.js"></script>
	<script src="<?php echo $this->url->get('public'); ?>/js/jquery-1.11.3.min.js"></script>
	<script src="<?php echo $this->url->get('public'); ?>/js/jquery-migrate-1.2.1.min.js"></script>
	<script src="<?php echo $this->url->get('public'); ?>/js/plugins.js"></script>
	<script src="<?php echo $this->url->get('public'); ?>/js/main.js"></script>
	<script src="<?php echo $this->url->get('public'); ?>/js/slider.js"></script>
	

</Body>

</html>
