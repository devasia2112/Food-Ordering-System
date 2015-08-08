<?php
require('../../includes/config/config.php');
require('../../includes/Sql/sql.class.php');
$result = mysql_query("set names 'latin1'");
$result = mysql_query("SELECT * FROM `categories`") or trigger_error(mysql_error()); 
while($row = mysql_fetch_array($result)){
    foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
        echo "<tr>";  
        echo "<td valign='top'>" . nl2br( $row['name']) . "</td>";  
        echo "<td valign='top'>" . nl2br( $row['short']) . "</td>";  
        echo "<td valign='top'>" . nl2br( $row['description']) . "</td>";  
        echo "<td valign='top' bgcolor='" . nl2br( $row['color']) . "'><font color='" . nl2br( $row['font_color']) . "'>" . nl2br( $row['color']) . "</font></td>";  
        echo "<td valign='top'><a href=category-update.php?id={$row['id']}><img src='../../images/icons/pen-fill.png' title='Editar' alt='Editar'></a></td>";
        echo "<td><a href=../model/category-delete.php?id={$row['id']} onclick=\"return confirm('Deseja realmente excluir os dados dessa categoria?');\"><img src='../../images/icons/delete_cross.png' title='Excluir' alt='Excluir'></a></td>";
        echo "</tr>";
} 
?>
