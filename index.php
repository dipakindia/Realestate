<?php include('includes/config.php'); ?>

<!DOCTYPE html>

<html lang="zxx">

<head>

<title>Canadalettings - House | Apartment | Residential | Student Property</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta charset="utf-8">

<?php include('includes/head.php'); ?>

</head>

<body>

<div class="page_loader"></div>

<?php include('includes/header.php'); ?>

<?php include('includes/banner.php'); ?>

<!--Search area start-->

<?php //include('includes/advanced-search.php'); ?>

<!--Search area end -->

<div class="content-area featured-properties">

  <div class="container">

    <div class="main-title">

      <h1>Featured Properties</h1>

    </div>

    <ul class="list-inline-listing filters filters-listing-navigation">

      <li class="active btn filtr-button filtr" data-filter="all">All</li>

	  <?php  $product_sql = mysql_query("SELECT * FROM `tbl_property_type_records` WHERE `status` = '1'");

		   if(mysql_num_rows($product_sql) > 0){

		   while($pr_type = mysql_fetch_object($product_sql)){

	 ?>

      <li data-filter="<?php echo $pr_type->property_type_id; ?>" class="btn btn-inline filtr-button filtr"><?php echo $pr_type->property_type_name; ?></li>

	  <?php }} ?>

    </ul>

    <div class="row">

      <div class="filtr-container">

	  <?php  $product_sql = mysql_query("SELECT * FROM `tbl_product_records` WHERE `status` = '1'");

		   if(mysql_num_rows($product_sql) > 0){

		   while($product_row = mysql_fetch_object($product_sql)){

	 ?>

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12  filtr-item" data-category="<?php echo $product_row->features_ids; ?>">

          <div class="property">

            <div class="property-img">

              <div class="property-tag button alt featured">Featured</div>

              <div class="property-tag button sale"><?php echo $product_row->property_status; ?></div>

              <div class="property-price"><?php echo $product_row->property_price; ?></div>

              <img src="img/properties-1.jpg" alt="fp" class="img-responsive">

              <div class="property-overlay"> <a href="#" class="overlay-link"> <i class="fa fa-link"></i> </a>

                <div class="property-magnify-gallery"> <a href="img/properties-1.jpg" class="overlay-link"> <i class="fa fa-expand"></i> </a> <a href="img/properties-1.jpg" class="hidden"></a> <a href="img/properties-1.jpg" class="hidden"></a> </div>

              </div>

            </div>

            <div class="property-content">

              <h1 class="title"> <a href="#"><?php echo $product_row->product_price; ?></a> </h1>

              <h3 class="property-address"> <a href="#"> <i class="fa fa-map-marker"></i><?php echo $product_row->address; ?></a> </h3>

              <ul class="facilities-list clearfix">

                <li> <i class="flaticon-square-layouting-with-black-square-in-east-area"></i> <span><?php echo $product_row->area; ?> sq ft</span> </li>

                <li> <i class="flaticon-bed"></i> <span><?php echo $product_row->rooms; ?> Beds</span> </li>

                <li> <i class="flaticon-monitor"></i> <span>TV </span> </li>

                <li> <i class="flaticon-holidays"></i> <span> <?php echo $product_row->bathrooms; ?> Baths</span> </li>

                <li> <i class="flaticon-vehicle"></i> <span><?php echo $product_row->parking; ?> Garage</span> </li>

                <li> <i class="flaticon-building"></i> <span> <?php echo $product_row->balcony; ?> Balcony</span> </li>

              </ul>

              <div class="property-footer"> <span class="left"> <a href="#"><i class="fa fa-user"></i>Jhon Doe</a> </span> <span class="right"> <i class="fa fa-calendar"></i>5 Days ago </span> </div>

            </div>

          </div>

        </div>

		<?php }} ?>

		<!--

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12  filtr-item" data-category="1">

          <div class="property">

            <div class="property-img">

              <div class="property-tag button alt featured">Featured</div>

              <div class="property-tag button sale">For Sale</div>

              <div class="property-price">$150,000</div>

              <img src="img/properties-2.jpg" alt="fp" class="img-responsive">

              <div class="property-overlay"> <a href="#" class="overlay-link"> <i class="fa fa-link"></i> </a>

                <div class="property-magnify-gallery"> <a href="img/properties-2.jpg" class="overlay-link"> <i class="fa fa-expand"></i> </a> <a href="img/properties-2.jpg" class="hidden"></a> <a href="img/properties-2.jpg" class="hidden"></a> </div>

              </div>

            </div>

            <div class="property-content">

              <h1 class="title"> <a href="#">Modern Family Home</a> </h1>

              <h3 class="property-address"> <a href="#"> <i class="fa fa-map-marker"></i>123 Kathal St. Tampa City, </a> </h3>

              <ul class="facilities-list clearfix">

                <li> <i class="flaticon-square-layouting-with-black-square-in-east-area"></i> <span>4800 sq ft</span> </li>

                <li> <i class="flaticon-bed"></i> <span>3 Beds</span> </li>

                <li> <i class="flaticon-monitor"></i> <span>TV </span> </li>

                <li> <i class="flaticon-holidays"></i> <span> 2 Baths</span> </li>

                <li> <i class="flaticon-vehicle"></i> <span>1 Garage</span> </li>

                <li> <i class="flaticon-building"></i> <span> 3 Balcony</span> </li>

              </ul>

              <div class="property-footer"> <span class="left"> <a href="#"><i class="fa fa-user"></i>Jhon Doe</a> </span> <span class="right"> <i class="fa fa-calendar"></i>5 Days ago </span> </div>

            </div>

          </div>

        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12  filtr-item" data-category="2, 3">

          <div class="property">

            <div class="property-img">

              <div class="property-tag button alt featured">Featured</div>

              <div class="property-tag button sale">For Sale</div>

              <div class="property-price">$150,000</div>

              <img src="img/properties-3.jpg" alt="fp" class="img-responsive">

              <div class="property-overlay"> <a href="#" class="overlay-link"> <i class="fa fa-link"></i> </a>

                <div class="property-magnify-gallery"> <a href="img/properties-3.jpg" class="overlay-link"> <i class="fa fa-expand"></i> </a> <a href="img/properties-3.jpg" class="hidden"></a> <a href="img/properties-3.jpg" class="hidden"></a> </div>

              </div>

            </div>

            <div class="property-content">

              <h1 class="title"> <a href="#">Sweet Family Home</a> </h1>

              <h3 class="property-address"> <a href="#"> <i class="fa fa-map-marker"></i>123 Kathal St. Tampa City, </a> </h3>

              <ul class="facilities-list clearfix">

                <li> <i class="flaticon-square-layouting-with-black-square-in-east-area"></i> <span>4800 sq ft</span> </li>

                <li> <i class="flaticon-bed"></i> <span>3 Beds</span> </li>

                <li> <i class="flaticon-monitor"></i> <span>TV </span> </li>

                <li> <i class="flaticon-holidays"></i> <span> 2 Baths</span> </li>

                <li> <i class="flaticon-vehicle"></i> <span>1 Garage</span> </li>

                <li> <i class="flaticon-building"></i> <span> 3 Balcony</span> </li>

              </ul>

              <div class="property-footer"> <span class="left"> <a href="#"><i class="fa fa-user"></i>Jhon Doe</a> </span> <span class="right"> <i class="fa fa-calendar"></i>5 Days ago </span> </div>

            </div>

          </div>

        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12  filtr-item" data-category="3, 4">

          <div class="property">

            <div class="property-img">

              <div class="property-tag button alt featured">Featured</div>

              <div class="property-tag button sale">For Sale</div>

              <div class="property-price">$150,000</div>

              <img src="img/properties-4.jpg" alt="fp" class="img-responsive">

              <div class="property-overlay"> <a href="#" class="overlay-link"> <i class="fa fa-link"></i> </a>

                <div class="property-magnify-gallery"> <a href="img/properties-4.jpg" class="overlay-link"> <i class="fa fa-expand"></i> </a> <a href="img/properties-4.jpg" class="hidden"></a> <a href="img/properties-4.jpg" class="hidden"></a> </div>

              </div>

            </div>

            <div class="property-content">

              <h1 class="title"> <a href="#">Big Head House</a> </h1>

              <h3 class="property-address"> <a href="#"> <i class="fa fa-map-marker"></i>123 Kathal St. Tampa City, </a> </h3>

              <ul class="facilities-list clearfix">

                <li> <i class="flaticon-square-layouting-with-black-square-in-east-area"></i> <span>4800 sq ft</span> </li>

                <li> <i class="flaticon-bed"></i> <span>3 Beds</span> </li>

                <li> <i class="flaticon-monitor"></i> <span>TV </span> </li>

                <li> <i class="flaticon-holidays"></i> <span> 2 Baths</span> </li>

                <li> <i class="flaticon-vehicle"></i> <span>1 Garage</span> </li>

                <li> <i class="flaticon-building"></i> <span> 3 Balcony</span> </li>

              </ul>

              <div class="property-footer"> <span class="left"> <a href="#"><i class="fa fa-user"></i>Jhon Doe</a> </span> <span class="right"> <i class="fa fa-calendar"></i>5 Days ago </span> </div>

            </div>

          </div>

        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12  filtr-item" data-category="4">

          <div class="property">

            <div class="property-img">

              <div class="property-tag button alt featured">Featured</div>

              <div class="property-tag button sale">For Sale</div>

              <div class="property-price">$150,000</div>

              <img src="img/properties-5.jpg" alt="fp" class="img-responsive">

              <div class="property-overlay"> <a href="#" class="overlay-link"> <i class="fa fa-link"></i> </a>

                <div class="property-magnify-gallery"> <a href="img/properties-5.jpg" class="overlay-link"> <i class="fa fa-expand"></i> </a> <a href="img/properties-5.jpg" class="hidden"></a> <a href="img/properties-5.jpg" class="hidden"></a> </div>

              </div>

            </div>

            <div class="property-content">

              <h1 class="title"> <a href="#">Park Avenue</a> </h1>

              <h3 class="property-address"> <a href="#"> <i class="fa fa-map-marker"></i>123 Kathal St. Tampa City, </a> </h3>

              <ul class="facilities-list clearfix">

                <li> <i class="flaticon-square-layouting-with-black-square-in-east-area"></i> <span>4800 sq ft</span> </li>

                <li> <i class="flaticon-bed"></i> <span>3 Beds</span> </li>

                <li> <i class="flaticon-monitor"></i> <span>TV </span> </li>

                <li> <i class="flaticon-holidays"></i> <span> 2 Baths</span> </li>

                <li> <i class="flaticon-vehicle"></i> <span>1 Garage</span> </li>

                <li> <i class="flaticon-building"></i> <span> 3 Balcony</span> </li>

              </ul>

              <div class="property-footer"> <span class="left"> <a href="#"><i class="fa fa-user"></i>Jhon Doe</a> </span> <span class="right"> <i class="fa fa-calendar"></i>5 Days ago </span> </div>

            </div>

          </div>

        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12  filtr-item" data-category="1">

          <div class="property">

            <div class="property-img">

              <div class="property-tag button alt featured">Featured</div>

              <div class="property-tag button sale">For Sale</div>

              <div class="property-price">$150,000</div>

              <img src="img/properties-6.jpg" alt="fp" class="img-responsive">

              <div class="property-overlay"> <a href="#" class="overlay-link"> <i class="fa fa-link"></i> </a>

                <div class="property-magnify-gallery"> <a href="img/properties-6.jpg" class="overlay-link"> <i class="fa fa-expand"></i> </a> <a href="img/properties-6.jpg" class="hidden"></a> <a href="img/properties-6.jpg" class="hidden"></a> </div>

              </div>

            </div>

            <div class="property-content">

              <h1 class="title"> <a href="#">Masons Villas</a> </h1>

              <h3 class="property-address"> <a href="#"> <i class="fa fa-map-marker"></i>123 Kathal St. Tampa City, </a> </h3>

              <ul class="facilities-list clearfix">

                <li> <i class="flaticon-square-layouting-with-black-square-in-east-area"></i> <span>4800 sq ft</span> </li>

                <li> <i class="flaticon-bed"></i> <span>3 Beds</span> </li>

                <li> <i class="flaticon-monitor"></i> <span>TV </span> </li>

                <li> <i class="flaticon-holidays"></i> <span> 2 Baths</span> </li>

                <li> <i class="flaticon-vehicle"></i> <span>1 Garage</span> </li>

                <li> <i class="flaticon-building"></i> <span> 3 Balcony</span> </li>

              </ul>

              <div class="property-footer"> <span class="left"> <a href="#"><i class="fa fa-user"></i>Jhon Doe</a> </span> <span class="right"> <i class="fa fa-calendar"></i>5 Days ago </span> </div>

            </div>

          </div>

        </div>

		-->	

      </div>

    </div>

  </div>

