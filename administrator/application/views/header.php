<?php
$menuTrigger = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dashboard | <?php echo SITE_NAME; ?></title>
<!-- Global stylesheets -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
<link href="http://realestate.indiainfosystem.com/administrator/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
<link href="http://realestate.indiainfosystem.com/administrator/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="http://realestate.indiainfosystem.com/administrator/assets/css/core.css" rel="stylesheet" type="text/css">
<link href="http://realestate.indiainfosystem.com/administrator/assets/css/components.css" rel="stylesheet" type="text/css">
<link href="http://realestate.indiainfosystem.com/administrator/assets/css/colors.css" rel="stylesheet" type="text/css">
<!-- /global stylesheets -->
<!-- Core JS files -->
<script type="text/javascript" src="http://realestate.indiainfosystem.com/administrator/assets/js/plugins/loaders/pace.min.js"></script>
<script type="text/javascript" src="http://realestate.indiainfosystem.com/administrator/assets/js/core/libraries/jquery.min.js"></script>
<script type="text/javascript" src="http://realestate.indiainfosystem.com/administrator/assets/js/core/libraries/bootstrap.min.js"></script>
<script type="text/javascript" src="http://realestate.indiainfosystem.com/administrator/assets/js/plugins/loaders/blockui.min.js"></script>
<!-- /core JS files -->
</head>
<body><!---->
<!-- Main navbar -->
<style>
.label.label-success, .label.label-default {
    cursor: pointer;
}
</style>
<style>

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 9999; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
}

/* Caption of Modal Image */
#caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
}

/* Add Animation */
.modal-content, #caption {    
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
    from {-webkit-transform:scale(0)} 
    to {-webkit-transform:scale(1)}
}

@keyframes zoom {
    from {transform:scale(0)} 
    to {transform:scale(1)}
}

/* The Close Button */
.close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
}

.close:hover,
.close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}

.td-exp{
	width: 110px !important;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
    .modal-content {
        width: 100%;
    }
}
</style>
<div class="navbar navbar-inverse">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.html"><img src="http://realestate.indiainfosystem.com/img/logos/logo.png" alt=""></a>

			<ul class="nav navbar-nav visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
				<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav">
				<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>

			<p class="navbar-text"><span class="label bg-success">Online</span></p>

			<ul class="nav navbar-nav navbar-right">
				

				<li class="dropdown dropdown-user">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<img src="<?php echo BASE_URLD; ?>assets/images/placeholder.jpg" alt="">
						<span><?php echo SITE_NAME; ?></span>
						<i class="caret"></i>
					</a>

					<ul class="dropdown-menu dropdown-menu-right">
						<!--<li><a href="#"><i class="icon-user-plus"></i> My profile</a></li>-->
				<!--		<li><a href="#"><i class="icon-coins"></i> My balance</a></li>-->
					<!--	<li><a href="#"><span class="badge bg-teal-400 pull-right">58</span> <i class="icon-comment-discussion"></i> Messages</a></li>-->
						<li class="divider"></li>
						<!--<li><a href="#"><i class="icon-cog5"></i> Account settings</a></li>-->
						<li><a href="<?php echo site_url('Login/logout');?>"><i class="icon-switch2"></i> Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
