<?php
if (!isset($_SESSION)) session_start();
include( "includes/config/config.php" );
include( "admin/bootstrap.php" );
//include_once $_SERVER['DOCUMENT_ROOT'] . $_SESSION['path'] . '/login/globals.php';
//include( "includes/Sql/sql.class.php" );

$action = array();
$text = array();

if($_SESSION['result'] == 'error' ){
	array_push($text, $_SESSION['msg']);
}
$action['errors'] = $text;
unset($_SESSION['result']);
//session_destroy();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <title><?=TITLE_INDEX;?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="">
    <meta name="keywords" content="">
    <script type="text/javascript" src="scripts/jquery.min.js"></script>
    <script type="text/javascript" src="scripts/jquery.curvycorners.min.js"></script>
    <link type="text/css" href="stylesheet/stylesheet.css" rel="stylesheet" />
    <script type="text/javascript" src="scripts/jquery-ui-1.8.4.custom.min.js"></script>
    <link href="scripts/jqueryui/css/redmond/jquery-ui-1.8.4.custom.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="scripts/thickbox.js"></script>
    <link href="scripts/thickbox.css" rel="stylesheet" type="text/css" />
    <script src="scripts/jquery.tools.min.js"></script>
    <link rel="stylesheet" type="text/css" href="stylesheet/overlay-apple.css"/>
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
<?php 
require("_header.inc.php"); 
include_once UTIL . '/validators.php';

if ( isset( $_SESSION['IDCUSTOMER'] ) and !empty( $_SESSION['IDCUSTOMER'] ))
{
    GenericSql::Redirect($sec=2, $file="menu");
    echo "Redirecting to menu..";
}
?>
<!-- header -->


<body>

    <div style="height:0px; overflow:hidden;"></div>
    <table width="999" border="0" cellpadding="0" cellspacing="0" align="center" id="table990" class="table bg">
      <tr>
        <td width="638" id="left_column" valign="top">
            <div class="container">
	            <div class="hero-unit">
                    <h2><?=H2_CUSTOMER_LOGIN;?></h2>
                    <?php echo LBL_CUSTOMER_LOGIN_MESSAGE; ?>
                </div>
                <table class="cadastro-cliente" border=0>
                    <tr>
                        <td>

                            <form name="login" method="post" action="login/src/actions/login.php">
                                <?php echo show_errors($action); ?>
                                <?php if ($_SESSION['results'] == "success") {
									echo "<div>" . $_SESSION['msg'] . "</div>";
									unset($_SESSION['msg']);
									unset($_SESSION['success']);
								  }
								?>
                                <div>
                            		<label for="username"><?=LBL_USERNAME;?></label> <br/>
                            		<input type="text" name="username" id="username"/>
                            	</div>
                            	<div>
                            		<label for="password"><?=LBL_PASSWORD;?></label> <br/>
                            		<input type="password" name="password" id="password" />
                            	</div>
                            	<div>
                            		<br/>
                                    <input type="submit" value="Login" class="large green button" name="Submit" />
                                    <?php echo $link = '&nbsp;&nbsp;<a href="javascript:void(0);" onclick="tb_show(\'Show Data\', \'recovery?item_id=&amp;item_pos=&amp;KeepThis=true&amp;TB_iframe=true&amp;height=286&amp;width=980\', false);">' . H2_CUSTOMER_LOGIN_RECOVERY . ' </a>'; ?>
                                    <a href="recovery" rel="#overlay"></a>
                            	</div>
                            </form>

                        </td>
                    </tr>
                </table>
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
    <tr><td colspan=3>&nbsp;</td></tr>


    </table>



    <!-- footer -->
    <?php require("_footer.inc.php"); ?>
    <!-- footer -->


    </body>
</html>
