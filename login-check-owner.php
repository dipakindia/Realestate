<?php 
 if($_SESSION['isLogin'] != 1){ 
    header("Location: login.php");
 }else{
	//echo "SELECT * FROM `tbl_user_records` WHERE `id` = '".$_SESSION['user_id']."' AND `is_merchant` = '1'"; die;
 	$s = mysql_query("SELECT * FROM `tbl_user_records` WHERE `id` = '".$_SESSION['user_id']."' AND `is_merchant` = '1'");
	if(mysql_num_rows($s) > 0){
		$r = mysql_fetch_object($s);
		if($r->email_verified != 1){
			session_destroy();
			header("Location: login.php");
		}
	}else{
	   session_destroy();
	   header("Location: login.php");
	}
 }