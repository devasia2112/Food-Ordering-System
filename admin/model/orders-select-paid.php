<?php
require('../../includes/config/config.php');
require('../../includes/Sql/sql.class.php');
$result = mysql_query("set names 'utf8'");
$query  = "SELECT orders.order_id, orders.customer_id, orders.date_time, orders.payment_method, orders.order_status_id, orders.date_last_modified, customers.name, orders_status.orders_status_name, payment_types.description "
	  ."FROM `orders` "
	  ."LEFT JOIN customers ON customers.id = orders.customer_id "
      ."LEFT JOIN orders_status ON orders_status.orders_status_id = orders.order_status_id "
      ."LEFT JOIN payment_types ON payment_types.id = orders.payment_method "
	  ."WHERE order_status_id=13 "
	  ."ORDER BY orders.order_id ASC";
$result = mysql_query($query) or trigger_error(mysql_error());
while($row = mysql_fetch_array($result))
{
    foreach($row AS $key => $value) { 
        $row[$key] = stripslashes($value);

        if ( $row['orders_status_name'] == "Delivered" ) {
            $status = "success";  
        }elseif ( $row['orders_status_name'] == "Processing" ) {
            $status = "warning";  
        }elseif ( $row['orders_status_name'] == "Pending" ) {
            $status = "important";  
        }elseif ( $row['orders_status_name'] == "Canceled" ) {
            $status = "important";  
        }elseif ( $row['orders_status_name'] == "Finalized" ) {
            $status = "success";  
        }elseif ( $row['orders_status_name'] == "PayPal [Pending]" ) {
            $status = "important";  
        }elseif ( $row['orders_status_name'] == "PayPal [Processing]" ) {
            $status = "success";  
        }elseif ( $row['orders_status_name'] == "PayPal [Authorized]" ) {
            $status = "success";  
        }elseif ( $row['orders_status_name'] == "PayPal [canceled]" ) {
            $status = "important";  
        }elseif ( $row['orders_status_name'] == "MoIP [Pendente]" ) {
            $status = "important";  
        }elseif ( $row['orders_status_name'] == "MoIP [Processando]" ) {
            $status = "success";  
        }elseif ( $row['orders_status_name'] == "MoIP [Autorizado]" ) {
            $status = "success";  
        }elseif ( $row['orders_status_name'] == "MoIP [Cancelado]" ) {
            $status = "important";  
        }else {
            $status = "important"; 
        }        
    }

    echo "<tr>";  
    echo "<td valign='top'>" . nl2br( $row['order_id']) . "</td>";
    echo "<td valign='top'>" . nl2br( $row['name']) . "</td>";
    echo "<td valign='top'>" . nl2br( $row['date_time']) . "</td>";
    echo "<td valign='top'>" . nl2br( $row['description']) . "</td>";
    echo "<td valign='top'><span class='label " . $status . "'>" . nl2br( $row['orders_status_name']) . "</span></td>";
    echo "<td valign='top'>" . nl2br( $row['date_last_modified']) . "</td>";
    echo "<td valign='top'>
            <a href=orders-update.php?id={$row['order_id']}><img src='../../images/icons/pen-fill.png' title='Editar Status do pedido' alt='Editar Status do pedido'></a>
            <a href='javascript:abrir(\"1024\",\"600\",\"orders-print-receipt.php?id={$row['order_id']}\");'><img src='../../images/icons/print.png' title='Imprimir Recibo Detalhado do Pedido' alt='Imprimir Recibo Detalhado do Pedido'></a>
    </td>";
    //echo "<td><a href=../model/category-delete.php?id={$row['id']} onclick=\"return confirm('Deseja realmente excluir os dados dessa categoria?');\"><img src='../../images/icons/delete_cross.png' title='Excluir' alt='Excluir'></a></td>";
    echo "</tr>";
} 
?>
