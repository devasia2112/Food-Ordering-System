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
		<div class="hero-unit">
          <h1>Consulta de Ingredientes</h1>
          <p>Abaixo segue a listagem completa de todos os ingredientes usados nos pratos dos cardapios.</p>
        </div>
            <table class="zebra-striped">
            <tr>
                <td><b>C&oacute;digo</b></td>
                <td><b>Nome</b></td>
                <td><b>Nome Abrev.</b></td> 
                <td><b>Unidade Medida</b></td>
                <td><b>Escala Unidade</b></td>
                <td><b>Estoque M&iacute;nimo</b></td>
                <td><b>Estoque Atual</b></td>
                <td><b>Custo Unidade</b></td>
                <td><b>Fornecedor</b></td>
                <td><b>Data do Registro</b></td>
            </tr>
              <?php include("../model/stok-select.php"); ?>
            </table> 
            <p><a class='btn' href='stok-insert.php'>Cadastrar Ingrediente &raquo;</a></p>
            <? include("../footer.php"); ?>
      </div>
  </body>
</html>