</div>

<div class="mb-100 our-service">

  <div class="container">

    <div class="main-title">

      <h1><span>What are you</span> looking for?</h1>

    </div>

    <div class="row mgn-btm wow">

      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 wow fadeInLeft delay-04s">

        <div class="content"> <i class="flaticon-apartment"></i>

          <h4>Apartments</h4>

          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et</P>

        </div>

      </div>

      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 wow fadeInLeft delay-04s">

        <div class="content"> <i class="flaticon-internet"></i>

          <h4>Houses</h4>

          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et</P>

        </div>

      </div>

      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 wow fadeInRight delay-04s">

        <div class="content"> <i class="flaticon-apartment"></i>

          <h4>Residential</h4>

          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et</P>

        </div>

      </div>

      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 wow fadeInRight delay-04s">

        <div class="content"> <i class="flaticon-internet"></i>

          <h4>Student Space</h4>

          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et</P>

        </div>

      </div>

    </div>

    <a href="#" class="btn button-md button-theme">Read More</a> </div>

</div>

<div class="mb-70 recently-properties chevron-icon">

  <div class="container">

    <div class="main-title">

      <h1><span>Recently</span> Properties</h1>

    </div>

    <div class="row">

      <div class="carousel our-partners slide" id="ourPartners2">

        <div class="col-lg-12 mrg-btm-30"> <a class="right carousel-control" href="#ourPartners2" data-slide="prev"><i class="fa fa-chevron-left icon-prev"></i></a> <a class="right carousel-control" href="#ourPartners2" data-slide="next"><i class="fa fa-chevron-right icon-next"></i></a> </div>

        <div class="carousel-inner">

		 <?php  

		 $product_sql = mysql_query("SELECT * FROM `tbl_product_records` WHERE `status` = '1' limit 0,7");

		   if(mysql_num_rows($product_sql) > 0){

		   $a = 0;

		   while($product_row = mysql_fetch_object($product_sql)){

		   $a++;

	 ?>

          <div class="item <?php if($a == 1){ echo "active"; }?>">

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

              <div class="property-2">

                <div class="property-img">

                  <div class="featured"> Featured </div>

                  <div class="price-ratings">

                    <div class="price">$150,000</div>

                  </div>

                  <img src="img/properties-1.jpg" alt="rp" class="img-responsive">

                  <div class="property-overlay"> <a href="#" class="overlay-link"> <i class="fa fa-link"></i> </a>

                    <div class="property-magnify-gallery"> <a href="img/properties-1.jpg" class="overlay-link"> <i class="fa fa-expand"></i> </a> <a href="img/properties-1.jpg" class="hidden"></a> <a href="img/properties-1.jpg" class="hidden"></a> </div>

                  </div>

                </div>

                <div class="content">

                  <h4 class="title"> <a href="#"><?php echo $product_row->product_title; ?></a> </h4>

                  <h3 class="property-address"> <a href="#"> <i class="fa fa-map-marker"></i><?php echo $product_row->address; ?> </a> </h3>

                </div>

                <ul class="facilities-list clearfix">

                  <li> <i class="flaticon-square-layouting-with-black-square-in-east-area"></i> <span><?php echo $product_row->area; ?> sq ft</span> </li>

                  <li> <i class="flaticon-bed"></i> <span><?php echo $product_row->rooms; ?></span> </li>

                  <li> <i class="flaticon-holidays"></i> <span><?php echo $product_row->bathrooms; ?></span> </li>

                  <li> <i class="flaticon-vehicle"></i> <span><?php echo $product_row->parking; ?></span> </li>

                </ul>

              </div>

            </div>

          </div>

		  <?php }} ?>

         <!-- <div class="item">

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

              <div class="property-2">

                <div class="property-img">

                  <div class="featured"> Featured </div>

                  <div class="price-ratings">

                    <div class="price">$150,000</div>

                  </div>

                  <img src="img/properties-2.jpg" alt="rp" class="img-responsive">

                  <div class="property-overlay"> <a href="#" class="overlay-link"> <i class="fa fa-link"></i> </a>

                    <div class="property-magnify-gallery"> <a href="img/properties-2.jpg" class="overlay-link"> <i class="fa fa-expand"></i> </a> <a href="img/properties-2.jpg" class="hidden"></a> <a href="img/properties-2.jpg" class="hidden"></a> </div>

                  </div>

                </div>

                <div class="content">

                  <h4 class="title"> <a href="#">Masons Villas</a> </h4>

                  <h3 class="property-address"> <a href="#"> <i class="fa fa-map-marker"></i>123 Kathal St. Tampa City, </a> </h3>

                </div>

                <ul class="facilities-list clearfix">

                  <li> <i class="flaticon-square-layouting-with-black-square-in-east-area"></i> <span>4800 sq ft</span> </li>

                  <li> <i class="flaticon-bed"></i> <span>3</span> </li>

                  <li> <i class="flaticon-holidays"></i> <span>2</span> </li>

                  <li> <i class="flaticon-vehicle"></i> <span>1</span> </li>

                </ul>

              </div>

            </div>

          </div>

          <div class="item">

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

              <div class="property-2">

                <div class="property-img">

                  <div class="featured"> Featured </div>

                  <div class="price-ratings">

                    <div class="price">$150,000</div>

                  </div>

                  <img src="img/properties-3.jpg" alt="rp" class="img-responsive">

                  <div class="property-overlay"> <a href="#" class="overlay-link"> <i class="fa fa-link"></i> </a>

                    <div class="property-magnify-gallery"> <a href="img/properties-3.jpg" class="overlay-link"> <i class="fa fa-expand"></i> </a> <a href="img/properties-3.jpg" class="hidden"></a> <a href="img/properties-3.jpg" class="hidden"></a> </div>

                  </div>

                </div>

                <div class="content">

                  <h4 class="title"> <a href="#">Park Avenue</a> </h4>

                  <h3 class="property-address"> <a href="#"> <i class="fa fa-map-marker"></i>123 Kathal St. Tampa City, </a> </h3>

                </div>

                <ul class="facilities-list clearfix">

                  <li> <i class="flaticon-square-layouting-with-black-square-in-east-area"></i> <span>4800 sq ft</span> </li>

                  <li> <i class="flaticon-bed"></i> <span>3</span> </li>

                  <li> <i class="flaticon-holidays"></i> <span>2</span> </li>

                  <li> <i class="flaticon-vehicle"></i> <span>1</span> </li>

                </ul>

              </div>

            </div>

          </div>

          <div class="item">

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

              <div class="property-2">

                <div class="property-img">

                  <div class="featured"> Featured </div>

                  <div class="price-ratings">

                    <div class="price">$150,000</div>

                  </div>

                  <img src="img/properties-4.jpg" alt="rp" class="img-responsive">

                  <div class="property-overlay"> <a href="#" class="overlay-link"> <i class="fa fa-link"></i> </a>

                    <div class="property-magnify-gallery"> <a href="img/properties-4.jpg" class="overlay-link"> <i class="fa fa-expand"></i> </a> <a href="img/properties-4.jpg" class="hidden"></a> <a href="img/properties-4.jpg" class="hidden"></a> </div>

                  </div>

                </div>

                <div class="content">

                  <h4 class="title"> <a href="#">Sweet Family Home</a> </h4>

                  <h3 class="property-address"> <a href="#"> <i class="fa fa-map-marker"></i>123 Kathal St. Tampa City, </a> </h3>

                </div>

                <ul class="facilities-list clearfix">

                  <li> <i class="flaticon-square-layouting-with-black-square-in-east-area"></i> <span>4800 sq ft</span> </li>

                  <li> <i class="flaticon-bed"></i> <span>3</span> </li>

                  <li> <i class="flaticon-holidays"></i> <span>2</span> </li>

                  <li> <i class="flaticon-vehicle"></i> <span>1</span> </li>

                </ul>

              </div>

            </div>

          </div>-->

        </div>

      </div>

    </div>

  </div>

