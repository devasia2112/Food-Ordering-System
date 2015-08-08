<?php
require("../bootstrap-admin.php");
defined('SYSPATH_ADMIN') or die('No direct script access.');
require('../../includes/config/config.php');
require('../../includes/Sql/sql.class.php');
session_start();
$session_id = '1';
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
			var category 	= $("select#category").val();
			var code 		= $("input#code").val();
			var name 		= $("input#name").val();
			var desc 		= $("textarea#desc").val();
			var spicy 		= $("select#spicy").val();
			var chef 		= $('input#chef').is(':checked');
			var size 		= $("select#size").val();
			var price 		= $("input#price").val();
			var coupom 		= $("input#coupom").val();
			
			name 			= encodeURIComponent(name);	//allow to use &ampersan
			desc 			= encodeURIComponent(desc);	//allow to use &ampersan

			// Builds the string with posted values
			var dataString = 'category=' + category + '&code=' + code + '&name=' + name + '&desc=' + desc + '&spicy=' + spicy + '&chef=' + chef + '&size=' + size + '&price=' + price + '&coupom=' + coupom;
			
			//alert(dataString);
			
			$.ajax({
				type: "POST",
				url: "../model/products-update.php",
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
			$("#preview").html('<img src="../loader.gif">');
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
	  <h1>Atualizar Produto</h1>
	  <p>Atualiza&ccedil;&atilde;o do produto.</p>
	</div>	  
	<div class="row">
	<div class="span15">
	<table >
        <?php
        $idproduct          = $_GET['id'];
        $_SESSION['IDPROD'] = $idproduct;
        $array_comp = GenericSql::getProductsById( $idproduct ); 
        ?>
		<form method="post" action="../model/products-update.php">
			<input type="hidden" name="photo" value="<?=$_SESSION['product_image'];?>" />
			<tr><td align="right">&nbsp;</td><td></td></tr>
			<tr><td align="right"></td><td><h3>Informa&ccedil;&otilde;es do Produto </h3></td></tr>
			<tr><td align="right">&nbsp;</td><td></td></tr>
			<tr>
				<td align="right">Categoria</td><td>
				<select name="category" id="category">
					<option value="0">[selecione]</option>
					<?php GenericSql::getProductsCategory( $array_comp['category_id'] ); ?>
				</select>
				</td>
			</tr>
			<tr>
			  <td align="right">C&oacute;digo do Produto</td>
			  <td><input type="text" maxlength="20" name="code" id="code" size="20" value="<?=$array_comp['product_code'];?>" /></td>
			</tr>
			<tr><td align="right">Nome</td><td><input type="text" maxlength="255" name="name" id="name" value="<?=$array_comp['name'];?>" size="20" /> LL</td></tr>
			<tr><td align="right">Descri&ccedil;&atilde;o</td>
				<td><textarea name="desc" id="desc" class="span12" rows="5"><?=$array_comp['description'];?></textarea> <br />LL - <small>Add here description of the product in your Local Language (LL).</small></td>
			</tr>
			<tr><td align="right">&nbsp;</td><td></td></tr>
			<tr><td align="right"></td><td><b>Atributos do Produto </b></td></tr>
			<tr><td align="right">&nbsp;</td><td></td></tr>
			<tr>
			  <td align="right">N&iacute;vel de Condimentos (Apimentado)</td>
			  <td>
			    <select name="spicy" id="spicy">
					
					<?php
					if( $array_comp['atributes'] == 0 ) $sel0 = "selected"; else $sel0 = "";
					if( $array_comp['atributes'] == 1 ) $sel1 = "selected"; else $sel1 = "";
					if( $array_comp['atributes'] == 2 ) $sel2 = "selected"; else $sel2 = "";
					if( $array_comp['atributes'] == 3 ) $sel3 = "selected"; else $sel3 = "";
					?>

				    <option value="0" <?php echo $sel0; ?> style="background-image: url('../../images/chili.png'); background-repeat:repeat-y;"> &nbsp;&nbsp;&nbsp;&nbsp; [selecione] </option>
				    <option value="1" <?php echo $sel1; ?> style="background-image: url('../../images/chili.png'); background-repeat:repeat-y;"> &nbsp;&nbsp;&nbsp;&nbsp; Levemente Apimentado </option>
				    <option value="2" <?php echo $sel2; ?> style="background-image: url('../../images/chili.png'); background-repeat:repeat-y;"> &nbsp;&nbsp;&nbsp;&nbsp; Apimentado </option>
				    <option value="3" <?php echo $sel3; ?> style="background-image: url('../../images/chili.png'); background-repeat:repeat-y;"> &nbsp;&nbsp;&nbsp;&nbsp; Extremamente Apimentado </option>
			    </select>
			  </td>
			</tr>
			<tr>
			    <td align="right">Recomendado pelo Chef</td>

				<?php if( $array_comp['recommended'] == 1 ) $chk = "checked"; else $chk = ""; ?>

			    <td> <input type="checkbox" <?php echo $chk; ?> name="chef" id="chef" value="1" /> &nbsp; <img border=0 src="../../images/chef_hat.jpg" /> Marque a op&ccedil;&atilde;o caso o prato seja recomendado pelo Chef</td>
			</tr>
			<tr>
			  <td align="right">Tamanho da Embalagem</td><td>
			    <select name="size" id="size">

					<?php
					if( $array_comp['product_size'] == 0 ) $sel0 = "selected"; else $sel0 = "";
					if( $array_comp['product_size'] == 1 ) $sel1 = "selected"; else $sel1 = "";
					if( $array_comp['product_size'] == 2 ) $sel2 = "selected"; else $sel2 = "";
					if( $array_comp['product_size'] == 3 ) $sel3 = "selected"; else $sel3 = "";
					?>

				    <option value="0" <?php echo $sel0; ?> > &nbsp;&nbsp;&nbsp;&nbsp; [selecione] </option>
				    <option value="1" <?php echo $sel1; ?> > &nbsp;&nbsp;&nbsp;&nbsp; Pequeno (400 gramas) </option>
				    <option value="2" <?php echo $sel2; ?> > &nbsp;&nbsp;&nbsp;&nbsp; M&eacute;dio (500 gramas) </option>
				    <option value="3" <?php echo $sel3; ?> > &nbsp;&nbsp;&nbsp;&nbsp; Grande (600 gramas) </option>
			    </select>
			  </td>
			</tr>
			<tr>
			  <td align="right">Pre&ccedil;o</td>
			  <td><input type="text" maxlength="6" name="price" id="price" size="20" onkeypress="return(currencyFormat(this,'','.',event))" value="<?=$array_comp['price'];?>" /></td>
			</tr>
			<tr>
			  <td align="right">C&oacute;digo Cupom Disconto</td>
			  <td><input type="text" maxlength="20" name="coupom" id="coupom" size="20" value="<?=$array_comp['cupom_code'];?>" /></td>
			</tr>			
			<tr><td colspan="2">&nbsp; </td></tr>
			<tr>
			  <td align="right">Foto atual do Prato </td>
			  <td> <img width="260" height="150" src="../uploads/<?=$array_comp['image'];?>" /> </td>
			</tr>
			<tr>
			  <td align="right"> Nova Foto do produto </td>
			  <td>
			        <div >
			        <form id="imageform" method="post" enctype="multipart/form-data" action='ajaximage.php'>
			            <input type="file" name="photoimg" id="photoimg" />
			        </form>
			        <div id='preview'></div>
			        </div>
				<i> * Opcional (Caso a foto não seja trocada a foto atual sera mantida) </i>
			  </td>
			</tr>
			<tr>
			  <td colspan="2" align="center"><input type="submit" value="Atualizar Produto" name="submit" id="submit" class="btn success" /></td>
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
