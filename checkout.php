<?php
require("admin/bootstrap.php");
include( dirname(__FILE__) . SYSPATH_CONNECTION );
include( dirname(__FILE__) . SYSPATH_LANG );
include("includes/Sql/sql.class.php");
include("includes/_url.php");
$array_empresa = GenericSql::getEmpresa( );


include_once $_SERVER['DOCUMENT_ROOT'] . $_SESSION['path'] . '/login/globals.php';
include CLASSES . '/User.php';
$user = $_SESSION['user'];
//$user = serialize($user);
//echo $user[name];



// If your page calls session_start() be sure to include jcart.php before session_start();
include_once('jcart/jcart.php');
session_start();



// clean up session DEBUG
//unset($_SESSION['USER_EMAIL']);

if (isset($_SESSION['CHECKOUT_ADD_CUSTOMER']) && $_SESSION['CHECKOUT_ADD_CUSTOMER'] == 1 && isset($_SESSION['IDCUSTOMER']) && isset($_SESSION['MSGOK']))
{
    if ($_SESSION['MSGOK']==1)
    {
        $msg_reg_customer = '
        <center>
        <div class="alert-message success" style="width:92%;">
            <p><strong> '.LBL_WARNING.' </strong> ' . MSG_CUSTOMER_REGISTER_SUCCESS . ' </p>
        </div>
        </center>';
    }
    // unset session from customer register
    unset( $_SESSION['MSGOK'] );
    unset( $_SESSION['CHECKOUT_ADD_CUSTOMER']);
    //unset( $_SESSION['IDCUSTOMER'] );
}
    //unset( $_SESSION['IDCUSTOMER'] );

// Clean up the cart
if ( $_GET['done'] == 1 )
{
    $jcart->empty_cart();
    GenericSql::Redirect($sec=3, $file="menu");
    die( '<center><small>redirecionando ..</small><img src="images/loading.gif"></center>' );
    
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title><?=$array_empresa['nome_fantasia'];?> :: Checkout</title>
    <link rel="stylesheet" type="text/css" media="screen, projection" href="style.css" />
    <link rel="stylesheet" type="text/css" media="screen, projection" href="jcart/css/jcart.css" />
    <script type="text/javascript" src="jcart/js/jquery-1.4.4.min.js"></script>
    <script type="text/javascript" src="scripts/jquery.curvycorners.min.js"></script>
    <link href="stylesheet/stylesheet.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="scripts/jquery-ui-1.8.4.custom.min.js"></script>
    <link href="scripts/jqueryui/css/redmond/jquery-ui-1.8.4.custom.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="scripts/thickbox.js"></script>
    <link href="scripts/thickbox.css" rel="stylesheet" type="text/css" />
  </head>

  <body>

    <center>
    <table border="0" cellspacing="0" cellpadding="0" align="center" width="990" class="table bg">
     <tr>
      <td>
   
	   <div id="wrapper">
	      <div id="content">

		<img border=0 src="images/logo/<?=$array_empresa['logotipo'];?>" />
                
                
        <?php if ( empty( $_SESSION['PCS']['order_id'] )) { ?>
                
		  <address>
		      <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		      <?=$array_empresa['endereco'];?>, <?=$array_empresa['numero'];?>, <?=$array_empresa['bairro'];?>, CEP: <?=$array_empresa['cep'];?> </div>
		      <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		      <?=LBL_DELIVERY_TIME;?> <?=$array_empresa['abre'];?> - <?=$array_empresa['fecha'];?></div>
		  </address>
		  <center><div style="background-color:#dcdcdc; height:1px; overflow:hidden; width:900px; margin-top:20px; margin-bottom:10px;" class="table bg"></div></center>
		  
		<?php } ?>


                <!-- process checkout -->

                    <!-- Step 1 - The Cart the follow steps are in the jcart.php file  -->
						<?php
                        // Verify if has an active login or new customer registered (it creates a session IDCUSTOMER)  
                        //   $_SESSION["user"] needs to be creatd in login.php
                        //   $_SESSION['IDCUSTOMER'] needs to be unset somewhere!
                        if (isset($_SESSION["user"]) || isset($_SESSION['IDCUSTOMER']) || isset($_SESSION['USER_EMAIL']))
                        {
                            echo $msg_reg_customer; ?>
                            <!-- <h2><img src="images/icons/check-alt.png" /> 1 <?=LBL_YOUR_ORDER;?> </h2><hr />  -->
							<div id="jcart"><?php $jcart->display_cart();?></div> <?
							#echo '<pre>DEBUG<br />';
							#var_dump($_SESSION['jcart']);
							#echo '</pre>';
                            #echo $subTotal = $jcart->subtotal;
                        }
			// If checkout from personal chef service (PCS), then just need PayPal and Moip buttons to finish payment 
			elseif ( !empty( $_SESSION['PCS']['order_id'] )) 
			{
			    echo '<div id="jcart">' . $jcart->display_cart() . '</div>';
			}
            else 
            {

    			echo '<div style="height:200px; overflow:hidden;"></div>';

                // Warning 
                echo '
                <center>
                <div class="alert-message success" style="width:96%;">
                    <p><strong> '.LBL_WARNING.' </strong> '. MSG_CUSTOMER_REGISTER_LOGIN_NEEDED .' </p>
                </div>
                </center>';

                // Show only Customer Register and Keep Buying buttons
                echo '<div style="width: 100%;">
                        <div style="width: 30%; padding: 1px; float: left;">
                                <form action="customer-registration?add=1" method="post">
                                    <input type="submit" name="add" value="&larr; ' . LBL_CUSTOMER_BTN_REGISTER . '" id="jcart-paypal-checkout" />
                                </form>
                        </div>
                        <div style="width: 23%; padding: 1px; float: left;">
                                <form action="log-in" method="post">
                                    <input type="submit" value="&larr; ' . LBL_CUSTOMER_BTN_LOGIN . '" id="jcart-paypal-checkout" />
                                </form>
                        </div>
                        <div style="width: 20%; padding: 1px; float: left;">
                                <form action="menu" method="post">
                                    <input type="submit" value="&larr; ' . LBL_CUSTOMER_BTN_BUY . '" id="jcart-paypal-checkout" />
                                </form>
                        </div>
                    </div> ';
            }
			?>
                    <!-- Step 1  -->
                <!-- process checkout -->



	      </div>
	    <div class="clear"></div>
	   </div>

      </td>
     </tr>


	  <script type="text/javascript" src="jcart/js/jquery-1.4.4.min.js"></script>
	  <script type="text/javascript" src="jcart/js/jcart.min.js"></script>

	  
      <?php if ( empty( $_SESSION['PCS']['order_id'] )) { ?>

	<tr>
	    <td> 
		<div style="background-color:#dcdcdc; height:1px; overflow:hidden; width:990px; margin-top:20px; margin-bottom:10px;" class="table bg"></div>
	    </td>
	</tr>
	<tr><td colspan=6>&nbsp;</td></tr>
	<tr><td colspan=6>&nbsp;</td></tr>
	<tr>
	  <td colspan=6>
	      <!-- footer -->
	      <?php require("_footer.inc.php"); ?>
	      <!-- footer -->
	  </td>
	</tr>
	
      <?php } ?>
      

  </table>
  </center>


  </body>
</html>
