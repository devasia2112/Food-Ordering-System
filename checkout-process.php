<?php
require("admin/bootstrap.php");
include( dirname(__FILE__) . SYSPATH_CONNECTION );
include( dirname(__FILE__) . SYSPATH_LANG );
require_once ("includes/PHPMailer/class.phpmailer.php");
require("includes/Sql/sql.class.php");
include_once('jcart/jcart.php');	// If your page calls session_start() be sure to include jcart.php before session_start();
session_start();


// decode parameter of PayPal
$protocol = base64_decode( $_GET[protocol] );
$sandbox = base64_decode( $_GET[sandbox] );
$queryString = base64_decode( $_GET[queryString] );
$agenda_checkout = $_SESSION['agenda_checkout'];	// recebe a data do agendamento vindo la do carrinho do checkout



echo $paypal_url = $protocol . 'www' . $sandbox . '.paypal.com/cgi-bin/webscr' . $queryString;
//print "<pre>"; print $protocol; print "<br>" . $sandbox; print "<br>" . $queryString;
//print_r($_SESSION);




/*
 * If posted already then redirect on refresh
 */
if ( $_SESSION['POSTED'] == 1 )
{
    unset( $_SESSION['POSTED'] );
    GenericSql::Redirect($sec=1, $file='menu');
    die("posted");
}



/*
 * Find out where it comes from POST or SESSION
 */
if (isset($_POST) and $_POST['customer_id'] != "")
{
    // In case of come from Admin's area
    $customer_id = $_POST['customer_id'];
    $observation_order = $_POST['observation_order'];

    // Empty the POST to prevent re-submit orders
    unset( $_POST['customer_id'] );
    unset( $_POST['observation_order'] );
    $_SESSION['POSTED'] = 1;	// This count will tell the script to stop at the end
}
else
{
    if (isset($_SESSION['IDCUSTOMER']) && isset($_SESSION['observation_order']))
    {
        //$load = sys_getloadavg();
        //echo $load[0];

        // In case of come from Customer's area
        $customer_id 	   = $_SESSION['IDCUSTOMER'];
        $observation_order = $_SESSION['observation_order'];
	    $payment_method_id = $_SESSION['payment_method_id'];

        //unset($_SESSION['IDCUSTOMER']);       // mantem o login ativo
        unset( $_SESSION['observation_order'] );
        unset( $_SESSION['USER_EMAIL'] );
	    unset( $_SESSION['payment_method_id'] );
    }
    elseif (isset($_SESSION['USER_EMAIL']) && isset($_SESSION['observation_order']))
    {
        // Query customer data by email to fill the fields in the form
        $customers_data = GenericSql::mysql_select($fieldsarray="*", $table="customers", $uniquefield="email", $uniquevalue=$_SESSION['USER_EMAIL']);
        if ($customers_data == NULL)
        {
            echo '<pre>Não foi encontrado um endereço para entrega.<br />';
            echo '<a href="cadastro-usuario.php?endereco=atualizar">Atualizar Endereço</a>';
            echo '</pre>';
        }
        else
        {
            $customer_id       = $customers_data['id'];             //customer ID
            $observation_order = $_SESSION['observation_order'];    // customer observation
			$payment_method_id = $_SESSION['payment_method_id'];

			// unset sessions
            unset( $_SESSION['USER_EMAIL'] );
            unset( $_SESSION['observation_order'] );
			unset( $_SESSION['payment_method_id'] );
        }
    }
    else
    {
        GenericSql::Redirect($sec=1, $file='menu');
        die("No IDCUSTOMER, nether USER_EMAIL or observation_order");
    }
}



/*
 * Call data from database
 */
$mail           = new PHPMailer(true); //defaults to using php "mail()"; the true param means it will throw exceptions on errors, which we need to catch
$array_empresa  = GenericSql::getEmpresa( );
$arr_customer   = GenericSql::getCustomerById( $customer_id );  //Get all datas from customer's table



/*
 * MAKE THE ORDER :: Insert in orders and order products table
 */
# The Payment Method ID
$paym_id = GenericSql::setPaymentType( $payment_method_id );

