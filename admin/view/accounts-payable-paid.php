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
          <h1>Consulta de Faturas (PAGAS)</h1>
          <p>Abaixo segue a listagem de todas as faturas pagas no sistema.</p>
        </div>
            
            <table class='condensed-table'>
            <tr>
                <td><b>#ID</b></td>
                <td><b>HASH Pedido</b></td>
                <td><b>Data Pedido</b></td>
                <td><b>Data Venc. Pedido</b></td>
                <td><b>Desc.</b></td>
                <td><b>Total</b></td>
                <td><b>Nota</b></td>
                <td><b>A&ccedil;&atilde;o</b></td>
            </tr>
              <?php include("../model/accounts-payable-select-paid.php"); ?>
            </table>
            <?php include("../footer.php"); ?> 
      </div>
  </body>
</html>