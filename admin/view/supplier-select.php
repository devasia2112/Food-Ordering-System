<?php require("../bootstrap-admin.php");
defined('SYSPATH_ADMIN') or die('No direct script access.');
?>﻿<!DOCTYPE html>
<html lang="en">
  <head>
    <title>...</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
          <h1>Consulta de Fornecedores</h1>
          <p>Abaixo segue a listagem dos fornecedores cadastrados no sistema.</p>
        </div>	 
            
            <table class='condensed-table'>
            <tr>
                <td><b>Nome Fantasia</b></td>
                <td><b>Endereco</b></td>
                <td><b>Numero</b></td> 
                <td><b>Bairro</b></td>
                <td><b>Complemento</b></td>
                <td><b>Pa&iacute;s</b></td>
                <td><b>Estado</b></td>
                <td><b>Cidade</b></td>
                <td><b>Cep</b></td>
                <td><b>Cnpj</b></td>
                <td><b>Ie</b></td> 
                <td><b>Tel1</b></td>
                <td><b>Resp1</b></td>
                <td><b>A&ccedil;&atilde;o</b></td>
            </tr>
              <?php include("../model/supplier-select.php"); ?>
            </table> 
            <p><a class='btn' href='supplier-insert.php'>Cadastrar Novo Fornecedor &raquo;</a></p>
      </div>
    <? include("../footer.php"); ?>   
  </body>
</html>