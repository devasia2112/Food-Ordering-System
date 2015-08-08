<?php require("../bootstrap-admin.php");
defined('SYSPATH_ADMIN') or die('No direct script access.');
include('../../includes/config/config.php');
include('../../includes/Sql/sql.class.php');
session_start();
$session_id = '1';
$array_empresa = GenericSql::getEmpresa( );
$_SESSION['empresa_id'] = $array_empresa['id'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>...</title>
    <meta name="description" content="Software Development">
    <meta name="author" content="deepcell.org">
    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	<!-- upload -->  
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/jquery.form.js"></script>
	<script type="text/javascript" >
	$(document).ready(function() {
		$('#photoimg').live('change', function(){ 
			$("#preview").html('');
			$("#preview").html('<img src="../loader.gif" title="Uploading...." alt="Uploading....">');
			$("#imageform").ajaxForm({target: '#preview'}).submit();
		});
	});
	</script>
	<!-- upload -->	
	<script type="text/javascript" src="../../scripts/general-functions.js"></script>
	<script type="text/javascript" src="../js/form.js"></script>
	<!-- Le styles -->
    <link href="../bootstrap.css" rel="stylesheet">
    <style type="text/css">
		body {
			padding-top: 60px;
		}
		.preview{
			width:200px;
			border:solid 1px #dedede;
			padding:10px;
		}
		#preview{
			color:#cc0000;
			font-size:12px
		}	  
    </style>
    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../favicon2.ico">
  </head>
  <body>
	<?php include("../menu.php"); ?>
	<div class="content">
	    <div class="hero-unit">
	      <h1>Upload Logotipo</h1>
	      <p>Fa&ccedil;a o upload do logotipo da empresa, esse logotipo deve ser usado em todo o sistema {Frontend Loja, Faturas, NF, etc..}</p>
	    </div>	  
	    <div class="row">
	        <div class="span15">
                <i>Visualiza&ccedil;&atilde;o do logotipo </i>
	            <form id="imageform" method="post" enctype="multipart/form-data" action='ajax-logo-upload.php'>
	                <input type="file" name="photoimg" id="photoimg" />
	            </form>
	            <div id='preview'></div>
	        </div>
	    </div>
            <?php include("../footer.php"); ?>
	    </div>
    </div>
  </body>
</html>
