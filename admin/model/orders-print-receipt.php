<?php
require('../../includes/config/config.php');
require('../../includes/Sql/sql.class.php');
$result = mysql_query("set names 'utf8'");
$query = "SELECT `orders_products`.`orders_id`, `orders_products`.`products_id`, `orders_products`.`products_quantity`, `products`.`name`, `products`.`product_code`, `products_atributes`.`id` AS prodattid "
        . "FROM `orders_products` "
        . "LEFT JOIN `products_atributes` ON `products_atributes`.`id` = `orders_products`.`products_id` "
        . "LEFT JOIN `products` ON `products`.`id` = `products_atributes`.`product_id` "
        . "WHERE `orders_products`.`orders_id`='{$id}'";

$result = mysql_query($query) or trigger_error(mysql_error());
while($row = mysql_fetch_array($result))
{
    foreach($row AS $key => $value) { $row[$key] = stripslashes($value); }
    echo "<tr>";  
    echo "<td valign='top'>" . nl2br( $row['orders_id']) . "</td>";
    echo "<td valign='top'>" . nl2br( $row['product_code']) . "</td>";
    echo "<td valign='top'>" . nl2br( $row['name']) . "</td>";
    echo "<td valign='top'>" . nl2br( $row['products_quantity']) . "</td>";
    echo "</tr>";
} 
?>