# Insert new order
$orders_id = GenericSql::insertOrders( $customer_id, $paym_id );

# Insert the observation order of the customer
$array_oders_obs = array( 'orders_id'=>$orders_id, 'observation_order'=>$observation_order,'data_agendamento'=>$agenda_checkout );
GenericSql::insertOrdersObservation( $array_oders_obs );

# Insert new order produtcts
foreach ($jcart->get_contents() as $item)
{
    # If have a tax to add to the products it must be done right here.
    $tax         = 0;   // The default tax come from config file or whatever it is set.
    $item_id     = urlencode($item['id']);
    $item_name   = urlencode($item['name']);
    $item_price  = urlencode($item['price']);
    $item_qty    = urlencode($item['qty']);
    $final_price = (( $tax + $item_price ) * ( $item_qty ));

    $queryString .= '&item_number_' . $count . '=' . urlencode($item['id']) . '<br />';
    $queryString .= '&item_name_' . $count . '=' . urlencode($item['name']) . '<br />';
    $queryString .= '&amount_' . $count . '=' . urlencode($item['price']) . '<br />';
    $queryString .= '&quantity_' . $count . '=' . urlencode($item['qty']) . '<br /><br />';

    $arr_prod_order = array( "orders_id"    => $orders_id,
                             "item_id"      => $item_id,
                             "item_price"   => $item_price,
                             "product_tax"  => $tax,
                             "final_price"  => $final_price,
                             "quantity"     => $item_qty
                            );

    # Save data to sendmail
    $item = str_replace("+", " ", $item_name);
    $tr_data_mail .= "<tr>
                        <td>$item</td>
                        <td>" . LBL_CURRENCY . " $item_price</td>
                        <td>" . LBL_CURRENCY . " $tax</td>
                        <td>$item_qty</td>
                        <td>" . LBL_CURRENCY . " $final_price</td>
                      </tr>";

    # Increment the counter
    ++$count;

    // Insert
    GenericSql::insertOrderProducts( $arr_prod_order );
}



/*
 * Print the order on the screen to confirmation purposes only (it can be printed by customer and we also send a copy to the customer email)
 */
# Returns the town's name
$town_name  = GenericSql::getTownsNameById( $arr_customer['town'] );
if( $town_name['nome'] == "") $tn = $arr_customer['town']; else $tn = $town_name;

