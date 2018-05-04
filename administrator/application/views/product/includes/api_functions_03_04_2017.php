<?php 
include('includes/config.php'); 
//functions
//user login
error_reporting(0);
function userLogin($post){	
	$userName = '';
	$userPass ='';
	if($post['user_name']!=''){
		$userName = $post['user_name'];	
	}
	if($post['password']!=''){
		$userPass = $post['password'];	
	}
	if($post['device_token']!=''){
		$device_token = $post['device_token'];	
	}
	if($post['device_key']!=''){
		$device_key = $post['device_key'];	
	}
	if($userName == '' && $userPass == ''){
		$json = array("status"=>0, "statusCode"=>0, "msg" => ERROR_USER_AND_PASS_REQ);	
	}else if($userName == ''){
		$json = array("status"=>0, "statusCode"=>0, "msg" => RROR_USER_REQ);	
	}else if($userPass == ''){
		$json = array("status"=>0, "statusCode"=>0, "msg" => ERROR_PASS_REQ);	
	}else{
		$json = array();	
		/*$json = "SELECT * FROM `tbl_users_records` WHERE (`email` = '".$userName."' OR `mobile` = '".$userName."') AND `password` = '".md5($userPass)."' AND  `status` = 1";
		return $json;*/
		$sql = mysql_query("SELECT * FROM `tbl_users_records` WHERE (`email` = '".$userName."' OR `mobile` = '".$userName."') AND `password` = '".md5($userPass)."' AND  `status` = 1") or die(mysql_error());
		$num = mysql_num_rows($sql);
	if($num > 0){
		$data = mysql_fetch_object($sql);
		$token_id = mt_rand(10000,999999);
		$json = array("status"=>1, "statusCode"=>1, "msg" => LOGIN_SUCC_MSG);	
		$json['user_deatils'] = array("user_id" =>$data->user_id ,"name" =>$data->name, "email" => $data->email, "mobile" => $data->mobile,"token_id" => $token_id,"image"=> BASE_URLD.'user_pic/'.$data->image);
	     $update= mysql_query("UPDATE `tbl_users_records` SET `device_token`='".$device_token."',`device_key`='".$device_key."',`token_id`='".$token_id."' WHERE `user_id`='".$data->user_id."'");
			
	}else{
		$json = array("status"=>1, "statusCode"=>0, "msg" => ERR_LOGIN);
		}
	}
	return $json;
}
 //User Registration
function userRegister($post){
	    $name 	  = '';
		$email	   = '';
		$password  ='';
		$company_name  = '';	
		$userPass  = '';
		$dob       = '';
		$image     = '';
		$mobile    ='';
		$device_key = '';
		$device_id = '';
		if(@$post['name']!=''){ $name = $post['name'];}
		if(@$post['email']!=''){ $email = $post['email'];}
		if(@$post['mobile']!=''){ $mobile = $post['mobile'];}
		if(@$post['password']!=''){ $password = $post['password'];}
		if(@$post['company_name']!=''){ $company_name = $post['company_name'];}
		if(@$post['mobile']!=''){ $mobile = $post['mobile'];}   
		if(@$post['device_key']!=''){ $device_key = $post['device_key'];}   
		if(@$post['device_id']!=''){ $device_id = $post['device_id'];}        
		
		if($name == '' ){
			$json = array("status"=>0, "statusCode"=>0, "msg" => ERROR_NAME_REQ);	
		}else if($email == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => ERROR_EMAIL_REQ);	
		}else if($password == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => ERROR_PASS_REQ);	
		}else{
			$json = array();	
			$sql = mysql_query("SELECT * FROM `tbl_users_records` WHERE `email` = '".$email."'");
		if(mysql_num_rows($sql)> 0){
				$json = array("status"=>1, "statusCode"=>0, "msg" => ERROR_EMAIL_ALREADY_EXISTS);
		}else{
		$json = array();	
		$sql = mysql_query("SELECT * FROM `tbl_users_records` WHERE `email` = '".$email."'");
	if(mysql_num_rows($sql) > 0){
			$json = array("status"=>1, "statusCode"=>0, "msg" => ERROR_EMAIL_ALREADY_EXISTS);
	}else{
		//$otp_no = mt_rand(10000,999999);
		//sendOtp($mobile,$otp_no);
		$profile_pic = '';
		if($_FILES['profile_pic']){
		move_uploaded_file($_FILES["profile_pic"]["tmp_name"],
		"user_pic/" . $_FILES["profile_pic"]["name"]);
		$profile_pic = $_FILES["profile_pic"]["name"];
		}else{
			$profile_pic = '';
		}
/*        return "INSERT INTO `tbl_users_records`(`name`,`email`, `password`, `company_name`, `mobile`, `image`,`gender`,`device_token`, `device_key`, `status`, `date_added`, `reg_from`) VALUES ('".$name."','".$email."','".md5($password)."','".$company_name."','".$mobile."','".$profile_pic."','".$device_id."','".$device_key."','1','".date('y-m-d H:i:s')."','M')";*/
		$sqlIns = mysql_query("INSERT INTO `tbl_users_records`(`name`,`email`, `password`, `company_name`, `mobile`, `image`,`device_token`, `device_key`, `status`, `date_added`, `reg_from`,`plain_password`) VALUES ('".$name."','".$email."','".md5($password)."','".$company_name."','".$mobile."','".$profile_pic."','".$device_id."','".$device_key."','1','".date('y-m-d H:i:s')."','M','".$password."')");
				$to = $email;
				$subject = 'Welcome to Event Management!: ANCE 2017';
				$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
<table width="600" border="0" cellpadding="0" cellpadding="0" style="border: 1px solid rgb(0, 0, 0); font: 15px/22px calibri;" >
  <tr>
    <td colspan="3"  bgcolor="#336699"><br/><br/><br/></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td style="padding:20px">
	<p>Welcome '.$name.',</p>
    <p>Thank you for your registering with ANCE. You\'re all set to now Explore and connect with like minded professionals.</p>

<p>With this account, you can update your profile, Upload feeds & check the future event Listings, Add/Remove Friends, Speakers, news, blogs and much more. If you have any further concerns you can reach us on info@asiannetworkers.com </p>

<p>Please Login with the following account details: </p>
<p>&nbsp;</p>
<p>Email ID: <strong>'.$email.'</strong><br />
Mobile #: <strong>'.$mobile.'</strong><br />
Password: <strong>'.$password.'</strong><br />
</p>
<p>Thank you for your presence ! We look forward to welcoming you to the world of networking !</p>
<p>
Warm Regards,<br />

Shahin Noble Pilli<br />
Founder & CEO <br />
Asian Networkers Convention & Expo</p>
	  </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"  bgcolor="#336699"><br/><br/><br/></td>
  </tr>
</table>
<body>
</body>
</html>';
			  // Always set content-type when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			
			// More headers
			$headers .= 'From: ANCE 2017< admin@innoappstech.com>' . "\r\n";
			//$headers .= 'Cc: dipak.yts@gmail.com' . "\r\n";

$mail = mail($to,$subject,$message,$headers);

		$lastId = mysql_insert_id();
			if($sqlIns){
			$json = array("status"=>1, "statusCode"=>1, "user_id" => $lastId, "msg" => REGISTER_SUCCESS);
			}else{
			$json = array("status"=>1, "statusCode"=>0, "msg" => REGISTER_ERROR);	
			}
		}
	}
  }
	return $json;
}
//Forgot Password
function forgotPassword($post){
	$password = $user_id = $email = '';
	if($post['user_id']!=''){ $user_id = $post['user_id']; }
	if($post['email']!=''){	$email = $post['email']; }
	if($post['password']!=''){ $password = $post['password']; }
	if($user_id == ''){
		if($email == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => ERROR_EMAIL_REQ);	
		}else{
			$json = array();	
			$sql = mysql_query("SELECT * FROM `tbl_users_records` WHERE `email` = '".$email."'");
			if(mysql_num_rows($sql) > 0){
				$data = mysql_fetch_object($sql);
				$to = $data->email;
				$subject = 'Forgot Password: ANCE 2017';
				$message = '<table width="600" border="0" cellpadding="0" cellpadding="0" style="border: 1px solid rgb(0, 0, 0); font: 15px/22px calibri;" ><tr><td colspan="3"  bgcolor="#336699"><br/><br/><br/></td></tr><tr><td>&nbsp;</td><td style="padding:20px"><p>Hello '.$data->name.',</p>
    <p>We got a request to recover your password. <br />Here is your password:  <strong>'.$data->plain_password.'</strong> <br />If you don\'t request to recover password let us know.  <br /><br /><br />Warm Regards,<br />Shahin Noble Pilli<br />Founder & CEO <br />Asian Networkers Convention & Expo<br /></td><td>&nbsp;</td></tr><tr><td colspan="3"  bgcolor="#336699"><br/><br/><br/></td>
  </tr></table>';
			  // Always set content-type when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			
			// More headers
			$headers .= 'From: ANCE 2017< admin@innoappstech.com>' . "\r\n";
			//$headers .= 'Cc: dipak.yts@gmail.com' . "\r\n";

$mail = mail($to,$subject,$message,$headers);
				$otp_no = mt_rand(10000,999999);
				//sendOtp($phone,$otp_no);
				$json = array("status"=>1, "statusCode"=>1, "msg" => "Your password has been Sent successfully!");	
				$json['otp_deatils'] = array("otp_no" =>$otp_no ,"mobile" => $data->mobile,"user_id" => $data->user_id);
			}else{
				$json = array("status"=>1, "statusCode"=>0, "msg" => ERROR_EMAIL_NOT_EXISTS);
			}
		}
	}else{
		if($password == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => ERROR_PASS_REQ);	
		}else{
			$json = array();	
			$sql = mysql_query("SELECT * FROM `tbl_users_records` WHERE `user_id` = '".$user_id."'");
			if(mysql_num_rows($sql) > 0){
				$data = mysql_fetch_object($sql);
				$update = mysql_query("UPDATE `tbl_users_records` SET `password` = '".md5($password)."' WHERE `user_id` = '".$data->user_id."'");
				if($update){
					$json = array("status"=>1, "statusCode"=>1, "msg" => "Password Sussfully Changed!!");
				}else{
					$json = array("status"=>1, "statusCode"=>0, "msg" => "Password not Changed!!");
				}	
			}else{
				$json = array("status"=>1, "statusCode"=>0, "msg" => ERROR_EMAIL_NOT_EXISTS);
			}
		}
	}
	return $json;
	}
