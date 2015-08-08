<?php require("../bootstrap-admin.php");defined('SYSPATH_ADMIN') or die('No direct script access.');?>
﻿<!DOCTYPE html>
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
	  <h1>Ficha T&eacute;cnica & Receitas</h1>
	</div>
	<!-- Example row of columns -->
	<div class="row">
	  <div class="span8">
		<h2>CADASTRAR FICHA T&Eacute;CNICA</h2>
		<p> <ul>
			<li>Cadastrar Pre&ccedil;o Final de Venda</li>
			<li>Cadastrar Ficha T&eacute;cnica </li>
			</ul>
		</p>
		<p><a class="btn" href="gen-sale-price.php">Abrir Interface &raquo;</a></p>
	  </div>
	  <div class="span6">
		<h2>IMPRIMIR FICHA T&Eacute;CNICA</h2>
		<p> Imprimir/Consultar Ficha T&eacute;cnica.</p>
		<p><a class="btn" href="javascript:abrir('1024','600','print-factsheet-select.php');">Imprimir Ficha T&eacute;cnica &raquo;</a></p>		
	  </div>
	</div>

	<div class="row"><div class="span14"><hr /></div></div>

	<!-- Example row of columns -->
	<div class="row">
	  <div class="span8">
		<h2>CADASTRAR RECEITAS</h2>
		<p> Cadastro de Receitas. </p>
		<p><a class="btn" href="recipe-insert.php">Abrir Interface &raquo;</a></p>
	  </div>
	  <div class="span6">
		<h2>LISTA DE RECEITAS</h2>
		<p> Imprimir/Consultar Receitas.</p>
		<p><a class="btn" href="javascript:abrir('1024','600','recipe-select.php');">Imprimir Receitas &raquo;</a></p>		
	  </div>
	</div>

    <?php include("../footer.php"); ?>

	</div>
    </div>

  </body>
</html>
