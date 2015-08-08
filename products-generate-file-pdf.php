<?php
include('includes/config/config.php');
include('includes/Sql/sql.class.php');
include('includes/lang/pt-br.php');

// Query products
$sql = "SELECT p.`product_code`, p.`name`, p.`description`, pa.price \n"
    . "FROM `products` p \n"
    . "LEFT JOIN products_atributes pa ON pa.product_id = p.id \n"
    . "WHERE p.`active`=1 ORDER BY p.category_id ASC";

$res = mysql_query($sql) or die("Erro gerando menu PDF");
while ($row = mysql_fetch_array($res))
{
    $product_code = $row['product_code'];
    $product_name = $row['name'];
    //$product_description = $row['description'];
    $price = $row['price'];

    if ($price == null) $price = "0.00";
    //$dados .= $product_code . ";" . $product_name . ";" . $product_description .";" . $price . "\n"; //$product_description
    $dados .= $product_code . ";" . $product_name . ";" . $price . "\n";
}
$result = file_put_contents('menu.txt', $dados);
if (!empty($result)) echo "Menu do cliente gerado com sucesso. Formato do arquivo: PDF.<hr />";
echo "<a href='menu-print.php'>Visualizar Arquivo</a>";
?>