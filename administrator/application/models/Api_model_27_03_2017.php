<?php 
 
define('BASE_URLD','http://jondig.com/whatsNewData/');
define('ERROR_USER_AND_PASS_REQ','Mobile/Email and Password should Not be Blank!!');
define('ERROR_USER_REQ','Mobile/Email should Not be Blank!!');
define('ERROR_PASS_REQ','Password should Not be Blank!!');
define('LOGIN_SUCC_MSG','Login Success !!');
define('ERR_LOGIN','Invalid Email And Password!!');
define('ERROR_BANNERID_REQ','Banner Id should Not be Blank!!');
define('ERROR_TAB_REQ','Tab Id should Not be Blank!!');
define('ERROR_ADDRESS_REQ','Address Id should Not be Blank!!');
define('ERROR_MER_REQ','Merchant Id should Not be Blank!!');
define('ERROR_USER_REQ','User Name should Not be Blank!!');
define('ERROR_EMAIL_REQ','Email should Not be Blank!!');
define('ERROR_MOBILE_REQ','Mobile should Not be Blank!!');
define('ERROR_NAME_REQ','Name should Not be Blank!!');
define('ERROR_GENDER_REQ','Gender should Not be Blank!!');
define('ERROR_DOB_REQ','Date of Birth should Not be Blank!!');
define('ERROR_PASS_REQ','Password should Not be Blank!!');
define('ERROR_PINCODE_REQ','Pincode should Not be Blank!!');
define('ERROR_CATEGORY_REQ','Category should Not be Blank!!');
define('ERROR_MOBILE_ALREADY_EXISTS','Mobile No already Exists!!');
define('ERROR_EMAIL_ALREADY_EXISTS','Email Or Mobile already Exists!!');
define('ERROR_UID_REQ','User Id should Not be Blank!!');
define('REGISTER_SUCCESS','Your account is successfully created, please login continue!');
define('REGISTER_ERROR','Error in Register!!');
define('ERROR_EVENT_ALREADY_EXISTS','Event already register!!');
define('EVENT_ADDED_SUCCESS','Event successfully added!!');
define('ERROR_LOCATION_REQ','Location should Not be Blank!!');
define('ERROR_DATE_REQ','Date should Not be Blank!!');
define('ERROR_SEARCH_TEXT_REQ','Search Text should Not be Blank!!');
define('ERROR_DESC_REQ','Description should Not be Blank!!');
define('ERROR_TITLE_REQ','Title should Not be Blank!!');
define('ERROR_PID_REQ','Product Id should Not be Blank!!');
define('ERROR_MERCHENTID_REQ','Merchant Id should Not be Blank!!');
define('ERROR_EVENT_REQ','Event Id should Not be Blank!!');
define('ERROR_EVENT_ACTION_REQ','Event action should Not be Blank!!');
define('EVENT_ADDED_ERROR','Error in adding event!!');
define('POST_ADDED_ERROR','Error in adding post!!');
define('ADDED_SUCCESS','successfully added!!');
define('UPDATED_SUCCESS','successfully Updated!');
define('NO_RECORD_FOUND','No Records Found!!');
define('RECORD_FOUND','Records Found!!');
define('ERROR_OFFERID_REQ','Offer Id should Not be Blank!!');
define('ERROR_GALLERY_IMG_REQ','Gallery Image should Not be Blank!!');
define('ERROR','Error');
define("OTP_MSG","Your OTP for WhatsNew is:");
define("OTP_USERNAME","sunojii123");
define("OTP_PASSWORD","Sunojii@misc9");
date_default_timezone_set("Asia/Kolkata");

