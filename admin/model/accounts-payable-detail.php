<?php
require('../../includes/config/config.php');
require('../../includes/Sql/sql.class.php');
$result = mysql_query("set names 'utf8'");

/* query sample
SELECT `ip`.`id`, `ip`.`order_id`, `ip`.`date`, `ip`.`bill_date`, `ip`.`due_date`, `ip`.`paid_date`, `ip`.`desc`, `ip`.`qty`, `ip`.`rate`, `ip`.`tax`, `ip`.`salestax`, `ip`.`amt`, `ip`.`shipping`, `ip`.`interest`, `ip`.`fine`, `ip`.`discount`, `ip`.`subtotal`, `ip`.`total`, `ip`.`status`, `ip`.`reference_id`, `ip`.`recurring_bill`, `ip`.`prediction_account`, `ip`.`user_register`, `ip`.`user_low_account`, `ip`.`cashier_id`, `ip`.`company_id`, `ip`.`nota_fiscal`, `ip`.`notes`, `f`.`id` AS fid, `f`.`nome_fantasia` 
FROM invoice_payable ip 
INNER JOIN fornecedor f ON `f`.`id`=`ip`.`supplier_id` 
WHERE `ip`.`id`='23'
*/

$query  = " SELECT `ip`.`id`, `ip`.`order_id`, `ip`.`date`, `ip`.`bill_date`, `ip`.`due_date`, `ip`.`paid_date`, `ip`.`desc`, `ip`.`qty`, `ip`.`rate`, `ip`.`tax`, `ip`.`salestax`, `ip`.`amt`, `ip`.`shipping`, `ip`.`interest`, `ip`.`fine`, `ip`.`discount`, `ip`.`subtotal`, `ip`.`total`, `ip`.`status`, `ica`.`categ` AS AccCateg, `ica`.`code` AS AccCode, `ica`.`categ_name` AS AccCategName, `ica`.`name` AS AccPlanName, `ip`.`recurring_bill`, `ip`.`prediction_account`, `au`.`user_nicename` AS EmployeeAdminUser, `au2`.`user_nicename` AS EmployeeAdminUserLowerAccount, `ip`.`cashier_id`, `ip`.`nota_fiscal`, `ip`.`notes`, `f`.`id` AS fid, `f`.`nome_fantasia` AS fNomeFantasia, `e`.`nome_fantasia` AS eNomeFantasia 
	    FROM invoice_payable ip 
	    LEFT JOIN fornecedor f ON `f`.`id`=`ip`.`supplier_id` 
	    LEFT JOIN empresa e ON `e`.`id`=`ip`.`company_id` 
	    LEFT JOIN admin_users au ON `au`.`id`=`ip`.`user_register`   
	    LEFT JOIN admin_users au2 ON `au2`.`id`=`ip`.`user_low_account` 
	    LEFT JOIN invoices_chart_accounts ica ON `ica`.`id`=`ip`.`reference_id` 
	    WHERE `ip`.`id`='{$_GET[id]}' ";
$result = mysql_query($query) or trigger_error(mysql_error());
while($row = mysql_fetch_array($result))
{
    foreach($row AS $key => $value) { 
        $row[$key] = stripslashes($value);
    }
  
    echo "<tr><td><b>#ID</b></td><td valign='top'>" . nl2br( $row['id']) . "</td></tr>";
    echo "<tr><td><b>HASH Pedido</b></td><td valign='top'>" . nl2br( $row['order_id']) . "</td></tr>";
    echo "<tr><td><b>Data Pedido</b></td><td valign='top'>" . nl2br( $row['date']) . "</td></tr>";
    echo "<tr><td><b>Data Conta</b></td><td valign='top'>" . nl2br( $row['bill_date']) . "</td></tr>";
    echo "<tr><td><b>Data Venc. Pedido</b></td><td valign='top'>" . nl2br( $row['due_date']) . "</td></tr>";
    echo "<tr><td><b>Desc.</b></td><td valign='top'>" . nl2br( $row['desc']) . "</td></tr>";
    echo "<tr><td><b>Qtde.</b></td><td valign='top'>" . nl2br( $row['qty']) . "</td></tr>";
    echo "<tr><td><b>Taxa</b></td><td valign='top'>" . nl2br( $row['rate']) . "</td></tr>";
    echo "<tr><td><b>Imposto</b></td><td valign='top'>" . nl2br( $row['tax']) . "</td></tr>";
    echo "<tr><td><b>Imposto de Vendas</b></td><td valign='top'>" . nl2br( $row['salestax']) . "</td></tr>";
    echo "<tr><td><b>Valor</b></td><td valign='top'>" . nl2br( $row['amt']) . "</td></tr>";
    echo "<tr><td><b>Valor Frete</b></td><td valign='top'>" . nl2br( $row['shipping']) . "</td></tr>";
    echo "<tr><td><b>Juros</b></td><td valign='top'>" . nl2br( $row['interest']) . "</td></tr>";
    echo "<tr><td><b>Multa</b></td><td valign='top'>" . nl2br( $row['fine']) . "</td></tr>";
    echo "<tr><td><b>Desconto</b></td><td valign='top'>" . nl2br( $row['discount']) . "</td></tr>";
    echo "<tr><td><b>Subtotal</b></td><td valign='top'>" . nl2br( $row['subtotal']) . "</td></tr>";
    echo "<tr><td><b>Total</b></td><td valign='top'>" . nl2br( $row['total']) . "</td></tr>";
    echo "<tr><td><b>Status</b></td><td valign='top'>" . nl2br( $row['status']) . "</td></tr>";
    echo "<tr><td><b>Plano Contas</b></td><td valign='top'>" . nl2br( $row['AccCateg']) ."". nl2br( $row['AccCode']) . " | " . nl2br( $row['AccCategName']) . " - " . nl2br( $row['AccPlanName']) . "</td></tr>";
    echo "<tr><td><b>Recorrente</b></td><td valign='top'>" . nl2br( $row['recurring_bill']) . "</td></tr>";
    echo "<tr><td><b>Conta Previsao</b></td><td valign='top'>" . nl2br( $row['prediction_account']) . "</td></tr>";
    echo "<tr><td><b>Usuario Registro</b></td><td valign='top'>" . nl2br( $row['EmployeeAdminUser']) . "</td></tr>";
    echo "<tr><td><b>Usuario Baixa</b></td><td valign='top'>" . nl2br( $row['EmployeeAdminUserLowerAccount']) . "</td></tr>";
    echo "<tr><td><b>Caixa</b></td><td valign='top'>" . nl2br( $row['cashier_id']) . "</td></tr>";
    echo "<tr><td><b>Empresa</b></td><td valign='top'>" . nl2br( $row['eNomeFantasia']) . "</td></tr>";
    echo "<tr><td><b>NF</b></td><td valign='top'>" . nl2br( $row['nota_fiscal']) . "</td></tr>";
    echo "<tr><td><b>Fornecedor</b></td><td valign='top'>" . nl2br( $row['fNomeFantasia']) . "</td></tr>";
    echo "<tr><td><b>Obs.</b></td><td valign='top'>" . nl2br( $row['notes']) . "</td></tr>";
} 
?>