</div>

<div class="clearfix"></div>

<div class="categories">

  <div class="container">

    <div class="main-title">

      <h1>Popular Places</h1>

    </div>

    <div class="clearfix"></div>

    <div class="row wow">

      <div class="col-lg-7 col-md-7 col-sm-12">

        <div class="row">
		<?php  

		 $city_sql = mysql_query("SELECT * FROM `tbl_places_records` WHERE `status` = '1' limit 0,4");
		   if(mysql_num_rows($city_sql) > 0){
		   while($city_row = mysql_fetch_object($city_sql)){

	 ?>

          <div class="col-sm-6 col-pad wow fadeInLeft delay-04s">

            <div class="category">

              <div class="category_bg_box cat-2-bg">

                <div class="category-overlay">

                  <div class="category-content">

                    <div class="category-subtitle">14 Properties</div>

                    <h3 class="category-title"> <a href="#"><?php echo $city_row->city_name; ?></a> </h3>

                  </div>

                </div>

              </div>

            </div>

          </div>
<?php }} ?>
       <!--   <div class="col-sm-6 col-pad wow fadeInLeft delay-04s">

            <div class="category">

              <div class="category_bg_box cat-2-bg">

                <div class="category-overlay">

                  <div class="category-content">

                    <div class="category-subtitle">24 Properties</div>

                    <h3 class="category-title"> <a href="#">Quebec</a> </h3>

                  </div>

                </div>

              </div>

            </div>

          </div>

          <div class="col-sm-12 col-pad wow fadeInUp delay-04s">

            <div class="category">

              <div class="category_bg_box cat-3-bg">

                <div class="category-overlay">

                  <div class="category-content">

                    <div class="category-subtitle">9 Properties</div>

                    <h3 class="category-title"><a href="#">Canada</a></h3>

                  </div>

                </div>

              </div>

            </div>

          </div>-->

        </div>

      </div>

      <div class="col-lg-5 col-md-5 col-sm-12 col-pad wow fadeInRight delay-04s">

        <div class="category">

          <div class="category_bg_box category_long_bg cat-4-bg">

            <div class="category-overlay">

              <div class="category-content">

                <div class="category-subtitle">14 Properties</div>

                <h3 class="category-title"><a href="#">British Columbia</a></h3>

              </div>

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>

</div>

<?php include('includes/our-agents.php'); ?>

<?php include('includes/testimonials.php'); ?>

<div class="clearfix"></div>

<br/>

<?php include('includes/partners.php'); ?>

<?php include('includes/footer.php'); ?>

<?php include('includes/foot.php'); ?>

</body>

</html>

