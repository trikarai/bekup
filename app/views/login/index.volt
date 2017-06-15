<style>
    .alert {
        text-align: justify !important;
        border-radius: 0 !important;
        border-color: transparent !important;
        margin-top: 20px;
    }
</style>

<html lang="en">
    <head>
        <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
        <link rel="icon" type="image/png" href="assets/img/favicon.png">

        <title>BEKUP - Login Page</title>

        <!--     Fonts and icons     -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

        <!-- CSS Files -->
        <link href="<?php echo $this->url->get('public'); ?>/css/bootstrap.min.css" rel="stylesheet" />
        <link href="<?php echo $this->url->get('public'); ?>/css/material-kit.css" rel="stylesheet"/>


    </head>

    <body class="index-page">

        <div class="wrapper">

            <div class="main main-raised">
                <div class="section section-full-screen section-signup" style="background-image: url({{url('public/img/login-bg-1.jpg')}});min-height: 700px;background-color: #f3f3f3;border-radius: 6px;margin-top: 95px;">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4">
                                <div class="card card-signup">
                                    <form class="form-login" action=<?php echo $this->url->get('login/login'); ?> method="post">
                                        <div class="header header-primary text-center">
                                            <h4>login</h4>

                                        </div>
                                        <p class="text-divider">Welcome to BEKUP</p>
                                        
                                        {{flash.output()}}
                                        <div class="content">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">face</i>
                                                </span>
                                                <div class="form-group label-floating">
                                                    <label class="control-label">username</label>
                                                    <input class="form-control" type="text" name="username" autocomplete="off" autofocus required/>
                                                </div>
                                            </div>

                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">lock_outline</i>
                                                </span>
                                                <div class="form-group label-floating">
                                                    <label class="control-label">password</label>
                                                    <input type="password" name="password" class="form-control" autocomplete="off" required/>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="footer text-center" style="margin-bottom: 25px;">
                                            <button class="btn btn-theme" type="submit">Submit</button>
                                        </div>
                                    </form>
                                    <div style="text-align: center;margin-bottom: 37px;">
                                        Don't have an account yet?<br/>
                                        <a class="" href={{url('register/index')}} style="text-decoration:none !important">
                                            Register Here
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
    </div>
            <footer class="footer">
                <div class="container">

                    <div class="copyright text-center">
                        &copy; 2017, <b style="font-weight:900;">BEKUP</b>
                    </div>
                </div>
            </footer>
        </div>


    </body>

    <script src="<?php echo $this->url->get('public'); ?>/js/jquery.min.js"></script>
    <script src="<?php echo $this->url->get('public'); ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo $this->url->get('public'); ?>/js/material.min.js"></script>
    <script src="<?php echo $this->url->get('public'); ?>/js/material-kit.js" type="text/javascript"></script>


</html>