//Change Password
function changePasword($post){
	$user_id = '';
	$password = '';
	if($post['user_id']!=''){
		$user_id = $post['user_id'];	
	}
	if($post['password']!=''){
		$password = $post['password'];	
	}
	if($user_id == ''){
		$json = array("status"=>0, "statusCode"=>0, "msg" => ERROR_UID_REQ);	
	}else if($password == ''){
		$json = array("status"=>0, "statusCode"=>0, "msg" => ERROR_PASS_REQ);	
	}else{
		$json = array();	
		$sql = mysql_query("SELECT * FROM `tbl_users_records` WHERE `user_id` = '".$user_id."'");
	if(mysql_num_rows($sql) > 0){
		$data = mysql_fetch_object($sql);
		$sqlUp = mysql_query("UPDATE `tbl_users_records` SET `password` = '".md5($password)."', `plain_password` = '".$password."' WHERE `user_id` = '".$user_id."'");
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
function getEventSearchListing($post){
	$checkToken = checkTokenKey();
	if($checkToken){
		$user_id = $search_text = '';
		if(@$post['search_text']!=''){ $search_text = $post['search_text'];}	
		if($search_text == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => "Search Text Should Not be Blank!");	
		}else{
			$sql = mysql_query("SELECT `event_id`, `event_name`, `event_description`, `image`, `status`, `added_date` FROM `tbl_event_records` WHERE `status` = 1 AND `event_name` LIKE '%".$search_text."%'");
			if(mysql_num_rows($sql) > 0){
			$json[] = array();
			$pub_rtng[] =array();
			$media_detail =array();
			  $json = array("status"=>1, "statusCode"=>1, "msg" => mysql_num_rows($sql).' '.RECORD_FOUND);	
				while($data = mysql_fetch_object($sql)){
				$json['event_listing'][] = $data;
				}
			}else{
				$json = array("status"=>1, "statusCode"=>0, "msg" => NO_RECORD_FOUND);
			}
		}	
	}else{
		$json = array("status"=>0, "statusCode"=>0, "msg" => INVALID_TOKEN );
	}
	return $json;
}
function checkTokenKey(){
	/* $headers = getallheaders();
	$token_id = $headers['Token-Id'];
	$sql = mysql_query("SELECT * FROM `tbl_pub_records` WHERE `token_id` = '".$token_id."'");
	$result = 0;
	if($token_id){
		$result = 1;
	}*/
	$result = 1;
	return $result;
}
// send OTP
function sendOtp($phone,$otp){
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
function giveMeRandNumber($count){
    $array = array();
    for($i = 0; $i <= $count; $i++) {
        $array[] = mt_rand(); 
    }
	return $array;
}	
function getEventList($post){
			if(@$post['user_id']!=''){ $user_id = $post['user_id'];}else{ $user_id = '';}
			if(@$post['page']!=''){ $page = $post['page'];}else{ $page = '';}
			if(@$post['max']!=''){ $max = $post['max'];}else{ $max = '';}
			$str = '';
			if($page!='' && $page!='0' && $max!='' && $max!='0'){
				$start = ($page-1)*$max;
				$str = " LIMIT $start, $max";
			}
			$sql = mysql_query("SELECT `event_id`, `event_name`, `event_description`, `image`, `latitude`,`longitude`,`user_id`, `status`, `added_date` FROM `tbl_event_records` ORDER BY `added_date` DESC $str");
			$json['event_list'] = array();
			if(mysql_num_rows($sql) > 0){
				$json = array("status"=>1, "statusCode"=>1, "msg" => mysql_num_rows($sql).' '.RECORD_FOUND);	
				while($data = mysql_fetch_assoc($sql)){
				$sqlTotal = mysql_query("SELECT * FROM `tbl_event_favorite` WHERE `event_id` = '".$data['event_id']."' AND `like_val` = '1'");
				$numTotal = mysql_num_rows($sqlTotal);
				$sqlL = mysql_query("SELECT * FROM `tbl_event_favorite` WHERE `event_id` = '".$data['event_id']."' AND `user_id` = '".$user_id."' AND `like_val` = '1'");
				$num = mysql_num_rows($sqlL);
				$like_val = 0;
				if($num > 0){
					$row = mysql_fetch_object($sqlL);
					$like_val = $row->like_val;
				}
				$json['event_list'][] = array_merge($data,array("image" => BASE_URLD.'event_pic/'.$data['image'], "user_name" => getUserName($data['user_id']),"user_image" => getUserImage($data['user_id']),"user_email" => getUserEmail($data['user_id']),"user_phone" => getUserPhone($data['user_id']), "total_like" => $numTotal, "like_val" => $like_val, "added_date" => date("d M Y", strtotime($data['added_date'])).' at '.date("H:i A", strtotime($data['added_date']))));
				}
			}else{
				$json = array("status"=>1, "statusCode"=>0, "msg" => NO_RECORD_FOUND);
			}
	return $json;
}
function getUserEventList($post){
			if(@$post['user_id']!=''){ $user_id = $post['user_id'];}else{ $user_id = '';}
			if(@$post['page']!=''){ $page = $post['page'];}else{ $page = '';}
			if(@$post['max']!=''){ $max = $post['max'];}else{ $max = '';}
			$str = '';
			if($page!='' && $page!='0' && $max!='' && $max!='0'){
				$start = ($page-1)*$max;
				$str = " LIMIT $start, $max";
			}
		if($user_id == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => ERROR_UID_REQ);	
		}else{
			$sql = mysql_query("SELECT `event_id`, `event_name`, `event_description`, `image`, `latitude`,`longitude`,`user_id`, `status`, `added_date` FROM `tbl_event_records` WHERE `user_id` = '".$user_id."' ORDER BY `added_date` DESC $str");
			$json['event_list'] = array();
			if(mysql_num_rows($sql) > 0){
				$json = array("status"=>1, "statusCode"=>1, "msg" => mysql_num_rows($sql).' '.RECORD_FOUND);	
				while($data = mysql_fetch_assoc($sql)){
				$sqlTotal = mysql_query("SELECT * FROM `tbl_event_favorite` WHERE `event_id` = '".$data['event_id']."' AND `like_val` = '1'");
				$numTotal = mysql_num_rows($sqlTotal);
				$json['event_list'][] = array_merge($data,array("image" => BASE_URLD.'event_pic/'.$data['image'], "user_name" => getUserName($data['user_id']),"user_image" => getUserImage($data['user_id']),"user_email" => getUserEmail($data['user_id']),"user_phone" => getUserPhone($data['user_id']), "total_like" => $numTotal, "added_date" => date("d M Y", strtotime($data['added_date'])).' at '.date("H:i A", strtotime($data['added_date']))));
				}
			}else{
				$json = array("status"=>1, "statusCode"=>0, "msg" => NO_RECORD_FOUND);
			}
		}	
	return $json;
}
function addEvent($post){
 	$checkToken = checkTokenKey();
	if($checkToken){
		if(@$post['user_id']!=''){ $user_id = $post['user_id'];}
		if(@$post['event_title']!=''){ $event_title = $post['event_title'];}
		if(@$post['latitude']!=''){ $latitude = $post['latitude'];}
		if(@$post['longitude']!=''){ $longitude = $post['longitude'];}
        if(@$post['event_description']!=''){ $event_description = $post['event_description'];}
        if(@$post['event_pic']!=''){ $event_pic = $post['event_pic'];}
		if($user_id == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => ERROR_UID_REQ);	
		}elseif($event_title == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => "Event Title Should not be Blank!!");	
		}elseif($event_description == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => "Event Desc Should not be Blank!!");	
		}elseif($event_pic){
			$json = array("status"=>0, "statusCode"=>0, "msg" => "Event Image Should not be Blank!!");	
		}else{
            if($_FILES['event_pic']){
            move_uploaded_file($_FILES["event_pic"]["tmp_name"],
            "event_pic/" . $_FILES["event_pic"]["name"]);
            $event_pic = $_FILES["event_pic"]["name"];
            }else{
                $event_pic = '';
            }   
            $sql = mysql_query("SELECT * FROM `tbl_event_records` WHERE `event_name` = '".$event_name."' AND `user_id` = '".$user_id."'");
            $num = mysql_num_rows($sql);
            if($num > 0){
                $json = array("status"=>1, "statusCode"=>0, "msg" => "Event Title Already Exists!!");	
            }else{
                $insertSql = mysql_query("INSERT INTO `tbl_event_records`(`event_name`, `event_description`, `image`, `latitude`,`longitude`, `user_id`, `status`, `added_date`) VALUES ('".$event_title."','".$event_description."','".$event_pic."', '".$latitude."','".$longitude."', '".$user_id."', '1','".date("Y-m-d H:i:s")."')");
                $lastId = mysql_insert_id();
                if($insertSql){
                    $json = array("status"=>1, "statusCode"=>1, "event_id" => $lastId, "msg" => "Event Added Successfully!!");	
                }else{
                    $json = array("status"=>1, "statusCode"=>0, "msg" => "Event not Add!!");	
                }
            }
            
        }
    }
    return $json;
}
function likeFeed($post){
	$user_id = $event_id = $like_val = $comment = '';
	if(@$post['user_id']!=''){ $user_id = $post['user_id'];}
	if(@$post['event_id']!=''){ $event_id = $post['event_id'];}
	if(@$post['like_val']!=''){ $like_val = $post['like_val']; }
	if($user_id == '' ){
	$json = array("status"=>0, "statusCode"=>0, "msg" => ERROR_UID_REQ);	
	}else if($event_id == ''){
	$json = array("status"=>0, "statusCode"=>0, "msg" => "Event id should not be blank");	
	}else{
		$json = array();
		$sql = mysql_query("SELECT * FROM `tbl_event_favorite` WHERE `event_id` = '".$event_id."' AND `user_id` = '".$user_id."'");
		$num = mysql_num_rows($sql);
		if($num > 0){
			$sqlIns = mysql_query("UPDATE `tbl_event_favorite` SET `like_val`='".$like_val."', `updated_date`='".date("Y-m-d H:i:s")."' WHERE `event_id` = '".$event_id."' AND `user_id` = '".$user_id."'");
			if($sqlIns){
				$json = array("status"=>1, "statusCode"=>1,"msg" => ADD_SUCCESS);
			}else{
				$json = array("status"=>1, "statusCode"=>0, "msg" => REGISTER_ERROR);	
			}
		}else{
			$sqlIns = mysql_query("INSERT INTO `tbl_event_favorite`(`event_id`, `user_id`, `like_val`, `added_date`) VALUES ('".$event_id."','".$user_id."','".$like_val."','".date("Y-m-d H:i:s")."')");
			$lastId = mysql_insert_id();
			if($sqlIns){
				$json = array("status"=>1, "statusCode"=>1,"msg" => ADD_SUCCESS);
			}else{
				$json = array("status"=>1, "statusCode"=>0, "msg" => REGISTER_ERROR);	
			}
		}
	}
	return $json;
}
function loginWithFB($post){
		$email	   = '';
		$name	   = '';
		$device_id	   = '';
		$device_key	   = '';
		if(@$post['fb_id']!=''){ $fb_id = $post['fb_id'];}
		if(@$post['email']!=''){ $email = $post['email'];}
		if(@$post['name']!=''){ $name = $post['name'];}
		if($post['device_id']!=''){	$device_id = $post['device_id'];}
		if($post['device_key']!=''){ $device_key = $post['device_key'];}
		
		if($name == '' ){
			$json = array("status"=>0, "statusCode"=>0, "msg" => ERROR_NAME_REQ);	
		}else/* if($fb_id == '' ){
			$json = array("status"=>0, "statusCode"=>0, "msg" => "Facebook Id should not be Blank!!");	
		}else*/ if($email == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => ERROR_EMAIL_REQ);	
		}else{
		
		$json = array();	
		$sql = mysql_query("SELECT * FROM `tbl_users_records` WHERE `email` = '".$email."'");
		if(mysql_num_rows($sql) > 0){
				$data = mysql_fetch_object($sql);
				$json = array("status"=>1, "statusCode"=>1, "msg" => "login Success!!");
				$udid = mysql_query("UPDATE `tbl_users_records` SET  `device_token`='".$device_id."',`device_key`='".$device_key."'WHERE `user_id`='".$data->user_id."'");
				$json['user_deatils'] = array("user_id" =>$data->user_id ,"name" =>$data->name, "email" => $data->email,'DOB' =>  $data->dob );
		}else{

			$sqlIns = mysql_query("INSERT INTO `tbl_users_records`(`name`, `email`, `device_token`,`device_key`) VALUES ('".$name."','".$email."','".$device_id."','".$device_key."')");
			$lastId =mysql_insert_id();
			$sqlDa = mysql_query("SELECT * FROM `tbl_users_records` WHERE `user_id` = '".$lastId."'");
			$data = mysql_fetch_object($sqlDa);
				if($sqlIns){
					$json = array("status"=>1, "statusCode"=>1, "msg" => REGISTER_SUCCESS);
					$json['user_deatils'] = array("user_id" =>$data->user_id ,"name" =>$data->name, "email" => $data->email );
				}else{
					$json = array("status"=>1, "statusCode"=>0, "msg" => REGISTER_ERROR);	
				}
			}
		}
		return $json;
	}
