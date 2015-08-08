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
      <div class="content">
		<div class="hero-unit">
          <h2>Consulta detalhada fatura PAGA</h2>
          <p>Abaixo segue todos os detalhes da fatura paga.</p>
        </div>
	      <table class='condensed-table'>
		<?php include("../model/accounts-payable-detail.php"); ?>
	      </table>
            <?php include("../footer.php"); ?> 
      </div>
  </body>
</html>