class Api_model extends CI_Model {
	function __construct(){			
		parent::__construct();
		//$this->load->library('email');
	}
	public function userLogin($post){
		if($post['user_name']!=''){$user_name = $post['user_name'];}else{ $user_name = '';}
		if($post['password']!=''){$password = $post['password'];}else{ $password = '';}
		if($post['device_token']!=''){$device_token = $post['device_token'];}else{ $device_token = '';}
		if($post['device_type']!=''){$device_type = $post['device_type'];}else{ $device_type = '';}
		
		if($user_name == ''){
			$json = array("status"=> 0, "statusCode"=>0, "msg" => ERROR_USER_REQ );	
		}else if($password == ''){
			$json = array("status"=> 0, "statusCode"=>0, "msg" => ERROR_PASS_REQ );	
		}
		else{
			$json = array();

			$sql = $this->db->query("SELECT * FROM `tbl_user_records` WHERE (`email_id` = '".$user_name."' OR `mobile` = '".$user_name."' ) AND `password` ='".$password."'");
		if($sql->num_rows() > 0){
			$json = array("status"=>1, "statusCode"=>1, "msg" => LOGIN_SUCC_MSG );
			$data = $sql->result();
			$pi = '';
			if($data[0]->Image!=''){
			$pi = BASE_URLD.'uploads/'.$data[0]->image;
			}
			$token_id = md5($data[0]->user_id);
			$json['user_details'] = array("user_id" =>$data[0]->id ,"name" =>$data[0]->first_name, "emailId" => $data[0]->email_id,"mobileNumber" => $data[0]->mobile,"token_id" => $token_id);
			$upArr = array("device_token" => $device_token,"device_type" => $device_type,"token_id" => $token_id);
			$update = $this->db->update("tbl_user_records",$upArr,array("user_id" => $data[0]->user_id));
			
		}else{
			$json = array("status"=>1, "statusCode"=>0, "msg" => ERR_LOGIN );
			}
		}
		return $json;
	}
	public function sendOtp($phone,$otp){

		$message = OTP_MSG." ".$otp."";
		$sendsms =""; //initialise the sendsms variable 
		$param['To'] = $phone; 
		$param['Message'] = $message; 
		$param['UserName'] = OTP_USERNAME; 
		$param['Password'] = OTP_PASSWORD;
		$param['Mask'] = "SSUNOJ";
		$param['v'] = "1.1"; //optional 
		$param['Type'] = "Individual"; //Can be "Bulk/Group” //We need to URL encode the values 
		foreach($param as $key=>$val){
			$sendsms.= $key."=".urlencode($val); $sendsms.= "&"; //append the ampersand (&) sign after each parameter/value
		}
		$sendsms = substr($sendsms, 0, strlen($sendsms)-1);//remove last ampersand (&) sign from the sendsms 
		$url = "http://www.smsgatewaycenter.com/library/send_sms_2.php?".$sendsms; 
		$ch = curl_init($url); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		$curl_scraped_page = curl_exec($ch); 
		curl_close($ch); 
		$curl_scraped_page = 'SUCCESS | Success (1) Fail (0) | Total Sms Cost (1)'; 
		$response = explode('|',$curl_scraped_page);
		if($response[0] == 'error '){
			return false;
		}else{
			return true;
		}
	}
	public function sendOtpByMobile($post){
		if(@$post['mobile']!=''){ $mobile = $post['mobile']; }else{ $mobile = ''; }	
		if($mobile == ''){ 
			$json = array("status"=>0, "statusCode"=>0,"msg" =>"Mobile should not be Blank");
		}else{ 
			$otp_no = mt_rand(10000,999999);
			$res = $this->sendOtp($mobile,$otp_no);
			$json = array("status"=>1, "statusCode"=>1,"otp_no" => $otp_no, "res" => $res,"msg" =>"OTP send Succesfully");
		}
		return $json;
	}
	public function userRegister($post){
		$first_name = $last_name = $email = $password = $gender	= $registeredVia = $dateofbirth = $image = '';
		$device_type = '';
		$device_token = '';
		if(@$post['first_name']!=''){ $first_name = $post['first_name'];}
		if(@$post['last_name']!=''){ $last_name = $post['last_name'];}
		if(@$post['email']!=''){ $email = $post['email'];}
		if(@$post['mobile']!=''){ $mobile = $post['mobile'];}
		if(@$post['registeredVia']!=''){ $registeredVia = $post['registeredVia']; }
		if(@$post['dateofbirth']!=''){ $dateofbirth = $post['dateofbirth'];}
		if(@$post['password']!=''){ $password = $post['password'];}		
		if(@$post['device_type']!=''){ $device_type = $post['device_type'];}
		if(@$post['device_token']!=''){ $device_token = $post['device_token'];}
	
		if($first_name == '' ){
			$json = array("status"=>0, "statusCode"=>0, "msg" => "First ".ERROR_NAME_REQ);	
		}else if($email == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => ERROR_EMAIL_REQ);	
		}else if($mobile == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => ERROR_MOBILE_REQ);	
		}else if($registeredVia == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => "Registration Via is Required!!");	
		}else if($dateofbirth == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => ERROR_DOB_REQ);	
		}else if($password == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => ERROR_PASS_REQ);	
		}else{
			$json = array();	
			$sql = $this->db->query("SELECT * FROM `tbl_user_records` WHERE `email_id` = '".$email."' OR `mobile` = '".$mobile."'");
		if($sql->num_rows() > 0){
				$json = array("status"=>1, "statusCode"=>0, "msg" => ERROR_EMAIL_ALREADY_EXISTS);
		}else{
			//$image = '';
			if($_FILES['profile_pic']){
			move_uploaded_file($_FILES["profile_pic"]["tmp_name"],
			"uploads/" . $_FILES["profile_pic"]["name"]);
			$image = $_FILES["profile_pic"]["name"];
			}else{
				$image = '';
			}
			
			$array = array(
				'first_name' => $first_name,
				'last_name' => $last_name,
				'email_id' => $email,
				'password'=>$password,
				'date_of_birth' => $dateofbirth,
				'mobile' => $mobile,
				'pic' => $image,
				'device_token' => $device_token,
				'device_type' => $device_type,
			);
			$sqlIns = $this->db->insert('tbl_user_records', $array);
			$lastId =$this->db->insert_id();
			$sqlDa = $this->db->query("SELECT * FROM `tbl_user_records` WHERE `id` = '".$lastId."'");
			$data = $sqlDa->result();
				if($sqlIns){
					//$this->send_mail($email,$name,'user',$password);
					$json = array("status"=>1, "statusCode"=>1, "msg" => REGISTER_SUCCESS);
					$pi = '';
					if($data[0]->image!=''){
					$pi = BASE_URLD.'uploads/'.$data[0]->pic;
					}
					$otp_no = mt_rand(10000,999999);
					//$res = $this->sendOtp($mobile,$otp_no);
					$json['user_deatils'] = array("user_id" =>$data[0]->id ,"first_name" =>$data[0]->first_name,"last_name" =>$data[0]->last_name, "email" => $data[0]->email_id,"otp_no" => $otp_no, "profile_pic" => $data[0]->pic,"image_url" => $pi,"dateofbirth" => $data[0]->date_of_birth );
				}else{
					$json = array("status"=>1, "statusCode"=>0, "msg" => REGISTER_ERROR);	
				}
			}
		}
		return $json;
	} 
	public function userName($userId){
		$sqlDa = $this->db->query("SELECT * FROM `wn_users` WHERE `user_id` = '".$userId."'");
		$num = $sqlDa->num_rows();
		if($num > 0){
			$row = $sqlDa->result();
			return $row[0]->Name;
		}else{
			return false;
		}
	}
	public function allCategoriesList($post){
		$category_list = array();
		if(@$post['category_id']!=''){ $category_id = $post['category_id'];}else{ $category_id = 0;}	
		$sqlDa = $this->db->query("SELECT `category_id`, `category_name`, `parent_id`, `category_image`, `category_description`, `status` FROM tbl_category_records WHERE `parent_id` = '".$category_id."' AND `status` = '1'");
		if($sqlDa->num_rows() > 0){
			$json['category_list'] = array();
			$data = $sqlDa->result_array();
			$json = array("status"=>1, "statusCode"=>1, "msg" => $sqlDa->num_rows().' '.RECORD_FOUND);
			foreach($data as $dt){
				$sqlDa = $this->db->query("SELECT `category_id`, `category_name`, `parent_id`, `category_image`, `category_description`, `status` FROM tbl_category_records WHERE `parent_id` = '".$dt['category_id']."' AND `status` = '1'");
				$sub_category_list = array();
				if($sqlDa->num_rows() > 0){
					$data = $sqlDa->result_array();
					$json = array("status"=>1, "statusCode"=>1, "msg" => $sqlDa->num_rows().' '.RECORD_FOUND);
					foreach($data as $dt){
						$sub_category_list[] =  $dt; 
					}
				}
				$json['category_list'][] =  array_merge($dt,array("sub_category_list" => $sub_category_list)); 
			}
		}else{
			$json = array("status"=>1, "statusCode"=>0, "msg" => NO_RECORD_FOUND);
		}	
		return $json;
	}
	public function getUserInfo($post){
		$password = $user_id = $email = '';
		if($post['user_id']!=''){ $user_id = $post['user_id']; }
		if($user_id == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => ERROR_UID_REQ);	
		}else{
			$json = array();	
			$sql = $this->db->query("SELECT * FROM `tbl_user_records` WHERE `id` = '".$user_id."'");
			if($sql->num_rows() > 0){
				$data = $sql->result();
				$json = array("status"=>1, "statusCode"=>1, "msg" => "User are available!!");
				$json['user_info'] = $data;
			}else{
				$json = array("status"=>1, "statusCode"=>0, "msg" => ERROR_UID_REQ);
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
		$sql = $this->db->query("SELECT * FROM `tbl_content_records` WHERE `action` = '".$content_value."'");
		if($sql->num_rows() > 0){
			$data = $sql->result();
			$json = array("status"=>1, "statusCode"=>1, "msg" => "Content Value are available!!");
			$json['content_data'] = $data;
		}else{
			$json = array("status"=>1, "statusCode"=>0, "msg" => "Content Value Does not Exists!!");
		}
	}
	return $json;
	}
	public function allPlacesList($post){
		$sqlDa = $this->db->query("SELECT * FROM `places` ");
		if($sqlDa->num_rows() > 0){
			$json['place_list'] = array();
			$data = $sqlDa->result();
			$json = array("status"=>1, "statusCode"=>1, "msg" => $sqlDa->num_rows().' '.RECORD_FOUND);
			$json['place_list'] =  $data; 
		}else{
			$json = array("status"=>1, "statusCode"=>0, "msg" => NO_RECORD_FOUND);
		}	
		return $json;
	} 
	public function upgradeAccountToMerchant($post){
		$user_id = $email = '';
		if($post['user_id']!=''){ $user_id = $post['user_id']; }
		if($user_id == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => "User Id Should not be Blank!!");	
		}else{
			$json = array();	
			$sql = $this->db->query("SELECT * FROM `tbl_user_records` WHERE `id` = '".$user_id."'");
			if($sql->num_rows() > 0){
				$data = $sql->result();
				$array = array("is_merchant" => '1', 'office_address' => $office_address, 'peryear_sale' => $peryear_sale, 'office_email' => $office_email, 'office_phone' => $office_phone, 'device_type' => $device_type, 'device_token' => $device_token);
				$update = $this->db->update('tbl_user_records',$array,array("id" => $user_id));
				if($update){
					$json = array("status"=>1, "statusCode"=>1, "msg" => UPDATED_SUCCESS);
				}
			}else{
				$json = array("status"=>1, "statusCode"=>0, "msg" => "User id Does not Exists!!");
			}
		}
		return $json;

	}
	public function userLogout($post){
		$user_id = $email = '';
		if($post['user_id']!=''){ $user_id = $post['user_id']; }
		if($user_id == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => "User Id Should not be Blank!!");	
		}else{
			$json = array();	
			$sql = $this->db->query("SELECT * FROM `tbl_user_records` WHERE `id` = '".$user_id."'");
			if($sql->num_rows() > 0){
				$data = $sql->result();
				$array = array("token_id" => '','device_token' => '', 'device_type' => "");
				$update = $this->db->update('tbl_user_records',$array,array("id" => $user_id));
				if($update){
					$json = array("status"=>1, "statusCode"=>1, "msg" => "Successfully Logout!");
				}else{
					$json = array("status"=>1, "statusCode"=>0, "msg" => "Error in Logout!");
				}
			}else{
				$json = array("status"=>1, "statusCode"=>0, "msg" => "User id Does not Exists!!");
			}
		}
		return $json;

	}
	public function verifyTokenId($token_id,$user_id){
		$sql = $this->db->query("SELECT * FROM `tbl_user_records` WHERE `token_id` = '".$token_id."' AND `id` ='".$user_id."'");
		$result = 0;
		if($sql->num_rows() > 0){
		$result = 1;
		}
		return $result;
	}
	public function changePasword($post){
		$user_id = $password = '';
		if($post['user_id']!=''){ $user_id = $post['user_id']; }
		if($post['password']!=''){ $password = $post['password']; }
		if($user_id == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => ERROR_UID_REQ);	
		}else if($password == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => ERROR_PASS_REQ);	
		}else{
			$json = array();	
			$sql = $this->db->query("SELECT * FROM `tbl_user_records` WHERE `id` = '".$user_id."'");
		if($sql->num_rows() > 0){
			$data = $sql->result();
			$sqlUp = $this->db->query("UPDATE `tbl_user_records` SET `password` = '".$password."' WHERE `id` = '".$user_id."'");
			if($sqlUp){
				$json = array("status"=>1, "statusCode"=>1, "msg" => "Your password has been changed successfully!");	
			}else{
				$json = array("status"=>1, "statusCode"=>0, "msg" => ERROR_USER_UPDATE);	
			}
		}else{
			$json = array("status"=>1, "statusCode"=>0, "msg" => ERROR_UID_NOT_EXISTS);
			}
		}
		return $json;
	}
	public function updateTokenId($post){
		$user_id = $device_token = $device_key = '';
		if(@$post['user_id']!=''){ $user_id = $post['user_id'];}
		if(@$post['device_token']!=''){ $device_token = $post['device_token'];}
		if(@$post['device_type']!=''){ $device_type = $post['device_type'];}
		if($user_id == ''){
		$json = array("status"=>0, "statusCode"=>0, "msg" => ERROR_UID_REQ);	
		}elseif($device_token == ''){
		$json = array("status"=>0, "statusCode"=>0, "msg" => "Device Token should Not be Blank");	
		}elseif($device_type == ''){
		$json = array("status"=>0, "statusCode"=>0, "msg" => "Device Type should Not be Blank");	
		}else{
			$sql = $this->db->query("SELECT * FROM `tbl_users_records` WHERE `user_id` = '".$user_id."'");
			$num = $sql->num_rows();
			if($num > 0){
				$sqlIns = $this->db->query("UPDATE `tbl_users_records` SET `device_token` = '".$device_token."', `device_type` = '".$device_type."' WHERE `user_id`='".$user_id."'");
				if($sqlIns){
				$json = array("status"=>1, "statusCode"=>1,"msg" => "Updated Successfully");
				}else{
				$json = array("status"=>1, "statusCode"=>0, "msg" => "Not Updated");	
				}
			}else{
				$json = array("status"=>1, "statusCode"=>0,"msg" => NO_RECORD_FOUND);
			}
		}
		return $json;	
	}
	public function updateProfile($post){
		$first_name = $last_name = $email = $password = $gender	= $registeredVia = $dateofbirth = $image = '';
		$device_type = '';
		$device_token = '';
		if(@$post['first_name']!=''){ $first_name = $post['first_name'];}
		if(@$post['last_name']!=''){ $last_name = $post['last_name'];}
		if(@$post['email']!=''){ $email = $post['email'];}
		if(@$post['mobile']!=''){ $mobile = $post['mobile'];}
		if(@$post['registeredVia']!=''){ $registeredVia = $post['registeredVia']; }
		if(@$post['dateofbirth']!=''){ $dateofbirth = $post['dateofbirth'];}
		if(@$post['password']!=''){ $password = $post['password'];}		
		if(@$post['device_type']!=''){ $device_type = $post['device_type'];}
		if(@$post['device_token']!=''){ $device_token = $post['device_token'];}
	
		if($first_name == '' ){
			$json = array("status"=>0, "statusCode"=>0, "msg" => "First ".ERROR_NAME_REQ);	
		}elseif($user_id == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => ERROR_UID_REQ);	
		}else{
			//$image = '';
			if($_FILES['profile_pic']){
			move_uploaded_file($_FILES["profile_pic"]["tmp_name"],
			"uploads/" . $_FILES["profile_pic"]["name"]);
			$image = $_FILES["profile_pic"]["name"];
			}else{
				$image = '';
			}
			$json = array();	
			$sql = $this->db->query("SELECT * FROM `tbl_user_records` WHERE `id` = '".$user_id."'");
			if($sql->num_rows() > 0){
				$data = $sql->result();
				$array = array( 'first_name' => $first_name, 'last_name' => $last_name, 'address' => $address, 'latitude' => $latitude, 'longitude' => $longitude,'date_of_birth' => $date_of_birth, 'pic' => $alue, 'cover_pic' => $cover_pic, 'office_address' => $office_address, 'peryear_sale' => $peryear_sale, 'office_email' => $office_email, 'office_phone' => $office_phone, 'device_type' => $device_type, 'device_token' => $device_token);
				$update = $this->db->update('tbl_user_records',$array,array("id" => $user_id));
				if($update){
					$json = array("status"=>1, "statusCode"=>1, "msg" => "Successfully Logout!");
				}else{
					$json = array("status"=>1, "statusCode"=>0, "msg" => "Error in Logout!");
				}
			}else{
				$json = array("status"=>1, "statusCode"=>0, "msg" => "User id Does not Exists!!");
			}
		}
		return $json;
	}
	public function getProductWithOffer($post){
		$password = $user_id = $email = '';
		if($post['user_id']!=''){ $user_id = $post['user_id']; }
		if($user_id == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => ERROR_UID_REQ);	
		}else{
			$json = array();	
			$sql = $this->db->query("SELECT * FROM  `tbl_product_records` WHERE `user_id` = '".$user_id."'");
			if($sql->num_rows() > 0){
				$data = $sql->result_array();
				$json = array("status"=>1, "statusCode"=>1, "msg" => "User are available!!");
				foreach($data as $dt){
					$product_id = $dt['product_id'];
					$offer_list = $this->offerList($product_id);
					$product_images = $this->productImageList($product_id);
					$json['product_list'][] = array_merge($dt,array("offer_list" => $offer_list, "product_images" => $product_images));
				}
			}else{
				$json = array("status"=>1, "statusCode"=>0, "msg" => NO_RECORD_FOUND);
			}
		}
		return $json;
	}
	public function getProductWithOfferDetails($post){
		$product_id = '';
		if($post['product_id']!=''){ $product_id = $post['product_id']; }
		if($product_id == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => ERROR_PID_REQ);	
		}else{
			$json = array();	
			$sql = $this->db->query("SELECT * FROM `tbl_product_records` WHERE `product_id` = '".$product_id."'");
			if($sql->num_rows() > 0){
				$data = $sql->result_array();
			
				$offer_list = $this->offerList($product_id);
					$product_images = $this->productImageList($product_id);
					$json['product_details'] = array_merge($dt,array("offer_list" => $offer_list, "product_images" => $product_images));
			}else{
				$json = array("status"=>1, "statusCode"=>0, "msg" => NO_RECORD_FOUND);
			}
		}
		return $json;
	}
	public function offerList($product_id){
			$data = array();
			$sql = $this->db->query("SELECT * FROM `tbl_offers_records` WHERE `product_id` = '".$product_id."'");
			if($sql->num_rows() > 0){
				$data = $sql->result_array();
			}
		return $data;
	}
	public function productImageList($product_id){
			$data = array();
			$sql = $this->db->query("SELECT `product_image_id`, `image_url` FROM `tbl_product_images` WHERE `product_id` = '".$product_id."'");
			if($sql->num_rows() > 0){
				$data = $sql->result_array();
			}
		return $data;
	}
	//delete offers
	public function DeleteOffer($post){
			$data = array();
			$sql = $this->db->query("DELETE * FROM `tbl_offers_records` WHERE `offer_id` ='".$product_id."' ");
			if($sql->num_rows() > 0){
				$data = $sql->result_array();
			}
		return $data;
	}
	public function DeleteProduct($post){
		$product_id = '';
		if($post['product_id']!=''){ $product_id = $post['product_id']; }
		if($product_id == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => ERROR_PID_REQ);	
		}else{
			$json = array();	
			$sql = $this->db->query("SELECT * FROM `tbl_product_records` WHERE `product_id` = '".$product_id."'");
			if($sql->num_rows() > 0){
				$data = array();
				$sql = $this->db->query("DELETE * FROM `tbl_product_records` WHERE `product_id` ='".$product_id."' ");
				$sql = $this->db->query("DELETE * FROM `tbl_offers_records` WHERE `product_id` ='".$product_id."' ");
				if($sql){
					$json = array("status"=>1, "statusCode"=>1, "msg" => "Successfully Deleted!");
				}
			}else{
				$json = array("status"=>1, "statusCode"=>0, "msg" => "Invalid Product Id!");
			}
		}
		return $json;
			
	}
