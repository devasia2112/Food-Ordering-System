<?php
/*
 * Classe Sql
 * Description: All queries must be provided by this class
 * Date: 26-01-2012
 * Coder: Costa, Fernando
 *
 * Observation: The main idea is to centralize all the queries, all the code, everything about Sql (Model) stuffs here in this class.
 *  It must be used by the "tiny" API
 *
 */

 class GenericSql
 {
       /*
	* Query the dedault company
	*
	*/

	public static function getEmpresa( )
	{
		$sqle = mysql_query("SELECT * FROM `empresa` WHERE `default` = 'y'") or die("ERROR: Get Company");
		$rowe = mysql_fetch_array($sqle);

		// In case of table be modified this option is useless
		// $array_comp = $rowe;

		$array_comp = array(
			"id"            => "".$rowe[id]."",
			"nome_fantasia" => "".$rowe[nome_fantasia]."",
			"razao_social"  => "".$rowe[razao_social]."",
			"endereco"		=> "".$rowe[endereco]."",
			"numero"		=> "".$rowe[numero]."",
			"bairro"		=> "".$rowe[bairro]."",
			"complemento"	=> "".$rowe[complemento]."",
			"estado"		=> "".$rowe[estado]."",
			"cidade"		=> "".$rowe[cidade]."",
			"cep"			=> "".$rowe[cep]."",
			"cnpj"			=> "".$rowe[cnpj]."",
			"ie"			=> "".$rowe[ie]."",
			"tel1"			=> "".$rowe[tel1]."",
			"cidade"		=> "".$rowe[cidade]."",
			"tel1"			=> "".$rowe[tel1]."",
			"tel2"			=> "".$rowe[tel2]."",
			"resp1"			=> "".$rowe[resp1]."",
			"resp2"			=> "".$rowe[resp2]."",
			"fax"			=> "".$rowe[fax]."",
			"website"		=> "".$rowe[website]."",
			"website_fb"	=> "".$rowe[website_fb]."",
			"gmap"			=> "".$rowe[gmap]."",
			"email"			=> "".$rowe[email]."",
			"logotipo"		=> "".$rowe[logotipo]."",
			"slider"		=> "".$rowe[slider]."",
			"IM"			=> "".$rowe[IM]."",
			"cnae"			=> "".$rowe[cnae]."",
			"crt"			=> "".$rowe[crt]."",
			"abre"			=> "".$rowe[abre]."",
			"fecha"			=> "".$rowe[fecha]."",
			"frontend"		=> "".$rowe[frontend]."",
			"valor_entrega"		=> "".$rowe[valor_entrega].""
		);
		return $array_comp;
	}



   	/*
	* Query the delivery area by company
    	*
	*  trabalhar com a faixa de cep para itajai e balneario direto no codigo
	*  http://www.buscacep.correios.com.br/servicos/dnec/menuAction.do?Metodo=menuFaixaCep
	*  By Range of ZIP code:
    	*
	*
	*  By specific ZIP code:
	*   Entrar manualmente todos os CEP do atendimento.
	*
	*  Example SOUTH BRAZIL-SC - use by range of ZIP code:
	*   Itajaí                88300-001 a 88319-999
	*   Balneário Camboriú    88330-001 a 88339-999
	*/
	public static function getDeliveryArea( $zipcode )
	{
		/* nao esta mais pegando do banco para comparar, estamos comparando por faixas agora
		$sqle = mysql_query("SELECT company FROM `delivery_area` WHERE `zipcode`=$zipcode") or die("ERROR: Get Delivery Area");
		$rowe = mysql_fetch_array($sqle);
		$array_area = array( "company" => $rowe['company'] );
		*/

		$zipcode = str_replace("-", "", $zipcode);
		if (( $zipcode >= 88300001 && $zipcode <= 88319999 ) || ( $zipcode >= 88330001 && $zipcode <= 88339999 )) {
			$array_area = array( "company" => 1 );	// 1 means OK 0 meand not ok
		} else {
			$array_area = array( "company" => 0 );	// 1 means OK 0 meand not ok
		}
		return $array_area;
	}




	/*
     * Query the categories of products
     *
	 */

	public static function getCategories( )
	{
		$sqle = mysql_query( "SELECT * FROM `categories` where `status`=1" ) or die( "ERRO: Get Categories" );
		while ( $rowe[] = mysql_fetch_array( $sqle ) ) { }
		return $rowe;
	}


       /*
	* Query all products
	*
	*/
	public static function getAllProducts( )
	{
		try {
			$sql = "SELECT p.id, p.product_code, p.image, p.name, p.description, p.active,
					c.name AS categ_name, c.short, pa.atributes, pa.recommended, pa.product_size, pa.price
					FROM products p
					INNER JOIN categories c ON c.id = p.category_id
					LEFT JOIN products_atributes pa ON pa.product_id = p.id
					ORDER BY c.name ASC ";
			$result = mysql_query("set names 'latin1'");
			$result = mysql_query($sql);
		}
		catch (Exception $e) {
			echo "Exceção pega: ",  $e->getMessage(), "\n";
			return FALSE;
		}
		$arr = array();
		while ($row = mysql_fetch_array($result)) {
				$arr[] = $row;
		}
		return $arr;
	}


       /*
	* Query all products with category labels (used to generate menu printed version with only actives products )
	* Date: 2013-09-06 19:30
	* Coder: Costa (fernando@deepcell.org)
	*/
	public static function getAllProductsMenu( )
	{
		try {
			$sql = "SELECT p.id, p.product_code, p.image, p.name, p.description, p.active,
				  c.id AS categ_id, c.name AS categ_name, c.short, pa.atributes, pa.recommended,
				  pa.product_size, pa.price
				 FROM products p
				 INNER JOIN categories c ON c.id = p.category_id
				 LEFT JOIN products_atributes pa ON pa.product_id = p.id
				 WHERE p.active=1
				 ORDER BY p.category_id ASC";
			$result = mysql_query("set names 'latin1'");
			$result = mysql_query($sql);
		}
		catch (Exception $e) {
			echo "Exceção pega: ",  $e->getMessage(), "\n";
			return FALSE;
		}
		$arr = array();
		while ($row = mysql_fetch_array($result)) {
			$arr[] = $row;
		}
		return $arr;
	}



	/*
     * Query all products
     *
	 */
	public static function getAllIngredients( )
	{
		try {
			$sql = "SELECT * FROM `ingredients` ORDER BY `name` ASC";
			$result = mysql_query("set names 'latin1'");
			$result = mysql_query($sql);
		}
	    catch (Exception $e) {
			echo "Exceção pega: ",  $e->getMessage(), "\n";
			return FALSE;
	    }
		$arr = array();
		while ($row = mysql_fetch_array($result)) {
				$arr[] = $row;
		}
		return $arr;
	}



	/*
     * Query the products by category
     *
	 */

	public static function getProductsByCategory( $category )
	{
        if ($category==0)
        {
		    $sqlc = mysql_query( "SELECT * FROM `products` WHERE active=1 ORDER BY name ASC" ) or die( "ERROR: Get Products." );
		    if ($sqlc)
		    {
			    while ( $rowc[] = mysql_fetch_array( $sqlc ) ) { }
			    return $rowc;
		    }
        }
		$sqlc = mysql_query( "SELECT * FROM `products` WHERE category_id = '$category' AND active=1 ORDER BY name ASC" ) or die( "ERRO: Get Products by Categories" );
		if ($sqlc)
		{
			while ( $rowc[] = mysql_fetch_array( $sqlc ) ) { }
			return $rowc;
		}
		else
		{
			return 0;
		}
	}



	/*
     * Get the total number of products by category
     *
	 */

	public static function getNumberOfProductsByCategory( $category )
	{
        if ($category==0)
        {
		    $sqlnc = mysql_query( "SELECT COUNT(id) as total FROM `products` WHERE active=1" ) or die( "ERRO: Get Number of Products." );
		    if ($sqlnc)
		    {
			    while ( $rownc[] = mysql_fetch_array( $sqlnc ) ) { }
			    return $rownc;
		    }
        }
		$sqlnc = mysql_query( "SELECT COUNT(id) as total FROM `products` WHERE category_id = '$category' AND active=1" ) or die( "ERRO: Get Number of Products by Categories" );
		if ($sqlnc)
		{
			while ( $rownc[] = mysql_fetch_array( $sqlnc ) ) { }
			return $rownc;
		}
		else
		{
			return 0;
		}
	}


	/*
     * Get the total number of products
     *
	 */

	public static function getNumberOfProducts( )
	{
		try
		{
		    $sqlnc = mysql_query( "SELECT COUNT(id) as total FROM `products` WHERE active=1" );
		}
		catch (Exception $e)
		{
			    echo "Exce&ccedil;&atilde;o pega: ",  $e->getMessage(), "\n";
			    return FALSE;
		}
		if ($sqlnc)
		{
			return $rownc = mysql_fetch_array( $sqlnc );
		}
	}



	/*
     * Query the products by atributes
     *
	 */
	public static function getProductsByAtributes( $product_id, $groupby )
	{
		if ( $groupby == 1 )
		{
			$gb = " GROUP BY product_id ";
		}
		else
		{
			$gb = "";
		}

		$sqla = mysql_query( "SELECT * FROM `products_atributes` WHERE product_id = '$product_id' " . $gb ) or die( "ERRO: Get Products by Atributes" );
		if ($sqla)
		{
			while ( $rowa[] = mysql_fetch_array( $sqla ) ) { }
			return $rowa;
		}
		else
		{
			return 0;
		}
	}



	/*
     * Query wine list by ID
     *
	 */
	public static function getWineListByID( $wine_id )
	{
		$sqla = mysql_query( "SELECT * FROM `products_wine_list` WHERE id = '$wine_id'" ) or die( "ERRO: Get wine list fail." );
		if ($sqla)
		{
			while ( $rowa[] = mysql_fetch_array( $sqla ) ) { }
			return $rowa;
		}
		else
		{
			return 0;
		}
	}




	/*
     * Get the total number of products atributes
     *
	 */

	public static function getNumberOfProductsAtributes( $product_id )
	{
		$sqlnat = mysql_query( "SELECT COUNT(id) as total FROM `products_atributes` WHERE product_id = '$product_id'" ) or die( "ERRO: Get Number of Total Atributes" );
		if ($sqlnat)
		{
			while ( $rownat[] = mysql_fetch_array( $sqlnat ) ) { }
			return $rownat;
		}
		else
		{
			return 0;
		}
	}



	/*
     * Get the total number of categories
     *
	 */

	public static function getTotalNumberOfCategories( )
	{
		$sqlnat = mysql_query("SELECT COUNT(*) FROM `categories`") or die( "ERRO: Get Total Number of  Categories" );
		if ($sqlnat)
		{
			$num_rows = mysql_fetch_array($sqlnat);
			return $num_rows[0];
		}
		else
		{
			return 0;
		}
	}



       /*
	* Get complete list of products categories in a combo (mainly used in interfaces)
	*
	*/
	public static function getProductsCategory( $categ )
	{
		$res = mysql_query("SELECT id, name, short FROM categories ORDER BY id ASC");
		while ($ln = mysql_fetch_array($res))
		{
			if( $categ == $ln['id'] ) $sel = "selected"; else $sel = "";
			echo "<option value='$ln[id]' $sel>" . $ln['id'] . " - " . $ln['short'] . " - " . $ln['name'] . "</option>";
		}
	}



       /*
	* Get all status possible to use in admin interfaces to down an order!
	*
	*/

	public static function getAllOrdersStatus( $order_status_id )
	{
		$res = mysql_query("SELECT orders_status_id, orders_status_name FROM orders_status ORDER BY orders_status_name DESC");
		while ($ln = mysql_fetch_array( $res ))
		{

		      if ( $order_status_id == $ln[orders_status_id] ) { $sel = "selected";  } else { $sel = ""; }
		      echo "<option value='$ln[orders_status_id]' $sel>" . $ln['orders_status_name'] . "</option>";
		}
	}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////ADMIN/AREA////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	/*
	* Get complete list of countries in a combo (mainly used in interfaces)
	*
	*/
	public static function getCountries( $pais )
	{
	    if (!empty($pais))
	    {
		$res = mysql_query("set names 'utf-8'");
		$res = mysql_query("SELECT * FROM tb_paises");
		while ($ln = mysql_fetch_array($res))
		{
			if ($pais == $ln['id']) $sel="selected"; else $sel="";
			echo $opt = "<option value='" . $ln[id] . "'" . $sel . ">" . $ln['iso_code'] . ' - ' . $ln['nome'] . "</option>";
		}
	    }
	    else
	    {
		$res = mysql_query("set names 'utf-8'");
		$res = mysql_query("SELECT * FROM tb_paises");
		while ($ln = mysql_fetch_array($res))
		{
			echo $opt = "<option value='" . $ln[id] . "'>" . $ln['iso_code'] . ' - ' . $ln['nome'] . "</option>";
		}
	    }
	    //return $opt;
	}


	/*
	* Get complete list of brazilian states in a combo (mainly used in interfaces)
	*
	*/
	public static function getBrazilianStates( $uf )
	{
	    if (!empty($uf))
	    {
		$res = mysql_query("set names 'utf-8'");
			$res = mysql_query("SELECT nome, uf FROM tb_estados");
			while ($ln = mysql_fetch_array($res))
			{
				    if ($uf == $ln['uf']) $sel="selected"; else $sel="";
				echo $opt = "<option value='" . $ln[uf] . "'" . $sel . ">" . $ln['nome'] . "</option>";
			}
	    }
	    else
	    {
		$res = mysql_query("set names 'utf-8'");
			$res = mysql_query("SELECT nome, uf FROM tb_estados");
			while ($ln = mysql_fetch_array($res))
			{
				echo $opt = "<option value='" . $ln[uf] . "'>" . $ln['nome'] . "</option>";
			}
	    }
	    //return $opt;
	}



	/*
     * Get complete list of brazilian cities in a combo (mainly used in interfaces)
     *
	 */

	public static function getBrazilianCities( $id )
	{
        if (!empty($id))
        {
            $res = mysql_query("set names 'latin1'");
		    $res = mysql_query("SELECT id, nome FROM tb_cidades");
		    while ($ln = mysql_fetch_array($res))
		    {
                if ($ln['id'] == $id) { $sel="selected"; } else { $sel=""; }
			    echo $opt = "<option value='$ln[id]' $sel>".$ln['nome']."</option>";
		    }
        }
        else
        {
            $res = mysql_query("set names 'latin1'");
		    $res = mysql_query("SELECT id, nome FROM tb_cidades");
		    while ($ln = mysql_fetch_array($res))
		    {
			    echo $opt = "<option value='$ln[id]'>".$ln['nome']."</option>";
		    }
        }
    //return $opt;
	}



	/*
     * Insert company in database
     *
	 */

	public static function insert( )
	{
		if ($_POST)
		{
			$res = mysql_query("INSERT INTO `empresa` (`id`, `nome_fantasia`, `razao_social`, `endereco`, `numero`, `bairro`, `complemento`, `estado`, `cidade`, `cep`, `cnpj`, `ie`, `obs`, `tel1`, `tel2`, `resp1`, `resp2`, `fax`, `data`, `website`, `email`, `IM`, `cnae`, `crt`) VALUES (NULL, '$_REQUEST[nome_fantasia]', '$_REQUEST[razao_social]', '$_REQUEST[logradouro]', '$_REQUEST[numero]', '$_REQUEST[bairro]', '$_REQUEST[complemento]', '$_REQUEST[estado]', '$_REQUEST[atualiza]', '$_REQUEST[cep]', '$_REQUEST[cnpj]', '$_REQUEST[insc_estadual]', '$_REQUEST[obs]', '$_REQUEST[tel1]', '$_REQUEST[tel2]', '$_REQUEST[resp1]', '$_REQUEST[resp2]', '$_REQUEST[fax]', now(), '$_POST[website]', '$_POST[email]', '$_POST[IM]', '$_POST[cnae]', '$_POST[crt]')");
			if (!$res)
			{
				echo "<script>alert('Erro ao cadastrar dados da Empresa.');</script>";
				//exit;
			}
			else
			{
				//header("Location: index.php");
				echo "<div class='warning'>Empresa Cadastrada com sucesso.</div>";
				header( "Location: empresa_adm.php" );
			}
		}
	}



	/*
     * Query company by id
     *
	 */

	public static function getEmpresaById( $id )
	{
        $sqle = mysql_query("set names 'utf8'");
		$sqle = mysql_query("SELECT * FROM `empresa` WHERE `id` = '$id'") or die("ERROR: Get Company by ID");
		$rowe = mysql_fetch_array($sqle);

		// In case of table be modified this option is useless
		// $array_comp = $rowe;


		$array_comp = array(
			"nome_fantasia" => "".$rowe[nome_fantasia]."",
			"razao_social"  => "".$rowe[razao_social]."",
			"endereco"		=> "".$rowe[endereco]."",
			"numero"		=> "".$rowe[numero]."",
			"bairro"		=> "".$rowe[bairro]."",
			"complemento"	=> "".$rowe[complemento]."",
			"estado"		=> "".$rowe[estado]."",
			"cidade"		=> "".$rowe[cidade]."",
			"cep"			=> "".$rowe[cep]."",
			"cnpj"			=> "".$rowe[cnpj]."",
			"ie"			=> "".$rowe[ie]."",
			"obs"			=> "".$rowe[obs]."",
			"tel1"			=> "".$rowe[tel1]."",
			"cidade"		=> "".$rowe[cidade]."",
			"tel1"			=> "".$rowe[tel1]."",
			"tel2"			=> "".$rowe[tel2]."",
			"resp1"			=> "".$rowe[resp1]."",
			"resp2"			=> "".$rowe[resp2]."",
			"fax"			=> "".$rowe[fax]."",
			"website"		=> "".$rowe[website]."",
			"website_fb"	=> "".$rowe[website_fb]."",
			"gmap"			=> "".$rowe[gmap]."",
			"email"			=> "".$rowe[email]."",
			"logotipo"		=> "".$rowe[logotipo]."",
			"IM"			=> "".$rowe[IM]."",
			"cnae"			=> "".$rowe[cnae]."",
			"crt"			=> "".$rowe[crt]."",
			"abre"			=> "".$rowe[abre]."",
			"fecha"			=> "".$rowe[fecha]."",
			"frontend"		=> "".$rowe[frontend].""
		);
		return $array_comp;
	}



	/*
     * Query products and its attributes
     * Use of Join
	 */

    public static function getProductsById( $id )
    {
		$sql = mysql_query("set names 'latin1'");
        $sql = "SELECT p.id, p.category_id, p.product_code, p.image, p.active, c.name AS categ_name, c.short,
                pa.atributes, pa.recommended, pa.product_size, pa.price, pa.cupom_discount_code,
				p.name, p.description
                FROM products p
                INNER JOIN categories c ON c.id = p.category_id
                LEFT JOIN products_atributes pa ON pa.product_id = p.id
                WHERE p.id = '$id'";

        $result = mysql_query($sql) or trigger_error(mysql_error());
        $rowe    = mysql_fetch_array($result);

        $array_comp = array(
			"category_id"   => "".$rowe[category_id]."",
			"product_code"  => "".$rowe[product_code]."",
			"image"         => "".$rowe[image]."",
			"name"          => "".$rowe[name]."",
			"description"   => "".$rowe[description]."",
			"active"        => "".$rowe[active]."",
			"categ_name"    => "".$rowe[categ_name]."",
			"short"         => "".$rowe[short]."",
			"atributes"     => "".$rowe[atributes]."",
			"recommended"   => "".$rowe[recommended]."",
			"product_size"  => "".$rowe[product_size]."",
			"price"         => "".$rowe[price]."",
            "cupom_code"    => "".$rowe[cupom_discount_code].""
        );
        return $array_comp;
    }



   /*
	* Query the categories of products by ID (for updates)
	*
	*/
	public static function getCategoriesByID( $id )
	{
		$sqle = mysql_query( "SELECT * FROM `categories` WHERE id='$id'" ) or die( "ERRO: Get Categories by ID" );
		$rowe = mysql_fetch_array($sqle);
		$array_comp = array(
			"name"          => "".$rowe[name]."",
			"short"         => "".$rowe[short]."",
			"description"   => "".$rowe[description]."",
			"color"         => "".$rowe[color]."",
      "font_color"    => "".$rowe[font_color]."",
      "status"    => "".$rowe[status].""
		);
		return $array_comp;
	}



   /*
	* Query all gateways by ID
	*
	*/
	public static function getGatewaysByID( $id )
	{
		$sqle = mysql_query( "SELECT * FROM `gateways` WHERE id='$id'" ) or die( "ERRO: Get Gateways" );
		$rowe = mysql_fetch_array($sqle);
		$array_comp = array(
			"name"          => "" . $rowe[name] . "",
			"currency_code" => "" . $rowe[currency_code] . "",
			"business_id"   => "" . $rowe[business_id] . "",
			"return_url"    => "" . $rowe[return_url] . "",
			"notify_url"    => "" . $rowe[notify_url] . "",
			"useit"           => "" . $rowe[useit] . ""
		);
		return $array_comp;
	}



   /*
	* Get gateway data to use with payment
	*
	*/
	public static function getGatewayData( $name, $useit )
	{
		$sqle = mysql_query( "SELECT * FROM `gateways` WHERE name='$name' and useit=$useit " ) or die( "ERRO: Get Gateways" );
		$rowe = mysql_fetch_array($sqle);
		$array_comp = array(
			"name"          => "" . $rowe[name] . "",
			"currency_code" => "" . $rowe[currency_code] . "",
			"business_id"   => "" . $rowe[business_id] . "",
			"return_url"    => "" . $rowe[return_url] . "",
			"notify_url"    => "" . $rowe[notify_url] . "",
			"useit"         => "" . $rowe[useit] . ""
		);
		return $array_comp;
	}



       /*
	* Query pendings orders by ID
	*
	*/

	public static function getOrdersByID( $id )
	{
		$sqle = mysql_query( "SELECT * FROM `orders` WHERE order_id='$id'" ) or die( "ERRO: Get Orders by ID" );
		$rowe = mysql_fetch_array($sqle);
		$array_comp = array(
			"order_id"           => "".$rowe[order_id]."",
			"date_time"          => "".$rowe[date_time]."",
			"payment_method"     => "".$rowe[payment_method]."",
			"order_status_id"    => "".$rowe[order_status_id]."",
			"date_last_modified" => "".$rowe[date_last_modified].""
		);
		return $array_comp;
	}



       /*
	* Query orders by customer ID
	*
	*/

	public static function getOrdersByCustomer( $id )
	{
		$query = "SELECT orders.order_id, orders.date_time, payment_types.description, orders_status.orders_status_name "
				."FROM orders "
				."LEFT JOIN payment_types ON payment_types.id = orders.payment_method "
				."LEFT JOIN orders_status ON orders_status.orders_status_id = orders.order_status_id "
				."WHERE orders.customer_id='{$id}' ORDER BY orders.date_time DESC";

		$sqle = mysql_query( $query ) or die( "ERRO: Retrieve Orders." );
		while ( $rowe = mysql_fetch_array( $sqle ))
		{
			$array_comp[] = array(
				"order_id"           => "".$rowe[order_id]."",
				"date_time"          => "".$rowe[date_time]."",
				"payment_method"     => "".$rowe[description]."",
				"order_status_id"    => "".$rowe[orders_status_name].""
			);
		}
		return $array_comp;
	}


       /*
	* Query suppliers orders
	*
	*/

	public static function getSuppliersOrders( )
	{
		$query = "SELECT supplier_order.*, fornecedor.nome_fantasia, ingredients.name AS IngredName, fixed_assets.desc_item AS FixedAssets FROM `supplier_order` LEFT JOIN fornecedor ON fornecedor.id = supplier_order.supplier_id LEFT JOIN ingredients ON ingredients.id = supplier_order.item LEFT JOIN fixed_assets ON fixed_assets.id = supplier_order.item ORDER BY supplier_order.order_date DESC";

		$sqle = mysql_query( $query ) or die( "ERROR: Retrieve Orders." );
		while ( $rowe = mysql_fetch_array( $sqle ))
		{
			$array_comp[] = array(
				"supplier_name"      => "".$rowe[nome_fantasia]."",
				"order_id"           => "".$rowe[order_id]."",
				"date_time"          => "".$rowe[order_date]."",
				"item_type"          => "".$rowe[item_type]."",
				"item"               => $rowe[IngredName] . $rowe[FixedAssets],
				"qty"                => "".$rowe[qty]."",
				"unity"              => "".$rowe[unity]."",
				"price_unity"        => "".$rowe[price_unity]."",
				"payment_method"     => "".$rowe[payment_method]."",
				"status"             => "".$rowe[status].""
			);
		}
		return $array_comp;
	}



       /*
	* Query products orders by customer ID
	*
	*/

	public static function getProductsOrdersByCustomer( $id )
	{
		$query2 = "SELECT op.products_id, op.products_price, op.products_final_price, op.products_quantity, pa.product_id, p.name "
				. "FROM orders_products op "
				. "LEFT JOIN products_atributes pa ON pa.id = op.products_id "
				. "LEFT JOIN products p ON p.id = pa.product_id "
				. "WHERE op.orders_id = '{$id}'";
		$sqle2 = mysql_query( $query2 ) or die( "ERRO: Retrieve Orders Products." );
		while ( $rowe2 = mysql_fetch_array( $sqle2 ))
		{
			$array_comp2[] = array(
				"products_id"        	=> "".$rowe2[products_id]."", 				// ID do produto tbl products
				"product_name"        	=> "".$rowe2[name]."", 				// ID do produto tbl products
				"products_price"     	=> "".$rowe2[products_price]."",
				"products_quantity"  	=> "".$rowe2[products_quantity]."",
				"products_final_price" 	=> "".$rowe2[products_final_price].""
			);
		}
		return $array_comp2;

		# Clear the array
		#$array_comp2 = null;
	}





	/*
     * Query the last "id_transacao" from moip_nasp table
     *
	 */

	public static function getIdTransacaoMoipNasp( )
	{
		$sqle = mysql_query( "SELECT MAX(`id_transacao`) as idtrans FROM `moip_nasp`" ) or die( "ERRO: Get ID da transação MoIP NASP" );
		$rowe = mysql_fetch_array($sqle);
		$array_comp = array(
			"id_transacao" => "".$rowe[idtrans].""
		);
		return $array_comp;
	}



	/*
     *  Provide a default redirect
     */
	public static function Redirect($sec, $file)
	{
		if (!headers_sent())
		{
			header( "refresh:$sec;url=$file" );
		}
		else
		{
			echo '<noscript>';
			echo '<meta http-equiv="refresh" content="'.$sec.';url='.$file.'" />';
			echo '</noscript>';
			echo '<script type="text/javascript">';
			echo 'window.location="'.$file.'";';
			echo '</script>';
		}
	}



	/*
     * Query customer by id
     *
	 */

	public static function getCustomerById( $id )
	{
	    try
	    {
			$sqle = mysql_query("set names 'utf8'");
			$sqle = mysql_query("SELECT * FROM `customers` WHERE `id`='{$id}'");
	    }
	    catch (Exception $e)
	    {
			echo "Exceção pega: ",  $e->getMessage(), "\n";
			return FALSE;
	    }

	    $rowe = mysql_fetch_array($sqle);
	    $array_comp = array(
		    "id" => $rowe['id'],
		    "name" => $rowe['name'],
		    "valid_document" => $rowe['valid_document'],
		    "email" => $rowe['email'],
		    "birthday" => $rowe['birthday'],
		    "street" => $rowe['street'],
		    "number" => $rowe['number'],
		    "complement" => $rowe['complement'],
		    "suburb" => $rowe['suburb'],
		    "state" => $rowe['state'],
		    "town" => $rowe['town'],
		    "zipcode" => $rowe['zipcode'],
		    "phone_one" => $rowe['phone_one'],
		    "phone_two" => $rowe['phone_two'],
		    "registered_in" => $rowe['registered_in'],
		    "last_login" => $rowe['last_login']
	    );
	    return $array_comp;
	}



	/*
	 * Query town's name
	 *
	 */
	public static function getTownsNameById( $id )
	{
	    try
	    {
			$sqle = mysql_query("set names 'utf8'");
			$sqle = mysql_query("SELECT nome FROM `tb_cidades` WHERE `id`=$id");
	    }
	    catch (Exception $e)
	    {
			echo "Exceção pega: ",  $e->getMessage(), "\n";
			return FALSE;
	    }
	    return $town_name = mysql_fetch_array($sqle);
	}





    //-----------------------------------------------------
    // Método responsável por consultas especificas por campo e valor ou consulta genérica.
    // Parametros: SIM, $fieldsarray é um campos obrigatório pode receber um array com os campos desejados para consulta, ou todos usando *
    //                  $table é um campos obrigatório
    // 					$uniquefield é um campo opcional que pode receber o campo que deseja filtrar a consulta, se usar esse campo, então $uniquevalue
    //						passa a ser um campo obrigatório caso contrario não.
    //-----------------------------------------------------

    public static function mysql_select($fieldsarray, $table, $uniquefield, $uniquevalue)
    {
        //The required fields can be passed as an array with the field names or as a comma separated value string
        if(is_array($fieldsarray))
        {
            $fields = implode(", ", $fieldsarray);
        }
        else
        {
            $fields = $fieldsarray;
        }

	    //verify $uniquefield - if $uniquefield is empty then $uniquevalue is useless (do not need to verify)
	    if(!empty($uniquefield))
	    {
		    $where = " WHERE ".$uniquefield." = '".$uniquevalue."'";
	    }
	    else
	    {
		    $where = " ";
	    }

        //performs the query
        $result = mysql_query(" SELECT $fields FROM $table $where ") or die("Error: mysql_select " . mysql_error());

	    /* Esse fragmento requer revisão e testes */
	    $num_rows = mysql_num_rows($result);

        //if query result is empty, returns NULL, otherwise, returns an array containing the selected fields and their values
        if($num_rows == NULL)
        {
            return NULL;
        }
        else
        {
            $queryresult = array();
            $num_fields  = mysql_num_fields($result);
            $i = 0;
            while ($i < $num_fields)
            {
                $currfield = mysql_fetch_field($result, $i);
                $queryresult[$currfield->name] = mysql_result($result, 0, $currfield->name);
                $i++;
            }
            return $queryresult;
        }

	    /* exemplo de como usar o select

	    $fieldsarray = "*";     //ou especifique um array("id", "abertura", "fechamento", "observacao");
	    $uniquefield = "id";
	    $uniquevalue = $last_insert_id;
	    $userdata    = mysql_select($fieldsarray, $table, $uniquefield, $uniquevalue);
	    print_r($userdata);

	    exemplo de como usar o select */
    }



    //-----------------------------------------------------
    // Metodo reponsável por todas as inserções no banco de dados
    // A sanitização dos dados deve ser feita em /Model no respectivo arquivo
    //
    // Parametros: sim.
    //  $table -> recebe a tabela que deseja fazer o INSERT
    //  $inserts -> Um Array com todos os dados vindos do form
    //  Importante para $inserts: O nomes dos inputs do form devem respeitar os mesmos nomes dos campos da tabela
    //-----------------------------------------------------

    function mysql_insert($table, $inserts)
    {
		if ($_POST)
		{
	        $values = array_map( 'mysql_real_escape_string', array_values( $inserts ));
	        $keys   = array_keys( $inserts );
	        mysql_query('INSERT INTO `'.$table.'` (`'.implode('`,`', $keys).'`) VALUES (\''.implode('\',\'', $values).'\')') or die("Error: mysql_insert " . mysql_error());
            return mysql_insert_id();
        }
    }



    public static function insertOrders( $customer_id, $payment_method_id )
    {
		try
		{
			// First insert in orders table, and we get an Order ID  --- by default order_status_id starts with status pending
			mysql_query("INSERT INTO `orders` (`order_id`, `customer_id`, `date_time`, `payment_method`, `order_status_id`) VALUES (NULL, '$customer_id', CURRENT_TIMESTAMP, '$payment_method_id', '1')");
		}
		catch (Exception $e)
		{
			echo "Exceção pega: ",  $e->getMessage(), "\n";
			return FALSE;
		}
        return $orders_id = mysql_insert_id();
    }



    public static function insertOrderProducts( $arr_prod_order )
    {
        try
        {
            // Insert into order products
            $res = mysql_query("INSERT INTO `orders_products` (`id`, `orders_id`, `products_id`, `products_price`, `products_tax`, `products_final_price`, `products_quantity`) VALUES (NULL, '{$arr_prod_order['orders_id']}', '{$arr_prod_order['item_id']}', '{$arr_prod_order['item_price']}', '{$arr_prod_order['product_tax']}', '{$arr_prod_order['final_price']}', '{$arr_prod_order['quantity']}')");
        }
        catch (Exception $e)
        {
            echo "Exceção pega: ",  $e->getMessage(), "\n";
            return FALSE;
        }
        return $res;
    }



    public static function insertOrdersObservation( $array_oders_obs )
    {
		try
		{
			// First insert in orders table, and we get an Order ID
			mysql_query("INSERT INTO `orders_observations` ( `order_id`, `observation`, `scheduling`, `options`, `cupom`, `cupom_number` ) VALUES ('$array_oders_obs[orders_id]', '$array_oders_obs[observation_order]', '$array_oders_obs[data_agendamento]', '$array_oders_obs[options]', '$array_oders_obs[cupom]', '$array_oders_obs[cupom_numero]' )");
		}
		catch (Exception $e)
		{
			echo "Exceção pega: ",  $e->getMessage(), "\n";
			return FALSE;
		}
		return TRUE;
    }



	public static function insertInvoicesReceivable( $array_invoice )
	{
		try
		{
			$query = "INSERT INTO `invoices_receivable` (`id`, `customer_id`, `order_id`, `date`, `bill_date`, `due_date`,
					`paid_date`, `serv_desc`, `serv_qty`, `serv_rate`, `serv_amt`, `serv_tax`,
					`shipping`, `subtotal`, `salestax`, `discount`, `note`, `total`,
					`status`, `reference`, `company`, `insert_by`, `update_by`)
					VALUES (NULL, '{$array_invoice[customer_id]}', '{$array_invoice['orders_id']}', NOW(), NOW(), NOW(),
					'', '{$array_invoice['observation_order']}', 1, '{$array_invoice['totalPedido']}', 0.00, 'no',
					0.00, '{$array_invoice['observation_order']}', 0.00, '{$array_invoice['cupom_desconto']}', '{$array_invoice['observation_order']}', '{$array_invoice['total_with_discount']}',
					'pending', NULL, 1, 1, 0) ";
			mysql_query( $query );
		}
		catch (Exception $e)
		{
			echo "Exceção pega: ",  $e->getMessage(), "\n";
			return FALSE;
		}
		return TRUE;
	}



    public static function setPaymentType( $payment_method_id )
    {
		// Check what is the payment type
		if ( $payment_method_id == "payonreceive" )
			$payment_method_id = 1;	// 1 = cash
		elseif ( $payment_method_id == "paywithmoip" )
			$payment_method_id = 4;	// 4 = MoIP credit card --- Code 4 must be used to all types of gateway payment
		elseif ( $payment_method_id == "paywithpaypal" )
			$payment_method_id = 4;	// 4 = PayPal credit card --- Code 4 must be used to all types of gateway payment
		elseif ( $payment_method_id == "cash" )
			$payment_method_id = 1;	// 1 = cash --- the same as payonreceive
		elseif ( $payment_method_id == "tef" )
			$payment_method_id = 2;	// 2 = credit card
		else
			$payment_method_id = 1000;	// 1000 is equal to other type of payment not identified by the system or in case of error.

		return $payment_method_id;
    }


	/*
	* Grava dados dos ingredientes da ficha técnica
	*/
    public static function insertFactSheet( $prato, $item_value, $ingredient, $unit, $qup )
    {
		try
		{
			$sql = "INSERT INTO `factsheet` (`id`, `final_product`, `ingredient`, `unit`, `qup`, `vi`, `datetime`) "
				  ."VALUES (NULL, '{$prato}', '{$ingredient}', '{$unit}', '{$qup}', '{$item_value}', CURRENT_TIMESTAMP)";
			mysql_query( $sql );
		}
		catch (Exception $e)
		{
			echo "Exceção pega: ",  $e->getMessage(), "\n";
			return FALSE;
		}
		return TRUE;
    }


	/*
	* Grava o preço final de venda e todas as informações usadas para gerar o mesmo
	*/
	public static function insertSalePrice( $prato, $icms, $frete, $icsf, $iefsf, $icsf2, $iodsf, $pldsf, $vi, $pvu)
	{
		    try
		    {
			    $sql = "INSERT INTO `sale_price` (`id`, `product_id`, `shipping`, `contribution`, `financial_charges`, `icms`, `other_expenses`, `comissions`, `profit`, `cost_value`, `final_price`, `datetime`) "
				    . "VALUES (NULL, '{$prato}', '{$frete}', '{$icsf}', '{$iefsf}', '{$icms}', '{$iodsf}', '{$icsf2}', '{$pldsf}', '{$vi}', '{$pvu}', CURRENT_TIMESTAMP)";
			    mysql_query( $sql );
		    }
		    catch (Exception $e)
		    {
			    echo "Exceção pega: ",  $e->getMessage(), "\n";
			    return FALSE;
		    }
		    return TRUE;
	}


       /*
	* Get complete list of suppliers in a combo (mainly used in interfaces)
	*
	*/
	public static function getSuppliers( )
	{
		$res = mysql_query("SELECT f.id, f.nome_fantasia, tbp.nome AS countryName, tbc.nome AS cityName FROM fornecedor f LEFT JOIN tb_paises tbp ON tbp.id=f.pais LEFT JOIN tb_cidades tbc ON tbc.id=f.cidade ORDER BY f.nome_fantasia ASC");
		while ($ln = mysql_fetch_array($res))
		{
			echo "<option value='$ln[id]'>" . $ln['nome_fantasia'] . " - <i>" . $ln['countryName'] . ", " . $ln['cityName'] . "</ii></option>";
		}
	}


       /*
	* Get complete list of suppliers in a combo (mainly used in interfaces)
	*
	*/
	public static function getAccountingPlan( )
	{
		$res = mysql_query("SELECT id, categ, categ_name, code, name FROM invoices_chart_accounts WHERE active=1 ORDER BY categ ASC");
		while ($ln = mysql_fetch_array($res))
		{
			echo "<option value='$ln[id]'>" . $ln['categ'] . "|" . $ln['code'] . " - " . $ln['categ_name'] . " - " . $ln['name'] . "</option>";
		}
	}



   /*
	* Query pendings invoices payables
	*
	*/
	public static function getInvoicesPayableByID( $id )
	{
		$sqle = mysql_query( "SELECT * FROM `invoice_payable` WHERE id='$id'" ) or die( "ERRO: Get Invoice Payable by ID" );
		$rowe = mysql_fetch_array($sqle);
		$array_comp = array(
			"id"           		=> $rowe[id],
			"order_id"           	=> $rowe[order_id],
			"due_date"          	=> $rowe[due_date],
			"desc"     		=> $rowe[desc],
			"total"    		=> $rowe[total],
			"status" 		=> $rowe[status],
			"nota_fiscal" 		=> $rowe[nota_fiscal],
			"notes" 		=> $rowe[notes]
		);
		return $array_comp;
	}



   /*
	* Query pendings invoices receivables
	*
	*/
	public static function getInvoicesReceivableByID( $id )
	{
		$sqle = mysql_query( "SELECT * FROM `invoices_receivable` WHERE id='$id'" ) or die( "ERRO: Get Invoice Payable by ID" );
		$rowe = mysql_fetch_array($sqle);
		$array_comp = array(
			"id"           	=> $rowe[id],
			"order_id"      => $rowe[order_id],
			"due_date"      => $rowe[due_date],
			"desc"     		=> $rowe[desc],
			"total"    		=> $rowe[total],
			"status" 		=> $rowe[status],
			"nota_fiscal" 	=> $rowe[NF],
			"notes" 		=> $rowe[note]
		);
		return $array_comp;
	}


