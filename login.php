<?php include('includes/config.php');
	$error = '';
if(isset($_POST['login_submit'])){
	//echo '<pre>';
	//print_r($_POST);

	$sql = mysql_query("SELECT * FROM `tbl_user_records` WHERE `email_id` = '".$_POST['email']."' AND `password` = '".$_POST['password']."' AND `status` = '1'");
	if(mysql_num_rows($sql) > 0){
		$row = mysql_fetch_object($sql);
		//print_r($row);
		$_SESSION['isLogin'] = true;
		$_SESSION['user_id'] = $row->id;
		$_SESSION['userData'] = array(
			"first_name" => $row->first_name, 
			"last_name" => $row->last_name, 
			"email" => $row->email_id,
			"mobile" => $row->mobile
		);
		if($row->is_merchant == 1){
			$_SESSION['isAgent'] = true;
			header("location: user-profile.php");
			/*//echo '<script>window.location = "my_profile.php";</script>';
			//exit();*/
		}else{
			$_SESSION['isAgent'] = false;
			header("location: index.php");
			/*echo "<script>window.location = 'index.php';</script>";
			exit();*/
		}
	}else{
		$error = "Invalid Login Details";
	}
}
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
<?php include('includes/head.php'); ?>
</head>
<body>
<div class="page_loader"></div>
<div class="content-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="form-content-box">
                    <div class="details">
                        <div class="main-title">
                            <h1>Login</h1>
                        </div>
						<?php if($error){ ?><div class="error-msg"><?php echo $error; ?></div><?php } ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <input type="email" name="email" class="input-text" placeholder="Email Address">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="input-text" placeholder="Password">
                            </div>
                            <div class="checkbox">
                                <div class="ez-checkbox pull-left">
                                    <label>
                                        <input type="checkbox" class="ez-hide">
                                        Remember me
                                    </label>
                                </div>
                                <a href="forgot-password.php" class="link-not-important pull-right">Forgot Password</a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="login_submit" class="button-md button-theme btn-block">login</button>
                            </div>
                        </form>
                    </div>
                    <div class="footer">
                        <span>
                            New Here? <a href="signup.php">Sign up now</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
<script src="js/ie10-viewport-bug-workaround.js"></script>
<script src="js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>