<?php
include_once('jcart/jcart.php');
require("admin/bootstrap.php");
include( dirname(__FILE__) . SYSPATH_LANG );
defined('SYSPATH_ADMIN') or die('No direct script access.');
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?=TITLE_INDEX;?></title>                            
    <meta name="description" content="<?=SEO_DESCRIPTION_PEDIDOS_GRUPO;?>">
    <meta name="keywords" content="<?=SEO_KEYWORDS_PEDIDOS_GRUPO;?>">
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
			    if (loc[loc.length-1]=="menu.php") {
				    if (url=="menu.php")
					    $(this).css("color", "yellow");
			    }
			    else if (url!="menu.php") {
				    $(this).css("color", "yellow");
			    }
			    else {
				    $(this).css("color", "yellow");
			    }
		    }
	    });
    });
    </script>
</head>


<!-- header -->
<?php require("_header.inc.php"); ?>
<!-- header -->

<?php $array_empresa  = GenericSql::getEmpresa( ); ?>


<body>


<div style="height:0px; overflow:hidden;"></div>

<table width="999" border="0" cellpadding="0" cellspacing="0" align="center" id="table990" class="table bg">
    <tr>
	    <td width="638" id="left_column" valign="top">

		<div style="height:5px; overflow:hidden;"></div>
		<div style="width:990px; margin:auto;">
			<center><div class="round_bar" style="background-color:#e6212a; font-size:18px; font-weight:bold; color:#FFF; width:950px;">
				AVISO: Os pedidos para grupos devem ser feitos com 2 dias de anteced&ecirc;ncia.</div></center>
		</div>
		<div style="height:15px; overflow:hidden; clear:both;"></div>

		<div id="index_ordering_is_easy">
			<div class="round_corner_parent" style="position:relative;">	<!-- http://placehold.it/970x400 -->
				<center><div style="background:url(images/catering.jpg) no-repeat; width:980px; height:900px;"> </div></center>
				<center><img src="images/passos_oficial.png" width=970 /></center>
				<div class="promo1_bg" style="position:absolute; top:0px;"> </div>
				<div class="promo1" style="padding-left:30px; position:absolute;"> <br /> 
					<div style="color:#000000; font-size:28px; line-height:24px; font-weight:bold;"> </div>
					<div style="height:15px; overflow:hidden;"></div>
					<div style="color:#FFFFFF; font-size:24px; line-height:26px; font-weight:bold;"></div><br /> 
				</div>
			</div>	
			<div style="height:22px; overflow:hidden;"></div>
		</div>


		<!-- Make round border for the warning in the page -->
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
				bl: { radius: 0 },
				br: { radius: 0 },
				antiAlias: true,
				autoPad: true
			}
			$('.round_corner').corner(settings);
			$("#index_ordering_is_easy").height($("#ordering_is_easy").height());
		});
		</script>
		<!-- Make round border for the warning in the page -->

	    <!-- <center><div style="background:url(http://placehold.it/980x400) no-repeat; width:980px; height:400px;" class="round_corner" align="left"> </div></center> -->
            <!-- <img src="images/mini_catering.jpg" width="990" /> -->
        </td>
    </tr>

    <tr><td colspan=6>&nbsp;</td></tr>
    <tr>
        <td colspan=6> 
            <div style="background-color:#dcdcdc; height:1px; overflow:hidden; width:997px; margin-top:20px; margin-bottom:10px;" class="table bg"></div>
        </td>
    </tr>
    <tr><td colspan=6>&nbsp;</td></tr>
</table>


<!-- footer -->
<?php require("_footer.inc.php"); ?>
<!-- footer -->


</body>
</html>