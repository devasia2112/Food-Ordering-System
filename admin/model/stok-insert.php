<?php
include('../../includes/config/config.php');
include('../../includes/Sql/sql.class.php');
require("../../includes/config/config-aux.php");

session_start();

if ($_POST)
{
	$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
	$short_name = filter_var($_POST['short_name'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
	$unity_measure = mysql_real_escape_string($_POST['unity_measure']);
	$scale_unity = mysql_real_escape_string($_POST['scale_unity']);
	$minimum_stock = mysql_real_escape_string($_POST['minimum_stock']);
	$stock_level = mysql_real_escape_string($_POST['stock_level']);
	$unit_cost = mysql_real_escape_string($_POST['unit_cost']);

	try 
	{
		// Insert table ingredients
		$sql = "INSERT INTO `ingredients` (`id`, `name`, `short_name`, `unit`, `scale_unit`, `minimum_stock`, `stock_level`, `unit_cost`, `supplier`, `datetime`) 
				VALUES (NULL, '{$name}', '{$short_name}', '{$unity_measure}', '{$scale_unity}', '{$minimum_stock}', '{$stock_level}', '{$unit_cost}', '{$_POST['supplier']}', CURRENT_TIMESTAMP)";
		mysql_query( $sql );
		$ingredient_id = mysql_insert_id();
		
		
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
						'{$ingredient_id}', '{$short_name}', '{$name}', '', '', '0', 
						NULL, NULL, '0', 'G', '0.0000', '$unit_cost', 
						'1.00', '1.00', NULL, '{$scale_unity}', '{$stock_level}', NULL, 
						NULL, NULL, NULL, NULL, NULL, NULL, 
						NULL, NULL, NULL, NULL, NULL, NULL, 
						NULL, NULL, NULL, 'N', '0.00', '0.00', 
						'0', NULL, NULL, NULL, NULL, NULL, 
						NULL, NULL, NULL, 'Cadastro feito via web'
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
