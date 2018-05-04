<?php
session_start();
define('BASE_URLD','http://innoappstech.com/event_program/');
function insert($table_name, $attr) //Insert Function
		{
				$keyField = '';
				$valField = "";
				foreach ($attr as $key => $value) {
					$keyField.= $key.', ';
					$valField.= "'".$value."', ";
				}
				$keyField = rtrim($keyField,', ');
				$sql = mysql_query("INSERT INTO $table_name (".rtrim($keyField,', ').") VALUES(".rtrim($valField,', ').")");
				$lastId = mysql_insert_id();
				return $lastId;
			}
/*user login*/
function getPubAdminLogin($pub_email, $password){
	
	$sql_log = mysql_query("SELECT * FROM `tbl_pub_records` WHERE `pub_email` = '".$pub_email."' AND `password` = '".md5($password)."'") or die(mysql_error());
	$num_log = mysql_num_rows($sql_log);
	$details = array();
		if($num_log > 0){
			$row_log = mysql_fetch_object($sql_log);
			$details = $row_log;
		}
		 else{
		     if($pub_email == ''){ 
					  $_SESSION['err_msg']='Email Should Not Be Blank';
				  }
				  else if($password == '' ){
					   $_SESSION['err_msg']='Password Should Not Be Blank';
					  }
				  else{
				 $_SESSION['err_msg']='Enter Correct Email And Password';
				  }
			}
		return $details;
	}

function getAllData($table, $sort, $val){
	if($table!=''){
	if($val==''){ $val = 'DESC';}
		$sql_cat = mysql_query("SELECT * FROM `".$table."` Order by $sort $val");
		$num_cat = mysql_num_rows($sql_cat);
		$details = array();
			if($num_cat > 0){
				while($row_cat = mysql_fetch_object($sql_cat)){
					$details[] = $row_cat;
				}
			}
		return $details;
	}else{ return array(); }
}

function getSingleData($tblname,$key,$value){
	if($tblname!='' && $key !='' && $value!=''){
		$sql_cat = mysql_query("SELECT * FROM `".$tblname."` WHERE `".$key."` = '".$value."'");
		$num_cat = mysql_num_rows($sql_cat);
		$details = array();
			if($num_cat > 0){
				while($row_cat = mysql_fetch_object($sql_cat)){
					$details = $row_cat;
				}
			}
		return $details;
	}else{ return array(); }

}

/*find total count of pub*/
function totalCount($tablename,$cond){
	/*echo "SELECT * FROM `".$tablename."` WHERE 1=1 AND $cond";
	exit();*/
	$sql = mysql_query("SELECT * FROM `".$tablename."` WHERE 1=1 AND $cond");
	$num = mysql_num_rows($sql);
	return $num;
}
function totalUserAccectDealCount(){
    $num=0;
	$sql = mysql_query("SELECT * FROM `tbl_user_deal` WHERE`pub_id`='".$_SESSION['pub_user_login']."' AND `redeem`=1");
	$num = mysql_num_rows($sql);
	return $num;
}
function percentageUserDealCount(){
   $totalCount = totalCount('tbl_user_deal','pub_id='.$_SESSION['pub_user_login']); 
   $totaldealaccet=totalUserAccectDealCount();
  /* $percent= ($totaldealaccet / 100) * $totalCount;
   return $percent;*/
		$percent = $totaldealaccet/$totalCount;
		return $percent_friendly = number_format( $percent * 100) . '%';
}
/*$new_width = ($percentage / 100) * $totalWidth;*/

/*echo '<pre>';
print_r($dat);
exit();*/

