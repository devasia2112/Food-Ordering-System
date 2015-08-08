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
    <script language="JavaScript">
    function abrir(w,h,URL)
    {
      var width = w;
      var height = h;      
      var left = (screen.width/2)-(w/2);
      var top = (screen.height/2)-(h/2);    
      window.open(URL,'janela', 'width='+width+', height='+height+', top='+top+', left='+left+', scrollbars=yes, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=no');
    }
    </script>
  </head>
  <body>
    <?php include("../menu.php"); ?>
      <div class="content">
		<div class="hero-unit">
          <h1>Consulta de Pedidos Finalizados</h1>
          <p>Abaixo segue a listagem de todos os pedidos cadastrados no sistema com status PAGO.</p>
        </div>
            
            <table class='condensed-table'>
            <tr>
                <td><b>ID Pedido</b></td>
                <td><b>Cliente</b></td>
                <td><b>Hora Pedido</b></td>
                <td><b>Pagamento</b></td>
                <td><b>Status</b></td>
                <td><b>Ultima Modificação</b></td>
                <td><b>A&ccedil;&atilde;o</b></td>
            </tr>
              <?php include("../model/orders-select-paid.php"); ?>
            </table>
            <p> <a class="btn" href="javascript:abrir('1320','700','<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>sales.php');">Vendas (PDV) &raquo; </a></p>
			<? include("../footer.php"); ?>
      </div>
  </body>
</html>
