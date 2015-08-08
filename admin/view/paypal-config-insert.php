<?php require("../bootstrap-admin.php");
defined('SYSPATH_ADMIN') or die('No direct script access.');
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
	  <h1>Cadastro de Contas do PayPal</h1>
	  <p>Cadastre aqui todas as contas paypal da empresa.</p>
	</div>	  
	<div class="row">
	<div class="span15">
	<table class="zebra-striped">
		<form method="post" action="../model/paypal-config-insert.php">
            <input type='hidden' value='1' name='submitted' />
			<tr><td align="right">&nbsp;</td><td></td></tr>
			<tr><td align="right"></td><td><h3>Formul&aacute;rio de Cadastro</h3></td></tr>
			<tr><td align="right">&nbsp;</td><td></td></tr>
			<tr><td align="right">Nome</td><td><input type="text" maxlength="64" name="name" size="20" /></td></tr>
			<tr><td align="right">C&oacute;digo da Moeda</td>
			<td>
				<select name="currency_code">
					<option value="">[Escolha]</option>
					<option value="BRL">BRL</option>
					<option value="USD">USD</option>
					<option value="EUR">EUR</option>
					<option value="THB">THB</option>
				</select>
			</td></tr>
			<tr><td align="right">ID do Neg&oacute;cio (Geralmente um email)</td><td><input type="text" maxlength="255" name="email" size="20" /></td></tr>
			<tr><td align="right">URL de Retorno</td><td>
			<input type="text" maxlength="255" name="return_url" size="20"  </td></tr>
			<tr><td align="right">URL de Notifica&ccedil;&atilde;o</td><td>
			<input type="text" maxlength="255" name="notify_url" size="20" value="" /> </td></tr>
			<tr><td colspan="2">&nbsp; </td></tr>
			<tr><td colspan="2" align="center"><input type='submit' value="Cadastrar Conta" name="" class="btn" /></td></tr>
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
