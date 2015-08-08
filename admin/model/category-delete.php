<?php
require('../../includes/config/config.php');
require('../../includes/Sql/sql.class.php');

$id = (int) $_GET['id']; 
mysql_query("DELETE FROM `categories` WHERE `id` = '$id' ") ; 
echo (mysql_affected_rows()) ? "<SCRIPT LANGUAGE=\"JavaScript\" TYPE=\"text/javascript\"> alert(\"A categoria foi removida com sucesso!\") </script>" 
                             : "<SCRIPT LANGUAGE=\"JavaScript\" TYPE=\"text/javascript\"> alert(\"Houve falha na tentativa de remover a categoria de produtos!\") </script>";

GenericSql::Redirect( $sec=0, $file="../view/category-select.php" );
?>