#############ROTINAS DO ESTOQUE#############

	/*
	 * Update Stock of Ingredients
	 *
	 */
	public static function setNewStockLevelIngredient( $order_status, $order_id )
	{
	    try
	    {
	        // IF ORDER_STATUS_ID EQUAL TO 13 OR Finalized THEN NEEDS TO UPDATE INGREDIENT'S STOK.
	        // PARAMETERS: ORDER_ID, ORDER_STATUS_ID
	        if ( $order_status == 13 )
	        {
	            $res2 = mysql_query( "SELECT orders_products.products_id, orders_products.products_quantity, products_atributes.product_id FROM orders_products INNER JOIN products_atributes ON products_atributes.id = orders_products.products_id WHERE orders_products.orders_id = '{$order_id}'" );
	            while ($row2 = mysql_fetch_array($res2))
	            {
	                $row2['products_id'];               // ID from products_atributes
	                $row2['product_id'];                // Real ID of product
	                $row2['products_quantity'];         // how many dish was sold?

	                $res3 = mysql_query("SELECT * FROM factsheet WHERE final_product = '{$row2['product_id']}'");
	                while ($row3 = mysql_fetch_array($res3))
	                {
	                    $row3['ingredient'];            // ingredient code
	                    $row3['qup'];                   // quantity used of this product
	                    $total_multiply = ($row2['products_quantity'] * $row3['qup']);     // $total_multiply = $row3['qup'] * $row2['products_quantity']
	                    echo '<br />Ingred.: ' . $row3['ingredient'] . ' Total: ' . $total_multiply;

	                    // Select the ingredient stock
	                    $res4 = mysql_query("SELECT stock_level FROM ingredients WHERE id='{$row3['ingredient']}' ");
	                    $row4 = mysql_fetch_array( $res4 );
	                    // new stock level is actual stock level minus total multiply of products quantity (Ex.: 2 dish) and qup(quantity used of product)
	                    $new_stock_level = ($row4['stock_level'] - $total_multiply);

	                    // Update stock of ingredients here
	                    $res5 = mysql_query("UPDATE ingredients SET stock_level='{$new_stock_level}' WHERE id='{$row3['ingredient']}' ");
	                }
	            }
	        }
	    }
	    catch (Exception $e)
	    {
			echo "Exce&ccedil;&atilde;o pega: ",  $e->getMessage(), "\n";
			return FALSE;
	    }
		return $res5;
	}

