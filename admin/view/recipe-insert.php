<?php require("../bootstrap-admin.php"); defined('SYSPATH_ADMIN') or die('No direct script access.'); ?>
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
            elements : "editor1,editor2,editor3,editor4,editor5,editor6,editor7,editor8,editor9,editor10,editor11,editor12",
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
          <h1>Cadastro de Receitas</h1>
          <p>Cadastre aqui todas as receitas para ser usadas para impress&otilde;es seja em situa&ccedil;&otilde;es de aula de culin&aacute;ria ou publica&ccedil;&atilde;o no site/blog </p>
        </div>	  
		
		<div class="row">
		<div class="span15">
		<table class="zebra-striped">
			<form method="post" action="../model/recipe-insert.php?submitted=1">
                <!-- <input type='hidden' value='1' name='submitted' /> -->

				<tr>
					<td align="right"><?php echo LBL_RECIPE_LANGUAGE; ?></td>
					<td>

	<!-- not used now
					<select name="language" >
						<option value="0">[selecione]</option>
						<option value="pt">Portugu&ecirc;s</option>
						<option value="en">Ingl&ecirc;s</option>
						<option value="th">Thai</option>
					</select>
	-->

                	Ex.: <span class="label"> Idioma em que a receita vai ser digitada aqui. </span> 
					</td>
				</tr>
				<tr><td align="right"><?php echo LBL_RECIPE_TITLE; ?></td><td><input type="text" maxlength="255" name="recipe_title" size="20"  /></td></tr>
				<tr><td align="right"><?php echo LBL_RECIPE_AUTHOR; ?></td><td><input type="text" maxlength="255" name="recipe_author" size="20"  /></td></tr>
				<tr><td align="right"><?php echo LBL_RECIPE_CONTACT; ?></td>
                    <td>
                        <div class="input-prepend">
                            <span class="add-on">@</span>
                            <input id="prependedInput" class="large" type="text" size="20" name="recipe_contact">
                        </div>
                    </td>
                </tr>

				<tr><td align="right">&nbsp;</td><td></td></tr>
				<tr><td align="right"></td><td><b>Informa&ccedil;&otilde;es da Receita</b></td></tr>
				<tr><td align="right">&nbsp;</td><td></td></tr>


				<!-- INICIO DADOS DA RECEITA -->
				<tr><td align="right"> <?php echo LBL_RECIPE_INGREDIENTS; ?> </td><td><textarea id="editor1" class="span12" name="ingredients" style="width:100%"></textarea></td></tr>
				<tr><td align="right"> <?php echo LBL_RECIPE_FOR_MARINADE; ?> </td><td><textarea id="editor2" class="span12" name="for_marinade" style="width:100%"></textarea></td></tr>
				<tr><td align="right"> <?php echo LBL_RECIPE_FOR_PASTE; ?> </td><td><textarea id="editor3" class="span12" name="for_paste" style="width:100%"></textarea></td></tr>
				<tr><td align="right"> <?php echo LBL_RECIPE_FOR_SAUCE; ?> </td><td><textarea id="editor4" class="span12" name="for_sauce" style="width:100%"></textarea></td></tr>
				<tr><td align="right"> <?php echo LBL_RECIPE_FOR_STIRFRY; ?> </td><td><textarea id="editor5" class="span12" name="for_stirfry" style="width:100%"></textarea></td></tr>
				<tr><td align="right"> <?php echo LBL_RECIPE_FOR_STEAM; ?> </td><td><textarea id="editor6" class="span12" name="for_steam" style="width:100%"></textarea></td></tr>
				<tr><td align="right"> <?php echo LBL_RECIPE_FOR_WRAPPING; ?> </td><td><textarea id="editor7" class="span12" name="for_wrapping" style="width:100%"></textarea></td></tr>
				<tr><td align="right"> <?php echo LBL_RECIPE_SEASONING; ?> </td><td><textarea id="editor8" class="span12" name="seasoning" style="width:100%"></textarea></td></tr>
				<tr><td align="right"> <?php echo LBL_RECIPE_DRESSING; ?> </td><td><textarea id="editor9" class="span12" name="dressing" style="width:100%"></textarea></td></tr>
				<tr><td align="right"> <?php echo LBL_RECIPE_GARNISHING; ?> </td><td><textarea id="editor10" class="span12" name="garnishing" style="width:100%"></textarea></td></tr>
				<tr><td align="right"> <?php echo LBL_RECIPE_ACCOMPANIMENT; ?> </td><td><textarea id="editor11" class="span12" name="accompaniment" style="width:100%"></textarea></td></tr>
				<tr><td align="right"> <?php echo LBL_RECIPE_METHOD; ?> </td><td><textarea id="editor12" class="span12" name="method" style="width:100%"></textarea></td></tr>
				<!-- FIM DADOS DA RECEITA -->


				<tr><td colspan="2">&nbsp; </td></tr>
				<tr><td colspan="2" align="center"><input type='submit' value="Cadastrar Empresa" class="btn success" /></td></tr>
			</form>
		</table>
		</div>
		</div>
            <? include("../footer.php"); ?>
      </div>
    </div>

  </body>
</html>
