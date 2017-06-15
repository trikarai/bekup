<!DOCTYPE html>

<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo $this->url->get('public'); ?>/css/Admin-m.css">
	<link rel="stylesheet" href="<?php echo $this->url->get('public'); ?>/css/custommanager.css">
	<link rel="stylesheet" href="<?php echo $this->url->get('public'); ?>/css/_all-skins-m.css">	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<style>
	.modal-backdrop {
		z-index:999 !important;	
	}
</style>

<html>

<script type="text/javascript">
		document.write("<Bo"+"dy");
</script> class="hold-transition skin-blue sidebar-mini">

<script>
    (function () {
      if (Boolean(sessionStorage.getItem('sidebar-toggle-collapsed'))) {
        var body = document.getElementsByTagName('body')[0];
        body.className = body.className + ' sidebar-collapse';
      }
    })();
</script>

<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="#" class="logo" style="text-decoration: none;">
     
      <span class="logo-mini">B</span>
      
      <span class="logo-lg">BEKUP</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
         
          <li>
            <a style="cursor:pointer;" data-toggle="modal" data-target=".logoutadminmodal"><i class="fa fa-sign-out"></i></a>
			<!-- add data-toggle="control-sidebar" if u want to add left sidebar  -->
			<!-- Modal  -->
			  <div class="modal fade logoutadminmodal" tabindex="-1" role="dialog" aria-hidden="true">
				  <div class="modal-dialog modal-sm">
					<div class="modal-content">
					  <div class="modal-header"><h4>Logout <i class="fa fa-lock"></i></h4></div>
					  <div class="modal-body"><i class="fa fa-question-circle">&nbsp;</i> Are you sure you want to log-off?</div>
					  <div class="modal-footer"><a href="<?php echo $this->url->get('manager/logout');?>" class="btn tombollogout btn-block">Logout</a></div>
					</div>
				  </div>
			  </div>
			<!-- modal -->
          </li>
		  <li>
		   
		  </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/dart/public/img/profile-fill-circle-160.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->get('auth')['name']; ?></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">Main Navigation</li>
        <!-- Optionally, you can add icons to the links -->
        <li id="dashboardMenu" class=""><a href="<?php echo $this->url->get('managerial/dashboard');?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li id="cityMenu" class="treeview" <?php if($this->session->get('auth')['role']!='Direktur'){echo 'style="display:none;"';}else{echo '';}?>>
          <a href="<?php echo $this->url->get('city/index');?>"><i class="fa fa-building-o"></i> <span>City</span> <i class=""></i></a>         
        </li>
		
        <li id="trackMenu" class="treeview" <?php if($this->session->get('auth')['role']!='Direktur'){echo 'style="display:none;"';}else{echo '';}?>>
          <a href="<?php echo $this->url->get('track/index');?>"><i class="fa fa-sitemap"></i> <span>Track</span> <i class=""></i></a>
          <!-- <ul class="treeview-menu"> -->
            <!-- <li><a id="" href="">sub menu 2</a></li> -->
            <!-- <li><a id="" href="/../dart/User">sub menu 2</a></li> -->
          <!-- </ul> -->
        </li>
		
		<li id="personelMenu" class="treeview" <?php if($this->session->get('auth')['role']!='Direktur'){echo 'style="display:none;"';}else{echo '';}?>>
          <a href="<?php echo $this->url->get('personnel/index');?>"><i class="fa fa-user-circle"></i> <span>Personel</span> <i class=""></i></a>
          <!-- <ul class="treeview-menu"> -->
            <!-- <li><a id="" href="">sub menu 2</a></li> -->
            <!-- <li><a id="" href="/../dart/User">sub menu 2</a></li> -->
          <!-- </ul> -->
        </li>
		<li id="skillMenu" class="treeview" <?php if($this->session->get('auth')['role']!='Direktur'){echo 'style="display:none;"';}else{echo '';}?>>
          <a href="<?php echo $this->url->get('skill/index');?>"><i class="fa fa-graduation-cap"></i> <span>Skill</span> <i class=""></i></a>          
        </li>
		<li id="courseMenu" class="treeview" <?php if($this->session->get('auth')['role']!='Koordinator Track'){echo 'style="display:none;"';}else{echo '';}?>>
          <a href="<?php echo $this->url->get('course/index');?>"><i class="fa fa-book"></i> <span>Course</span> <i class=""></i></a>          
        </li>
            <li id="teamclassMenu" class="treeview" <?php if($this->session->get('auth')['role']!='Koordinator Wilayah'){echo 'style="display:none;"';}else{echo '';}?>>
          <a href="<?php echo $this->url->get('teamclass/index');?>"><i class="fa fa-book"></i> <span>Team Class</span> <i class=""></i></a>          
        </li>
		
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    {{ flash.output() }}
    {{ content() }}
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <!-- <footer class="main-footer"> -->
    <!-- <!-- To the right --> 
    <!-- <div class="pull-right hidden-xs"> -->
      <!-- <small style="color:#c5c5c5;">BEKUP Version 0.2</small> -->
    <!-- </div> -->
    <!-- <!-- Default to the left --> 
    <!-- Copyright &copy; 2017 <b style="color:#80ce51;">BEKUP</b> -->
  <!-- </footer> -->

  
  
</div>
<!-- ./wrapper -->



<script src="<?php echo $this->url->get('public'); ?>/js/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo $this->url->get('public'); ?>/js/fastclick.js"></script>
<!-- Admin App -->
<script src="<?php echo $this->url->get('public'); ?>/js/app.min.js"></script>

<script>
    // Click handler can be added latter, after jQuery is loaded...
    $('.sidebar-toggle').click(function(event) {
      event.preventDefault();
      if (Boolean(sessionStorage.getItem('sidebar-toggle-collapsed'))) {
        sessionStorage.setItem('sidebar-toggle-collapsed', '');
      } else {
        sessionStorage.setItem('sidebar-toggle-collapsed', '1');
      }
    });
</script>

</body>
</html>
