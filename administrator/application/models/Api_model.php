<?php
 
date_default_timezone_set("Asia/Kolkata");

class Api_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function userLogin($post) { 

        if ($post['user_name'] != '') {
            $user_name = $post['user_name'];
        } else {
            $user_name = '';
        }

        if ($post['password'] != '') {
            $password = $post['password'];
        } else {
            $password = '';
        }

        if ($post['device_token'] != '') {
            $device_token = $post['device_token'];
        } else {
            $device_token = '';
        }

        if ($post['device_type'] != '') {
            $device_type = $post['device_type'];
        } else {
            $device_type = '';
        }

        if ($user_name == '') { 

            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_USER_REQ);
        } else if ($password == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_PASS_REQ);
        } else {

            $json = array();

            $sql = $this->db->query("SELECT * FROM `tbl_user_records` WHERE `mobile` = '" . $user_name . "' AND `password` ='" . $password . "' AND `status` = '1'");

            if ($sql->num_rows() > 0) {

                $json = array("status" => 1, "statusCode" => 1, "msg" => LOGIN_SUCC_MSG);

                $data = $sql->result();

                $pi = '';

                if ($data[0]->Image != '') {

                    $pi = BASE_URLD . 'uploads/' . $data[0]->image;
                }

                $token_id = md5($data[0]->id);

                $json['user_details'] = array("user_id" => $data[0]->id, "name" => $data[0]->first_name, "emailId" => $data[0]->email_id, "mobileNumber" => $data[0]->mobile, "token_id" => $token_id);

                $upArr = array("device_token" => $device_token, "device_type" => $device_type, "token_id" => $token_id);

                $update = $this->db->update("tbl_user_records", $upArr, array("id" => $data[0]->id));
            } else {

                $json = array("status" => 1, "statusCode" => 0, "msg" => ERR_LOGIN);
            }
        }

        return $json;
    }
	public function sendMessageOnMobile($phone, $message) {

       // $message = OTP_MSG . " " . $otp . "";

        $sendsms = ""; //initialise the sendsms variable 

        $param['mobile'] = '+91'.$phone;

        $param['message'] = $message;

        $param['user'] = 'panshuld';

        $param['Password'] = OTP_PASSWORD;

        $param['key'] = "94edff096aXX";

        $param['senderid'] = "INFOSM"; //optional 

        $param['accusage'] = "1"; //Can be "Bulk/Group� //We need to URL encode the values 

        foreach ($param as $key => $val) {

            $sendsms.= $key . "=" . urlencode($val);
            $sendsms.= "&"; //append the ampersand (&) sign after each parameter/value
        }


        $sendsms = substr($sendsms, 0, strlen($sendsms) - 1); //remove last ampersand (&) sign from the sendsms 

        $url = "http://trans.acefinity.com/submitsms.jsp?" . $sendsms;

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $curl_scraped_page = curl_exec($ch);

        curl_close($ch);

        return $curl_scraped_page;

    }
    public function sendOtp($phone, $otp) {

        $message = OTP_MSG . " " . $otp . "";

        $sendsms = ""; //initialise the sendsms variable 

        $param['mobile'] = '+91'.$phone;

        $param['message'] = $message;

        $param['user'] = 'panshuld';

        $param['key'] = "94edff096aXX";

        $param['senderid'] = "INFOSM"; //optional 

        $param['accusage'] = "1"; //Can be "Bulk/Group� //We need to URL encode the values 

        foreach ($param as $key => $val) {

            $sendsms.= $key . "=" . urlencode($val);
            $sendsms.= "&"; //append the ampersand (&) sign after each parameter/value
        }


        $sendsms = substr($sendsms, 0, strlen($sendsms) - 1); //remove last ampersand (&) sign from the sendsms 

        $url = "http://trans.acefinity.com/submitsms.jsp?" . $sendsms;

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $curl_scraped_page = curl_exec($ch);

        curl_close($ch);

        return $curl_scraped_page;

    }
	 public function sendPassword($phone, $password) {

        $message = "Your Password is: " . $password;

        //$message = OTP_MSG . " " . $otp . "";

        $sendsms = ""; //initialise the sendsms variable 

        $param['mobile'] = '+91'.$phone;

        $param['message'] = $message;

        $param['user'] = 'panshuld';

        $param['key'] = "94edff096aXX";

        $param['senderid'] = "INFOSM"; //optional 

        $param['accusage'] = "1"; //Can be "Bulk/Group� //We need to URL encode the values 

        foreach ($param as $key => $val) {

            $sendsms.= $key . "=" . urlencode($val);
            $sendsms.= "&"; //append the ampersand (&) sign after each parameter/value
        }


        $sendsms = substr($sendsms, 0, strlen($sendsms) - 1); //remove last ampersand (&) sign from the sendsms 

        $url = "http://trans.acefinity.com/submitsms.jsp?" . $sendsms;

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $curl_scraped_page = curl_exec($ch);

        curl_close($ch);

        return $curl_scraped_page;

    }

    public function sendOtpByMobile($post) {

        if (@$post['mobile'] != '') {
            $mobile = $post['mobile'];
        } else {
            $mobile = '';
        }

        if ($mobile == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => "Mobile should not be Blank");
        } else {

            

            $catStr = "`mobile` = '" . $mobile . "'";
            $user_status = $this->totalCount('tbl_user_records', $catStr);
			if($user_status < 1){
				$otp_no = mt_rand(1000, 9999);
            	$res = $this->sendOtp($mobile,$otp_no);
            	$json = array("status" => 1, "statusCode" => 1, "otp_no" => $otp_no, "user_status" => $user_status, "res" => $res, "msg" => "OTP send Succesfully");
			}else{
				$json = array("status" => 1, "statusCode" => 1, "otp_no" => "", "user_status" => 1, "msg" => "OTP send Succesfully");
			}
        }

        return $json;
    }

    public function userRegister($post) {

        $first_name = $last_name = $email = $password = $gender = $registeredVia = $dateofbirth = $image = '';

        $device_type = '';

        $device_token = '';

        if (@$post['first_name'] != '') {
            $first_name = $post['first_name'];
        }

        if (@$post['last_name'] != '') {
            $last_name = $post['last_name'];
        }

        if (@$post['email'] != '') {
            $email = $post['email'];
        }

        if (@$post['mobile'] != '') {
            $mobile = $post['mobile'];
        }

        if (@$post['registeredVia'] != '') {
            $registeredVia = $post['registeredVia'];
        }

        if (@$post['dateofbirth'] != '') {
            $dateofbirth = $post['dateofbirth'];
        }

        if (@$post['password'] != '') {
            $password = $post['password'];
        }

        if (@$post['device_type'] != '') {
            $device_type = $post['device_type'];
        }

        if (@$post['device_token'] != '') {
            $device_token = $post['device_token'];
        }



        if ($first_name == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => "First " . ERROR_NAME_REQ);
        } else if ($email == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_EMAIL_REQ);
        } else if ($mobile == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_MOBILE_REQ);
        } else if ($registeredVia == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => "Registration Via is Required!!");
        } else if ($dateofbirth == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_DOB_REQ);
        } else if ($password == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_PASS_REQ);
        } else {

            $json = array();

            $sql = $this->db->query("SELECT * FROM `tbl_user_records` WHERE `mobile` = '" . $mobile . "'");

            if ($sql->num_rows() > 0) {

                $json = array("status" => 1, "statusCode" => 0, "msg" => ERROR_EMAIL_ALREADY_EXISTS);
            } else {

                //$image = '';

                if ($_FILES['profile_pic']) {

                    move_uploaded_file($_FILES["profile_pic"]["tmp_name"], "uploads/" . $_FILES["profile_pic"]["name"]);

                    $image = $_FILES["profile_pic"]["name"];
                } else {

                    $image = '';
                }



                $array = array(
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'email_id' => $email,
                    'password' => $password,
                    'date_of_birth' => $dateofbirth,
                    'mobile' => $mobile,
                    'profile_pic' => $image,
                    'device_token' => $device_token,
                    'device_type' => $device_type,
                );

                $sqlIns = $this->db->insert('tbl_user_records', $array);

                $lastId = $this->db->insert_id();

                $sqlDa = $this->db->query("SELECT * FROM `tbl_user_records` WHERE `id` = '" . $lastId . "'");

                $data = $sqlDa->result();

                if ($sqlIns) {

                    //$this->send_mail($email,$name,'user',$password);
                    userSignUpMail($name, $email, $password);
                    $json = array("status" => 1, "statusCode" => 1, "msg" => REGISTER_SUCCESS);

                    $pi = '';

                    if ($data[0]->image != '') {

                        $pi = BASE_URLD . 'uploads/' . $data[0]->pic;
                    }

                    $otp_no = mt_rand(10000, 999999);

                    //$res = $this->sendOtp($mobile,$otp_no);

                    $json['user_deatils'] = array("user_id" => $data[0]->id, "first_name" => $data[0]->first_name, "last_name" => $data[0]->last_name, "email" => $data[0]->email_id, "otp_no" => $otp_no, "profile_pic" => $data[0]->profile_pic, "image_url" => $pi, "dateofbirth" => $data[0]->date_of_birth);
                } else {

                    $json = array("status" => 1, "statusCode" => 0, "msg" => REGISTER_ERROR);
                }
            }
        }

        return $json;
    }

    public function userName($userId) {

        $sqlDa = $this->db->query("SELECT * FROM `wn_users` WHERE `user_id` = '" . $userId . "'");

        $num = $sqlDa->num_rows();

        if ($num > 0) {

            $row = $sqlDa->result();

            return $row[0]->Name;
        } else {

            return false;
        }
    }

    public function allCategoriesList($post) {
        $category_list = array();
        if (@$post['category_id'] != '') {
            $category_id = $post['category_id'];
        } else {
            $category_id = 0;
        }
        if (@$post['filter_id'] != '') {
            $filter_id = $post['filter_id'];
        } else {
            $filter_id = 0;
        }
        $sqlDa = $this->db->query("SELECT `category_id`, `category_name`, `parent_id`, `category_image`, `category_description`, `status`,`sort_by` FROM tbl_category_records WHERE `parent_id` = '" . $category_id . "' AND `status` = '1' ORDER BY `sort_by` DESC");
        if ($sqlDa->num_rows() > 0) {


            $json['category_list'] = array();

            $data = $sqlDa->result_array();

            $json = array("status" => 1, "statusCode" => 1, "msg" => $sqlDa->num_rows() . ' ' . RECORD_FOUND);

            foreach ($data as $dt1) {

                $sqlDa = $this->db->query("SELECT `category_id`, `category_name`, `parent_id`, `category_image`, `category_description`, `status` FROM tbl_category_records WHERE `parent_id` = '" . $dt1['category_id'] . "' AND `status` = '1'");

                $sub_category_list = array();

               if ($sqlDa->num_rows() > 0) {

                    $data = $sqlDa->result_array();


                    foreach ($data as $dt) {
                         $sqlDa3 = $this->db->query("SELECT `category_id`, `category_name`, `parent_id`, `category_image`, `category_description`, `status` FROM tbl_category_records WHERE `parent_id` = '" . $dt['category_id'] . "' AND `status` = '1'");

                                $child_category_list = array();

                               if ($sqlDa3->num_rows() > 0) {

                                    $data3 = $sqlDa3->result_array();


                                    foreach ($data3 as $dt3) {

                                        $child_category_list[] = array_merge($dt3, array("category_image" => BASE_URLD . 'uploads/category_images/' . $dt3['category_image']));
                                    }
                                }
                                $sub_category_list[] = array_merge($dt, array("category_image" => BASE_URLD . 'uploads/category_images/' . $dt['category_image'], "child_cat_list" => $child_category_list));

                    }
                }
                $json['category_list'][] = array_merge($dt1, array("category_image" => BASE_URLD . 'uploads/category_images/' . $dt1['category_image'], "sub_category_list" => $sub_category_list));
            }


            //rt //26/5/17
            //echo "SELECT `id`, `Name` FROM tbl_Filters WHERE `id` = '".$dt1['filter_id']."'"; exit;
            $sqlFilter = $this->db->query("SELECT `id`, `Name` FROM tbl_Filters");
            $filter_list = array();
            if ($sqlFilter->num_rows() > 0) {
                $filter_list = $sqlFilter->result_array();
            }
            //end
            //rt //26/5/17
            //SELECT `id`, `city_id`, `name`, `latitude`, `longitude` FROM `tbl_locality` WHERE 1
            $sqlLocality = $this->db->query("SELECT `city_id`, `latitude`, `longitude` , `name` FROM tbl_locality");
            $locality_list = array();
            if ($sqlLocality->num_rows() > 0) {
                $locality_list = $sqlLocality->result_array();
            }
            //end
            $json['filter_list'] = $filter_list;
            //$json['category_list']['locality_list'] = $locality_list;
        } else {
            $json = array("status" => 1, "statusCode" => 0, "msg" => NO_RECORD_FOUND);
        }
        return $json;
    }

    public function getUserInfo($post) {

        $password = $user_id = $email = '';

        if ($post['user_id'] != '') {
            $user_id = $post['user_id'];
        }

        if ($user_id == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_UID_REQ);
        } else {

            $json = array();

            $sql = $this->db->query("SELECT * FROM `tbl_user_records` WHERE `id` = '" . $user_id . "'");

            if ($sql->num_rows() > 0) {

                $data = $sql->result();

                $json = array("status" => 1, "statusCode" => 1, "msg" => "User are available!!");

                $data[0]->profile_pic = BASE_URLD . 'uploads/profile_pic/' . $data[0]->profile_pic;

                $data[0]->cover_pic = BASE_URLD . 'uploads/cover_pic/' .$data[0]->cover_pic ;
				if($data[0]->is_merchant == 1){
					$data[0]->followers_count = $this->totalCount('tbl_subscribe_list','merchant_id='.$data[0]->id);
				}
                $json['user_info'] = $data;
            } else {

                $json = array("status" => 1, "statusCode" => 0, "msg" => ERROR_UID_REQ);
            }

            /*rt count*/
           // $json['enquiry_count'] = array();
             //$json = array();
            //echo "SELECT count(*) as total from tbl_enquiry_records WHERE `user_id` = '".$user_id."' AND `is_closed` = '0'";
                 $sql = $this->db->query("SELECT count(*) as total from tbl_enquiry_records WHERE `user_id` = '".$user_id."' AND `is_closed` = '0' ");
                 /*$jnm = mysql_num_rows($sqlList);*/
                 if ($sql->num_rows() > 0) {
                $count = $sql->result();
                //echo $count;
                /*if($jnm > 0) {
                    $rows = array();*/
                    /*while($data = mysql_fetch_assoc($sqlList)){                        
                        $count = mysql_result($sqlList, 0);
                    } */ 
                }

            $json['enquiry_count'] = $count;
            /*end count*/

        }

        return $json;
    }
	
	public function getMerchantInfo($post) {
		
        $merchant_id = $user_id = $email = '';

        if ($post['user_id'] != '') {
            $user_id = $post['user_id'];
        }
		if ($post['merchant_id'] != '') {
            $merchant_id = $post['merchant_id'];
        }
        if ($user_id == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_UID_REQ);
        } else if ($merchant_id == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => "Merchant ".ERROR_UID_REQ);
        } else {

            $json = array();

            $sql = $this->db->query("SELECT `tur`.*,`tsl`.`category_ids` AS `subscribe_category` FROM `tbl_user_records` AS `tur` LEFT JOIN `tbl_subscribe_list` AS `tsl` ON `tsl`.`merchant_id` = `tur`.`id`  AND `tsl`.`user_id` = '".$user_id."'  WHERE `tur`.`id` = '" . $merchant_id . "'");

            if ($sql->num_rows() > 0) {

                $data = $sql->result();

                $json = array("status" => 1, "statusCode" => 1, "msg" => "User are available!!");

                $data[0]->profile_pic = BASE_URLD . 'uploads/profile_pic/' . $data[0]->profile_pic;

                $data[0]->cover_pic = BASE_URLD . 'uploads/cover_pic/' .$data[0]->cover_pic ;
				if($data[0]->is_merchant == 1){
					$data[0]->followers_count = $this->totalCount('tbl_subscribe_list','merchant_id='.$data[0]->id);
				}
                $json['user_info'] = $data;
            } else {

                $json = array("status" => 1, "statusCode" => 0, "msg" => NO_RECORD_FOUND);
            }
        }

        return $json;
    }

    public function getUserInfoData($user_id) {

        $sql = $this->db->query("SELECT * FROM `tbl_user_records` WHERE `id` = '" . $user_id . "'");

        if ($sql->num_rows() > 0) {

            $data = $sql->result();

            $json = array("status" => 1, "statusCode" => 1, "msg" => "User are available!!");

            $data[0]->profile_pic = BASE_URLD . 'uploads/profile_pic/' . $data[0]->profile_pic;

            $data[0]->cover_pic = BASE_URLD . 'uploads/cover_pic/' . $data[0]->cover_pic;

            $user_info = $data[0];
        } else {

            $user_info = array("status" => 1, "statusCode" => 0, "msg" => ERROR_UID_REQ);
        }

        return $user_info;
    }

    public function getContentData($post) {

        $content_value = '';

        if ($post['content_value'] != '') {
            $content_value = $post['content_value'];
        }

        if ($content_value == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => "Content Value Should not be Blank!!");
        } else {

            $json = array();

            $sql = $this->db->query("SELECT * FROM `tbl_content_records` WHERE `action` = '" . $content_value . "'");

            if ($sql->num_rows() > 0) {

                $data = $sql->result();

                $json = array("status" => 1, "statusCode" => 1, "msg" => "Content Value are available!!");

                $json['content_data'] = $data;
            } else {

                $json = array("status" => 1, "statusCode" => 0, "msg" => "Content Value Does not Exists!!");
            }
        }

        return $json;
    }

    public function allPlacesList($post) {

        $sqlDa = $this->db->query("SELECT * FROM `tbl_places_records` WHERE `status` = '1'");

        if ($sqlDa->num_rows() > 0) {

            $json['place_list'] = array();

            $json = array("status" => 1, "statusCode" => 1, "msg" => $sqlDa->num_rows() . ' ' . RECORD_FOUND);

            foreach ($sqlDa->result_array() as $data) {
                $sqlLocality = $this->db->query("SELECT id as locality_id, `city_id`, `latitude`, `longitude` , `name` FROM tbl_locality WHERE `city_id` = '" . $data['id'] . "'");
                $locality_list = array();
                if ($sqlLocality->num_rows() > 0) {
                    $locality_list = $sqlLocality->result_array();
                }

                $json['place_list'][] = array_merge($data, array("place_image" => BASE_URLD . 'uploads/place_images/' . $data['place_image'], "locality_list" => $locality_list));
            }
        } else {

            $json = array("status" => 1, "statusCode" => 0, "msg" => NO_RECORD_FOUND);
        }

        return $json;
    }

    public function upgradeAccountToMerchant($post) {

        $business_name = $user_id = $office_address = $peryear_sale = $office_email = $office_phone = '';

        if ($post['user_id'] != '') {
            $user_id = $post['user_id'];
        }

        if ($post['office_address'] != '') {
            $office_address = $post['office_address'];
        }

        if ($post['peryear_sale'] != '') {
            $peryear_sale = $post['peryear_sale'];
        }

        if ($post['office_email'] != '') {
            $office_email = $post['office_email'];
        }

        if ($post['office_phone'] != '') {
            $office_phone = $post['office_phone'];
        }
		if ($post['business_name'] != '') {
            $business_name = $post['business_name'];
        }

        if ($user_id == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => "User Id Should not be Blank!!");
        } else {

            $json = array();

            $sql = $this->db->query("SELECT * FROM `tbl_user_records` WHERE `id` = '" . $user_id . "'");

            if ($sql->num_rows() > 0) {

                $data = $sql->result();

                //$cover_pic = '';

                if ($_FILES['cover_pic']) {

                    $cover_pic = $this->makeFileRename($_FILES["cover_pic"]["name"]);

                    move_uploaded_file($_FILES["cover_pic"]["tmp_name"], "uploads/cover_pic/" . $cover_pic);
                } else {

                    $cover_pic = '';
                }

                //$image = '';

                if ($_FILES['profile_pic']) {

                    $profile_pic = $this->makeFileRename($_FILES["profile_pic"]["name"]);

                    move_uploaded_file($_FILES["profile_pic"]["tmp_name"], "uploads/profile_pic/" . $profile_pic);
                } else {

                    $profile_pic = '';
                }

                $array = array("is_merchant" => '2');

                if ($profile_pic != '') {
                    $array['profile_pic'] = $profile_pic;
                }

                if ($cover_pic != '') {
                    $array['cover_pic'] = $cover_pic;
                }

                if ($office_address != '') {
                    $array['office_address'] = $office_address;
                }

                if ($peryear_sale != '') {
                    $array['peryear_sale'] = $peryear_sale;
                }

                if ($office_email != '') {
                    $array['office_email'] = $office_email;
                }

                if ($office_phone != '') {
                    $array['office_phone'] = $office_phone;
                }
				if ($business_name != '') {
				$array['business_name'] = $business_name;
       			 }
                $update = $this->db->update('tbl_user_records', $array, array("id" => $user_id));

                if ($update) {

                    $json = array("status" => 1, "statusCode" => 1, "msg" => UPDATED_SUCCESS);
                }
            } else {

                $json = array("status" => 1, "statusCode" => 0, "msg" => "User id Does not Exists!!");
            }
        }

        return $json;
    }

    public function userLogout($post) {

        $user_id = $email = '';

        if ($post['user_id'] != '') {
            $user_id = $post['user_id'];
        }

        if ($user_id == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => "User Id Should not be Blank!!");
        } else {

            $json = array();

            $sql = $this->db->query("SELECT * FROM `tbl_user_records` WHERE `id` = '" . $user_id . "'");

            if ($sql->num_rows() > 0) {

                $data = $sql->result();

                $array = array("token_id" => '', 'device_token' => '', 'device_type' => "");

                $update = $this->db->update('tbl_user_records', $array, array("id" => $user_id));

                if ($update) {

                    $json = array("status" => 1, "statusCode" => 1, "msg" => "Successfully Logout!");
                } else {

                    $json = array("status" => 1, "statusCode" => 0, "msg" => "Error in Logout!");
                }
            } else {

                $json = array("status" => 1, "statusCode" => 0, "msg" => "User id Does not Exists!!");
            }
        }

        return $json;
    }

    public function verifyTokenId($token_id, $user_id) {

        $sql = $this->db->query("SELECT * FROM `tbl_user_records` WHERE `token_id` = '" . $token_id . "' AND `id` ='" . $user_id . "'");

        $result = 0;

        if ($sql->num_rows() > 0) {

            $result = 1;
        }

        return $result;
    }

    public function changePasword($post) {

        $old_password = $user_id = $password = '';

        if ($post['user_id'] != '') {
            $user_id = $post['user_id'];
        }

        if ($post['password'] != '') {
            $password = $post['password'];
        }

        if ($post['old_password'] != '') {
            $old_password = $post['old_password'];
        }

        if ($user_id == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_UID_REQ);
        } else if ($password == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_PASS_REQ);
        } else if ($old_password == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => "Old " . ERROR_PASS_REQ);
        } else {

            $json = array();

            $sql = $this->db->query("SELECT * FROM `tbl_user_records` WHERE `id` = '" . $user_id . "' AND `password` = '" . $old_password . "'");

            if ($sql->num_rows() > 0) {

                $data = $sql->result();

                $sqlUp = $this->db->query("UPDATE `tbl_user_records` SET `password` = '" . $password . "' WHERE `id` = '" . $user_id . "'");

                if ($sqlUp) {
					$data = $this->sendMessageOnMobile($data[0]->mobile, "Your Property App Password is: ".$password);
                    $json = array("status" => 1, "statusCode" => 1, "msg" => "Your password has been changed successfully!","res" => $data);
                } else {

                    $json = array("status" => 1, "statusCode" => 0, "msg" => ERROR_USER_UPDATE);
                }
            } else {

                $json = array("status" => 1, "statusCode" => 0, "msg" => "Old Password is Not Correct!!");
            }
        }

        return $json;
    }

    public function updateTokenId($post) {

        $user_id = $device_token = $device_key = '';

        if (@$post['user_id'] != '') {
            $user_id = $post['user_id'];
        }

        if (@$post['device_token'] != '') {
            $device_token = $post['device_token'];
        }

        if (@$post['device_type'] != '') {
            $device_type = $post['device_type'];
        }

        if ($user_id == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_UID_REQ);
        } elseif ($device_token == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => "Device Token should Not be Blank");
        } elseif ($device_type == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => "Device Type should Not be Blank");
        } else {

            $sql = $this->db->query("SELECT * FROM `tbl_users_records` WHERE `user_id` = '" . $user_id . "'");

            $num = $sql->num_rows();

            if ($num > 0) {

                $sqlIns = $this->db->query("UPDATE `tbl_users_records` SET `device_token` = '" . $device_token . "', `device_type` = '" . $device_type . "' WHERE `user_id`='" . $user_id . "'");

                if ($sqlIns) {

                    $json = array("status" => 1, "statusCode" => 1, "msg" => "Updated Successfully");
                } else {

                    $json = array("status" => 1, "statusCode" => 0, "msg" => "Not Updated");
                }
            } else {

                $json = array("status" => 1, "statusCode" => 0, "msg" => NO_RECORD_FOUND);
            }
        }

        return $json;
    }

    public function updateProfile($post) {

        $view_phone = $business_name = $last_name = $email = $password = $gender = $registeredVia = $dateofbirth = $image = '';

        $device_type = '';

        $device_token = '';

        if (@$post['user_id'] != '') {
            $user_id = $post['user_id'];
        }

        if (@$post['first_name'] != '') {
            $first_name = $post['first_name'];
        }

        if (@$post['last_name'] != '') {
            $last_name = $post['last_name'];
        }
		 if (@$post['business_name'] != '') {
            $business_name = $post['business_name'];
        }
        if (@$post['email'] != '') {
            $email = $post['email'];
        }

        if (@$post['mobile'] != '') {
            $mobile = $post['mobile'];
        }

        if (@$post['registeredVia'] != '') {
            $registeredVia = $post['registeredVia'];
        }

        if (@$post['dateofbirth'] != '') {
            $dateofbirth = $post['dateofbirth'];
        }

        if (@$post['password'] != '') {
            $password = $post['password'];
        }

        if (@$post['device_type'] != '') {
            $device_type = $post['device_type'];
        }

        if (@$post['device_token'] != '') {
            $device_token = $post['device_token'];
        }

        if ($post['office_address'] != '') {
            $office_address = $post['office_address'];
        }

        if ($post['peryear_sale'] != '') {
            $peryear_sale = $post['peryear_sale'];
        }

        if ($post['office_email'] != '') {
            $office_email = $post['office_email'];
        }

        if ($post['office_phone'] != '') {
            $office_phone = $post['office_phone'];
        }
        if ($post['view_phone'] != '') {
            $view_phone = $post['view_phone'];
        }		

        if ($user_id == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_UID_REQ);
        } else {

            //$cover_pic = '';

            if ($_FILES['cover_pic']) {

                $cover_pic = $this->makeFileRename($_FILES["cover_pic"]["name"]);

                move_uploaded_file($_FILES["cover_pic"]["tmp_name"], "uploads/cover_pic/" . $cover_pic);
            } else {

                $cover_pic = '';
            }

            //$image = '';

            if ($_FILES['profile_pic']) {

                $profile_pic = $this->makeFileRename($_FILES["profile_pic"]["name"]);

                move_uploaded_file($_FILES["profile_pic"]["tmp_name"], "uploads/profile_pic/" . $profile_pic);
            } else {

                $profile_pic = '';
            }

            /* 	$array = array( 'first_name' => $first_name, 'last_name' => $last_name, 'address' => $address, 'latitude' => $latitude, 'longitude' => $longitude,'date_of_birth' => $date_of_birth, 'pic' => $alue, 'cover_pic' => $cover_pic, 'office_address' => $office_address, 'peryear_sale' => $peryear_sale, 'office_email' => $office_email, 'office_phone' => $office_phone, 'device_type' => $device_type, 'device_token' => $device_token);	 */

            $array = array();

            if ($first_name != '') {
                $array['first_name'] = $first_name;
            }

            if ($last_name != '') {
                $array['last_name'] = $last_name;
            }

            if ($address != '') {
                $array['address'] = $address;
            }

            if ($latitude != '') {
                $array['latitude'] = $latitude;
            }

            if ($longitude != '') {
                $array['longitude'] = $longitude;
            }

            if ($date_of_birth != '') {
                $array['date_of_birth'] = $date_of_birth;
            }

            if ($profile_pic != '') {
                $array['profile_pic'] = $profile_pic;
            }

            if ($cover_pic != '') {
                $array['cover_pic'] = $cover_pic;
            }

            if ($office_address != '') {
                $array['office_address'] = $office_address;
            }

            if ($peryear_sale != '') {
                $array['peryear_sale'] = $peryear_sale;
            }

            if ($office_email != '') {
                $array['office_email'] = $office_email;
            }

            if ($office_phone != '') {
                $array['office_phone'] = $office_phone;
            }

            if ($device_token != '') {
                $array['device_token'] = $device_token;
            }

            if ($device_type != '') {
                $array['device_type'] = $device_type;
            }

            //return $array;

            $json = array();

            $sql = $this->db->query("SELECT * FROM `tbl_user_records` WHERE `id` = '" . $user_id . "'");

            if ($sql->num_rows() > 0) {

                $data = $sql->result();

                if ($profile_pic != '') {
                    $array['profile_pic'] = $profile_pic;
                }

                if ($cover_pic != '') {
                    $array['cover_pic'] = $cover_pic;
                }

                $update = $this->db->update('tbl_user_records', $array, array("id" => $user_id));

                //return $this->db->last_query();

                if ($update) {

                    $json = array("status" => 1, "statusCode" => 1, "data" => $array, "msg" => "Successfully Updated!");
                } else {

                    $json = array("status" => 1, "statusCode" => 0, "msg" => "Error in Updated!");
                }
            } else {

                $json = array("status" => 1, "statusCode" => 0, "msg" => "User id Does not Exists!!");
            }
        }

        return $json;
    }

    public function getProductWithOffer($post) {

        $password = $user_id = $email = '';

        if ($post['user_id'] != '') {
            $user_id = $post['user_id'];
        }

        if ($user_id == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_UID_REQ);
        } else {

            $json = array();

            $sql = $this->db->query("SELECT * FROM  `tbl_product_records` WHERE `user_id` = '" . $user_id . "'");

            if ($sql->num_rows() > 0) {

                $data = $sql->result_array();

                $json = array("status" => 1, "statusCode" => 1, "msg" => "User are available!!");

                foreach ($data as $dt) {

                    $product_id = $dt['product_id'];

                    $offer_list = $this->offerList($product_id, $user_id);

                    $product_images = $this->productImageList($product_id);

                    $json['product_list'][] = array_merge($dt, array("offer_list" => $offer_list, "product_images" => $product_images));
                }
            } else {

                $json = array("status" => 1, "statusCode" => 0, "msg" => NO_RECORD_FOUND);
            }
        }

        return $json;
    }

    public function getProductWithOfferDetails($post) {

        $user_id = $product_id = '';

        if ($post['product_id'] != '') {
            $product_id = $post['product_id'];
        }
        if ($post['user_id'] != '') {
            $user_id = $post['user_id'];
        }

        if ($user_id == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_UID_REQ);
        } elseif ($product_id == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_PID_REQ);
        } else {

            $json = array("status" => 1, "statusCode" => 1, "msg" => RECORD_FOUND);

            $sql = $this->db->query("SELECT * FROM `tbl_product_records` WHERE `product_id` = '" . $product_id . "'");

            if ($sql->num_rows() > 0) {

                $data = $sql->result_array();



                $offer_list = $this->offerList($product_id, $user_id);

                $product_images = $this->productImageList($product_id);

                $json['product_details'] = array_merge($data[0], array("offer_list" => $offer_list, "product_images" => $product_images, "category_name" => $this->getCategoryName($data[0]['category_id']), "Sub_cat_name" => $this->getCategoryName($data[0]['sub_category_id']), "place_name" => $this->getPlaceName($data[0]['places_ids'])));
            } else {

                $json = array("status" => 1, "statusCode" => 0, "msg" => NO_RECORD_FOUND);
            }
        }

        return $json;
    }

    public function getCategoryName($category_id) {

        $this->db->select('category_name');

        $this->db->from('tbl_category_records');

        $this->db->where('category_id', $category_id);

        $query = $this->db->get();

        $data = $query->result();

        return $data[0]->category_name;
    }

    public function getPlaceName($city_id) {

        $this->db->select('city_name');

        $this->db->from('places');

        $this->db->where('id', $city_id);

        $query = $this->db->get();

        $data = $query->result();

        return $data[0]->city_name;
    }

    public function offerList($product_id, $user_id) {

        $data = array();

        $sql = $this->db->query("SELECT * FROM `tbl_offers_records` WHERE `product_id` = '" . $product_id . "'");

        if ($sql->num_rows() > 0) {

            $data = array();

            $s = $this->db->query("SELECT * FROM `tbl_product_records` WHERE `product_id` = '" . $product_id . "'");

            $r = $s->result();

            foreach ($sql->result_array() as $val) {

                $offer_images = $this->offerImageList($val['offer_id']);

                $comment_list = $this->getofferCommentList($val['offer_id'], 1, 10);

                $catStr = "`offer_id` = '" . $val['offer_id'] . "'";

                $total_like = $this->totalCount('tbl_offer_likes', $catStr);

                $nbv = $this->getIsOfferLike($val['offer_id'], $user_id);

                //$jsonData[] = array_merge($offdata,array("is_like" => $nbv));
                $data[] = array_merge($val, array("offer_images" => $offer_images, "comment_list" => $comment_list, "total_like" => $total_like, "user_info" => $this->getUserInfoData($r[0]->user_id), "is_like" => $nbv));
            }
        }

        return $data;
    }

    public function offerDetails($post) {

        $json = array();

        $offer_id = isset($post['offer_id']) ? $post['offer_id'] : '';

        if ($offer_id == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_OFFER_ID_REQ);
        } else {

            $sql = $this->db->query("SELECT * FROM `tbl_offers_records` WHERE `offer_id` = '" . $offer_id . "'");

            if ($sql->num_rows() > 0) {

                $json = array("status" => 1, "statusCode" => 1, "msg" => RECORD_FOUND);

                foreach ($sql->result_array() as $val) {

                    $offer_images = $this->offerImageList($val['offer_id']);

                    $comment_list = $this->getofferCommentList($val['offer_id'], 1, 10);

                    $catStr = "`offer_id` = '" . $val['offer_id'] . "'";

                    $total_like = $this->totalCount('tbl_offer_likes', $catStr);

                    //$product_info = array();

                    $sqlPI = $this->db->query("SELECT * FROM `tbl_product_records` WHERE `product_id` = '" . $val['product_id'] . "'");

                    if ($sqlPI->num_rows() > 0) {

                        $product_info = $sqlPI->result();
                    }

                    $owner_details = $this->getUserInfoData($product_info[0]->user_id);

                    $json['offer_details'] = array_merge($val, array("offer_images" => $offer_images, "comment_list" => $comment_list, "total_like" => $total_like, "product_info" => $product_info[0], "owner_details" => $owner_details));
                }
            } else {

                $json = array("status" => 1, "statusCode" => 0, "msg" => NO_RECORD_FOUND);
            }
        }

        return $json;
    }

    public function productImageList($product_id) {

        $data = array();

        $sql = $this->db->query("SELECT `product_image_id`, `image_url` FROM `tbl_product_images` WHERE `product_id` = '" . $product_id . "'");

        if ($sql->num_rows() > 0) {

            $rows = $sql->result_array();

            foreach ($rows as $row) {

                $data[] = array("product_image_id" => $row['product_image_id'], "image_url" => BASE_URLD . 'uploads/product_images/' . $row['image_url']);
            }
        }

        return $data;
    }

    public function offerImageList($offer_id) {

        $data = array();

        $sql = $this->db->query("SELECT `offer_image_id`, `image_url` FROM `tbl_offer_images` WHERE `offer_id` = '" . $offer_id . "'");

        if ($sql->num_rows() > 0) {

            $rows = $sql->result_array();

            foreach ($rows as $row) {

                $data[] = array("offer_image_id" => $row['offer_image_id'], "image_url" => BASE_URLD . 'uploads/offer_images/' . $row['image_url']);
            }
        }

        return $data;
    }

    //delete offers

    public function DeleteOffer($post) {

        $offer_id = '';

        if ($post['offer_id'] != '') {
            $offer_id = $post['offer_id'];
        }

        if ($offer_id == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_PID_REQ);
        } else {

            $json = array();

            $sql = $this->db->query("SELECT * FROM `tbl_offers_records` WHERE `offer_id` = '" . $offer_id . "'");

            if ($sql->num_rows() > 0) {

                $data = array();

                $sql = $this->db->query("DELETE FROM `tbl_offers_records` WHERE `offer_id` ='" . $offer_id . "' ");

                if ($sql) {

                    $json = array("status" => 1, "statusCode" => 1, "msg" => "Successfully Deleted!");
                }
            } else {

                $json = array("status" => 1, "statusCode" => 0, "msg" => "Invalid offer id!");
            }
        }

        return $json;
    }

    public function DeleteProduct($post) {

        $product_id = '';

        if ($post['product_id'] != '') {
            $product_id = $post['product_id'];
        }

        if ($product_id == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_PID_REQ);
        } else {

            $json = array();

            $sql = $this->db->query("SELECT * FROM `tbl_product_records` WHERE `product_id` = '" . $product_id . "'");

            if ($sql->num_rows() > 0) {

                $data = array();

                $sql = $this->db->query("DELETE FROM `tbl_product_records` WHERE `product_id` ='" . $product_id . "' ");

                $sql = $this->db->query("DELETE FROM `tbl_offers_records` WHERE `product_id` ='" . $product_id . "' ");

                if ($sql) {

                    $json = array("status" => 1, "statusCode" => 1, "msg" => "Successfully Deleted!");
                }
            } else {

                $json = array("status" => 1, "statusCode" => 0, "msg" => "Invalid Product Id!");
            }
        }

        return $json;
    }

    //Add offers

    public function addOffer($post) {

        $data = array();

        $product_id = isset($post['product_id']) ? $post['product_id'] : '';

        $offer_title = isset($post['offer_title']) ? $post['offer_title'] : '';

        $start_date = isset($post['start_date']) ? $post['start_date'] : '';

        $end_date = isset($post['end_date']) ? $post['end_date'] : '';

        $location = isset($post['location']) ? $post['location'] : '';

        $sponsered = isset($post['sponsered']) ? $post['sponsered'] : '';

        $description = isset($post['description']) ? $post['description'] : '';



        if ($product_id == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => PRODUCT_ID_REQUIRED);
        } elseif ($offer_title == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => OFFER_TITLE_REQUIRED);
        } elseif ($start_date == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => START_DATE_REQUIRED);
        } elseif ($end_date == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => END_DATE_REQUIRED);
        } else {

            $json = array();

            $sqlIns = $this->db->query("INSERT INTO `tbl_offers_records`(`product_id`, `offer_title`, `offer_desc`, `start_date`, `end_date`, `added_date`, `status`, `sponsered`,`location`) VALUES ('" . $product_id . "', '" . $offer_title . "', '" . $description . "', '" . $start_date . "', '" . $end_date . "','" . $added_date . "','" . $status . "','" . $sponsered . "','" . $location . "')");

            $lastId = $this->db->insert_id();

            if ($sqlIns) {

                $json = array("status" => 1, "statusCode" => 1, "offer_id" => $lastId, "msg" => "Offer " . ADDED_SUCCESS);
            } else {

                $json = array("status" => 1, "statusCode" => 0, "msg" => "Offer " . NOT_ADDED);
            }
        }

        return $json;
    }

    public function addProduct($post) {

        $data = array();

        $user_id = isset($post['user_id']) ? $post['user_id'] : '';

        $product_name = isset($post['product_name']) ? $post['product_name'] : '';

        $description = isset($post['description']) ? $post['description'] : '';
        $discount_price = isset($post['discount_price']) ? $post['discount_price'] : '';
        $price = isset($post['price']) ? $post['price'] : '';        
        $category = isset($post['category']) ? $post['category'] : '';

        $sub_category = isset($post['sub_category']) ? $post['sub_category'] : '';

        $location = isset($post['location']) ? $post['location'] : '';

        $latitude = isset($post['latitude']) ? $post['latitude'] : '';

        $longitude = isset($post['longitude']) ? $post['longitude'] : '';

        $address = isset($post['address']) ? $post['address'] : '';

        $places_ids = isset($post['places_ids']) ? $post['places_ids'] : '';



        if ($product_name == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => PRODUCT_NAME_REQ);
        } elseif ($description == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_DESCRIPTION_REQ);
        } elseif ($category == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_CAT_REQ);
        } elseif ($sub_category == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_SUB_CAT_REQ);
        } else {

            $catStr = "category_id='" . $category . "'";

            $subCatStr = "category_id='" . $sub_category . "'";

            if ($this->totalCount('tbl_category_records', $catStr) > 0) {

                if ($this->totalCount('tbl_category_records', $subCatStr) > 0) {

                    $json = array();

                    $sqlIns = $this->db->query("INSERT INTO `tbl_product_records`(`user_id`, `product_title`,`price`, `discount_price`,  `location`, `latitude`, `longitude`, `product_description`, `category_id`, `sub_category_id`, `places_ids`) VALUES ('" . $user_id . "','" . $product_name . "','" . $price . "','" . $discount_price . "','" . $location . "','" . $latitude . "','" . $longitude . "','" . $description . "','" . $category . "','" . $sub_category . "','" . $places_ids . "')");

                    $lastId = $this->db->insert_id();

                    if ($sqlIns) {

                        $json = array("status" => 1, "statusCode" => 1, "product_id" => $lastId, "msg" => "Product " . ADDED_SUCCESS);
                    } else {

                        $json = array("status" => 1, "statusCode" => 0, "msg" => "Product " . NOT_ADDED);
                    }
                } else {

                    $json = array("status" => 1, "statusCode" => 0, "msg" => "Sub category Not Found!!");
                }
            } else {

                $json = array("status" => 1, "statusCode" => 0, "msg" => "Category  Not Found!!");
            }
        }

        return $json;
    }

    function makeFileRename($file_name) {

        $vl = explode('.', $file_name);

        $ext = end($vl);

        $imgName = str_replace('.' . $ext, '', $file_name);

        $finalImgName = $imgName . "_" . strtotime(date('y-m-d h:i:s')) . "." . $ext;

        $filename = trim(addslashes($finalImgName));

        return $finalImgName = str_replace(' ', '_', $filename);
    }

    public function addProductImages($post) {

        $product_id = isset($post['product_id']) ? $post['product_id'] : '';

        if ($product_id == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_PID_REQ);
        } else {

            if ($_FILES['product_image']) {

                $img_name = $this->makeFileRename($_FILES["product_image"]["name"]);

                move_uploaded_file($_FILES["product_image"]["tmp_name"], "uploads/product_images/" . $img_name);

                $sqlIns = $this->db->query("INSERT INTO `tbl_product_images`(`product_id`, `image_url`, `status`, `added_date`) VALUES ('" . $product_id . "','" . $img_name . "','1','" . date("Y-m-d H:i:s") . "')");

                $lastId = $this->db->insert_id();

                if ($sqlIns) {

                    $json = array("status" => 1, "statusCode" => 1, "product_image_id" => $lastId, "msg" => "Product Image " . ADDED_SUCCESS);
                } else {

                    $json = array("status" => 1, "statusCode" => 0, "msg" => "Product Image " . NOT_ADDED);
                }
            } else {

                $json = array("status" => 1, "statusCode" => 0, "msg" => ERROR_SUB_CAT_REQ);
            }
        }

        return $json;
    }

    function totalCount($tablename, $cond) {

        $sql = $this->db->query("SELECT * FROM `" . $tablename . "` WHERE 1=1 AND $cond");

        $num = $sql->num_rows();

        return $num;
    }

    public function updateProduct($post) {

        $data = array();

        $product_id = isset($post['product_id']) ? $post['product_id'] : '';

        $user_id = isset($post['user_id']) ? $post['user_id'] : '';

        $product_name = isset($post['product_name']) ? $post['product_name'] : '';

        $description = isset($post['description']) ? $post['description'] : '';

        $category = isset($post['category']) ? $post['category'] : '';

        $sub_category = isset($post['sub_category']) ? $post['sub_category'] : '';

        $location = isset($post['location']) ? $post['location'] : '';

        $latitude = isset($post['latitude']) ? $post['latitude'] : '';

        $longitude = isset($post['longitude']) ? $post['longitude'] : '';

        $address = isset($post['address']) ? $post['address'] : '';

        $places_ids = isset($post['places_ids']) ? $post['places_ids'] : '';



        if ($product_id == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_PID_REQ);
        } elseif ($product_name == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => PRODUCT_NAME_REQ);
        } elseif ($description == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_DESCRIPTION_REQ);
        } elseif ($category == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_CAT_REQ);
        } elseif ($sub_category == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_SUB_CAT_REQ);
        } else {

            $json = array();

            $catStr = "category_id='" . $category . "'";

            $subCatStr = "category_id='" . $sub_category . "'";

            if ($this->totalCount('tbl_category_records', $catStr) > 0) {

                if ($this->totalCount('tbl_category_records', $subCatStr) > 0) {

                    $array = array("user_id" => $user_id, "product_title" => $product_name, "location" => $location, "latitude" => $latitude, "longitude" => $longitude, "product_description" => $description, "category_id" => $category, "sub_category_id" => $sub_category, "places_ids" => $places_ids);

                    $sqlIns = $this->db->update("tbl_product_records", $array, array("product_id" => $product_id));

                    if ($sqlIns) {

                        $json = array("status" => 1, "statusCode" => 1, "product_id" => $product_id, "msg" => "Product " . UPDATED_SUCCESS);
                    } else {

                        $json = array("status" => 1, "statusCode" => 0, "msg" => "Product " . NOT_ADDED);
                    }
                } else {

                    $json = array("status" => 1, "statusCode" => 0, "msg" => "Sub category not Found!!");
                }
            } else {

                $json = array("status" => 1, "statusCode" => 0, "msg" => "Category not Found!!");
            }
        }

        return $json;
    }

    public function updateOffer($post) {

        $data = array();

        $product_id = isset($post['product_id']) ? $post['product_id'] : '';

        $offer_id = isset($post['offer_id']) ? $post['offer_id'] : '';

        $offer_title = isset($post['offer_title']) ? $post['offer_title'] : '';

        $start_date = isset($post['start_date']) ? $post['start_date'] : '';

        $end_date = isset($post['end_date']) ? $post['end_date'] : '';

        $location = isset($post['location']) ? $post['location'] : '';

        $sponsered = isset($post['sponsered']) ? $post['sponsered'] : '';

        $description = isset($post['description']) ? $post['description'] : '';



        if ($offer_id == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_OFFER_ID_REQ);
        } elseif ($offer_title == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => OFFER_TITLE_REQUIRED);
        } elseif ($start_date == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => START_DATE_REQUIRED);
        } elseif ($end_date == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => END_DATE_REQUIRED);
        } else {

            $prStr = "product_id='" . $product_id . "'";

            if ($this->totalCount('tbl_product_records', $prStr) > 0) {



                $array = array("product_id" => $product_id, "offer_title" => $offer_title, "offer_desc" => $description, "start_date" => $start_date, "end_date" => $end_date, "sponsered" => $sponsered, "location" => $location);

                //return $array;

                $sqlIns = $this->db->update("tbl_offers_records", $array, array("offer_id" => $offer_id));

                if ($sqlIns) {

                    $json = array("status" => 1, "statusCode" => 1, "offer_id" => $offer_id, "msg" => "Offer " . ADDED_SUCCESS);
                } else {

                    $json = array("status" => 1, "statusCode" => 0, "msg" => "Offer " . NOT_ADDED);
                }
            } else {

                $json = array("status" => 1, "statusCode" => 0, "msg" => "Product not Found!!");
            }
        }

        return $json;
    }

    public function addOfferImages($post) {

        $offer_id = isset($post['offer_id']) ? $post['offer_id'] : '';

        if ($offer_id == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_OFFER_ID_REQ);
        } else {

            if ($_FILES['offer_image']) {

                $img_name = $this->makeFileRename($_FILES["offer_image"]["name"]);

                move_uploaded_file($_FILES["offer_image"]["tmp_name"], "uploads/offer_images/" . $img_name);

                $sqlIns = $this->db->query("INSERT INTO `tbl_offer_images`(`offer_id`, `image_url`, `status`, `added_date`) VALUES ('" . $offer_id . "','" . $img_name . "','1','" . date("Y-m-d H:i:s") . "')");

                $lastId = $this->db->insert_id();

                if ($sqlIns) {

                    $json = array("status" => 1, "statusCode" => 1, "offer_image_id" => $lastId, "msg" => "Offer Image " . ADDED_SUCCESS);
                } else {

                    $json = array("status" => 1, "statusCode" => 0, "msg" => "Offer Image " . NOT_ADDED);
                }
            } else {

                $json = array("status" => 1, "statusCode" => 0, "msg" => ERROR_SUB_CAT_REQ);
            }
        }

        return $json;
    }

    public function deleteProductImages($post) {

        $product_image_id = isset($post['product_image_id']) ? $post['product_image_id'] : '';

        if ($product_image_id == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => "Product_image Id Should Not be Blank!");
        } else {

            $lastId = $this->db->delete('tbl_product_images', array('product_image_id' => $product_image_id));

            if ($lastId) {

                $json = array("status" => 1, "statusCode" => 1, "msg" => "Product Image Deleted");
            } else {

                $json = array("status" => 1, "statusCode" => 0, "msg" => "Product Image " . NOT_ADDED);
            }
        }

        return $json;
    }

    public function deleteOfferImages($post) {

        $offer_image_id = isset($post['offer_image_id']) ? $post['offer_image_id'] : '';

        if ($offer_image_id == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => "Offer Image Id Should Not Be Blank!");
        } else {

            $lastId = $this->db->delete('tbl_offer_images', array('offer_image_id' => $offer_image_id));

            if ($lastId) {

                $json = array("status" => 1, "statusCode" => 1, "msg" => "Offer Image Deleted");
            } else {

                $json = array("status" => 1, "statusCode" => 0, "msg" => "Offer Image " . NOT_ADDED);
            }
        }

        return $json;
    }

    public function addSubscribeList($post) {
        $user_id = isset($post['user_id']) ? $post['user_id'] : '';
        $merchant_id = isset($post['merchant_id']) ? $post['merchant_id'] : '';
		$category_ids = isset($post['category_ids']) ? $post['category_ids'] : '';
        if ($user_id == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_UID_REQ);
        } else if ($merchant_id == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_MERCHENTID_REQ);
        } else if ($category_ids == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => "Category ids Should not be Blank!!");
        } else {
			$sql = $this->db->query("SELECT * FROM `tbl_subscribe_list` WHERE `user_id` = '".$user_id."' AND `merchant_id` = '".$merchant_id."'");
			if($sql->num_rows() > 0){
				$arr = array('category_ids' => $category_ids);
				$lastId = $this->db->update('tbl_subscribe_list', $arr,array('user_id' => $user_id, "merchant_id" => $merchant_id));
			}else{
				$arr = array('user_id' => $user_id, "merchant_id" => $merchant_id, 'category_ids' => $category_ids, "added_date" => date("Y-m-d H:i:s"));
				$lastId = $this->db->insert('tbl_subscribe_list', $arr);
			}
            if ($lastId) {
                $json = array("status" => 1, "statusCode" => 1, "msg" => USER_SUBSCRIBE_SUCC);
            } else {
                $json = array("status" => 1, "statusCode" => 0, "msg" => "User not Subscribed");
            }
        }
        return $json;
    }

    public function getNewsData($post) {

        $user_id = isset($post['user_id']) ? $post['user_id'] : '';

        $merchant_id = isset($post['merchant_id']) ? $post['merchant_id'] : '';

        if ($user_id == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_UID_REQ);
        } else {

            /* $arr = array('user_id' => $user_id, "merchant_id" => $merchant_id, "added_date" => date("Y-m-d H:i:s"));

              $lastId = $this->db->select('tbl_subscribe_list',$arr);

             */

            $this->db->select('tbl_product_records.*, tbl_offers_records.*');

            $this->db->from('tbl_subscribe_list');

            $this->db->join('tbl_product_records', 'tbl_product_records.user_id = tbl_subscribe_list.merchant_id');

            $this->db->join('tbl_offers_records', 'tbl_offers_records.product_id = tbl_product_records.product_id');

            $this->db->where('tbl_subscribe_list.user_id', $user_id);

            $query = $this->db->get();

            //return $this->db->last_query();

            if ($query->num_rows() > 0) {

                $feed_list = array();

                $json = array("status" => 1, "statusCode" => 1, "msg" => $query->num_rows() . ' ' . RECORD_FOUND);



                foreach ($query->result_array() as $row) {

                    $catStr = "`offer_id` = '" . $row['offer_id'] . "'";

                    $total_like = $this->totalCount('tbl_offer_likes', $catStr);

                    $catStr.= " AND `user_id` = '" . $user_id . "'";

                    $is_like = $this->totalCount('tbl_offer_likes', $catStr);

                    $offer_images = $this->offerImageList($row['offer_id']);

                    $json['feed_list'][] = array_merge($row, array("total_like" => $total_like, "is_like" => $is_like, "comment_list" => $this->getofferCommentList($row['offer_id'], 1, 10), "offer_images" => $offer_images));
                }
            } else {

                $json = array("status" => 1, "statusCode" => 0, "msg" => NO_RECORD_FOUND);
            }
        }

        return $json;
    }

    public function getNewsFeedsList($post) {



        $user_id = isset($post['user_id']) ? $post['user_id'] : '';

        $merchant_id = isset($post['merchant_id']) ? $post['merchant_id'] : '';

        if ($user_id == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_UID_REQ);
        } else {

            /* $arr = array('user_id' => $user_id, "merchant_id" => $merchant_id, "added_date" => date("Y-m-d H:i:s"));

              $lastId = $this->db->select('tbl_subscribe_list',$arr);

             */

            $this->db->select('tbl_product_records.*, tbl_offers_records.*');

            $this->db->from('tbl_subscribe_list');

            $this->db->join('tbl_product_records', 'tbl_product_records.user_id = tbl_subscribe_list.merchant_id');

            $this->db->join('tbl_offers_records', 'tbl_offers_records.product_id = tbl_product_records.product_id');

            $this->db->where('tbl_subscribe_list.user_id', $user_id);

            $query = $this->db->get();

            //return $this->db->last_query();

            if ($query->num_rows() > 0) {

                $feed_list = array();

                $json = array("status" => 1, "statusCode" => 1, "msg" => $query->num_rows() . ' ' . RECORD_FOUND);



                foreach ($query->result_array() as $row) {

                    $catStr = "`offer_id` = '" . $row['offer_id'] . "'";

                    $total_like = $this->totalCount('tbl_offer_likes', $catStr);

                    $catStr.= " AND `user_id` = '" . $user_id . "'";

                    $is_like = $this->totalCount('tbl_offer_likes', $catStr);

                    $offer_images = $this->offerImageList($row['offer_id']);

                    $json['feed_list'][] = array_merge($row, array("total_like" => $total_like, "is_like" => $is_like, "comment_list" => $this->getofferCommentList($row['offer_id'], 1, 10), "offer_images" => $offer_images));
                }
            } else {

                $json = array("status" => 1, "statusCode" => 0, "msg" => NO_RECORD_FOUND);
            }
        }

        return $json;
    }

    public function getofferCommentList($offer_id, $page, $max) {

        $data = array();

        $str = '';

        if ($page != '' && $page != '0' && $max != '' && $max != '0') {

            $start = ($page - 1) * $max;

            $str = " LIMIT $start, $max";
        }

        $sql = $this->db->query("SELECT * FROM `tbl_offer_comments` WHERE `offer_id` = '" . $offer_id . "' $str");

        if ($sql->num_rows() > 0) {

            foreach($sql->result_array() as $key => $value){
				$data[] = array_merge($value, array("user_info" => $this->getUserInfo($value['user_id'])));
			}
        }

        return $data;
    }

    public function getofferCommentListData($post) {

        $offer_id = isset($post['offer_id']) ? $post['offer_id'] : '';

        if (@$post['page'] != '') {
            $page = $post['page'];
        } else {
            $page = '1';
        }

        if (@$post['max'] != '') {
            $max = $post['max'];
        } else {
            $max = '10';
        }

        if ($offer_id == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_OFFER_ID_REQ);
        } else {

            $comment_list = $this->getofferCommentList($offer_id, $page, $max);

            if (count($comment_list) > 0) {

                $json = array("status" => 1, "statusCode" => 1, "msg" => RECORD_FOUND, "comment_list" => $comment_list);
            } else {

                $json = array("status" => 1, "statusCode" => 0, "msg" => NO_RECORD_FOUND);
            }
        }

        return $json;
    }

    public function getRecommendedList($post) {
		if (@$post['page'] != '') {
            $page = $post['page'];
        } else {
            $page = '1';
        }
        if (@$post['max'] != '') {
            $max = $post['max'];
        } else {
            $max = '10';
        }
        $json = $data = array();
		$user_id = isset($post['user_id']) ? $post['user_id'] : '';
		$city_id = isset($post['city_id']) ? $post['city_id'] : '';
		$locality_id = isset($post['locality_id']) ? $post['locality_id'] : '';
        if ($user_id == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_UID_REQ);
        } else {

			if ($page != '' && $page != '0' && $max != '' && $max != '0') {
                $start = ($page - 1) * $max;
                $str = " LIMIT $start, $max";
            }
			//$sql = $this->db->query("SELECT * FROM `tbl_offers_records` AS `tor` JOIN `tbl_offer_sponsered_records` AS `tosr` ON `tosr`.`offer_id` = `tor`.`offer_id` JOIN `tbl_product_records` AS `tpr` ON `tpr`.`product_id` = `tor`.`product_id` WHERE `tpr`.`user_id` != '".$user_id."' AND `tosr`.`start_date` <= '".date("Y-m-d")."' AND `tosr`.`end_date` >= '".date("Y-m-d")."' ORDER BY `tor`.`offer_id` desc $str");
  $where = array("`tbl_offer_sponsered_records`.`start_date` <= " => date("Y-m-d"),'`tbl_offer_sponsered_records`.`end_date` >= ' => date("Y-m-d"));
  $this->db->select("*");
  $this->db->from('tbl_offers_records');
  $this->db->join('tbl_offer_sponsered_records', 'tbl_offer_sponsered_records.offer_id = tbl_offers_records.offer_id'); 
  if($user_id!=''){
  $this->db->join('tbl_product_records', 'tbl_product_records.product_id = tbl_offers_records.product_id');
  $this->db->where('`tbl_product_records`.`user_id`!= ',$user_id);
  }
  if($city_id!='' && $locality_id!=''){
  	
  	$this->db->join('tbl_user_records','tbl_product_records.user_id = tbl_user_records.id');
	$this->db->where('tbl_user_records.city_ids',$city_id);
	$this->db->where('tbl_user_records.Locality_ids ',$locality_id);
	
  }
  $this->db->where($where);
  $this->db->order_by('tbl_offers_records.offer_id','DESC');
  $sql = $this->db->get();
 //return $this->db->last_query();
			
			if ($sql->num_rows() > 0) {
				$data = array();
				foreach ($sql->result_array() as $val) {
					$s = $this->db->query("SELECT * FROM `tbl_product_records` WHERE `product_id` = '" . $val['product_id'] . "'");
					$r = $s->result();
					$offer_images = $this->offerImageList($val['offer_id']);
					$comment_list = $this->getofferCommentList($val['offer_id'], 1, 10);
					$catStr = "`offer_id` = '" . $val['offer_id'] . "'";
					$total_like = $this->totalCount('tbl_offer_likes', $catStr);
					$isLike = $this->getIsOfferLike($val['offer_id'], $user_id);
					$data[] = array_merge($val, array("offer_images" => $offer_images, "comment_list" => $comment_list, "total_like" => $total_like, "isLike" => $isLike, "user_info" => $this->getUserInfoData($r[0]->user_id)));
				}
				 $json = array("status" => 1, "statusCode" => 1, "msg" => RECORD_FOUND, "offer_list" => $data);
			} else {
					$json = array("status" => 1, "statusCode" => 0, "msg" => NO_RECORD_FOUND);
			}
		}
        return $json;
    }

    public function likeFeed($post) {

        $offer_id = isset($post['offer_id']) ? $post['offer_id'] : '';

        $user_id = isset($post['user_id']) ? $post['user_id'] : '';

        $like_val = isset($post['like_val']) ? $post['like_val'] : '';

        if ($offer_id == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_OFFER_ID_REQ);
        } elseif ($user_id == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_UID_REQ);
        } else {

            if ($like_val == '0') {

                $array = array("user_id" => $user_id, "offer_id" => $offer_id);

                $sqlIns = $this->db->delete("tbl_offer_likes", $array);

                if ($sqlIns) {

                    $json = array("status" => 1, "statusCode" => 1, "msg" => "Offer deleted successully!");
                } else {

                    $json = array("status" => 1, "statusCode" => 0, "msg" => "Offer not Deleted");
                }
            } else {

                $sql = $this->db->query("SELECT * FROM `tbl_offer_likes` WHERE `user_id` = '$user_id' AND `offer_id` = '" . $offer_id . "'");

                if ($sql->num_rows() > 0) {

                    $json = array("status" => 1, "statusCode" => 0, "msg" => "Already Liked!");
                } else {

                    $array = array("user_id" => $user_id, "offer_id" => $offer_id, "added_date" => date("Y-m-d H:i:s"));

                    $sqlIns = $this->db->insert("tbl_offer_likes", $array);

                    if ($sqlIns) {

                        $json = array("status" => 1, "statusCode" => 1, "msg" => "Offer Like " . ADDED_SUCCESS);
                    } else {

                        $json = array("status" => 1, "statusCode" => 0, "msg" => "Offer Like " . NOT_ADDED);
                    }
                }
            }
        }

        return $json;
    }

    public function commentFeed($post) {

        $offer_id = isset($post['offer_id']) ? $post['offer_id'] : '';

        $user_id = isset($post['user_id']) ? $post['user_id'] : '';

        $comment_text = isset($post['comment_text']) ? $post['comment_text'] : '';

        if ($offer_id == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_OFFER_ID_REQ);
        } elseif ($user_id == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_UID_REQ);
        } elseif ($comment_text == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_COMMENT_TEXT_REQ);
        } else {

            $array = array("user_id" => $user_id, "offer_id" => $offer_id, "comment_text" => $comment_text, "added_date" => date("Y-m-d H:i:s"));

            $sqlIns = $this->db->insert("tbl_offer_comments", $array);

            $comment_id = $this->db->insert_id();

            if ($sqlIns) {

                $json = array("status" => 1, "statusCode" => 1, "comment_id" => $comment_id, "msg" => "Offer Comment " . ADDED_SUCCESS);
            } else {

                $json = array("status" => 1, "statusCode" => 0, "msg" => "Offer Comment " . NOT_ADDED);
            }
        }

        return $json;
    }

    public function getSearchData($post) {

        $latitude = isset($post['latitude']) ? $post['latitude'] : '';

        $longitude = isset($post['longitude']) ? $post['longitude'] : '';

        $category = isset($post['category']) ? $post['category'] : '';

        $sub_category = isset($post['sub_category']) ? $post['sub_category'] : '';

        $place_id = isset($post['place_id']) ? $post['place_id'] : '';

        $search_text = isset($post['search_text']) ? $post['search_text'] : '';

        $search_text = isset($post['search_text']) ? $post['search_text'] : '';
    }

    public function sendRecomondedRequest($post) {

        $offer_id = isset($post['offer_id']) ? $post['offer_id'] : '';

        $user_id = isset($post['user_id']) ? $post['user_id'] : '';

        /* if($offer_id == ''){

          $json = array("status"=>0, "statusCode"=>0, "msg" => ERROR_OFFER_ID_REQ);

          } */if ($user_id == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_UID_REQ);
        } else {

            $sql = $this->db->query("SELECT * FROM `tbl_offers_records` WHERE `offer_id` = '" . $offer_id . "'");

            $num = $sql->num_rows($sql);

            if ($num > 0) {

                $sql1 = $this->db->query("SELECT * FROM `tbl_recommeded_merchant` WHERE `offer_id` = '" . $offer_id . "' AND `user_id` = '" . $user_id . "'");

                $num1 = $sql1->num_rows($sql);

                if ($num1 > 0) {

                    $json = array("status" => 1, "statusCode" => 0, "msg" => "Already added!");
                } else {

                    $array = array('offer_id' => $offer_id, 'user_id' => $user_id, "added_date" => date("Y-m-d H:i:s"));

                    $sqlIns = $this->db->insert('tbl_recommeded_merchant', $array);

                    if ($sqlIns) {

                        $json = array("status" => 1, "statusCode" => 1, "msg" => ADDED_SUCCESS);
                    } else {

                        $json = array("status" => 1, "statusCode" => 0, "msg" => NOT_ADDED);
                    }
                }
            } else {

                $json = array("status" => 1, "statusCode" => 0, "msg" => "Invalid Offer!");
            }
        }

        return $json;
    }

    public function getNearByOffer($post) {
	
        $str = $locality_id = $city_id = $sub_category_id = $user_id = $category_id = '';

        if ($post['user_id'] != '') {
            $user_id = $post['user_id'];
        }
        if ($post['category_id'] != '') {
            $category_id = $post['category_id'];
        }
        if ($post['sub_category_id'] != '') {
            $sub_category_id = $post['sub_category_id'];
        }				
		if ($post['locality_id'] != '') {
            $locality_id = $post['locality_id'];
			//$str = "WHERE FIND_IN_SET( ".$locality_id.", places_ids )";
        }
		if ($post['city_id'] != '') {
            $city_id = $post['city_id'];
        }

        if ($user_id == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_UID_REQ);
        } else {

            $json = array();

            /* SELECT *, ( 6371 * ACOS( COS( RADIANS( $lat ) ) * COS( RADIANS( latitude ) ) * COS( RADIANS( longitude ) - RADIANS( $long ) ) + SIN( RADIANS( $lat ) ) * SIN( RADIANS( latitude ) ) ) ) AS distance FROM `tbl_product_records` WHERE `status` = 1 ".$str."  HAVING distance < $distance ORDER BY distance LIMIT 0 , 20 */
//return "SELECT * FROM  `tbl_product_records` WHERE FIND_IN_SET( ".$locality_id.", places_ids )";
 $where = array("`tbl_offers_records`.`start_date` <= " => date("Y-m-d"),'`tbl_offers_records`.`end_date` >= ' => date("Y-m-d"));
  $this->db->select("*");
  $this->db->from('tbl_offers_records');
  $this->db->join('tbl_product_records', 'tbl_product_records.product_id = tbl_offers_records.product_id');
  $this->db->where('`tbl_product_records`.`user_id`!= ',$user_id);
  if($city_id!='' && $locality_id!=''){
  	$this->db->join('tbl_user_records','tbl_product_records.user_id = tbl_user_records.id');
	$this->db->where('tbl_user_records.city_ids',$city_id);
	$this->db->where('tbl_user_records.Locality_ids ',$locality_id);
  }
  if($category_id!='' && $sub_category_id!=''){
	$this->db->where('tbl_product_records.category_id ',$category_id);
	$this->db->where('tbl_product_records.sub_category_id ',$sub_category_id);
  }  
  $this->db->where($where);
  $this->db->order_by('tbl_offers_records.offer_id','DESC');
  $sql = $this->db->get();
  $this->db->last_query();
  // $sql = $this->db->query("SELECT * FROM  `tbl_product_records` $str");
			if ($sql->num_rows() > 0) {
				$data = array();
				foreach ($sql->result_array() as $val) {
					$s = $this->db->query("SELECT * FROM `tbl_product_records` WHERE `product_id` = '" . $val['product_id'] . "'");
					$r = $s->result();
					$offer_images = $this->offerImageList($val['offer_id']);
					$comment_list = $this->getofferCommentList($val['offer_id'], 1, 10);
					$catStr = "`offer_id` = '" . $val['offer_id'] . "'";
					$total_like = $this->totalCount('tbl_offer_likes', $catStr);
					$isLike = $this->getIsOfferLike($val['offer_id'], $user_id);
					$data[] = array_merge($val, array("offer_images" => $offer_images, "comment_list" => $comment_list, "total_like" => $total_like, "isLike" => $isLike, "user_info" => $this->getUserInfoData($r[0]->user_id)));
				}
				 $json = array("status" => 1, "statusCode" => 1, "msg" => RECORD_FOUND, "offer_list" => $data);
			} else {
					$json = array("status" => 1, "statusCode" => 0, "msg" => NO_RECORD_FOUND);
			}
        }

        return $json;
    }

    public function getIsOfferLike($offer_id, $user_id) {

        $value = 0;

        $sql = $this->db->query("SELECT * FROM `tbl_offer_likes` WHERE `offer_id` = '" . $offer_id . "' AND `user_id` = '" . $user_id . "'");

        if ($sql->num_rows() > 0) {

            $value = 1;
        }

        return $value;
    }

    public function getNotificationList($post) {

        $user_id = '';

        if ($post['user_id'] != '') {
            $user_id = $post['user_id'];
        }

        if ($user_id == '') {

            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_UID_REQ);
        } else {

            $json = array();

            $sql = $this->db->query("SELECT `notification_id`, `type`, `notification_title`, `notifiaction_desc`, `notification_image`, `added_date` FROM `tbl_notification_records` WHERE FIND_IN_SET(" . $user_id . ", user_ids)");

            if ($sql->num_rows() > 0) {

                $json = array("status" => 1, "statusCode" => 1, "msg" => $sql->num_rows() . ' ' . RECORD_FOUND);

                $json['notification_info'] = array();

                foreach ($data = $sql->result() as $data) {

                    $json['notification_info'][] = $data;
                }
            } else {

                $json = array("status" => 1, "statusCode" => 0, "msg" => NO_RECORD_FOUND);
            }
        }

        return $json;
    }

    function addNotificationData($sender_id, $receiver_id, $type, $title, $media_id) {

        $addSql = mysql_query("INSERT INTO `tbl_notification_records`(`title`, `type`, `sender_id`, `receiver_id`,`media_id`, `added_date`) VALUES ('" . $title . "','" . $type . "','" . $sender_id . "','" . $receiver_id . "','" . $media_id . "','" . date("Y-m-d H:i:s") . "')");

        if ($type == 'friend_request') {

            $message = $this->userName($sender_id) . ' Sent you Friend Request.';
        } elseif ($type == 'response_request') {

            $message = $this->userName($sender_id) . ' Confirm your Friend Request.';
        } elseif ($type == 'like') {

            $message = $this->userName($sender_id) . ' Like your Media.';
        } elseif ($type == 'comment') {

            $message = $this->userName($sender_id) . ' Comments on your Media.';
        }

        $msg = array("sender_id" => $sender_id, "receiver_id" => $receiver_id, "sender_image" => $this->getUserImage($sender_id), "title" => $title, "type" => $type, "media_id" => $media_id, "message" => $message);

        $registrationIds[] = $this->getDeviceToken($receiver_id);

        return $this->sendPushFCM($registrationIds, $msg);
    }

    public function sendPushFCM($registrationIds, $msg) {

        define('API_ACCESS_KEY', 'AAAA1OLOQe8:APA91bGTQWNZdd64-5BVQDhoj3V1lRkAtrD40UZTflP9p73ycchLQ-IEHWjgBCOGdSKbgVHi1YSSYUwzaC-XcuNV_mmpLtonmTDV8ORjUnVVb38cHrpCh3gYfkuUyoqvZEq0RTPeN9Ez');

        $fields = array('registration_ids' => $registrationIds, 'data' => $msg);

        $headers = array('Authorization: key=' . API_ACCESS_KEY, 'Content-Type: application/json');



        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        $result = curl_exec($ch);

        curl_close($ch);



        return $result;
    }

    public function getDeviceToken($user_id) {
        $sql = $this->db->query("SELECT * FROM `tbl_users_records` WHERE `user_id`='" . $user_id . "'");
        $num = $sql->num_rows();
        if ($num > 0) {
            $data = $sql->result();
            $device_token = $data[0]->device_token;
        }
        return $device_token;
    }

    function getUserImage($user_id) {
        $sql = $this->db->query("SELECT * FROM `tbl_users_records` WHERE `user_id`='" . $user_id . "'");
        $num = $sql->num_rows();
        if ($num > 0) {
            $data = $sql->result();
            $image = BASE_URLD . 'uploads/profile_pic/' . $data[0]->profile_pic;
        }
        return $image;
    }

    public function getContact($post) {
        $merchant_id = $name = $email = '';
        if (@$post['name'] != '') {
            $name = $post['name'];
        }
        if (@$post['user_id'] != '') {
            $user_id = $post['user_id'];
        }
        if (@$post['email'] != '') {
            $email = $post['email'];
        }
        if (@$post['mobile'] != '') {
            $mobile = $post['mobile'];
        }
        if (@$post['subject'] != '') {
            $subject = $post['subject'];
        }
        if (@$post['message'] != '') {
            $message = $post['message'];
        }
        if (@$post['merchant_id'] != '') {
            $merchant_id = $post['merchant_id'];
        }
        if (@$post['offer_id'] != '') {
            $offer_id = $post['offer_id'];
        }
        if (@$post['product_id'] != '') {
            $product_id = $post['product_id'];
        }
        if ($user_id == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_UID_REQ);
        } else if ($merchant_id == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => "Merchant Id Should Not be Blank!");
        } else if ($offer_id == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => "Offer Id Should Not be Blank!");
        } else if ($product_id == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => "Product Id Should Not be Blank!");
        } else if ($name == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_NAME_REQ);
        } else if ($email == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_EMAIL_REQ);
        } else if ($mobile == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_MOBILE_REQ);
        } else {
            $array['user_id'] = $user_id;
            $array['name'] = $name;
            $array['email'] = $email;
            $array['mobile'] = $mobile;
            $array['subject'] = $subject;
            $array['message'] = $message;
            $array['merchant_id'] = $merchant_id;
            $array['offer_id'] = $offer_id;
            $array['product_id'] = $product_id;

            $sql = $this->db->insert('tbl_enquiry_records', $array);

            userSendOfferEnquiryMail($name, $email);
            
            if ($sql) {
                $json = array("status" => 1, "statusCode" => 1, "msg" => ADDED_SUCCESS);
            } else {
                $json = array("status" => 1, "statusCode" => 0, "msg" => NOT_ADDED);
            }
        }
        return $json;
    }

    /*Add product enquiry*/
     public function addEnquiryProduct($post) {
        $merchant_id = $name = $email = '';
        if (@$post['name'] != '') {
            $name = $post['name'];
        }
        if (@$post['user_id'] != '') {
            $user_id = $post['user_id'];
        }
        if (@$post['email'] != '') {
            $email = $post['email'];
        }
        if (@$post['mobile'] != '') {
            $mobile = $post['mobile'];
        }
        if (@$post['subject'] != '') {
            $subject = $post['subject'];
        }
        if (@$post['message'] != '') {
            $message = $post['message'];
        }
        if (@$post['merchant_id'] != '') {
            $merchant_id = $post['merchant_id'];
        }
        if (@$post['offer_id'] != '') {
            $offer_id = $post['offer_id'];
        }
        if (@$post['product_id'] != '') {
            $product_id = $post['product_id'];
        }

        if (@$post['is_for_product'] != '') {
            $is_for_product = $post['is_for_product'];
        }
   
        if ($user_id == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_UID_REQ);
        } else if ($merchant_id == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => "Merchant Id Should Not be Blank!");
        } else if ($is_for_product == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => "is_for_product Should Not be Blank!");
        } else if ($product_id == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => "Product Id Should Not be Blank!");
        } else if ($name == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_NAME_REQ);
        } else if ($email == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_EMAIL_REQ);
        } else if ($mobile == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_MOBILE_REQ);
        } else {
            $array['user_id'] = $user_id;
            $array['name'] = $name;
            $array['email'] = $email;
            $array['mobile'] = $mobile;
            $array['subject'] = $subject;
            $array['message'] = $message;
            $array['merchant_id'] = $merchant_id;
            $array['offer_id'] = '0';
            $array['product_id'] = $product_id;
            $array['is_for_product'] = '1';

            $sql = $this->db->insert('tbl_enquiry_records', $array);
            /*echo $sql;
            exit;*/
            userSendProductEnquiryMail($name, $email);
            if ($sql) {
                $json = array("status" => 1, "statusCode" => 1, "msg" => ADDED_SUCCESS);
            } else {
                $json = array("status" => 1, "statusCode" => 0, "msg" => NOT_ADDED);
            }
        }
        return $json;
    }

    /*get List  enquiry product (not in use)*/
    public function listEnquiryProduct($post) {
        $user_id = '';
        if (@$post['user_id'] != '') {
            $user_id = $post['user_id'];
        }
        if ($user_id == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_UID_REQ);
        } else {
            $sqlDa = $this->db->query("SELECT * FROM `tbl_enquiry_records` WHERE `user_id` = '" . $user_id . "'");
            /*$sqlDa = $this->db->query("SELECT `ter`.*,`tor`.`offer_title`,`tur`.`profile_pic` FROM `tbl_enquiry_records` AS ter LEFT JOIN `tbl_offers_records` AS tor ON ter.`offer_id` = tor.`offer_id` LEFT JOIN `tbl_user_records` AS `tur` ON tur.`id` = `ter`.`user_id` WHERE `user_id` = '" . $user_id . "'");*/

            if ($sqlDa->num_rows() > 0) {
                $json['enquiry_list_product'] = array();
                $json = array("status" => 1, "statusCode" => 1, "msg" => $sqlDa->num_rows() . ' ' . RECORD_FOUND);
                foreach ($sqlDa->result_array() as $data) { 
                   /* $profile_pic = BASE_URLD . 'uploads/profile_pic/' . $data['profile_pic'];
                    $json['enquiry_list_product'][] = array_merge($data,array("profile_pic"=>$profile_pic,"user_info" => $this->getUserInfo($data['merchant_id'])));*/
                    $json['enquiry_list_product'][] = $data;
                }
            } else {
                $json = array("status" => 1, "statusCode" => 0, "msg" => NO_RECORD_FOUND);
            }
        }
        return $json;
    }

    /*end*/

    public function addCommentEnquiry($post) {
        $enquiry_id = isset($post['enquiry_id']) ? $post['enquiry_id'] : '';
        $user_id = isset($post['user_id']) ? $post['user_id'] : '';
        $comment_text = isset($post['comment_text']) ? $post['comment_text'] : '';
        $is_owner = isset($post['is_owner']) ? $post['is_owner'] : '0';
        if ($enquiry_id == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => "Enquiry Id Should not be Blank!");
        } elseif ($user_id == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_UID_REQ);
        } elseif ($comment_text == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_COMMENT_TEXT_REQ);
        } else {
            $array = array("user_id" => $user_id, "enquiry_id" => $enquiry_id, "comment_text" => $comment_text, 'is_owner' => $is_owner, "added_date" => date("Y-m-d H:i:s"));
            $sqlIns = $this->db->insert("tbl_enquiry_comments", $array);
            $comment_id = $this->db->insert_id();
            if ($sqlIns) {
                $json = array("status" => 1, "statusCode" => 1, "comment_id" => $comment_id, "msg" => "Enquiry Comment " . ADDED_SUCCESS);
            } else {
                $json = array("status" => 1, "statusCode" => 0, "msg" => "Offer Comment " . NOT_ADDED);
            }
        }
        return $json;
    }

    public function listEnquiry($post) {
        $user_id = '';
        if (@$post['user_id'] != '') {
            $user_id = $post['user_id'];
        }
        if ($user_id == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_UID_REQ);
        } else {
           /* $sqlDa = $this->db->query("SELECT `ter`.*,`tor`.`offer_title`,`tur`.`profile_pic` FROM `tbl_enquiry_records` AS ter LEFT JOIN `tbl_offers_records` AS tor ON ter.`offer_id` = tor.`offer_id` LEFT JOIN `tbl_user_records` AS `tur` ON tur.`id` = `ter`.`user_id` WHERE `user_id` = '" . $user_id . "'");*/
            $sqlDa = $this->db->query("SELECT `ter`.*,`tor`.`offer_title`,`tur`.`profile_pic` ,`tpr`.`product_title` FROM `tbl_enquiry_records` AS ter LEFT JOIN `tbl_offers_records` AS tor ON ter.`offer_id` = tor.`offer_id` LEFT JOIN `tbl_user_records` AS `tur` ON tur.`id` = `ter`.`user_id`   LEFT JOIN `tbl_product_records` AS tpr ON ter.`product_id` = tpr.`product_id`   WHERE ter.`user_id` = '" .$user_id."'  ORDER BY `ter`.`added_date` DESC ");

            /* $sqlDa = $this->db->query("SELECT `ter`.*,`tor`.`offer_title`,`tur`.`profile_pic` ,`tpr`.`product_title` FROM `tbl_enquiry_records` AS ter LEFT JOIN `tbl_offers_records` AS tor ON ter.`offer_id` = tor.`offer_id` LEFT JOIN `tbl_user_records` AS `tur` ON tur.`id` = `ter`.`user_id`   LEFT JOIN `tbl_product_records` AS tpr ON ter.`product_id` = tpr.`product_id`   WHERE `merchant_id` = '" . $merchant_id . "'  ORDER BY `ter`.`added_date` DESC ");*/

            if ($sqlDa->num_rows() > 0) {
                $json['enquiry_list'] = array();
                $json = array("status" => 1, "statusCode" => 1, "msg" => $sqlDa->num_rows() . ' ' . RECORD_FOUND);
                foreach ($sqlDa->result_array() as $data) { 
					$profile_pic = BASE_URLD . 'uploads/profile_pic/' . $data['profile_pic'];
                    $json['enquiry_list'][] = array_merge($data,array("profile_pic"=>$profile_pic,"user_info" => $this->getUserInfo($data['merchant_id'])));
                }
            } else {
                $json = array("status" => 1, "statusCode" => 0, "msg" => NO_RECORD_FOUND);
            }
        }
        return $json;
    }

    public function myEnquiry($post) {
        $merchant_id = '';
        if (@$post['merchant_id'] != '') {
            $merchant_id = $post['merchant_id'];
        }
        if ($merchant_id == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => "Merchant" . ERROR_UID_REQ);
        } else {
            /*$sqlDa = $this->db->query("SELECT `ter`.*,`tor`.`offer_title`,`tur`.`profile_pic` FROM `tbl_enquiry_records` AS ter LEFT JOIN `tbl_offers_records` AS tor ON ter.`offer_id` = tor.`offer_id` LEFT JOIN `tbl_user_records` AS `tur` ON tur.`id` = `ter`.`user_id` WHERE `merchant_id` = '" . $merchant_id . "'");*/
            $sqlDa = $this->db->query("SELECT `ter`.*,`tor`.`offer_title`,`tur`.`profile_pic` ,`tpr`.`product_title` FROM `tbl_enquiry_records` AS ter LEFT JOIN `tbl_offers_records` AS tor ON ter.`offer_id` = tor.`offer_id` LEFT JOIN `tbl_user_records` AS `tur` ON tur.`id` = `ter`.`user_id`   LEFT JOIN `tbl_product_records` AS tpr ON ter.`product_id` = tpr.`product_id`   WHERE `merchant_id` = '" . $merchant_id . "'  ORDER BY `ter`.`added_date` DESC ");
            if ($sqlDa->num_rows() > 0) {
                $json['enquiry_list'] = array();
                $json = array("status" => 1, "statusCode" => 1, "msg" => $sqlDa->num_rows() . ' ' . RECORD_FOUND);
                foreach ($sqlDa->result_array() as $data) {
                    $profile_pic = BASE_URLD . 'uploads/profile_pic/' . $data['profile_pic'];
                    $json['enquiry_list'][] = array_merge($data,array("profile_pic"=>$profile_pic,"user_info" => $this->getUserInfo($data['user_id'])));
                }
            } else {
                $json = array("status" => 1, "statusCode" => 0, "msg" => NO_RECORD_FOUND);
            }
        }
        return $json;
    }

    public function changeEnquiryStatus($post) {
        $merchant_id = $name = $enquiry_id = '';
        if (@$post['status'] != '') {
            $status = $post['status'];
        }
        if (@$post['enquiry_id'] != '') {
            $enquiry_id = $post['enquiry_id'];
        }
        if (@$post['merchant_id'] != '') {
            $merchant_id = $post['merchant_id'];
        }
        if ($enquiry_id == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => "Enquiry Id Should Not be Blank!");
        } else if ($merchant_id == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => "Merchant Id Should Not be Blank!");
        } else if ($status == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => "Enquiry status Should Not be Blank!");
        } else {
            $array['id'] = $enquiry_id;
            $array['merchant_id'] = $merchant_id;

            $sql = $this->db->update('tbl_enquiry_records', array("status" => $status), $array);
            if ($sql) {
                $json = array("status" => 1, "statusCode" => 1, "msg" => UPDATED_SUCCESS);
            } else {
                $json = array("status" => 1, "statusCode" => 0, "msg" => NOT_ADDED);
            }
        }
        return $json;
    }


    /*update status==1 by RT 15july17*/

        /*change enquiry status */
        public function UpdateEnquiryStatus($post) {
        $merchant_id = $name = $enquiry_id = '';
        if (@$post['status'] != '') {
            $status = $post['status'];
        }
        if (@$post['enquiry_id'] != '') {
            $enquiry_id = $post['enquiry_id'];
        }
        if (@$post['merchant_id'] != '') {
            $merchant_id = $post['merchant_id'];
        }
        if ($enquiry_id == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => "Enquiry Id Should Not be Blank!");
        } else if ($merchant_id == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => "Merchant Id Should Not be Blank!");
        } else if ($status == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => "Enquiry status Should Not be Blank!");
        } else {
            $array['id'] = $enquiry_id;
            $array['merchant_id'] = $merchant_id;

            $sql = $this->db->update('tbl_enquiry_records', array("status" => $status), $array);
            if ($sql) {
                $json = array("status" => 1, "statusCode" => 1, "msg" => UPDATED_SUCCESS);
            } else {
                $json = array("status" => 1, "statusCode" => 0, "msg" => NOT_ADDED);
            }
        }
        return $json;
    }

     /*change enquiry is_closed */
        public function UpdateEnquiryClosed($post) {
        $merchant_id = $name = $enquiry_id = '';
        if (@$post['is_closed'] != '') {
            $is_closed = $post['is_closed'];
        }
        if (@$post['enquiry_id'] != '') {
            $enquiry_id = $post['enquiry_id'];
        }
        if (@$post['merchant_id'] != '') {
            $merchant_id = $post['merchant_id'];
        }
        if ($enquiry_id == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => "Enquiry Id Should Not be Blank!");
        } else if ($merchant_id == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => "Merchant Id Should Not be Blank!");
        } else if ($is_closed == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => "Enquiry is_closed Should Not be Blank!");
        } else {
            $array['id'] = $enquiry_id;
            $array['merchant_id'] = $merchant_id;

            $sql = $this->db->update('tbl_enquiry_records', array("is_closed" => $is_closed), $array);
            if ($sql) {
                $json = array("status" => 1, "statusCode" => 1, "msg" => UPDATED_SUCCESS);
            } else {
                $json = array("status" => 1, "statusCode" => 0, "msg" => NOT_ADDED);
            }
        }
        return $json;
    }

       /*change user view email/phone */
        public function changeUserViewPhoneEmail($post) {
        $user_id = $view_phone = $view_email = '';
        if (@$post['view_phone'] != '') {
            $view_phone = $post['view_phone'];
        }
        if (@$post['view_email'] != '') {
            $view_email = $post['view_email'];
        }
        if (@$post['user_id'] != '') {
            $user_id = $post['user_id'];
        }
        if ($user_id == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => "User Id Should Not be Blank!");
        } else if ($view_phone == '' && $view_email == '' ) {
            $json = array("status" => 0, "statusCode" => 0, "msg" => "view_phone/view_email Should Not be Blank!");
        }/* else if ($view_email == '' ) {
            $json = array("status" => 0, "statusCode" => 0, "msg" => "view_email Should Not be Blank!");
        } */else {
            $array['id'] = $user_id;
            /*$array['view_email'] = $view_email;
            $array['view_phone'] = $view_phone;*/
            $sql = $this->db->update('tbl_user_records', array("view_email" => $view_email, "view_phone" => $view_phone), $array);
            //$sql = $this->db->update('tbl_enquiry_records', array("view_email" => $view_email), $array);
            if ($sql) {
                $json = array("status" => 1, "statusCode" => 1, "msg" => UPDATED_SUCCESS);
            } else {
                $json = array("status" => 1, "statusCode" => 0, "msg" => NOT_ADDED);
            }
        }
        return $json;
    }

    /*end new apis by RT*/




    public function enquiryDetails($post) {
        $enquiry_id = '';
        if (@$post['enquiry_id'] != '') {
            $enquiry_id = $post['enquiry_id'];
        }
        if ($enquiry_id == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => "Enquiry Id should not be Blank!!");
        } else {
            $sqlDa = $this->db->query("SELECT * FROM `tbl_enquiry_records` WHERE `id` = '" . $enquiry_id . "'");
            if ($sqlDa->num_rows() > 0) {
                $json['enquiry_details'] = array();
                $json = array("status" => 1, "statusCode" => 1, "msg" => $sqlDa->num_rows() . ' ' . RECORD_FOUND);
                foreach ($sqlDa->result_array() as $data) {
                    $dta = array();
					$offer_image = BASE_URLD . 'uploads/profile_pic/' . $data['profile_pic'];
					$sOffer = $this->db->query("SELECT `tbl_offers_records`.`offer_title`, `tbl_offers_records`.`offer_desc`, `tbl_offers_records`.`start_date`, `tbl_offers_records`.`end_date`, CONCAT('".BASE_URLD."uploads/offer_images/',`tbl_offer_images`.`image_url`) as offer_image FROM `tbl_offers_records` LEFT JOIN `tbl_offer_images` ON `tbl_offer_images`.`offer_id` = `tbl_offers_records`.`offer_id`  WHERE `tbl_offers_records`.`offer_id` = '".$data['offer_id']."'");
					$rOffer = $sOffer->result();
					$offerDetails = $rOffer[0];
                    $json['enquiry_details'] = array_merge($data, array("enquiry_comment" => $dta,"merchant_info" => $this->getUserInfoData($data['merchant_id']),"user_info" => $this->getUserInfoData($data['user_id']),"offer_details" => $offerDetails));
                }
            } else {
                $json = array("status" => 1, "statusCode" => 0, "msg" => NO_RECORD_FOUND);
            }
        }
        return $json;
    }

