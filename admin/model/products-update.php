<?php
include('../../includes/config/config.php');
include('../../includes/Sql/sql.class.php');
session_start();

if ($_POST)
{
	// session image name
	//echo $_SESSION['product_image'];

	$code   = mysql_real_escape_string($_POST['code']);
	$name   = mysql_real_escape_string($_POST['name']);
	$desc   = mysql_real_escape_string($_POST['desc']);
	$price  = mysql_real_escape_string($_POST['price']);
	$coupom = mysql_real_escape_string($_POST['coupom']);

	if ( $_POST['chef'] == "true" ) { $chef = 1; } else { $chef = 0; }

	$idproduct = $_SESSION['IDPROD'];
    
	// Verifica se usario trocou a foto
	if (isset($_SESSION['product_image']))
	{
	    $foto = "`image` = '$_SESSION[product_image]', ";
	}
	else 
	{
	    $foto = " ";
	}

	try 
	{
	      // Update products
	      $sql_products = "UPDATE `products` SET `category_id` = '$_POST[category]', `product_code` = '$code', $foto `name` = '$name', `description` = '$desc' WHERE `id` = '$idproduct'";
	      mysql_query($sql_products);

	      // Update products atributes
	      $sql_atributes = "UPDATE `products_atributes` SET `atributes` = '$_POST[spicy]', `recommended` = '$chef', `product_size` = '$_POST[size]', `price` = '$price', `cupom_discount_code` = '$coupom' WHERE `product_id` = '$idproduct'";
	      mysql_query($sql_atributes) or die("ERROR: Update atributos dos produtos");

	      // Kill Session IDPROD, product_image
	      unset($_SESSION['IDPROD']);
	      unset($_SESSION['product_image']);

			echo "OK";
	}
	catch (Exception $e)
	{
	      echo 'ERRO UPDATE PRODUTOS: ',  $e->getMessage(), "\n";
	}
}
?>
