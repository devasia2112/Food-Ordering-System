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
	  <h1>Atualizar/Baixar Fatura</h1>
	  <p>Area exclusiva para baixas de faturas pendentes.</p>
	</div>
	<div class="row">
	<div class="span15">
	<table class="zebra-striped">
        <?php $array_comp = GenericSql::getInvoicesReceivableByID( $id ); ?>
	  <form method="post" action="../model/accounts-receivable-update.php">
	      <input type='hidden' value='1' name='submitted' />
	      <input type="hidden" value="<?=$array_comp['order_id'];?>" name="hash_order" />
	      <input type="hidden" value="<?=$id;?>" name="id" />
		  <tr><td align="right">&nbsp;</td><td></td></tr>
		  <tr><td align="right"></td><td><b>Dados Parcial da fatura </b></td></tr>
		  <tr><td align="right">&nbsp;</td><td></td></tr>
		  <tr><td align="right">#Fatura</td><td><input type="text" maxlength="20" name="orderid" size="20" value="<?=$array_comp['id'];?>" readonly /></td></tr>
		  <tr><td align="right">#Pedido</td><td><input type="text" maxlength="20" name="orderid" size="20" value="<?=$array_comp['order_id'];?>" readonly /></td></tr>
		  <tr><td align="right">Data Vencimento</td><td><input type="text" maxlength="14" name="date_time" size="20" value="<?=$array_comp['due_date'];?>" readonly /></td></tr>
		  <tr><td align="right">Total</td><td><input type="text" maxlength="14" name="pagto" size="20" value="<?=$array_comp['total'];?>" readonly /></td></tr>
		  <tr><td align="right">Status</td><td><input type="text" maxlength="14" name="pagto" size="20" value="<?=$array_comp['status'];?>" readonly /></td></tr>
		  <tr><td align="right">Notas</td><td><input type="text" maxlength="14" name="pagto" size="20" value="<?=$array_comp['notes'];?>" readonly /></td></tr>
		  
		  <tr><td align="right"> <hr /> </td><td> <hr /> </td></tr>
		  
		  <tr><td align="right">Empresa</td><td>
		      <select name="company_id">
			<option value="#">SELECIONE A EMPRESA</option>
			<option value="1">1</option>
			<option value="2">2</option>
		      </select></td></tr>
		  <tr><td align="right">Novo Status</td><td>
		      <select name="status">
			<option value="#">SELECIONE O STATUS</option>
			<option value="paid">PAGO</option>
			<option value="terminated">RESCINDIDO</option>
			<option value="draft">RASCUNHO</option>
			<option value="due">VENCIDO</option>
			<option value="pending">PENDENTE</option>
		      </select></td></tr>
		  <tr><td align="right">Nota Fiscal</td><td><input type="text" maxlength="64" name="nota_fiscal" size="20" value="<?=$array_comp['nota_fiscal'];?>" /></td></tr>
		  <tr><td align="right">Notas</td><td><textarea name="notas" class="span10"><?=$array_comp['notes'];?></textarea></td></tr>
		  <tr><td colspan="2">&nbsp; </td></tr>
		  <tr><td colspan="2" align="center"><input type='submit' value="Baixar Fatura" class="btn success" /></td></tr>
	  </form>
	</table>
	</div>
	</div>
        <?php include("../footer.php"); ?>
	</div>
    </div>
	    <script type="text/javascript" src="../../scripts/jscolor/jscolor.js"></script>
  </body>
</html>
