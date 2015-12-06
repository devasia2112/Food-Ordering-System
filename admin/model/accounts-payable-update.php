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
        $sql = "UPDATE `invoice_payable` SET `status` = '{$_POST['status']}', `paid_date`='" . date('Y-m-d') . "', `user_low_account`='{$_SESSION["admin_id"]}', `cashier_id`='{$_POST['cashier_id']}', `company_id`='{$_POST['company_id']}', `nota_fiscal`='{$_POST['nota_fiscal']}', `notes`='{$_POST['notas']}' WHERE `id` = '{$id}'";
	      if ( $_POST['status'] == "paid" ) { $status = "finalizado"; } else { $status = ""; }
        $sql2 = "UPDATE `supplier_order` SET `status` = '{$status}' WHERE `order_id` = '{$_POST['hash_order']}'";

        try {
        	    mysql_query($sql);
        	    mysql_query($sql2);
        	    echo (mysql_affected_rows()) ? "<SCRIPT LANGUAGE=\"JavaScript\" TYPE=\"text/javascript\"> alert(\"A fatura {$id} foi atualizada com sucesso!\") </script>"
				      : "<SCRIPT LANGUAGE=\"JavaScript\" TYPE=\"text/javascript\"> alert(\"Falha na tentativa de atualizar a fatura {$id}!\") </script>";
        }
      	catch (Exception $e)
      	{
      	    echo "Exception Catch: ",  $e->getMessage(), "\n";
      	    return FALSE;
      	}
		    GenericSql::Redirect($sec=0, $file="../view/accounts-payable.php");
    }
}
else 
{
    die('No direct script access.');
}
?>
