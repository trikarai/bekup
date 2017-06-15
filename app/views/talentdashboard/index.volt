<?php use Phalcon\Tag; ?>

<!-- Animation library for notifications   -->
<link href="{{url('public/css/animate.min.css')}}" rel="stylesheet"/>
<!--  Paper Dashboard core CSS    -->
<link href="{{url('public/css/dashboard.css')}}" rel="stylesheet"/>
<link rel="stylesheet" href="{{url('public/css/linkstyles.css')}}">

{{ content() }}
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
                                <i class="fa fa-pencil-square"></i><a href="{{url('talentprofile/index')}}" class="info-a link link--kumya"> <span data-letters="Update Profile">Update Profile</span></a>
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
                                    <p>Kelas</p>
                                    Class
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr />
                            <div class="stats">
                                <i class="fa fa-plus"></i><a href="{{url('talentclass/new')}}" class="info-a link link--kumya"><span data-letters="Apply New Class">Apply New Class</span></a>
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
                                <i class="fa fa-search"></i><a href="{{url('team/index')}}" class="info-a link link--kumya"><span data-letters="View Team Profile">View Team Profile</span></a>
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
<script src="https://code.jquery.com/jquery-2.2.0.min.js"
        integrity="sha256-ihAoc6M/JPfrIiIeayPE9xjin4UWjsx2mjW/rtmxLM4="
crossorigin="anonymous"></script>
<script>
    $('#dashboardMenu').addClass('active');
    $('#dashboardMenu').css('color', '#fff');
</script>

