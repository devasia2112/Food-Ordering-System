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
			    if (loc[loc.length-1]=="como-pedir.php") {
				    if (url=="como-pedir.php")
					    $(this).css("color", "yellow");
			    }
			    else if (url!="como-pedir.php") {
				    $(this).css("color", "yellow");
			    }
			    else {
				    $(this).css("color", "yellow");
			    }
		    }
	    });
    });
    </script>
    <title><?=TITLE_INDEX;?></title>
    <meta name="description" content="">
    <meta name="keywords" content="food delivery,food delivery services,online food delivery,lunch delivery,dinner delivery,food,delivery">
</head>


<!-- header -->
<?php require("_header.inc.php"); ?>
<!-- header -->


<body>



<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
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
        <td> &nbsp;&nbsp;&nbsp; </td>
	    <td width="645" id="left_column" valign="top">
            <div id="ordering_is_easy">
                <div class="round_bar" style="background-color:#000; font-size:18px; font-weight:bold; color:#FFF;"> <?php echo LBL_ORDER_EASY; ?> </div>
		        <div style="height:7px; overflow:hidden;"></div>
	            <div style="height:11px; overflow:hidden;"></div>

	            <table width="100%" border="0" cellpadding="0" style="background:url(images/step1b.jpg) no-repeat;">
		            <tr>
			            <td style="font-size:42px; font-weight:bold; padding-left:10px; color:#999;" height="60" width="15%" valign="middle">1</td>
			            <td style="font-size:16px; font-weight:bold; line-height:18px;" valign="middle">
						<?php echo LBL_HOWTO_STEP_1; ?>
                        </td>
		            </tr>
	            </table>

		        <div style="height:7px; overflow:hidden;"></div>
	            <div style="height:11px; overflow:hidden;"></div>

	            <table width="100%" border="0" cellpadding="0" style="background:url(images/step1b.jpg) no-repeat;">
		            <tr>
			            <td style="font-size:42px; font-weight:bold; padding-left:10px; color:#999;" height="60" width="15%" valign="middle">2</td>
			            <td style="font-size:16px; font-weight:bold; line-height:18px;" valign="middle"> 
						<?php echo LBL_HOWTO_STEP_2; ?>
						</td>
		            </tr>
	            </table>
	
		        <div style="height:7px; overflow:hidden;"></div>
	            <div style="height:11px; overflow:hidden;"></div>

	            <table width="100%" border="0" cellpadding="0" style="background:url(images/step1b.jpg) no-repeat;">
		            <tr>
			            <td style="font-size:42px; font-weight:bold; padding-left:10px; color:#999;" height="60" width="15%" valign="middle">3</td>
			            <td style="font-size:16px; font-weight:bold; line-height:18px;" valign="middle">
						<?php echo LBL_HOWTO_STEP_3; ?>
						</td>
		            </tr>
	            </table>
	
	            <div style="height:11px; overflow:hidden;"></div>	
		        <div style="height:25px; overflow:hidden;"></div>
            </div>


	    </td>
	    <td valign="top" align="center">
	        <div class="fb-like-box" data-href="http://www.facebook.com/<?php echo $array_empresa['website_fb']; ?>" data-width="310" data-height="360" data-show-faces="true" data-stream="false" data-header="true"></div>

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
