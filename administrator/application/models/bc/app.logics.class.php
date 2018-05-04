<?php
include "connect.class.php";
$conn_obj = new connect();
class property_app{


	public function admin_creation($username,$password,$mobile,$email_id)
	{
		$admin_reg = connect::$conn->prepare("INSERT INTO admin (username,password,mobile,email_id) values (?,?,?,?)");
		$admin_reg->bind_param("ssis",$username,$password,$mobile,$email_id);
		$admin_reg->execute();
	} // admin_creation function ends here...

	public function admin_login($username,$password)
	{
		$admin_login = connect::$conn->query("SELECT * FROM admin where username='".$username."' AND password='".$password."'");
		if($admin_login->num_rows==1)
		{
			
			header("Location: ../DASHBOARD/");
			return 1;
		}
		else
		{
			return 0;
		}

	} // admin_login function ends here.....

	public function register($first_name,$last_name,$mobile)
	{	
		$user_reg = connect::$conn->prepare("INSERT INTO user_master (first_name,last_name,mobile) VALUES (?,?,?)");
	    $user_reg->bind_param('ssi',$first_name,$last_name,$mobile);
	    $user_reg->execute();

		


	} //register function ends here.....
	/*
	public function user_sign_up($user_id,$name,$last_name,$email,$password,$address,$mobile,$country_code)
	{
		$user_sign_up = connect::$conn->prepare("INSERT INTO user_master (user_id,first_name,last_name,email_id,password,address,mobile,country_code) values (?,?,?,?,?,?,?,?)");
		$user_sign_up->bind_param('ssssssii',$user_id,$name,$last_name,$email,$password,$address,$mobile,$country_code);
		if($user_sign_up->execute())
		{
			header("Content-Type: application/json");
			echo json_encode(array("status"=>"1","status_code"=>1,"message"=>"user successfully added"));
		}
		else {
			header("Content-Type: application/json");
			echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"Some error occurred"));
		}
	} // user sign up function ends here.......
	*/


