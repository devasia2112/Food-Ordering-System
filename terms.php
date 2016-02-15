<?php
include_once('jcart/jcart.php');
require("admin/bootstrap.php");
include( dirname(__FILE__) . SYSPATH_LANG );
defined('SYSPATH_ADMIN') or die('No direct script access.');
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript" src="scripts/jquery.min.js"></script>
    <script type="text/javascript" src="scripts/jquery.curvycorners.min.js"></script>
    <link href="stylesheet/stylesheet.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="scripts/jquery-ui-1.8.4.custom.min.js"></script>
    <link href="scripts/jqueryui/css/redmond/jquery-ui-1.8.4.custom.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="scripts/thickbox.js"></script>
    <link href="scripts/thickbox.css" rel="stylesheet" type="text/css" />
    <link rel="SHORTCUT ICON" href="favicon2.ico" />
    <script>
    $(function() {
	    flag = 0;
	    $("a.header").each(function() {
		    loc = window.location.href;
		    url = $(this).attr("href");
		    if (loc.indexOf(url) > -1) {
			    if (loc[loc.length-1]=="pedido-grupos.php") {
				    if (url=="pedido-grupos.php")
					    $(this).css("color", "yellow");
			    }
			    else if (url!="pedido-grupos.php") {
				    $(this).css("color", "yellow");
			    }
		    }
	    });
    });
    </script>
	<title></title>
	<meta name="description" content="">
	<meta name="keywords" content="">
</head>


<!-- header -->
<?php require("_header.inc.php"); ?>
<!-- header -->

<?php $comp_data = GenericSql::getEmpresa(); ?>

<body>

<div style="height:0px; overflow:hidden;"></div>

<table width="999" border="0" cellpadding="0" cellspacing="0" align="center" id="table990" class="table bg">
  <tr>
    <td width=10>&nbsp;</td>
	  <td id="left_column" valign="top">
  	  <div class="round_bar" style="background-color:#000; font-size:18px; font-weight:bold; color:#FFF;"><?php echo LBL_TERMS_CONDITIONS; ?></div>
  	  <div style="height:10px; overflow:hidden;"></div>
  	  <div style="height:10px; overflow:hidden;"></div>
  	  <center><img src='images/Mascote.png' /></center>
  	  <div style="line-height:17px;">
	      <p>&nbsp;&nbsp;&nbsp;<?php echo html_entity_decode($comp_data['frontend4']); ?> </p>
  	  </div>
  	  <div style="height:15px; overflow:hidden;"></div>
	  </td>
    <td width=10> &nbsp; </td>
  </tr>
  <tr><td colspan=3>&nbsp;</td></tr>
  <tr>
    <td colspan=3>
     <div style="background-color:#dcdcdc; height:1px; overflow:hidden; margin-top:20px; margin-bottom:10px;" class="table bg"></div>
    </td>
  </tr>
  <tr><td colspan=3>&nbsp;</td></tr>
</table>


<script>
$(function() {
  settings = {
    tl: { radius: 10 },
    tr: { radius: 10 },
    bl: { radius: 10 },
    br: { radius: 10 },
    antiAlias: true,
    autoPad: true
  }
  $(".round_bar")
  .css("padding-top", "10px")
  .css("padding-bottom", "10px")
  .css("padding-left", "15px")
  .css("padding-right", "10px")
  .corner(settings);
});
</script>
<script>
$(function(){
  settings = {
    tl: { radius: 15 },
    tr: { radius: 15 },
    bl: { radius: 15 },
    br: { radius: 15 },
    antiAlias: true,
    autoPad: true
  }
  $('.round_corner').corner(settings);
  $("#index_ordering_is_easy").height($("#ordering_is_easy").height());
});
</script>


<!-- footer -->
<?php require("_footer.inc.php"); ?>
<!-- footer -->


</body>
</html>
