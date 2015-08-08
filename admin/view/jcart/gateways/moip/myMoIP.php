<?php
require("../../../includes/config/config.php");
require("../../../includes/Sql/sql.class.php");
$t_id_trans = GenericSql::getIdTransacaoMoipNasp( );
$id_trans   = $t_id_trans[id_transacao]+1;    //ID da transacao +1

$token      = "FY4OJHCFUQDPF2IDG1HPNMWDV1ZRNNZP";
$key        = "MF6P74WB6D5PKZG8YFGOKP0JYL4VUIT9AW8BKZ0D";
$base       = $token . ":" . $key;
$auth       = base64_encode($base);
$header[]   = "Authorization: Basic " . $auth;
$param      = "
<EnviarInstrucao>
    <InstrucaoUnica> <!-- Identificador do tipo de instrução --> 
    <!-- *********** DADOS OBRIGATÓRIOS *********** -->
        <Razao>KIMTHAI DELIVERY [PEDIDO]</Razao>
    <!-- *********** DADOS RECOMENDADOS *********** -->
        <FormasPagamento>
            <FormaPagamento>CarteiraMoIP</FormaPagamento>
            <FormaPagamento>CartaoCredito</FormaPagamento>
            <FormaPagamento>DebitoBancario</FormaPagamento>
        </FormasPagamento>
        <Valores>
             <Valor moeda='BRL'>".$_GET['subtotal']."</Valor>
        </Valores>
        <IdProprio>order".$id_trans."</IdProprio>
        <DataVencimento>2012-05-15 T23:59:48.703-02:00</DataVencimento>
        <Mensagens>
            <Mensagem>O prazo de entrega varia entre 30 e 60 minutos dependendo da sua região.</Mensagem>
        </Mensagens>
    <!-- *********** DADOS DA ENTREGA *********** -->
        <Entrega>
            <Destino>AInformar</Destino>
            <CalculoFrete>
                <Tipo>Proprio</Tipo>
                <ValorFixo>1.00</ValorFixo>
            </CalculoFrete>
        </Entrega>
    </InstrucaoUnica>
</EnviarInstrucao>
";
$curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://desenvolvedor.moip.com.br/sandbox/ws/alpha/EnviarInstrucao/Unica");
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_USERPWD, $user . ":" . $passwd);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0");
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $param);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$ret = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

$tokenretornado = new SimpleXMLElement($ret);
echo $token_resposta = $tokenretornado->Resposta->Token;
//die("debugging");
header("Location: https://desenvolvedor.moip.com.br/sandbox/Instrucao.do?token=" . $token_resposta);