$order_data = '<center><pre>';
$order_data .= '<a href="menu"><img src="images/logo/'.$array_empresa[logotipo].'" /></a><br />';
$order_data .= '<br />------------------------------------------------------------------------------------------<br />';
$order_data .= '<b> '.LBL_CUSTOMER_THANKYOU.' </b>';
$order_data .= '<br />------------------------------------------------------------------------------------------<br />';
$order_data .= '<b> '.LBL_CUSTOMER_CONFIRMATION.' </b>';
$order_data .= '<br />------------------------------------------------------------------------------------------<br />';
$order_data .= '<br />------------------------------------------------------------------------------------------<br />';
$order_data .= '<b> '.LBL_CUSTOMER_DATA.' </b>';
$order_data .= '<br />------------------------------------------------------------------------------------------<br />';
$order_data .= '<table width=550>';
$order_data .= '<tr><td>'.LBL_CUSTOMER_NAME.':</td><td>' . $arr_customer['name'] . '</td></tr>';
$order_data .= '<tr><td>'.LBL_CUSTOMER_EMAIL.':</td><td>' . $arr_customer['email'] . '</td></tr>';
$order_data .= '<tr><td>'.LBL_CUSTOMER_PHONE1.':</td><td>' . $arr_customer['phone_one'] . '</td></tr>';
$order_data .= '<tr><td colspan=2>&nbsp; </td></tr>';
$order_data .= '<tr><td colspan=2><b>'.LBL_CUSTOMER_ADDRESS_INFORMATION.'</b></td></tr>';
$order_data .= '<tr><td>'.LBL_CUSTOMER_STREET.':</td><td>' . $arr_customer['street'] . '</td></tr>';
$order_data .= '<tr><td>'.LBL_CUSTOMER_NUMBER.':</td><td>' . $arr_customer['number'] . '</td></tr>';
$order_data .= '<tr><td>'.LBL_CUSTOMER_MISC.':</td><td>' . $arr_customer['complement'] . '</td></tr>';
$order_data .= '<tr><td>'.LBL_CUSTOMER_SUBURB.':</td><td>' . $arr_customer['suburb'] . '</td></tr>';
$order_data .= '<tr><td>'.LBL_CUSTOMER_STATE.':</td><td>' . $arr_customer['state'] . '</td></tr>';
$order_data .= '<tr><td>'.LBL_CUSTOMER_TOWN.':</td><td>' . $tn . '</td></tr>';
$order_data .= '<tr><td>'.LBL_CUSTOMER_ZIPCODE.':</td><td>' . $arr_customer['zipcode'] . '</td></tr>';
$order_data .= '</table>';
$order_data .= '<br />------------------------------------------------------------------------------------------<br />';
$order_data .= '<b> '.LBL_YOUR_ORDER.' </b><br />';
$order_data .= '<table width="500"><tr style="font-weight:bold;"><td>'.LBL_SINGLE_ITEM.'</td><td>'.LBL_ITEM_PRICE.'</td><td>'.LBL_ITEM_TAX.'</td><td>'.TABLE_TR_QUANTITY.'</td><td>'.LBL_TOTAL.'</td></tr>';
$order_data .= $tr_data_mail;
$order_data .= '</table>';
$order_data .= '<br />------------------------------------------------------------------------------------------<br />';
$order_data .= $subTotal = '<b>'.LBL_TOTAL.': ' . LBL_CURRENCY . ' ' . $jcart->subtotal . '</b>';
$order_data .= '<br />------------------------------------------------------------------------------------------<br />';
$order_data .= '<br /> '.LBL_OBSERVATION_ORDER.': <i>"' . $observation_order . $_SESSION[observation_customer_order] . '"</i>';
$order_data .= '<br />------------------------------------------------------------------------------------------<br />';
$order_data .= '<i> '.LBL_RECEIPT_NOTAX.' </i>';
$order_data .= '</pre></center>';
print $order_data;   // print the receipt on screen



/*
 * Send email to customer with the detailed order
 */
if ( $jcart->subtotal != 0)
{
    try
    {
        $mail->AddReplyTo($array_empresa['email'], 'Food Ordering System');
        $mail->AddAddress($arr_customer['email'], $arr_customer['name']);             //TO
        $mail->SetFrom($array_empresa['email'], $array_empresa['nome_fantasia']);     //FROM
        $mail->AddReplyTo($array_empresa['email'], $array_empresa['nome_fantasia']);
        $mail->Subject = MAIL_SUBJECT_ORDER . ' - ' . $orders_id;
        $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
        $mail->MsgHTML($order_data);
        $mail->AddAttachment('images/logo/' . $array_empresa[logotipo] );      // attachment
        //$mail->AddAttachment('images/phpmailer_mini.gif'); // attachment
        $mail->Send();
        echo "<center><pre><img src='images/icons/check-alt.png' /> </pre></center> \n";
    }
    catch (phpmailerException $e)
    {
        echo $e->errorMessage(); //Pretty error messages from PHPMailer
    }
    catch (Exception $e)
    {
        echo $e->getMessage(); //Boring error messages from anything else!
    }
}



/*
 * Empty the cart and finalize the order
 */
$jcart->empty_cart();
unset( $_SESSION['MSGOK'] );    // unset MSGOK
unset( $_SESSION['CHECKOUT_ADD_CUSTOMER'] );
unset( $_SESSION['agenda_checkout'] ); // unset agendamento delivery



// Redirect only when the payment chosed was PayPal
if( $_GET['protocol'] != "" and $_GET['queryString'] != "" ) {
	// Send the visitor to PayPal
	//@header( 'Location: ' . $protocol . 'www' . $sandbox . '.paypal.com/cgi-bin/webscr' . $queryString );
    //GenericSql::Redirect( $sec=0, $file = $protocol . 'www' . $sandbox . '.paypal.com/cgi-bin/webscr' . $queryString );
    GenericSql::Redirect( $sec=0, $file = $paypal_url );
}
?>