function addOffer($post){
  extract($post);
  $sql_log = mysql_query("SELECT * FROM `tbl_offer` WHERE  `offer_title` ='".$name."'") or die(mysql_error());
  $num_log = mysql_num_rows($sql_log);
  $data='';
  if($num_log > 0){
	  $data = 'err';
	  }
 else{
	  $file_data = $_FILES['offer_image']['name'];
	  $file_loc = $_FILES['offer_image']['tmp_name'];
	  $File_Ext = substr($file_data,strrpos($file_data,'.')); 
	  $folder="offer_images/";
	  $final_file_name = random_string(3,substr($offer_title0,3));
	  move_uploaded_file($file_loc,$folder.$final_file_name.$File_Ext);	
	  $sql_array = array('offer_title' => $offer_title,'offfer_desc' => $description,'offer_image' => $offer_image,'status' => $status,'pub_id'=>$_SESSION['pub_user_login'],'added_date' => date("Y-m-d"),'offer_from_date'=>date('Y-m-d', strtotime($from_date)),'offer_to_date'=>date('Y-m-d', strtotime($to_date))); 
	  $lastId = insert('tbl_offer',$sql_array);
	  if($lastId){
		  $data = $lastId;
		  }else{
			  $data= 0;
			  }
  }
  return $data;
 }	
function addEvent($post){
  extract($post);
  $sql_log = mysql_query("SELECT * FROM `tbl_event_records` WHERE  `event_name` ='".$event_title."'") or die(mysql_error());
  $num_log = mysql_num_rows($sql_log);
  $data='';
  if($num_log > 0){
	  $data = 'err';
	  }
 else{
      	$dtr = explode("-",$daterange);
		$from =   date("Y/m/d H:i:sa",strtotime($dtr[0]));
		$to   = date("Y/m/d H:i:sa",strtotime($dtr[1]));
	  $sql_array = array('event_name' => $event_title,'event_description' => $description,'start_date' =>$from,'end_date'=>$to,'status' => $status,'pub_id'=>$_SESSION['pub_user_login'],'added_date' => date("Y-m-d h:i:sa")); 
	  $lastId = insert('tbl_event_records',$sql_array);
	  if($lastId){
		  $data = $lastId;
		  }else{
			  $data= 0;
			  }
  }
  return $data;
 }	

function getOfferAllData()
{
	$sql = mysql_query("SELECT * FROM `tbl_offer` WHERE `status`=1"); 
	$num_cat = mysql_num_rows($sql);
	 $details = array();
	  if($num_cat > 0){
	   while($row_cat = mysql_fetch_object($sql)){
		$details[] = $row_cat;
		 }
		}
 return $details;
   
}
function getEventList()
{
	$sql = mysql_query("SELECT * FROM `tbl_event_records` WHERE `status`=1"); 
	$num_cat = mysql_num_rows($sql);
	 $details = array();
	  if($num_cat > 0){
	   while($row_cat = mysql_fetch_object($sql)){
		$details[] = $row_cat;
		 }
		}
 return $details;
   
}
function getEventDetails($event_id)
{
	$sql_cat = mysql_query("SELECT * FROM `tbl_event_records` WHERE `event_id`='".$event_id."'");
	$num_cat = mysql_num_rows($sql_cat);
	$details = array();
	if($num_cat > 0){
	$row_cat = mysql_fetch_object($sql_cat);
	$details = $row_cat;
	}
  return $details;
	
}
function getOfferDetails($offer_id)
{
	$sql_cat = mysql_query("SELECT * FROM `tbl_offer` WHERE `offer_id`='".$offer_id."'");
	$num_cat = mysql_num_rows($sql_cat);
	$details = array();
	if($num_cat > 0){
	$row_cat = mysql_fetch_object($sql_cat);
	$details = $row_cat;
	}
  return $details;
	
}
function updateOffer($post){
	extract($post);
	$sql = mysql_query(" UPDATE `tbl_offer` SET `offer_title`='".$offer_title."',`offer_image` = '".$offer_image."', `offfer_desc`='".$description."',`offer_barcode`='".$offer_barcode."',`status`='".$status."',`updated_date`='".date("Y-m-d")."' WHERE `offer_id`='".$offer_id."'");
	if($sql){
	$data = 1;
	}else{
	$data= 0;
	}
	return $data;
}	

