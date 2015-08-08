<?php require("../bootstrap-admin.php");
defined('SYSPATH_ADMIN') or die('No direct script access.');

require "../../includes/config/config.php";
include "../../includes/Sql/sql.class.php";
include "../../includes/data.php";

$arrayOrders 	= GenericSql::getSuppliersOrders( );
?><!DOCTYPE html>
<html lang="en">
  <head>
    <title>...</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!-- Le styles -->
    <link href="../bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
      }
    </style>
    <script language="JavaScript">
    function abrir(w,h,URL)
    {
      var width = w;
      var height = h;      
      var left = (screen.width/2)-(w/2);
      var top = (screen.height/2)-(h/2);    
      window.open(URL,'janela', 'width='+width+', height='+height+', top='+top+', left='+left+', scrollbars=yes, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=no');
    }
    </script>
  </head>
  <body>
    <?php include("../menu.php"); ?>
      <div class="content">
		<div class="hero-unit">
          <h1>Hist&oacute;rico de Pedidos</h1>
          <p>Abaixo segue a listagem de todos os pedidos para fornecedores feitos no sistema.</p>
        </div>

	    <?php
	    //echo "<pre>";print_r( $arrayOrders );echo "</pre>";
	    echo "<table class='condensed-table' width='100%'>";
	    echo "<tr bgcolor='#CCC'>
		    <td><b>#ID Pedido</b></td>
		    <td><b>Data</b></td>
		    <td><b>Fornecedor</b></td>
		    <td><b>Tipo Item</b></td>
		    <td><b>Item</b></td>
		    <td><b>Qtde.</b></td>
		    <td><b>Unid.Medida</b></td>
		    <td><b>Valor Unitario</b></td>
		    <td><b>Método Pagamento</b></td>
		    <td><b>Status Pedido</b></td>
		    <td>&nbsp;</td>
		  </tr>";
	    foreach ( $arrayOrders as $arrayOrders ) {
		    echo "<tr>";
		    echo "<td>{$arrayOrders[order_id]}</td>";
		    echo "<td>" . mysql_datetime_para_humano($arrayOrders[date_time]) . "</td>";
		    echo "<td>{$arrayOrders[supplier_name]}</td>";
		    echo "<td>{$arrayOrders[item_type]}</td>";
		    echo "<td>{$arrayOrders[item]}</td>";
		    echo "<td>{$arrayOrders[qty]}</td>";
		    echo "<td>{$arrayOrders[unity]}</td>";
		    echo "<td>{$arrayOrders[price_unity]}</td>";
		    echo "<td>{$arrayOrders[payment_method]}</td>";
		    echo "<td>{$arrayOrders[status]}</td>";
		    //$arrayProductsOrders = GenericSql::getProductsOrdersByCustomer( $orderID[order_id] );
		    
		    echo "</tr>";
	    }
	    echo "</table>";
	    ?>
            
            
            <?php include("../footer.php"); ?> 
      </div>
  </body>
</html>