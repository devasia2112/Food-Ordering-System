<?php
require("../includes/config/config.php");
include("../includes/Sql/sql.class.php");
include("../includes/_url.php");
// jCart v1.3
// http://conceptlogic.com/jcart/
// This file is called when any button on the checkout page (PayPal checkout, update, or empty) is clicked
// Include jcart before session start
include_once('jcart.php');

// Get Valor da entrega
$empresa_array = GenericSql::getEmpresa( );

session_start();


    //Redirect to the customers choice
    if ($_POST['update-address'])
    {
        GenericSql::Redirect($sec=0, $file="../customer-registration?endereco=atualizar&id=" . Url::urlEnc( $_SESSION['IDCUSTOMER'] ));
        die( '<center><img src="../images/loading.gif"></center>' );
    }
    // Redirect to the right place checkout-process.php
    if ($_POST['payonreceive'])
    {
        if(!isset($_SESSION))session_start();
        $_SESSION['observation_order'] = $_POST['observation_order'];
		$_SESSION['payment_method_id'] = "payonreceive";
        GenericSql::Redirect($sec=0, $file="../checkout-process");
        die( '<center><img src="../images/loading.gif">' );
    }
    // Redirect to the right place checkout-process.php
    if ($_POST['continueorder'])
    {
		// Empty the cart if the subtotal is ZERO, it means there are no items
		if($jcart->subtotal <= 0) 
	    {
			$jcart->empty_cart();
		}
        GenericSql::Redirect($sec=0, $file="../menu");
        die( '<center><img src="../images/loading.gif"></center>' );
    }
    // Redirect to the right place checkout-process.php
    if ($_POST['paywithmoip'])
    {
        if(!isset($_SESSION))session_start();
        $_SESSION['observation_order'] = $_POST['observation_order'];
		$_SESSION['payment_method_id'] = "paywithmoip";
        (float) $subTotal = $jcart->subtotal;
        
		// If order from PCS personal chef service then
		if ( !empty( $_SESSION['PCS']['order_id'] )) { $valor_entrega = 0; } else { $valor_entrega = (float) $empresa_array['valor_entrega']; }
		    
		$subTotal = (float) $subTotal + (float) $valor_entrega;
		$subTotal = number_format($subTotal, 2, '.', '');

        GenericSql::Redirect($sec=0, $file="gateways/moip/myMoIP.php?subtotal=".$subTotal);
        die( '<center><img src="../images/loading.gif"></center>' );
    }


$config = $jcart->config;

