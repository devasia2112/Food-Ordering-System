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
          <h1>Monitoramento de Gateways</h1>
          <p>Escolha abaixo o gateway usado para recebimento. Aqui pode ser configurado os dados da conta de cada gateway. <br />
            Também acompanhe a alteração do status de pagamentos para liberaçao de entregas.</p>
        </div>	 

      	<!-- Example row of columns -->
      	<div class="row">
      	  <div class="span6">
      		<img src="../../images/logo-moip.png" title="moip" />
      		<p>MoIP NASP - Notificação de Alteração de Status de Pagamento.</p>
      		<p><a class="btn" href="javascript:abrir('1024','600','../../jcart/gateways/moip/nasp-db-select.php');">Abrir Monitoramento &raquo;</a></p><hr />
          <p>Interface de configuração do sistema MoIP. Permite recebimentos pela internet via MoIP.</p>
          <p><a class="btn" href="#">Configurar MoIP &raquo;</a></p>
      	  </div>
      	  <div class="span5">
      		<img src="../../images/paypal_logo.gif" title="paypal" />
      		<p>Em desenvolvimento! Em breve acompanhe a alteração de status de pagamentos para liberação de entregas.</p>
      		<p><a class="btn" href="#">Abrir Monitoramento &raquo;</a></p><hr />
          <p>Interface de configuração do sistema PayPal. Permite recebimentos pela internet via PayPal. Interface de Cadastro.</p>
          <p><a class="btn" href="paypal-config-insert.php">Cadastrar Conta PayPal &raquo;</a></p>
          <p>Interface de configuração do sistema PayPal. Permite recebimentos pela internet via PayPal. Interface de Consulta.</p>
          <p><a class="btn" href="paypal-config-select.php">Consultar Conta(s) PayPal &raquo;</a></p>
      	  </div>
      	</div>

      <? include("../footer.php"); ?>

      </div>
    </div>

  </body>
</html>
