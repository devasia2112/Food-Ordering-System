<?php
require('../../includes/config/config.php');
require('../../includes/Sql/sql.class.php');
$result = mysql_query("set names 'latin1'");
$query  = "SELECT * FROM invoices_receivable WHERE status<>'paid' ORDER BY due_date ASC";
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
    echo "<td valign='top'>" . nl2br( $row['serv_rate']) . "</td>";
    echo "<td valign='top'>" . nl2br( $row['subtotal']) . "</td>";
    echo "<td valign='top'>" . nl2br( $row['discount']) . "</td>";
    echo "<td valign='top'>" . nl2br( $row['total']) . "</td>";
    echo "<td valign='top'>" . nl2br( $row['status']) . "</td>";
    echo "<td valign='top'>" . nl2br( $row['note']) . "</td>";
    echo "<td valign='top'>
            <a href=accounts-receivable-update.php?id={$row['id']}><img src='../../images/icons/pen-fill.png' title='Baixa de Conta' alt='Baixa de Conta'></a>
            <a href='javascript:abrir(\"1024\",\"600\",\"accounts-receivable-detail.php?id={$row['id']}\");'><img src='../../images/icons/print.png' title='Imprimir Fatura Detalhada' alt='Imprimir Fatura Detalhada'></a>
    </td>";
    //echo "<td><a href=../model/category-delete.php?id={$row['id']} onclick=\"return confirm('Deseja realmente excluir os dados dessa categoria?');\"><img src='../../images/icons/delete_cross.png' title='Excluir' alt='Excluir'></a></td>";
    echo "</tr>";
} 
?>
