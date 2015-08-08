<?php require("../../../admin/bootstrap.php");
defined('SYSPATH_ADMIN') or die('No direct script access.');?>
<link href="../../../admin/bootstrap.css" rel="stylesheet">
<center><img src="<?=SYSPATH_PROTOCOL;?><?=SYSPATH_SERVER_ROOT;?>/images/logo-moip.png" height=""></center>
<style type="text/css">
  body {
    padding-top: 0px;
  }
</style>

<!-- SM2 BAREBONES TEMPLATE: START -->
<script type="text/javascript">
function loadScript(sURL, onLoad) {

    function loadScriptHandler() {
    var rs = this.readyState;
        if (rs == 'loaded' || rs == 'complete') {
            this.onreadystatechange = null;
            this.onload = null;
            if (onLoad) {
                onLoad();
            }
        }
    }

    function scriptOnload() {
        this.onreadystatechange = null;
        this.onload = null;
        window.setTimeout(onLoad,20);
    }
    var oS = document.createElement('script');
    oS.type = 'text/javascript';
    if (onLoad) {
        oS.onreadystatechange = loadScriptHandler;
        oS.onload = scriptOnload;
    }
    oS.src = sURL;
    document.getElementsByTagName('head')[0].appendChild(oS);
}

function msg(s) {
  document.getElementById('sm2-status').innerHTML = s;
}

window.onload = function() {
  msg('Window loaded, waiting ..');
  setTimeout(function() {
    msg('Loading js script ..');
    loadScript('soundmanager2.js', function() {

      // SM2 script has loaded
      soundManager.url = 'soundmanager/swf/';
      soundManager.onready(function() {
        soundManager.createSound({
          id:'foo',
          url:'sounds/beep-1.mp3'
        }).play();
        msg('');
      });

      soundManager.ontimeout(function() {
        msg('Loaded OK, but unable to start: unsupported/flash blocked, etc.');
      });

      soundManager.beginDelayedInit(); // ensure start-up in case document.readyState and/or DOMContentLoaded are unavailable
    });
  },100);
}
</script>
<!-- SM2 BAREBONES TEMPLATE: START -->

<?php
//error_reporting(0);
$payment_date = date("Y-m-d 00:00:01");

//Include the autoload function
include_once 'autoload.inc.php';
require('../../../includes/config/config.php');
//require('../../../includes/Sql/sql.class.php');

//Uses the MoIPNASP class to persist information in a database
//Instance new object MoIPNASP()
$nasp = new MoIPNASP();

//Set the database informations
$nasp->setDatabase("$host","$bd","$user","$pass");

$results = $nasp->getDataByDate($payment_date);

// MoIP - API
/*
Anexo A - Status das transações no MoIP  (Campo status do pagamento)
Status 	           |Código |Descrição
-------------------|-------|-----------------
autorizado 	        1 	    Pagamento já foi realizado porém ainda não foi creditado na Carteira MoIP recebedora (devido ao floating da forma de pagamento)
iniciado 	        2 	    Pagamento está sendo realizado ou janela do navegador foi fechada (pagamento abandonado)
boleto impresso 	3 	    Boleto foi impresso e ainda não foi pago
concluido 	        4 	    Pagamento já foi realizado e dinheiro já foi creditado na Carteira MoIP recebedora
cancelado 	        5 	    Pagamento foi cancelado pelo pagador, instituição de pagamento, MoIP ou recebedor antes de ser concluído
em análise 	        6 	    Pagamento foi realizado com cartão de crédito e autorizado, porém está em análise pela Equipe MoIP. Não existe garantia de que será concluído
estornado 	        7 	    Pagamento foi estornado pelo pagador, recebedor, instituição de pagamento ou MoIP
-------------------|-------|-----------------

    //3 = Visa
    //5 = mastercard
    //6 = Diners
    //7 = Amex (American Express)
*/

// Refresh every XX seconds Recommended run every 30 seconds when in production
echo "<meta http-equiv=\"refresh\" content=\"55;url={$_SERVER['PHP_SELF']}\" />";
echo "<h2>&Uacute;ltimas Transa&ccedil;&otilde;es</h2>";
echo "<table class='zebra-striped'>
        <tr>
            <td><b>DATA</b></td><td><b>TRANSA&Ccedil;&Atilde;O</b></td><td><b>VALOR</b></td><td><b>STATUS PGTO.</b></td><td><b>ID MOIP</b></td><td><b>FORMA PGTO.</b></td><td><b>TIPO PGTO.</b></td><td><b>EMAIL</b></td><td><b>ENTREGA</b></td>
        </tr>";


