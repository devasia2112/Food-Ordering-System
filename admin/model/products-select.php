<?php
require('../../includes/config/config.php');
require('../../includes/Sql/sql.class.php');

$sql = "SELECT p.id, p.product_code, p.image, p.name, p.description, p.active, 
        c.name AS categ_name, c.short, pa.atributes, pa.recommended, pa.product_size, pa.price 
        FROM products p 
        INNER JOIN categories c ON c.id = p.category_id 
        LEFT JOIN products_atributes pa ON pa.product_id = p.id 
        ORDER BY c.name ASC ";

$result = mysql_query($sql) or trigger_error(mysql_error());

while($row = mysql_fetch_array($result)){

    // Size
    if (nl2br( $row['product_size'])==1)        $size = "pequeno";
    elseif (nl2br( $row['product_size'])==2)    $size = "m&eacute;dio";
    elseif (nl2br( $row['product_size'])==3)    $size = "grande";
    else $size = "<font color=red><b>VAZIO</b></font>"; // nada encontrado

    // Product Status in the system
    if (nl2br( $row['active'])==0)        $active = "Inativo";
    elseif (nl2br( $row['active'])==1)    $active = "Ativo";
    else $active = "<font color=red><b>VAZIO</b></font>"; // nada encontrado

    // Spicy (apimentado)
    if (nl2br( $row['atributes'])==1)        $spicy = "Leve";
    elseif (nl2br( $row['atributes'])==2)    $spicy = "M&eacute;dio";
    elseif (nl2br( $row['atributes'])==3)    $spicy = "Muito";
    else $spicy = "<font color=red><b>VAZIO</b></font>"; // nada encontrado

    // Recommended by Chef
    if (nl2br( $row['recommended'])==0)        $chef = "";
    elseif (nl2br( $row['recommended'])==1)    $chef = "<img src='../../images/chef_hat.jpg' title='Recomendado pelo chef' alt='Recomendado pelo chef' />";
    else $chef = "<font color=red><b>VAZIO</b></font>"; // nada encontrado


    foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
    echo "<tr>";  
    echo "<td valign='top'>" . nl2br( $row['product_code']) . "</td>";  
    echo "<td valign='top'><img width='75' height='50' src='../uploads/" . nl2br( $row['image']) . "' /></td>";  
    echo "<td valign='top'>" . nl2br( $row['name']) . "</td>";  
    echo "<td valign='top'>" . nl2br( $row['description']) . "</td>";  
    echo "<td valign='top'>" . $active . "</td>";
    echo "<td valign='top'>" . nl2br( $row['categ_name']) . "</td>";
    echo "<td valign='top'>" . $spicy . "</td>";
    echo "<td valign='top'>" . $chef . "</td>";
    echo "<td valign='top'>" . $size . "</td>";
    echo "<td valign='top'>" . nl2br( $row['price']) . "</td>";  
    echo "<td valign='top'><a href=products-update.php?id={$row['id']}><img src='../../images/icons/pen-fill.png' title='Editar' alt='Editar'></a></td>";
    echo "<td><a href=../model/products-delete.php?id={$row['id']} onclick=\"return confirm('Deseja realmente excluir os dados desse produto?');\"><img src='../../images/icons/delete_cross.png' title='Excluir' alt='Excluir'></a></td>";
    echo "</tr>"; 
} 
?>
