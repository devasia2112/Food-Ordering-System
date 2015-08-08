<?php
session_start();
require('../../includes/config/config.php');
require('../../includes/Sql/sql.class.php');

if (isset($_POST['submitted'])) 
{
    $order_id = md5(date("Ymd H:i:s"));

    // DEBUG
    //print "<pre>"; 
    //print_r($_POST); 
    //print "</pre>";
   
    $cnt = count($_POST['item_tipo']);
    for ( $ii=0;$ii<$cnt;$ii++ ) {

	$item_tipo 	= $_POST['item_tipo'][$ii];
	$item_id 	= $_POST['item_id'][$ii];
	$quantidade 	= $_POST['quantidade'][$ii];
	$unid_medida 	= $_POST['unid_medida'][$ii];
	$preco_unitario = $_POST['preco_unitario'][$ii];
	
	// Em caso de Ativo Permanente 
	$fixed_assets   = $_POST['fixed_assets'][$ii];
	

	if ($unid_medida == "unidade") {
	    $preco_unitario = ($preco_unitario * $quantidade);
	} else {
	    $preco_unitario = $preco_unitario;
	}
	$equa += $preco_unitario;
	
	try {
	
	    $sql =  "INSERT INTO `supplier_order` (`id`, `order_id`, `order_date`, `supplier_id`, `item_type`, `item_categ`, `item`, `qty`, `unity`, `price_unity`, `time_delivery`, `payment_deadline`, `payment_method`, `user_id`, `company`, `status`) VALUES (NULL, '{$order_id}', NOW(), '{$_POST['fornecedor']}', '{$item_tipo}', '', '{$item_id}', '{$quantidade}', '{$unid_medida}', '{$preco_unitario}', '{$_POST[prazo_fornecimento]}', '{$_POST[prazo_pagamento]}', '{$_POST[metodo_pgto]}', '{$_SESSION['admin_id']}', '{$_POST['empresa']}', 'aberto')";
	    mysql_query( $sql );
	    
	    // if item_tipo == fixed assets then insert in fixed_assets table
	    // A descricao do item esta indo como VAZIO, precisa criar um campo descricao na interface /view/supplier_orders.php 
	    //   e so mostrar o campo caso o item_tipo for fixed assets.
	    if ( $item_tipo == "fixed assets" ) {
		$sql2 =  "INSERT INTO `fixed_assets` (`id`, `desc_item`, `date_buy`, `qty`, `order_id`) VALUES (NULL, '$fixed_assets', NOW(), '$quantidade', '$order_id')";
		mysql_query( $sql2 );
	    }
	
	} catch (Exception $e) {
	
	    echo 'Caught exception: ',  $e->getMessage(), "\n";
	    die();
	    
	}
    }
    
    foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); }
    $amt = $equa;
    $subtotal = $equa;
    $total = $equa;
    $sql2 = "INSERT INTO `invoice_payable` (`id`, `order_id`, `date`, `bill_date`, `due_date`, `paid_date`, `desc`, `qty`, `rate`, `tax`, `salestax`, `amt`, `shipping`, `interest`, `fine`, `discount`, `subtotal`, `total`, `status`, `reference_id`, `recurring_bill`, `prediction_account`, `user_register`, `user_low_account`, `cashier_id`, `company_id`, `nota_fiscal`, `supplier_id`, `notes`) VALUES (NULL, '{$order_id}', '{$_POST[date]}', '{$_POST[prazo_fornecimento]}', '{$_POST[prazo_pagamento]}', '', '{$_POST['desc']}', '1', 0.00, 0.00, 0.00, '{$amt}', 0.00, 0.00, 0.00, 0.00, '{$subtotal}', '{$total}', 'pending', '{$_POST[plano_contas]}', 0, 0, '{$_SESSION['admin_id']}', '', '{$_POST[caixa]}', '{$_POST[empresa]}', '', '{$_POST[fornecedor]}', '')";

    try {
	mysql_query( $sql2 );
	echo "<SCRIPT LANGUAGE=\"JavaScript\" TYPE=\"text/javascript\"> alert(\"O novo pedido " . $order_id . " foi gravado com sucesso!\") </script>";
    } catch (Exception $e) {
	echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
    
	GenericSql::Redirect($sec=0, $file="../view/supplier-orders.php");

}
?>
