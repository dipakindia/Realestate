<?php if(!isset($_SESSION['isLogin'])){ 
    header("Location: login.php");
 }else{
 	$s = mysql_query("SELECT * FROM `tbl_user_records` WHERE `id` = '".$_SESSION['user_id']."' AND `is_merchent` = '1'");
	if(mysql_query($s) > 0){
		$r = mysql_fetch_object($s);
		if($r->email_verified != 1){
			header("Location: login.php");
		}
	}else{
	   header("Location: login.php");
	}
 }