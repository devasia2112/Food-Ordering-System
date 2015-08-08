<?php
//include DB configuration file
include('db_config.php');

//Connect to database
mysql_connect($db_host, $db_user, $db_password);
mysql_select_db($db_table);


$title = mysql_real_escape_string($_POST['title']);
$content = mysql_real_escape_string($_POST['content']);
$id = (int)$_POST['article_id'];

//save contents to database
mysql_query("UPDATE `articles` SET title = '$title', content = '$content' WHERE id = '$id'");

//get timestamp
$result = mysql_query("SELECT timestamp FROM `articles` WHERE id = $id");
$timestamp = mysql_result($result, 0);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title><?php echo $title ?></title>
	<style type="text/css">
			body{font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px}
			h1, h2{font-size:20px;}
	</style>
</head>

<body>
	<p>Article has been succesfully saved</p>
	<h2><?php echo $title ?></h2>
	<p><?php echo $content ?></p>
	<p>Last Saved: <?php echo $timestamp ?></p>
</body>
</html>