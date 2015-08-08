<?php
require('../../includes/config/config.php');
require('../../includes/Sql/sql.class.php');

if (isset($_POST['id']))
{
    $id = (int) $_POST['id'];
    if (isset($_POST['submitted'])) 
    {
        foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); }
        $sql = "UPDATE `orders` SET `order_status_id` = '{$_POST['status']}', `date_last_modified`='" . date('Y-m-d H:i:s') . "' WHERE `order_id` = '{$id}'";
        mysql_query($sql) or die(mysql_error()); 
        echo (mysql_affected_rows()) ? "<SCRIPT LANGUAGE=\"JavaScript\" TYPE=\"text/javascript\"> alert(\"O Pedido {$id} foi atualizado com sucesso!\") </script>" 
                                     : "<SCRIPT LANGUAGE=\"JavaScript\" TYPE=\"text/javascript\"> alert(\"Falha na tentativa de atualizar o pedido {$id}!\") </script>";
        GenericSql::Redirect( $sec=0, $file="../view/orders-select.php" );
    }
}
else 
{
    die('No direct script access.');
}
?>
