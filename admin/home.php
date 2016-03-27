<?php
require "bootstrap-admin.php";
session_start();
defined('SYSPATH_ADMIN') or die('No direct script access.');
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
    <link href="bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
      }
    </style>
  </head>
  <body>
    <?php include "menu.php"; ?>
	<div class="content">
	<!-- Main hero unit for a primary marketing message or call to action -->
	<div class="hero-unit">
	  <h1>Administration Area</h1>
	  <p></p>
	</div>
	<!-- Example row of columns -->
	<div class="row">
	  <div class="span8">
		<h2>Cliente</h2>
		<p>Abrir Gerenciamento de Cliente</p>
		<p><a class="btn" href="view/customers.php">Abrir &raquo;</a></p>
	  </div>
	  <div class="span7">
		<h2>Receita</h2>
		 <p>Gerenciamento das fichas t&eacute;cnicas de produ&ccedil;&atilde;o e receitas.  </p>
		<p><a class="btn" href="view/factsheet.php">Abrir &raquo;</a></p>
	 </div>
	</div>

	<div class="row">
	  <div class="span8">
		<h2>Contas a Pagar e Receber</h2>
		<p>Gerenciamento de Contas a Pagar e Receber.</p>
		<p><a class="btn" href="view/accounts.php">Abrir &raquo;</a></p>
	  </div>
	  <div class="span7">
		<h2>Agenda</h2>
		<p>Gerenciamento dos Agendamentos.</p>
		<p><a class="btn" target="__blank" href="../../scheduler">Abrir &raquo;</a></p>
	  </div>
	</div>


	</div>
	<footer>
	  <p>&copy; Company 2012</p>
	</footer>
	</div>
    </div>

  </body>
</html>
