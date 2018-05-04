<?php
//print_r($this->session->userdata());
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login Page | <?php echo SITE_NAME; ?></title>
<!-- Global stylesheets -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
<link href="http://realestate.indiainfosystem.com/administrator/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
<link href="http://realestate.indiainfosystem.com/administrator/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="http://realestate.indiainfosystem.com/administrator/assets/css/core.css" rel="stylesheet" type="text/css">
<link href="http://realestate.indiainfosystem.com/administrator/assets/css/components.css" rel="stylesheet" type="text/css">
<link href="http://realestate.indiainfosystem.com/administrator/assets/css/colors.css" rel="stylesheet" type="text/css">
<!-- /global stylesheets -->
<!-- Core JS files -->
<!--	<script type="text/javascript" src="assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/loaders/blockui.min.js"></script>-->
<!-- /core JS files -->
<!-- Theme JS files -->
<!--<script type="text/javascript" src="assets/js/core/app.js"></script>-->
<!-- /theme JS files -->
</head>
<body class="login-container">
<!-- Main navbar -->
<div class="navbar navbar-inverse">
  <div class="navbar-header"> <a class="navbar-brand" href="index.html">Canada Lettings</a>
    <ul class="nav navbar-nav pull-right visible-xs-block">
      <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
    </ul>
  </div>
</div>
<!-- /main navbar -->
<!-- Page container -->
<div class="page-container">
  <!-- Page content -->
  <div class="page-content">
    <!-- Main content -->
    <div class="content-wrapper">
      <?php /*?><?php if($_SESSION['succ_msg']!=''){ ?><div class="alert alert-success><?php echo $_SESSION['succ_msg']; ?></div><?php } unset($_SESSION['succ_msg']);?><?php if($_SESSION['err_msg']!=''){ ?><div class="alert alert-warning"><?php echo $_SESSION['err_msg']; ?></div><?php } unset($_SESSION['err_msg']);?><?php */?>
      <!-- Content area -->
      <div class="content">
        <!-- Simple login form -->
        <form action="" method="post" name="LoginForm">
          <div class="panel panel-body login-form">
            <div class="text-center">
              <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
              <h5 class="content-group">Login to your account <small class="display-block">Enter your credentials below</small></h5>
			  <?php if (validation_errors()) : ?>
			<div class="col-md-12">
				<div class="alert alert-danger" role="alert">
					<?= validation_errors() ?>
				</div>
			</div>
		<?php endif; ?>
		<?php if (isset($error)) : ?>
			<div class="col-md-12">
				<div class="alert alert-danger" role="alert">
					<?= $error ?>
				</div>
			</div>
		<?php endif; ?>
		<div style="clear:both;">
            </div>
			
            <div class="form-group has-feedback has-feedback-left">
              <input type="text" class="form-control" id="username" name="username" placeholder="Username">
              <div class="form-control-feedback"> <i class="icon-user text-muted"></i> </div>
            </div>
            <div class="form-group has-feedback has-feedback-left">
              <input type="password" class="form-control" id="password" name="password" placeholder="Password">
              <div class="form-control-feedback"> <i class="icon-lock2 text-muted"></i> </div>
            </div>
            <div class="form-group">
              <button type="submit" name="login_button" class="btn btn-primary btn-block btn-danger">Sign in <i class="icon-circle-right2 position-right"></i></button>
            </div>
            <div class="text-center"> <a href="<?=site_url();?>/forgot_password">Forgot password?</a> </div>
          </div>
        </form>
        <!-- /simple login form -->
        <!-- Footer -->
       <?php /*?> <div class="footer text-muted text-center"> &copy;
          <?=date("Y")?>
          . <a href="<?php echo BASE_URLD; ?>"><?php echo SITE_NAME; ?></a> </div><?php */?>
        <!-- /footer -->
      </div>
      <!-- /content area -->
    </div>
    <!-- /main content -->
  </div>
  <!-- /page content -->
</div>
<!-- /page container -->
</body>
</html>
