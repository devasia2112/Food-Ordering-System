<?php require("../bootstrap-admin.php");defined('SYSPATH_ADMIN') or die('No direct script access.');?>
﻿<!DOCTYPE html>
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
  </head>
  <body>
  
      <div class="content">
		<div class="hero-unit">
          <h1>Imprimir Receita</h1>
          <p>Ficha de impress&atilde;o de receita</p>
        </div>
			<?php include("../model/print-recipe.php"); ?>
			<?php include("../footer.php"); ?>
      </div>
  </body>
</html>
