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
  </head>
  <body>
  
      <div class="content">
		<div class="hero-unit">
          <h1>Ficha Técnica</h1>
          <p>Ficha Técnica de Produção - Selecione o prato abaixo.</p>
        </div>
		<table class="zebra-striped">
			<tr>
				<td><b>Produto (Prato)</b></td>
				<td><b>Incidências SUM(%)</b></td>
				<td><b>Preço de Custo</b></td>
				<td><b>Preço Final</b></td> 
				<td><b>Data do Registro</b></td>
			</tr>
			<?php include("../model/print-factsheet-select.php"); ?>
		</table> 
		<? include("../footer.php"); ?>
      </div>
  </body>
</html>
