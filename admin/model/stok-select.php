<?php
require('../../includes/config/config.php');
require('../../includes/Sql/sql.class.php');
$result = mysql_query("set names 'utf-8'");
$result = mysql_query("SELECT * FROM `ingredients` ORDER BY `name`") or trigger_error(mysql_error()); 
while($row = mysql_fetch_array($result)) {

    foreach($row AS $key => $value) {
		$row[$key] = stripslashes($value);
		if ( $row['stock_level'] > $row['minimum_stock'] ) {
			$status = "success";  
		} else {
			$status = "important"; 
		}
	}

	echo "<tr>";  
	echo "<td valign='top'>" . $row['id'] . "</td>";  
	echo "<td valign='top'>" . $row['name'] . "</td>";  
	echo "<td valign='top'>" . $row['short_name'] . "</td>";  
	echo "<td valign='top'>" . $row['unit'] . "</td>";  
	echo "<td valign='top'>" . $row['scale_unit'] . "</td>";  
	echo "<td valign='top'><span class='label'>" . $row['minimum_stock'] . "</span></td>";
	echo "<td valign='top'><span class='label " . $status . "'>" . $row['stock_level'] . "</span></td>";
	echo "<td valign='top'>" . $row['unit_cost'] . "</td>";  
	echo "<td valign='top'>" . $row['supplier'] . "</td>";  
	echo "<td valign='top'>" . $row['datetime'] . "</td>";  
	echo "<td valign='top'><a onclick='return false' href='stok-update.php?id={$row['id']}'><img src='../../images/icons/pen-fill.png' title='Editar' alt='Editar'></a></td>";
	echo "<td><a href=../model/stok-delete.php?id={$row['id']} onclick=\"return false\"><img src='../../images/icons/delete_cross.png' title='Excluir' alt='Excluir'></a></td>";
	echo "</tr>";
}
?>