//Get the informations by date
$payment_date = date("Y-m-d 00:00:01");
$sql = "SELECT * FROM moip_nasp WHERE data_hora_transacao >= '{$payment_date}'";
$res = mysql_query($sql) or die("Erro: moip nasp");
while ($row = mysql_fetch_array($res))
{

    $id                 = $row['id'];     //ID index primary key
    $id_transacao       = $row['id_transacao'];
    $valor              = $row['valor'];
    $status_pagamento   = $row['status_pagamento'];
    $cod_moip           = $row['cod_moip'];
    $forma_pagamento    = $row['forma_pagamento'];
    $tipo_pagamento     = $row['tipo_pagamento'];
    $email_consumidor   = $row['email_consumidor'];
    $data_transacao     = $row['data_hora_transacao'];
    
    if ( $status_pagamento == 2 ) $stat = "Iniciado";
    if ( $status_pagamento == 4 ) $stat = "Concluido";

    if ( $forma_pagamento == 3 ) $cc = "Visa";
    if ( $forma_pagamento == 5 ) $cc = "Mastercard";
    if ( $forma_pagamento == 6 ) $cc = "Diners";
    if ( $forma_pagamento == 7 ) $cc = "Amex";

    // Status da entrega
    $sql2 = "SELECT status_entrega FROM delivery WHERE id='$id'";
    $res2 = mysql_query($sql2) or die("Erro: delivery");
    $row2 = mysql_fetch_array($res2);
        $status_entrega = $row2['status_entrega'];
        if ( $status_entrega == 1 ) $se = "<a href='#'><img src='../../../images/icons/check-alt.png' title='Entregue - Finalizado' alt='Entregue - Finalizado' /></a>";
        if ( $status_entrega == 2 ) $se = "<a href='#'><img src='../../../images/icons/arrow-repeat.png' title='Retornado por algum problema' /></a>";
        if ( $status_entrega == 3 ) $se = "<a href='#'><img src='../../../images/icons/clock-bolt.png' title='Em Andamento - A caminho do cliente' /></a>";
        if ( $status_entrega == 4 ) $se = "<a href='#'><img src='../../../images/icons/clock-grey.png' title='Preparando' /></a>";

    $tr .= "<tr>
           <td>$data_transacao</td><td>$id_transacao</td><td>$valor</td><td>$status_pagamento - $stat</td><td>$cod_moip</td><td>$forma_pagamento - $cc</td><td>$tipo_pagamento</td><td>$email_consumidor</td><td> $se </td>
           </tr>";
}

echo $tr;
echo "</table>";


// Loop responsável por receber dados do NASP - AVISO SONORO DE PEDIDOS - ASDP
foreach ($results as $res => $value)
{
    $status_pagto = $results[$res]['status_pagamento'];
    $transacao = $results[$res]['id_transacao'];
    if ( $status_pagto == 1 )
    {
    ?>
        <p><b id="sm2-status"> AUTORIZADO (COD. 1) - Pedido Liberado para Envio </b></p>
        <!-- SM2 BAREBONES TEMPLATE: START -->
            <div style="margin-right:23em">
                <p>Status do pagamento: <b id="sm2-status"> Transação <?=$transacao;?> - Pagamento AUTORIZADO (COD. 1) - Pedido Liberado para Envio </b></p>
            </div>
        <!-- SM2 BAREBONES TEMPLATE: START -->
    <?
    }

    //echo $status_pagto = $results[$res]['status_pagamento'];
    if ( $status_pagto == 4 )
    {
    ?>
        <!-- SM2 BAREBONES TEMPLATE: START -->
            <div style="margin-right:23em">
                <p>Status do pagamento: <b id="sm2-status"> Transação <?=$transacao;?> - Pagamento CONCLUIDO (COD. 4) - Pedido Liberado para Envio </b></p>
            </div>
        <!-- SM2 BAREBONES TEMPLATE: START -->
    <?
    }
}


?>