#############ROTINAS DO ESTOQUE#############


#############INTEGRACAO B2STOK#############
	/*
	* Create Orders in b2stok database
	* Cria pedido nas tabelas do banco b2stok
	* Os pedidos feitos via web serão armazenados em 2 bases distintas, sendo a primeira base (Base Web-Frontend) armazena os pedidos do cliente.
	* A segunda base (B2Stok Retaguarda) armazena os dados do pedido, nota fiscal, pagamentos, etc.. são 8 tabelas ao todo. Isso é necessario
	*  caso precise emitir NF para clientes PJ ou qualquer situação onde precise emitir NF.
	*
	* Observação Importante: O numero do PEDIDO precisa obrigatoriamente ser o mesmo em ambas as bases de dados. Ex.: Pedido feito no Frontend da WEB,
	*  precisa gravar o ID do Pedido exatamente igual na base de retaguarda e vice-versa. Caso isso não ocorrer com sucesso, a base vai estar corrompida
	*  e as informações podem ser perdidas.
	*
	*/
	public static function b2stokOrders( $mysqli, $orders_id, $totalPedido, $arr_customer )
	{
		/* INSERT NOTA CABEÇALHO */
		$sql1 = "INSERT INTO nota_cabecalho (`cod_pedido`, `razao_social`, `endereco`, `bairro`, `cep`, `cidade`, `estado`, `telefone`, `cnpj`, `insc_estadual`) "
				."VALUES ('{$orders_id}', '{$arr_customer['name']}', '{$arr_customer['street']} {$arr_customer['number']}', '{$arr_customer['suburb']}', '{$arr_customer['zipcode']}', '{$arr_customer['town']}', '{$arr_customer['state']}', '{$arr_customer['phone_one']}', '{$arr_customer['valid_document']}', '')";

		$sql11 = "INSERT INTO `notas` (`cod_pedido`, `user_id`, `formulario`, `tipo_nota`, `data`, `nat_operacao`, `cfop`, `valor_total_nota`, `valor_total_prod`, `valor_frete`, `valor_seguros`, `base_icms`, `base_icms_sub`, `valor_icms`, `valor_icms_sub`, `valor_ipi`, `valor_outros`, `ind_icms_outros`, `uso_merc`, `data_saida`, `hora_saida`, `situacao_cancela`, `obs`, `vendedor`, `futura`, `finalizado`) "
				."VALUES ('{$orders_id}', NULL, NULL, 'saida', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'N', NULL, '0', NULL, NULL)";

		/* UPDATE NOTAS */
		$sql2 = "UPDATE notas SET user_id='{$arr_customer['id']}', formulario='', tipo_nota='', data=NOW(), nat_operacao='', cfop='', valor_total_nota='{$totalPedido}', valor_total_prod='{$totalPedido}', valor_frete='0', valor_seguros='', base_icms='', base_icms_sub='', valor_icms='', valor_icms_sub='', valor_ipi='', valor_outros='0.00', ind_icms_outros='', uso_merc='', data_saida=NOW(), hora_saida='', situacao_cancela='', obs='', futura='', vendedor='' WHERE cod_pedido='{$orders_id}'";

		/* INSERT RECEBER */
		$sql3 = "INSERT INTO receber (fiscal, data_c, data_v, valor, saldo, descr, codorigem, codplacon, obs, vendedor, comissao, codsaidas) "
				."VALUES ('PP2C', NOW(), NOW(), '{$totalPedido}', '{$totalPedido}', 'VENDA EM DINHEIRO', '{$arr_customer['id']}', '1.1.1', 'CODIGO {$orders_id}', 1, 0, '{$orders_id}')";

		/* INSERT MOVPAGAMENTOS */
		$sql4 = "INSERT INTO movpagamentos (codorigem, tipo, nnf, codmeiopgto, meio, valor, data, data_c, codformapgto) "
				."VALUES ('{$orders_id}','S','P2C', '2', 'DINHEIRO', '{$totalPedido}', NOW(), NOW(), '1')";

		/* UPDATE NOTAS */
		$sql5 = "UPDATE notas SET finalizado='S', data_saida=NOW() WHERE cod_pedido='{$orders_id}'";

		/* INSERT NOTA PAULISTA */
		$sql6 = "INSERT INTO nota_paulista (`indice_nota_paulista`, `formulario`, `cpf_cnpj`, `enviar`, `enviado`) VALUES ('', '', '{$arr_customer['valid_document']}', '0', '0')";

		try
		{
			/* Executar a query */
			if (!$mysqli->query( $sql1 ) || !$mysqli->query( $sql11 ) || !$mysqli->query( $sql2 ) || !$mysqli->query( $sql3 ) || !$mysqli->query( $sql4 ) || !$mysqli->query( $sql5 ) || !$mysqli->query( $sql6 ))
			{
				echo "Query Fail: INSERT BACKEND B2STOK ORDERS: (" . $mysqli->errno . ") " . $mysqli->error;
			}
		}
		catch (Exception $e)
		{
			echo "Exceção pega: ",  $e->getMessage(), "\n";
			return FALSE;
		}
		return TRUE;
	}

	public static function b2stokOrdersNotaFiscal( $mysqli, $count, $arr_prod_order )
	{
		/* QUERY INSERT NOTA ITENS */
		$sql1 = "INSERT INTO nota_itens (cod_pedido, nota_item, cod_produto, descricao, class_fiscal, sit_trib, unidade, quantidade, preco_unit, total_item, ipi, icms, redus_icms, prazo) "
				."VALUES('{$arr_prod_order['orders_id']}', '{$count}', '{$arr_prod_order['item_id']}', '', '23', '4', 'KG', '{$arr_prod_order['quantity']}', '{$arr_prod_order['item_price']}', '{$arr_prod_order['final_price']}', 0.00, 17.000, 0.000, '')";

		/* UPDATE PRODUTOS SET ESTOQUE */
		$sql2 = "UPDATE produtos SET estoque='-{$arr_prod_order['quantity']}', ultima_venda=NOW() WHERE cod_produto={$arr_prod_order['item_id']}";

		try
		{
			/* Executar a query */
			if (!$mysqli->query( $sql1 ) || !$mysqli->query( $sql2 ))
			{
				echo "Query Fail: INSERT BACKEND B2STOK NOTA FISCAL: (" . $mysqli->errno . ") " . $mysqli->error;
			}
		}
		catch (Exception $e)
		{
			echo "Exceção pega: ",  $e->getMessage(), "\n";
			return FALSE;
		}
		return TRUE;
	}

	# AVISO: MUITO CUIDADO AO USAR ESSE METODO --- APENAS PARA TESTES DE INSTALAÇÂO
	public static function b2stokTruncateOrders( $mysqli )
	{
		$sql1 = "TRUNCATE TABLE `nota_cabecalho`";
		$sql2 = "TRUNCATE TABLE `notas`";
		$sql3 = "TRUNCATE TABLE `receber`";
		$sql4 = "TRUNCATE TABLE `movpagamentos`";
		$sql5 = "TRUNCATE TABLE `nota_paulista`";
		$sql6 = "TRUNCATE TABLE `nota_itens`";

		try
		{
			/* Executar a query */
			if (!$mysqli->query( $sql1 ) || !$mysqli->query( $sql2 ) || !$mysqli->query( $sql3 ) || !$mysqli->query( $sql4 ) || !$mysqli->query( $sql5 ) || !$mysqli->query( $sql6 ))
			{
				echo "QUERY FAIL: TRUNCATE BACKEND B2STOK ORDERS: (" . $mysqli->errno . ") " . $mysqli->error;
			}
		}
		catch (Exception $e)
		{
			echo "Exceção pega: ",  $e->getMessage(), "\n";
			return FALSE;
		}
		return TRUE;
	}
