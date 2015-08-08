<?php
require("../bootstrap-admin.php");
defined('SYSPATH_ADMIN') or die('No direct script access.');
include('../../includes/config/config.php');
include('../../includes/Sql/sql.class.php');
session_start();
$session_id = '1';
$array_empresa = GenericSql::getEmpresa( );
//$_SESSION['empresa_id'] = $array_empresa['id'];
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
	      <h1>Upload Imagens do Slider</h1>
	      <p>Fa&ccedil;a o upload das imagens que ser&atilde;o usadas no slider da interface principal de abertura.</p>
	    </div>	  
	    <div class="row">
	        <div class="span15">
	        
				<?php
				include("plupload/index.php");
				
				//echo '<pre>SESS: ' . print_r($_SESSION['fname']) . '</pre>'; die;
				###DB-OP#################################################
				// If session exists and not empty update database
				if ( isset($_SESSION) and !empty($_SESSION['fname']) ) 
				{
					// Update company's data
					$sql = "UPDATE `empresa` SET  `slider` =  '{$_SESSION['fname']}' WHERE `id` = '{$array_empresa['id']}'";
					mysql_query($sql) or die(mysql_error()); 
					echo (mysql_affected_rows()) ? "<SCRIPT LANGUAGE=\"JavaScript\" TYPE=\"text/javascript\"> alert(\"Imagens do slider atualizadas com sucesso!\") </script>" 
												: "<SCRIPT LANGUAGE=\"JavaScript\" TYPE=\"text/javascript\"> alert(\"Falha na tentativa de alterar as imagens do slider!\") </script>";
				}
				###DB-OP#################################################
				
				// Clean up fname session
				unset($_SESSION['fname']);
				?>
	        
				<script type="text/javascript">
					$(document).ready(function() {
						$('#Button1').click(function() {
							location.reload();
						});
					});     
				</script>
				<input id="Button1" type="button" value="Atualizar Website" class="btn success" />

	        </div>
	    </div>
            <?php include("../footer.php"); ?>
	    </div>
    </div>
  </body>
</html>
