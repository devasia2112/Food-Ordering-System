<?php
require("../bootstrap-admin.php");
defined('SYSPATH_ADMIN') or die('No direct script access.');
require('../../includes/config/config.php');
require('../../includes/Sql/sql.class.php');
$id = $_GET['id'];
//session_start();
?>﻿<!DOCTYPE html>
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
	  <h1>Atualizar Contas PayPal</h1>
	  <p>Atualize as informações da conta do PayPal.</p>
	</div>	  
	<div class="row">
	<div class="span15">
	<table class="zebra-striped">
        <?php 
		$array_comp = GenericSql::getGatewaysByID( $id ); 
		if( $array_comp['useit']==1 ) $chk="checked"; else $chk=""; 
		if( $array_comp['currency_code']=="BRL" ) $brl="selected"; else $brl="";
		if( $array_comp['currency_code']=="USD" ) $usd="selected"; else $usd="";
		if( $array_comp['currency_code']=="EUR" ) $eur="selected"; else $eur="";
		if( $array_comp['currency_code']=="THB" ) $thb="selected"; else $thb="";
		?>
		<form method="post" action="../model/paypal-config-update.php">
            <input type='hidden' value='1' name='submitted' />
            <input type="hidden" value="<?=$id;?>" name="id" />
			<tr><td align="right">&nbsp;</td><td></td></tr>
			<tr><td align="right"></td><td><b>Dados da Conta </b></td></tr>
			<tr><td align="right">&nbsp;</td><td></td></tr>
			<tr><td align="right">Nome</td><td><input type="text" maxlength="64" name="name" size="20" value="<?=$array_comp['name'];?>" /></td></tr>
			<tr><td align="right">Codigo da Moeda</td><td> 

				<select name="currency_code">
					<option value="">[Escolha]</option>
					<option value="BRL" <?php echo $brl;?> >BRL</option>
					<option value="USD" <?php echo $usd;?> >USD</option>
					<option value="EUR" <?php echo $eur;?> >EUR</option>
					<option value="THB" <?php echo $thb;?> >THB</option>
				</select>

			</td></tr>
			<tr><td align="right">ID do Negocio (email)</td><td> <input type="text" maxlength="255" name="business_id" size="255" value="<?=$array_comp['business_id'];?>" /> </td></tr>
			<tr><td align="right">URL de Retorno</td><td>
			<input type="text" maxlength="6" name="return_url" size="255" value="<?=$array_comp['return_url'];?>" /> </td></tr>
			<tr><td align="right">URL de Notificacao</td><td>
			<input type="text" maxlength="6" name="notify_url" size="255" value="<?=$array_comp['notify_url'];?>" /> </td></tr>
			<tr><td align="right">Usar?</td><td>
			<input type="checkbox" name="useit" value="1" <?php echo $chk; ?> /> </td></tr>
			<tr><td colspan="2">&nbsp; </td></tr>
			<tr><td colspan="2" align="center"><input type='submit' value="Editar Conta" class="btn success" /></td></tr>
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
