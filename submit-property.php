<?php 
include('includes/config.php');
include('login-check-owner.php');
$error = $success = '';
if(isset($_POST['sign_submit'])){
	//echo '<pre>';
	//print_r($_POST);die;
		extract($_POST);
		$userId = $_SESSION['user_id'];
		
		$insertSql = mysql_query("INSERT INTO `tbl_product_records`(
		`user_id`, 
		`product_title`, 
		`price`,  
		`product_description`, 
		`features_ids`, 
		`added_date`, 
		`property_type`, 
		`property_status`, 
		`area`, 
		`area_unit`, 
		`rooms`, 
		`bathrooms`, 
		`parking`, 
		`balcony`,		
		`address`, 
		`city_id`, 
		`state_id`, 
		`postal_code`, 
		`building_age`,
		`name`,
		`email`,
		`phone`,
		`bathroom_optional`,
		`room_optional`
		) VALUES (
		'".$userId."',
		'".$product_title."',
		'".$property_price."',
		'".$property_description."',
		'".implode(',',$features)."',
		'".date("Y-m-d h:i:s")."',
		'".$property_type."',
		'".$property_status."',
		'".$property_area."',
		'',
		'".$rooms."',
		'".$bathrooms."',
		'".$parking."',	
		'".$balcony."',	
		'".$address."',
		'".$city."',
		'".$state."',
		'".$pincode."',
		'".$property_age."',
		'".$name."',
		'".$email."',
		'".$phone."',
		'".$bathroom_opt."',
		'".$room_opt."'
		)");
		if($insertSql){
			$success = "User successfully registered. please check your mail for verify!.";
		}else{
			$error = "Error in registration!!";
		}
}
?><!DOCTYPE html>
<html lang="zxx">
<head>
    <title>Submit Property</title>
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
                <h1>Submit Property</h1>
                <ul class="breadcrumbs">
                    <li><a href="index.html">Home</a></li>
                    <li class="active">Submit Property</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="content-area-7 submit-property">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="notification-box">
                    <h3>Don't Have an Account?</h3>
                    <p>Submit your property here and we will get back to you.</p>
                </div>
            </div>
            <div class="col-md-12">
                <div class="submit-address">
            <?php if($error){ ?>
            	<div class="error-msg"><?php echo $error; ?></div>
            <?php } ?>
			<?php if($success){ ?>
            	<div class="success-msg"><?php echo $success; ?></div>
            <?php } ?>
            <form action="" method="post">
                        <div class="main-title-2">
                            <h1><span>Basic</span> Information</h1>
                        </div>
                        <div class="search-contents-sidebar mb-30">
                            <div class="form-group">
                                <label>Property Title</label>
                                <input type="text" class="input-text" required name="product_title" placeholder="Property Title">
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="selectpicker search-fields" required name="property_status">
                                            <option>For Sale</option>
                                            <option>For Rent</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label>Type</label>
                                        <select class="selectpicker search-fields" name="property_type" required>
										<?php  $property_type_sql = mysql_query("SELECT * FROM `tbl_property_type_records` WHERE `status` = '1'");
										   if(mysql_num_rows($property_type_sql) > 0){
										   while($pt_row = mysql_fetch_object($property_type_sql)){
									 ?><option value="<?php echo $pt_row->property_type_id; ?>"><?php echo $pt_row->property_type_name; ?></option> 
										<?php }} ?>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-6">
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="text" required class="input-text" name="property_price" placeholder="USD">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="form-group">
                                        <label>Area/Location</label>
                                        <input type="text" required class="input-text" name="property_area" placeholder="SqFt">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="form-group">
                                        <label>Rooms</label>
                                        <select class="selectpicker search-fields" name="rooms" required>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="form-group">
                                        <label>Bathroom</label>
                                        <select class="selectpicker search-fields" name="bathrooms" required>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
							<div class="row">
                                <div class="col-md-3 col-sm-6">
                                    <div class="form-group">
                                        <label>Parking</label>
                                        <select class="selectpicker search-fields" name="parking" required>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="form-group">
                                        <label>Balcony</label>
                                        <select class="selectpicker search-fields" name="balcony" required>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="main-title-2">
                            <h1><span>Property</span> Gallery</h1>
                        </div>
                        <div id="myDropZone" class="dropzone dropzone-design mb-50">
                            <div class="dz-default dz-message"><span>Drop files here to upload</span></div>
                        </div>
                        <div class="main-title-2">
                            <h1><span>Location</span></h1>
                        </div>
                        <div class="row mb-30 ">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="input-text" name="address" required placeholder="Address">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label>City</label>

                                    <select class="selectpicker search-fields" name="city" required data-live-search="true" data-live-search-placeholder="Search value">
                                        <option>Choose City</option>
                                        <option>Ontario</option>
                                        <option>Quebec</option>
                                        <option>British Columbia</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label>State</label>
                                    <select class="selectpicker search-fields" name="state" required data-live-search="true" data-live-search-placeholder="Search value">
                                        <option>Choose State</option>
                                        <option>Canada</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label>City</label>
                                    <select class="selectpicker search-fields" name="city" data-live-search="true" data-live-search-placeholder="Search value">
                                        <option>Choose City</option>
                                        <option>Ontario</option>
                                        <option>Quebec</option>
                                        <option>British Columbia</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label>Postal Code</label>
                                    <input type="text" class="input-text" name="pincode" required placeholder="Postal Code">
                                </div>
                            </div>
                        </div>

                        <div class="main-title-2">
                            <h1><span>Detailed</span> Information</h1>
                        </div>
                        <div class="row mb-30">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Detailed Information</label>
                                    <textarea class="input-text" name="property_description" required placeholder="Detailed Information"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-30">
                            <div class="col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label>Building Age <span>(optional)</span></label>
                                    <select class="selectpicker search-fields" name="property_age">
                                        <option>0-1 Years</option>
                                        <option>0-5 Years</option>
                                        <option>0-10 Years</option>
                                        <option>0-20 Years</option>
                                        <option>0-40 Years</option>
                                        <option>40+Years</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label>Bedrooms (optional)</label>
                                    <select class="selectpicker search-fields" name="bedroom_optional">
                                                        <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label>Bathrooms (optional)</label>
                                    <select class="selectpicker search-fields" name="bathroom_optional">
                                                                   <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label class="margin-t-10">Features (optional)</label>
                                <div class="row">
                                    
									<?php  $feature_sql = mysql_query("SELECT * FROM `tbl_feature_records` WHERE `status` = '1'");
										   if(mysql_num_rows($feature_sql) > 0){
										   while($f_row = mysql_fetch_object($feature_sql)){
									 ?><div class="col-lg-4 col-sm-4 col-xs-12">
                                        <div class="checkbox checkbox-theme checkbox-circle">
                                            <input id="checkbox<?=$f_row->feature_id;?>" type="checkbox" name="features[]" value="<?php echo $f_row->feature_id; ?>">
                                            <label for="checkbox<?=$f_row->feature_id;?>">
                                                <?php echo $f_row->feature_name; ?>
                                            </label>
                                        </div>
										</div>
										<?php }} ?>
                                     
                                    
                                </div>
                            </div>
                        </div>
                        <div class="main-title-2">
                            <h1><span>Contact</span> Details</h1>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="input-text" required name="contact_name" placeholder="Name">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="input-text" required name="contact_email" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label>Phone (optional)</label>
                                    <input type="text" class="input-text" name="contact_phone" placeholder="Phone">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" name="sign_submit" class="btn button-md button-theme">Submit</button>
                            </div>
                        </div>
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