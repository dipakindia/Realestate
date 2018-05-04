<?php
include "app.logics.class.php";
$access_obj = new property_app;



@$api_key = $_REQUEST['key']; 
@$api_token = $_REQUEST['token']; 

switch($api_key)
{
	case "usersignup":
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
			if($api_token=="e22dd5dabde45eda5a1a67772c8e25dd")
			{
				if(@$_REQUEST['firstname']=="")
				{
				header("Content-Type: application/json");
			echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"Firstname Field Not Found"));
			die();	
					}if(@$_REQUEST['email']=="")
				{
				header("Content-Type: application/json");
			echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"Email Field Not Found"));
			die();	
					}if(@$_REQUEST['password']=="")
				{
				header("Content-Type: application/json");
			echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"Password Field Not Found"));
			die();	
					}if(@$_REQUEST['mobile']=="")
				{
				header("Content-Type: application/json");
			echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"Mobile Field Not Found"));
			die();	
					}if(@$_REQUEST['dateofbirth']=="")
				{
				header("Content-Type: application/json");
			echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"Date Of Birth Field Not Found"));
			die();	
					}
					$user_id = rand(0,4000);
				@$name = $_REQUEST['firstname'];
				@$email = $_REQUEST['email'];
				@$mobile = $_REQUEST['mobile'];
				@$password = $_REQUEST['password'];
				@$date_of_birth = $_REQUEST['dateofbirth'];
				
				
			
				$access_obj->user_sign_up($user_id,$name,$email,$mobile,$password,$date_of_birth);
			}
				else { 
					header("Content-Type: application/json");
					echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"Invalid Token"));
		
				}

			}else{
				header("Content-Type: application/json");
					echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"Invalid Request Type"));
			}
	break;


	case "userlogin":
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		// if($api_token=="daaaf13651380465fc284db6940d8478")
		if($api_token=="e22dd5dabde45eda5a1a67772c8e25dd")
		{
			
			if(@$_REQUEST['password']=="")
			{
				header("Content-Type: application/json");
			echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"Password Field Not Found"));
			die();	
			}

		@$mobile = $_REQUEST['mobile'];
		@$email = $_REQUEST['email'];
		@$password = $_REQUEST['password'];
			if(is_numeric($mobile))
			{
				// $access_obj->user_login($mobile,$password);
			$data_get_mob = $access_obj->user_login($mobile,$password);
				foreach($data_get_mob as $data_res)
				{
					// echo $data_res->first_name;
					header("Content-Type: application/json");
				echo json_encode(array("status"=>1,"statusCode"=>1,"message"=>"Successfully Logged In","Name"=>$data_res->first_name,"Address"=>$data_res->address,"Email_id"=>$data_res->email_id,"Mobile_Number"=>$data_res->mobile));
				}
			}
			else
			{
			$data_get_email = $access_obj->user_login($email,$password);
			// $access_obj->user_login($email,$password);
				foreach($data_get_email as $data_res)
				{
					header("Content-Type: application/json");
				echo json_encode(array("status"=>1,"statusCode"=>1,"message"=>"Successfully Logged In","name"=>$data_res->first_name,"userId"=>$data_res->id,"emailId"=>$data_res->email_id,"mobileNumber"=>$data_res->mobile));
				}

			}
		}
		else { 
			header("Content-Type: application/json");
			echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"Invalid Token"));
			}

	}
	else{
		header("Content-Type: application/json");
		echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"Invalid Request Type"));
		}
	break;


	case "updateprofile":
	if($_SERVER['REQUEST_METHOD']=='POST'||'GET')
	{
		// if($api_token=="3812f9a59b634c2a9c574610eaba5bed")
		if($api_token=="e22dd5dabde45eda5a1a67772c8e25dd")
		{
			if(@$_REQUEST['mobile']=="")
			{
				header("Content-Type: application/json");
			echo json_encode(array("status"=>1,"statusCode"=>0,"message"=>"Mobile Reference Param Required"));
			die();	
			}

		@$first_name = $_REQUEST['firstname'];
		@$last_name = $_REQUEST['lastname'];
		@$mobile = $_REQUEST['mobile'];
		@$address = $_REQUEST['address'];
		@$country_code = $_REQUEST['countrycode'];

		$access_obj->update_profile($first_name,$last_name,$mobile,$address,$country_code);
		}else
		{ 
			header("Content-Type: application/json");
			echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"Invalid Token"));
			}
		
	}else{
		header("Content-Type: application/json");
		echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"Invalid Request Type"));

	}
	break;

	case "changepassword":
	if($_SERVER['REQUEST_METHOD']=='POST'||'GET')
	{	
		// if($api_token=="dc4c44f624d600aa568390f1f1104aa0")
		if($api_token=="e22dd5dabde45eda5a1a67772c8e25dd")
		{	
			if(@$_REQUEST['userid']=="")
			{
				header("Content-Type: application/json");
			echo json_encode(array("status"=>1,"statusCode"=>0,"message"=>"Userid Reference Param Required"));
			die();	
			}
			if(@$_REQUEST['oldpassword']=="")
			{
				header("Content-Type: application/json");
			echo json_encode(array("status"=>1,"statusCode"=>0,"message"=>"Provide Old password"));
			die();	
			}
			if(@$_REQUEST['newpassword']=="")
			{
				header("Content-Type: application/json");
			echo json_encode(array("status"=>1,"statusCode"=>0,"message"=>"Provide New password"));
			die();	
			}

			@$user_id = $_REQUEST['userid'];
			@$oldpassword = $_REQUEST['oldpassword'];
			@$newpassword = $_REQUEST['newpassword'];

			$access_obj->change_password($user_id,$oldpassword,$newpassword);

		}else
		{ 
			header("Content-Type: application/json");
			echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"Invalid Token"));
			}

	}else{
		header("Content-Type: application/json");
		echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"Invalid Request Type"));

	}
	break;

	case "addproducts":

	if($_SERVER['REQUEST_METHOD']=='POST'||'GET')
	{	

		// if($api_token=="38181d991caac98be8fb2ecb8bd0f166")
		if($api_token=="e22dd5dabde45eda5a1a67772c8e25dd")
		{	
			if(@$_REQUEST['userid']=="")
				{
				header("Content-Type: application/json");
			echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"User id Field Not Found"));
			die();	
					}if(@$_REQUEST['producttitle']=="")
				{
				header("Content-Type: application/json");
			echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"Product Title Field Not Found"));
			die();	
					}if(@$_REQUEST['productcategory']=="")
				{
				header("Content-Type: application/json");
			echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"Product Category Field Not Found"));
			die();	
					}if(@$_REQUEST['location']=="")
				{
				header("Content-Type: application/json");
			echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"Location Field Not Found"));
			die();	
					}if(@$_REQUEST['productdescription']=="")
				{
				header("Content-Type: application/json");
			echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"Product Description Field Not Found"));
			die();	
					}if(@$_REQUEST['productimage']=="")
				{
				header("Content-Type: application/json");
			echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"Product Image Field Not Found"));
			die();	
					}if(@$_REQUEST['subcategoryid']=="")
				{
				header("Content-Type: application/json");
			echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"Sub Category Id Field Not Found"));
			die();	
					}if(@$_REQUEST['categoryid']=="")
				{
				header("Content-Type: application/json");
			echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"Category Id Field Not Found"));
			die();	
					}if(@$_REQUEST['placesid']=="")
				{
				header("Content-Type: application/json");
			echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"Places Id Field Not Found"));
			die();	
					}


			@$user_id = $_REQUEST['userid'];
			@$product_title = $_REQUEST['producttitle'];
			@$product_category = $_REQUEST['productcategory'];
			@$location = $_REQUEST['location'];
			@$product_description = $_REQUEST['productdescription'];
			@$product_image = $_REQUEST['productimage'];
			@$subcategory_id = $_REQUEST['subcategoryid'];
			@$category_id = $_REQUEST['categoryid'];
			@$places_id = $_REQUEST['placesid'];


			$access_obj->add_product($user_id,$product_title,$product_category,$location,$product_description,$product_image,$subcategory_id,$category_id,$places_ids);			
		}else
		{ 
			header("Content-Type: application/json");
			echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"Invalid Token"));
			}

	}else{
		header("Content-Type: application/json");
		echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"Invalid Request Type"));

	}
	break;


	case "senddevicetoken":
	if($_SERVER['REQUEST_METHOD']=='POST'||'GET')
	{	
		
		if($api_token=="e22dd5dabde45eda5a1a67772c8e25dd")
		{	
			if(@$_REQUEST['userid']=="")
				{
				header("Content-Type: application/json");
			echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"User Id Field Not Found"));
			die();	
					}if(@$_REQUEST['devicetype']=="")
				{
				header("Content-Type: application/json");
			echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"Device Type Field Not Found"));
			die();	
					}if(@$_REQUEST['devicetoken']=="")
				{
				header("Content-Type: application/json");
			echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"Device Token Field Not Found"));
			die();	
					}

			@$user_id = $_REQUEST['userid'];
			@$device_type = $_REQUEST['devicetype'];
			@$device_token = $_REQUEST['devicetoken'];

			$access_obj->send_device_token($user_id,$device_type,$device_token);

		}else
		{ 
			header("Content-Type: application/json");
			echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"Invalid Token"));
			}

	}else {
		header("Content-Type: application/json");
		echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"Invalid Request Type"));
	}


	break;



	case "userprofiledetails":
	if($_SERVER['REQUEST_METHOD']=='POST'||'GET')
	{	
		
		if($api_token=="e22dd5dabde45eda5a1a67772c8e25dd")
		{	
			if(@$_REQUEST['userid']=="")
				{
				header("Content-Type: application/json");
			echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"User Id Field Not Found"));
			die();	
					}

			@$user_id = $_REQUEST['userid'];


			$fetch_user_details = $access_obj->user_profile_details($user_id);
			
			foreach($fetch_user_details as $user_details_res)
			{	
				header("Content-Type: application/json");
				echo json_encode($user_details_res);
			
			} 
				

		}else
		{ 
			header("Content-Type: application/json");
			echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"Invalid Token"));
			}

	}else {
		header("Content-Type: application/json");
		echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"Invalid Request Type"));
	}


	break;

	case "fetchplaces":

	if($_SERVER['REQUEST_METHOD']=='POST'||'GET')
	{	
		
		if($api_token=="e22dd5dabde45eda5a1a67772c8e25dd")
		{	

			$fetch_places = $access_obj->fetch_places();
			$status_array = array("status"=>1,"statusCode"=>1,"message"=>"Category List");
			// array_merge($status,$fetch_places);
			header("Content-Type: application/json");
				// echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"Invalid Request Type"));
				// echo json_encode(array(array("status"=>1,"statusCode"=>1,"message"=>"Place List"),array("places"=>$fetch_places)));
				echo json_encode(array(array("status"=>1,"statusCode"=>1,"message"=>"Place List","places"=>$fetch_places)));
				// echo json_encode(array_merge($status_array,$fetch_places));
				/*
			foreach ($fetch_places as $place_res) 
			{
				header("Content-Type: application/json");
				echo json_encode($place_res);

			}*/

		}else
		{ 
			header("Content-Type: application/json");
			echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"Invalid Token"));
			}

	}else {
		header("Content-Type: application/json");
		echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"Invalid Request Type"));
	}

	break;


	case "fetchcategory":

	if($_SERVER['REQUEST_METHOD']=='POST'||'GET')
	{	
		
		if($api_token=="e22dd5dabde45eda5a1a67772c8e25dd")
		{		

			$fetch_category = $access_obj->fetch_category();
			$fetch_city = array();
			foreach($fetch_category as $category_res)
			{	
				/*$seperate_place_id = explode(",",$category_res->city_id);
			foreach ($separate_place_id as $sep_res) 
			{
				// echo $sep_res;
				
				$fetch_city[] = $access_obj->fetch_places_id($sep_res);

			}
			$fetch_places = $access_obj->fetch_places();
				*/
				
			// ,"city_id"=>$access_obj->fetch_places_id($category_res->city_id)
			header("Content-Type: application/json");
			echo json_encode(array("status"=>1,"statusCode"=>1,"message"=>"Category List","category_list"=>array("id"=>$category_res->id,"category_name"=>$category_res->category_name,"image"=>$category_res->image,"description"=>$category_res->description,"city_id"=>$access_obj->fetch_places_id($category_res->city_id),"sub_category"=>$access_obj->selective_sub_category_list($category_res->id))));
			} 
			

			
			
			
		}else
		{ 
			header("Content-Type: application/json");
			echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"Invalid Token"));
			}

	}else {
		header("Content-Type: application/json");
		echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"Invalid Request Type"));
	}

	break;
	case "get_category":
	$result = $access_obj->getCategories($_REQUEST);
	header('Content-type: application/json');
	echo json_encode($result);
	break;
	case "forgot_password":
	$result = $access_obj->forgotPassword($_REQUEST);
	header('Content-type: application/json');
	echo json_encode($result);
	break;	
	case "get_user_info":
	$result = $access_obj->getUserInfo($_REQUEST);
	header('Content-type: application/json');
	echo json_encode($result);
	break;	
	case "get_content_data":
	$result = $access_obj->getContentData($_REQUEST);
	header('Content-type: application/json');
	echo json_encode($result);
	break;	
	/*
	case "fetchplaces":

	if($_SERVER['REQUEST_METHOD']=='POST'||'GET')
	{	
		
		if($api_token=="e22dd5dabde45eda5a1a67772c8e25dd")
		{	

			
		}else
		{ 
			header("Content-Type: application/json");
			echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"Invalid Token"));
			}

	}else {
		header("Content-Type: application/json");
		echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"Invalid Request Type"));
	}

	break;
*/

} // main switch ends here....

	
	

?>