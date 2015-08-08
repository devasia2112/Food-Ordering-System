<?php
require("../bootstrap-admin.php");
defined('SYSPATH_ADMIN') or die('No direct script access.');
require('../../includes/config/config.php');
require('../../includes/Sql/sql.class.php');
$id = $_GET['id'];
//session_start();
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
	  <h1>Atualizar Categorias</h1>
	  <p>Atualize as informações da categoria de produtos.</p>
	</div>	  
	<div class="row">
	<div class="span15">
	<table class="zebra-striped">
        <?php $array_comp = GenericSql::getCategoriesByID( $id ); ?>
		<form method="post" action="../model/category-update.php">
            <input type='hidden' value='1' name='submitted' />
            <input type="hidden" value="<?=$id;?>" name="id" />
			<!-- DADOS DO ENDERE? DA EMPRESA -->
			<!-- START COMBO estado / endere? -  IMPORTANTE: isso vai para tabela endereco   -->		
			<tr><td align="right">&nbsp;</td><td></td></tr>
			<tr><td align="right"></td><td><b>Informações da Categoria </b></td></tr>
			<tr><td align="right">&nbsp;</td><td></td></tr>
			<tr><td align="right">Nome</td><td><input type="text" maxlength="64" name="name" size="20" value="<?=$array_comp['name'];?>" /></td></tr>
			<tr><td align="right">Abreviatura</td><td><input type="text" maxlength="14" name="short" size="20" value="<?=$array_comp['short'];?>" /></td></tr>
			<tr><td align="right">Descrição</td><td><textarea name="desc" ><?=$array_comp['description'];?></textarea></td></tr>
			<tr><td align="right">Cor do Menu</td><td>
			<input type="text" maxlength="6" name="color" size="20" class="color {styleElement:'myStyle'}" value="<?=$array_comp['color'];?>" /> <input id="myStyle"> </td></tr>
			<tr><td align="right">Cor da Fonte</td><td>
			<input type="text" maxlength="6" name="font-color" size="20" class="color {styleElement:'myStyle2'}" value="<?=$array_comp['font_color'];?>" /> <input id="myStyle2"> </td></tr>
			<tr><td colspan="2">&nbsp; </td></tr>
			<tr><td colspan="2" align="center"><input type='submit' value="Editar Categoria" class="btn success" /></td></tr>
			<!-- FIM DADOS DA EMPRESA -->
		</form>
	</table>
	</div>
	</div>
        <? include("../footer.php"); ?>
	</div>
    </div>
	    <script type="text/javascript" src="../../scripts/jscolor/jscolor.js"></script>
  </body>
</html>
