<?php
include_once('jcart/config.php');
require('includes/config/config.php');
require("admin/bootstrap.php");
include( dirname(__FILE__) . SYSPATH_LANG );

// IMPORTANTE: OLHAR O ARQUIVO global-register.php -> complemento para o cadastro do cliente
defined('SYSPATH_ADMIN') or die('No direct script access.');
session_start();

// This step is executed after connect with facebook was successfuly, then the email is used as parameter and redirect user to proceed with checkout
if (isset($_GET['user']) && $_GET['user'] != '')
{
    include("includes/Sql/sql.class.php");
    $_SESSION['USER_EMAIL'] = $_GET['user'];
    GenericSql::Redirect($sec=0, $file=$config['checkoutPath']);
    die("redirected");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?=TITLE_INDEX;?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="Cadastro de clientes">
    <meta name="keywords" content="<?=SEO_KEYWORDS_LOGIN_INTERFACE;?>">

    <script type="text/javascript" src="scripts/jquery.min.js"></script>
    <script type="text/javascript" src="scripts/jquery.curvycorners.min.js"></script>
    <link type="text/css" rel="stylesheet" href="stylesheet/stylesheet.css" />
    <script type="text/javascript" src="scripts/jquery-ui-1.8.4.custom.min.js"></script>
    <link rel="stylesheet" type="text/css" href="scripts/jqueryui/css/redmond/jquery-ui-1.8.4.custom.css" />
    <script type="text/javascript" src="scripts/thickbox.js"></script>
    <link href="scripts/thickbox.css" rel="stylesheet" type="text/css" />
    <link rel="SHORTCUT ICON" href="favicon2.ico" />
    <script type="text/javascript" src="admin/js/combo.js"></script>
    <script type="text/javascript">
      function formatar_mascara(src, mascara) {
	      var campo = src.value.length;
	      var saida = mascara.substring(0,1);
	      var texto = mascara.substring(campo);
	      if(texto.substring(0,1) != saida) {
		      src.value += texto.substring(0,1);
	      }
      }
      function AddHiddenValue(oForm) {
	  var strValue = document.getElementById("cidade").value;
	  //alert("value: " + strValue);
	  var oHidden = document.createElement("input");
	  oHidden.name = "town";
	  oHidden.value = strValue;
	  oForm.appendChild(oHidden);
      }
    </script>
    <script src="scripts/jquery.tools.min.js"></script>
    <link rel="stylesheet" type="text/css" href="stylesheet/overlay-apple.css"/>

    <!-- OVERLAY -->
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


    <body>

    <div style="height:0px; overflow:hidden;"></div>
        <table width="999" border="0" cellpadding="0" cellspacing="0" align="center" id="table990" class="table bg">
          <tr>
            <td width="638" id="left_column" valign="top">

                <div class="container">

		            <div class="hero-unit">
                            <?=TXT_H2_REGISTER_NEW_CUSTOMER;?>
                    </div>


                    <?php if ( isset($_SESSION['fb_arrays'])): //&& array_key_exists('email', $_SESSION['fb_array']) ?>


                        <table class="cadastro-cliente" border=0>
                            <tr>
                                <td colspan=3> <blockquote><?=LOGIN_SOCIAL_NETWORK;?></blockquote> </td>
                            </tr>
			                <tr>
                                <td class="cadastro-cliente-td" width="6%"></td>
                                <td class="cadastro-cliente-td" width="93%" colspan=2>
                                    <a href="fb-login/fb_login.php" title="<?=LOGIN_WITH_FACEBOOK;?>" alt="<?=LOGIN_WITH_FACEBOOK;?>"><img src="images/fb-login-logo.png" /></a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=3> <br /><br /><br /><hr /> </td>
                            </tr>
	                    </table>


                    <?php else: ?>


                        <table class="cadastro-cliente" border=0>
			                <tr>
                                <td class="cadastro-cliente-td" width="6%"></td>
                                <td class="cadastro-cliente-td" width="93%" colspan=2></td>
                            </tr>
                            <tr>
                                <td colspan=3> <br /> </td>
                            </tr>
			                <tr>
			                    <td class="cadastro-cliente-td"> </td>
			                    <td class="cadastro-cliente-td"> <a href="customer-registration"><?=LNK_CUSTOMER_LOGIN_SIGUP;?></a> <?php echo LBL_OR; ?> <a href="sig-in"><?=LNK_CUSTOMER_LOGIN_SIGIN;?></a> </td>
                                <td class="cadastro-cliente-td"> &nbsp; </td>
                            </tr>
                            <tr>
                                <td colspan=3> <br /> </td>
                            </tr>
                            <tr>
                                <td colspan=3> <blockquote><?=LBL_CUSTOMER_LOGIN_RECOVERY;?></blockquote> </td>
                            </tr>
			    <tr>
				<td class="cadastro-cliente-td"> </td>
				<td class="cadastro-cliente-td"> <?php echo $link = '<a class="link_1" href="javascript:void(0);" onclick="tb_show(\'Show Data\', \'recovery?item_id=&amp;item_pos=&amp;KeepThis=true&amp;TB_iframe=true&amp;height=288&amp;width=976\', false);">  ' . LNK_CUSTOMER_LOGIN_RECOVER . ' </a>'; ?> </td>
                                <td class="cadastro-cliente-td"> &nbsp; </td>
                            </tr>
	                    </table>


                    <?php endif; ?>


                </div>


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



        <!-- footer -->
        <?php require("_footer.inc.php"); ?>
        <!-- footer -->


    </body>
</html>
