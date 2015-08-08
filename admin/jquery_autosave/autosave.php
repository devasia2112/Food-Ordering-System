<?php
//include DB configuration file
include('db_config.php');

//Connect to database
$link = mysql_connect($db_host, $db_user, $db_password);
mysql_select_db($db_table);
mysql_set_charset('utf8',$link); 

$title   = mysql_real_escape_string($_POST['title']);
$content = mysql_real_escape_string($_POST['content']);
$id      = (int)$_POST['article_id'];

try {
	//save contents to database
	mysql_query("UPDATE `articles` SET title = '$title', content = '$content' WHERE id = '$id'");

	//get timestamp
	$result = mysql_query("SELECT timestamp FROM `articles` WHERE id = $id");
	$timestamp = mysql_result($result, 0);
}
catch (Exception $e)
{
	echo 'INSERT: Banco Vazio: ',  $e->getMessage(), "\n";
	// If empty insert
	//create new article on database
	mysql_query("INSERT INTO `articles`(title, content) VALUES('', '')");
	$article_id = mysql_insert_id();
}


//output timestamp
echo 'Last Saved: ', $timestamp;
?>