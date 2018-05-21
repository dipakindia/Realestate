<?php 
include('includes/config.php');
include('includes/login-check.php'); ?>
<?php 

/*	echo '<pre>';
	print_r($_SESSION);
	die;*/
	$row = array();
	$userId = $_SESSION['user_id'];
	$sql = mysql_query("SELECT * FROM `tbl_user_records` WHERE `id` = '".$userId."'");
	if(mysql_num_rows($sql) > 0){
		$row = mysql_fetch_object($sql);
	}else{
		session_destroy();
		header("Location: login.php");
	}
	if(isset($_POST['sign_submit'])){ 
	extract($_POST);
	//echo "UPDATE `tbl_user_records` SET `first_name`='".$first_name."',`last_name`='".$last_name."',`about`='".$about."',`business_name`='".$business_name."',`mobile`='".$mobile."',`updated_on`='".date("Y-m-d h:i:s")."' WHERE `id` = '".$userId."'";
	//die;
		$sqlUpdate = mysql_query("UPDATE `tbl_user_records` SET `first_name`='".$first_name."',`last_name`='".$last_name."',`about`='".$about."',`business_name`='".$business_name."',`mobile`='".$mobile."',`updated_on`='".date("Y-m-d h:i:s")."' WHERE `id` = '".$userId."'");
		if($sqlUpdate){
				$success = "User successfully updated!.";
			}else{
				$error = "Error in updation!!";
			}
	}
?><!DOCTYPE html>
<html lang="zxx">
<head>
    <title>Admin Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
<?php include('includes/head.php'); ?>
</head>
<body>
<div class="page_loader"></div>
<?php include('includes/header.php'); ?>
<div class="sub-banner overview-bgi">
    <div class="overlay">
        <div class="container">
            <div class="breadcrumb-area">
                <h1>My Profile</h1>
                <ul class="breadcrumbs">
                    <li><a href="index.php">Home</a></li>
                    <li class="active">My Profile</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="content-area my-profile">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <!-- User account box start -->
                <?php include('includes/user_profile_box.php'); ?>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="my-address">
                    <div class="main-title-2">
                        <h1><span>My</span> Profile</h1>
                    </div>
                    <?php if($error){ ?>
					<div class="error-msg"><?php echo $error; ?></div>
					<?php } ?>
					<?php if($success){ ?>
					<div class="success-msg"><?php echo $success; ?></div>
					<?php } ?>
					<form action="" method="post">
                        <div class="form-group">
                            <label>FIrst Name</label>
                            <input type="text" class="input-text" name="first_name" placeholder="Enter first name" value="<?php echo $row->first_name; ?>">
                        </div>
						<div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="input-text" name="last_name" placeholder="Enter Last name" value="<?php echo $row->last_name; ?>">
                        </div>
                        <div class="form-group">
                            <label>Your Title</label>
                            <input type="text" class="input-text" name="business_name" placeholder="Your title" value="<?php echo $row->business_name; ?>">
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" class="input-text" name="mobile" placeholder="Enter mobile no" value="<?php echo $row->mobile; ?>">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="input-text" name="email" value="<?php echo $row->email_id; ?>" disabled="disabled" >
                        </div>
                        <div class="form-group">
                            <label>About Me</label>
                            <textarea class="input-text" name="about" placeholder=""><?php echo $row->about; ?></textarea>
                        </div>
                        <button type="submit" name="sign_submit" class="btn button-md button-theme">Save Changes</button>
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