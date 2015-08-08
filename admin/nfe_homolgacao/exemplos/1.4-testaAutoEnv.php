<?php
/**
 * Exemplo de uso do método autoEnvNFe()
 * Serão enviadas para a SEFAZ, conforme definido pelo arquivo config.php, as NFe contidas na pasta "validadas",
 * caso a conversão seja bem sucedida os arquivos txt serão movidos para a pasta "temporarias".
 *   
 * As funções auto contidas na classe seguem uma determinada lógica
 * e movimentam as NFes pelos diretorios da estrutura.
 * 
 * Estas são funções simplificadas que podem ser utilizadas em linha de comando com 
 * o CRON para automatizar as tarefas de gestão das NFe.
 * 
 * As funções auto não são muito adequadas para o tratamento de erros !!!
 * Portanto é desaconselhado seu uso em ambiente Produção, sem outras 
 * ações que permitam o tratamento dos erros.
 * 
 * Recomenda-se o teste e leitura atenta das mesmas antes de tentar por em uso.
 *
error_reporting(E_ALL);
require_once('../libs/AutoToolsNFePHP.class.php');
$nfe = new ToolsNFePHP;
if (!$nfe->autoEnvNFe()){
    echo $nfe->errMsg;
}
*/
?>
<?php
/*
 * Exemplo de envio de Nfe já assinada e validada
 */
require_once('../libs/ToolsNFePHP.class.php');
$nfe = new ToolsNFePHP;
$modSOAP = '2'; //usando cURL

//use isso, este é o modo manual voce tem mais controle sobre o que acontece  
$filename = '/home/kinthai/www/Delivery/admin/nfe_homolgacao/nfe-xml/homologacao/assinadas/35100258716523000119550000000033453539003003-nfe-sign.xml';
//obter um numero de lote
$lote = substr(str_replace(',','',number_format(microtime(true)*1000000,0)),0,15);
// montar o array com a NFe
$aNFe = array(0=>file_get_contents($filename));
//enviar o lote
if ($aResp = $nfe->sendLot($aNFe, $lote, $modSOAP)){
    if ($aResp['bStat']){
        echo "Numero do Recibo : " . $aResp['nRec'] .", use este numero para obter o protocolo ou informações de erro no xml com testaRecibo.php.";  
    } else {
        echo "Houve erro !! $nfe->errMsg";
    }
} else {
    echo "houve erro !!  $nfe->errMsg";
}
echo '<BR><BR><h1>DEBUG DA COMUNICAÇÃO SOAP</h1><BR><BR>';
echo '<PRE>';
echo htmlspecialchars($nfe->soapDebug);
echo '</PRE><BR>';
?>
