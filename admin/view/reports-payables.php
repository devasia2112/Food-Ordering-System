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
    <script src="../js/d3.v3.min.js"></script>

      <?php include("../menu.php"); ?>
      
      <div class="content">
	<div class="hero-unit">
          <h1>Relatorios Graficos</h1>
          <p>Relatorios Graficos de Contas a Pagar, o periodo inicia na data da abertura do faturamento da empresa ate a data da ultima fatura gerada. Cada relatorio tem suas particulardades.</p>
        </div>
        
	<div class="row">
	
	  <div class="span15">
	  
	    <ul class="media-grid">
	      <li>
		<a href="reports-payables-action.php?action=d"><p>Diario</p><img class="thumbnail" src="../../images/thumbnails/admin-graph-01.png" alt=""></a>
	      </li>
	      <li>
		<a href="reports-payables-action.php?action=m"><p>Mensal</p><img class="thumbnail" src="../../images/thumbnails/admin-graph-01.png" alt=""></a>
	      </li>
	      <li>
		<a href="reports-payables-action.php?action=y"><p>Anual</p><img class="thumbnail" src="../../images/thumbnails/admin-graph-01.png" alt=""></a>
	      </li>
	    </ul>

	  </div>
        </div>
        
        
	<?php //include "../footer.php"; ?>
      </div>
  </body>
</html>