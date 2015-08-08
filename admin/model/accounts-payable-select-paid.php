<?php
require('../../includes/config/config.php');
require('../../includes/Sql/sql.class.php');
$result = mysql_query("set names 'utf8'");
$query  = "SELECT * FROM invoice_payable WHERE status='paid' ORDER BY due_date";
$result = mysql_query($query) or trigger_error(mysql_error());
while($row = mysql_fetch_array($result))
{
    foreach($row AS $key => $value) { 
        $row[$key] = stripslashes($value);
    }

    echo "<tr>";  
    echo "<td valign='top'>" . nl2br( $row['id']) . "</td>";
    echo "<td valign='top'>" . nl2br( $row['order_id']) . "</td>";
    echo "<td valign='top'>" . nl2br( $row['date']) . "</td>";
    echo "<td valign='top'>" . nl2br( $row['due_date']) . "</td>";
    echo "<td valign='top'>" . nl2br( $row['desc']) . "</td>";
    echo "<td valign='top'>" . nl2br( $row['total']) . "</td>";
    echo "<td valign='top'>" . nl2br( $row['notes']) . "</td>";
    echo "<td valign='top'>
            <a href='javascript:abrir(\"1024\",\"600\",\"accounts-payable-paid-detail.php?id={$row['id']}\");'><img src='../../images/icons/print.png' title='Imprimir Fatura Detalhada' alt='Imprimir Fatura Detalhada'></a>
    </td>";
    //echo "<td><a href=../model/category-delete.php?id={$row['id']} onclick=\"return confirm('Deseja realmente excluir os dados dessa categoria?');\"><img src='../../images/icons/delete_cross.png' title='Excluir' alt='Excluir'></a></td>";
    echo "</tr>";
} 
?>