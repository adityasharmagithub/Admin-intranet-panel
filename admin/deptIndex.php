<?php
    require('../config/config.php');
    require('../config/db.php');

    $department = mysqli_real_escape_string($conn, $_GET['id']);
    
    $query = "SELECT * FROM articles WHERE file='' AND deptid='$department' ORDER BY startdate DESC";
    $queryImage = "SELECT * FROM articles WHERE file != '' ";
    $queryDept = "SELECT * FROM department";
    $queryCurrDept = "SELECT * FROM department WHERE deptid='$department'";

    $result = mysqli_query($conn, $query);
    $resultImage = mysqli_query($conn, $queryImage);
    $resultDept = mysqli_query($conn, $queryDept);
    $resultCurrDept = mysqli_query($conn, $queryCurrDept);

    $circulars = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $images = mysqli_fetch_all($resultImage, MYSQLI_ASSOC);
    $departments = mysqli_fetch_all($resultDept, MYSQLI_ASSOC);
    $currDept = mysqli_fetch_all($resultCurrDept, MYSQLI_ASSOC);
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>NHPC Home</title>
    <link rel="icon" href="img/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- animate CSS -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <!-- themify CSS -->
    <link rel="stylesheet" href="css/themify-icons.css">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="css/flaticon.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="css/magnific-popup.css">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/gijgo.min.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/all.css">
    <!-- style CSS -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <!--::header part start::-->
    <header class="main_menu home_menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="main_menu_iner">
                        <div class="logo">
                            <a href="#"><img src="img/logo.png" alt="#"></a>
                        </div>
                        <h3><b><?php echo $currDept[0]['deptname'] ?></b></h3>
                        <span class="menu-trigger visible-xs">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                        <div class="off-canven-menu">
                            <span class="close-icon">
                                <i class="ti-close"></i>
                            </span>
                            <div class="canven-menu-warp">
                                <div class="canven-menu-iner">
                                    <ul>
                                        <li><a href="index.php">Home</a></li>
                                        <?php foreach($departments as $department): ?>
                                            <li><a href="deptIndex.php?id=<?php echo $department['deptid'] ?>"><?php echo $department['deptname'] ?></a></li>
                                        <?php endforeach; ?>
                                        <li><a href="../login/login.php">Login</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header part end-->

    <!-- banner part start-->
    <section class="banner_part">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <br><br>
                    <h2>What's New</h2>
                    <div class="banner_text">
                        <?php foreach($circulars as $circular): ?>
                            <div class="banner_text_iner">
                                <h5>Issued on: <?php echo $circular['startdate']; ?></h5>
                                <h1><?php echo $circular['title']; ?></h1>
                                <p><b><?php echo $circular['body']; ?></b></p>
                                <br><hr noshade="noshade"><br>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="nav next"><a href="#"><span class="flaticon-left-arrow"></span></a></div>
                    <div class="nav prev"><a href="#"><span class="flaticon-right-arrow"></span></a></div>
                </div>
                <div class="col-sm-2"></div>
                <div class="col-sm-6">
                    <div class="section_tittle">
                        <br>
                        <h2>Gallery</h2>
                        <p>Here are some latest media releases of
                            NHPC Limited. It highlights the work culture
                            of organisation as well as the ongoing projects
                            that are running successfully across India.
                        </p>
                    </div>
                    <div class="blog_post_slider owl-carousel">
                        <?php foreach($images as $image): ?>
                        <div class="single_blog_post">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="single_img">
                                        <img src="<?php echo '../uploads/'.$image['file']; ?>" alt="#">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="slider-counter"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner part end-->

    <!-- Info area strats-->
    <section class="blog_part">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-7">
                    <br><br>
                    <u><h1>NHPC Limited</h1></u>
                    <p>NHPC Limited (erstwhile National Hydroelectric Power Corporation) is an Indian Hydropower generation company that was incorporated in the year 1975 with an authorised capital of Rs. 2000 million and with an objective to plan, promote and organise an integrated and efficient development of hydroelectric power in all aspects. Later on NHPC expanded its objects to include other sources of energy like Solar, Geothermal, Tidal, Wind etc.

                    At present, NHPC is a Mini Ratna Category-I Enterprise of the Govt. of India with an authorised share capital of Rs. 150,000 Million . With an investment base of over Rs. 387,180 Million Approx., NHPC is among the top ten companies in the country in terms of investment. Baira Suil Power station in Salooni Tehsil of Chamba district was the first project undertaken by NHPC. Shri Balraj Joshi is the current CMD of NHPC. </p>
                </div>
                <div class="col-lg-2">
                    <br><br>
                     <style>
                        .vl {
                            border-left: 6px solid aqua;
                            height: 500px;
                            position: absolute;
                            left: 50%;
                            margin-left: -3px;
                            top: 10%;
                        }
                    </style>
                    <div class="vl"></div> 
                </div>
                <div class="col-lg-3">
                    <br><br>
                    <img src="http://www.nhpcindia.com/writereaddata/images/ShriBalrajJoshi.jpg">
                    <label>Shri Balraj Joshi</label>
                    <p>Shri Balraj Joshi (59 years) is the Chairman and Managing Director of NHPC and is also the chairman of Board of Directors of NHDC Limited and LDHCL. </p>
                    <br><hr align="center" noshade><br>
                    <h4>Check Company Stocks</h4>
                    <style>
                        .btn{
                            background-color: aqua;
                        }
                    </style>
                    <a href="https://www.moneycontrol.com/india/stockpricequote/power-generation-distribution/nhpc/N07" target="_blank"><button type="reset" class="btn">Click Here</button></a>
                </div>
            </div>
        </div>
    </section>
    <!-- Info area ends -->

    <!-- contact us part start-->
    <section class="contact_us">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact_us_iner">
                        <div class="row justify-content-around">
                            <div class="col-lg-4">
                                <div class="contact_us_left_text">
                                    <h4>NHPC Faridabad</h4>
                                    <span>Haryana, India</span>
                                    <p> N.H.P.C Office Complex,
                                    Sector-33, Faridabad - 121003 (Haryana), India
                                    </p>
                                    <p><a href="webmaster@nhpc.nic.in">Email</a><br>Phone no:  0129-2588500</p>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="contact_us_right_text">
                                    <h5>Call Directly;</h5>
                                    <h3>( 0129-2588500)</h3>
                                    <h5>Head Office</h5>
                                    <span>N.H.P.C Office Complex,
                                    Sector-33, Faridabad - 121003 (Haryana), India</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact us part end-->

    <!-- footer part start-->
    <footer class="footer-area">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-3 col-sm-6">
                    <div class="single-footer-widget footer_1">
                        <div class="social_icon">
                            <a href="https://www.facebook.com/NHPCIndiaLimited/"><i class="ti-facebook"></i></a>
                            <a href="https://twitter.com/nhpcltd?lang=en"><i class="ti-twitter-alt"></i></a>
                            <a href="https://youtu.be/XF3ndSL81x0"><i class="ti-youtube"></i></a>
                            <a href="https://www.instagram.com/nhpclimited/?hl=en"><i class="ti-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright_part">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <p class="footer-text m-0">
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Made with <i class="fa fa-heart" aria-hidden="true"></i> by Aditya</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer part end-->

    <!-- jquery plugins here-->
    <!-- jquery -->
    <script src="js/jquery-1.12.1.min.js"></script>
    <!-- popper js -->
    <script src="js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- easing js -->
    <script src="js/jquery.magnific-popup.js"></script>
    <!-- swiper js -->
    <script src="js/swiper.min.js"></script>
    <!-- swiper js -->
    <script src="js/masonry.pkgd.js"></script>
    <!-- particles js -->
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/gmap3.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpfS1oRGreGSBU5HHjMmQ3o5NLw7VdJ6I&callback=initMap">
    </script>
    <!-- slick js -->
    <script src="js/slick.min.js"></script>
    <script src="js/gijgo.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <!-- contact js -->
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/jquery.form.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/mail-script.js"></script>
    <script src="js/contact.js"></script>
    <!-- custom js -->
    <script src="js/custom.js"></script>
</body>

</html>