<?php 
include('includes/config.php');
include('includes/login-check.php'); ?>

<?php 



//	echo '<pre>';

//	print_r($_SESSION);

//	die;

?><!DOCTYPE html>

<html lang="zxx">

<head>

    <title>My Properties</title>

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

                <h1>My Properties</h1>

                <ul class="breadcrumbs">

                    <li><a href="index.html">Home</a></li>

                    <li class="active">My Properties</li>

                </ul>

            </div>

        </div>

    </div>

</div>

<div class="content-area-7 my-properties">

    <div class="container">

        <div class="row">

            <div class="col-lg-4 col-md-4 col-sm-12">

                <!-- User account box start -->

                <?php include('includes/user_profile_box.php'); ?>

            </div>



             <div class="col-lg-8 col-md-8 col-sm-12">

                 <div class="main-title-2">

                     <h1><span>My</span> Properties</h1>

                 </div>

                <table class="manage-table responsive-table">

                    <tbody>
<?php  
$product_sql = mysql_query("SELECT * FROM `tbl_product_records` WHERE `user_id` = '".$_SESSION['user_id']."'");
if(mysql_num_rows($product_sql) > 0){
while($product_row = mysql_fetch_object($product_sql)){
?>
                    <tr>

                        <td class="title-container">

                            <img src="img/13090.jpg" alt="my-properties-1" class="img-responsive hidden-xs">

                            <div class="title">

                                <h4><a href="#"><?php echo $product_row->product_title; ?></a></h4>

                                <span><i class="fa fa-map-marker"></i> <?php echo $product_row->address; ?> </span>

                                <span class="table-property-price">Rs. <?php echo $product_row->price; ?> / <?php echo $product_row->area; ?> Sq. Ft.</span>

                            </div>

                        </td>

                        <td class="expire-date hidden-xs"><?php echo $product_row->added_date; ?></td>

                        <td class="action">

                            <a href="#"><i class="fa fa-pencil"></i> Edit</a>

                            <a href="#" class="delete"><i class="fa fa-remove"></i> Delete</a>

                        </td>

                    </tr>
<?php }} ?>
                    <!--<tr>

                        <td class="title-container">

                            <img src="img/13090.jpg" alt="my-properties-2" class="img-responsive hidden-xs">

                            <div class="title">

                                <h4><a href="#">beautiful  Family  home </a></h4>

                                <span><i class="fa fa-map-marker"></i> 123 Kathal St. Tampa City, </span>

                                <span class="table-property-price">$900 / monthly</span>

                            </div>

                        </td>

                        <td class="expire-date hidden-xs">April 28 2018</td>

                        <td class="action">

                            <a href="#"><i class="fa fa-pencil"></i> Edit</a>

                            <a href="#" class="delete"><i class="fa fa-remove"></i> Delete</a>

                        </td>

                    </tr>

                    <tr>

                        <td class="title-container">

                            <img src="img/13090.jpg" alt="my-properties-3" class="img-responsive hidden-xs">

                            <div class="title">

                                <h4><a href="#">beautiful  Family  home </a></h4>

                                <span><i class="fa fa-map-marker"></i> 123 Kathal St. Tampa City, </span>

                                <span class="table-property-price">$900 / monthly</span>

                            </div>

                        </td>

                        <td class="expire-date hidden-xs">April 28 2018</td>

                        <td class="action">

                            <a href="#"><i class="fa fa-pencil"></i> Edit</a>

                            <a href="#" class="delete"><i class="fa fa-remove"></i> Delete</a>

                        </td>

                    </tr>

                    <tr>

                        <td class="title-container">

                            <img src="img/13090.jpg" alt="my-properties-4" class="img-responsive hidden-xs">

                            <div class="title">

                                <h4><a href="#">beautiful  Family  home </a></h4>

                                <span><i class="fa fa-map-marker"></i> 123 Kathal St. Tampa City, </span>

                                <span class="table-property-price">$900 / monthly</span>

                            </div>

                        </td>

                        <td class="expire-date hidden-xs">April 28 2018</td>

                        <td class="action">

                            <a href="#"><i class="fa fa-pencil"></i> Edit</a>

                            <a href="#" class="delete"><i class="fa fa-remove"></i> Delete</a>

                        </td>

                    </tr>

                    <tr>

                        <td class="title-container">

                            <img src="img/13090.jpg" alt="my-properties-5" class="img-responsive hidden-xs">

                            <div class="title">

                                <h4><a href="#">beautiful  Family  home </a></h4>

                                <span><i class="fa fa-map-marker"></i> 123 Kathal St. Tampa City, </span>

                                <span class="table-property-price">$900 / monthly</span>

                            </div>

                        </td>

                        <td class="expire-date hidden-xs">April 28 2018</td>

                        <td class="action">

                            <a href="#"><i class="fa fa-pencil"></i> Edit</a>

                            <a href="#" class="delete"><i class="fa fa-remove"></i> Delete</a>

                        </td>

                    </tr>-->

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<div class="counters overview-bgi">

    <div class="container">

        <div class="row">

            <div class="col-md-3 col-sm-6 bordered-right">

                <div class="counter-box">

                    <i class="flaticon-tag"></i>

                    <h1 class="counter">967</h1>

                    <p>Listings For Sale</p>

                </div>

            </div>

            <div class="col-md-3 col-sm-6 bordered-right">

                <div class="counter-box">

                    <i class="flaticon-symbol-1"></i>

                    <h1 class="counter">1276</h1>

                    <p>Listings For Rent</p>

                </div>

            </div>

            <div class="col-md-3 col-sm-6 bordered-right">

                <div class="counter-box">

                    <i class="flaticon-people"></i>

                    <h1 class="counter">396</h1>

                    <p>Agents</p>

                </div>

            </div>

            <div class="col-md-3 col-sm-6">

                <div class="counter-box">

                    <i class="flaticon-people-1"></i>

                    <h1 class="counter">177</h1>

                    <p>Brokers</p>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include('includes/footer.php'); ?>

<?php include('includes/foot.php'); ?>

</body>

</html>