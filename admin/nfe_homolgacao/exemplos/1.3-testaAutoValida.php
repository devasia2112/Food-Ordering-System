<?php
/**
 * Exemplo de uso do método autoValidNFe()
 * Serão validadas contra o XSD as NFe já assinadas contidas na pasta "assinadas", 
 * caso a validação seja bem sucedida os arquivos serão movidos para a pasta "validadas",
 * caso contrario serão movidos para a pasta "rejeitadas".
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
if (!$nfe->autoValidNFe()){
    echo $nfe->errMsg;
}
 */
?>
<?php
/**
 * Este é um exemplo de uso do método validXML que confere se o xml 
 * assinado de uma NFe atende aos critérios do seu schema
 * Note que não devemos aplicar esse método as NFe que já tenham incorporados 
 * seus proptocolos de aceitação da SEFAZ pois vai gerar erro.
 * E isso é lógico pois esse método deve ser usado antes de submeter a NFe ao SEFAZ
 * e portanto antes de receber o protocolo.
 */
//carregue a classe
require_once('../libs/ToolsNFePHP.class.php');
header('Content-type: text/html; charset=UTF-8');
//instancie a classe
$nfe = new ToolsNFePHP;
echo '<BR><BR><BR>Teste Validação<BR><BR><BR>';
//defina o arquivo da NFe assinado que deseja validar
$file = '/home/kinthai/www/Delivery/admin/nfe_homolgacao/nfe-xml/homologacao/assinadas/35100258716523000119550000000033453539003003-nfe-sign.xml';
if (file_exists($file)){
    //se o arquivo existir, carregue o em uma string
    $docXml = file_get_contents($file);
    //coloque o path completo para o schema a ser usado
    $pathXSD = '/home/kinthai/www/Delivery/admin/nfe_homolgacao/schemes/PL_006j/nfe_v2.00.xsd';
    //verifique a validade do xml em relação ao seu schema construtivo
    $aRet = $nfe->validXML($docXml, $pathXSD);
    if (!$aRet['status']) {
        echo str_replace("\n","<br>",$aRet['error']);
    }
}
?>
