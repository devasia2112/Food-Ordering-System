<?php
require('../../includes/config/config.php');
require('../../includes/Sql/sql.class.php');

if (isset($_POST['submitted'])) 
{
    foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); }
    $sql = "INSERT INTO `gateways` ( `name` ,  `currency_code` ,  `business_id` ,  `return_url`,  `notify_url` ) VALUES(  '{$_POST['name']}' ,  '{$_POST['currency_code']}' ,  '{$_POST['email']}' ,  '{$_POST['return_url']}', '{$_POST['notify_url']}' )";
    mysql_query($sql) or die(mysql_error());
    echo "<SCRIPT LANGUAGE=\"JavaScript\" TYPE=\"text/javascript\"> alert(\"Dados da conta PayPal gravados com sucesso!\") </script>";

	GenericSql::Redirect( $sec=0, $file="../view/paypal-config-select.php" );
}
else 
{
	echo "No direct access";
}
?>