function socialLogin($post){
		$email = $name = $device_id	= $social_id = $social_key = $device_key = '';
		if(@$post['email']!=''){ $email = $post['email'];}
		if(@$post['name']!=''){ $name = $post['name'];}
		if($post['device_id']!=''){	$device_id = $post['device_id'];}
		if($post['device_key']!=''){$device_key = $post['device_key'];}
		if($post['social_key']!=''){$social_key = $post['social_key'];}
		if($post['social_id']!=''){ $social_id = $post['social_id'];}
		
		if($name == '' ){
			$json = array("status"=>0, "statusCode"=>0, "msg" => ERROR_NAME_REQ);	
		}else if($social_key == '' ){
			$json = array("status"=>0, "statusCode"=>0, "msg" => "Social Key should not be Blank!!");	
		}else if($social_id == '' ){
			$json = array("status"=>0, "statusCode"=>0, "msg" => "Social Id should not be Blank!!");	
		}else if($email == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => ERROR_EMAIL_REQ);	
		}else{
		
		$json = array();	
		$sql = mysql_query("SELECT * FROM `tbl_users_records` WHERE `email` = '".$email."' OR `".$social_key."` = '".$social_id."'");
		if(mysql_num_rows($sql) > 0){
				$data = mysql_fetch_object($sql);
				$json = array("status"=>1, "statusCode"=>1, "msg" => "login Success!!");
				$udid = mysql_query("UPDATE `tbl_users_records` SET  `device_token`='".$device_id."',`device_key`='".$device_key."',  `".$social_key."` = '".$social_id."' WHERE `user_id`='".$data->user_id."'");
				$json['user_deatils'] = $data;
		}else{

			$sqlIns = mysql_query("INSERT INTO `tbl_users_records`(`name`, `email`, `device_token`,`device_key`, `".$social_key."`) VALUES ('".$name."','".$email."','".$device_id."','".$device_key."', '".$social_id."')");
			$lastId = mysql_insert_id();
			$sqlDa = mysql_query("SELECT * FROM `tbl_users_records` WHERE `user_id` = '".$lastId."'");
			$data = mysql_fetch_object($sqlDa);
				if($sqlIns){
					$json = array("status"=>1, "statusCode"=>1, "msg" => REGISTER_SUCCESS);
					$json['user_deatils'] = $data;
				}else{
					$json = array("status"=>1, "statusCode"=>0, "msg" => REGISTER_ERROR);	
				}
			}
		}
		return $json;	
	}
