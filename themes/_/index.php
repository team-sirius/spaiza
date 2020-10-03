<!doctype html>
<html lang="zxx">


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
                                    <a href="#SubmitIdea">About US</a>
                                </li>
                                <li>
                                    <a href="new.php">Submit Idea</a>
                                </li>

                                <li>
                                    <a href="#about"> Submitted Ideas</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </nav>
                <div id="home" class="page-hero header-filter">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-0 col-sm-8 col-sm-offset-2">
                                <h1 class="title">Welcome to Spaiza</h1>
                                <p class="up-type-title"> A Ground of <span class="animated-text" id="animated-text"></span></p>
                                <p class="p-details">
                                    Spiza is Open Web Application platform, Where every one can get the actual interest of Space Study. We support you with all eassiest approaches of Space.
                                </p>

                            </div>	
                           
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Header -->
        </div>



        <!-- Idea display -->
        <section class=" bg-gray" id="ideas">
            <div class="container">
                <div class="section-header text-center">
                    <h2 class="title">Latest Ideas</h2>
                    <h5 class="description">All space ideas are submitted by Space lovers. </h5>
                </div>
                <div class="zowl-carousel" id="xblog-carousel">
                    <?php if (!has_posts()): ?>
                        <h5 class="description text-center" style="color:red">No discussions available</h5>
                        <?php if ($Error) echo $Error ?>

                    <?php else: while (has_post()): ?>

                            <div class="item">
                                <div class="card card-blog">
                                    <div class="card-image">
                                        <a href="details.php?id=<?= the_id() ?>">
                                            <img class="img img-raised img-responsive" src="<?= the_thumb() ?>" alt="img" />
                                        </a>
                                    </div>
                                    <div class="content">

                                        <h4 class="card-title">
                                            <a href="details.php?id=<?= the_id() ?>"><?= the_title() ?></a>
                                        </h4>

                                        <h6 class="category text-info"><?= the_name() ?></h6>
                                        <p> 
                                            <i class="fa fa-clock-o"></i> <?= date("Y-m-d H:i:s",the_time()) ?>
                                        </p>
                                        <p class="card-description" style="  display: block;/* or inline-block */
  text-overflow: ellipsis;
  word-wrap: break-word;
  overflow: hidden;
  max-height: 2.6em;
  line-height: 1.4em;"><?= the_text() ?></p>......<a style="color:red" href="details.php?id=<?= the_id() ?>"> Read More </a>
                                    </div>
                                </div>
                            </div>

                        <?php endwhile;
                    endif;
                    ?>
                </div>

                <div class="section-header text-center">

                    <h5 class="description">


                        <style>
                            .pagination {
                                display: inline-block;
                            }

                            .pagination a {
                                color: black;
                                float: left;
                                padding: 8px 16px;
                                text-decoration: none;
                                transition: background-color .3s;
                                border: 1px solid #ddd;
                                margin: 0 4px;
                            }

                            .pagination a.active {
                                background-color: #4CAF50;
                                color: white;
                                border: 1px solid #4CAF50;
                            }

                            .pagination a:hover:not(.active) {background-color: #ddd;}
                        </style>
                        </head>
                        <body>
                                 
                            
                            <div class="pagination">
                                 <?php if(prev_page()){ 
								 echo'<a href="'.prev_page().'">&laquo; Prev</a>';}
                            elseif(next_page()){
                                echo'<a href="'.next_page().'" class="active">Next &raquo;</a>';
							} ?>
                            </div>
                    </h5>
                </div>
            </div>
        </section>



        <section class="section" id="about">
            <div class="container">
                <div class="section-heading text-center wow fadeInUp">
                    <h2 class="title">About us</h2>
                    <h5 class="description">Making an interactive, attractive, and fun content to make space study fun for teenagers.  It will becaome easier and fun.</h5>
                </div>
                <!-- first row -->
                <div class="row">
                    <div class="col-md-4 wow fadeInUp">
                        <div class="info info-horizontal">
                            <div class="icon icon-info">
                                <i class="fa fa-gift"></i>
                            </div>
                            <div class="description">
                                <h4 class="info-title">The problem we are working on</h4>
                                <p>
                                    Despite of so much success in this field of study, it has always seemed complicated to the common citizens.
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 wow fadeInUp">
                        <div class="info info-horizontal">
                            <div class="icon icon-danger">
                                <i class="fa fa-heartbeat"></i>
                            </div>
                            <div class="description">
                                <h4 class="info-title">Our Aim</h4>
                                <p>
                                    Diminish the fear of complicated space study among common people so that our new generation will be more active on this platform. 
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 wow fadeInUp">
                        <div class="info info-horizontal">
                            <div class="icon icon-success">
                                <i class="fa fa-cubes"></i>
                            </div>
                            <div class="description">
                                <h4 class="info-title">The solution we are working on</h4>
                                <p>
                                    Making an interactive, attractive, and fun site to make space study fun for teenagers.  It will becaome easier and fun.
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <img src="themes/_/img/about-img.png" alt="" class="img-responsive">
                </div>
                <!-- End first row -->
            </div>
        </section>





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
                        <a href="#"><h2>SPAIZA</a></a>
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
        <!-- <script src="js/modernizr.js" type="text/javascript"></script> -->
        <script src="themes/js/main.js" type="text/javascript"></script>
        <!-- Color Switcher -->


        <!-- END Skin switcher -->
    </body>


</html>