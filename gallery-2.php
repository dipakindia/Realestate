<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>The Nest - Real Estate HTML Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">

    <!-- External CSS libraries -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-submenu.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-select.min.css">
    <link rel="stylesheet" href="css/leaflet.css" type="text/css">
    <link rel="stylesheet" href="css/map.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" type="text/css" href="fonts/linearicons/style.css">
    <link rel="stylesheet" type="text/css"  href="css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" type="text/css"  href="css/dropzone.css">
    <link rel="stylesheet" type="text/css"  href="css/magnific-popup.css">

    <!-- Custom stylesheet -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" id="style_sheet" href="css/skins/default.css">

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" >

    <!-- Google fonts -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800%7CPlayfair+Display:400,700%7CRoboto:100,300,400,400i,500,700">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link rel="stylesheet" type="text/css" href="css/ie10-viewport-bug-workaround.css">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script type="text/javascript" src="js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="js/html5shiv.min.js"></script>
    <script type="text/javascript" src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div class="page_loader"></div>

<!-- Top header start -->
<?php include('includes/header.php'); ?>
<!-- Main header end -->

<!-- Sub banner start -->
<div class="sub-banner overview-bgi">
    <div class="overlay">
        <div class="container">
            <div class="breadcrumb-area">
                <h1>Gallery</h1>
                <ul class="breadcrumbs">
                    <li><a href="index.html">Home</a></li>
                    <li class="active">Gallery</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Sub Banner end -->