/*function getUserFriendList($post){
$checkToken = checkTokenKey();
	if($checkToken){
		if(@$post['user_id']!=''){ $user_id = $post['user_id'];}
		if($user_id == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => ERROR_UID_REQ);	
		}
		else{
		$sql = mysql_query("SELECT * FROM `tbl_user_friend` WHERE (`user_id`='".$user_id."' OR user_frnd_id = '".$user_id."') AND `status` = '1'");
		$num = mysql_num_rows($sql);
		if($num > 0){
		$json = array();
		$json = array("status"=>1, "statusCode"=>1,"msg" => mysql_num_rows($sql).' '.RECORD_FOUND);		
				while($data = mysql_fetch_object($sql)){
				$json['user_friend_list'][] = array("user_friend_id"=> $data->user_frnd_id,"user_friend_name"=> getUserName($data->user_frnd_id),"user_friend_image"=> getUserImage($data->user_frnd_id),"user_friend_email" => getUserEmail($data->user_frnd_id),"user_friend_phone" => getUserPhone($data->user_frnd_id));
			  }
			}
		else{
			$json = array("status"=>1, "statusCode"=>0,"msg" => NO_RECORD_FOUND);
		   }
			}
			}else{
				$json = array("status"=>0, "statusCode"=>0, "msg" => INVALID_TOKEN);
			 }	
return $json;
}*/
function getUserFriendList($post){
$checkToken = checkTokenKey();
	if($checkToken){
		if(@$post['user_id']!=''){ $user_id = $post['user_id'];}
		if($user_id == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => ERROR_UID_REQ);	
		}
		else{
		$sql = mysql_query("SELECT * FROM `tbl_user_friend` WHERE `user_id`='".$user_id."' AND `status` = '1'");
		$num = mysql_num_rows($sql);
		$CHK = 0;
		if($num > 0){
		$CHK = 1;
		$input = array();
		
				while($data = mysql_fetch_object($sql)){
				$input[] = array("user_friend_id"=> $data->user_frnd_id,"user_friend_name"=> getUserName($data->user_frnd_id),"user_friend_image"=> getUserImage($data->user_frnd_id),"user_friend_email" => getUserEmail($data->user_frnd_id),"user_friend_phone" => getUserPhone($data->user_frnd_id),"status" => $data->status);
			  }
			}
		$sql = mysql_query("SELECT * FROM `tbl_user_friend` WHERE `user_frnd_id`='".$user_id."' AND (`status` = '0' OR `status` = '1')");
		$num = mysql_num_rows($sql);
		if($num > 0){
				$CHK = 1;
				while($data = mysql_fetch_object($sql)){
				$input[] = array("user_friend_id"=> $data->user_id,"user_friend_name"=> getUserName($data->user_id),"user_friend_image"=> getUserImage($data->user_id),"user_friend_email" => getUserEmail($data->user_id),"user_friend_phone" => getUserPhone($data->user_id),"status" => $data->status);
			  }
			}	
			//$input = array_map("unserialize", array_unique(array_map("serialize", $input)));
			$json = array("status"=>1, "statusCode"=>1,"msg" => count($input).' '.RECORD_FOUND);
			foreach($input as $d){		
			$json['user_friend_list'][] = $d;
			}
		if($CHK == 0){
			$json = array("status"=>1, "statusCode"=>0,"msg" => NO_RECORD_FOUND);
		}
			}
			}else{
				$json = array("status"=>0, "statusCode"=>0, "msg" => INVALID_TOKEN);
			 }	
return $json;
}
function getUserFriendRequest($post){
$checkToken = checkTokenKey();
	if($checkToken){
		if(@$post['user_id']!=''){ $user_id = $post['user_id'];}
		if($user_id == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => ERROR_UID_REQ);	
		}
		else{
		$sql = mysql_query("SELECT * FROM `tbl_user_friend` WHERE `user_id`='".$user_id."' AND `status` = '0'");
		$num = mysql_num_rows($sql);
		if($num > 0){
		$json = array();
		$json = array("status"=>1, "statusCode"=>1,"msg" => mysql_num_rows($sql).' '.RECORD_FOUND);	
				while($data = mysql_fetch_object($sql)){
				$json['user_friend_list'][] = array("user_friend_id"=> $data->user_frnd_id,"user_friend_name"=> getUserName($data->user_frnd_id),"user_friend_image"=> getUserImage($data->user_frnd_id),"user_friend_phone" => getUserPhone($data->user_frnd_id),"status" => "pending");
			  }
			}
		else{
			$json = array("status"=>1, "statusCode"=>0,"msg" => NO_RECORD_FOUND);
		   }
			}
			}else{
				$json = array("status"=>0, "statusCode"=>0, "msg" => INVALID_TOKEN);
			 }	
