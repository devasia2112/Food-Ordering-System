<?php
require('../../includes/config/config.php');
require('../../includes/Sql/sql.class.php');

if (isset($_POST['submitted'])) 
{
    foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); }
    $sql = "INSERT INTO `fornecedor` ( `nome_fantasia` ,  `razao_social` ,  `endereco` ,  `numero` ,  `bairro` ,  `complemento` ,  `pais`,  `estado` ,  `cidade` ,  `cep` ,  `doc_valido1` ,  `doc_valido2` ,  `obs` ,  `tel1` ,  `tel2`,  `resp1`,  `resp2`,  `fax`,  `data`,  `website`, `website_fb`, `gmap`, `email` ,  `default` ,  `logotipo` ,  `ativo` ,  `doc_valido3` ,  `cnae` ,  `crt`, `abre`, `fecha`) VALUES(  '{$_POST['nome_fantasia']}' ,  '{$_POST['razao_social']}' ,  '{$_POST['endereco']}' ,  '{$_POST['numero']}' ,  '{$_POST['bairro']}' ,  '{$_POST['complemento']}' ,  '{$_POST['pais']}' ,  '{$_POST['estado']}' ,  '{$_POST['cidade']}' ,  '{$_POST['cep']}' ,  '{$_POST['cnpj']}' ,  '{$_POST['ie']}' ,  '{$_POST['obs']}' ,  '{$_POST['tel1']}' ,  '{$_POST['tel2']}' ,  '{$_POST['resp1']}' ,  '{$_POST['resp2']}' ,  '{$_POST['fax']}' ,  '{$_POST['data']}' ,  '{$_POST['website']}' , '{$_POST['website_fb']}', '{$_POST['gmap']}', '{$_POST['email']}' ,  '{$_POST['default']}', '{$_POST['logotipo']}', '{$_POST['ativo']}', '{$_POST['im']}', '{$_POST['cnae']}', '{$_POST['crt']}', '{$_POST['abre']}', '{$_POST['fecha']}') ";
    mysql_query($sql) or die(mysql_error());
    echo "<SCRIPT LANGUAGE=\"JavaScript\" TYPE=\"text/javascript\"> alert(\"Dados do fornecedor gravados com sucesso!\") </script>";

	GenericSql::Redirect( $sec=0, $file="../view/supplier-select.php" );
}
?>
