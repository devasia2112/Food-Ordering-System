<?php
include_once "jcart/jcart.php";
require "admin/bootstrap.php";
defined('SYSPATH_ADMIN') or die('No direct access.');
include dirname(__FILE__) . SYSPATH_LANG;
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/javascript" src="scripts/jquery.min.js"></script>
	<script type="text/javascript" src="scripts/jquery.curvycorners.min.js"></script>
	<script type="text/javascript" src="scripts/jquery-ui-1.8.4.custom.min.js"></script>
	<link rel="stylesheet" type="text/css" href="stylesheet/stylesheet.css" />

	<link rel="SHORTCUT ICON" href="favicon.ico" />
	<script>
	$(function() {
		flag = 0;
		$("a.header").each(function() {
			loc = window.location.href;
			url = $(this).attr("href");
			if (loc.indexOf(url) > -1) {
				if (loc[loc.length-1]=="index.php") {
					if (url=="index.php")
						$(this).css("color", "yellow");
				}
				else if (url!="index.php") {
					$(this).css("color", "yellow");
				}
				else {
					$(this).css("color", "yellow");
				}
			}
		});
	});
	</script>
	<title><?php echo TITLE_INDEX; ?></title>
	<meta name="description" content="<?php echo META_DESCRIPTION; ?>">
	<meta name="keywords" content="<?php echo META_KEYWORDS; ?>"">
</head>


<!-- header -->
<?php require "_header.inc.php"; ?>
<!-- header -->


<body>
<script>
$(function() {
	if ($(window).width() < 1100) {
		$("#table990").css("padding-right", "0px");
	}
});
</script>

<div style="height:0px; overflow:hidden;"></div>

<table width="999" border="0" cellpadding="0" cellspacing="0" align="center" id="table990" class="table bg">
  <tr>
	<td width="638" id="left_column" valign="top">
		<div id="index_ordering_is_easy">

			<?php include "scripts/FlexSlider/demo/index.php"; ?>

		</div>
		<div style="height:15px; overflow:hidden;"></div>
		<div style="height:15px; overflow:hidden;"></div>


		<table border="0" cellspacing="0" cellpadding="0" align="center" width="980">
			<tr>
				<td width="638" valign="top" id="left_column">
					<div class="title_1"><?=LBL_ABOUT_US;?></div><br />
					<div class="txt_1">
						<justify><?php echo $txt = html_entity_decode(htmlspecialchars_decode($array_company['frontend'], ENT_NOQUOTES ), ENT_QUOTES, 'UTF-8'); ?> </justify>
					</div><br />
				</td>
				<td width="10">&nbsp;</td>
				<td valign="top" align="right">
					<img src="https://placehold.it/330x190" />

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

			<tr><td colspan=3>&nbsp;</td></tr>
			<tr>
			    <td colspan=3>
				<div style="background-color:#dcdcdc; height:1px; overflow:hidden; margin-top:20px; margin-bottom:10px;" class="table bg"></div>
			    </td>
			</tr>
			<tr><td colspan=3>&nbsp;</td></tr>
		</table>

	</td>
  </tr>
</table>


<!-- footer -->
<?php require "_footer.inc.php"; ?>
<!-- footer -->


</body>
</html>
