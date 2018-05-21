<?php 
include('includes/config.php');
//echo md5("dipak.nimawat@gmail.com");die;
if(isset($_GET['user-email'])){
//echo "SELECT * FROM `tbl_user_records` WHERE `email_id` = '".$_GET['user-email']."'"; die;
 	$s = mysql_query("SELECT * FROM `tbl_user_records` WHERE md5(email_id) = '".$_GET['user-email']."'");
	if(mysql_num_rows($s) > 0){
		$r = mysql_fetch_object($s);
		if($r->email_verified == 1){
			header("Location: already-verified.php");
		}else{
		$str = '';
			if($r->is_merchant == 0){
			$str = ", status = '1'";
			}
			//echo "UPDATE `tbl_user_records` SET `email_verified` = 1 $str WHERE `id` = '".$r->id."'"; die;
			$sqlUpdate = mysql_query("UPDATE `tbl_user_records` SET `email_verified` = 1 $str WHERE `id` = '".$r->id."'");
			header("Location: success-verified.php");
		}
	}else{
	   header("Location: login.php");
	}
 }