// The update and empty buttons are displayed when javascript is disabled 
// Re-display the cart if the visitor has clicked either button
if ($_POST['jcartUpdateCart'] || $_POST['jcartEmpty']) 
{
	// Update the cart
	if ($_POST['jcartUpdateCart']) {
		if ($jcart->update_cart() !== true)	{
			$_SESSION['quantityError'] = true;
		}
	}

	// Empty the cart
	if ($_POST['jcartEmpty']) {
		$jcart->empty_cart();
	}

	// Redirect back to the checkout page
	$protocol = 'http://';
	if (!empty($_SERVER['HTTPS'])) {
		$protocol = 'https://';
	}

	header('Location: ' . $protocol . $_SERVER['HTTP_HOST'] . $config['checkoutPath']);
	exit;
}
// The visitor has clicked the PayPal checkout button
else 
{
	////////////////////////////////////////////////////////////////////////////
	/*

	A malicious visitor may try to change item prices before checking out.

	Here you can add PHP code that validates the submitted prices against
	your database or validates against hard-coded prices.

	The cart data has already been sanitized and is available thru the
	$jcart->get_contents() method. For example:

	foreach ($jcart->get_contents() as $item) {
		$itemId	    = $item['id'];
		$itemName	= $item['name'];
		$itemPrice	= $item['price'];
		$itemQty	= $item['qty'];
	}

	*/
	////////////////////////////////////////////////////////////////////////////

	// observacao do pedido
    $_SESSION['observation_order'] = $_POST['observation_order'];
	$_SESSION['payment_method_id'] = "paywithpaypal";

	// For now we assume prices are valid
	$validPrices = true;

	////////////////////////////////////////////////////////////////////////////

	// If the submitted prices are not valid, exit the script with an error message
	if ($validPrices !== true)
	{
		die($config['text']['checkoutError']);
	}
	// Price validation is complete
	// Send cart contents to PayPal using their upload method, for details see: http://j.mp/h7seqw
	elseif ($validPrices === true) 
	{


		// HERE SOMEWHERE NEED TO INSERT IN THE DATABASE THE FOLLOW INFORMATION:
		//  - PAYMENT_METHOD
		//  - CUSTOMER_OBSERVATION
		//  - ORDERS ROUTINE (FULL) TRY TO INSERT IN THE PAYPAL'S RETURN PAGE WHEN THE WHOLE PAYMENT PROCCESS ARE DONE!


		// Get Valor da entrega
		$paypal_array = GenericSql::getGatewayData( $name="PayPal", $useit=1 );

		// Paypal count starts at one instead of zero
		$count = 1;
		
		// Build the query string
		$queryString  = "?cmd=_cart";
		$queryString .= "&upload=1";
		$queryString .= "&charset=utf-8";
		$queryString .= "&currency_code=" . urlencode( $paypal_array['currency_code'] );
		$queryString .= "&business=" . urlencode( $paypal_array['business_id'] );	//email da conta
		$queryString .= "&return=" . urlencode( $paypal_array['return_url'] );
		$queryString .= '&notify_url=' . urlencode( $paypal_array['notify_url'] );

		// before
		//$queryString .= "&currency_code=" . urlencode( $config['currencyCode'] );
		//$queryString .= "&business=" . urlencode( $config['paypal']['id'] );	//email da conta
		//$queryString .= "&return=" . urlencode( $config['paypal']['returnUrl'] );
		//$queryString .= '&notify_url=' . urlencode( $config['paypal']['notifyUrl'] );

		
		if (!isset($_SESSION)) @session_start();
		
		// If order from PCS personal chef service then
		if ( !empty( $_SESSION['PCS']['order_id'] )) { $valor_entrega = 0; } else { $valor_entrega = (float) $empresa_array['valor_entrega']; }

		// Calc price to delivery and include it in the item price
		$div_transport = ( $valor_entrega / count($jcart->get_contents()) );
		
		
		/*
		* Query value of personal chef service : the value must be provided after the customer request the service (i is very important to have a value here, otherwise the checkout will be only products of the menu)
		*/
		$pcs_orders = GenericSql::getPCSOrdersByOrderId( $_SESSION['PCS']['order_id'] );
		// generate total to send to gateway
		//$valor_dividido = ( $pcs_orders['chef_service_price'] / count($jcart->get_contents()) );
		
		
		foreach ($jcart->get_contents() as $item) 
		{
			$queryString .= '&item_number_' . $count . '=' . urlencode($item['id']);
			$queryString .= '&item_name_' . $count . '=' . urlencode($item['name']);
			$queryString .= '&amount_' . $count . '=' . urlencode($item['price']);
			$queryString .= '&quantity_' . $count . '=' . urlencode($item['qty']);

			
			// Increment the counter
			++$count;
		}
		
		// If order from PCS personal chef service then
		if ( !empty( $_SESSION['PCS']['order_id'] )) {
		
		    $queryString .= '&item_number_' . $count . '=' . urlencode( 999999 );
		    $queryString .= '&item_name_' . $count . '=' . urlencode( "SERVICE_CHEF" );
		    $queryString .= '&amount_' . $count . '=' . urlencode( $pcs_orders['chef_service_price'] );
		    $queryString .= '&quantity_' . $count . '=' . urlencode( 1 );
		    
		} else {
		
		    $queryString .= '&item_number_' . $count . '=' . urlencode( 900000 );
		    $queryString .= '&item_name_' . $count . '=' . urlencode( "SERVICE_DELIVERY" );
		    $queryString .= '&amount_' . $count . '=' . urlencode( $valor_entrega );
		    $queryString .= '&quantity_' . $count . '=' . urlencode( 1 );
		
		}
		 
		 
		//number_format($this->subtotal+$_SESSION['valor_entrega'], $priceFormat['decimals'], $priceFormat['dec_point'], $priceFormat['thousands_sep'])
		

		// Empty the cart
		//$jcart->empty_cart();

		// Confirm that a PayPal id is set in config.php
		if ($config['paypal']['id']) 
		{
			// Add the sandbox subdomain if necessary
			$sandbox = '';
			if ($config['paypal']['sandbox'] === true) 
			{
				$sandbox = '.sandbox';
			}

			// Use HTTPS by default
			$protocol = 'https://';
			if ($config['paypal']['https'] == false) 
			{
				$protocol = 'http://';
			}
			
			// unset session for PCS personal chef service
			unset( $_SESSION['PCS'] );

			// send the visitor to checkout-process with paypal parameter in the url
			GenericSql::Redirect( $sec=0, $file="../checkout-process?protocol=" . base64_encode( $protocol ) . "&sandbox=" . base64_encode( $sandbox ) . "&queryString=" . base64_encode( $queryString ) );

			// Send the visitor to PayPal
			//@header('Location: ' . $protocol . 'www' . $sandbox . '.paypal.com/cgi-bin/webscr' . $queryString);
		}
		else 
		{
			die('Couldn&rsquo;t find a PayPal ID in <strong>config.php</strong>.');
		}
	}
}
?>
