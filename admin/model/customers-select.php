<?php
require('../../includes/config/config.php');
require('../../includes/Sql/sql.class.php');

$result = mysql_query("SELECT `customers`.*, `tb_cidades`.`nome` AS cityName, `tb_estados`.`nome` AS stateName FROM `customers` LEFT JOIN tb_estados ON tb_estados.id=customers.state LEFT JOIN tb_cidades ON tb_cidades.id=customers.town ") or trigger_error(mysql_error());
while($row = mysql_fetch_array($result)) {
    foreach($row AS $key => $value) { $row[$key] = stripslashes($value); }
        echo "<tr>";
        echo "<td valign='top'>" . nl2br( $row['name']) . "</td>";
        echo "<td valign='top'>" . nl2br( $row['valid_document']) . "</td>";
        echo "<td valign='top'>" . nl2br( $row['email']) . "</td>";
        echo "<td valign='top'>" . nl2br( $row['birthday']) . "</td>";
        
        echo "<td valign='top'>" . nl2br( $row['street']) . "</td>";
        echo "<td valign='top'>" . nl2br( $row['number']) . "</td>";
        echo "<td valign='top'>" . nl2br( $row['suburb']) . "</td>";
        echo "<td valign='top'>" . nl2br( $row['complement']) . "</td>";
        echo "<td valign='top'>" . nl2br( $row['state']) . "</td>";
        echo "<td valign='top'>" . nl2br( $row['town']) . "</td>";
        echo "<td valign='top'>" . nl2br( $row['zipcode']) . "</td>";
        echo "<td valign='top'>" . nl2br( $row['phone_one']) . "</td>";
        echo "<td valign='top'>" . nl2br( $row['phone_two']) . "</td>";
        
        echo "<td valign='top'>" . nl2br( $row['registered_in']) . "</td>";
        echo "<td valign='top'>" . nl2br( $row['last_login']) . "</td>";
        echo "<td valign='top'>
		<a href=customers-update.php?id={$row['id']}><img src='../../images/icons/pen-fill.png' title='Editar' alt='Editar'></a>
		<a href=../model/customers-delete.php?id={$row['id']} onclick=\"return confirm('Deseja realmente excluir os dados desse cliente?');\"><img src='../../images/icons/delete_cross.png' title='Excluir' alt='Excluir'></a>
	      </td>";
        echo "</tr>";
}
?>