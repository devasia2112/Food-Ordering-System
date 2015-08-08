<?php
require('../../includes/config/config.php');
require('../../includes/Sql/sql.class.php');
$result = mysql_query("set names 'latin1'");
$result = mysql_query("SELECT * FROM `gateways`") or trigger_error(mysql_error()); 
while($row = mysql_fetch_array($result)){
    foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 

		if( $row['useit'] == 1 ) $useit = "SIM"; else $useit = "N&Atilde;O";

        echo "<tr>";
        echo "<td valign='top'>" . nl2br( $row['id'] ) . "</td>";
        echo "<td valign='top'>" . nl2br( $row['name'] ) . "</td>";
        echo "<td valign='top'>" . nl2br( $row['currency_code'] ) . "</td>";
        echo "<td valign='top'>" . nl2br( $row['business_id'] ) . "</td>";
        echo "<td valign='top'>" . nl2br( $row['return_url'] ) . "</td>";
        echo "<td valign='top'>" . nl2br( $row['notify_url'] ) . "</td>";
        echo "<td valign='top'>" . nl2br( $useit ) . "</td>";
        echo "<td valign='top'><a href=paypal-config-update.php?id={$row['id']}><img src='../../images/icons/pen-fill.png' title='Editar' alt='Editar'></a></td>";
        //echo "<td><a href=../model/category-delete.php?id={$row['id']} onclick=\"return confirm('Deseja realmente excluir os dados dessa categoria?');\"><img src='../../images/icons/delete_cross.png' title='Excluir' alt='Excluir'></a></td>";
        echo "</tr>";
} 
?>
