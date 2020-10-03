<?php
$msg = "";
if(has_msg()){
    if(the_error()){

        $msg = '<h5 class="description text-center" style="color:#8dcaff;font-size:23px">'. the_error().'</h5>';
    }else $msg = '<h5 class="description text-center" style="color:#8dcaff;font-size:23px">Idea added successfully! <a href="details.php?id='. the_id().'">Click here to browse</a></h5>';
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="spaiza">
        <title>Spaiza</title>
        <!-- Google fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
        <!-- CSS Files -->
        <link href="themes/css/bootstrap.min.css" rel="stylesheet" />
        <link href="themes/css/font-awesome.min.css" rel="stylesheet" />
        <link href="themes/css/material-kit.css" rel="stylesheet" />
        <link href="themes/css/style.css" rel="stylesheet" />
        <style type="text/css">
            .skins {
                position: fixed;
                top: 190px;
                left: -120px;
                transition: .3s ease-in-out;
                z-index: 1000;
            }

            .skins:hover {
                left: 0;
            }

            .skin-colors {
                list-style: none;
                padding: 20px;
                margin: 0;
                background-color: #fff;
                width: 120px;
                border: 1px solid #e7e7e7;
            }

            .skin-colors li {
                position: relative;
                display: inline-block;
                width: 32px;
                height: 32px;
                cursor: pointer;
                margin: -3px;
                line-height: 0;
                transition: .3s ease-in-out;
            }

            .skin-colors li:hover {
                opacity: .7;
            }

            .skin-colors li.active::before {
                content: "\f00c";
                font-family: FontAwesome;
                font-size: 20px;
                width: 32px;
                line-height: 32px;
                text-align: center;
                position: absolute;
                color: #fff;
            }

            .skin-toggler {
                position: absolute;
                display: inline-block;
                width: 50px;
                height: 50px;
                right: -49px;
                top: 0;
                background-color: #fff;
                font-size: 30px;
                text-align: center;
                line-height: 50px;
                color: #888;
                border: 1px solid #e7e7e7;
                border-left: 0;
            }

            .skin-toggler .fa {
                transform: rotate(30deg);
                -webkit-transition: 2s;
                -moz-transition: 2s;
                -ms-transition: 2s;
                -o-transition: 2s;
                transition: 2s;
                animation: gear 1s infinite;
            }

            @keyframes gear {
                0% {
                    transform: rotate(0deg)
                }
                100% {
                    transform: rotate(360deg)
                }
            }
        </style>
    </head>

    <body id="up">
        <!-- Preloader -->

        <!-- Page hero -->
        <div class="" id="headers">
            <!--  Header -->
            <div class="header">
                <nav id="sticky-nav" class="navbar navbar-custom sticky navbar-center">
                    <div class="container">

                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="" href="index.php">
                                <h2> SPAIZA  </h2>
                            </a>
                        </div>
                        <div class="collapse navbar-collapse" id="navigation-example">
                            <ul class="nav navbar-nav navbar-right">
                                <li>
                                    <a href="index.php#about">About US</a>
                                </li>
                                <li>
                                    <a href="#SubmitIdea">Submit Idea</a>
                                </li>

                                <li>
                                    <a href="index.php"> Submitted Ideas</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </nav>

            </div>
            <!-- End Header -->
        </div>

        <div class="container">
               
        </div>
        <div class="col-md-5 col-md-offset-2" style="margin-top:150px;margin-left:500px"><?=$msg?>
            <div class="card card-contact">
			
			
			  
                <form id="signup" method="post" novalidate enctype="multipart/form-data">
                    <div class="header header-raised header-primary text-center">
                        <h4 class="card-title">Submit your Innovation Idea of Space</h4>
                    </div>
                    <div class="card-layer"></div>
                    <div class="content">
                        <div class="form-group label-floating">
                            <label class="control-label">Title <i class="help-block text-danger"></i></label>
                            <input type="text" name="title" class="form-control">
                        </div>

                        <div class="form-group label-floating">
                            <label class="control-label">Details <i class="help-block text-danger"></i></label>
                            <textarea class="form-control" rows="6" name="text"></textarea>
                        </div>

                        <div class="xform-group label-floating">

                            <label>Image
                                <input type="file" name="thumb"> 
                            </label>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary pull-right">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>





            </div>
        </div>
    </div>
</div>


<div class="subscribe bg-primary">
    <div class="container">
        <div class="row">

            <div class="col-md-6 text-right">
                <form method="post" id="subscribe">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="input-group">
                                <span class="input-group-addon">

                                </span>

                            </div>
                        </div>
                        <div class="col-sm-4">

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="footer section">
    <div class="container footer-widget">
        <div class="row">
            <div class="col col-sm-3">
                <h2>SPAIZA</h2>
                <div class="social">
                    <a href="#social"><i class="fa fa-facebook"></i></a>
                    <a href="#social"><i class="fa fa-youtube-play"></i></a>
                    <a href="#social"><i class="fa fa-instagram"></i></a>
                </div>
                <!-- /Social -->
                <hr class="up-hr">

            </div>
            <div class="col col-sm-3">
                <h6 class="typo-light hd">Our Supports</h6>
                <ul class="list-1">
                    <li><a href="#link">Submit Idea</a></li>
                    <li><a href="#link">Supports</a></li>
                    <li><a href="#link">Help</a></li>

                </ul>
            </div>
            <div class="col col-sm-3">
                <h6 class="typo-light hd">Link</h6>
                <ul class="list-1">
                    <li><a href="http//nasa.gov">NASA</a></li>
                    <li><a href="https://www.nasa.gov/multimedia/nasatv/index.html#public">NASA TV</a></li>
                    <li><a href="https://robotics.nasa.gov/links/nasa.php">NASA Robotics</a></li>

                </ul>
            </div>
            <div class="col col-sm-3">
                <div class="newsletter">
                    <h6 class="typo-light">Newsletter</h6>
                    <p>Add e-mail for the Space news &amp;</p>
                    <div id="subscribe-success"></div>
                    <form class="form-widget subscribe-form" id="subscribe-form">
                        <div class="field-group">
                            <input type="email" class="form-control" placeholder="Enter Your Email">
                            <button type="submit" id="submit" class="btn footer-btn btn-primary"><i class="fa fa-envelope-o"></i></button>
                        </div>
                        <div class="msg-wrp"></div>
                    </form>
                    <!-- /form -->
                </div>
            </div>
        </div>
        <hr>
        <p class="copyright">Design: Sakir ,Developed:  Saad</p>
        <p class="copyright"></p>
    </div>
</footer>
<!-- ./Footer section -->
<!-- End footer -->
<!--   Core JS Files   -->
<script src="themes/js/jquery.min.js" type="text/javascript"></script>
<script src="themes/js/bootstrap.min.js" type="text/javascript"></script>
<script src="themes/js/material.min.js"></script>
<!-- Jquery easing -->
<script type="text/javascript" src="themes/js/jquery.easing.1.3.min.js"></script>
<!-- Plugin For Google Maps -->
<!-- Typing text -->
<script src="themes/js/typed.min.js" type="text/javascript"></script>
<!-- sticky -->
<script src="themes/js/jquery.sticky.js" type="text/javascript"></script>
<!-- owl  carousel -->
<script src="themes/js/owl.carousel.min.js" type="text/javascript"></script>
<!-- contact form -->
<script type="text/javascript" src="themes/js/jqBootstrapValidation.js"></script>
<!-- <script src="themes/js/modernizr.js" type="text/javascript"></script> -->
<script src="themes/js/main.js" type="text/javascript"></script>
<!-- Color Switcher -->


<!-- END Skin switcher -->
</body>


</html>