function add_user_deal_data($post){
extract($post);
 if($user_type ==1){
     $table_name = 'tbl_user_checkins';
 }else if($user_type ==2){
    $table_name = 'tbl_user_views';
 }else if($user_type ==3){
   $table_name = 'tbl_user_shares';
 }else if($user_type ==4){
   $table_name = 'tbl_user_favorites';
 }
$sql = mysql_query("SELECT * FROM $table_name WHERE `pub_id`='".$_SESSION['pub_user_login']."'"); 
	$num_cat = mysql_num_rows($sql);
	 $details = array();
	  if($num_cat > 0){
	   while($row_cat = mysql_fetch_object($sql)){
	       $sql_array = array('user_id' => $row_cat->user_id ,'offer_id' =>$offer_type,'status' => 1,'added_date' => date("Y-m-d"),'pub_id'=>$_SESSION['pub_user_login']);
	  $lastId = insert('tbl_user_deal',$sql_array);
	  if($lastId){
		  $data = $lastId;
		  }else{
			  $data= 0;
			  }
		 }
		}
    return $data;
}
function random_string($length,$name) //Random Generation Number Function
 {
	$key = '';
	$keys = array_merge(range(0, 9), range('a', 'z'));
	
	for ($i = 0; $i < $length; $i++)
	 {
		$key .= $keys[array_rand($keys)];
	 }

return ($name.$key);
}











function addPub($post){
extract($post);
$sql = mysql_query("INSERT INTO `tbl_pub_records`(`pub_thunmb`, `pub_name`, `pub_email`, `password`, `pub_phone`, `pub_mobile`, `pub_address`, `pub_city`, `pub_state`, `pub_country`, `pub_pincode`, `status`, `added_date`, `ip_address`) VALUES ('','".$pub_name."','".$pub_email."','".md5($password)."','".$pub_phone."','".$pub_mobile."','".$pub_address."','','','','','".$status."','".date("Y-m-d H:i:s")."','".$ip_address."')");
if($sql){
	$data = 1;
}else{
	$data = 0;
}
return $data;
}
function updatePub($post){
extract($post);
//echo "UPDATE `tbl_pub_records` SET `pub_thunmb` ='', `pub_name` = '".$pub_name."', `pub_email` = '".$pub_email."', `pub_phone` = '".$pub_phone."', `pub_mobile` = '".$pub_mobile."', `pub_address` = '".$pub_address."' `status` = '".$status."', `updated_date`= '".date("Y-m-d H:i:s")."' WHERE `pub_id` = '".$pub_id."'";
//exit();
$sql = mysql_query("UPDATE `tbl_pub_records` SET `pub_thunmb` ='', `pub_name` = '".$pub_name."', `pub_email` = '".$pub_email."', `pub_phone` = '".$pub_phone."', `pub_mobile` = '".$pub_mobile."', `pub_address` = '".$pub_address."', `status` = '".$status."', `update_date`= '".date("Y-m-d H:i:s")."' WHERE `pub_id` = '".$pub_id."'");
if($sql){
	$data = 1;
}else{
	$data = 0;
}
return $data;
}








//All page conetnt
function timeDiff($firstTime,$lastTime) {
    $datetime1 = new DateTime($firstTime);
	$datetime2 = new DateTime($lastTime);
	$interval = $datetime1->diff($datetime2);
	return $interval->format('%H').":".$interval->format('%I').":".$interval->format('%S');
}
function explode_time($time) { //explode time and convert into seconds
        $time = explode(':', $time);
        $time = $time[0] * 3600 + $time[1] * 60;
        return $time;
}

function second_to_hhmm($time) { //convert seconds to hh:mm
        $hour = floor($time / 3600);
        $minute = strval(floor(($time % 3600) / 60));
        if ($minute == 0) {
            $minute = "00";
        } else {
            $minute = $minute;
        }
        $time = $hour . ":" . $minute;
        return $time;
}
function addTwoTimes($time1 = "00:00:00", $time2 = "00:00:00"){
        /*$time2_arr = [];
        $time1 = $time1;
        $time2_arr = explode(":", $time2);
        //Hour
        if(isset($time2_arr[0]) && $time2_arr[0] != ""){
            $time1 = $time1." +".$time2_arr[0]." hours";
            $time1 = date("H:i:s", strtotime($time1));
        }
        //Minutes
        if(isset($time2_arr[1]) && $time2_arr[1] != ""){
            $time1 = $time1." +".$time2_arr[1]." minutes";
            $time1 = date("H:i:s", strtotime($time1));
        }
        //Seconds
        if(isset($time2_arr[2]) && $time2_arr[2] != ""){
            $time1 = $time1." +".$time2_arr[2]." seconds";
            $time1 = date("H:i:s", strtotime($time1));
        }

        return date("H:i:s", strtotime($time1));*/
		
		$time = 0;
		$time_arr =  array($time1,$time2);
		foreach ($time_arr as $time_val) {
		$time +=explode_time($time_val); // this fucntion will convert all hh:mm to seconds
		}
		return second_to_hhmm($time);
    }