return $json;
}
function addUserFriendList($post){
	$checkToken = checkTokenKey();
	if($checkToken){
		if(@$post['user_id']!=''){ $user_id = $post['user_id'];}
		if(@$post['friend_ids']!=''){ $friend_ids = $post['friend_ids'];}
		if($user_id == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => ERROR_UID_REQ);	
		}if($friend_ids == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => "Friend Ids Should not be Blank!!");	
		}else{
			$fl = explode(",", $friend_ids);
			foreach($fl as $key=>$val){
				$sql = mysql_query("SELECT * FROM `tbl_user_friend` WHERE `user_id`='".$user_id."' AND `user_frnd_id` = '".$val."'");
				$num = mysql_num_rows($sql);
				if($num < 1){
					$sql = mysql_query("INSERT INTO `tbl_user_friend`(`user_id`, `user_frnd_id`, `status`, `added_date`) VALUES ('".$user_id."','".$val."','0','".date("Y-m-d")."')");
				}
			}
			$json = array("status"=>1, "statusCode"=>1, "msg" => "Successfully Added");
		}
	}else{
		$json = array("status"=>0, "statusCode"=>0, "msg" => INVALID_TOKEN);
	}	
	return $json;
}
function actionUserFriendList($post){
	$checkToken = checkTokenKey();
	if($checkToken){
		$user_id = $friend_id = $act_val = '';
		if(@$post['user_id']!=''){ $user_id = $post['user_id'];}
		if(@$post['friend_id']!=''){ $friend_id = $post['friend_id'];}
		if(@$post['act_val']!=''){ $act_val = $post['act_val'];}
		if($user_id == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => ERROR_UID_REQ);	
		}elseif($friend_id == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => "Friend Id Should not be Blank!!");	
		}elseif($act_val == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => "Action Value Should not be Blank(accept=1,reject=2)!!");	
		}else{
		
				$sql = mysql_query("SELECT * FROM `tbl_user_friend` WHERE (`user_id`='".$user_id."' AND `user_frnd_id` = '".$friend_id."') OR (`user_id`='".$friend_id."' AND `user_frnd_id` = '".$user_id."')");
				$num = mysql_num_rows($sql);
				if($num > 0){
					$row = mysql_fetch_object($sql);
							if($act_val == '0'){
								$type = 'friend_request';
								$title = 'Friend Request';
								$dt = addNotificationData($user_id,$friend_id,$type,$title,'');
							}elseif($act_val == '1'){
								$type = 'friend_response';
								$title = 'Respond Friend Request';
								$dt = addNotificationData($user_id,$friend_id,$type,$title,'');
							}
							//return $dt;
					if($act_val == '2'){
					$sql = mysql_query("DELETE FROM `tbl_user_friend` WHERE `tbl_id` = '".$row->tbl_id."'");
					$json = array("status"=>1, "statusCode"=>1, "msg" => "Successfully Removed");
					}else{
					$sql = mysql_query("UPDATE `tbl_user_friend` SET `status`='".$act_val."',`updated`='".date("Y-m-d")."' WHERE `tbl_id` = '".$row->tbl_id."'");
					$json = array("status"=>1, "statusCode"=>1, "msg" => "Successfully Updated");
					}
				}else{
					$sql = mysql_query("INSERT INTO `tbl_user_friend`(`user_id`, `user_frnd_id`, `status`, `added_date`) VALUES ('".$user_id."','".$friend_id."','".$act_val."','".date("Y-m-d")."')");
					$json = array("status"=>1, "statusCode"=>1, "msg" => "Successfully Added");
				}
			}
			
	}else{
		$json = array("status"=>0, "statusCode"=>0, "msg" => INVALID_TOKEN);
	}	
	return $json;
}
function getUserName($user_id){
		$sql = mysql_query("SELECT * FROM `tbl_users_records` WHERE `user_id`='".$user_id."'");
		$num = mysql_num_rows($sql);
		$user_name='';
		if($num > 0){
				while($data = mysql_fetch_object($sql)){
				$user_name = $data->name;
			  }
			}
return $user_name;
}
function getUserImage($user_id){
		$sql = mysql_query("SELECT * FROM `tbl_users_records` WHERE `user_id`='".$user_id."'");
		$num = mysql_num_rows($sql);
			if($num > 0){
				$data = mysql_fetch_object($sql);
				$image = BASE_URLD.'user_pic/'.$data->image;
			}
return $image;
}
function getUserEmail($user_id){
		$sql = mysql_query("SELECT * FROM `tbl_users_records` WHERE `user_id`='".$user_id."'");
		$num = mysql_num_rows($sql);
			if($num > 0){
				$data = mysql_fetch_object($sql);
				$email =$data->email;
			}
return $email;
}
function getUserPhone($user_id){
		$sql = mysql_query("SELECT * FROM `tbl_users_records` WHERE `user_id`='".$user_id."'");
		$num = mysql_num_rows($sql);
			if($num > 0){
				$data = mysql_fetch_object($sql);
				$mobile =$data->mobile;
			}
return $mobile;
}
function getUserProfile($post){
$checkToken = checkTokenKey();
	if($checkToken){
		if(@$post['user_id']!=''){ $user_id = $post['user_id'];}
		if($user_id == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => ERROR_UID_REQ);	
		}
		else{
		$sql = mysql_query("SELECT * FROM `tbl_users_records` WHERE `user_id`='".$user_id."'");
		$num = mysql_num_rows($sql);
		if($num > 0){
		$json = array();
		$json = array("status"=>1, "statusCode"=>1,"msg" => mysql_num_rows($sql).' '.RECORD_FOUND);	
				$data = mysql_fetch_object($sql);
				$json['user_profile'] = array("name" => $data->name,"mobile"=>$data->mobile,"email"=>$data->email,"image"=> BASE_URLD.'user_pic/'.$data->image,"company_name"=> $data->company_name);

			}
		else{
			$json = array("status"=>1, "statusCode"=>0,"msg" => NO_RECORD_FOUND);
		   }
			}
			}else{
				$json = array("status"=>0, "statusCode"=>0, "msg" => INVALID_TOKEN);
			 }	
