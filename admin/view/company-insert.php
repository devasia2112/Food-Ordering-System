<?php
require("../bootstrap-admin.php");
defined('SYSPATH_ADMIN') or die('No direct script access.');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
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
	<script>
	function formatar_mascara(src, mascara) {
		var campo = src.value.length;
		var saida = mascara.substring(0,1);
		var texto = mascara.substring(campo);
		if(texto.substring(0,1) != saida) {
			src.value += texto.substring(0,1);
		}
	}
	</script>
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
 	<script type="text/javascript" src="../js/combo.js"></script>

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

  </head>

  <body>
    <?php include( SYSPATH_ADMIN . "menu.php"); ?>
      <div class="content">
		<div class="hero-unit">
          <h1>Cadastro da Empresa</h1>
          <p>Cadastre aqui todas as informa&ccedil;&otilde;es legais da empresa.</p>
        </div>	  
		
		<div class="row">
		<div class="span15">
		<table class="zebra-striped">
			<form method="post" action="../model/company-insert.php" onsubmit="AddHiddenValue(this);">
                <input type='hidden' value='1' name='submitted' />
				<!-- DADOS DO ENDERECO DA EMPRESA -->
				<!-- START COMBO estado / endere诠 -  IMPORTANTE: isso vai para tabela endereco   -->		
				<tr><td align="right">&nbsp;</td><td></td></tr>
				<tr><td align="right"></td><td><b>Informa&ccedil;&otilde;es do Endere&ccedil;o </b></td></tr>
				<tr><td align="right">&nbsp;</td><td></td></tr>
				<tr>
                    <?php require('../../includes/config/config.php'); ?>
                    <?php require('../../includes/Sql/sql.class.php'); ?>
                    <?php session_start(); ?>
					<td align="right">Estado</td><td>
					<select name="estado" onChange="javascript:Atualiza(this.value,'0');">
						<option value="0">[selecione]</option>
						<?php GenericSql::getBrazilianStates( ); ?>
					</select>
					</td>
				</tr>
				<tr>
					<td align="right">Cidade</td>
					<td><div id="atualiza"></div></td>
				</tr>
				<!-- END COMBO -->
				<tr><td align="right">Logradouro</td><td><input type="text" maxlength="34" name="endereco" size="20" /></td></tr>
				<tr><td align="right">Numero</td><td><input type="text" maxlength="14" name="numero" size="20" /></td></tr>
				<tr><td align="right">Complemento</td><td><input type="text" maxlength="24" name="complemento" size="20" /></td></tr>
				<tr><td align="right">Bairro</td><td><input type="text" maxlength="24" name="bairro" size="20" /></td></tr>
				<tr><td align="right">CEP</td><td><input type="text" maxlength="9" name="cep" size="20" onkeypress="formatar_mascara(this, '#####-###')" /></td></tr>
				<!-- FIM DADOS DO ENDEREȏ DA EMPRESA -->
				<tr><td align="right">&nbsp;</td><td></td></tr>
				<tr><td align="right"></td><td><b>Informa&ccedil;&otilde;es da Empresa</b></td></tr>
				<tr><td align="right">&nbsp;</td><td></td></tr>
				<!-- DADOS DA EMPRESA -->
				<tr><td align="right">Raz&atilde;o Social</td><td><input type="text" maxlength="53" name="razao_social" size="20"  /></td></tr>
				<tr><td align="right">Nome Fantasia</td><td><input type="text" maxlength="60" name="nome_fantasia" size="20"  /></td></tr>
				<tr><td align="right">CNPJ</td><td><input type="text" maxlength="19" name="cnpj" size="20"  onkeypress="formatar_mascara(this, '###.###.###/####-##')" /></td></tr>
				<tr><td align="right">Insc. Estadual</td><td><input type="text" maxlength="15" name="ie" size="20"  onkeypress="formatar_mascara(this, '###.###.###.###')" />  </td></tr>
				<tr><td align="right">Insc. Municipal</td><td><input type="text" maxlength="15" name="im" value="" size="20"  />  </td></tr>
				<tr><td align="right">CNAE</td><td><input type="text" maxlength="15" name="cnae" value="" size="20"  title="CNAE Fiscal" alt="CNAE Fiscal" />  </td></tr>
				<tr><td align="right">CRT</td><td><input type="text" maxlength="15" name="crt" value="" size="20"  title="Co de regime tributação" alt="Co de regime tributção" />  </td></tr>
				<tr><td align="right">&nbsp;</td><td></td></tr>
				<tr><td align="right"></td><td><b>Informa&ccedil;&otilde;es de Contato da Empresa</b></td></tr>
				<tr><td align="right">&nbsp;</td><td></td></tr>		
				<tr><td align="right">Telefone 1</td><td><input type="text" maxlength="12" name="tel1" size="20"  onkeypress="formatar_mascara(this, '##-####-####')" /> Resp. <input type="text" maxlength="100" name="resp1" size="20"  /> </td></tr>
				<tr><td align="right">Telefone 2</td><td><input type="text" maxlength="12" name="tel2" size="20"  onkeypress="formatar_mascara(this, '##-####-####')" /> Resp. <input type="text" maxlength="100" name="resp2" size="20"  /> </td></tr>
				<tr><td align="right">FAX</td><td><input type="text" maxlength="12" name="fax" size="20"  onkeypress="formatar_mascara(this, '##-####-####')" /></td></tr>
				<tr><td align="right">E-Mail</td>
                    <td>
                        <div class="input-prepend">
                            <span class="add-on">@</span>
                            <input id="prependedInput" class="large" type="text" size="20" name="email">
                        </div>
                    </td>
                </tr>
				<tr><td align="right">Website</td>
                    <td>
                        <div class="input-prepend">
                            <span class="add-on">www</span>
                            <input id="prependedInput" class="large" type="text" maxlength="255" size="50" name="website">
                        </div>
                    </td>
                </tr>
				<tr><td align="right">Facebook Page</td>
                    <td>
                        <div class="input-prepend">
                            <span class="add-on">page</span>
                            <input id="prependedInput" class="large" type="text" maxlength="255" size="50" name="website_fb">
                            <small><i>* Apenas o nome do profile. Ex.: </i> https://www.facebook.com/<b>SUA_PAGINA</b> </small>
                        </div>
                    </td>
                </tr>
				<tr><td align="right">GMAP</td>
                    <td>
                        <div class="input-prepend">
                            <span class="add-on">url</span>
                            <input id="prependedInput" class="span12" type="text" maxlength="255" size="200" name="gmap"><br />
                            <small><i>* O URL completo do mapa. Isso vai ser usado em informa&ccedil;&otilde;es do restaurante.</i> <br /><br />
                            	Ex.: <span class="label"> https://maps.google.com/maps/ms?msa=0...&amp;ll=-00.010101,-00.010101&amp;spn=0.061188,0.164623&amp;z=13&amp;output=embed </span> 
                            </small>
                        </div>
                    </td>
                </tr>
				<tr><td align="right">&nbsp;</td><td></td></tr>
				<tr><td align="right"></td><td><b>Outras Informa&ccedil;&otilde;es da Empresa</b></td></tr>
				<tr><td align="right">&nbsp;</td><td></td></tr>
				<tr><td align="right">Horario Abertura</td>
                    <td><input type="text" maxlength="8" name="abre" size="20"  onkeypress="formatar_mascara(this, '##:##:##')" /> hh:mm:ss </td></tr>
				<tr><td align="right">Horario Fechamento</td>
                    <td><input type="text" maxlength="8" name="fecha" size="20"  onkeypress="formatar_mascara(this, '##:##:##')" /> hh:mm:ss </td></tr>
				<tr><td align="right">Observa&ccedil;&atilde;o</td>
					<td><textarea name="obs" class="span8"></textarea></td>
				</tr>
				<tr><td align="right">Texto Front-end</td>
					<td><textarea id="editor1" class="span12" name="content" style="width:100%"></textarea></td>
				</tr>
				<tr><td colspan="2">&nbsp; </td></tr>
				<tr><td colspan="2" align="center"><input type='submit' value="Cadastrar Empresa" class="btn success" /></td></tr>
				<!-- FIM DADOS DA EMPRESA -->
			</form>
		</table>
		</div>
		</div>
            <? include("../footer.php"); ?>
      </div>
    </div>

  </body>
</html>
