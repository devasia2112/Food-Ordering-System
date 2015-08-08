<?php
require('../../includes/config/config.php');
require('../../includes/Sql/sql.class.php');

$idproduct = (int) $_GET['id']; 

try
{
    mysql_query("DELETE FROM `products` WHERE `id` = '$idproduct'");
    echo (mysql_affected_rows()) ? "<SCRIPT LANGUAGE=\"JavaScript\" TYPE=\"text/javascript\"> alert(\"Dados do produto removidos com sucesso!\") </script>" 
				: "<SCRIPT LANGUAGE=\"JavaScript\" TYPE=\"text/javascript\"> alert(\"Falha em remover os dados do produto!\") </script>";

    mysql_query("DELETE FROM `products_atributes` WHERE `product_id` = '$idproduct'");
    echo (mysql_affected_rows()) ? "<SCRIPT LANGUAGE=\"JavaScript\" TYPE=\"text/javascript\"> alert(\"Dados dos atributos do produto removidos com sucesso!\") </script>" 
				: "<SCRIPT LANGUAGE=\"JavaScript\" TYPE=\"text/javascript\"> alert(\"Falha em remover os dados dos atributos do produto!\") </script>";

    mysql_query("DELETE FROM `products_description` WHERE `products_id` = '$idproduct'");
    echo (mysql_affected_rows()) ? "<SCRIPT LANGUAGE=\"JavaScript\" TYPE=\"text/javascript\"> alert(\"Dados da descrição do produto foram removidos com sucesso!\") </script>" 
				: "<SCRIPT LANGUAGE=\"JavaScript\" TYPE=\"text/javascript\"> alert(\"Falha em remover os dados da descrição do produto!\") </script>";
}
catch (Exception $e)
{
      echo 'ERRO UPDATE PRODUTOS: ',  $e->getMessage(), "\n";
}

GenericSql::Redirect( $sec=0, $file="../view/products-select.php" );
?>
