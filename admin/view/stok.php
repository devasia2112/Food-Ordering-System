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
	<!-- Main hero unit for a primary marketing message or call to action -->
	<div class="hero-unit">
	  <h1>Ingredientes (Item)</h1>
	</div>
	<!-- Example row of columns -->
	<div class="row">
	  <div class="span10">
		<h2>CADASTRAR ESTOQUE DE INGREDIENTES</h2>
		<p>O Cadastro de estoque de ingredientes é fundamental para o controle exato do estoque, toda vez que um prato for elaborado e vendido via PDV ou Web, a baixa no estoque de ingredientes vai ocorrer automaticamente, evitando assim aquele procedimento diario de checagem de estoque feito pelo pessoal da cozinha, sobrando tempo para outras atividades. </p>
		<p><a class="btn" href="stok-insert.php">Cadastrar Ingrediente &raquo;</a></p>
	  </div>
	  <div class="span8">
		<h2>CONSULTAR ESTOQUE INGREDIENTES</h2>
		<p>Lista todos os ingredientes usados nos pratos e produtos usados na revenda (Ex.: Garrafas: Vinhos, Cervejas, Sucos, Refrigerantes, etc..)</p>
		<p><a class="btn" href="stok-select.php">Consultar Estoque Ingredientes &raquo;</a></p>
	  </div>
	</div>

    <? include("../footer.php"); ?>

	</div>
    </div>

  </body>
</html>
