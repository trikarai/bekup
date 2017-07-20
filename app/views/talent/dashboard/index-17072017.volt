{{content()}}

<style>
.cardpronotif {
    float: right;
    background: #ff4e4e;
    color: #fff;
    padding: 5px;
    position: relative;
    bottom: 13px;
    z-index: 9;
    font-size: 11px;
    right: 15px;
	border-radius: 5px;
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
                <div class="card">
					<!-- <div class="cardpronotif">{{ profileCount }}</span> </div> -->
                    <div class="content-card">
                        <div class="row">
                            <div class="col-xs-5">
                                <div class="icon-big icon-bekup text-center">
                                    <i class="fa fa-address-card" aria-hidden="true"></i>
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
                                <i class="fa fa-pencil-square"></i><a href="{{url('talent/profile/index')}}" class="info-a link link--kumya"> <span style="font-size:initial" data-letters="Update Profile">Update Profile</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="content-card">
                        <div class="row">
                            <div class="col-xs-5">
                                <div class="icon-big icon-bekup text-center">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <div class="numbers">
                                    <p>Skill</p>
                                    Skill
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr />
                            <div class="stats">
                                <i class="fa fa-plus"></i><a href="{{url('talent/skill/index')}}" class="info-a link link--kumya"><span style="font-size:initial" data-letters="Add New Skill">Add New Skill</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
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
                                <i class="fa fa-search"></i><a href="{{url('team/dashboard/index')}}" class="info-a link link--kumya"><span style="font-size:initial" data-letters="View Team Profile">View Team Profile</span></a>
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
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="content-card">
                        <div class="row">
                            <div class="col-xs-5">
                                <div class="icon-big icon-bekup text-center">
                                    <i class="fa fa-file-powerpoint-o" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <div class="numbers">
                                    <p>Program</p>
                                    Programme
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr />
                            <div class="stats">
                                <i class="fa fa-search"></i><a href="{{url('team/programme/index')}}" class="info-a link link--kumya"> <span style="font-size:initial" data-letters="View Programme">View Programme</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="content-card">
                        <div class="row">
                            <div class="col-xs-5">
                                <div class="icon-big icon-bekup text-center">
                                    <i class="fa fa-lightbulb-o" aria-hidden="true"></i>
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
                                <i class="fa fa-plus"></i><a href="{{url('talent/skill/index')}}" class="info-a link link--kumya"><span style="font-size:initial" data-letters="Add New Idea">Add New Idea</span></a>
                            </div>
                        </div>
                    </div>
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

