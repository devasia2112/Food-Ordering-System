<?php
session_start();
include_once('../jcart/jcart.php');
require("../admin/bootstrap.php");
require("../includes/lang/en-us.php");
require("../includes/config/config.php");
include("../includes/Sql/sql.class.php");
#----URL ENCODE DECODE---------------
require( "../includes/_url.php" );
#----URL ENCODE DECODE---------------
require('../includes/data.php');
include_once $_SERVER['DOCUMENT_ROOT'] . $_SESSION['path'] . '/login/globals.php';
include CLASSES . '/User.php';

if ( !isset( $_SESSION['IDCUSTOMER'] ) and empty( $_SESSION['IDCUSTOMER'] ))
{
	GenericSql::Redirect($sec=0, $file="../log-in");
	die;
}

$array_empresa 	= GenericSql::getEmpresa( );
$arrayCustomer 	= GenericSql::getCustomerById( $_SESSION['IDCUSTOMER'] );
$arrayOrders 	= GenericSql::getOrdersByCustomer( $_SESSION['IDCUSTOMER'] );
?>

<!-- ABAS -->
  <script src="https://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<!-- ABAS -->

  <link rel="stylesheet" type="text/css" href="../stylesheet/stylesheet.css" />
  <script src="../scripts/jquery.tools.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../stylesheet/overlay-apple.css" />
  <link rel="stylesheet" type="text/css" href="../stylesheet/stylesheet.css" />