/*new api for product rt 22july*/
    public function enquiryDetailsProduct($post) {
        $enquiry_id = '';
        if (@$post['enquiry_id'] != '') {
            $enquiry_id = $post['enquiry_id'];
        }
        if ($enquiry_id == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => "Enquiry Id should not be Blank!!");
        } else {
            $sqlDa = $this->db->query("SELECT * FROM `tbl_enquiry_records` WHERE `id` = '" . $enquiry_id . "'");
            if ($sqlDa->num_rows() > 0) {
                $json['enquiry_details_product'] = array();
                $json = array("status" => 1, "statusCode" => 1, "msg" => $sqlDa->num_rows() . ' ' . RECORD_FOUND);
                foreach ($sqlDa->result_array() as $data) {
                    $dta = array();
                    $offer_image = BASE_URLD . 'uploads/profile_pic/' . $data['profile_pic'];

                   /* echo "SELECT `tbl_product_records`.`product_title`, `tbl_product_records`.`product_description`, `tbl_product_records`.`price`, `tbl_product_records`.`discount_price`, CONCAT('".BASE_URLD."uploads/product_images/',`tbl_product_images`.`image_url`) as product_image FROM `tbl_product_records` LEFT JOIN `tbl_product_images` ON `tbl_product_images`.`product_id` = `tbl_product_records`.`product_id`  WHERE `tbl_product_records`.`product_id` = '".$data['product_id']."' ";*/

                    $sOffer = $this->db->query("SELECT `tbl_product_records`.`product_title`, `tbl_product_records`.`product_description`, `tbl_product_records`.`price`, `tbl_product_records`.`discount_price`, CONCAT('".BASE_URLD."uploads/product_images/',`tbl_product_images`.`image_url`) as product_image FROM `tbl_product_records` LEFT JOIN `tbl_product_images` ON `tbl_product_images`.`product_id` = `tbl_product_records`.`product_id`  WHERE `tbl_product_records`.`product_id` = '".$data['product_id']."'");
                    $rOffer = $sOffer->result();
                    $offerDetails = $rOffer[0];
                    $json['enquiry_details_product'] = array_merge($data, array("enquiry_comment" => $dta,"merchant_info" => $this->getUserInfoData($data['merchant_id']),"user_info" => $this->getUserInfoData($data['user_id']),"product_details" => $offerDetails));
                }
            } else {
                $json = array("status" => 1, "statusCode" => 0, "msg" => NO_RECORD_FOUND);
            }
        }
        return $json;
    }


 /*delete subscriber*/   
 public function DeleteSubscriber($post) {
        $user_id = '';
        if ($post['user_id'] != '') {
            $user_id = $post['user_id'];
        }
         if ($post['merchant_id'] != '') {
            $merchant_id = $post['merchant_id'];
        }

        if ($user_id == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_UID_REQ);
        } else if ($merchant_id == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => "Merchant Id Required");
        } else {
            $json = array();
            $sql = $this->db->query("SELECT * FROM `tbl_subscribe_list` WHERE `user_id` = '" . $user_id ."'");
            if ($sql->num_rows() > 0) {
                $data = array();
                //echo "DELETE FROM `tbl_subscribe_list` WHERE  `user_id` = '" . $user_id ."' AND  `merchant_id` ='" . $merchant_id . "'";

                $sqlD = $this->db->query("DELETE FROM `tbl_subscribe_list` WHERE  `user_id` = '" . $user_id ."' AND  `merchant_id` ='" . $merchant_id . "' ");
                if ($sqlD) {
                    $json = array("status" => 1, "statusCode" => 1, "msg" => "Successfully Deleted!");
                }else{
                    $json = array("status" => 1, "statusCode" => 0, "msg" => "Not exist!");
                }
            } else {
                $json = array("status" => 1, "statusCode" => 0, "msg" => "Detail Not exist!");
            }
        }
        return $json;
    }
