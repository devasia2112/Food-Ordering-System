<?php
// include("../admin/bootstrap.php");
// jCart v1.3
// http://conceptlogic.com/jcart/
// By default, this file returns the $config array for use with PHP scripts
// If requested via Ajax, the array is encoded as JSON and echoed out to the browser

// Don't edit here, edit config.php
include_once 'config.php';

// Use default values for any settings that have been left empty
if (!$config['currencyCode'])           $config['currencyCode']            = ''; #CURRENCY_CODE;
if (!$config['text']['cartTitle'])      $config['text']['cartTitle']       = ''; #LBL_CART_TITLE;
if (!$config['text']['singleItem'])     $config['text']['singleItem']      = ''; #LBL_SINGLE_ITEM;
if (!$config['text']['multipleItems'])  $config['text']['multipleItems']   = ''; #LBL_MULTI_ITEM;
if (!$config['text']['subtotal'])       $config['text']['subtotal']        = ''; #LBL_SUBTOTAL;
if (!$config['text']['update'])         $config['text']['update']          = ''; #LBL_UPDATE;
if (!$config['text']['checkout'])       $config['text']['checkout']        = ''; #LBL_CHECKOUT;
if (!$config['text']['checkoutPaypal']) $config['text']['checkoutPaypal']  = ''; #LBL_CHECKOUT_PAYPAL;

if (!$config['text']['checkoutMoIP'])   $config['text']['checkoutMoIP']    = ''; /* Checkout with MoIP Brazil added in 18/04/2012 */
if (!$config['text']['removeLink'])     $config['text']['removeLink']      = '';
if (!$config['text']['emptyButton'])    $config['text']['emptyButton']     = '';
if (!$config['text']['emptyMessage'])   $config['text']['emptyMessage']    = '';
if (!$config['text']['itemAdded'])      $config['text']['itemAdded']       = '';
if (!$config['text']['priceError'])     $config['text']['priceError']      = '';
if (!$config['text']['quantityError'])  $config['text']['quantityError']   = '';
if (!$config['text']['checkoutError'])  $config['text']['checkoutError']   = '';
if (!$config['text']['chargeDelivery']) $config['text']['chargeDelivery']  = ''; /* Charge Delivery */

if ($_GET['ajax'] == 'true') 
{
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($config);
}
?>