#############INTEGRACAO B2STOK#############





#######################PCS-PERSONAL_CHEF_SERVICE#############################

	/*
	 * Query PCS TABLE
	 * Param: Order ID - it is an 32 chars string md5()
	 */
	public static function getPCSOrdersByOrderId( $order_id )
	{
	    try
	    {
		  $sqle = mysql_query("set names 'utf8'");
		  $sqle = mysql_query("SELECT * FROM `pcs_orders` WHERE `order_id`='{$order_id}' ");
	    }
	    catch (Exception $e)
	    {
		  echo "Exceção pega: ",  $e->getMessage(), "\n";
		  return FALSE;
	    }
	    return $pcs_orders = mysql_fetch_array( $sqle );
	}



	public static function updateOrdersPCS( $order_id_pcs, $orders_id )
	{
		/* UPDATE ORDERS PERSONAL CHEF SERVICE --- IT WILL INDEX COMMON ORDERS WITH PCS ORDERS */
		$query = "UPDATE pcs_orders SET delivery_orders_id='{$orders_id}' WHERE order_id='{$order_id_pcs}' ";
		try
		{
		      //$mysqli->query( $query );
		      mysql_query( $query );
		}
		catch (Exception $e)
		{
		      echo "Exceção pega: ",  $e->getMessage(), "\n";
		      return FALSE;
		}
		return TRUE;
	}





 }