return $json;
}
function updateUserProfile($post){
		if(@$post['user_id']!=''){ $user_id = $post['user_id'];}
		if(@$post['name']!=''){ $name = $post['name'];}
		if(@$post['company_name']!=''){ $company_name = $post['company_name']; }
		if(@$post['mobile']!=''){ $mobile = $post['mobile'];}
		if(@$post['profile_pic']!=''){ $profile_pic = $post['profile_pic'];}
		if($user_id == '' ){
			$json = array("status"=>0, "statusCode"=>0, "msg" => ERROR_UID_REQ);	
		}else if($name == '' ){
			$json = array("status"=>0, "statusCode"=>0, "msg" => "User name Required");	
		}else{
		$json = array();
		if($_FILES['profile_pic']){
		move_uploaded_file($_FILES["profile_pic"]["tmp_name"],
		"user_pic/" . $_FILES["profile_pic"]["name"]);
		$profile_pic = $_FILES["profile_pic"]["name"];
		}else{
			$profile_pic = '';
		}
		$clouse = '';
		if($name!=''){ $clouse.= "`name`='".$name."', ";}
		if($gender!=''){ $clouse.= "`gender`='".$gender."', ";}
		if($company_name!=''){ $clouse.= "`company_name`='".$company_name."', ";}
		if($mobile!=''){ $clouse.= "`mobile`='".$mobile."', ";}
		if($profile_pic!=''){ $clouse.= "`image`='".$profile_pic."', ";}
		$data = rtrim(', ', $clouse);
		$clouse = substr($clouse,0,strlen($clouse)-2); 
		//return "UPDATE `tbl_users_records` SET $clouse WHERE `user_id`='".$user_id."'";
		$sqlIns = mysql_query("UPDATE `tbl_users_records` SET $clouse WHERE `user_id`='".$user_id."'");
			if($sqlIns){
			$json = array("status"=>1, "statusCode"=>1,"msg" => "Updated Successfully");
			}else{
			$json = array("status"=>1, "statusCode"=>0, "msg" => "Not Updated");	
			}
	}
	return $json;
}
function updateTokenId($post){
	$user_id = $device_token = $device_key = '';
	if(@$post['user_id']!=''){ $user_id = $post['user_id'];}
	if(@$post['device_token']!=''){ $device_token = $post['device_token'];}
	if(@$post['device_key']!=''){ $device_key = $post['device_key'];}
	if($user_id == ''){
	$json = array("status"=>0, "statusCode"=>0, "msg" => ERROR_UID_REQ);	
	}elseif($device_token == ''){
	$json = array("status"=>0, "statusCode"=>0, "msg" => "Device Token should Not be Blank");	
	}elseif($device_key == ''){
	$json = array("status"=>0, "statusCode"=>0, "msg" => "Device Key should Not be Blank");	
	}else{
		$sql = mysql_query("SELECT * FROM `tbl_users_records` WHERE `user_id` = '".$user_id."'");
		$num = mysql_num_rows($sql);
		if($num > 0){
			$sqlIns = mysql_query("UPDATE `tbl_users_records` SET `device_token` = '".$device_token."', `device_key` = '".$device_key."' WHERE `user_id`='".$user_id."'");
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
function searchUserByNameEmail($post){
    $search_text = $user_id = '';
	if(@$post['search_text']!=''){ $search_text = trim($post['search_text']," ");}
	if(@$post['user_id']!=''){ $user_id = $post['user_id'];}
	/*if($search_text == '' ){
	$json = array("status"=>0, "statusCode"=>0, "msg" => "Search Text (Name Or Email) should Not be Blank");	
	}else{*/
		if($search_text != '' ){
			$str = "(`name` LIKE '%".$search_text."%' OR `email` LIKE '%".$search_text."%') AND";
		}
		$sql = mysql_query("SELECT * FROM `tbl_users_records` WHERE $str `user_id` != '".$user_id."'");
		$num = mysql_num_rows($sql);
		if($num > 0){
			$json = array("status"=>1, "statusCode"=>1,"msg" => $num.' '.RECORD_FOUND);
            while($row = mysql_fetch_object($sql)){
				$s = mysql_query("SELECT * FROM `tbl_user_friend` WHERE `user_id` = '".$user_id."' AND `user_frnd_id` = '".$row->user_id."'");
				$status = '';
				$ro = mysql_fetch_object($s);
				if($ro->status != ''){ $status = $ro->status; }
                $json['user_list'][] = array('user_id' => $row->user_id, 'name' => $row->name, 'email' => $row->email, 'user_pic' => getUserImage($row->user_id),"user_phone" => getUserPhone($row->user_id),"status" => $status);
            }
		}else{
			$json = array("status"=>1, "statusCode"=>0,"msg" => NO_RECORD_FOUND);
		}
	/*}*/
	return $json;
}
function getPubFriendRateList($post){
	$checkToken = checkTokenKey();
	if($checkToken){
		$pub_id = $user_id = '';
		if(@$post['pub_id']!=''){ $pub_id = $post['pub_id'];}	
		if(@$post['user_id']!=''){ $user_id = $post['user_id'];}	
		if($pub_id == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => "Pub Id Should Not be Blank!");	
		}elseif($user_id == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => "User Id Should Not be Blank!");	
		}else{
			$json['friend_list'] = array();
			$sql = mysql_query("SELECT `tbl_pub_rate_review`.`rating_value`,`tbl_user_friend`.`user_frnd_id` FROM `tbl_user_friend`,`tbl_pub_rate_review` WHERE `tbl_pub_rate_review`.`user_id` = `tbl_user_friend`.`user_frnd_id` AND `tbl_user_friend`.`user_id` = '".$user_id."' AND `tbl_pub_rate_review`.`pub_id` = '".$pub_id."'");
			if(mysql_num_rows($sql) > 0){
			  $json = array("status"=>1, "statusCode"=>1, "msg" => mysql_num_rows($sql).' '.RECORD_FOUND);	
				while($data = mysql_fetch_array($sql)){
					$json['friend_list'][] = array("friend_id" => $data['user_frnd_id'] ,"friend_name" => getUserName($data['user_frnd_id']), "friend_image" => getUserImage($data['user_frnd_id']), "friend_rate" => $data['rating_value']);
				}
			}else{
				$json = array("status"=>1, "statusCode"=>0, "msg" => NO_RECORD_FOUND);
			}
		}	
	}else{
		$json = array("status"=>0, "statusCode"=>0, "msg" => INVALID_TOKEN );
	}
	return $json;
}
function getAllSpeakers($post){
			$sql = mysql_query("SELECT `speaker_id`, `speaker_name`, `speaker_email`, `speaker_photo`, `speaker_tagline` FROM `tbl_speaker_records` ORDER BY `added_date` DESC");
			$json['speaker_list'] = array();
			if(mysql_num_rows($sql) > 0){
				$json = array("status"=>1, "statusCode"=>1, "msg" => mysql_num_rows($sql).' '.RECORD_FOUND);	
				while($data = mysql_fetch_assoc($sql)){	
				$json['speaker_list'][] = array_merge($data,array("speaker_photo" => BASE_URLD.'speaker_photo/'.$data['speaker_photo']));
				}
			}else{
				$json = array("status"=>1, "statusCode"=>0, "msg" => NO_RECORD_FOUND);
			}
	return $json;
}
function getAllSponsers($post){
			$sql = mysql_query("SELECT * FROM `tbl_sponser_records` ORDER BY `added_date` DESC");
			$json['speaker_list'] = array();
			if(mysql_num_rows($sql) > 0){
				$json = array("status"=>1, "statusCode"=>1, "msg" => mysql_num_rows($sql).' '.RECORD_FOUND);	
				while($data = mysql_fetch_assoc($sql)){	
				$json['sponser_list'][] = array_merge($data,array("sponser_photo" => BASE_URLD.'sponser_photo/'.$data['sponser_photo']));
				}
			}else{
				$json = array("status"=>1, "statusCode"=>0, "msg" => NO_RECORD_FOUND);
			}
	return $json;
}
function getAllAwards($post){
			$sql = mysql_query("SELECT * FROM `tbl_award_records` ORDER BY `added_date` DESC");
			$json['award_list'] = array();
			if(mysql_num_rows($sql) > 0){
				$json = array("status"=>1, "statusCode"=>1, "msg" => mysql_num_rows($sql).' '.RECORD_FOUND);	
				while($data = mysql_fetch_assoc($sql)){	
				$json['award_list'][] = $data;
				}
			}else{
				$json = array("status"=>1, "statusCode"=>0, "msg" => NO_RECORD_FOUND);
			}
	return $json;
}

function getAllAgenda($post){
	$checkToken = checkTokenKey();
	if($checkToken){
			$sql = mysql_query("SELECT `date` FROM `tbl_agenda_records` WHERE `status` = '1' GROUP BY `date`");
			$json['agenda_list'] = array();
			if(mysql_num_rows($sql) > 0){
				$json = array("status"=>1, "statusCode"=>1, "msg" => mysql_num_rows($sql).' '.RECORD_FOUND);	
				while($data = mysql_fetch_assoc($sql)){	
					$agenda_list = array();
					$sql1 = mysql_query("SELECT `agenda_id`, `date`, `agenda_title`, `from_time`, `to_time`, `status`, `added_date` FROM `tbl_agenda_records` WHERE `date` = '".$data['date']."' ORDER BY `agenda_id` ASC");
					if(mysql_num_rows($sql1) > 0){	
						while($data1 = mysql_fetch_assoc($sql1)){	
							$agenda_list[] = $data1;
						}
					}
					$json['agenda_list'][] = array("date" => date("Y-m-d",strtotime($data['date'])),"data" => $agenda_list);
				}
			}else{
			$json = array("status"=>1, "statusCode"=>0, "msg" => NO_RECORD_FOUND);
			}
	}else{
		$json = array("status"=>0, "statusCode"=>0, "msg" => INVALID_TOKEN);
	}	
	return $json;
}
function getAnceRefralList($post){
	$sql = mysql_query("SELECT `refral_id`, `refral_title`, `from_time`, `to_time`, `status`, `added_date` FROM `tbl_refral_records` WHERE `from_time` <= '".date("Y-m-d")."' AND `to_time` >= '".date("Y-m-d")."' AND `status` = '1'");
	$json['refral_list'] = array();
	if(mysql_num_rows($sql) > 0){
		$json = array("status"=>1, "statusCode"=>1, "msg" => mysql_num_rows($sql).' '.RECORD_FOUND);	
		while($data = mysql_fetch_assoc($sql)){	
			$json['refral_list'] = $data;
		}
	}else{
		$json = array("status"=>1, "statusCode"=>0, "msg" => NO_RECORD_FOUND);
	}
	return $json;
}
function addTicket($post){
$checkToken = checkTokenKey();
	if($checkToken){
		$refral_id = $ticket_no = $user_id = '';
		if(@$post['ticket_no']!=''){ $ticket_no = $post['ticket_no'];}	
		if(@$post['user_id']!=''){ $user_id = $post['user_id'];}	
		if($ticket_no == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => "Ticket No Should Not be Blank!");	
		}elseif($user_id == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => "User Id Should Not be Blank!");	
		}else{
		$sql = mysql_query("SELECT * FROM `tbl_refral_records` WHERE `status` = '1' AND `from_time` <= '".date("Y-m-d")."' AND `to_time` >= '".date("Y-m-d")."'");
		if(mysql_num_rows($sql) > 0){
			$row = mysql_fetch_object($sql);
			$refral_id = $row->refral_id;
			$sql = mysql_query("SELECT * FROM `tbl_user_refral_records` WHERE `user_id` = '".$user_id."' AND `refral_id` = '".$refral_id."'");
			if(mysql_num_rows($sql) > 0){
			  $sql = mysql_query("UPDATE `tbl_user_refral_records` SET `ticket_no`= '".$ticket_no."' WHERE `user_id` = '".$user_id."' AND `refral_id` = '".$refral_id."'");
			  if($sql){
			  	 $json = array("status"=>1, "statusCode"=>1, "msg" => "Successfully Updated!");
			  }else{
			     $json = array("status"=>1, "statusCode"=>0, "msg" => "Not added!");
			  }
			}else{
			  $sql = mysql_query("INSERT INTO `tbl_user_refral_records`(`refral_id`, `user_id`, `ticket_no`, `added_date`) VALUES ('".$refral_id."','".$user_id."','".$ticket_no."','".date("Y-m-d")."')");
			  if($sql){
			  	 $json = array("status"=>1, "statusCode"=>1, "msg" => "Successfully Added!");
			  }else{
			     $json = array("status"=>1, "statusCode"=>0, "msg" => "Not added!");
			  }
			}
		}else{
			$json = array("status"=>0, "statusCode"=>0, "msg" => "No Refral Event is Available!" );
		}	
		}	
	}else{
		$json = array("status"=>0, "statusCode"=>0, "msg" => INVALID_TOKEN );
	}
	return $json;
}
function getWinnerList($post){
$checkToken = checkTokenKey();
	if($checkToken){
		$sql = mysql_query("SELECT * FROM `tbl_refral_records` , `tbl_user_refral_records` WHERE `tbl_refral_records`.`refral_id` = `tbl_user_refral_records`.`refral_id` AND `tbl_user_refral_records`.`result` != '0' ORDER BY `tbl_user_refral_records`.`result` ASC LIMIT 10");
		if(mysql_num_rows($sql) > 0){
		  $array = array("0" => "","1" => "Top Rated", "2" => "Second Top", "3" => "Third Top", "4" => "Fourth Top", "5" => "Fifth Top", "6" => "Sixth Top", "7" => "Seventh Top", "8" => "Eighth Top", "9" => "Ninth Top", "10" => "Tenth Top");	
		  $json = array("status"=>1, "statusCode"=>1, "msg" => mysql_num_rows($sql).' '.RECORD_FOUND);
		  while($row = mysql_fetch_object($sql)){
			$s = mysql_query("SELECT `winner_number`,`prize_data` FROM `tbl_refral_records` WHERE `refral_id` = '".$row->refral_id."'");
			$r = mysql_fetch_object($s);
			$prize_data = json_decode($r->prize_data);
			$prizeValue = array();
			foreach($prize_data as $k => $v){
			$prizeValue[$v->sn] = $v->prize_name;
			}
		  $json['winner_list'][] = array("user_id" => $row->user_id, "user_name" => getUserName($row->user_id), "user_image" => getUserImage($row->user_id),"ticket_number" => $row->ticket_no,"result" => $array[$row->result],"tag_line" => $prizeValue[$row->result],"prize_name" => $prizeValue[$row->result]);
		  }
		}else{
			$json = array("status"=>1, "statusCode"=>0, "msg" => NO_RECORD_FOUND);
		}
	}else{
		$json = array("status"=>0, "statusCode"=>0, "msg" => INVALID_TOKEN );
	}
	return $json;
}

