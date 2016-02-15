<?php
require("../bootstrap-admin.php");
defined('SYSPATH_ADMIN') or die('No direct script access.');
require('../../includes/config/config.php');
require('../../includes/Sql/sql.class.php');
$id = $_GET['id'];
session_start();
?><!DOCTYPE html>
<html lang="en">
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
    <?php include "../menu.php"; ?>
    <?php $comp_data = GenericSql::getEmpresa(); ?>
	<div class="content">
	<div class="hero-unit">
	  <h1>Frontend  - Privacy Page</h1>
	  <p>Here goes the information accessed in `Delivery/privacy` page.</p>
	</div>
	<div class="row">
	<div class="span15">
	<table class="zebra-striped">
	  <form method="post" action="../model/privacy.php">
	      <input type='hidden' value='1' name='submitted' />
	      <input type="hidden" name="id" value="<?=$comp_data[id];?>" />

        <tr><td align="right">Front-end Text</td>
        <td><textarea id="editor1" class="span12" name="content" style="width:100%"><?php echo html_entity_decode($comp_data['frontend3']); ?></textarea></td>
        </tr>

			  <tr><td colspan="2">&nbsp; </td></tr>
			  <tr><td colspan="2" align="center"><input type='submit' value="Update" class="btn success" /></td></tr>
	  </form>
	</table>
	</div>
	</div>
        <? include("../footer.php"); ?>
	</div>
    </div>
	    <script type="text/javascript" src="../../scripts/jscolor/jscolor.js"></script>
  </body>
</html>
