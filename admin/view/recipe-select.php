<?php require("../bootstrap-admin.php");defined('SYSPATH_ADMIN') or die('No direct script access.');?>﻿
<!DOCTYPE html>
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
          <h1>Listagem de Receitas</h1>
          <p>Escolha a receita da lista para pode visualizar ou imprimir.</p>
        </div>
		<table class="zebra-striped">
			<tr>
				<td><b>Nome da Receita</b></td>
				<td><b>Chef Responsável</b></td>
				<td><b>Contato do Chef</b></td>
				<td><b>Ação</b></td>
			</tr>
			<?php include("../model/recipe-select.php"); ?>
		</table> 
		<?php include("../footer.php"); ?>
      </div>
  </body>
</html>
