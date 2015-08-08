<?php
$mysql_hostname  = "localhost";
$mysql_user 	   = "delivery";
$mysql_password  = "delivery";
$mysql_database  = "delivery";
$prefix 		     = "";

$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("ERROR: DB CONNECTION");
mysql_select_db($mysql_database, $bd) or die("ERROR: DB SELECT");
?>
