<?php
require('../../includes/config/config.php');
require('../../includes/Sql/sql.class.php');
$result = mysql_query("set names 'utf-8'");
$sql = "SELECT * FROM recipe";
$result = mysql_query( $sql ) or trigger_error(mysql_error());
while( $row = mysql_fetch_array( $result )) {

    foreach($row AS $key => $value) { $row[$key] = stripslashes($value); }

	echo "<tr>";  
	echo "<td valign='top'>" . $row['recipe_title'] . "</td>";
	echo "<td valign='top'>" . $row['recipe_author'] . "</td>";
	echo "<td valign='top'>" . $row['recipe_contact'] . "</td>";
	echo "<td valign='top'><a href='print-recipe.php?id={$row['id']}'><img src='../../images/icons/print.png' title='Imprimir' alt='Imprimir'></a></td>";
	echo "</tr>";
}
?>
