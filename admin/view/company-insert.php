<?php
require("../bootstrap-admin.php");
defined('SYSPATH_ADMIN') or die('No direct script access.');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
  <head>
    <title>...</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> <!-- helps to remove UTF8 BOM in ISO8859-1 files ï»¿ mark-->
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!-- Le styles -->
    <script type="text/javascript" src="jquery-1.5.2.min.js"></script>
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

      var strValue1 = document.getElementById("country").value;
      var strValue2 = document.getElementById("state").value;
      var strValue3 = document.getElementById("city").value;
      var loc = strValue1 + "|" + strValue2 + "|" + strValue3;

      var oHidden = document.createElement("input");
      oHidden.name = "location";
      oHidden.value = loc;
      oForm.appendChild(oHidden);
  	}
  	</script>
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
    </script>

  </head>

  <body>
    <?php include( SYSPATH_ADMIN . "menu.php"); ?>
      <div class="content">
		<div class="hero-unit">
          <h1><?php echo COMPANY_TITLE_2; ?></h1>
          <p><?php echo COMPANY_TITLE_2_1; ?></p>
        </div>

		<div class="row">
		<div class="span15">
		<table class="zebra-striped">
			<form method="post" action="../model/company-insert.php" onsubmit="AddHiddenValue(this);">
        <input type='hidden' value='1' name='submitted' />
				<!-- DADOS DO ENDERECO DA EMPRESA -->
				<!-- START COMBO estado / ender -  IMPORTANTE: isso vai para tabela endereco   -->
				<tr><td align="right">&nbsp;</td><td></td></tr>
				<tr><td align="right"></td><td><b><?php echo COMPANY_INSERT_1; ?></b></td></tr>
				<tr><td align="right">&nbsp;</td><td></td></tr>

        <!-- start COMBO -->
        <tr>
          <td align="right"><?php echo COMPANY_INPUT_1; ?></td>
          <td>
        		<select id="country" onchange="load_options(this.value,'state');">
        			<option value="">Select country</option>
        		</select>
        		&nbsp;&nbsp;&nbsp;
        		<select id="state" onchange="load_options(this.value,'city');">
        			<option value="">Select state</option>
        		</select>
        		&nbsp;&nbsp;&nbsp;
        		<select id="city">
        			<option value="">Select City</option>
        		</select>
        		<img src="loader.gif" id="loading" align="absmiddle" style="display:none;"/>
          </td>
        </tr>
				<!-- end COMBO -->

				<tr><td align="right"><?php echo COMPANY_INPUT_2; ?></td><td><input type="text" maxlength="34" name="endereco" size="20" /></td></tr>
				<tr><td align="right"><?php echo COMPANY_INPUT_3; ?></td><td><input type="text" maxlength="14" name="numero" size="20" /></td></tr>
				<tr><td align="right"><?php echo COMPANY_INPUT_4; ?></td><td><input type="text" maxlength="32" name="complemento" size="20" /></td></tr>
				<tr><td align="right"><?php echo COMPANY_INPUT_5; ?></td><td><input type="text" maxlength="32" name="bairro" size="20" /></td></tr>
				<tr><td align="right"><?php echo COMPANY_INPUT_6; ?></td><td><input type="text" maxlength="12" name="cep" size="20" /></td></tr>
				<!-- FIM DADOS DO ENDEREȏ DA EMPRESA -->
				<tr><td align="right">&nbsp;</td><td></td></tr>
				<tr><td align="right"></td><td><b><?php echo COMPANY_INSERT_2; ?></b></td></tr>
				<tr><td align="right">&nbsp;</td><td></td></tr>
				<!-- DADOS DA EMPRESA -->
				<tr><td align="right"><?php echo COMPANY_INPUT_7; ?></td><td><input type="text" maxlength="53" name="razao_social" size="20"  /></td></tr>
				<tr><td align="right"><?php echo COMPANY_INPUT_8; ?></td><td><input type="text" maxlength="60" name="nome_fantasia" size="20"  /></td></tr>
				<tr><td align="right"><?php echo COMPANY_INPUT_9; ?></td><td><input type="text" maxlength="19" name="cnpj" size="32" /></td></tr>
				<tr><td align="right"><?php echo COMPANY_INPUT_10; ?></td><td><input type="text" maxlength="15" name="ie" size="32" />  </td></tr>
				<tr><td align="right"><?php echo COMPANY_INPUT_11; ?></td><td><input type="text" maxlength="15" name="im" value="" size="32"  />  </td></tr>
				<tr><td align="right"><?php echo COMPANY_INPUT_12; ?></td><td><input type="text" maxlength="15" name="cnae" value="" size="20" />  </td></tr>
				<tr><td align="right"><?php echo COMPANY_INPUT_13; ?></td><td><input type="text" maxlength="15" name="crt" value="" size="20" />  </td></tr>
				<tr><td align="right">&nbsp;</td><td></td></tr>
				<tr><td align="right"></td><td><b><?php echo COMPANY_INSERT_3; ?></b></td></tr>
				<tr><td align="right">&nbsp;</td><td></td></tr>
				<tr><td align="right"><?php echo COMPANY_INPUT_14; ?></td><td><input type="text" maxlength="12" name="tel1" size="20"  onkeypress="formatar_mascara(this, '##-####-####')" /> <?php echo COMPANY_INPUT_16; ?> <input type="text" maxlength="100" name="resp1" size="20"  /> </td></tr>
				<tr><td align="right"><?php echo COMPANY_INPUT_15; ?></td><td><input type="text" maxlength="12" name="tel2" size="20"  onkeypress="formatar_mascara(this, '##-####-####')" /> <?php echo COMPANY_INPUT_16; ?> <input type="text" maxlength="100" name="resp2" size="20"  /> </td></tr>
				<tr><td align="right"><?php echo COMPANY_INPUT_17; ?></td><td><input type="text" maxlength="12" name="fax" size="20"  onkeypress="formatar_mascara(this, '##-####-####')" /></td></tr>
				<tr><td align="right"><?php echo COMPANY_INPUT_18; ?></td>
            <td>
                <div class="input-prepend">
                    <span class="add-on">@</span>
                    <input id="prependedInput" class="large" type="text" size="20" name="email">
                </div>
            </td>
        </tr>
				<tr><td align="right"><?php echo COMPANY_INPUT_19; ?></td>
            <td>
                <div class="input-prepend">
                    <span class="add-on">www</span>
                    <input id="prependedInput" class="large" type="text" maxlength="255" size="50" name="website">
                </div>
            </td>
        </tr>
				<tr><td align="right"><?php echo COMPANY_INPUT_20; ?> </td>
            <td>
                <div class="input-prepend">
                    <span class="add-on">page</span>
                    <input id="prependedInput" class="large" type="text" maxlength="255" size="50" name="website_fb">
                    <code><small><i>* <?php echo COMPANY_INPUT_20_a; ?> </small></code>
                </div>
            </td>
        </tr>
				<tr><td align="right"><?php echo COMPANY_INPUT_21; ?></td>
            <td>
                <div class="input-prepend">
                    <span class="add-on">url</span>
                    <input id="prependedInput" class="span12" type="text" maxlength="255" size="200" name="gmap"><br /><br />
                    <small>
                    	<code> <?php echo COMPANY_INPUT_21_a; ?> </code>
                    </small>
                </div>
            </td>
        </tr>
				<tr><td align="right">&nbsp;</td><td></td></tr>
				<tr><td align="right"></td><td><b><?php echo COMPANY_INSERT_4; ?></b></td></tr>
				<tr><td align="right">&nbsp;</td><td></td></tr>
				<tr><td align="right"><?php echo COMPANY_INPUT_22; ?></td>
            <td><input type="text" maxlength="8" name="abre" size="20"  onkeypress="formatar_mascara(this, '##:##:##')" /> hh:mm:ss </td>
        </tr>
				<tr><td align="right"><?php echo COMPANY_INPUT_23; ?></td>
            <td><input type="text" maxlength="8" name="fecha" size="20"  onkeypress="formatar_mascara(this, '##:##:##')" /> hh:mm:ss </td>
        </tr>
				<tr><td align="right"><?php echo COMPANY_INPUT_24; ?></td>
				     <td><textarea name="obs" class="span8"></textarea></td>
				</tr>
				<tr><td align="right"><?php echo COMPANY_INPUT_25; ?></td>
					<td><textarea id="editor1" class="span12" name="content" style="width:100%"></textarea></td>
				</tr>
				<tr><td colspan="2">&nbsp; </td></tr>
				<tr><td></td><td><input type='submit' value="<?php echo COMPANY_BUTTON_1; ?>" class="btn success" /></td></tr>
				<!-- FIM DADOS DA EMPRESA -->
			</form>
		</table>
		</div>
		</div>
        <?php include "../footer.php"; ?>
      </div>
    </div>

  </body>
</html>
