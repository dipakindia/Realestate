<header class="top-header hidden-xs" id="top">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <div class="list-inline"> <a href="tel:+1647 961 8625"><i class="fa fa-phone"></i>+1647 961 8625</a> <a href="tel:info@canadalettings.com"><i class="fa fa-envelope"></i>info@canadalettings.com</a> </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <ul class="top-social-media pull-right">
        <?php if($_SESSION['isLogin']){ ?>
          <li> <a href="user-profile.php" class="sign-in"><i class="fa fa-user"></i> My Account</a> </li>
          <li> <a href="logout.php" class="sign-in"><i class="fa fa-sign-in"></i> Logout</a> </li>
        <?php }else{ ?>
          <li> <a href="login.php" class="sign-in"><i class="fa fa-sign-in"></i> Login</a> </li>
          <li> <a href="signup.php" class="sign-in"><i class="fa fa-user"></i> Register</a> </li>
        <?php } ?>
        </ul>
      </div>
    </div>
  </div>
</header>
<header class="main-header">
  <div class="container">
    <nav class="navbar navbar-default">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navigation" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        <a href="index.php" class="logo"> <img src="img/logos/logo.png" alt="logo"> </a> </div>
      <div class="navbar-collapse collapse" role="navigation" aria-expanded="true" id="app-navigation">
        <ul class="nav navbar-nav">
          <li class="dropdown active"> <a href="index.php">Home</a> </li>
          <li class="dropdown"> <a tabindex="0" data-toggle="dropdown" data-submenu="" aria-expanded="false"> Buy<span class="caret"></span> </a>
            <ul class="dropdown-menu">
              <li><a href="#">Property For Sale</a></li>
              <li><a href="#">New Homes For Sale</a></li>
            </ul>
          </li>
          <li class="dropdown"> <a tabindex="0" data-toggle="dropdown" data-submenu="" aria-expanded="false"> Rent<span class="caret"></span> </a>
            <ul class="dropdown-menu">
              <li><a href="agent-listing-grid.php">Property To Rent</a></li>
              <li><a href="agent-listing-grid-sidebar.php">Student Property To Rent</a></li>
            </ul>
          </li>
          <li class="dropdown"> <a tabindex="0" data-toggle="dropdown" data-submenu="" aria-expanded="false"> Find Agent<span class="caret"></span> </a>
            <ul class="dropdown-menu">
              <li><a href="agent-listing-grid.php">Find Estate Agents</a></li>
            </ul>
          </li>
          <li class="dropdown"> <a tabindex="0" data-toggle="dropdown" data-submenu="" aria-expanded="false"> House Prices<span class="caret"></span> </a>
            <ul class="dropdown-menu">
              <li><a href="agent-listing-grid.php">Sold House Prices</a></li>
              <li><a href="agent-listing-grid.php">Market Trends</a></li>
            </ul>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right rightside-navbar">
          <li> <a href="submit-property.php" class="button"> Submit Property </a> </li>
        </ul>
      </div>
    </nav>
  </div>
</header>