<!-- properties gallery start -->
<div class="properties-gallery content-area">
    <div class="container">
        <div class="main-title">
            <h1><span>Properties</span> Gallery</h1>
        </div>

        <ul class="list-inline-listing filters filters-listing-navigation">
            <li class="active btn filtr-button filtr" data-filter="all">All</li>
            <li data-filter="1" class="btn btn-inline filtr-button filtr">House</li>
            <li data-filter="2" class="btn btn-inline filtr-button filtr">Office</li>
            <li data-filter="3" class="btn btn-inline filtr-button filtr">Apartment</li>
            <li data-filter="4" class="btn btn-inline filtr-button filtr">Residential</li>
        </ul>
        <div class="row">
            <div class="filtr-container">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12  filtr-item" data-category="1, 2, 3">
                    <div class="portfolio-item car-magnify-gallery">
                        <a href="http://placehold.it/750x540" title="Park Avenue">
                            <img src="http://placehold.it/262x175" alt="properties-gallery" class="img-fluid">
                        </a>
                        <div class="portfolio-content">
                            <div class="portfolio-content-inner">
                                <p>Park Avenue</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12  filtr-item" data-category="1">
                    <div class="portfolio-item car-magnify-gallery">
                        <a href="http://placehold.it/750x540" title="Beautiful Single Home">
                            <img src="http://placehold.it/262x175" alt="properties-gallery" class="img-fluid">
                        </a>
                        <div class="portfolio-content">
                            <div class="portfolio-content-inner">
                                <p>Beautiful Single Home</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12  filtr-item" data-category="2, 3">
                    <div class="portfolio-item car-magnify-gallery">
                        <a href="http://placehold.it/750x540" title="Masons Villas">
                            <img src="http://placehold.it/262x175" alt="properties-gallery" class="img-fluid">
                        </a>
                        <div class="portfolio-content">
                            <div class="portfolio-content-inner">
                                <p>Masons Villas</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12  filtr-item" data-category="3, 4">
                    <div class="portfolio-item car-magnify-gallery">
                        <a href="http://placehold.it/750x540" title="Big Head House">
                            <img src="http://placehold.it/262x175" alt="properties-gallery" class="img-fluid">
                        </a>
                        <div class="portfolio-content">
                            <div class="portfolio-content-inner">
                                <p>Big Head House</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12  filtr-item" data-category="4">
                    <div class="portfolio-item car-magnify-gallery">
                        <a href="http://placehold.it/750x540" title="Sweet Family Home">
                            <img src="http://placehold.it/262x175" alt="properties-gallery" class="img-fluid">
                        </a>
                        <div class="portfolio-content">
                            <div class="portfolio-content-inner">
                                <p>Sweet Family Home</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12  filtr-item" data-category="1">
                    <div class="portfolio-item car-magnify-gallery">
                        <a href="http://placehold.it/750x540" title="Park Avenue">
                            <img src="http://placehold.it/262x175" alt="properties-gallery" class="img-fluid">
                        </a>
                        <div class="portfolio-content">
                            <div class="portfolio-content-inner">
                                <p>Park Avenue</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12  filtr-item" data-category="1, 2, 3">
                    <div class="portfolio-item car-magnify-gallery">
                        <a href="http://placehold.it/750x540" title="Park Avenue">
                            <img src="http://placehold.it/262x175" alt="properties-gallery" class="img-fluid">
                        </a>
                        <div class="portfolio-content">
                            <div class="portfolio-content-inner">
                                <p>Park Avenue</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12  filtr-item" data-category="1">
                    <div class="portfolio-item car-magnify-gallery">
                        <a href="http://placehold.it/750x540" title="Beautiful Single Home">
                            <img src="http://placehold.it/262x175" alt="properties-gallery" class="img-fluid">
                        </a>
                        <div class="portfolio-content">
                            <div class="portfolio-content-inner">
                                <p>Beautiful Single Home</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12  filtr-item" data-category="2, 3">
                    <div class="portfolio-item car-magnify-gallery">
                        <a href="http://placehold.it/750x540" title="Masons Villas">
                            <img src="http://placehold.it/262x175" alt="properties-gallery" class="img-fluid">
                        </a>
                        <div class="portfolio-content">
                            <div class="portfolio-content-inner">
                                <p>Masons Villas</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12  filtr-item" data-category="1, 2, 3">
                    <div class="portfolio-item car-magnify-gallery">
                        <a href="http://placehold.it/750x540" title="Park Avenue">
                            <img src="http://placehold.it/262x175" alt="properties-gallery" class="img-fluid">
                        </a>
                        <div class="portfolio-content">
                            <div class="portfolio-content-inner">
                                <p>Park Avenue</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12  filtr-item" data-category="1">
                    <div class="portfolio-item car-magnify-gallery">
                        <a href="http://placehold.it/750x540" title="Beautiful Single Home">
                            <img src="http://placehold.it/262x175" alt="properties-gallery" class="img-fluid">
                        </a>
                        <div class="portfolio-content">
                            <div class="portfolio-content-inner">
                                <p>Beautiful Single Home</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12  filtr-item" data-category="2, 3">
                    <div class="portfolio-item car-magnify-gallery">
                        <a href="http://placehold.it/750x540" title="Masons Villas">
                            <img src="http://placehold.it/262x175" alt="properties-gallery" class="img-fluid">
                        </a>
                        <div class="portfolio-content">
                            <div class="portfolio-content-inner">
                                <p>Masons Villas</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12  filtr-item" data-category="3, 4">
                    <div class="portfolio-item car-magnify-gallery">
                        <a href="http://placehold.it/750x540" title="Big Head House">
                            <img src="http://placehold.it/262x175" alt="properties-gallery" class="img-fluid">
                        </a>
                        <div class="portfolio-content">
                            <div class="portfolio-content-inner">
                                <p>Big Head House</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12  filtr-item" data-category="4">
                    <div class="portfolio-item car-magnify-gallery">
                        <a href="http://placehold.it/750x540" title="Sweet Family Home">
                            <img src="http://placehold.it/262x175" alt="properties-gallery" class="img-fluid">
                        </a>
                        <div class="portfolio-content">
                            <div class="portfolio-content-inner">
                                <p>Sweet Family Home</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12  filtr-item" data-category="1">
                    <div class="portfolio-item car-magnify-gallery">
                        <a href="http://placehold.it/750x540" title="Park Avenue">
                            <img src="http://placehold.it/262x175" alt="properties-gallery" class="img-fluid">
                        </a>
                        <div class="portfolio-content">
                            <div class="portfolio-content-inner">
                                <p>Park Avenue</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12  filtr-item" data-category="1, 2, 3">
                    <div class="portfolio-item car-magnify-gallery">
                        <a href="http://placehold.it/750x540" title="Park Avenue">
                            <img src="http://placehold.it/262x175" alt="properties-gallery" class="img-fluid">
                        </a>
                        <div class="portfolio-content">
                            <div class="portfolio-content-inner">
                                <p>Park Avenue</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- properties gallery end -->

<!-- Partners block start -->
<div class="partners-block">
    <div class="container">
        <h3>Brands & Partners</h3>
        <div class="row">
            <div class="col-md-12">
                <div class="carousel our-partners slide" id="ourPartners">
                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="col-xs-12 col-sm-6 col-md-3 partner-box">
                                <a href="#">
                                    <img src="http://placehold.it/135x50" alt="partner">
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="col-xs-12 col-sm-6 col-md-3 partner-box">
                                <a href="#">
                                    <img src="http://placehold.it/135x50" alt="partner-2">
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="col-xs-12 col-sm-6 col-md-3 partner-box">
                                <a href="#">
                                    <img src="http://placehold.it/135x50" alt="partner-3">
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="col-xs-12 col-sm-6 col-md-3 partner-box">
                                <a href="#">
                                    <img src="http://placehold.it/135x50" alt="partner-4">
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="col-xs-12 col-sm-6 col-md-3 partner-box">
                                <a href="#">
                                    <img src="http://placehold.it/135x50" alt="partner-5">
                                </a>
                            </div>
                        </div>
                    </div>
                    <a class="left carousel-control" href="#ourPartners" data-slide="prev"><i class="fa fa-chevron-left icon-prev"></i></a>
                    <a class="right carousel-control" href="#ourPartners" data-slide="next"><i class="fa fa-chevron-right icon-next"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Partners block end -->

