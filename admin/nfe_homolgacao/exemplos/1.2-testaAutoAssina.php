<?php
/**
 * Exemplo de uso do método autoSignNFe()
 * Serão assinadas todas as NFe, em xml, que se encontrarem na pasta "entradas", com a terminação "*-nfe.xml",
 * caso a assinatura seja bem sucedida os xml serão movidos para a pasta "assinadas".
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
if (!$nfe->autoSignNFe()){
    echo $nfe->errMsg;
}
 */
?>



<?php
/**
 * Este é um exemplo do uso do método de assinatura digital do xml 
 * da NFe
 * Esse método recebe a NFe como uma "string" com o conteúdo do xml e o 
 * nome da "tag" xml que deverá ser assinada
 * 
 */
//carregue as classes
require_once('../libs/ToolsNFePHP.class.php');
//as classes desabilitam os erros e avisos por padrão então
//enquanto você está desenvolvendo reabilite os avisos de erros
error_reporting(E_ALL);ini_set('display_errors', 'On');
//instancie a classe tools
$nfe = new ToolsNFePHP();
//escolha o xml a ser assinado
#$arqxml = './35100258716523000119550000000033453539003003-nfe.xml';
$arqxml = './0008-nfe.xml';

//determine o novo local para o esse xml depois de assinado
$novonome = '/home/kinthai/www/Delivery/admin/nfe_homolgacao/nfe-xml/homologacao/assinadas/35100258716523000119550000000033453539003003-nfe-sign.xml';
//verifique se o xml existe
if ( is_file($arqxml) ) {
    //se o xml for achado então carregue o xml todo em uma string
    $nfefile = file_get_contents($arqxml);
    //tente assinar o xml na tag "infNFe", pois se trata de uma NFe 
    if ( $signn = $nfe->signXML($nfefile, 'infNFe') ) {
        //se houve retorno do método então o xml foi assinado
        echo "NFe foi Assinada ..<br />";
        //tente gravar esse xml assinado na nova localização
        if ( file_put_contents($novonome, $signn) ) {
            //a gravação foi um sucesso, apague o arquivo xml original
            unlink($arqxml);
            echo "SUCESSO !!! NFe assinada em $novonome. <br />";
        } else {
            echo "FALHA na gravação da NFe Assinada!! <br />";
        }
    } else {
        echo "FALHA NFe não assinada!!!! <br />";
        echo $nfe->errMsg;
    } //fim signXML    
} //fim file existe
//Fim do exemplo
?>
