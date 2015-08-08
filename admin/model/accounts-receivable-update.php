<?php
require('../../includes/config/config.php');
require('../../includes/Sql/sql.class.php');
session_start();

if (isset($_POST['id']))
{
    $id = (int) $_POST['id'];
    if (isset($_POST['submitted'])) 
    {
        foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); }
        $sql = "UPDATE `invoices_receivable` SET `status` = '{$_POST['status']}', `paid_date`='" . date('Y-m-d') . "', `update_by`='{$_SESSION["admin_id"]}', `company`='{$_POST['company_id']}', `NF`='{$_POST['nota_fiscal']}', `note`='{$_POST['notas']}' WHERE `id` = '{$id}'";

        try 
		{
			mysql_query($sql);
	    	echo (mysql_affected_rows()) ? "<SCRIPT LANGUAGE=\"JavaScript\" TYPE=\"text/javascript\"> alert(\"A fatura {$id} foi atualizada com sucesso!\") </script>" : "<SCRIPT LANGUAGE=\"JavaScript\" TYPE=\"text/javascript\"> alert(\"Falha na tentativa de atualizar a fatura {$id}!\") </script>";
        }
		catch (Exception $e) 
		{
			echo "Exception Catch: ",  $e->getMessage(), "\n";
			return FALSE;
		}
        
		GenericSql::Redirect($sec=0, $file="../view/accounts-receivable.php");
    }
}
else 
{
    die('No direct script access.');
}
?>
