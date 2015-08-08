<?php
include_once('jcart/jcart.php');
require("admin/bootstrap.php");
defined('SYSPATH_ADMIN') or die('No direct script access.');
include( dirname(__FILE__) . SYSPATH_LANG );
?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<title><?=TITLE_INDEX;?></title>
	<meta name="description" content="<?=SEO_DESCRIPTION_RESTAURANTE_INTERFACE;?>">
	<meta name="keywords" content="<?=SEO_KEYWORDS_RESTAURANTE_INTERFACE;?>">
    
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
				if (loc[loc.length-1]=="restaurante.php") {
					if (url=="restaurante.php")
						$(this).css("color", "yellow");
				}
				else if (url!="restaurante.php") {
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


<body>


<script>
$(function() {
	if ($(window).width() < 1100) {
		$("#table990").css("padding-right", "60px");
	}
});
</script>

<div style="height:0px; overflow:hidden;"></div>

<table width="999" border="0" cellpadding="0" cellspacing="0" align="center" id="table990" class="table bg">
    <tr>
	<td id="left_column" valign="top">
		<div id="index_ordering_is_easy">
			<div class="round_corner_parent" style="position:relative;">	<!-- http://placehold.it/970x400 -->

				<div style="font-size:20px; color:#666; padding-left:10px; font-weight:bold;"><?=LBL_FIND_US;?></div>
				<div style="background-color:#dcdcdc; height:1px; overflow:hidden; width:997px; margin-top:20px; margin-bottom:10px;" class="table bg"></div>

				<center>
				  <!-- GMAP - area atendimento -->
					    <iframe width="960" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo $array_empresa['gmap']; ?>"></iframe><br />
					    <div>
						    <div style="float:left;"><?php echo str_repeat('&nbsp;', 7); ?><img height="12" src="images/icons/area-legend.png"><img height="12" src="images/icons/area-legend-2.png"><?php echo str_repeat('&nbsp;', 1); ?> <small> <?php echo MSG_DELIVERY_AREA_PRICE; ?> </div>
						    <div style="float:right;"><?php echo str_repeat('&nbsp;', 25); ?> <?php echo MSG_DELIVERY_AREA_SEE_GOOGLE; ?> <a target="_blank" href="<?php echo $array_empresa['gmap']; ?>" style="color:#0000FF;text-align:left"> Map </a> </small><?php echo str_repeat('&nbsp;', 7); ?></div>
					    </div><br />
				  <!-- GMAP - area atendimento -->
				</center>


				<?php if( SYSPATH_LANG == "/includes/lang/pt-br.php" ) { ?>

					<center>
					  <img src="images/passos_oficial.png" width=970 />
					</center>

				<?php } else { ?>

					<center>
					  <img src="images/passos_oficial-EN.png" width=970 />
					</center>

				<?php } ?>


				<div class="promo1_bg" style="position:absolute; top:0px;"> </div>
				<div class="promo1" style="padding-left:30px; position:absolute;"> <br /> 
					<div style="color:#000000; font-size:28px; line-height:24px; font-weight:bold;"> </div>
					<div style="height:15px; overflow:hidden;"></div>
					<div style="color:#FFFFFF; font-size:24px; line-height:26px; font-weight:bold;"></div><br /> 
				</div>
			</div>	
			<div style="height:22px; overflow:hidden;"></div>
		</div>

		<table width="997" border="0" cellpadding="0" cellspacing="0" align="center" id="table990" class="table bg">
		  <tr>
		    <td width="970" valign="top" id="left_column">

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
			    
		    </td>
		  </tr>
		</table>
		<div style="background-color:#dcdcdc; height:1px; overflow:hidden; width:997px; margin-top:20px; margin-bottom:10px;" class="table bg"></div><br />

	</td>
  </tr>
</table>


<!-- footer -->
<?php require("_footer.inc.php"); ?>
<!-- footer -->


</body>
</html>