/*end */







    public function enquiryRating($post) {
        $merchant_id = $rating_value = $email = '';
        if (@$post['rating_value'] != '') {
            $rating_value = $post['rating_value'];
        }
        if (@$post['user_id'] != '') {
            $user_id = $post['user_id'];
        }
        if (@$post['review_text'] != '') {
            $review_text = $post['review_text'];
        }
        if (@$post['enquiry_id'] != '') {
            $enquiry_id = $post['enquiry_id'];
        }
        if ($enquiry_id == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => "Enquiry Id should not be Blank!!");
        } elseif ($user_id == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_UID_REQ);
        } else {
            $array['rating_value'] = $rating_value;
            $array['review_text'] = $review_text;
            $sqlDa = $this->db->query("SELECT * FROM `tbl_enquiry_records` WHERE `id` = '" . $enquiry_id . "'");
            if ($sqlDa->num_rows() > 0) {
                $sql = $this->db->update('tbl_enquiry_records', $array, array("id" => $enquiry_id));
                if ($sql) {
                    $json = array("status" => 1, "statusCode" => 1, "msg" => UPDATED_SUCCESS);
                } else {
                    $json = array("status" => 1, "statusCode" => 0, "msg" => NOT_ADDED);
                }
            } else {
                $json = array("status" => 1, "statusCode" => 0, "msg" => NO_RECORD_FOUND);
            }
        }
        return $json;
    }

    public function searchMerchant($post) {
        $user_id = isset($post['user_id']) ? $post['user_id'] : '';
        $category_id = isset($post['category_id']) ? $post['category_id'] : '';
        $city_id = isset($post['city_id']) ? $post['city_id'] : '';
        $locality_id = isset($post['locality_id']) ? $post['locality_id'] : '';
        $search_text = isset($post['search_text']) ? $post['search_text'] : '';
		$lat = isset($post['lat']) ? $post['lat'] : '';
		$long = isset($post['long']) ? $post['long'] : '';
		$page = isset($post['page']) ? $post['page'] : '';
		$max = isset($post['max']) ? $post['max'] : '';

        if ($user_id == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_UID_REQ);
        } elseif ($category_id == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => "Category Id is required!");
        } elseif ($lat == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => "latitude is required!");
        } elseif ($long == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => "longitude is required!");
        } elseif ($page == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => "Page is required!");
        } elseif ($max == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => "Max is required!");
        } else{
        	$lmtstr = $json = $str = '';
            /*if ($category_id != '') {
                $str.= " AND FIND_IN_SET('" . $category_id . "', `category_ids`) ";
            }*/
            if ($city_id != '') {
                $str.= " AND FIND_IN_SET('" . $city_id . "', `city_ids`) ";
            }
            //if($search_text!=''){ $str.= " AND `search_text` = '".$search_text."' ";}
            /* `is_merchant` = '0' AND */
            
            if ($page != '' && $page != '0' && $max != '' && $max != '0') {
            $start = ($page - 1) * $max;
            	$lmtstr = " LIMIT $start, $max";
        	}
            $sqlDa = $this->db->query("SELECT * FROM `tbl_user_records` WHERE FIND_IN_SET('" . $category_id . "', `category_ids`) $str $lmtstr");
            if ($sqlDa->num_rows() > 0) {
                $json['merchant_list'] = array();
                $json = array("status" => 1, "statusCode" => 1, "msg" => $sqlDa->num_rows() . ' ' . RECORD_FOUND);
                foreach ($sqlDa->result_array() as $data) {
					$total_offer = $this->db->query("SELECT COUNT(`tbl_offers_records`.`offer_id`) as total_count FROM `tbl_offers_records` JOIN `tbl_product_records` ON `tbl_offers_records`.`product_id` = `tbl_product_records`.`product_id` WHERE `tbl_product_records`.`user_id` = '".$data['id']."'")->result();
                    $json['merchant_list'][] = array_merge($data, array("total_offer" => $total_offer[0]->total_offer,"subscribe_category" => $this->getCategoryList($data['id'], $user_id),"profile_pic" => BASE_URLD . 'uploads/profile_pic/' . $data['profile_pic'],"cover_pic" => BASE_URLD . 'uploads/cover_pic/' . $data['cover_pic']));
                }
            } else {
                $json = array("status" => 1, "statusCode" => 0, "msg" => NO_RECORD_FOUND);
            }
        }
        return $json;
    }
    public function searchMerchantByText($post) {
		$user_id = isset($post['user_id']) ? $post['user_id'] : '';
        $category_id = isset($post['category_id']) ? $post['category_id'] : '';
        $city_id = isset($post['city_id']) ? $post['city_id'] : '';
        $locality_id = isset($post['locality_id']) ? $post['locality_id'] : '';
        $search_text = isset($post['search_text']) ? $post['search_text'] : '';
		$lat = isset($post['lat']) ? $post['lat'] : '';
		$long = isset($post['long']) ? $post['long'] : '';
		$page = isset($post['page']) ? $post['page'] : '';
		$max = isset($post['max']) ? $post['max'] : '';

        if ($user_id == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_UID_REQ);
        } elseif ($lat == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => "latitude is required!");
        } elseif ($long == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => "longitude is required!");
        } elseif ($page == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => "Page is required!");
        } elseif ($max == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => "Max is required!");
        } else{
        	$lmtstr = $json = $str = '';
            if ($category_id != '') {
                $str.= " AND FIND_IN_SET('" . $category_id . "', `category_ids`) ";
            }
            if ($city_id != '') {
                $str.= " AND FIND_IN_SET('" . $city_id . "', `city_ids`) ";
            }
            //if($search_text!=''){ $str.= " AND `search_text` = '".$search_text."' ";}
            /* `is_merchant` = '0' AND */
            
            if ($page != '' && $page != '0' && $max != '' && $max != '0') {
            $start = ($page - 1) * $max;
            	$lmtstr = " LIMIT $start, $max";
        	}
            $sqlDa = $this->db->query("SELECT * FROM `tbl_user_records` WHERE  `first_name` LIKE '%" . $search_text . "%' OR `last_name` LIKE '%" . $search_text . "%' $str");
            if ($sqlDa->num_rows() > 0) {
                $json['merchant_list'] = array();
                $json = array("status" => 1, "statusCode" => 1, "msg" => $sqlDa->num_rows() . ' ' . RECORD_FOUND);
                foreach ($sqlDa->result_array() as $data) {
                    $total_offer = $this->db->query("SELECT COUNT(`tbl_offers_records`.`offer_id`) as total_count FROM `tbl_offers_records` JOIN `tbl_product_records` ON `tbl_offers_records`.`product_id` = `tbl_product_records`.`product_id` WHERE `tbl_product_records`.`user_id` = '".$data['id']."'")->result();
                   // $filter_data = $this->getFilterdata($post);
                    //$json['merchant_list'][] = array_merge($data, array("total_offer" => $total_offer, "filter_data" => $filter_data));
                    $json['merchant_list'][] = array_merge($data, array("total_offer" => $total_offer[0]->total_count,"subscribe_category" => $this->getCategoryList($data['id'], $user_id),"profile_pic" => BASE_URLD . 'uploads/profile_pic/' . $data['profile_pic'],"cover_pic" => BASE_URLD . 'uploads/cover_pic/' . $data['cover_pic']));
                }
            } else {
                $json = array("status" => 1, "statusCode" => 0, "msg" => NO_RECORD_FOUND);
            }
        }
        return $json;
    }

    public function getTotalCount($tablename, $condition) {
        $sql = $this->db->query("SELECT * FROM `" . $tablename . "` WHERE 1=1 $condition");
        return $sql->num_rows();
    }

    //------------Get Filter data according to the filter
    public function getFilterdata($post) {
        //return $post['category_id'];
        $sqlDa = $this->db->query("SELECT `category_id`, `category_name`, `category_image` FROM `tbl_category_records` WHERE `parent_id` = '" . $post['category_id'] . "'");
        $sub_place_list = $sub_category_list = array();
        if ($sqlDa->num_rows() > 0) {
            $sub_category_list = $sqlDa->result_array();
        }
        $sqlDa1 = $this->db->query("SELECT `id`, `city_name`, `place_image` FROM `tbl_places_records` WHERE `parent_id` = '" . $post['city_id'] . "'");
        if ($sqlDa1->num_rows() > 0) {
            $sub_place_list = $sqlDa1->result_array();
        }
        $array['sub_category'] = array("key" => "Sub Category", "value" => $sub_category_list);
        $array['sub_location'] = array("key" => "Sub Location", "value" => $sub_place_list);
        return $array;
    }

    public function getFeedList($post) {
        $user_id = isset($post['user_id']) ? $post['user_id'] : '';
        $category_id = isset($post['category_id']) ? $post['category_id'] : '';
        $city_id = isset($post['city_id']) ? $post['city_id'] : '';
        $search_text = isset($post['search_text']) ? $post['search_text'] : '';
        if (@$post['page'] != '') {
            $page = $post['page'];
        } else {
            $page = '1';
        }
        if (@$post['max'] != '') {
            $max = $post['max'];
        } else {
            $max = '10';
        }
        if ($user_id == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_UID_REQ);
        } else {
			$sqlSt = $this->db->query("SELECT `merchant_id`,`category_ids` FROM `tbl_subscribe_list` WHERE `user_id` = '".$user_id."'");
			$userNotSubscribeList = $sqlSt->result_array();
			$strCont = '';
			$dataStreem = $strM = '0, ';
			foreach($userNotSubscribeList as $key=>$val){
			$strM.= $val['merchant_id'].', ';
			$strCont.= $val['category_ids'].', ';
				$sqlOffers = $this->db->query("SELECT `product_id` FROM `tbl_product_records` WHERE `user_id` = '".$val['merchant_id']."' AND (FIND_IN_SET(`sub_category_id`,'".$val['category_ids']."') OR FIND_IN_SET(`sub_category_id`,'".$val['category_ids']."')) ");
				//echo "SELECT `product_id` FROM `tbl_product_records` WHERE `user_id` = '".$val['merchant_id']."' AND (FIND_IN_SET(`sub_category_id`,'".$val['category_ids']."') OR FIND_IN_SET(`sub_category_id`,'".$val['category_ids']."')) <br />";
				foreach($sqlOffers->result() as $productId){
					$dataStreem.= $productId->product_id.', ';
				}
			}
			
			//return "SELECT * FROM `tbl_user_records` AS tur JOIN `tbl_recommeded_merchant` AS trr ON `tur`.`id` = `trr`.`merchant_id` WHERE `tur`.`is_merchant` = '1' AND `tur`.`id` NOT IN(".rtrim($strM, ", ").") LIMIT 5";
            $sqlD = $this->db->query("SELECT `tur`.* FROM `tbl_user_records` AS tur JOIN `tbl_recommeded_merchant` AS trr ON `tur`.`id` = `trr`.`merchant_id` WHERE `tur`.`is_merchant` = '1' AND `tur`.`id` NOT IN(".rtrim($strM, ", ").") LIMIT 5");
            $json['merchant_list'] = array();
            if ($sqlD->num_rows() > 0) {
                foreach ($sqlD->result_array() as $data) {
                    $total_offer = $this->getTotalCount('tbl_offers_records', '');
                    $json['merchant_list'][] = array_merge($data, array("total_offer" => $total_offer,"profile_pic" => BASE_URLD . 'uploads/profile_pic/' . $data['profile_pic'],"cover_pic" => BASE_URLD . 'uploads/cover_pic/' . $data['cover_pic']));
                }
            }
            $json['recommand_list'] = array();
            $sql = $this->db->query("SELECT * FROM `tbl_offers_records` AS `tor` JOIN `tbl_offer_sponsered_records` AS `tosr` ON `tosr`.`offer_id` = `tor`.`offer_id` JOIN `tbl_product_records` AS `tpr` ON `tpr`.`product_id` = `tor`.`product_id` WHERE `tpr`.`user_id` != '".$user_id."' AND `tosr`.`start_date` <= '".date("Y-m-d")."' AND `tosr`.`end_date` >= '".date("Y-m-d")."' ORDER BY `tor`.`offer_id` desc LIMIT 5");
            if ($sql->num_rows() > 0) {
                $data = array();
                foreach ($sql->result_array() as $val) {
                    $offer_images = $this->offerImageList($val['offer_id']);
                    //$comment_list = $this->getofferCommentList($val['offer_id'],1,10);
                    $s = $this->db->query("SELECT * FROM `tbl_product_records` WHERE `product_id` = '" . $val['product_id'] . "'");
                    $r = $s->result();
                    $catStr = "`offer_id` = '" . $val['offer_id'] . "'";
                    $total_like = $this->totalCount('tbl_offer_likes', $catStr);
                    $nbv = $this->getIsOfferLike($offdata['offer_id'], $user_id);
                    $json['recommand_list'][] = array_merge($val, array("offer_images" => $offer_images, "total_like" => $total_like, "user_info" => $this->getUserInfoData($r[0]->user_id), "is_like" => $nbv));
                }
            }
            $json['feed_list'] = array();
			//userNotSubscribeList
			
            if ($page != '' && $page != '0' && $max != '' && $max != '0') {
                $start = ($page - 1) * $max;
                $str = " LIMIT $start, $max";
            }
			//return "SELECT * FROM `tbl_offers_records` AS tor JOIN `tbl_product_records` AS tpr ON `tor`.`product_id` = `tpr`.`product_id` WHERE `tpr`.`user_id` IN(".rtrim($strM, ", ").") AND (FIND_IN_SET(`tpr`.`sub_category_id`,'".rtrim($strCont, ", ")."') OR FIND_IN_SET(`tpr`.`sub_category_id`,'".rtrim($strCont, ", ")."')) ORDER BY `tor`.`offer_id` ASC ";
            //$sql = $this->db->query("SELECT * FROM `tbl_offers_records` AS tor JOIN `tbl_product_records` AS tpr ON `tor`.`product_id` = `tpr`.`product_id` WHERE `tpr`.`user_id` IN(".$strM.") AND (FIND_IN_SET(`tpr`.`sub_category_id`,".rtrim($strCont, ", ").") OR FIND_IN_SET(`tpr`.`sub_category_id`,".rtrim($strCont, ", ").")) ORDER BY `tor`.`offer_id` ASC $str");
			$sql = $this->db->query("SELECT * FROM `tbl_offers_records` WHERE `product_id` IN(".rtrim($dataStreem, ", ").") ORDER BY `offer_id` ASC $str");
            if ($sql->num_rows() > 0) {
                $data = array();
                foreach ($sql->result_array() as $val) {
                    $s = $this->db->query("SELECT * FROM `tbl_product_records` WHERE `product_id` = '" . $val['product_id'] . "'");
                    $r = $s->result();
                    $offer_images = $this->offerImageList($val['offer_id']);
                    //$comment_list = $this->getofferCommentList($val['offer_id'],1,10);
                    $catStr = "`offer_id` = '" . $val['offer_id'] . "'";
                    $total_like = $this->totalCount('tbl_offer_likes', $catStr);
					$isCatStr = "`offer_id` = '" . $val['offer_id'] . "' AND `user_id` = '".$user_id."'";
					$is_like = $this->totalCount('tbl_offer_likes', $isCatStr);
					if($is_like > 0){ $isLike = 1; }else{ $isLike = 0;}
                    $nbv = $this->getIsOfferLike($offdata['offer_id'], $user_id);
                    $json['feed_list'][] = array_merge($val, array("offer_images" => $offer_images, "total_like" => $total_like, "user_info" => $this->getUserInfoData($r[0]->user_id), "is_like" => $nbv));
                }
            }
        }
        return $json;
    }
	
	function getCategoryList($merchant_id, $user_id){
		$sql = $this->db->query("SELECT b.category_id, b.category_name FROM `tbl_subscribe_list` AS a INNER JOIN `tbl_category_records` AS b ON FIND_IN_SET(b.category_id, a.`category_ids`) > 0 WHERE a.user_id = '".$user_id."' AND a.`merchant_id` ='".$merchant_id."'");
		return $sql->result();
		
	}
	function testPushNotification($post){
	    $user_id = isset($post['user_id']) ? $post['user_id'] : '';
        $deviceToken = isset($post['device_token']) ? $post['device_token'] : '';
        if ($deviceToken == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => "Device Token should not be Blank");
        } else {
			$registrationIds[] = $deviceToken;
			$result = $this->sendPushFCM($registrationIds, $msg);
			$json = array("status" => 1, "statusCode" => 1,"response" => $result, "msg" => "Push Sent Successfully");
		}
		return $json;
	}
	function forgotPassword($post){
        if (@$post['mobile'] != '') {
            $mobile = $post['mobile'];
        } else {
            $mobile = '';
        }
        if ($mobile == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => "Mobile should not be Blank");
        } else {

            $user_status = $this->db->query("SELECT * FROM `tbl_user_records` WHERE `mobile` = '".$mobile."'");
			if($user_status->num_rows() > 0){

                userForgetPasswordMail($user_status->name, $user_status->email, $user_status->password);

				$row = $user_status->result();
				$otp_no = mt_rand(1000, 9999);
            	$res = $this->sendPassword($mobile,$row[0]->password);
            	$json = array("status" => 1, "statusCode" => 1, "res" => $res, "msg" => "Password send succesfully on your mobile!");
			}else{
				$json = array("status" => 1, "statusCode" => 0, "msg" => "Mobile no not exists in the Database!");
			}
        }

        return $json;
    
	}
	public function reportOffers($post){
	    $offer_id = isset($post['offer_id']) ? $post['offer_id'] : '';
        $user_id = isset($post['user_id']) ? $post['user_id'] : '';
        $comment_text = isset($post['comment_text']) ? $post['comment_text'] : '';
        $is_owner = isset($post['is_owner']) ? $post['is_owner'] : '0';
        if ($offer_id == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => "Offer Id Should not be Blank!");
        } elseif ($user_id == '') {
            $json = array("status" => 0, "statusCode" => 0, "msg" => ERROR_UID_REQ);
        } else{
			$sql = $this->db->query("SELECT * FROM `tbl_offer_report_abuse` WHERE `user_id` = '".$user_id."' AND `offer_id` = '".$offer_id."' ");
			if($sql->num_rows() > 0){
				$array = array("user_id" => $user_id, "offer_id" => $offer_id,"added_date" => date("Y-m-d H:i:s"));
				$response = $this->db->insert("tbl_offer_report_abuse", $array);
			}else{
				$response = '5';
			}
            if ($response) {
                $json = array("status" => 1, "statusCode" => 1,"msg" => "Report Abouse " . ADDED_SUCCESS);
            } else {
                $json = array("status" => 1, "statusCode" => 0, "msg" => "Report Abouse " . NOT_ADDED);
            }
        }
        return $json;
	}
}


