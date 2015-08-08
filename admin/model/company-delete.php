<?php
require('../../includes/config/config.php');
require('../../includes/Sql/sql.class.php');

$id = (int) $_GET['id'];
mysql_query("DELETE FROM `empresa` WHERE `id` = '$id' ") ; 
echo (mysql_affected_rows()) ? "<SCRIPT LANGUAGE=\"JavaScript\" TYPE=\"text/javascript\"> alert(\"Dados da empresa removidos com sucesso!\") </script>" 
                             : "<SCRIPT LANGUAGE=\"JavaScript\" TYPE=\"text/javascript\"> alert(\"Houve falha na tentativa de remover os dados da empresa!\") </script>";

GenericSql::Redirect( $sec=0, $file="../view/company-select.php" );
?>
