<?php require("../bootstrap-admin.php");
defined('SYSPATH_ADMIN') or die('No direct script access.');
?> <!DOCTYPE html>
<html lang="en">
  <head>
    <title></title>
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
	<!-- Main hero unit for a primary marketing message or call to action -->
	<div class="hero-unit">
	  <h1>Cadastro de Clientes</h1>
	</div>
	<!-- Example row of columns -->
	<div class="row">
	  <div class="span6">
		<h2>CADASTRAR DADOS</h2>
		<p></p>
		<p><a class="btn" href="customers-insert.php">Cadastrar cliente novo &raquo;</a></p>
	  </div>
	  <div class="span5">
		<h2>LISTAR DADOS</h2>
		<p></p>
		<p><a class="btn" href="customers-select.php">Listar Clientes &raquo;</a></p>
	  </div>
	</div>
	<hr>

	<?php include("../footer.php"); ?>

	</div>
    </div>

  </body>
</html>