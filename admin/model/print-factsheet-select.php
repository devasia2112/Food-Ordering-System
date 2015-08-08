<?php
require('../../includes/config/config.php');
require('../../includes/Sql/sql.class.php');
$result = mysql_query("set names 'utf-8'");
$sql = "SELECT sp.id as spid, sp.product_id, \n"
    . "(sp.shipping + sp.contribution + sp.financial_charges + sp.icms + sp.other_expenses + sp.comissions) AS incidencias, \n"
    . "sp.cost_value, sp.final_price, sp.datetime, p.name \n"
    . "FROM `sale_price` sp \n"
    . "INNER JOIN products p ON p.id = sp.product_id \n"
    . "ORDER BY sp.final_price LIMIT 0, 30 ";
    
$result = mysql_query( $sql ) or trigger_error(mysql_error());
while( $row = mysql_fetch_array( $result )) {

    foreach($row AS $key => $value) { $row[$key] = stripslashes($value); }

	echo "<tr>";  
	echo "<td valign='top'>" . $row['name'] . "</td>";
	echo "<td valign='top'>" . $row['incidencias'] . "</td>";
	echo "<td valign='top'>" . $row['cost_value'] . "</td>";
	echo "<td valign='top'>" . $row['final_price'] . "</td>";
	echo "<td valign='top'>" . $row['datetime'] . "</td>";
	echo "<td valign='top'><a href='print-factsheet.php?product_id={$row['product_id']}'><img src='../../images/icons/print.png' title='Imprimir' alt='Imprimir'></a></td>";
	echo "</tr>";
}
?>