<?php
include('../../includes/config/config.php');
include('../../includes/Sql/sql.class.php');
require("../../includes/config/config-aux.php");

session_start();

if ($_POST)
{
	// session image name
	//echo $_SESSION['product_image'];

	$code    = mysql_real_escape_string($_POST['code']);
	$price   = mysql_real_escape_string($_POST['price']);
	$coupom  = mysql_real_escape_string($_POST['coupom']);
	$name_ll = filter_var($_POST['name_ll'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
	$name_en = filter_var($_POST['name_en'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
	$desc_ll = filter_var($_POST['desc_ll'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
	$desc_en = filter_var($_POST['desc_en'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);

	if ( $_POST[chef] == "true" ) { $chef = 1; } else { $chef = 0; }

	try 
	{
		// Insert table products
		mysql_query("INSERT INTO `products`(category_id, product_code, image, name, description, registered_in) VALUES('{$_POST[category]}', '{$code}', '{$_SESSION[product_image]}', '{$name_ll}', '{$desc_ll}', NOW())");
		$product_id = mysql_insert_id();
		
		// Insert table products atributes
		mysql_query("INSERT INTO `products_atributes`(product_id, atributes, recommended, product_size, price, cupom_discount_code) VALUES('{$product_id}', '{$_POST[spicy]}', '{$chef}', '{$_POST[size]}', '{$price}', '{$coupom}')");
		
		// Insert table products description (2 languages)
		mysql_query("INSERT INTO `products_description`(products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES('{$product_id}', '1', '{$name_ll}', '{$desc_ll}', '', '')");
		mysql_query("INSERT INTO `products_description`(products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES('{$product_id}', '2', '{$name_en}', '{$desc_en}', '', '')");
		
		// Define the size of the dish (product) in grams
		if ($_POST[size] == 1) $size = 350;
		elseif ($_POST[size] == 2) $size = 450;
		elseif ($_POST[size] == 3) $size = 550;
		else $size = 0;
		
		
		###### INTEGRACAO COM B2STOK ######
		# Call the connection
		$mysqli = MysqliConnect();
		
		$query = "INSERT INTO `produtos` (
					`cod_produto`, `cod_alfa`, `nome`, `descricao`, `cod_categoria`, `cod_fornecedor`, 
					`cod_foto`, `cod_catalogo`, `fragil`, `unidade`, `preco_fornecedor`, `preco_unitario`, 
					`multiplicador`, `divisor`, `emb_forn`, `peso_liquido`, `estoque`, `cod_class_fiscal`, 
					`icms`, `red_icms`, `ipi`, `cod_sit`, `cod_prod_forn`, `cod_barras`, 
					`ultima_compra`, `total_entradas`, `total_saidas`, `ultima_venda`, `vendas_quant`, `vendas_reais`, 
					`ponto_repos`, `material`, `medidas`, `comissionada`, `comissaomaxima`, `descontomaximo`, 
					`inativa`, `precoatacado`, `falsolucroatacado`, `margemlucroatacado`, `quantatacado`, `volume`, 
					`promopreco`, `promoinicio`, `promofim`, `obs`
					) 
					VALUES (
						'{$product_id}', '{$code}', '{$name_ll}', '{$desc_ll}', '{$_POST[category]}', '0', 
						NULL, NULL, '0', 'G', '0.0000', '{$price}', 
						'1.00', '1.00', NULL, '{$size}', NULL, NULL, 
						NULL, NULL, NULL, NULL, NULL, NULL, 
						NULL, NULL, NULL, NULL, NULL, NULL, 
						NULL, NULL, NULL, 'N', '0.00', '0.00', 
						'0', NULL, NULL, NULL, NULL, NULL, 
						NULL, NULL, NULL, NULL
					)";
		
		# Execute the Query
		if (!$mysqli->query( $query ))
		{
			echo "QUERY FAIL -> INSERT PRODUCTS BACKEND B2STOK: (" . $mysqli->errno . ") " . $mysqli->error;
		}
		###### INTEGRACAO COM B2STOK ######
		
		echo "Success!";
		
	}
	catch (Exception $e)
	{
		echo 'INSERT: Banco Vazio: ',  $e->getMessage(), "\n";
		echo "ERRO";
	}
}
?>
