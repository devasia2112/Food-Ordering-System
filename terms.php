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


<body>


<div style="height:0px; overflow:hidden;"></div>

<table width="999" border="0" cellpadding="0" cellspacing="0" align="center" id="table990" class="table bg">
    <tr>
        <td> &nbsp; </td>
	    <td width="638" id="left_column" valign="top">
            <div style="height:5px; overflow:hidden;"></div>
            <div style="width:984px; margin:auto;">
	            <div class="round_bar" style="background-color:#000; font-size:18px; font-weight:bold; color:#FFF;"><?php echo LBL_TERMS_CONDITIONS; ?></div>
            </div>
            <div style="height:15px; overflow:hidden; clear:both;"></div>

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

            <div style="height:10px; overflow:hidden;"></div>
        </td>
        <td> &nbsp; </td>

    </tr>
</table>


<table width="999" border="0" cellpadding="0" cellspacing="0" align="center" id="table990" class="table bg">
    <tr>
	    <td width="638" id="left_column" valign="top">

            <?php echo "<div style='line-height:17px; font-size:18px; line-height:22px;'>" . TXT_TERMS_CONDITIONS . "</div> "; ?>

            <div style="height:15px; overflow:hidden;"></div>
	    </td>
	    <td width="20">&nbsp;</td>
	    <td valign="top" align="right">
	    

		  <div id="ordering_is_easy">

		      <div id="ordering_is_easy">
		      <div class="round_bar" style="background-color:#000; font-size:18px; font-weight:bold; color:#FFF;"><?php echo LBL_ORDER_EASY; ?> </div>
		      <div style="height:7px; overflow:hidden;"></div>
		      <div style="height:11px; overflow:hidden;"></div>

		      <table width="100%" border="0" cellpadding="0" style="background:url(images/step1.jpg) no-repeat;">
			      <tr>
				  <td style="font-size:42px; font-weight:bold; padding-left:10px; color:#999;" height="60" width="15%" valign="middle">1</td>
				  <td style="font-size:16px; font-weight:bold; line-height:18px;" valign="middle">
				  <?php echo LBL_STEP_1; ?>
			  </td>
			      </tr>
		      </table>
	  
			  <div style="height:7px; overflow:hidden;"></div>
		  <div style="height:11px; overflow:hidden;"></div>

		      <table width="100%" border="0" cellpadding="0" style="background:url(images/step1.jpg) no-repeat;">
			      <tr>
				  <td style="font-size:42px; font-weight:bold; padding-left:10px; color:#999;" height="60" width="15%" valign="middle">2</td>
				  <td style="font-size:16px; font-weight:bold; line-height:18px;" valign="middle">
				  <?php echo LBL_STEP_2; ?>
			  </td>
			      </tr>
		      </table>
	  

	  
			  <div style="height:7px; overflow:hidden;"></div>
		  <div style="height:11px; overflow:hidden;"></div>

		      <table width="100%" border="0" cellpadding="0" style="background:url(images/step1.jpg) no-repeat;">
			      <tr>
				  <td style="font-size:42px; font-weight:bold; padding-left:10px; color:#999;" height="60" width="15%" valign="middle">3</td>
				  <td style="font-size:16px; font-weight:bold; line-height:18px;" valign="middle">
				  <?php echo LBL_STEP_3; ?>
			  </td>
			      </tr>
		      </table>
	  
			  <div style="height:25px; overflow:hidden;"></div>
	      </div>
	      
	      
    	</td>
        <td> &nbsp; </td>
    </tr>

    <tr><td colspan=5>&nbsp;</td></tr>
    <tr>
        <td colspan=5> 
            <div style="background-color:#dcdcdc; height:1px; overflow:hidden; margin-top:20px; margin-bottom:10px;" class="table bg"></div>
        </td>
    </tr>
    <tr><td colspan=5>&nbsp;</td></tr>
</table>


<!-- footer -->
<?php require("_footer.inc.php"); ?>
<!-- footer -->


</body>
</html>
