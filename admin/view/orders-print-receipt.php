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
      padding-top: 75px;
    }
    </style>    
  </head>
  <body>
      <div class="content">

        <div class="topbar">
          <div class="topbar-inner">
            <div class="container-fluid">
              <a class="brand" ><img src="<?=SYSPATH_SERVER_LOGO;?>" height="50"></a>
              <p class="pull-right">Logado como <a href="#"><?php echo $_SESSION["admin_display_name"]; ?></a></p>
            </div>
          </div>
        </div>


        <h2>Recibo - Pedido Detalhado</h2>
        <p>Abaixo segue a listagem de todos os items do pedido <br />
          <small>(Esse recibo serve para simples conferência assim como para a cozinha).</small>
        </p><hr />


            
        <table class='condensed-table'>
          <tr>
              <td><b>ID Pedido</b></td>
              <td><b>C&oacute;digo Item</b></td>
              <td><b>Nome do Item</b></td> 
              <td><b>Quantidade</b></td> 
          </tr>
          <?php $id = $_GET['id']; ?>
          <?php include("../model/orders-print-receipt.php"); ?>
        </table>

      </div>
    <?php include("../footer.php"); ?>
  </body>
</html>