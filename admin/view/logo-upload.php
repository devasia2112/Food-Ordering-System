<?php require '../bootstrap-admin.php';
defined('SYSPATH_ADMIN') or die('No direct script access.');
include '../../includes/config/config.php';
include '../../includes/Sql/sql.class.php';
session_start();
$session_id = '1';
$array_empresa = GenericSql::getEmpresa();
$_SESSION['empresa_id'] = $array_empresa['id'];
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
    <link rel="shortcut icon" href="../../images/chef_hat.jpg">
  </head>
  <body>
	<?php include("../menu.php"); ?>
	<div class="content">
	    <div class="hero-unit">
	      <h1><?php echo LOGO_TITLE_1; ?></h1>
	      <p><?php echo LOGO_TITLE_1_1; ?></p>
	    </div>
	    <div class="row">
	        <div class="span15">
              <i><?php echo LOGO_TITLE_2; ?></i>
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
