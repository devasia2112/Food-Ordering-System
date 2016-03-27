<?php require("../bootstrap-admin.php");
defined('SYSPATH_ADMIN') or die('No direct script access.');
?>﻿<!DOCTYPE html>
<html lang="en">
  <head>
    <title>...</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> <!-- helps to remove UTF8 BOM in ISO8859-1 files ï»¿ mark-->    
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
          <h1>Consulta de Categorias</h1>
          <p>Abaixo segue a listagem de todas as categorias cadastradas no sistema.</p>
        </div>

            <table class='condensed-table'>
            <tr>
                <td><b>Nome da Categoria</b></td>
                <td><b>Abreviatura</b></td>
                <td><b>Descri&ccedil;&atilde;o</b></td>
                <td><b>Cor no menu</b></td>
                <td><b>A&ccedil;&atilde;o</b></td>
            </tr>
              <?php include("../model/category-select.php"); ?>
            </table>
            <p><a class='btn' href='category-insert.php'>Cadastrar Nova Categoria &raquo;</a></p>
            <? include("../footer.php"); ?>
      </div>
  </body>
</html>
