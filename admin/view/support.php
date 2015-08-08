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
	<!-- Main hero unit for a primary marketing message or call to action -->
	<div class="hero-unit">
	  <h1>Atendimento</h1>
	</div>
	<!-- Example row of columns -->
	<div class="row">
	  <div class="span6">
		<h2>VENDAS ONLINE</h2>
		<p>Chat destinado ao suporte de vendas online.</p>
		<p><a class="btn" href="javascript:abrir('900','650','../../Suporte/webim/');">Abrir Chat &raquo;</a></p>
	  </div>
	  <div class="span5">
		<h2>SUPORTE ONLINE </h2>
		<p>Chat destinando ao atendimento de clientes com problemas na compra, reclamações, devoluções, etc..</p>
		<p><a class="btn" href="javascript:abrir('900','650','../../Suporte/webim/');">Abrir Chat &raquo;</a></p>
	  </div>
	</div>
	<hr>

    <? include("../footer.php"); ?>

	</div>
    </div>

  </body>
</html>