/////Registration email/////
function userSignUpMail($firstname, $email, $password){
$message = '
<table width="1000" border="0" style="background:url(https://www.mysolutions4u.com/btapp_apis/images/bg.jpg) repeat-x; margin:0 auto; width:1000px; border:1px solid #fff; height:1000px;">
  <tr>
    <td width="80"><span class="style2"></span></td>
    <td width="826" valign="top"><table width="100%" border="0" cellspacing="20">
  <tr>
    <td width="49%" class="style2"><img src="https://www.mysolutions4u.com/btapp_apis/images/logo.jpg" alt="logo" width="234" height="74" longdesc="http://breathmastry.com" /></td>
    <td width="51%" align="right" class="style2"><img src="https://www.mysolutions4u.com/btapp_apis/images/right_logo.jpg" alt="flower" width="89" height="84" /></td>
  </tr>
  <tr>
    <td colspan="2" class="style2" style="background:#fff; border:2px solid #ddd;height:200px; padding:20px;"><p>Dear '.$name.',</p>
    
<p><strong>Welcome to Property App</strong><p>
<p>Thank you for Downloading our App and signing up with us. Your new account has been setup and you can now login to our client area using the details below.</p>
      <p><strong>Email Address:</strong> '.$email.'<br />
        <strong>Password:</strong> '.$password.'<br /> 

        <p style="color:red;font-style: italic;">Please save these credentials for future logins.</p>    
       <p>Thankyou,</p>     
      <p>PropertyApp Team </p></td>
    </tr>
  
  <tr>
    <td colspan="2" align="center" class="style2"><hr /><span class="style3"><a href="">Visit Our Website</a>  | <a href="">Login Your Account</a>  | <a href="mailto:support@propertyapp.com">support@propertyapp.com</a></span><br />
      <span class="style3">Copyright &copy; Propertyapp Tech, All Right Reserved.</span></td>
    </tr>
  
</table></td>
    <td width="80"><span class="style2"></span></td>
  </tr>
</table>';

$subject = 'Welcome to PropertyApp';
// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
// More headers
$headers .= 'From: PropertyApp <admin@aartichauhan.com>' . "\r\n";
//$headers .= 'Cc: artianu1991@gmail.com' . "\r\n";
$headers .= 'Cc: artianu1991@gmail.com, bdm@mysolutions4u.in, info@mysolutions4u.in' . "\r\n";
 $mail = mail($email,$subject,$message,$headers);
 return $mail;
 mail($email,$subject,$message,$headers);
exit;
}
/*end registration email */
function userForgetPasswordMail($firstname, $email, $password){
    
$message = '
<table id="m_3109107740335688119templateContainer" cellspacing="0" cellpadding="10" border="0" style="border: 1px solid rgb(239, 98, 98); font:14px calibri;">
  <tbody>
    <tr>
      <td valign="top" align="center"><table id="m_3109107740335688119templateHeader" width="100%" cellspacing="0" cellpadding="10" border="0">
          <tbody>
            <tr>
              <td class="m_3109107740335688119headerContent" valign="top" bgcolor="#EF6262"><a href="http://www.mysolutions4u.in/Projects/btapp_admin/" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en-GB&amp;q=https://www.temok.com&amp;source=gmail&amp;ust=1487598865132000&amp;usg=AFQjCNGEC-8-6noHfG1AyX-7fnzSR4SejA"> <img src="" alt="Breath Tech" name="m_3109107740335688119headerImage" width="200" border="0" class="CToWUd" id="m_3109107740335688119headerImage" style="max-width:600px;padding:20px"> </a></td>
            </tr>
          </tbody>
        </table></td>
    </tr>
    <tr>
      <td valign="top" align="center"><table id="m_3109107740335688119templateBody" width="100%" cellspacing="0" cellpadding="0" border="0">
          <tbody>
            <tr>
              <td class="m_3109107740335688119bodyContent" valign="top"><p>Dear '.$firstname.',</p>
                <p> BreathTech recently received a request for a forgotten password.<br>                    
                    Please use this password to login: '.$password.'</p>
                </p>
                                             
                <p>Propertyapp Admin</p></td>
            </tr>
          </tbody>
        </table></td>
    </tr>
    <tr>
      <td valign="top" align="center"><table id="m_3109107740335688119templateFooter" width="100%" cellspacing="0" cellpadding="0" border="0">
          <tbody>
            <tr>
    <td colspan="2" align="center" class="style2"><hr /><span class="style3"><a href="">Visit Our Website</a>  | <a href="">Login Your Account</a>  | <a href="mailto:support@propertyapp.com">support@propertyapp.com</a></span><br />
      <span class="style3">Copyright &copy; Propertyapp Tech, All Right Reserved.</span></td>
    </tr>
          </tbody>
        </table></td>
    </tr>
  </tbody>
</table>';
$subject = 'Forgotten password request';
// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: Propertyapp <admin@aartichauhan.com>' . "\r\n";
$headers .= 'Cc: artianu1991@gmail.com' . "\r\n";
//$headers .= 'Cc: artianu1991@gmail.com, bdm@mysolutions4u.in, info@mysolutions4u.in' . "\r\n";

 $mail = mail($email,$subject,$message,$headers);
 return $mail;
// mail($email,$subject,$message,$headers);
//exit;
}   

