<?php
require('../../includes/config/config.php');
require('../../includes/Sql/sql.class.php');

if (isset($_POST['submitted'])) 
{
    foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); }
    $sql = "INSERT INTO `empresa` ( `nome_fantasia` ,  `razao_social` ,  `endereco` ,  `numero` ,  `bairro` ,  `complemento` ,  `estado` ,  `cidade` ,  `cep` ,  `cnpj` ,  `ie` ,  `obs` ,  `tel1` ,  `tel2`,  `resp1`,  `resp2`,  `fax`,  `data`,  `website`, `website_fb`, `gmap`, `email` ,  `default` ,  `logotipo` ,  `ativo` ,  `IM` ,  `cnae` ,  `crt`, `abre`, `fecha`, `frontend`) VALUES(  '{$_POST['nome_fantasia']}' ,  '{$_POST['razao_social']}' ,  '{$_POST['endereco']}' ,  '{$_POST['numero']}' ,  '{$_POST['bairro']}' ,  '{$_POST['complemento']}' ,  '{$_POST['estado']}' ,  '{$_POST['atualiza']}' ,  '{$_POST['cep']}' ,  '{$_POST['cnpj']}' ,  '{$_POST['ie']}' ,  '{$_POST['obs']}' ,  '{$_POST['tel1']}' ,  '{$_POST['tel2']}' ,  '{$_POST['resp1']}' ,  '{$_POST['resp2']}' ,  '{$_POST['fax']}' ,  '{$_POST['data']}' ,  '{$_POST['website']}' , '{$_POST['website_fb']}', '{$_POST['gmap']}', '{$_POST['email']}' ,  '{$_POST['default']}', '{$_POST['logotipo']}', '{$_POST['ativo']}', '{$_POST['im']}', '{$_POST['cnae']}', '{$_POST['crt']}', '{$_POST['abre']}', '{$_POST['fecha']}', '{$_POST['content']}') "; 
    mysql_query($sql) or die(mysql_error());
    echo "<SCRIPT LANGUAGE=\"JavaScript\" TYPE=\"text/javascript\"> alert(\"Dados da empresa gravados com sucesso!\") </script>";

	GenericSql::Redirect( $sec=0, $file="../view/company-select.php" );
}
?>
<?php
/*
 $allowedTags='<p><strong><em><u><h1><h2><h3><h4><h5><h6><img>';
 $allowedTags.='<li><ol><ul><span><div><br><ins><del>';  
// Should use some proper HTML filtering here.
  if($_POST['elm1']!='') {
    $sHeader = '<h1>Ah, content is king.</h1>';
    $sContent = strip_tags(stripslashes($_POST['elm1']),$allowedTags);
} else {
    $sHeader = '<h1>Nothing submitted yet</h1>';
    $sContent = '<p>Start typing...</p>';
    $sContent.= '<p><img width="107" height="108" border="0" src="/mediawiki/images/badge.png"';
    $sContent.= 'alt="TinyMCE button"/>This rover has crossed over</p>';
  }
*/
?>
