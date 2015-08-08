<?php require("../bootstrap.php");
defined('SYSPATH_ADMIN') or die('No direct script access.');
include( '../..' . SYSPATH_CONNECTION );
include( '../..' . SYSPATH_LANG );
require_once ("../../includes/PHPMailer/class.phpmailer.php");
require("../../includes/Sql/sql.class.php");
require("../../includes/config/config-aux.php");
// If your page calls session_start() be sure to include jcart.php before session_start();
include_once('jcart/jcart.php');
session_start();

# Call the connection to B2Stok (from config-aux.php)
$mysqli = MysqliConnect();



/*
 * Execute Sales only if it comes from a POST (sales-checkout.php)
 */
if ( $_POST ) {

	/*
	* POST vars
	*/
	$customer_id = $_POST['customer_id'];
	$payment_method_id = $_POST['payment_type'];
	$observation_order = $_POST['observation_order'];

	/* new 2013-12-26 */
	$data_agendamento = $_POST['data_agendamento'];
	$options = $_POST['options'];
	$cupom = $_POST['cupom'];
	$cupom_numero = $_POST['cupom_numero'];
	$cupom_desconto = $_POST['cupom_desconto'];
	/* new 2013-12-26 */



	/*
	* Call data from database
	*/
	$mail           = new PHPMailer(true); //defaults to using php "mail()"; the true param means it will throw exceptions on errors, which we need to catch
	$array_empresa  = GenericSql::getEmpresa( );
	$arr_customer   = GenericSql::getCustomerById( $customer_id );  //Get all datas from customer's table


	/*
	* MAKE THE ORDER :: Insert in orders and order products table
	*/
	// The Payment Method ID
	$paym_id = GenericSql::setPaymentType( $payment_method_id );

	// Insert new order
	$orders_id = GenericSql::insertOrders( $customer_id, $paym_id );

	// Insert the observation order of the customer
	$array_oders_obs = array( "orders_id"=>$orders_id, "observation_order"=>$observation_order, 
							  "data_agendamento"=>$data_agendamento, "options"=>$options, 
							  "cupom"=>$cupom, "cupom_numero"=>$cupom_numero );
	GenericSql::insertOrdersObservation( $array_oders_obs );



	#######INTEGRACAO B2STOK######### NAO ESTA MAIS SENDO USADO ESSE PROGRAMA TEM MUITO BUG
	// Insert Pedidos no banco B2Stok Retaguarda
	$totalPedido = $jcart->subtotal;
	//GenericSql::b2stokOrders( $mysqli, $orders_id, $totalPedido, $arr_customer );
	#######INTEGRACAO B2STOK#########


	#######GRAVA INVOICE_RECEIVABLE############## 
	// Aplicavel quando necessario, o maior uso do desconto esta relacionado aos cupoms (groupon, peixe urbano, clickon , etc..))
	$total_with_discount = ( $totalPedido - $cupom_desconto );
	$array_invoice = array( "customer_id"=>$customer_id, "orders_id"=>$orders_id, "observation_order"=>$observation_order, "totalPedido"=>$totalPedido, "observation_order"=>$observation_order, "cupom_desconto"=>$cupom_desconto, "observation_order"=>$observation_order, "total_with_discount"=>$total_with_discount );
	$res_inv_receivable = GenericSql::insertInvoicesReceivable( $array_invoice );
	#######GRAVA INVOICE_RECEIVABLE############## 



	// Insert new order produtcts
	foreach ($jcart->get_contents() as $item) 
	{
		// If have a tax to add to the products it must be done right here.
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

		// Save data to sendmail
		$item = str_replace("+", " ", $item_name);
		$tr_data_mail .= "<tr>
							<td>$item</td>
							<td>" . LBL_CURRENCY . " $item_price</td>
							<td>" . LBL_CURRENCY . " $tax</td>
							<td>$item_qty</td>
							<td>" . LBL_CURRENCY . " $final_price</td>
						</tr>";    

		// Increment the counter
		++$count;
		
		// Insert Order
		GenericSql::insertOrderProducts( $arr_prod_order );


		#######INTEGRACAO B2STOK#########  NAO ESTA MAIS SENDO USADO
		// Insert into b2stok database - insert de itens da nota fiscal de pedidos
		//GenericSql::b2stokOrdersNotaFiscal( $mysqli, $count, $arr_prod_order );
		#######INTEGRACAO B2STOK#########
	}



	/*
	* Print the order on the screen to confirm purposes
	*/
	// Returns the town's name
	$town_name  = GenericSql::getTownsNameById( $arr_customer['town'] );

	$confirmation = file_get_contents('../../includes/Mails/confirmation');
	$order_data = '<center><pre>';
	$order_data .= '<a href="sales.php"><img src="../../images/logo/'.$array_empresa[logotipo].'" /></a><br />';
	$order_data .= $confirmation;
	$order_data .= '<br />------------------------------------------------------------------------------------------<br />';
	$order_data .= '<b>DADOS DO CLIENTE </b>';
	$order_data .= '<br />------------------------------------------------------------------------------------------<br />';

	$order_data .= '<table width=550>';
	$order_data .= '<tr><td>Nome:</td><td>' . $arr_customer['name'] . '</td></tr>';
	$order_data .= '<tr><td>Email:</td><td>' . $arr_customer['email'] . '</td></tr>';
	$order_data .= '<tr><td>Telefone:</td><td>' . $arr_customer['phone_one'] . '</td></tr>';
	$order_data .= '<tr><td colspan=2>&nbsp; </td></tr>';
	$order_data .= '<tr><td colspan=2><b>Endere&ccedil;o da entrega</b></td></tr>';
	$order_data .= '<tr><td>Rua:</td><td>' . $arr_customer['street'] . '</td></tr>';
	$order_data .= '<tr><td>Numero:</td><td>' . $arr_customer['number'] . '</td></tr>';
	$order_data .= '<tr><td>Complemento:</td><td>' . $arr_customer['complement'] . '</td></tr>';
	$order_data .= '<tr><td>Bairro:</td><td>' . $arr_customer['suburb'] . '</td></tr>';
	$order_data .= '<tr><td>Estado:</td><td>' . $arr_customer['state'] . '</td></tr>';
	$order_data .= '<tr><td>Cidade:</td><td>' . $town_name['nome'] . '</td></tr>';
	$order_data .= '<tr><td>Cep:</td><td>' . $arr_customer['zipcode'] . '</td></tr>';
	$order_data .= '</table>';
	$order_data .= '<br />------------------------------------------------------------------------------------------<br />';
	$order_data .= '<b>DADOS DO PEDIDO </b><br />';
	$order_data .= '<table width="500"><tr style="font-weight:bold;"><td>Item</td><td>Valor</td><td>Imposto</td><td>Quatde.</td><td>Total</td></tr>';
	$order_data .= $tr_data_mail;
	$order_data .= '</table>';
	$order_data .= '<br />------------------------------------------------------------------------------------------<br />';
	$order_data .= $subTotal = '<b>Total: ' . LBL_CURRENCY . ' ' . $jcart->subtotal . '</b>';
	$order_data .= '<br />------------------------------------------------------------------------------------------<br />';
	$order_data .= '<br />OBSERVA&Ccedil;&Otilde;ES DO CLIENTE: <i>"' . $observation_order . $_SESSION['observation_customer_order'] . '"</i>';
	$order_data .= '<br />------------------------------------------------------------------------------------------<br />';
	$order_data .= '<i>Este recibo n&atilde;o possui valor fiscal.</i>';
	$order_data .= '</pre></center>';
	print $order_data;   // print the receipt on screen



	/*
	* Send email to customer with the detailed order
	*/
	if ( $jcart->subtotal != 0)
	{
		try 
		{
			$mail->AddReplyTo($array_empresa['email'], 'First Last');
			$mail->AddAddress($arr_customer['email'], $arr_customer['name']);             //TO
			$mail->SetFrom($array_empresa['email'], $array_empresa['nome_fantasia']);     //FROM
			$mail->AddReplyTo($array_empresa['email'], $array_empresa['nome_fantasia']);
			$mail->Subject = MAIL_SUBJECT_ORDER . ' - ' . $orders_id;
			$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
			$mail->MsgHTML($order_data);
			$mail->AddAttachment('../../images/logo/logo_oficial.png');      // attachment
			//$mail->AddAttachment('images/phpmailer_mini.gif'); // attachment
			//$mail->Send();
			echo "<center><pre><img src='../../images/icons/check-alt.png' /> </pre></center> \n";
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
	//var_dump($_SESSION);
}
else
{
	die('No direct access!');
}
