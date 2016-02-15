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
	<title><?=TITLE_INDEX;?></title>
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
    <td width=10> &nbsp; </td>
    <td id="left_column" valign="top">
    <div class="round_bar" style="background-color:#000; font-size:18px; font-weight:bold; color:#FFF;"> <?php echo LBL_CONTACT_US; ?> </div>
    <div style="height:10px; overflow:hidden;"></div>
    <div style="height:10px; overflow:hidden;"></div>
    <form action="contact-process.php" method="post" onsubmit="return check_feedback();">
		  <table width="100%" border="0" cellpadding="3">
			  <tr>
				  <td width="20%" align="right" valign="top"><?php echo TABLE_TR_NAME; ?></td>
				  <td width="80%" valign="top"><input name="feedback_name" type="text" id="feedback_name" size="30" /></td>
			  </tr>
			  <tr>
				  <td align="right" valign="top"><?php echo LBL_CUSTOMER_PHONE; ?></td>
				  <td valign="top"><input name="feedback_contact" type="text" id="feedback_contact" size="30" /></td>
			  </tr>
			  <tr>
				  <td align="right" valign="top"><?php echo LBL_CUSTOMER_EMAIL; ?></td>
				  <td valign="top"><input name="feedback_email" type="text" id="feedback_email" size="30" /></td>
			  </tr>
			  <tr>
				  <td align="right" valign="top"><?php echo LBL_CONTACT_SUBJECT; ?></td>
				  <td valign="top">
				    <select name="feedback_subject" id="feedback_subject">
				      <option value=""><?php echo LBL_CONTACT_SUBJECT; ?></option>
				      <option value="delivery"><?php echo LBL_DELIVERY; ?></option>
				      <option value="take_away"><?php echo LBL_TAKEAWAY; ?></option>
				    </select>
				  </td>
			  </tr>
			  <tr>
				  <td align="right" valign="top"><?php echo LBL_CONTACT_COMMENT; ?></td>
				  <td valign="top"><textarea name="feedback_comment" id="feedback_comment" cols="45" rows="5"></textarea></td>
			  </tr>
			  <tr>
				  <td>&nbsp;</td>
				  <td><input type="submit" name="BtnFeedback" id="BtnFeedback" value="<?php echo LBL_SEND_EMAIL; ?>" /></td>
			  </tr>
			  <tr>
				  <td>&nbsp;</td>
				  <td>&nbsp;</td>
			  </tr>
		  </table>
    </form>
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
  $("#feedback_name").focus();
});
function check_feedback() {
  msg = "";
  if ($("#feedback_name").val() == "")
    msg += "\nType your name.";
  if ($("#feedback_contact").val() == "")
    msg += "\nType your telephone.";
  if ($("#feedback_email").val() == "")
    msg += "\nType your E-mail.";
  if ($("#feedback_subject").val() == "")
    msg += "\nType your subject.";
  if ($("#feedback_comment").val() == "")
    msg += "\nType your comments.";
  if (msg != "") {
    alert(msg);
    $("#feedback_name").focus();
    return false;
  }
  return true;
}
</script>
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
