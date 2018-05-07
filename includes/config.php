<?php
error_reporting(0);
session_start();
/*$conn = mysql_connect("localhost","indiain4_pubapp","Pubapp!234") or die(mysql_error());
$dbconn = mysql_select_db("indiain4_pubapp",$conn) or die(mysql_error());*/

$conn = mysql_connect("localhost","root","") or die(mysql_error());
$dbconn = mysql_select_db("real_estate_db",$conn) or die(mysql_error());

?>