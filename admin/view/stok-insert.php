<?php require("../bootstrap-admin.php");
defined('SYSPATH_ADMIN') or die('No direct script access.');
include('../../includes/config/config.php');
include('../../includes/Sql/sql.class.php');
session_start();
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
	$(function() {
		$("#submit").click(function() {
			var name = $("input#name").val();
			var short_name = $("input#short_name").val();
			var unity_measure = $("select#unity_measure").val();
			var scale_unity = $("input#scale_unity").val();
			var minimum_stock = $("input#minimum_stock").val();
			var stock_level = $("input#stock_level").val();
			var unit_cost = $("input#unit_cost").val();
			var supplier = $("select#supplier").val();
			
			name = encodeURIComponent(name);	//allow to use &ampersan
			short_name = encodeURIComponent(short_name);	//allow to use &ampersan

			// Builds the string with posted values
			var dataString = 'name=' + name + '&short_name=' + short_name + '&unity_measure=' + unity_measure + '&scale_unity=' + scale_unity + '&minimum_stock=' + minimum_stock + '&stock_level=' + stock_level + '&unit_cost=' + unit_cost + '&supplier=' + supplier;
			
			//alert(dataString);	//debug
			//return false;

			$.ajax({
				type: "POST",
				url: "../model/stok-insert.php",
				data: dataString,
				cache: false, // Do not cache the page
				success: function(msg) {
					$("#alert").html(msg); // Display messages (php echo)
				},
				// If there is an Ajax error or cannot connect to your model file, display the error message
				error: function(msg) {
					document.getElementById("alert").innerHTML="Your request could not be processed.";
					$("#alert").slideDown("fast");
				}
			});
			return false;
		});
	});
	</script>

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
	  <h1>Cadastro de Ingredientes</h1>
	  <p>Cadastre aqui todos os ingredientes usados para o preparo dos pratos.</p>
	</div>
	<div class="row">
	<div class="span15">
	<table>

		<form method="post" action="../model/stok-insert.php">

			<div id="alert"></div>

			<tr><td align="right"></td><td><b>Informa&ccedil;&otilde;es do Ingrediente </b></td></tr>
			<tr><td align="right">&nbsp;</td><td></td></tr>
			<tr><td align="right">Nome</td><td><input type="text" maxlength="256" name="name" id="name" /> </td></tr>
			<tr><td align="right">Nome Abrev.</td><td><input type="text" maxlength="64" name="short_name" id="short_name" /> </td></tr>
			
			<tr><td align="right">&nbsp;</td><td></td></tr>
			<tr><td align="right"></td><td><b>Atributos do Ingrediente </b></td></tr>
			<tr><td align="right">&nbsp;</td><td></td></tr>
			
			<tr><td align="right">Unidade Medida</td>
				<td>
					<select name="unity_measure" id="unity_measure">
						<option value="0"> &nbsp;&nbsp;&nbsp;&nbsp; [selecione] </option>
						<option value="g"> &nbsp;&nbsp;&nbsp;&nbsp; Gramas - G </option>
						<option value="ml"> &nbsp;&nbsp;&nbsp;&nbsp; Mili Litros - ML </option>
					</select>
				</td>
			</tr>
			<tr><td align="right">Escala da Unidade</td>
				<td><input type="text" maxlength="15" name="scale_unity" id="scale_unity" size="20" value="1000" onkeypress="return isNumberKey(event)" /></td>
			</tr>
			<tr><td align="right">Estoque M&iacute;nimo</td>
				<td><input type="text" maxlength="15" name="minimum_stock" id="minimum_stock" size="20" onkeypress="return isNumberKey(event)" /> G ou ML </td>
			</tr>
			<tr><td align="right">N&iacute;vel do Estoque Atual</td>
				<td><input type="text" maxlength="15" name="stock_level" id="stock_level" size="20" onkeypress="return isNumberKey(event)" /> G ou ML </td>
			</tr>
			<tr><td align="right">Pre&ccedil;o Unitario</td>
				<td><input type="text" maxlength="5" name="unit_cost" id="unit_cost" size="20" onkeypress="return(currencyFormat(this,'','.',event))" /></td>
			</tr>

			<tr>
				<td align="right">Fornecedor</td><td>
				<select name="supplier" id="supplier">
				      <option value="0"> &nbsp;&nbsp;&nbsp;&nbsp; [selecione] </option>
				      <?php GenericSql::getSuppliers( ); ?>
				</select>
				</td>
			</tr>
			
			<tr><td colspan="2">&nbsp; </td></tr>
			<tr><td colspan="2" align="center">
				<input type="submit" value="Cadastrar Ingrediente" name="submit" id="submit" class="btn success" /></td>
			</tr>
		</form>

	</table>
	</div>
	</div>
        <?php include("../footer.php"); ?>
	</div>
    </div>

  </body>
</html>
