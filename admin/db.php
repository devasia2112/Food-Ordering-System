<?php
$mysql_hostname = "localhost";
$mysql_user 	= "root";
$mysql_password = "xeStnkb4j2dd";
$mysql_database = "kinthai_delivery";
$prefix 		= "";

$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("ERROR: DB CONEXION");
mysql_select_db($mysql_database, $bd) or die("ERROR: DB SELECT");
?>