function addBlog($post){
$checkToken = checkTokenKey();
	if($checkToken){
		$blog_title = $blog_description = $blog_id = $user_id = '';
		if(@$post['user_id']!=''){ $user_id = $post['user_id'];}
		if(@$post['blog_title']!=''){ $blog_title = $post['blog_title'];}	
		if(@$post['blog_description']!=''){ $blog_description = $post['blog_description'];}	
		if($blog_title == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => "Blog Title Should Not be Blank!");	
		}elseif($user_id == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => "User Id Should Not be Blank!");	
		}elseif($blog_description == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => "Blog Description Should Not be Blank!");	
		}else{
			$blog_photo = '';
			if($_FILES['blog_photo']){
			move_uploaded_file($_FILES["blog_photo"]["tmp_name"],
			"blog_images/" . $_FILES["blog_photo"]["name"]);
			$blog_photo = $_FILES["blog_photo"]["name"];
			}else{
			$blog_photo = '';
			}
			$sql = mysql_query("INSERT INTO `tbl_blog_records`(`blog_title`, `blog_photo`, `blog_description`, `user_id`, `added_date`) VALUES ('".$blog_title."','".$blog_photo."','".$blog_description."','".$user_id."','".date("Y-m-d H:i:s")."')");
			if($sql){
				$json = array("status"=>1, "statusCode"=>1, "msg" => "Your blog successfully posted, we will back to you in 24 hours!");
			}else{
				$json = array("status"=>1, "statusCode"=>0, "msg" => "Blog Not Added!");
			}
		}	
	}else{
		$json = array("status"=>0, "statusCode"=>0, "msg" => INVALID_TOKEN );
	}	
	return $json;
}
function updateBlog($post){
$checkToken = checkTokenKey();
	if($checkToken){
		$blog_id = $user_id = '';
		if(@$post['user_id']!=''){ $user_id = $post['user_id'];}
		if(@$post['blog_id']!=''){ $blog_id = $post['blog_id'];}
		if(@$post['blog_title']!=''){ $blog_title = $post['blog_title'];}	
		if(@$post['blog_description']!=''){ $blog_description = $post['blog_description'];}				
		if($blog_id == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => "Blog Id Should Not be Blank!");	
		}elseif($blog_title == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => "Blog Title Should Not be Blank!");	
		}elseif($user_id == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => "User Id Should Not be Blank!");	
		}elseif($blog_description == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => "Blog Description Should Not be Blank!");	
		}else{
			$sql = mysql_query("SELECT * FROM `tbl_blog_records` WHERE `blog_id` = '".$blog_id."' ORDER BY `added_date` DESC");
			$json = array();
			if(mysql_num_rows($sql) > 0){	
				$data = mysql_fetch_assoc($sql);
				$str = '';
				if($_FILES['blog_photo']){
				move_uploaded_file($_FILES["blog_photo"]["tmp_name"],
				"blog_images/" . $_FILES["blog_photo"]["name"]);
				$blog_photo = $_FILES["blog_photo"]["name"];
				$str = "`blog_photo`= '".$blog_photo."',";
				}	
				
				$sql = mysql_query("UPDATE `tbl_blog_records` SET `blog_title`= '".$blog_title."',`blog_description`='".$blog_description."', ".$str." `updated_date`= '".date("Y-m-d")."' WHERE `blog_id` = '".$blog_id."'");
				if($sql){
					$json = array("status"=>1, "statusCode"=>1, "msg" => "Blog Successfully Updated!");
				}else{
					$json = array("status"=>1, "statusCode"=>0, "msg" => "Blog Not Updated!");
				}
			}else{
				$json = array("status"=>1, "statusCode"=>0, "msg" => "No Blog Updated!!");
			}
		}	
	}else{
		$json = array("status"=>0, "statusCode"=>0, "msg" => INVALID_TOKEN );
	}	
	return $json;
}
function deleteBlog($post){
$checkToken = checkTokenKey();
	if($checkToken){
		$blog_id = $user_id = '';
		if(@$post['user_id']!=''){ $user_id = $post['user_id'];}
		if(@$post['blog_id']!=''){ $blog_id = $post['blog_id'];}	
		if($blog_id == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => "Blog Id Should Not be Blank!");	
		}elseif($user_id == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => "User Id Should Not be Blank!");	
		}else{
			$sql = mysql_query("SELECT * FROM `tbl_blog_records` WHERE `blog_id` = '".$blog_id."' AND `user_id` = '".$user_id."' ORDER BY `added_date` DESC");
			$json = array();
			if(mysql_num_rows($sql) > 0){	
				$data = mysql_fetch_assoc($sql);	
				$sql = mysql_query("DELETE FROM `tbl_blog_records` WHERE `blog_id` = '".$blog_id."'");
				if($sql){
					$json = array("status"=>1, "statusCode"=>1, "msg" => "Blog Successfully deleted!");
				}else{
					$json = array("status"=>1, "statusCode"=>0, "msg" => "Blog Not Delete!");
				}
			}else{
				$json = array("status"=>1, "statusCode"=>0, "msg" => "You are Not authorize Person!");
			}
		}	
	}else{
		$json = array("status"=>0, "statusCode"=>0, "msg" => INVALID_TOKEN );
	}	
	return $json;
}
function listBlogs($post){
	$blog_id = $str = '';
	if(@$post['blog_id']!=''){ $blog_id = $post['blog_id']; $str = " AND `blog_id` = '".$blog_id."'";}
	$sql = mysql_query("SELECT * FROM `tbl_blog_records` WHERE `status` = '1' $str ORDER BY `blog_id` DESC");
	$json['speaker_list'] = array();
	if(mysql_num_rows($sql) > 0){
		$json = array("status"=>1, "statusCode"=>1, "msg" => mysql_num_rows($sql).' '.RECORD_FOUND);	
		while($data = mysql_fetch_assoc($sql)){	
		$json['blog_list'][] = array_merge($data,array("added_date" => date("d M Y", strtotime($data['added_date'])).' at '.date("H:i A", strtotime($data['added_date'])), "user_name" => getUserName($data['user_id']), "blog_photo" => BASE_URLD.'blog_images/'.$data['blog_photo']));
		}
	}else{
		$json = array("status"=>1, "statusCode"=>0, "msg" => NO_RECORD_FOUND);
	}
	return $json;
}
function myListBlogs($post){
	$checkToken = checkTokenKey();
	if($checkToken){
		$user_id = '';
			$blog_id = $str = '';
		if(@$post['blog_id']!=''){ $blog_id = $post['blog_id']; $str = " AND `blog_id` = '".$blog_id."'";}
		if(@$post['user_id']!=''){ $user_id = $post['user_id'];}	
		if($user_id == ''){
			$json = array("status"=>0, "statusCode"=>0, "msg" => "User Id Should Not be Blank!");	
		}else{
			$sql = mysql_query("SELECT * FROM `tbl_blog_records` WHERE `user_id` = '".$user_id."' $str ORDER BY `blog_id` DESC");
			$json['speaker_list'] = array();
			if(mysql_num_rows($sql) > 0){
				$json = array("status"=>1, "statusCode"=>1, "msg" => mysql_num_rows($sql).' '.RECORD_FOUND);	
				while($data = mysql_fetch_assoc($sql)){	
				$json['blog_list'][] = array_merge($data,array("blog_photo" => BASE_URLD.'blog_images/'.$data['blog_photo']));
				}
			}else{
				$json = array("status"=>1, "statusCode"=>0, "msg" => NO_RECORD_FOUND);
			}
		}	
	}else{
		$json = array("status"=>0, "statusCode"=>0, "msg" => INVALID_TOKEN );
	}	
	return $json;
}
function addNotificationData($sender_id,$receiver_id,$type,$title,$media_id){

//$addSql = mysql_query("INSERT INTO `tbl_notification_records`(`title`, `type`, `sender_id`, `receiver_id`,`media_id`, `added_date`) VALUES ('".$title."','".$type."','".$sender_id."','".$receiver_id."','".$media_id."','".date("Y-m-d H:i:s")."')");
if($type == 'friend_request'){
	$message = getUserName($sender_id).' Sent you Friend Request.';
}elseif($type == 'response_request'){
	$message = getUserName($sender_id).' Confirm your Friend Request.';
}elseif($type == 'like'){
	$message = getUserName($sender_id).' Like your Media.';
}elseif($type == 'comment'){
	$message = getUserName($sender_id).' Comments on your Media.';
}
$msg = array("sender_id" => $sender_id, "receiver_id" => $receiver_id,"sender_image" => getUserImage($sender_id),"title" => $title, "type" => $type, "message" => $message);
$registrationIds[] = getDeviceToken($receiver_id);
//$url = 'http://saxenasiddharth.com/api/fcm2.php?id='.$registrationIds.'&msg='.json_encode($msg);
  sendPushFCM($registrationIds,$msg);
//return file_get_contents($url);
 $registrationIds;

}
function getDeviceToken($user_id){
		$sql = mysql_query("SELECT * FROM `tbl_users_records` WHERE `user_id`='".$user_id."'");
		$num = mysql_num_rows($sql);
			if($num > 0){
				$data = mysql_fetch_object($sql);
				$device_token = $data->device_token;
			}
return $device_token;
}
function sendPushFCM($registrationIds,$msg){
define( 'API_ACCESS_KEY', 'AAAAS8fV5LY:APA91bEnipTn9gVDdFx3BT3ZXxypI0onLsW-2AwuQWTCFzyN4OeKlsZlNTqO5bsEVSOkwFV2MKzdgDWwNq4HJIEqwJxqbwdrj8w9NvuMwabRwonsLYBhDrBDBgXF5ES_J92aQA-pciQI' );

/*$registrationIds = array('fearkVLNzNY:APA91bGnZMuXsNTivKfpXV9gZ8gNXhRHS0Ow7_l23RVN2OlZlqxb-KKnWhiqxVf0EGe_J-bckqRfI0TcsboOG7mON4lI28k_CFk1XwkQ-KFruCr0dtbq8N8Y6k-p-OrE3UERV4f637zV');
$msg = array
(
	'message' 	=> 'helllo',
	'who'		=> 'lelo',

);*/
$fields = array('registration_ids' 	=> $registrationIds,'data' => $msg);
$headers = array('Authorization: key=' . API_ACCESS_KEY,'Content-Type: application/json');
 
$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );	
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
$result = curl_exec($ch );
curl_close( $ch );

return $result;
}

?>
