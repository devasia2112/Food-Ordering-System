<?php
require('../../includes/config/config.php');
require('../../includes/Sql/sql.class.php');

if (isset($_POST['id']))
{
    $id = (int) $_POST['id'];
    if (isset($_POST['submitted'])) 
    {
        foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); }
        $sql = "UPDATE `gateways` SET  `name` =  '{$_POST['name']}' ,  `currency_code` =  '{$_POST['currency_code']}' ,  `business_id` =  '{$_POST['business_id']}' ,  `return_url` =  '{$_POST['return_url']}', `notify_url` =  '{$_POST['notify_url']}' , `useit` =  '{$_POST['useit']}' WHERE `id` = '$id' ";
        mysql_query($sql) or die(mysql_error()); 
        echo (mysql_affected_rows()) ? "<SCRIPT LANGUAGE=\"JavaScript\" TYPE=\"text/javascript\"> alert(\"Dados da conta paypal alterados com sucesso!\") </script>" 
                                     : "<SCRIPT LANGUAGE=\"JavaScript\" TYPE=\"text/javascript\"> alert(\"Falha na tentativa de alterar os dados da conta paypal!\") </script>";
        GenericSql::Redirect( $sec=0, $file="../view/paypal-config-select.php" );
    }
}
else 
{
    die('No direct script access.');
}
?>