	public function user_sign_up($user_id,$name,$email,$mobile,$password,$data_of_birth)
	{
		$check_duplicates = connect::$conn->query("SELECT * FROM user_master where mobile='".$mobile."'");
		$check_duplicates_email = connect::$conn->query("SELECT * FROM user_master where email_id='".$email."'");
		if($check_duplicates->num_rows==1)
		{
			header("Content-Type: application/json");
			echo json_encode(array("status"=>"0","statusCode"=>0,"message"=>"Duplicate Entry Mobile Number Already Exists"));
		}
		elseif($check_duplicates_email->num_rows==1)
		{
			header("Content-Type: application/json");
			echo json_encode(array("status"=>"0","statusCode"=>0,"message"=>"Duplicate Entry Email Id Already Exists"));
		}
		else
		{
					$user_sign_up = connect::$conn->prepare("INSERT INTO user_master (user_id,first_name,email_id,mobile,password,date_of_birth) values (?,?,?,?,?,?)");
					$user_sign_up->bind_param('sssiss',$user_id,$name,$email,$mobile,$password,$data_of_birth);
					if($user_sign_up->execute())
					{
						header("Content-Type: application/json");
						echo json_encode(array("status"=>"1","statusCode"=>1,"message"=>"user successfully added"));
					}
					else {
						header("Content-Type: application/json");
						echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"Some error occurred"));
					}
				}
	} // user sign up function ends here.......

	public function user_login($mobile,$password)
	{	$user_data = array();
		if(is_numeric($mobile))
		{
		$user_login = connect::$conn->query("SELECT * FROM user_master where mobile='$mobile' AND password='$password'");
		}else
		{
		$user_login = connect::$conn->query("SELECT * FROM user_master where email_id='$mobile' AND password='$password'");
		}
		if($user_login->num_rows==1)
		{	
			while($data_fetch = $user_login->fetch_object())
			{
				$user_data[] = $data_fetch;
				
			}
			// here status is disabled coz multi array conflicts....
			// header("Content-Type: application/json");
			// echo json_encode(array("status"=>1,"status code"=>1,"message"=>"Successfully Logged In"));
			return $user_data;
		}
		else{
			header("Content-Type: application/json");
			echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"Invalid User"));
		}
	
	} // user login function ends here.....



	public function send_device_token($user_id,$device_type,$device_token)
	{

		$device_token_query = "UPDATE user_master set device_type='$device_type', device_token='$device_token' WHERE user_id='$user_id'";
		$device_token = connect::$conn->query("SELECT * FROM user_master WHERE user_id='$user_id'");
		if($device_token->num_rows==1)
		{
		if(connect::$conn->query($device_token_query))
		{	
			header("Content-Type: application/json");
			echo json_encode(array("status"=>"1","statusCode"=>1,"message"=>"updated"));

		} // if device token query ends here....
		else{
			header("Content-Type: application/json");
			echo json_encode(array("status"=>"0","statusCode"=>0,"message"=>"error in updating"));
		} // else part ends here .... 
	} // device token check if block ends here ....
	else{
		header("Content-Type: application/json");
			echo json_encode(array("status"=>"0","statusCode"=>2,"message"=>"No such User Id Exists"));
	}

	} // send_deivce_token ends here.......


	public function user_profile_details($user_id)
	{
		$user_details = array();
		$user_details_fetch = connect::$conn->query("SELECT * FROM user_master WHERE user_id='$user_id'");
		if($user_details_fetch->num_rows==1)
		{
			while($fetch_user_details = $user_details_fetch->fetch_object())
			{
				$user_details[] = $fetch_user_details;
			}
		return $user_details;
			
		}
		else 
		{
		header("Content-Type: application/json");
		echo json_encode(array("status"=>"0","statusCode"=>2,"message"=>"No such User Id Exists"));	
		}
	
	} // function user_profile_details ends here ......

	public function fetch_places()
	{
		$places_array = array();
		$fetch_places = connect::$conn->query("SELECT * FROM places");
		while($fetch_res = $fetch_places->fetch_object())
		{

			$places_array[] = $fetch_res;

		}
		return $places_array;
	} // fetch places ends here.....


	public function fetch_category()
	{
		$category_array = array();
		$fetch_category = connect::$conn->query("SELECT * FROM Category");
		while($fetch_res = $fetch_category->fetch_object())
		{

			$category_array[] = $fetch_res;

		}
		return $category_array;
	} // fetch category ends here.....
