{{content()}}

<style>

.cardpronotif {
    float: right;
    background: #ff4e4e;
    color: #fff;
    padding: 5px;
    position: relative;
    bottom: 12px;
    z-index: 9;
    font-size: 11px;
    right: 15px;
    border-radius: 5px;
}

.regiscard {
	border-radius: 6px;
    box-shadow: 0 2px 2px rgba(204, 197, 185, 0.5);
    background-color: #FFFFFF;
    color: #252422;
    margin-bottom: 20px;
    position: relative;
    z-index: 1;
}

.regisbut {
	background: #80ce51;
    color: #fff;
    padding: 5px;
    border-radius: 4px;
    font-size: 11px;
    padding-left: 11px;
    padding-right: 11px;
}

.numbercard {
	font-weight: 900;
    font-size: 26px;
    background: #80ce51;
    padding: 15px;
    z-index: 9;
    color: #fff;
    position: relative;
    top: 11px;
    border-radius: 51%;
    padding-left: 25px;
    padding-right: 25px;
    -webkit-box-shadow: 2px 10px 17px -7px rgba(102,102,102,0.67);
    -moz-box-shadow: 2px 10px 17px -7px rgba(102,102,102,0.67);
    box-shadow: 2px 10px 17px -7px rgba(102,102,102,0.67);
}

.modal-header {
    border-bottom: none;
}

.arrowpro {
	position: relative;
    left: 7px;
    top: 29px;
}


