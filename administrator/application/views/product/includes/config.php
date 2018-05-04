<?php 
$config['site_name'] = 'Event program';
$config['site_logo'] = 'assets/images/logo_light.png';
$con = mysql_connect("localhost","nimawat","Pass!234");
mysql_select_db("event_program_db",$con);

date_default_timezone_set('Asia/Manila');
//date_default_timezone_set('Asia/Calcutta'); 
//echo date("Y-m-d H:i:s"); // time in India
?>