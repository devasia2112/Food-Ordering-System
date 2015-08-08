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
          <h1>Consulta de Produtos</h1>
          <p>Abaixo segue a listagem de todos os produtos comercializados pela empresa.</p>
        </div>	             
            <table class="zebra-striped">
            <tr>
                <td><b>C&oacute;digo</b></td>
                <td><b>Foto</b></td>
                <td><b>Nome</b></td> 
                <td><b>Descri&ccedil;&atilde;o</b></td>
                <td><b>Ativo</b></td>
                <td><b>Categoria</b></td>
                <td><b>Spicy</b></td>
                <td><b>Recomendado</b></td>
                <td><b>Tamanho</b></td>
                <td><b>Pre&ccedil;o</b></td>
                <td><b>A&ccedil;&atilde;o</b></td>
            </tr>
              <?php include("../model/products-select.php"); ?>
            </table> 
            <p><a class='btn' href='products-insert.php'>Cadastrar Produto &raquo;</a></p>
            <? include("../footer.php"); ?>
      </div>
  </body>
</html>
