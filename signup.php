<?php include('includes/config.php');
$error = $success = '';
if(isset($_POST['sign_submit'])){
	//echo '<pre>';
	//print_r($_POST);
	$sql = mysql_query("SELECT * FROM `tbl_user_records` WHERE `email_id` = '".$_POST['email']."'");
	if(mysql_num_rows($sql) > 0){
		$row = mysql_fetch_object($sql);
		$error = "Email id already exists!! Please try another.";
	}else{
		
			extract($_POST);
			//die;//
			//echo "INSERT INTO `tbl_user_records`(`first_name`, `last_name`, `email_id`, `password`, `date`, `is_merchant`) VALUES ('".$first_name."','".$last_name."','".$email."','".$password."','".date("Y-m-d H:i:s")."','".$user_type."')";die;
			$insertSql = mysql_query("INSERT INTO `tbl_user_records`(`first_name`, `last_name`, `email_id`, `password`, `date`, `is_merchant`) VALUES ('".$first_name."','".$last_name."','".$email."','".$password."','".date("Y-m-d H:i:s")."','".$user_type."')");
			if($insertSql){
				$to = $email;
				$subject = "Your Canada Latting account confirmation!!";
				
				$message = '<html>
<head>
<title>HTML email</title>
</head>
<body>
<table>
  <tbody>
    <tr>
      <td>Dear '.$first_name.',</td>
    </tr>
    <tr>
      <td><br></td>
    </tr>
    <tr>
      <td>Congratulations! You have successfully regitered.</td>
    </tr>
    <tr>
      <td><br></td>
    </tr>
    <tr>
      <td>For confermation of your Account: &nbsp;<a href="http://overseastask.site/verify-email.php?user-email='.md5($email).'" >click here </a>.</td>
    </tr>
    <tr>
      <td><br></td>
    </tr>
    <tr>
      <td>Regards,</td>
    </tr>
    <tr>
      <td><strong>Canada Latting </strong></td>
    </tr>
  </tbody>
</table>
<p>&nbsp;</p>
</body>
</html>
';
				
				// Always set content-type when sending HTML email
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				
				// More headers
				$headers .= 'From: Canada Latting <info@overseastask.site>' . "\r\n";
				$headers .= 'Cc: dipak.yts@gmail.com' . "\r\n";
				
				mail($to,$subject,$message,$headers);
				$success = "User successfully registered. please check your mail for verify!.";
			}else{
				$error = "Error in registration!!";
			}
	}
}
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
<title>Signup</title>
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
              <h1><span>Signup</span></h1>
            </div>
            <?php if($error){ ?>
            <div class="error-msg"><?php echo $error; ?></div>
            <?php } ?>
			<?php if($success){ ?>
            <div class="success-msg"><?php echo $success; ?></div>
            <?php } ?>
            <form action="" method="post">
              <div class="row">
                <div class="col-lg-6" style="text-align:left">
				<div class="form-group">
                  <input type="radio" name="user_type" class="input-radio" value="0" checked="checked">
                  User 
				  </div>
				  </div>
                <div class="col-lg-6" style="text-align:left">
				<div class="form-group">
                  <input type="radio" name="user_type" class="input-radio" value="1">
                  Agent / Owner </div>
				  </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <input type="text" name="first_name" class="input-text" placeholder="First Name">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <input type="text" name="last_name" class="input-text" placeholder="Last Name">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <input type="email" name="email" class="input-text" placeholder="Email Address">
              </div>
              <div class="form-group">
                <input type="password" name="password" class="input-text" placeholder="Password">
              </div>
              <div class="form-group">
                <input type="password" name="confirm_Password" class="input-text" placeholder="Confirm Password">
              </div>
              <div class="form-group">
                <button type="submit" class="button-md button-theme btn-block" name="sign_submit">Signup</button>
              </div>
            </form>
          </div>
          <div class="footer"> <span> Already Registered? <a href="login.php">Login Here</a> </span> </div>
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
