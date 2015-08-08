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
          <h1>Contas PayPal Cadastradas</h1>
          <p>Abaixo segue a listagem de todas as contas cadastradas no sistema.</p>
        </div>
            <table class='condensed-table'>
            <tr>
                <td><b>ID da Conta</b></td>
                <td><b>Nome da Conta</b></td>
                <td><b>C&oacute;digo da Moeda</b></td>
                <td><b>ID do Neg&oacute;cio (email)</b></td> 
                <td><b>URL de Retorno</b></td>
                <td><b>URL de Notifica&ccedil;&atilde;o</b></td>
                <td><b>Ativo</b></td>
                <td><b>A&ccedil;&atilde;o</b></td>
            </tr>
              <?php include("../model/paypal-config-select.php"); ?>
            </table> 
            <p><a class='btn' href='paypal-config-insert.php'>Cadastrar Nova Conta &raquo;</a></p>
            <? include("../footer.php"); ?>
      </div>
  </body>
</html>
