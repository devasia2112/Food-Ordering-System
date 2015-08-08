<?php
require('../../includes/config/config.php');
require('../../includes/Sql/sql.class.php');

$result = mysql_query("SELECT * FROM `empresa`") or trigger_error(mysql_error());
while($row = mysql_fetch_array($result)){
    foreach($row AS $key => $value) { $row[$key] = stripslashes($value); }
        echo "<tr>";
        echo "<td valign='top'>" . nl2br( $row['nome_fantasia']) . "</td>";
        echo "<td valign='top'>" . nl2br( $row['endereco']) . "</td>";
        echo "<td valign='top'>" . nl2br( $row['numero']) . "</td>";
        echo "<td valign='top'>" . nl2br( $row['bairro']) . "</td>";
        echo "<td valign='top'>" . nl2br( $row['complemento']) . "</td>";
        echo "<td valign='top'>" . nl2br( $row['estado']) . "</td>";
        echo "<td valign='top'>" . nl2br( $row['cidade']) . "</td>";
        echo "<td valign='top'>" . nl2br( $row['cep']) . "</td>";
        echo "<td valign='top'>" . nl2br( $row['cnpj']) . "</td>";
        echo "<td valign='top'>" . nl2br( $row['ie']) . "</td>";
        echo "<td valign='top'>" . nl2br( $row['tel1']) . "</td>";
        echo "<td valign='top'>" . nl2br( $row['resp1']) . "</td>";
        echo "<td valign='top'><a href=company-update.php?id={$row['id']}><img src='../../images/icons/pen-fill.png' title='Editar' alt='Editar'></a></td>";
        echo "<td><a href=../model/company-delete.php?id={$row['id']} onclick=\"return confirm('Deseja realmente excluir os dados dessa empresa?');\"><img src='../../images/icons/delete_cross.png' title='Excluir' alt='Excluir'></a></td>";
        echo "</tr>";
}
?>
