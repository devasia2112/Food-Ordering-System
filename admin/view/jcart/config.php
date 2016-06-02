<?php
// jCart v1.3
// http://conceptlogic.com/jcart/
// Do NOT store any sensitive info in this file!!!
// It's loaded into the browser as plain text via Ajax

////////////////////////////////////////////////////////////////////////////////
// REQUIRED SETTINGS

// Path to your jcart files
$config['jcartPath']              = 'jcart/';

// Path to your checkout page
//$config['checkoutPath']         = 'sales-checkout.php';
$config['salesCheckoutPath']      = 'sales-checkout.php';

// The HTML name attributes used in your item forms
$config['item']['id']             = 'my-item-id';    // Item id
$config['item']['name']           = 'my-item-name';    // Item name
$config['item']['price']          = 'my-item-price';    // Item price
$config['item']['qty']            = 'my-item-qty';    // Item quantity
$config['item']['url']            = 'my-item-url';    // Item URL (optional)
$config['item']['add']            = 'my-add-button';    // Add to cart button

// Your PayPal secure merchant ID
// Found here: https://www.paypal.com/webapps/customerprofile/summary.view
$config['paypal']['id']           = '';

////////////////////////////////////////////////////////////////////////////////
// OPTIONAL SETTINGS

// Three-letter currency code, defaults to USD if empty
// See available options here: http://j.mp/agNsTx
$config['currencyCode']           = 'BRL';

// Add a unique token to form posts to prevent CSRF exploits
// Learn more: http://conceptlogic.com/jcart/security.php
$config['csrfToken']              = false;

// Override default cart text
$config['text']['cartTitle']      = 'Seu Pedido';    // Shopping Cart
$config['text']['singleItem']     = 'Item';    // Item
$config['text']['multipleItems']  = 'Items';    // Items
$config['text']['subtotal']       = 'Subtotal';    // Subtotal
$config['text']['update']         = 'Atualizar';    // update
$config['text']['checkout']       = 'Finalizar Compra';    // checkout
$config['text']['checkoutPaypal'] = 'Pagar com PayPal';    // Checkout with PayPal

// MoIP gateway from Brazil Added by Fernando in 18-04-2012 04:45
$config['text']['checkoutMoIP'] = 'Pagar com MoIP';    // Checkout with MoIP

$config['text']['removeLink']     = 'Remover';    // remove
$config['text']['emptyButton']    = 'Esvaziar';    // empty
$config['text']['emptyMessage']   = 'Ainda não ha items';    // Your cart is empty!
$config['text']['itemAdded']      = 'Item adicionado!';    // Item added!
$config['text']['priceError']     = 'Formato de preço inválido!';    // Invalid price format!
$config['text']['quantityError']  = 'A quantidade de items deve ser um numero inteiro!';    // Item quantities must be whole numbers!
$config['text']['checkoutError']  = 'O seu pedido não pode ser processado!';    // Your order could not be processed!

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
$config['paypal']['returnUrl']    = '';

// The URL of your PayPal IPN script
$config['paypal']['notifyUrl']    = '';
/////////PAYPAL/////////////////////////////////
?>
