<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>Change Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
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
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" id="style_sheet" href="css/skins/default.css">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" >
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800%7CPlayfair+Display:400,700%7CRoboto:100,300,400,400i,500,700">
    <link rel="stylesheet" type="text/css" href="css/ie10-viewport-bug-workaround.css">
    <script src="js/ie-emulation-modes-warning.js"></script>
</head>
<body>
<div class="page_loader"></div>
<?php include('includes/header.php'); ?>
<div class="sub-banner overview-bgi">
    <div class="overlay">
        <div class="container">
            <div class="breadcrumb-area">
                <h1>Change Password</h1>
                <ul class="breadcrumbs">
                    <li><a href="index.html">Home</a></li>
                    <li class="active">Change Password</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="content-area change-password">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-5">
                <div class="user-account-box">
                    <div class="header clearfix">
                        <div class="edit-profile-photo">
                            <img src="img/profile-my-property.jpg" alt="agent-1" class="img-responsive">
                            <div class="change-photo-btn">
                                <div class="photoUpload">
                                    <span><i class="fa fa-upload"></i> Upload Photo</span>
                                    <input type="file" class="upload">
                                </div>
                            </div>
                        </div>
                        <h3>John Doe</h3>
                        <p>johndoe@gmail.com</p>
                    </div>
                    <div class="content">
                        <ul>
                            <li>
                                <a href="user-profile.html">
                                    <i class="flaticon-social"></i>Profile
                                </a>
                            </li>
                            <li>
                                <a href="my-properties.html">
                                    <i class="flaticon-apartment"></i>My Properties
                                </a>
                            </li>
                            <li>
                                <a href="submit-property.html">
                                    <i class="fa fa-plus"></i>Submit New Property
                                </a>
                            </li>
                            <li>
                                <a href="change-password.html" class="active">
                                    <i class="flaticon-security"></i>Change Password
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="flaticon-sign-out-option"></i>Log Out
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-7">
                <div class="my-address">
                    <div class="main-title-2">
                        <h1><span>Change</span> Password</h1>
                    </div>
                    <form action="index.html" method="GET">
                        <div class="form-group">
                            <label>Current Password</label>
                            <input type="password" class="input-text" name="current password" placeholder="Current Password">
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" class="input-text" name="new-password" placeholder="New Password">
                        </div>
                        <div class="form-group">
                            <label>Confirm New Password</label>
                            <input type="password" class="input-text" name="confirm-new-password" placeholder="Confirm New Password">
                        </div>
                        <a href="submit-property.html" class="btn button-md button-theme">Save Changes</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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
                                    <img src="img/g4.png" alt="partner">
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="col-xs-12 col-sm-6 col-md-3 partner-box">
                                <a href="#">
                                    <img src="img/g4.png" alt="partner-2">
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="col-xs-12 col-sm-6 col-md-3 partner-box">
                                <a href="#">
                                    <img src="img/g4.png" alt="partner-3">
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="col-xs-12 col-sm-6 col-md-3 partner-box">
                                <a href="#">
                                    <img src="img/g4.png" alt="partner-4">
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="col-xs-12 col-sm-6 col-md-3 partner-box">
                                <a href="#">
                                    <img src="img/g4.png" alt="partner-5">
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
<?php include('includes/footer.php'); ?>
<?php include('includes/foot.php'); ?>
</body>
</html>