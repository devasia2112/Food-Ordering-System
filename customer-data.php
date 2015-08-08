<?php
include_once('jcart/jcart.php');
require("admin/bootstrap.php");
include( dirname(__FILE__) . SYSPATH_LANG );
defined('SYSPATH_ADMIN') or die('No direct script access.');
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/javascript" src="scripts/jquery.min.js"></script>
	<script type="text/javascript" src="scripts/jquery.curvycorners.min.js"></script>
	<script type="text/javascript" src="scripts/jquery-ui-1.8.4.custom.min.js"></script>
	<link rel="stylesheet" type="text/css" href="scripts/jqueryui/css/redmond/jquery-ui-1.8.4.custom.css"  />

	<script type="text/javascript" src="scripts/thickbox.js"></script>
	<link rel="stylesheet" type="text/css" href="scripts/thickbox.css" />
	<link rel="SHORTCUT ICON" href="favicon2.ico" />
	<title></title>
	
      <!-- OVERLAY -->
	<script src="scripts/jquery.tools.min.js"></script>
	<link rel="stylesheet" type="text/css" href="stylesheet/overlay-apple.css" />
	<link rel="stylesheet" type="text/css" href="stylesheet/stylesheet.css" />
      <!-- OVERLAY -->	
</head>


<!-- overlayed element -->
<div class="apple_overlay" id="overlay">
  <!-- the external content is loaded inside this tag -->
  <div class="contentWrap"></div>
</div>
<!-- make all links with the 'rel' attribute open overlays -->
<script>
$(function() {
	// if the function argument is given to overlay,
	// it is assumed to be the onBeforeLoad event listener
	$("a[rel]").overlay({
		mask: '#000',
		effect: 'apple',
		onBeforeLoad: function() {
			// grab wrapper element inside content
			var wrap = this.getOverlay().find(".contentWrap");
			// load the page specified in the trigger
			wrap.load(this.getTrigger().attr("href"));
		}
	});
});
</script>
<!-- overlayed element - end -->



<!-- header -->
<?php require("_header.inc.php"); ?>
<!-- header -->



<?php
if (!isset($_SESSION)) session_start();
include_once ROOTDIR . DIR . "/jcart/jcart.php";

if ( !isset( $_SESSION['IDCUSTOMER'] ) and empty( $_SESSION['IDCUSTOMER'] ))
{
	GenericSql::Redirect($sec=0, $file="log-in");
	die;
}

$array_empresa 	= GenericSql::getEmpresa( );
$arrayCustomer 	= GenericSql::getCustomerById( $_SESSION['IDCUSTOMER'] );
$arrayOrders 	= GenericSql::getOrdersByCustomer( $_SESSION['IDCUSTOMER'] );
?>


<body>

<div style="height:0px; overflow:hidden;"></div>
<table width="999" border="0" cellpadding="0" cellspacing="0" align="center" id="table990" class="table bg">
  <tr>
	<td width="638" id="left_column" valign="top"> 

		<table border="0" cellspacing="0" cellpadding="0" align="center" width="980">
			<tr>
				<td width="10">&nbsp;</td>
				<td width="980" valign="top" id="left_column">

				  <!-- <div style="background-color:#dcdcdc; height:1px; overflow:hidden; width:990px; margin-top:20px; margin-bottom:10px;" class="table bg"></div> -->
				  <br /><br /><br /><div class="title_1"> <?php echo H2_CUSTOMER_AREA; ?> &nbsp;&nbsp;&nbsp; <?php echo $link = '<a class="link_1" href="javascript:void(0);" onclick="tb_show(\'Show Data\', \'Cliente/customer-data.php?item_id=&amp;item_pos=&amp;KeepThis=true&amp;TB_iframe=true&amp;height=600&amp;width=990\', false);"><img height="16" title="' . VIEW_DATA . '" src="images/icons/free-vector-user-interface-icons/PNG/eye.png" /></a>'; ?> </div><br /><br />

				  <div class="txt_1"> <?php echo TXT_CUSTOMER_AREA; ?> </div><br /><br />
				  

				</td>
				<td width="10">&nbsp;</td>
			</tr>
			<tr><td colspan=3>&nbsp;</td></tr>
			<tr>
				<td colspan=3> 
					<div style="background-color:#dcdcdc; height:1px; overflow:hidden; width:997px; margin-top:20px; margin-bottom:10px;" class="table bg"></div>
				</td>
			</tr>
			<tr><td colspan=3>&nbsp;</td></tr>
		</table>

	</td>
  </tr>
</table>


<!-- footer -->
<?php require("_footer.inc.php"); ?>
<!-- footer -->

		
</body>
</html>
