<?php
require("../bootstrap-admin.php");
defined('SYSPATH_ADMIN') or die('No direct script access.');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
  <head>
    <title>...</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
    <script type="text/javascript" src="jquery-1.5.2.min.js"></script>
    <script type="text/javascript">
    function AddHiddenValue(oForm) {
	var strValue = document.getElementById("cidade").value;
	//alert("value: " + strValue);
	var oHidden = document.createElement("input");
	oHidden.name = "atualiza";
	oHidden.value = strValue;
	oForm.appendChild(oHidden);
    }
    </script>
    
<!--    <script type="text/javascript" src="../js/combo.js"></script>   -->

    <script type="text/javascript" src="../../scripts/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
    <script type="text/javascript">
    // Creates a new plugin class and a custom listbox
    tinymce.create('tinymce.plugins.ExamplePlugin', {
            createControl: function(n, cm) {
                    return null;
            }
    });

    // Register plugin with a short name
    tinymce.PluginManager.add('example', tinymce.plugins.ExamplePlugin);

    // Initialize TinyMCE with the new plugin and menu button
    tinyMCE.init({
            //plugins : '-example', // - tells TinyMCE to skip the loading of the plugin
            theme : "advanced",
            mode : "exact",  //textareas
            elements : "editor1",
            theme_advanced_toolbar_location : "top",
            theme_advanced_buttons1 : "bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,bullist,numlist,undo,redo,link,unlink",
            theme_advanced_buttons2 : "",
            theme_advanced_buttons3 : "",
            theme_advanced_toolbar_align : "left",
            theme_advanced_statusbar_location : "bottom"
    });
    </script>


<!-- dropdown -->
<script type="text/javascript">
$(document).ready(function(){
	load_options('','country');
});

function load_options(id,index){
	$("#loading").show();
	if(index=="state"){
		$("#city").html('<option value="">Select city</option>');
	}
	$.ajax({
		url: "ajax-dropdown.php?index="+index+"&id="+id,
		complete: function(){$("#loading").hide();},
		success: function(data) {
			$("#"+index).html(data);
		}
	})
}



function mostra_cpf()
{
	if (document.getElementById("cpf").style.display != "none")
	{
		document.getElementById("cpf").style.display = "none";
	}
	else
	{
		document.getElementById("cpf").style.display = "block";
		document.getElementById("cnpj").style.display = "none";
	}
}
function mostra_cnpj()
{
	if (document.getElementById("cnpj").style.display != "none")
	{
		document.getElementById("cnpj").style.display = "none";
	}
	else
	{
		document.getElementById("cnpj").style.display = "block";
		document.getElementById("cpf").style.display = "none";
	}
}
function formatar_mascara(src, mascara) {
	var campo = src.value.length;
	var saida = mascara.substring(0,1);
	var texto = mascara.substring(campo);
	if(texto.substring(0,1) != saida) {
		src.value += texto.substring(0,1);
	}
}

</script>
<!-- dropdown -->




  </head>

  <body>
    <?php include( SYSPATH_ADMIN . "menu.php"); ?>
      <div class="content">
	  <div class="hero-unit">
          <h1>Cadastro de Cliente</h1>
          <p>Cadastro das informa&ccedil;&otilde;es legais do cliente. (Caso precise gerar NF-e para clientes PF ou PJ)</p>
      </div>
		
		<div class="row">
		<div class="span15">
		<table class="zebra-striped">
			<form method="post" action="../model/customer-insert.php" onsubmit="AddHiddenValue(this);">
				
				<?php require('../../includes/config/config.php'); ?>
				<?php require('../../includes/Sql/sql.class.php'); ?>
				<?php session_start(); ?>
				
				<input type='hidden' value='1' name='submitted' />
				
				<!-- DADOS DO CLIENTE -->
				<tr><td align="right"></td><td><b>Informa&ccedil;&otilde;es pessoais do cliente</b></td></tr>
				<tr><td align="right">Nome</td><td><input type="text" maxlength="53" name="name" size="20"  /></td></tr>
				<tr>
				    <td align="right"> DOC.VALIDO </td>
				    <td><input type="text" class="input" name="valid_document" maxlength="25" size="20" /></td>
				</tr>
				<tr><td align="right">Data Nasc.</td><td><input type="text" maxlength="10" name="birthday" size="10"  /></td></tr>
				<tr><td align="right">&nbsp;</td><td></td></tr>
				<!-- DADOS DO CLIENTE -->
				
				<!-- DADOS DO ENDERECO -->
				<!-- START COMBO estado / endereco -  IMPORTANTE: isso vai para tabela endereco   -->
				<tr><td align="right"></td><td><b>Informa&ccedil;&otilde;es do Endere&ccedil;o </b></td></tr>
				<tr>
					<td align="right">Localiza&ccedil;&atilde;o</td><td>
				
					    <select name="country" id="country" onchange="load_options(this.value,'state');">
						    <option value="">Selecione o pais</option>
					    </select>
					    &nbsp;&nbsp;&nbsp;
					    <select name="state" id="state" onchange="load_options(this.value,'city');">
						    <option value="">Selecione o estado</option>
					    </select>
					    &nbsp;&nbsp;&nbsp;
					    <select name="town" id="city">
						    <option value="">Selecione a cidade</option>
					    </select>
					    <img src="loader.gif" id="loading" align="absmiddle" style="display:none;"/>
					</td>
				</tr>
				<!-- END COMBO -->
				<tr><td align="right">Logradouro</td><td><input type="text" maxlength="155" name="street" size="20" /></td></tr>
				<tr><td align="right">Numero</td><td><input type="text" maxlength="14" name="number" size="20" /></td></tr>
				<tr><td align="right">Bairro</td><td><input type="text" maxlength="32" name="suburb" size="20" /></td></tr>
				<tr><td align="right">Complemento</td><td><input type="text" maxlength="32" name="complement" size="20" /></td></tr>
				<tr><td align="right">CEP</td><td><input type="text" maxlength="9" name="zipcode" size="20" onkeypress="formatar_mascara(this, '#####-###')" /></td></tr>
				<!-- FIM DADOS DO ENDERECO -->
				
				<!-- DADOS DE CONTATO -->
				<tr><td align="right">&nbsp;</td><td></td></tr>
				<tr><td align="right"></td><td><b>Informa&ccedil;&otilde;es de contato</b></td></tr>
				<tr><td align="right">Telefone 1</td><td><input type="text" maxlength="12" name="phone_one" size="20"  onkeypress="formatar_mascara(this, '##-####-####')" />  </td></tr>
				<tr><td align="right">Telefone 2</td><td><input type="text" maxlength="12" name="phone_two" size="20"  onkeypress="formatar_mascara(this, '##-####-####')" />  </td></tr>
				<tr><td align="right">E-Mail</td>
				    <td>
					<div class="input-prepend">
					    <span class="add-on">@</span>
					    <input id="prependedInput" class="large" type="text" size="20" name="email">
					</div>
				    </td>
				</tr>
				<!-- DADOS DE CONTATO -->
				
				<tr><td colspan="2">&nbsp; </td></tr>
				<tr><td colspan="2" align="center"><input type='submit' value="Cadastrar Cliente" class="btn success" /></td></tr>
			</form>
		</table>
		</div>
		</div>
            <?php include("../footer.php"); ?>
      </div>
    </div>

  </body>
</html>