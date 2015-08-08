<?php
require("../bootstrap-admin.php");
defined('SYSPATH_ADMIN') or die('No direct script access.');
require('../../includes/config/config.php');
require('../../includes/Sql/sql.class.php');
$id = $_GET['id'];
session_start();
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
  </head>
  <body>
    <?php include("../menu.php"); ?>
	<div class="content">
	<div class="hero-unit">
	  <h1>Atualizar/Baixar Pedido</h1>
	  <p>Area exclusiva para Atualiza&ccedil;&atilde;o de pedidos pendentes.</p>
	</div>	  
	<div class="row">
	<div class="span15">
	<table class="zebra-striped">
        <?php $array_comp = GenericSql::getOrdersByID( $id ); ?>
	  <form method="post" action="../model/orders-update.php">
	      <input type='hidden' value='1' name='submitted' />
	      <input type="hidden" value="<?=$id;?>" name="id" />
			  <tr><td align="right">&nbsp;</td><td></td></tr>
			  <tr><td align="right"></td><td><b>Dados do Pedido </b></td></tr>
			  <tr><td align="right">&nbsp;</td><td></td></tr>
			  <tr><td align="right">ID do Pedido</td><td><input type="text" maxlength="20" name="orderid" size="20" value="<?=$array_comp['order_id'];?>" readonly /></td></tr>
			  <tr><td align="right">Data e Hora</td><td><input type="text" maxlength="14" name="date_time" size="20" value="<?=$array_comp['date_time'];?>" readonly /></td></tr>
			  <tr><td align="right">Pagamento</td><td><input type="text" maxlength="14" name="pagto" size="20" value="<?=$array_comp['payment_method'];?>" readonly /></td></tr>
			  <tr><td align="right">Status</td><td><select name="status"> <?=GenericSql::getAllOrdersStatus( $array_comp['order_status_id'] );?> </select></td></tr>
			  <tr><td colspan="2">&nbsp; </td></tr>
			  <tr><td colspan="2" align="center"><input type='submit' value="Atualizar Pedido" class="btn success" /></td></tr>
			  <!-- FIM DADOS DA EMPRESA -->
	  </form>
	</table>
	</div>
	</div>
        <? include("../footer.php"); ?>
	</div>
    </div>
	    <script type="text/javascript" src="../../scripts/jscolor/jscolor.js"></script>
  </body>
</html>