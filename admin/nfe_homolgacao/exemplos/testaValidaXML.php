<?php
require_once('../libs/ToolsNFePHP.class.php');
$arq = './35101158716523000119550010000000011003000000-nfe.xml';
//$arq = './35120358716523000119550000000162421280334154-nfe.xml';



$nfe = new ToolsNFePHP;
$docxml = file_get_contents($arq);
$xsdFile = '/opt/lampp/htdocs/Delivery/admin/nfe/schemes/PL_006j/nfe_v2.00.xsd';
$aErro = '';
$c = $nfe->validXML($docxml,$xsdFile,$aErro);
if (!$c){
    echo 'Houve erro --- <br>';
    foreach ($aErro as $er){
        echo $er .'<br>';
    }
} else {
    echo 'VALIDADA!';
}
?>