/*function getAllData($table, $sort){
	if($table!=''){
		$sql_cat = mysql_query("SELECT * FROM `".$table."` Order by $sort DESC");
		$num_cat = mysql_num_rows($sql_cat);
		$details = array();
			if($num_cat > 0){
				while($row_cat = mysql_fetch_object($sql_cat)){
					$details[] = $row_cat;
				}
			}
		return $details;
	}else{ return array(); }
}*/
function getAllDataByDate($table, $date, $sort){
	if($table!=''){
	//echo "SELECT * FROM `".$table."` WHERE `Date` = '".date('d-m-Y',strtotime($date))."' Order by $sort DESC";
		$sql_cat = mysql_query("SELECT * FROM `".$table."` WHERE `Date` = '".date('d-m-Y',strtotime($date))."' Order by $sort DESC");
		$num_cat = mysql_num_rows($sql_cat);
		$details = array();
			if($num_cat > 0){
				while($row_cat = mysql_fetch_object($sql_cat)){
					$details[] = $row_cat;
				}
			}
		return $details;
	}else{ return array(); }
}
function getAllDataByDateTotal($table, $date, $sort,$ctrl){
	if($table!=''){
	//echo "SELECT ".$ctrl." FROM `".$table."` WHERE `Date` = '".date('d-m-Y',strtotime($date))."' Order by $sort DESC";
		$sql_cat = mysql_query("SELECT ".$ctrl." FROM `".$table."` WHERE `Date` = '".date('d-m-Y',strtotime($date))."' Order by $sort DESC");
		$num_cat = mysql_num_rows($sql_cat);
		$details = array();
			if($num_cat > 0){
				while($row_cat = mysql_fetch_object($sql_cat)){
					$details[] = $row_cat;
				}
			}
		return $details;
	}else{ return array(); }
}

/*function getSingleData($tblname,$key,$value){
	if($tblname!='' && $key !='' && $value!=''){
		$sql_cat = mysql_query("SELECT * FROM `".$tblname."` WHERE `".$key."` = '".$value."'");
		$num_cat = mysql_num_rows($sql_cat);
		$details = array();
			if($num_cat > 0){
				while($row_cat = mysql_fetch_object($sql_cat)){
					$details = $row_cat;
				}
			}
		return $details;
	}else{ return array(); }

}
function addPub($post){
extract($post);
$sql = mysql_query("INSERT INTO `tbl_pub_records`(`pub_thunmb`, `pub_name`, `pub_email`, `password`, `pub_phone`, `pub_mobile`, `pub_address`, `pub_city`, `pub_state`, `pub_country`, `pub_pincode`, `status`, `added_date`, `ip_address`) VALUES ('','".$pub_name."','".$pub_email."','".$password."','".$pub_phone."','".$pub_mobile."','".$pub_address."','','','','','".$status."','".date("Y-m-d H:i:s")."','".$ip_address."')");
if($sql){
	$data = 1;
}else{
	$data = 0;
}
return $data;
}
function updatePub($post){
extract($post);
//echo "UPDATE `tbl_pub_records` SET `pub_thunmb` ='', `pub_name` = '".$pub_name."', `pub_email` = '".$pub_email."', `pub_phone` = '".$pub_phone."', `pub_mobile` = '".$pub_mobile."', `pub_address` = '".$pub_address."' `status` = '".$status."', `updated_date`= '".date("Y-m-d H:i:s")."' WHERE `pub_id` = '".$pub_id."'";
//exit();
$sql = mysql_query("UPDATE `tbl_pub_records` SET `pub_thunmb` ='', `pub_name` = '".$pub_name."', `pub_email` = '".$pub_email."', `pub_phone` = '".$pub_phone."', `pub_mobile` = '".$pub_mobile."', `pub_address` = '".$pub_address."', `status` = '".$status."', `update_date`= '".date("Y-m-d H:i:s")."' WHERE `pub_id` = '".$pub_id."'");
if($sql){
	$data = 1;
}else{
	$data = 0;
}
return $data;
}*/
function updateEntries($tbl_name,$post,$unique_id,$btn){
	$clouse = '';
	foreach($post as $key => $value){
		if($key!=$unique_id && $key!=$btn){
			$clouse.= $key." = '".$value."', ";
		}
	}
	/*echo "UPDATE `".$tbl_name."` SET ".rtrim($clouse,', ')." WHERE `$unique_id`='".$post[$unique_id]."'";
	exit();*/
	$sql = mysql_query("UPDATE `".$tbl_name."` SET ".rtrim($clouse,', ')." WHERE `$unique_id`='".$post[$unique_id]."'");
	if($sql){
		$data = 1;
	}else{
		$data= 0;
	}
	return $data;
}
function getListData($text){
	$data = file_get_contents("data.txt");
	$dta = json_decode($data);
	return $dta->$text;
}	

