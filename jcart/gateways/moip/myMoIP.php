<?php
include_once("../../jcart.php");
session_start();

require("../../../includes/config/config.php");
require("../../../includes/Sql/sql.class.php");


/*
 * Query value of personal chef service : the value must be provided after the customer request the service (i is very important to have a value here, otherwise the checkout will be only products of the menu)
 */
$pcs_orders = GenericSql::getPCSOrdersByOrderId( $_SESSION['PCS']['order_id'] );
// generate total to send to gateway
$valor_total = ( $pcs_orders['chef_service_price'] + $_GET['subtotal'] );



/*
* MAKE THE ORDER :: Insert in orders and order products table
*/
// validação de sessão
if (!isset($_SESSION['payment_method_id']) and $_SESSION['payment_method_id'] == "") die("Session expired!");

// Query customer data by email to fill the fields in the form
$customer_id       	= $_SESSION['IDCUSTOMER'];             	//customer ID
$observation_order 	= $_SESSION['observation_order'];    	// customer observation
$payment_method_id 	= $_SESSION['payment_method_id'];

// unset sessions
unset( $_SESSION['observation_order'] );
unset( $_SESSION['payment_method_id'] );

// The Payment Method ID
$paym_id = GenericSql::setPaymentType( $payment_method_id );

// Insert new order
$orders_id = GenericSql::insertOrders( $customer_id, $paym_id );


// Indexa o numero do pedido de personal chef ao numero do pedido dos produtos escolhidos no catalogo
// If order from PCS personal chef service then
if ( !empty( $_SESSION['PCS']['order_id'] )) { 
  
  $order_id_pcs = $_SESSION['PCS']['order_id'];
  GenericSql::updateOrdersPCS( $order_id_pcs, $orders_id );

}


// Insert the observation order of the customer
GenericSql::insertOrdersObservation( $orders_id, $observation_order );

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
    
    // Insert
    GenericSql::insertOrderProducts( $arr_prod_order );
}


/*  MODELO 
    <!-- *********** DADOS DA ENTREGA *********** -->
        <Entrega>
            <Destino>AInformar</Destino>
            <CalculoFrete>
                <Tipo>Proprio</Tipo>
                <ValorFixo></ValorFixo>
            </CalculoFrete>
        </Entrega>
        <DataVencimento>2012-10-10 T23:59:48.703-02:00</DataVencimento>
 */
// Pega o ultimo ID da transação MOIP
$t_id_trans = GenericSql::getIdTransacaoMoipNasp( );	//$t_id_trans[id_transacao]

$id_trans   = (int) $orders_id;    //ID da transacao (Esse ID é enviado para o MOIP como sendo o ID próprio)





// PEDIDOS NO AMBIENTE DE PRODUCAO ESTAO INICIANDO COM O ID 1 A PARTIR DE 2013-10-03
// PARA TESTAR NO AMBIENTE SANDBOX USAR O ID ($id_trans) ABAIXO PARA TESTES
// $id_trans  += 3100;




// MODELO COMPLETO DO XML MOIP
// https://labs.moip.com.br/parametro/InstrucaoUnica/



// Ambiente Desenvolvimento
//$token      = "FY4OJHCFUQDPF2IDG1HPNMWDV1ZRNNZP";
//$key        = "MF6P74WB6D5PKZG8YFGOKP0JYL4VUIT9AW8BKZ0D";

// Ambiente Producao
$token      = "AIE6FV9K5SVHGWTSFYBAP7MNWNTKWCTH";
$key        = "GVNF71VYD94AUFBMJGPIHJFHSLVAQYJWB3ZQIRDL";

$base       = $token . ":" . $key;
$auth       = base64_encode( $base );
$header[]   = "Authorization: Basic " . $auth;		// onde esta 3333333333333333333333333333 trocar por   " . $id_trans . "
$param      = "
<EnviarInstrucao>
    <InstrucaoUnica> <!-- Identificador do tipo de instrução -->
    <!-- *********** DADOS OBRIGATÓRIOS *********** -->
        <Razao>KINTHAI BRASIL [NOVO PEDIDO]</Razao>
    <!-- *********** DADOS RECOMENDADOS *********** -->
        <FormasPagamento>
            <FormaPagamento>CarteiraMoIP</FormaPagamento>
            <FormaPagamento>CartaoCredito</FormaPagamento>
            <FormaPagamento>BoletoBancario</FormaPagamento>
        </FormasPagamento>
        <Valores>
             <Valor moeda='BRL'>" . (float) $valor_total . "</Valor>
        </Valores>
        <!-- como isso ja foi testado muito, usar um valor alto para o ambiente de teste -->
        <IdProprio>" . $id_trans . "</IdProprio>
        <Mensagens>
            <Mensagem>R$ " . $pcs_orders['chef_service_price'] . " do servico prestado pelo Chef  foi adicionado a sua compra. Avisaremos via e-mail ou telefone quando o seu pagamento estiver concluido.</Mensagem>
        </Mensagens>
    </InstrucaoUnica>
</EnviarInstrucao>
";
// Mensagem usada para o Delivery apenas: O prazo de entrega varia entre 30 e 60 minutos dependendo da sua região.


//curl_setopt($curl, CURLOPT_URL, "https://www.moip.com.br/ws/alpha/EnviarInstrucao/Unica");
//curl_setopt($curl, CURLOPT_URL, "https://desenvolvedor.moip.com.br/sandbox/ws/alpha/EnviarInstrucao/Unica");
$curl = curl_init();
        //curl_setopt($curl, CURLOPT_URL, "https://desenvolvedor.moip.com.br/sandbox/ws/alpha/EnviarInstrucao/Unica");
        curl_setopt($curl, CURLOPT_URL, "https://www.moip.com.br/ws/alpha/EnviarInstrucao/Unica");
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_USERPWD, $base);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0");
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $param);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$ret = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);


/*
print "<pre>";
print $id_trans;
var_dump( $ret );
var_dump( $err );
print "</pre>";
*/


$tokenretornado = new SimpleXMLElement($ret);
$token_resposta = $tokenretornado->Resposta->Token;



// Empty the cart
$jcart->empty_cart();

// unset session for PCS personal chef service
unset( $_SESSION['PCS'] );

GenericSql::Redirect($sec=0, $file="https://desenvolvedor.moip.com.br/sandbox/Instrucao.do?token=" . $token_resposta);
?>