//Add offers
	public function addOffer($product_id){
		$data = array();
		$product_id	 = isset($post['product_id'])?$post['product_id']:'';
		$offer_title =  isset($post['offer_title'])?$post['offer_title']:'';
		$start_date	 =  isset($post['start_date'])?$post['start_date']:'';
		$end_date	 =  isset($post['end_date'])?$post['end_date']:'';
		$location	 =  isset($post['location'])?$post['location']:'';
		$sponsered	 =  isset($post['sponsered'])?$post['sponsered']:'';

		if($offer_id == '' ){
			$json = array("status"=>0, "statusCode"=>0, "msg" => OFFER_ID_REQURED);	
		}elseif($product_id == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => "");	
		}elseif($offer_title == ''){
				$json = array("status"=>0, "statusCode"=>0, "msg" => "");
		}elseif($start_date == ''){
				$json = array("status"=>0, "statusCode"=>0, "msg" => "");
		}elseif($end_date == ''){
				$json = array("status"=>0, "statusCode"=>0, "msg" => "");
		}else{
				$json = array();	
				$sqlIns = mysql_query("INSERT INTO `tbl_offers_records`(`product_id`, `offer_title`, `start_date`, `end_date`, `added_date`, `status`, `sponsered`,`location`) VALUES ('".$product_id."', '".$offer_title."', '".$start_date."', '".$end_date."','".$added_date."','".$status."','".$sponsered."','".$location."' )");
				$lastId = mysql_insert_id();
				if($sqlIns){
				$json = array("status"=>1, "statusCode"=>1, "offer_id" => $lastId, "msg" => "");
				}else{
				$json = array("status"=>1, "statusCode"=>0, "msg" => "");	
				}

			}
		}

	return $json;

	}
		


	
} 