function getAdminLogin($userid, $password){
	
	$sql_log = mysql_query("SELECT * FROM `tbl_admin` WHERE `username` = '".$userid."' AND `password` = '".md5($password)."'") or die(mysql_error());
	$num_log = mysql_num_rows($sql_log);
	$details = array();
		if($num_log > 0){
			$row_log = mysql_fetch_object($sql_log);
			$details = $row_log;
		}
		return $details;
	}
function gerAdminUserDetails($userid){
	
	$sql_log = mysql_query("SELECT * FROM `tbl_admin` WHERE `id` = '".$userid."'") or die(mysql_error());
	$num_log = mysql_num_rows($sql_log);
	$details = array();
		if($num_log > 0){
			$row_log = mysql_fetch_object($sql_log);
			$details = $row_log;
		}
		return $details;
	}	

/*Code by prakash*/

/*function getCompairedData($post){
  //extract($post);
	
		$dtr = explode("-",$post['rangedate']);
		$from = date("Y-m-d",strtotime($dtr[0]));
		$to   = date("Y-m-d",strtotime($dtr[1]));
		echo "SELECT * FROM tbl_pub_gallery WHERE added_date BETWEEN '" . $from . "' AND  '" . $to . "' AND pub_id = '".$_SESSION['pub_user_login']."' GROUP by user_id";
		exit();

		$sql_qry = mysql_query("SELECT * FROM tbl_pub_gallery WHERE added_date BETWEEN '" . $from . "' AND  '" . $to . "' AND pub_id = '".$_SESSION['pub_user_login']."' GROUP by user_id");
     $num_ro = mysql_num_rows($sql_qry);
 
		return $num_ro;
	
}*/

function getCompairedData($post){
	$dtr = explode("-",$post['rangedate']);
	$from = date("Y-m-d",strtotime($dtr[0]));
	$to = date("Y-m-d",strtotime($dtr[1]));
	$table="tbl_user_views";
	$table1="tbl_user_checkins";
	$table2="tbl_pub_gallery";
	$table3="tbl_user_favorites";
	while (strtotime($from) <= strtotime($to)) 
		{
			$cond ="pub_id = '".$_SESSION['pub_user_login']."' AND `added_date` LIKE '".date("Y-m-d",strtotime($from))."%'";
			$total_count[$from]=array("Date"=>$from,"Total_view_count"=>totalCount($table,$cond),"Total_visit_count"=>totalCount($table1,$cond),"Total_galary_upload"=>totalCount($table2,$cond),"Total_fev_count"=>totalCount($table,$cond)); 
		$from = date ("Y-m-d", strtotime("+1 day", strtotime($from)));
	}
		return $total_count;
	}


