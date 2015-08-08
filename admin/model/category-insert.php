<?php
require('../../includes/config/config.php');
require('../../includes/Sql/sql.class.php');

if (isset($_POST['submitted'])) 
{
    foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); }
    $sql = "INSERT INTO `categories` ( `name` ,  `short` ,  `description` ,  `color`,  `font_color` ) VALUES(  '{$_POST['name']}' ,  '{$_POST['short']}' ,  '{$_POST['desc']}' ,  '{$_POST['color']}', '{$_POST['font-color']}' )";
    mysql_query($sql) or die(mysql_error());
    echo "<SCRIPT LANGUAGE=\"JavaScript\" TYPE=\"text/javascript\"> alert(\"Dados da categoria gravados com sucesso!\") </script>";

	GenericSql::Redirect( $sec=0, $file="../view/category-select.php" );
}
else 
{
	echo "No direct access";
}
?>
