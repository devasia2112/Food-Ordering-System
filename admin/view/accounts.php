<?php require("../bootstrap-admin.php");
defined('SYSPATH_ADMIN') or die('No direct script access.');
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
	<!-- Main hero unit for a primary marketing message or call to action -->
	<div class="hero-unit">
	  <h1>Contas (Receitas & Despesas)</h1>
	</div>
	<!-- Example row of columns -->
	<div class="row">
	  <div class="span5">
		<h2>Plano de Contas</h2>
		<p>Cadastro do plano de contas</p>
		<p><a class="btn" href="">Cadastrar Plano de Contas &raquo;</a></p>
		<p><a class="btn" href="#">Consultar Plano de Contas &raquo;</a></p>
	  </div>
	  <div class="span5">
		<h2>Contas a Receber</h2>
		<p>Listagem geral de contas a receber --- NESTA PARTE FICOU PENDENTE APENAS A VISUALIZACAO DE CONTAS A RECEBER RECEBIDAS(PAGAS)  ---- P/ CONSULTAR CONTAS PAGAS RODAR QUERY NA TABELA invoices_receivable </p>
		<p><a class="btn" href="accounts-receivable.php">Contas a Receber (PENDENTES) &raquo;</a></p>
		<p><a class="btn" href="">Contas a Receber (PAGAS) &raquo;</a></p>
	  </div>
	  <div class="span5">
		<h2>Contas a Pagar</h2>
		<p>Listagem geral de contas a Pagar com status: pendente e pago</p>
		<p><a class="btn" href="accounts-payable.php">Contas a Pagar (PENDENTES) &raquo;</a></p>
		<p><a class="btn" href="accounts-payable-paid.php">Contas a Pagar (PAGAS) &raquo;</a></p>
	  </div>
	</div>
	<hr>

    <? include("../footer.php"); ?>

	</div>
    </div>

  </body>
</html>