//end forgot password email//


/////add product enquiry email/////
function userSendProductEnquiryMail($name, $email){
$message = '
<table width="1000" border="0" style="background:url(https://www.mysolutions4u.com/btapp_apis/images/bg.jpg) repeat-x; margin:0 auto; width:1000px; border:1px solid #fff; height:1000px;">
  <tr>
    <td width="80"><span class="style2"></span></td>
    <td width="826" valign="top"><table width="100%" border="0" cellspacing="20">
  <tr>
    <td width="49%" class="style2"><img src="https://www.mysolutions4u.com/btapp_apis/images/logo.jpg" alt="logo" width="234" height="74" longdesc="http://breathmastry.com" /></td>
    <td width="51%" align="right" class="style2"><img src="https://www.mysolutions4u.com/btapp_apis/images/right_logo.jpg" alt="flower" width="89" height="84" /></td>
  </tr>
  <tr>
    <td colspan="2" class="style2" style="background:#fff; border:2px solid #ddd;height:200px; padding:20px;"><p>Dear '.$name.',</p>
    
<p><strong>Thankyou for Enquiry to Property App</strong><p>
<p>This is to inform you that you have successfully inquired on &lt;Product/ Offer Names goes here&gt;
with Product ID/Offer ID</p>
<p>The merchant of the your inquired product / offer will get back to you on the details provided by you while registering to your &lt;Name of the APP&gt; account.</p>
      <p><strong>Email Address:</strong> '.$email.'<br />
        <strong>Password:</strong> '.$password.'<br /> 

        <p style="color:red;font-style: italic;">Please save these credentials for future logins.</p>    
       <p>Thankyou,</p>     
      <p>PropertyApp Team </p></td>
    </tr>
  
  <tr>
    <td colspan="2" align="center" class="style2"><hr /><span class="style3"><a href="">Visit Our Website</a>  | <a href="">Login Your Account</a>  | <a href="mailto:support@propertyapp.com">support@propertyapp.com</a></span><br />
      <span class="style3">Copyright &copy; Propertyapp Tech, All Right Reserved.</span></td>
    </tr>
  
</table></td>
    <td width="80"><span class="style2"></span></td>
  </tr>
</table>';

$subject = 'Thankyou for Product Enquiry to PropertyApp';
// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
// More headers
$headers .= 'From: PropertyApp <admin@aartichauhan.com>' . "\r\n";
//$headers .= 'Cc: artianu1991@gmail.com' . "\r\n";
$headers .= 'Cc: artianu1991@gmail.com, bdm@mysolutions4u.in, info@mysolutions4u.in' . "\r\n";
 $mail = mail($email,$subject,$message,$headers);
 return $mail;
 mail($email,$subject,$message,$headers);
exit;
}
/*end product enquiry*/