function getBetweenData($post){
	$dtr = explode("-",$post['rangedate']);
	$from = date("Y-m-d",strtotime($dtr[0]));
	$to = date("Y-m-d",strtotime($dtr[1]));
	$table="tbl_user_views";
	$table1="tbl_user_checkins";
	$table2="tbl_pub_gallery";
	$table3="tbl_user_favorites";
	while (strtotime($from) <= strtotime($to)) 
		{
			$cond ="pub_id = '".$_SESSION['pub_user_login']."' AND added_date = '" . $from . "'";
			$total_count[$from]=array("Date"=>$from,"Total_view_count"=>totalCount($table,$cond)); 
		$from = date ("Y-m-d", strtotime("+1 day", strtotime($from)));
	}
		return $total_count;
	}


function getCompairedBetween($post){
	$dtr = explode("-",$post['rangedate']);
	$from = date("Y-m-d",strtotime($dtr[0]));
	$to = date("Y-m-d",strtotime($dtr[1]));
	
	$sql_views_from = mysql_query("SELECT * FROM `tbl_user_views` WHERE added_date LIKE '" . $from . "%' AND pub_id = '".$_SESSION['pub_user_login']."'") or die(mysql_error());
	$num_views_from = mysql_num_rows($sql_views_from);

	$sql_views_to = mysql_query("SELECT * FROM `tbl_user_views` WHERE added_date LIKE '" . $to . "%' AND pub_id = '".$_SESSION['pub_user_login']."'") or die(mysql_error());
	$num_views_to = mysql_num_rows($sql_views_to);

	$sql_visit_from = mysql_query("SELECT * FROM `tbl_user_checkins` WHERE added_date LIKE '" . $from . "%' AND pub_id = '".$_SESSION['pub_user_login']."'") or die(mysql_error());
	$num_visit_from = mysql_num_rows($sql_visit_from);

	$sql_visit_to = mysql_query("SELECT * FROM `tbl_user_checkins` WHERE added_date LIKE '" . $to . "%' AND pub_id = '".$_SESSION['pub_user_login']."'") or die(mysql_error());
	$num_visit_to = mysql_num_rows($sql_visit_to);

	$sql_upload_from = mysql_query("SELECT * FROM `tbl_pub_gallery` WHERE added_date LIKE '" . $from . "%' AND pub_id = '".$_SESSION['pub_user_login']."'") or die(mysql_error());
	$num_upload_from = mysql_num_rows($sql_upload_from);

	$sql_upload_to = mysql_query("SELECT * FROM `tbl_pub_gallery` WHERE added_date LIKE '" . $to . "%' AND pub_id = '".$_SESSION['pub_user_login']."'") or die(mysql_error());
	$num_upload_to = mysql_num_rows($sql_upload_to);


	$sql_fev_from = mysql_query("SELECT * FROM `tbl_user_favorites` WHERE added_date = '" . $from . "' AND pub_id = '".$_SESSION['pub_user_login']."'") or die(mysql_error());
	$num_fev_from = mysql_num_rows($sql_fev_from);

	$sql_fev_to = mysql_query("SELECT * FROM `tbl_user_favorites` WHERE added_date = '" . $to . "' AND pub_id = '".$_SESSION['pub_user_login']."'") or die(mysql_error());
	$num_fev_to = mysql_num_rows($sql_fev_to);

	$details[] = array("from"=>$from,"total_views_from"=>$num_views_from,"to"=>$to,"total_views_to"=>$num_views_to,"total_visit_from"=>$num_visit_from,"total_visit_to"=>$num_visit_to,"total_upload_from"=>$num_upload_from,"total_upload_to"=>$num_upload_to,"total_fev_from"=>$num_fev_from,"total_fev_to"=>$num_fev_to);
	
	

		return $details;

}


function getCustomDayDate($pub_id){
$sql = mysql_query("SELECT `dashboard_time_interval` FROM `tbl_pub_records` WHERE `pub_id` = '".$pub_id."'");	
$day = 0;
if(mysql_num_rows($sql) > 0){
	$row = mysql_fetch_object($sql);
	$day = '-'.$row->dashboard_time_interval;
}
$date = date('Y-m-d', strtotime($day." days"));
return $date;
}

function getTotalNoOfUser(){
	$sql = mysql_query("SELECT * FROM `tbl_users_records`");
	$num_rows = mysql_num_rows($sql);
	return $num_rows;
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

/*Code End by prakash*/
?>