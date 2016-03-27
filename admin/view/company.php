<?php require("../bootstrap-admin.php");
defined('SYSPATH_ADMIN') or die('No direct script access.');
//require('../../includes/Sql/sql.class.php');
?><!DOCTYPE html>
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
	    <!-- Main hero unit for a primary marketing message or call to action -->
	    <div class="hero-unit"><h1><?php echo COMPANY_TITLE_1; ?></h1></div>
	    <!-- Example row of columns -->
	    <div class="row">
	      <div class="span6">
		    <h2><?php echo COMPANY_TITLE_2; ?></h2>
		    <p><?php echo COMPANY_TITLE_2_1; ?></p>
		    <p><a class="btn" href="company-insert.php"><?php echo COMPANY_TITLE_2; ?> &raquo;</a></p>
	      </div>
	      <div class="span5">
		    <h2><?php echo COMPANY_TITLE_3; ?></h2>
		    <p><?php echo COMPANY_TITLE_3_1; ?></p>
		    <p><a class="btn" href="company-select.php"><?php echo COMPANY_TITLE_3; ?> &raquo;</a></p>
	      </div>
	    </div>
	    <hr>
	    <?php include("../footer.php"); ?>
	</div>


  </body>
</html>