</style>
<!-- Animation library for notifications   -->
<link href="{{url('public/css/animate.min.css')}}" rel="stylesheet"/>
<!--  Paper Dashboard core CSS    -->
<link href="{{url('public/css/dashboard.css')}}" rel="stylesheet"/>
<link rel="stylesheet" href="{{url('public/css/linkstyles.css')}}">

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Talent 
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
            <div class="col-lg-3 col-sm-6">
				<div class="col-md-10">
                <div class="card">
					<!-- <div class="cardpronotif">{{ profileCount }}</div> -->
                    <div class="content-card">
                        <div class="row">
							
								<div class="col-xs-5">
									<div class="icon-big icon-bekup text-center">
										<!-- <i class="fa fa-address-card" aria-hidden="true"></i> -->
										<div>1</div>
									</div>
								</div>
								<div class="col-xs-7">
									<div class="numbers">
										<p>Profil</p>
										Profile
									</div>
								</div>							
                        </div>
                        <div class="footer">
                            <hr />
                            <div class="stats">
                                <i class="fa fa-pencil-square"></i><a href="{{url('talent/profile/index')}}" class="info-a link link--kumya"> <span style="font-size:9px" data-letters="Update Profile">Update Profile</span></a>
                            </div>
                        </div>
                    </div>
                </div>
				</div>
				<div class="col-md-2 visible-lg">
					<img class="arrowpro" src="{{url('public/img/arrowempat.png')}}"></img>
				</div>
            </div>
            <div class="col-lg-3 col-sm-6">
				<div class="col-md-10">
                <div class="card">
                    <div class="content-card">
                        <div class="row">
                            <div class="col-xs-5">
                                <div class="icon-big icon-bekup text-center">
                                    <!-- <i class="fa fa-pencil-square-o" aria-hidden="true"></i> -->
									<div>2</div>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <div class="numbers">
                                    <p>Keterampilan</p>
                                    Skill
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr />
                            <div class="stats">
                                <i class="fa fa-plus"></i><a href="{{url('talent/skill/index')}}" class="info-a link link--kumya"><span style="font-size:9px" data-letters="Add New Skill">Add New Skill</span></a>
                            </div>
                        </div>
                    </div>
                </div>
				</div>
				<div class="col-md-2 visible-lg">
					<img class="arrowpro" src="{{url('public/img/arrowempat.png')}}"></img>
				</div>
            </div>
            <div class="col-lg-3 col-sm-6">
				<div class="col-md-10">
                <div class="card">
                    <div class="content-card">
                        <div class="row">
                            <div class="col-xs-5">
                                <div class="icon-big icon-bekup text-center">
                                    <!-- <i class="fa fa-users" aria-hidden="true"></i> -->
									<div>3</div>
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
                                <i class="fa fa-search"></i><a href="{{url('team/dashboard/index')}}" class="info-a link link--kumya"><span style="font-size:9px" data-letters="View Team Profile">View Team Profile</span></a>
                            </div>
                        </div>
                    </div>
                </div>
				</div>
				<div class="col-md-2 visible-lg">
					<img class="arrowpro" src="{{url('public/img/arrowempat.png')}}"></img>
				</div>
				
            </div>
			 <div class="col-lg-3 col-sm-6">
				<div class="col-md-10">
                <div class="card">
                    <div class="content-card">
                        <div class="row">
                            <div class="col-xs-5">
                                <div class="icon-big icon-bekup text-center">
                                    <!-- <i class="fa fa-lightbulb-o" aria-hidden="true"></i> -->
									<div>4</div>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <div class="numbers">
                                    <p>Ide</p>
                                    Idea
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr />
                            <div class="stats">
                                <i class="fa fa-plus"></i><a href="{{url('team/idea/index')}}" class="info-a link link--kumya"><span style="font-size:9px" data-letters="Add New Idea">Add New Idea</span></a>
                            </div>
                        </div>
                    </div>
                </div>
				</div>
            </div>
            <div class="col-lg-3 col-sm-6">
                
            </div>
			
        </div>
		<div class="row" style="height:70px;">
		

			<h3>
				Programme 
				<small>registration</small>
			</h3>
         
		</div>
						
		<div class="row">
			<div class="col-lg-4 col-sm-6">
				<!-- <h4 style="text-align: center";><span class="numbercard">1</span></h4> -->
                <div class="regiscard">
                    <div class="content-card">
                        <div class="row">
                            
                            <div class="col-xs-12">
                                <div class="numbers">
                                    <p>Class</p>
                                    BEKUP - <span style="font-weight:900;">Basic</span>
                                </div>
                            </div>
                        </div>
                        <div>
							<a href="#" data-toggle="modal" data-target="#myModal"><h5 style="text-align: center;margin-top: 29px;"><span class="regisbut">Apply</span></h5></a>
						</div>
                    </div>
                </div>
            </div>
			<div class="col-lg-4 col-sm-6">
				<!-- <h4 style="text-align: center";><span class="numbercard">2</span></h4> -->
                <div class="regiscard">
                    <div class="content-card">
                        <div class="row">
                            
                            <div class="col-xs-12">
                                <div class="numbers">
                                    <p>Programme</p>
                                    BEKUP - <span style="font-weight:900;">Start</span>
                                </div>
                            </div>
                        </div>
                        <div>
							<a href={{url('team/programme/index')}}><h5 style="text-align: center;margin-top: 29px;"><span class="regisbut">Apply</span></h5></a>
						</div>
                    </div>
                </div>
            </div>
			<div class="col-lg-4 col-sm-6">
				<!-- <h4 style="text-align: center";><span class="numbercard">3</span></h4> -->
                <div class="regiscard">
                    <div class="content-card">
                        <div class="row">
                            
                            <div class="col-xs-12">
                                <div class="numbers">
                                    <p>Journey</p>
                                    BEKUP - <span style="font-weight:900;">Journey</span>
                                </div>
                            </div>
                        </div>
                        <div>
							<a href="#" data-toggle="modal" data-target="#myModal"><h5 style="text-align: center;margin-top: 29px;"><span class="regisbut">Apply</span></h5></a>
						</div>
                    </div>
                </div>
            </div>
			
		</div>
    </div>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
          <p style="text-align:center;">Pendaftaran program ini akan segera di buka, tunggu informasi lebih lanjut</p>
        </div>
        
      </div>
      
    </div>
  </div>
	
</section>
<!-- /.content -->

<!-- jQuery 2.2.0 -->
<script src="https://code.jquery.com/jquery-2.2.0.min.js"
        integrity="sha256-ihAoc6M/JPfrIiIeayPE9xjin4UWjsx2mjW/rtmxLM4="
crossorigin="anonymous"></script>
<script>
    $('#dashboardMenu').addClass('active');
    $('#dashboardMenu').css('color', '#fff');
</script>