/////add product enquiry email/////
function userSendOfferEnquiryMail($name, $email){
$message = '
<table width="1000" border="0" style="background:url(https://www.mysolutions4u.com/btapp_apis/images/bg.jpg) repeat-x; margin:0 auto; width:1000px; border:1px solid #fff; height:1000px;">
  <tr>
    <td width="80"><span class="style2"></span></td>
    <td width="826" valign="top"><table width="100%" border="0" cellspacing="20">
  <tr>
    <td width="49%" class="style2"><img src="https://www.mysolutions4u.com/btapp_apis/images/logo.jpg" alt="logo" width="234" height="74" longdesc="http://breathmastry.com" /></td>
    <td width="51%" align="right" class="style2"><img src="https://www.mysolutions4u.com/btapp_apis/images/right_logo.jpg" alt="flower" width="89" height="84" /></td>
  </tr>
  <tr>
    <td colspan="2" class="style2" style="background:#fff; border:2px solid #ddd;height:200px; padding:20px;"><p>Dear '.$name.',</p>
    
<p><strong>Thankyou for Enquiry to Property App</strong><p>
<p>This is to inform you that you have successfully inquired on &lt;Product/ Offer Names goes here&gt;
with Product ID/Offer ID</p>
<p>The merchant of the your inquired product / offer will get back to you on the details provided by you while registering to your &lt;Name of the APP&gt; account.</p>
      <p><strong>Email Address:</strong> '.$email.'<br />
        <strong>Password:</strong> '.$password.'<br /> 

        <p style="color:red;font-style: italic;">Please save these credentials for future logins.</p>    
       <p>Thankyou,</p>     
      <p>PropertyApp Team </p></td>
    </tr>
  
  <tr>
    <td colspan="2" align="center" class="style2"><hr /><span class="style3"><a href="">Visit Our Website</a>  | <a href="">Login Your Account</a>  | <a href="mailto:support@propertyapp.com">support@propertyapp.com</a></span><br />
      <span class="style3">Copyright &copy; Propertyapp Tech, All Right Reserved.</span></td>
    </tr>
  
</table></td>
    <td width="80"><span class="style2"></span></td>
  </tr>
</table>';

$subject = 'Thankyou for Offer Enquiry to PropertyApp';
// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
// More headers
$headers .= 'From: PropertyApp <admin@aartichauhan.com>' . "\r\n";
//$headers .= 'Cc: artianu1991@gmail.com' . "\r\n";
$headers .= 'Cc: artianu1991@gmail.com, bdm@mysolutions4u.in, info@mysolutions4u.in' . "\r\n";
 $mail = mail($email,$subject,$message,$headers);
 return $mail;
 mail($email,$subject,$message,$headers);
exit;
}
/*end product enquiry*/