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
<link href="<?php echo BASE_URLD; ?>assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
<link href="<?php echo BASE_URLD; ?>assets/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="<?php echo BASE_URLD; ?>assets/css/core.css" rel="stylesheet" type="text/css">
<link href="<?php echo BASE_URLD; ?>assets/css/components.css" rel="stylesheet" type="text/css">
<link href="<?php echo BASE_URLD; ?>assets/css/colors.css" rel="stylesheet" type="text/css">
<!-- /global stylesheets -->
<!-- Core JS files -->
<script type="text/javascript" src="<?php echo BASE_URLD; ?>assets/js/plugins/loaders/pace.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URLD; ?>assets/js/core/libraries/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URLD; ?>assets/js/core/libraries/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URLD; ?>assets/js/plugins/loaders/blockui.min.js"></script>
<!-- /core JS files -->
</head>
<body>
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
			<a class="navbar-brand" href="index.html"><img src="<?php echo BASE_URLD; ?>assets/images/logo_light.png" alt=""></a>

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
						<span>Victoria</span>
						<i class="caret"></i>
					</a>

					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="#"><i class="icon-user-plus"></i> My profile</a></li>
				<!--		<li><a href="#"><i class="icon-coins"></i> My balance</a></li>-->
					<!--	<li><a href="#"><span class="badge bg-teal-400 pull-right">58</span> <i class="icon-comment-discussion"></i> Messages</a></li>-->
						<li class="divider"></li>
						<li><a href="#"><i class="icon-cog5"></i> Account settings</a></li>
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
      <li <?php if($menuTrigger == 'users' || $menuTrigger == 'merchant_request' || $menuTrigger == 'add_user' ){?>class="active"<?php }?>> <a href="#"><i class="icon-users"></i> <span>Registered Users
        <!--<span class="label bg-blue-400">1.3</span>-->
        </span></a>
		<ul>
          <li <?php if($menuTrigger == 'users'){?>class="active"<?php }?>><a href="<?=site_url('Dashboard/users');?>">All Users</a></li>
          <li <?php if($menuTrigger == 'merchant_request'){?>class="active"<?php }?>><a href="<?=site_url('Dashboard/merchant_request');?>">Merchant Requests</a></li>
		  <li <?php if($menuTrigger == 'add_user'){?>class="active"<?php }?>><a href="<?=site_url('Dashboard/add_user');?>">Add User</a></li>
        </ul>
		 </li>
		<li <?php if($menuTrigger == 'subscribers'){?>class="active"<?php }?>> <a href="<?=site_url('Dashboard/subscribers');?>" onClick="window.location='<?=site_url('Dashboard/Users');?>'"><i class="icon-user"></i> <span>Subscribers
        <!--<span class="label bg-blue-400">1.3</span>-->
        </span></a> </li>
		<li <?php if($menuTrigger == 'categories' || $menuTrigger == 'add_category'){?>class="active"<?php }?>> <a href="#"><i class="icon-grid"></i> <span>Manage Categories
        <!--<span class="label bg-blue-400">1.3</span>-->
        </span></a>
        <ul>
          <li <?php if($menuTrigger == 'categories'){?>class="active"<?php }?>><a href="<?=site_url('Dashboard/categories');?>">Categories</a></li>
          <li <?php if($menuTrigger == 'add_category'){?>class="active"<?php }?>><a href="<?=site_url('Dashboard/add_category');?>">Add Category</a></li>
        </ul>
      </li>
	  <li <?php if($menuTrigger == 'places' || $menuTrigger == 'add_place' || $menuTrigger == 'localities' || $menuTrigger == 'add_locality'){?>class="active"<?php }?>> <a href="#"><i class="icon-pin"></i> <span>Manage Places
        <!--<span class="label bg-blue-400">1.3</span>-->
        </span></a>
        <ul>
          <li <?php if($menuTrigger == 'places'){?>class="active"<?php }?>><a href="<?=site_url('Dashboard/places');?>">Places</a></li>
          <li <?php if($menuTrigger == 'add_place'){?>class="active"<?php }?>><a href="<?=site_url('Dashboard/add_place');?>">Add Place</a></li>
          <li <?php if($menuTrigger == 'localities'){?>class="active"<?php }?>><a href="<?=site_url('Dashboard/localities');?>">Localities</a></li>
          <li <?php if($menuTrigger == 'add_locality'){?>class="active"<?php }?>><a href="<?=site_url('Dashboard/add_locality');?>">Add Locality</a></li>		  
        </ul>
      </li>
      <li <?php if($menuTrigger == 'products' || $menuTrigger == 'add_product'){?>class="active"<?php }?>> <a href="#"><i class="icon-cart-add"></i> <span>Manage Products
        <!--<span class="label bg-blue-400">1.3</span>-->
        </span></a>
        <ul>
          <li <?php if($menuTrigger == 'products'){?>class="active"<?php }?>><a href="<?=site_url('Dashboard/products');?>">Products</a></li>
          <li <?php if($menuTrigger == 'add_product'){?>class="active"<?php }?>><a href="<?=site_url('Dashboard/add_product');?>">Add Product</a></li>
        </ul>
      </li>
      <li <?php if($menuTrigger == 'offers' || $menuTrigger == 'recomonded' || $menuTrigger == 'offers_plan' || $menuTrigger == 'add_offer'){?>class="active"<?php }?>> <a href="#"><i class="icon-gift"></i> <span>Manage Offers
        <!--<span class="label bg-blue-400">1.3</span>-->
        </span></a>
        <ul>
          <li <?php if($menuTrigger == 'offers'){?>class="active"<?php }?>><a href="<?=site_url('Dashboard/offers');?>">Offers</a></li>
		   <li <?php if($menuTrigger == 'add_offer'){?>class="active"<?php }?>><a href="<?=site_url('Dashboard/add_offer');?>">Add Offer</a></li>
          <li <?php if($menuTrigger == 'recomonded'){?>class="active"<?php }?>><a href="<?=site_url('Dashboard/recomonded');?>">Recomonded</a></li>
		  <li <?php if($menuTrigger == 'offers_plan'){?>class="active"<?php }?>><a href="<?=site_url('Dashboard/offers_plan');?>">Sponser Plan</a></li>
        </ul>
      </li>
      <li <?php if($menuTrigger == 'contents' || $menuTrigger == 'add_contant'){?>class="active"<?php }?>> <a href="#"><i class="icon-sphere"></i> <span>Manage Contents
        <!--<span class="label bg-blue-400">1.3</span>-->
        </span></a>
        <ul>
          <li <?php if($menuTrigger == 'contents'){?>class="active"<?php }?>><a href="<?=site_url('Dashboard/contents');?>">All Contents</a></li>
          <li <?php if($menuTrigger == 'add_contant'){?>class="active"<?php }?>><a href="<?=site_url('Dashboard/add_content');?>">Add Content</a></li>
        </ul>
      </li>
	        <li <?php if($menuTrigger == 'email_notification' || $menuTrigger == 'push_notification'){?>class="active"<?php }?>> <a href="#"><i class="icon-bell2"></i> <span>Manage Notification
        
        </span></a>
        <ul>
          <li <?php if($menuTrigger == 'email_notification'){?>class="active"<?php }?>><a href="<?=site_url('Dashboard/email_notification');?>">Email Notification</a></li>
          <li <?php if($menuTrigger == 'push_notification'){?>class="active"<?php }?>><a href="<?=site_url('Dashboard/push_notification');?>">Push Notification</a></li>
        </ul>
      </li>
    </ul>
  </div>
</div>

        <!-- /main navigation -->
      </div>
    </div>
    <!-- /main sidebar -->
