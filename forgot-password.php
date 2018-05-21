<?php include('includes/config.php');
$error = $success = '';
if(isset($_POST['sign_submit'])){
	//echo '<pre>';
	//print_r($_POST);
		$sql = mysql_query("SELECT * FROM `tbl_user_records` WHERE `email_id` = '".$_POST['email']."'");
	if(mysql_num_rows($sql) > 0){
		$row = mysql_fetch_object($sql);
		$success = "Password successfully sent on your registered mailId.";
	}else{
		$error = "Email id not exists!! Please try another.";
	}
}
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
<title>Forgot Password</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<?php include('includes/head.php'); ?>
<!DOCTYPE html>

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
                            <h1>Forgot Password</h1>
                        </div>
                        <?php if($error){ ?>
							<div class="error-msg"><?php echo $error; ?></div>
							<?php } ?>
							<?php if($success){ ?>
							<div class="success-msg"><?php echo $success; ?></div>
							<?php } ?>
							<form action="" method="post">
                            <div class="form-group">
                                <input type="text" name="email" class="input-text" placeholder="Email Address">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="sign_submit" class="button-md button-theme btn-block">Send Me Email</button>
                            </div>
                        </form>
                    </div>
                    <div class="footer">
                        <span>
                           <a href="login.php">Return to login again</a>
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