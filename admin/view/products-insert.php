<?php require("../bootstrap-admin.php");
defined('SYSPATH_ADMIN') or die('No direct script access.');
include('../../includes/config/config.php');
include('../../includes/Sql/sql.class.php');
session_start();
$session_id = '1';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>...</title>
    <meta name="description" content=" ">
    <meta name="author" content="">
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

			var category 		= $("select#category").val();
			var code 		= $("input#code").val();
			var name_ll 		= $("input#name_ll").val();
			var name_en 		= $("input#name_en").val();
			var desc_ll 		= $("textarea#desc_ll").val();
			var desc_en 		= $("textarea#desc_en").val();
			var spicy 		= $("select#spicy").val();
			//var chef 		= $("checkbox#chef").val();
			var chef 		= $('input#chef').is(':checked');
			var size 		= $("select#size").val();
			var price 		= $("input#price").val();
			var coupom 		= $("input#coupom").val();

			desc_ll 		= encodeURIComponent(desc_ll);	//allow to use &ampersan
			desc_en 		= encodeURIComponent(desc_en);	//allow to use &ampersan

			// Builds the string with posted values
			var dataString = 'category=' + category + '&code=' + code + '&name_ll=' + name_ll + '&name_en=' + name_en + '&desc_ll=' + desc_ll + '&desc_en=' + desc_en + '&spicy=' + spicy + '&chef=' + chef + '&size=' + size + '&price=' + price + '&coupom=' + coupom;

			//alert(dataString);	//debug
			//return false;

			$.ajax({
				type: "POST",
				url: "../model/products-insert.php",
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
	  <h1>Cadastro de Produtos</h1>
	  <p>Cadastre aqui todos os produtos finais de venda.</p>
	</div>
	<div class="row">
	<div class="span15">
	<table >

		<tr><td align="right"></td><td><b>Foto do Produto </b></td></tr>
		<tr><td align="right">&nbsp;</td><td></td></tr>
		<tr>
		  <td align="right">Foto do Prato </td>
		  <td>
			<form id="imageform" method="post" enctype="multipart/form-data" action='ajaximage.php'>
			    <input type="file" name="photoimg" id="photoimg" />
			</form>
			<div id='preview'></div>
		  </td>
		</tr>

		<form method="post" action="../model/products-insert.php">
			<input type="hidden" name="photo" value="<?=$_SESSION['product_image'];?>" />

			<div id="alert"></div>

			<tr><td align="right">&nbsp;</td><td></td></tr>
			<tr><td align="right"></td><td><b>Informa&ccedil;&otilde;es do Produto </b></td></tr>
			<tr><td align="right">&nbsp;</td><td></td></tr>
			<tr>
				<td align="right">Categoria</td><td>
				<select name="category" id="category">
					<option value="0">[selecione]</option>
					<?php GenericSql::getProductsCategory( ); ?>
				</select>
				</td>
			</tr>
			<tr><td align="right">C&oacute;digo do Produto</td><td><input type="text" maxlength="20" name="code" id="code" size="20" /></td></tr>

			<tr><td align="right"><br /></td><td></td></tr>

			<tr><td align="right">Nome</td><td><input type="text" maxlength="20" name="name_ll" id="name_ll" size="20" /> LL</td></tr>
			<tr><td align="right"></td><td><input type="text" maxlength="20" name="name_en" id="name_en" size="20" /> EN</td></tr>

			<tr><td align="right"><br /></td><td></td></tr>

			<tr><td align="right">Descri&ccedil;&atilde;o</td>
				<td><textarea name="desc_ll" id="desc_ll"></textarea> LL - <small>Add here description of the product in your Local Language (LL).</small></td>
			</tr>
			<tr><td align="right"></td>
				<td><textarea name="desc_en" id="desc_en"></textarea> EN - <small>Add here description of the product in English Language (EN).</small> </td>
			</tr>

			<tr><td align="right">&nbsp;</td><td></td></tr>
			<tr><td align="right"></td><td><b>Atributos do Produto </b></td></tr>
			<tr><td align="right">&nbsp;</td><td></td></tr>
			<tr>
				<td align="right">N&iacute;vel de Condimentos (Apimentado)</td><td>
				<select name="spicy" id="spicy">
					<option value="0" style="background-image: url('../../images/chili.png'); background-repeat:repeat-y;"> &nbsp;&nbsp;&nbsp;&nbsp; [selecione] </option>
					<option value="1" style="background-image: url('../../images/chili.png'); background-repeat:repeat-y;"> &nbsp;&nbsp;&nbsp;&nbsp; Levemente Apimentado </option>
					<option value="2" style="background-image: url('../../images/chili.png'); background-repeat:repeat-y;"> &nbsp;&nbsp;&nbsp;&nbsp; Apimentado </option>
					<option value="3" style="background-image: url('../../images/chili.png'); background-repeat:repeat-y;"> &nbsp;&nbsp;&nbsp;&nbsp; Extremamente Apimentado </option>
				</select>
				</td>
			</tr>
			<tr><td align="right">Recomendado pelo Chef</td>
				<td> <input type="checkbox" name="chef" id="chef" value="1" /> &nbsp; <img border=0 src="../../images/chef_hat.jpg" /> Marque a op&ccedil;&atilde;o caso o prato seja recomendado pelo Chef</td>
			</tr>
			<tr>
				<td align="right">Tamanho da Embalagem</td><td>
				<select name="size" id="size">
					<option value="0"> &nbsp;&nbsp;&nbsp;&nbsp; [selecione] </option>
					<option value="1"> &nbsp;&nbsp;&nbsp;&nbsp; Pequeno (400 gramas) </option>
					<option value="2"> &nbsp;&nbsp;&nbsp;&nbsp; M&eacute;dio (500 gramas) </option>
					<option value="3"> &nbsp;&nbsp;&nbsp;&nbsp; Grande (600 gramas) </option>
				</select>
				</td>
			</tr>
			<tr><td align="right">Pre&ccedil;o</td>
				<td><input type="text" maxlength="5" name="price" id="price" size="20" onkeypress="return(currencyFormat(this,'','.',event))" /></td>
			</tr>
			<tr><td align="right">C&oacute;digo Cupom Disconto</td>
				<td><input type="text" maxlength="20" name="coupom" id="coupom" size="20" /></td>
			</tr>

			<tr><td colspan="2">&nbsp; </td></tr>
			<tr><td colspan="2" align="center">
				<input type="submit" value="Cadastrar Produto" name="submit" id="submit" class="btn success" /></td>
			</tr>
		</form>

	</table>
	</div>
	</div>
        <?php include("../footer.php"); ?>
	</div>
    </div>

	<script type="text/javascript" src="../../scripts/jscolor/jscolor.js"></script>

  </body>
</html>