<!-- /main navbar -->
<!-- Page container -->
<div class="page-container">
  <!-- Page content -->
  <div class="page-content">
    <!-- Main sidebar -->
    <div class="sidebar sidebar-main">
      <div class="sidebar-content">
        <!-- User menu -->
        <div class="sidebar-user">
          <div class="category-content">
            <div class="media"> <a href="#" class="media-left"><img src="<?php echo BASE_URLD; ?>assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></a>
              <div class="media-body"> <span class="media-heading text-semibold">
                <?php //$_SESSION['username'];?>
                </span>
                <div class="text-size-mini text-muted"> <i class="icon-pin text-size-small"></i> &nbsp;
                  <?php //$_SESSION['event_user_email'];?>
                </div>
              </div>
              <div class="media-right media-middle">
                <ul class="icons-list">
                  <li> <a href="#"><i class="icon-cog3"></i></a> </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <!-- /user menu -->
        <!-- Main navigation -->
		<?php 
		if($this->uri->segment(2) === FALSE){
        	$menuTrigger = '';
		}else{
			$menuTrigger = $this->uri->segment(2);
		}
		?>
        <div class="sidebar-category sidebar-category-visible">
  <div class="category-content no-padding">
    <ul class="navigation navigation-main navigation-accordion">
      <!-- Main -->
      <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
      <li <?php if($menuTrigger == ''){?>class="active"<?php }?>><a href="<?=site_url('Dashboard');?>"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
	  <li <?php if($menuTrigger == 'users' || $menuTrigger == 'merchant_request' || $menuTrigger == 'add_user' ){?>class="active"<?php }?>> <a href="#"><i class="icon-users"></i> <span> Banner Management<!--<span class="label bg-blue-400">1.3</span>--></span></a>
		<ul>
          <li <?php if($menuTrigger == 'users'){?>class="active"<?php }?>><a href="<?=site_url('Dashboard/users');?>">All Slides</a></li>
		  <li <?php if($menuTrigger == 'add_user'){?>class="active"<?php }?>><a href="<?=site_url('Dashboard/add_user');?>">Add Slide</a></li>
        </ul>
		 </li>
      <li <?php if($menuTrigger == 'users' || $menuTrigger == 'merchant_request' || $menuTrigger == 'add_user' ){?>class="active"<?php }?>> <a href="#"><i class="icon-users"></i> <span> User Management<!--<span class="label bg-blue-400">1.3</span>--></span></a>
		<ul>
          <li <?php if($menuTrigger == 'users'){?>class="active"<?php }?>><a href="<?=site_url('Dashboard/users');?>">All Users</a></li>
		  <li <?php if($menuTrigger == 'add_user'){?>class="active"<?php }?>><a href="<?=site_url('Dashboard/add_user');?>">Add User</a></li>
        </ul>
		 </li>
		      <li <?php if($menuTrigger == 'sub_admins' || $menuTrigger == 'add_sub_admin' ){?>class="active"<?php }?>> <a href="#"><i class="icon-users"></i> <span>Agent/ Owner Management
        <!--<span class="label bg-blue-400">1.3</span>-->
        </span></a>
		<ul>
          <li <?php if($menuTrigger == 'sub_admins'){?>class="active"<?php }?>><a href="<?=site_url('Dashboard/sub_admins');?>">Agent/ Owner List
 </a></li>
		  <li <?php if($menuTrigger == 'add_sub_admin'){?>class="active"<?php }?>><a href="<?=site_url('Dashboard/add_sub_admin');?>">Add New</a></li>
<li <?php if($menuTrigger == 'add_sub_admin'){?>class="active"<?php }?>><a href="<?=site_url('Dashboard/add_sub_admin');?>">Account Request Pending</a></li>
<li <?php if($menuTrigger == 'add_sub_admin'){?>class="active"<?php }?>><a href="<?=site_url('Dashboard/add_sub_admin');?>">Property Listing Pending</a></li>
        </ul>
		 </li>
		<li <?php if($menuTrigger == 'users' || $menuTrigger == 'merchant_request' || $menuTrigger == 'add_user' ){?>class="active"<?php }?>> <a href="#"><i class="icon-users"></i> <span> Equiry Management<!--<span class="label bg-blue-400">1.3</span>--></span></a>
		<!--<ul>
          <li <?php if($menuTrigger == 'users'){?>class="active"<?php }?>><a href="<?=site_url('Dashboard/users');?>">All Users</a></li>
		  <li <?php if($menuTrigger == 'add_user'){?>class="active"<?php }?>><a href="<?=site_url('Dashboard/add_user');?>">Add User</a></li>
        </ul>-->
		 </li>
		<li <?php if($menuTrigger == 'categories' || $menuTrigger == 'add_category'){?>class="active"<?php }?>> <a href="#"><i class="icon-grid"></i> <span>Reveiws/ Testimonials 
        <!--<span class="label bg-blue-400">1.3</span>-->
        </span></a>
        <ul>
          <li <?php if($menuTrigger == 'categories'){?>class="active"<?php }?>><a href="<?=site_url('Dashboard/categories');?>">All Testimonials</a></li>
          <li <?php if($menuTrigger == 'add_category'){?>class="active"<?php }?>><a href="<?=site_url('Dashboard/add_category');?>">Add Testimonial</a></li>
        </ul>
      </li>
	<li <?php if($menuTrigger == 'users' || $menuTrigger == 'merchant_request' || $menuTrigger == 'add_user' ){?>class="active"<?php }?>> <a href="#"><i class="icon-users"></i> <span> Brand Partner Management<!--<span class="label bg-blue-400">1.3</span>--></span></a>
		<ul>
          <li <?php if($menuTrigger == 'users'){?>class="active"<?php }?>><a href="<?=site_url('Dashboard/users');?>">All brand Partner</a></li>
		  <li <?php if($menuTrigger == 'add_user'){?>class="active"<?php }?>><a href="<?=site_url('Dashboard/add_user');?>">Add brand Partner</a></li>
        </ul>
		 </li>

    </ul>
  </div>
</div>

        <!-- /main navigation -->
      </div>
    </div>
    <!-- /main sidebar -->