<body>

	<table border="0" cellspacing="0" cellpadding="0" align="center" width="980">
		<tr>
			<td width="10">&nbsp;</td>
			<td width="980" valign="top" id="left_column">

				<!-- ABAS area admin cliente -->
				<div id="tabs">
					<ul>
						<li><a href="#tabs-1"><?php echo LBL_CUSTOMER_ACCOUNT; ?></a></li>
						<li><a href="#tabs-2"><?php echo LBL_YOUR_ORDER; ?></a></li>
					</ul>
					<div id="tabs-1">

						<?php
						//echo "<pre>";print_r( $arrayCustomer );echo "</pre>";
						echo "<table width=100% border=0>";
						echo "<tr><td width=20% align='right'><b>".LBL_CUSTOMER_NAME." </b></td><td>".str_repeat("&nbsp;", 4)."{$arrayCustomer[name]}</td></tr>";
						echo "<tr><td width=20% align='right'><b>".LBL_CUSTOMER_VALID_DOCUMENT." </b></td><td>".str_repeat("&nbsp;", 4)."{$arrayCustomer[valid_document]}</td></tr>";
						echo "<tr><td width=20% align='right'><b>".LBL_CUSTOMER_EMAIL." </b></td><td>".str_repeat("&nbsp;", 4)."{$arrayCustomer[email]}</td></tr>";
						echo "<tr><td width=20% align='right'><b>".LBL_CUSTOMER_BIRTHDAY_DATE." </b></td><td>".str_repeat("&nbsp;", 4) . sqltobr($arrayCustomer[birthday]) . "</td></tr>";
						echo "<tr><td width=20% align='right'><b>".LBL_CUSTOMER_STREET." </b></td><td>".str_repeat("&nbsp;", 4)."{$arrayCustomer[street]}</td></tr>";
						echo "<tr><td width=20% align='right'><b>".LBL_CUSTOMER_NUMBER." </b></td><td>".str_repeat("&nbsp;", 4)."{$arrayCustomer[number]}</td></tr>";
						echo "<tr><td width=20% align='right'><b>".LBL_CUSTOMER_MISC." </b></td><td>".str_repeat("&nbsp;", 4)."{$arrayCustomer[complement]}</td></tr>";
						echo "<tr><td width=20% align='right'><b>".LBL_CUSTOMER_SUBURB." </b></td><td>".str_repeat("&nbsp;", 4)."{$arrayCustomer[suburb]}</td></tr>";
						echo "<tr><td width=20% align='right'><b>".LBL_CUSTOMER_STATE." </b></td><td>".str_repeat("&nbsp;", 4)."{$arrayCustomer[state]}</td></tr>";
						echo "<tr><td width=20% align='right'><b>".LBL_CUSTOMER_TOWN." </b></td><td>".str_repeat("&nbsp;", 4)."{$arrayCustomer[town]}</td></tr>";
						echo "<tr><td width=20% align='right'><b>".LBL_CUSTOMER_ZIPCODE." </b></td><td>".str_repeat("&nbsp;", 4)."{$arrayCustomer[zipcode]}</td></tr>";
						echo "<tr><td width=20% align='right'><b>".LBL_CUSTOMER_PHONE1." </b></td><td>".str_repeat("&nbsp;", 4)."{$arrayCustomer[phone_one]}</td></tr>";
						echo "<tr><td width=20% align='right'><b>".LBL_CUSTOMER_PHONE2." </b></td><td>".str_repeat("&nbsp;", 4)."{$arrayCustomer[phone_two]}</td></tr>";
						echo "<tr><td width=20% align='right'><b>".LBL_CUSTOMER_REGISTRATION_DATE." </b></td><td>".str_repeat("&nbsp;", 4) . mysql_datetime_para_humano($arrayCustomer[registered_in]) . "</td></tr>";
						echo "<tr><td width=20% align='right'><b>".LBL_CUSTOMER_LAST_ACCESS." </b></td><td>" . str_repeat("&nbsp;", 4) . mysql_datetime_para_humano($arrayCustomer[last_login]) . "</td></tr>";
						echo "<tr><td width=20% align='right'></td><td>&nbsp;</td></tr>";
						echo "<tr><td width=20% align='right'></td><td>" . str_repeat("&nbsp;", 4) . "<a href='".HTTPS . SERVER_NAME . DIR."/customer-registration?endereco=atualizar&id=".Url::urlEnc( $arrayCustomer[id] )."'><img src='../images/icons/pen-fill.png' title='".LBL_UPDATE."' alt='".LBL_UPDATE."' /></a></td></tr>";
						echo "</table>";
						?>

					</div>
					<div id="tabs-2">

						<?php
						//echo "<pre>";print_r( $arrayOrders );echo "</pre>";
						echo "<table border=0 width=100%>";
						echo "<tr bgcolor='#CCC'><td><b>".LBL_CUSTOMER_ORDER_NUMBER."</b></td><td><b>".LBL_CUSTOMER_REGISTRATION_DATE."</b></td><td><b>".LBL_PAYMENT_METHOD."</b></td><td><b>".LBL_CUSTOMER_ORDER_STATUS."</b></td><td>&nbsp;</td></tr>";
						foreach ( $arrayOrders as $key=>$orderID ) {
							echo "<tr>";
							echo "<td>{$orderID[order_id]}</td><td>" . mysql_datetime_para_humano($orderID[date_time]) . "</td><td>{$orderID[payment_method]}</td><td>{$orderID[order_status_id]}</td>";
							$arrayProductsOrders = GenericSql::getProductsOrdersByCustomer( $orderID[order_id] );
							
							echo "<tr bgcolor='#DDD'><td>&nbsp;</td><td><b>".LBL_SINGLE_ITEM."</b></td><td><b>".LBL_ITEM_PRICE."</b></td><td><b>".TABLE_TR_QUANTITY."</b></td><td><b>".LBL_SUBTOTAL."</b></td></tr>";
							foreach ( $arrayProductsOrders as $keys=>$values ) {
								echo "<tr>";
								echo "<td>&nbsp;</td><td>" . str_repeat("&nbsp;", 4) . "{$values[product_name]}</td><td>{$values[products_price]}</td><td>{$values[products_quantity]}</td><td>{$values[products_final_price]} </td>";
								echo "</tr>";
							}
							//echo "<pre>";print_r( $arrayProductsOrders );echo "</pre>";
							echo "</tr><tr><td colspan='5'><hr style='border-bottom: 1px dashed #000; border-top: 0px;'></td></tr>";
						}
						echo "</table>";
						?>

					</div>
				</div>
				<!-- ABAS area admin cliente -->
				
				
				<script>
				  $(function() {
				    $( "#tabs" ).tabs();
				  });
				</script>

				
			</td>
			<td width="10">&nbsp;</td>
		</tr>
		<tr><td colspan=3>&nbsp;</td></tr>
		<tr><td colspan=3>&nbsp;</td></tr>
	</table>


</body>
