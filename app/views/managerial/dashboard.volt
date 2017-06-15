<?php use Phalcon\Tag; ?>

<!-- Animation library for notifications   -->
<link href="<?php echo $this->url->get('public'); ?>/css/animate.min.css" rel="stylesheet"/>
<!--  Paper Dashboard core CSS    -->
<link href="<?php echo $this->url->get('public'); ?>/css/dashboard.css" rel="stylesheet"/>
<link rel="stylesheet" href="<?php echo $this->url->get('public'); ?>/css/linkstyles.css">

{{ content() }}
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Director
        <small>dashboard</small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> dashboard</a></li>
        <li></li>
      </ol>
             
        
    </section>

    <!-- Main content -->
    <section class="content">
		<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-sm-6" <?php 
                        if($rolebekup!='Direktur'){
                            echo 'style="display:none;"';
                        } else{
                            echo '';
                        }   
                        ?>>
                        <div class="card">
                            <div class="content-card">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-bekup text-center">
                                            <i class="fa fa-building-o" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>Kota</p>
                                            City
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="fa fa-plus "></i><a href="<?php echo $this->url->get('city/new'); ?>" class="info-a link link--kumya"><span data-letters="Add New City">Add New City</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6" <?php 
                        if($rolebekup!='Direktur'){
                            echo 'style="display:none;"';
                        } else{
                            echo '';
                        }?> >
                        <div class="card">
                            <div class="content-card">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-bekup text-center">
                                            <i class="fa fa-sitemap" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>Track</p>
                                            Track
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="fa fa-plus"></i><a href="<?php echo $this->url->get('track/new');?>" class="info-a link link--kumya"> <span data-letters="Add New Track">Add New Track</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6" <?php 
                        if($rolebekup!='Direktur'){
                            echo 'style="display:none;"';
                        } else{
                            echo '';
                        }?>>
                        <div class="card">
                            <div class="content-card">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-bekup text-center">
                                            <i class="fa fa-user-circle" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>Personil</p>
                                            Personnel
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="fa fa-plus"></i><a href="<?php echo $this->url->get('personnel/new');?>" class="info-a link link--kumya"> <span data-letters="Add New Personnel">Add New Personnel</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <!-- <div class="card"> -->
                            <!-- <div class="content-card"> -->
                                <!-- <div class="row"> -->
                                    <!-- <div class="col-xs-5"> -->
                                        <!-- <div class="icon-big icon-bekup text-center"> -->
                                            <!-- <i class="ti-twitter-alt"></i> -->
                                        <!-- </div> -->
                                    <!-- </div> -->
                                    <!-- <div class="col-xs-7"> -->
                                        <!-- <div class="numbers"> -->
                                            <!-- <p>Track</p> -->
                                            <!-- Track -->
                                        <!-- </div> -->
                                    <!-- </div> -->
                                <!-- </div> -->
                                <!-- <div class="footer"> -->
                                    <!-- <hr /> -->
                                    <!-- <div class="stats"> -->
                                        <!-- <i class="ti-reload"></i> Updated now -->
                                    <!-- </div> -->
                                <!-- </div> -->
                            <!-- </div> -->
                        <!-- </div> -->
                    </div>
                </div>
				<div class="row">
                    <div class="col-lg-3 col-sm-6" <?php 
                        if($rolebekup!='Direktur'){
                            echo 'style="display:none;"';
                        } else{
                            echo '';
                        }?>>
                        <div class="card">
                            <div class="content-card">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-bekup text-center">
                                            <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>Kemampuan</p>
                                            Skill
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="fa fa-plus"></i><a href="<?php echo $this->url->get('skill/new'); ?>" class="info-a link link--kumya"><span data-letters="Add New Skill"> Add New Skill</span> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6"<?php 
                        if($rolebekup!='Koordinator Track'){
                            echo 'style="display:none;"';
                        } else{
                            echo '';
                        }?>>
                        <div class="card">
                            <div class="content-card">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-bekup text-center">
                                            <i class="fa fa-book" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>Kursus</p>
                                            Course
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="fa fa-plus"></i><a href="<?php echo $this->url->get('course/new');?>" class="info-a link link--kumya"><span data-letters="Add New Course"> Add New Course</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6" <?php 
                        if($rolebekup!='Koordinator Wilayah'){
                            echo 'style="display:none;"';
                        } else{
                            echo '';
                        }?>>
                        <div class="card"> 
                             <div class="content-card"> 
                                 <div class="row"> 
                                     <div class="col-xs-5"> 
                                         <div class="icon-big icon-bekup text-center"> 
                                             <i class="fa fa-users" aria-hidden="true"></i> 
                                         </div> 
                                     </div> 
                                     <div class="col-xs-7"> 
                                         <div class="numbers"> 
                                             <p>Tim</p> 
                                             Team
                                         </div> 
                                     </div> 
                                 </div> 
                                 <div class="footer"> 
                                     <hr /> 
                                     <div class="stats"> 
                                         <i class="fa fa-plus"></i><a href="<?php echo $this->url->get('teamclass/new');?>" class="info-a link link--kumya"><span data-letters="Add Team Class">Add Team Class</span></a> 
                                     </div> 
                                 </div> 
                             </div> 
                         </div> 
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <!-- <div class="card"> -->
                            <!-- <div class="content-card"> -->
                                <!-- <div class="row"> -->
                                    <!-- <div class="col-xs-5"> -->
                                        <!-- <div class="icon-big icon-bekup text-center"> -->
                                            <!-- <i class="ti-twitter-alt"></i> -->
                                        <!-- </div> -->
                                    <!-- </div> -->
                                    <!-- <div class="col-xs-7"> -->
                                        <!-- <div class="numbers"> -->
                                            <!-- <p>Track</p> -->
                                            <!-- Track -->
                                        <!-- </div> -->
                                    <!-- </div> -->
                                <!-- </div> -->
                                <!-- <div class="footer"> -->
                                    <!-- <hr /> -->
                                    <!-- <div class="stats"> -->
                                        <!-- <i class="ti-reload"></i> Updated now -->
                                    <!-- </div> -->
                                <!-- </div> -->
                            <!-- </div> -->
                        <!-- </div> -->
                    </div>
                </div>
			</div>
      

    </section>
    <!-- /.content -->
	
<!-- jQuery 2.2.0 -->
<script src="<?php echo $this->url->get('public'); ?>/js/jQuery-2.2.0.min.js"></script>


	
<script>
	$('#dashboardMenu').addClass('active');
	$('#dashboardMenu').css('color','#fff');
</script>

 