<?php require("../bootstrap-admin.php"); //session_start();print"<pre>";print_r($_SESSION);print"</pre>";
defined('SYSPATH_ADMIN') or die('No direct script access.');
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">  	
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
	<!-- Main hero unit for a primary marketing message or call to action -->
	<div class="hero-unit">
	  <h1>Credito com fornecedores</h1>
	  <p> A lista de creditos abaixo deve ser atualizada toda vez que um novo pedido for feito. Observar os credito disponiveis com alguns fornecedores antes de efetuar pedido.</p>
	</div>
	<!-- Example row of columns -->
	<div class="row">
	  <div class="span16">
		<h2>Pedido: 5fa2bc6d5cd7a17bd46fb41fa1a261d1 </h2>
		<p>Fornecedor: TOWA (Sao Paulo - Liberdade) </p>
		<p>Credito de R$ 420,00 pago na compra de NF numero: 000.023.131. Compra feito em: 12/12/2013 </p>
		<p><a class="btn" href="accounts-payable-paid-detail.php?id=47">Ver detalhes da fatura &raquo;</a></p>
	  </div>
	</div>

	</div>
	<footer>
	  <p>&copy; Company 2012</p>
	</footer>
	</div>
    </div>

  </body>
</html>
