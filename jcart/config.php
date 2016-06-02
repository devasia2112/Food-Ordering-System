<?php
// jCart v1.3
// http://conceptlogic.com/jcart/
// Do NOT store any sensitive info in this file!!!
// It's loaded into the browser as plain text via Ajax

// ###########VERY IMPORTANT############
// FROM NOW ON (2014-03-27) ALL DATA FROM VARIABLES $config['paypal']['XXXXXXX'] ARE BEING CALLED FROM DATABASE (table: gateways)
// WE DO NOT NEED TO REMOVE THOSE VARIABLES FROM THIS SCRIPT, WE JUST NOT USING IT ANYMORE
// ###########VERY IMPORTANT############

////////////////////////////////////////////////////////////////////////////////
// REQUIRED SETTINGS

// Path to your jcart files
$config['jcartPath']              = 'jcart/';

// Path to your checkout page
$config['checkoutPath']           = 'checkout';     //checkout.php

// The HTML name attributes used in your item forms
$config['item']['id']             = 'my-item-id';    // Item id
$config['item']['name']           = 'my-item-name';    // Item name
$config['item']['price']          = 'my-item-price';    // Item price
$config['item']['qty']            = 'my-item-qty';    // Item quantity
$config['item']['url']            = 'my-item-url';    // Item URL (optional)
$config['item']['add']            = 'my-add-button';    // Add to cart button

// Your PayPal secure merchant ID
// Found here: https://www.paypal.com/webapps/customerprofile/summary.view
$config['paypal']['id']           = 'contato@' . $_SERVER['SERVER_NAME'];

////////////////////////////////////////////////////////////////////////////////
// OPTIONAL SETTINGS

// Three-letter currency code, defaults to USD if empty
// See available options here: http://j.mp/agNsTx
$config['currencyCode']           = 'BRL';

// Add a unique token to form posts to prevent CSRF exploits
// Learn more: http://conceptlogic.com/jcart/security.php
$config['csrfToken']              = false;

// Override default cart text
$config['text']['cartTitle']      = 'Your Order';    // Shopping Cart
$config['text']['singleItem']     = 'Item';    // Item
$config['text']['multipleItems']  = 'Items';    // Items
$config['text']['subtotal']       = 'Subtotal';    // Subtotal
$config['text']['update']         = 'Update';    // update
$config['text']['checkout']       = 'Checkout';    // checkout
$config['text']['checkoutPaypal'] = 'Pay with PayPal';    // Checkout with PayPal

// MoIP gateway from Brazil Added in 18-04-2012 04:45
$config['text']['checkoutMoIP']   = 'Pagar com MoIP';    // Checkout with MoIP

$config['text']['removeLink']     = 'Remove';    // remove
$config['text']['emptyButton']    = 'Empty';    // empty
$config['text']['emptyMessage']   = 'Your cart is empty!';    // Your cart is empty!
$config['text']['itemAdded']      = 'Item added!';    // Item added!
$config['text']['priceError']     = 'Invalid price format!';    // Invalid price format!
$config['text']['quantityError']  = 'Item quantities must be whole numbers!';    // Item quantities must be whole numbers!
$config['text']['checkoutError']  = 'Your order could not be processed!';    // Your order could not be processed!

// Charge Delivery Here
$config['text']['chargeDeliveryLabel']   = 'Delivery: ';    // charge R$1,00 per delivery
$config['text']['chargeDelivery']   = '1.00';    // charge R$1,00 per delivery

// Override the default buttons by entering paths to your button images
$config['button']['checkout']     = '';
$config['button']['paypal']       = '';
$config['button']['update']       = '';
$config['button']['empty']        = '';

////////////////////////////////////////////////////////////////////////////////
// ADVANCED SETTINGS

// Display tooltip after the visitor adds an item to their cart?
$config['tooltip']                = true;

// Allow decimals in item quantities?
$config['decimalQtys']            = false;

// How many decimal places are allowed?
$config['decimalPlaces']          = 1;

// Number format for prices, see: http://php.net/manual/en/function.number-format.php
$config['priceFormat']            = array('decimals' => 2, 'dec_point' => ',', 'thousands_sep' => '.');


/////////PAYPAL/////////////////////////////////
// Send visitor to PayPal via HTTPS?
$config['paypal']['https']        = true;

// Use PayPal sandbox?
$config['paypal']['sandbox']      = false;

// The URL a visitor is returned to after completing their PayPal transaction
//$config['paypal']['returnUrl']    = 'paypal-returnurl.php';
$config['paypal']['returnUrl']    = 'https://'.$_SERVER['SERVER_NAME'].'/personal-chef-service/retorno.html';

// The URL of your PayPal IPN script
$config['paypal']['notifyUrl']    = '';
/////////PAYPAL/////////////////////////////////
?>