<!-- Footer start -->
<footer class="main-footer clearfix">
    <div class="container">
        <!-- Footer info-->
        <div class="footer-info">
            <div class="row">
                <!-- About us -->
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="footer-item">
                        <div class="main-title-2">
                            <h1>Contact Us</h1>
                        </div>
                        <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's printing and
                        </p>
                        <ul class="personal-info">
                            <li>
                                <i class="fa fa-map-marker"></i>
                                Address: 20/F Green Road, Dhanmondi, Dhaka
                            </li>
                            <li>
                                <i class="fa fa-envelope"></i>
                                Email:<a href="mailto:sales@hotelempire.com">info@themevessel.com</a>
                            </li>
                            <li>
                                <i class="fa fa-phone"></i>
                                Phone: <a href="tel:+55-417-634-7071">+55 4XX-634-7071</a>
                            </li>
                            <li>
                                <i class="fa fa-fax"></i>
                                Fax: +55 4XX-634-7071
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Links -->
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                    <div class="footer-item">
                        <div class="main-title-2">
                            <h1>Links</h1>
                        </div>
                        <ul class="links">
                            <li>
                                <a href="index.html">Home</a>
                            </li>
                            <li>
                                <a href="about.html">About Us</a>
                            </li>
                            <li>
                                <a href="contact.html">Contact Us</a>
                            </li>
                            <li>
                                <a href="blog-single-sidebar-right.html">Blog</a>
                            </li>
                            <li>
                                <a href="blog-single-sidebar-right.html">Services</a>
                            </li>
                            <li>
                                <a href="properties-list-rightside.html">properties Listing</a>
                            </li>
                            <li>
                                <a href="properties-grid-rightside.html">properties Grid</a>
                            </li>
                            <li>
                                <a href="properties-details.html">properties Details</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Recent cars -->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="footer-item popular-posts">
                        <div class="main-title-2">
                            <h1>Popular Posts</h1>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <img class="media-object" src="http://placehold.it/90x63" alt="small-properties-1">
                            </div>
                            <div class="media-body">
                                <h3 class="media-heading">
                                    <a href="properties-details.html">Sweet Family Home</a>
                                </h3>
                                <p>February 27, 2018</p>
                                <div class="price">
                                    $734,000
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <img class="media-object" src="http://placehold.it/90x63" alt="small-properties-2">
                            </div>
                            <div class="media-body">
                                <h3 class="media-heading">
                                    <a href="properties-details.html">Modern Family Home</a>
                                </h3>
                                <p>February 27, 2018</p>
                                <div class="price">
                                    $734,000
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <img class="media-object" src="http://placehold.it/90x63" alt="small-properties-3">
                            </div>
                            <div class="media-body">
                                <h3 class="media-heading">
                                    <a href="properties-details.html">Beautiful Single Home</a>
                                </h3>
                                <p>February 27, 2018</p>
                                <div class="price">
                                    $734,000
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Subscribe -->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="footer-item">
                        <div class="main-title-2">
                            <h1>Subscribe</h1>
                        </div>
                        <div class="newsletter clearfix">
                            <p>
                                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id
                            </p>

                            <form action="#" method="post">
                                <div class="form-group">
                                    <input class="nsu-field btn-block" id="nsu-email-0" type="text" name="email" placeholder="Enter your Email Address" required="">
                                </div>
                                <div class="form-group mb-0">
                                    <button type="submit" class="button-sm button-theme btn-block">
                                        Subscribe
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer end -->

<!-- Copy right start -->
<div class="copy-right">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-8 col-sm-12">
                &copy;  2018 Trademarks and brands are the property of their respective owners.
            </div>
            <div class="col-md-4 col-sm-12">
                <ul class="social-list clearfix">
                    <li>
                        <a href="#" class="facebook">
                            <i class="fa fa-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="twitter">
                            <i class="fa fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="linkedin">
                            <i class="fa fa-linkedin"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="google">
                            <i class="fa fa-google-plus"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="rss">
                            <i class="fa fa-rss"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Copy end right-->

<script src="js/jquery-2.2.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-submenu.js"></script>
<script src="js/rangeslider.js"></script>
<script src="js/jquery.mb.YTPlayer.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/bootstrap-select.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/jquery.scrollUp.js"></script>
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="js/leaflet.js"></script>
<script src="js/leaflet-providers.js"></script>
<script src="js/leaflet.markercluster.js"></script>
<script src="js/dropzone.js"></script>
<script src="js/jquery.filterizr.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/maps.js"></script>
<script src="js/app.js"></script>

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="js/ie10-viewport-bug-workaround.js"></script>
<!-- Custom javascript -->
<script src="js/ie10-viewport-bug-workaround.js"></script>

</body>
</html>