/*	public function getCatdata($parent_id){
		$category_array = array();
		$fetch_category = connect::$conn->query("SELECT * FROM tbl_category_records WHERE `parent_id` = '".$parent_id."' AND `status` = '1'");
		while($fetch_res = $fetch_category->fetch_assoc()){
		$sub_cat = self::getCatdata($fetch_res['category_id']);
		$sc = array();
		if($sub_cat){
			$sc = array("sub_cat" => $sub_cat);
		}
		$category_array[] = array_merge($fetch_res,$sc);
		}
		}
		return $category_array;
	}*/
	public function getCategories($post){
		$category_list = array();
		if(@$post['category_id']!=''){ $category_id = $post['category_id'];}else{ $category_id = 0;}
		$fetch_category = connect::$conn->query("SELECT `category_id`, `category_name`, `parent_id`, `category_image`, `category_description`, `status` FROM tbl_category_records WHERE `parent_id` = '".$category_id."' AND `status` = '1'");
		while($fetch_res = $fetch_category->fetch_assoc()){
		$sc = array();
		$fetch_category1 = connect::$conn->query("SELECT `category_id`, `category_name`, `parent_id`, `category_image`, `category_description`, `status` FROM tbl_category_records WHERE `parent_id` = '".$fetch_res['category_id']."' AND `status` = '1'");
		while($fetch_res1 = $fetch_category1->fetch_assoc()){
		$sub_cat[] = $fetch_res1;
		}
		if($sub_cat){
			$sc = array("sub_category_list" => $sub_cat);
		}
		$category_list = array_merge($fetch_res,$sc);
		}
		if(count($category_list) > 0){
			$json = array("status"=>1, "statusCode"=>1,"msg" => count($category_list)." Records Found!!");
			$json['category_list'][] = $category_list;
		}else{
			$json = array("status"=>1, "statusCode"=>0,"msg" => "No Records Found!!");
		}
		return $json;
	}
	public function forgotPassword($post){
	$match_otp = $user_id = $email = '';
	if($post['user_id']!=''){ $user_id = $post['user_id']; }
	if($post['email']!=''){	$email = $post['email']; }
	if($post['match_otp']!=''){ $match_otp = $post['match_otp']; }
	if($user_id == ''){
		if($email == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => "Email Should not be blank");	
		}else{
			$json = array();	
			$sql = connect::$conn->query("SELECT * FROM `user_master` WHERE `email_id` = '".$email."'");
			if($sql->num_rows > 0){
				$data = $sql->fetch_object();
				$phone = $data->mobile;
				$otp_no = mt_rand(10000,999999);
				//sendOtp($phone,$otp_no);
				$json = array("status"=>1, "statusCode"=>1, "msg" => SENT_OTP);	
				$json['otp_deatils'] = array("otp_no" =>$otp_no ,"mobile" => $data->mobile,"user_id" => $data->id);
			}else{
				$json = array("status"=>1, "statusCode"=>0, "msg" => "Email Does not exists in the Database!!");
			}
		}
	}else{
		if($match_otp == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => "match_otp Should not be Blank!!");	
		}else{
			if($match_otp == '1'){
				$json = array();	
				$sql = connect::$conn->query("SELECT * FROM `user_master` WHERE `id` = '".$user_id."'");
				if($sql->num_rows > 0){
					$data = $sql->fetch_object();
					//$update = connect::$conn->query("UPDATE `user_master` SET `password` = '".$password."' WHERE `id` = '".$data->id."'");
					$message = "Your Password is <strong>".$data->password."</strong>";
					$to = $data->email_id;
					$subject = "Your Password";
					
					// Always set content-type when sending HTML email
					$headers = "MIME-Version: 1.0" . "\r\n";
					$headers.= "Content-type:text/html;charset=UTF-8" . "\r\n";
					
					// More headers
					$headers.= 'From: <admin@mysolutions4u.in>' . "\r\n";
					$headers.= 'Cc: dipak.yts@gmail.com' . "\r\n";
					
					$update = mail($to,$subject,$message,$headers);
					if($update){
						$json = array("status"=>1, "statusCode"=>1, "msg" => "Password Sussfully Sent On your Email!!");
					}else{
						$json = array("status"=>1, "statusCode"=>0, "msg" => "Password not Send!!");
					}	
				}else{
					$json = array("status"=>1, "statusCode"=>0, "msg" => "Email Does not Exists!!");
				}
			}else{
					$json = array("status"=>1, "statusCode"=>0, "msg" => "OTP is Not Correct!!");
				}
		}
	}
	return $json;
	}
	public function getUserInfo($post){
	$password = $user_id = $email = '';
	if($post['user_id']!=''){ $user_id = $post['user_id']; }
	if($user_id == ''){
		$json = array("status"=>0, "statusCode"=>0, "msg" => "User Id Should not be Blank!!");	
	}else{
		$json = array();	
		$sql = connect::$conn->query("SELECT * FROM `user_master` WHERE `id` = '".$user_id."'");
		if($sql->num_rows > 0){
			$data = $sql->fetch_object();
			$json = array("status"=>1, "statusCode"=>1, "msg" => "User are available!!");
			$json['user_info'] = $data;
		}else{
			$json = array("status"=>1, "statusCode"=>0, "msg" => "User id Does not Exists!!");
		}
	}
	return $json;
	}
	public function getContentData($post){
	$content_value = '';
	if($post['content_value']!=''){ $content_value = $post['content_value']; }
	if($content_value == ''){
		$json = array("status"=>0, "statusCode"=>0, "msg" => "Content Value Should not be Blank!!");	
	}else{
		$json = array();	
		$sql = connect::$conn->query("SELECT * FROM `tbl_content_records` WHERE `action` = '".$content_value."'");
		if($sql->num_rows > 0){
			$data = $sql->fetch_object();
			$json = array("status"=>1, "statusCode"=>1, "msg" => "Content Value are available!!");
			$json['content_data'] = $data;
		}else{
			$json = array("status"=>1, "statusCode"=>0, "msg" => "Content Value Does not Exists!!");
		}
	}
	return $json;
	}
	 
	public function fetch_places_id($id)
	{	
		$places_array = array();
		$id_separate = explode(",", $id);
		// print_r($id_separate);

		foreach ($id_separate as $id_res)
		{	
			// echo $id_res."<br>";
			// echo "SELECT * FROM places where id='$id_res'";
			$fetch_places = connect::$conn->query("SELECT * FROM places where id='$id_res'");
		while($fetch_res = $fetch_places->fetch_object())
		{
			// echo $fetch_res->city_name;
			$places_array[] = $fetch_res;

		}
		}
			// print_r($places_array);
		
		return $places_array;
	} // fetch places ends here.....


	public function selective_sub_category_list($parent_id)
	{
		$sub_category_data = array();

		$fetch_sub_category = connect::$conn->query("SELECT * FROM sub_category where parent_id='$parent_id'");
		while($fetch_sub_category_res = $fetch_sub_category->fetch_object())
		{

			$sub_category_data[] = $fetch_sub_category_res;
		}

		return $sub_category_data;

	}


	public function check()
	{	$store_array = array();
		$user_check = connect::$conn->query("SELECT first_name,last_name FROM user_master");
		while ($fetch_res = $user_check->fetch_object()) 
		{
			$store_array[] = $fetch_res;
		}
		header('Content-Type: application/json');
		echo json_encode($store_array);

	}

	public function status($fn,$mb)
	{
		$cehck_status = connect::$conn->query("SELECT * FROM user_master where first_name='$fn' AND mobile='$mb'");
		if($cehck_status->num_rows==1)
		{
			header('Content-Type: application/json');
			echo json_encode(array("STATUS"=>1));
		}else {
			header('Content-Type: application/json');
			echo json_encode(array("STATUS"=>0));
		}
	}


	public function remove_data()
	{
		connect::$conn->query("truncate user_master");
	}

	public function update_profile($first_name,$last_name,$mobile,$address,$country_code){

		$query = "UPDATE user_master set";
		if($first_name!="")
		{
			$query .= " first_name = '$first_name'";
		}
		if($first_name&&$last_name!="")
		{
			$query .= ",";
		}
		elseif($first_name&&$address!="")
		{
			$query .= ",";
		}
		
		if($last_name!="")
		{
			$query .= " last_name = '$last_name'";
		}
		if($last_name&&$address!="")
		{
			$query .= ",";
		}
		
		/*if($first_name&&$mobile!="")
		{
			$query .= ",";
		}
		if($mobile!="")
		{
			$query .= " mobile = '$mobile'";
		}*/
		
		
		if($address!="")
		{
			$query .= " address = '$address'";
		}
		elseif($first_name&&$country_code!="")
		{
			$query .= ",";
		}
		elseif($last_name&&$country_code!="")
		{
			$query .= ",";
		}
		if($address&&$country_code!="")
		{
			$query .= ",";
		}
		/*if($last_name&&$country_code!="")
		{
			$query .= ",";
		}*/
		if($country_code!="")
		{
			$query .= " country_code = '$country_code'";
		}
		$query .= " where mobile=".$mobile;
			if(connect::$conn->query($query))
				{
			header("Content-Type: application/json");
			echo json_encode(array("status"=>"1","statusCode"=>1,"message"=>"user successfully updated"));
		}else{
				header("Content-Type: application/json");
			echo json_encode(array("status"=>"1","statusCode"=>0,"message"=>"Some Error occurred in updating"));
		}

	} // function update profile ends here......


	public function change_password($user_id,$oldpassword,$newpassword)
	{

		$user_password_change = connect::$conn->query("SELECT * FROM user_master where user_id='".$user_id."' AND password='".$oldpassword."'");
		if($user_password_change->num_rows==1)
		{	
			$query = "UPDATE user_master set password = '$newpassword' where user_id='".$user_id."'";
			if(connect::$conn->query($query))
			{
			header("Content-Type: application/json");
			echo json_encode(array("status"=>"1","statusCode"=>1,"message"=>"Password Changed Successfully"));
			}else{
				header("Content-Type: application/json");
			echo json_encode(array("status"=>"1","statusCode"=>0,"message"=>"Password Cannot Be Changed"));

			}
			
				
		}
		else
		{
			header("Content-Type: application/json");
			echo json_encode(array("status"=>"1","statusCode"=>0,"message"=>"Invalid Old Password"));
		}

	} // function change_password ends here.....

	public function add_product($user_id,$product_title,$product_category,$location,$product_description,$product_image,$subcategory_id,$category_id,$places_ids)
		{	
			// this is google location part.....
			  $address =$location; // Google HQ
			  $prepAddr = str_replace(' ','+',$address);
			  $geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false&Key=AIzaSyDNx3M4dqmPH0MG_yX5odICtlzaGdkGGAY');
			  $output= json_decode($geocode);
			  $latitude = $output->results[0]->geometry->location->lat;
			  $longitude = $output->results[0]->geometry->location->lng;
			// this is google location part.....	
			  
		$add_products = connect::$conn->prepare("INSERT INTO products (user_id,product_title,product_category,location,latitude,longitude,product_description,product_image,subcategory_id,category_id,places_ids) values (?,?,?,?,?,?,?,?,?,?,?)");
		$add_products->bind_param('sssssssssss',$user_id,$product_title,$product_category,$location,$latitude,$longitude,$product_description,$product_image,$subcategory_id,$category_id,$places_ids);

		if($add_products->execute())
					{
						header("Content-Type: application/json");
						echo json_encode(array("status"=>"1","statusCode"=>1,"message"=>"Product successfully added"));
					}
					else {
						header("Content-Type: application/json");
						echo json_encode(array("status"=>0,"statusCode"=>0,"message"=>"Some error occurred"));
					}

	} // function add_products ends here....



} //property_app_class ends here.....

// $test_obj = new property_app;
// $test_obj->fetch_places_id("1,2");
 // $test_obj->add_product('lovey_2358','product_title','product_category','amsterdam','product_description','product_image','subcategory_id','category_id','places_ids');	
// $test_obj->change_password('lovey_2358','lovey','anirudh');
// $test_obj->update_profile('asd','asda','dsa','asdas','23');
// if($_SERVER['REQUEST_METHOD']=='POST')
// {
// 	$first_name = $_POST['firstname'];
// 	$last_name = $_POST['lastname'];
// 	$mobile = $_POST['mobile'];
// // $test_obj->register($first_name,$last_name,$mobile);
// 	$test_obj->status($first_name,$mobile);


// }
// $test_obj->check();
// $first_name = $_GET['firstname'];
// $mobile = $_GET['mobile']; 
// $test_obj->status($first_name,$mobile);
// $test_obj->admin_creation("Anirudh","password",7896578678,"anirud@gmail.com");
// $test_obj->admin_login("Anirudha","password");
// [GOOGLE MAP API:]
// https://maps.googleapis.com/maps/api/geocode/json?address=faridabad&Key=AIzaSyDNx3M4dqmPH0MG_yX5odICtlzaGdkGGAY

?>