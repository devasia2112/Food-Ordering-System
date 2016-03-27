<?php
require('../../includes/config/config.php');
require('../../includes/Sql/sql.class.php');

if (isset($_POST['id']))
{
    $id = (int) $_POST['id'];
    if (isset($_POST['submitted']))
    {
        foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); }
        $index_content = htmlspecialchars($_POST['index-content'], ENT_QUOTES);
        $sql = "UPDATE `empresa` SET  `nome_fantasia` =  '{$_POST['nome_fantasia']}' ,  `razao_social` =  '{$_POST['razao_social']}' ,  `endereco` =  '{$_POST['endereco']}' ,  `numero` =  '{$_POST['numero']}' ,  `bairro` =  '{$_POST['bairro']}' ,  `complemento` =  '{$_POST['complemento']}' ,  `estado` =  '{$_POST['estado']}' ,  `cidade` =  '{$_POST['cidade']}' ,  `cep` =  '{$_POST['cep']}' ,  `cnpj` =  '{$_POST['cnpj']}' ,  `ie` =  '{$_POST['ie']}' ,  `obs` =  '{$_POST['obs']}' ,  `tel1` =  '{$_POST['tel1']}' ,  `tel2` =  '{$_POST['tel2']}' ,  `resp1` =  '{$_POST['resp1']}' ,  `resp2` =  '{$_POST['resp2']}' ,  `fax` =  '{$_POST['fax']}' ,  `data` =  '{$_POST['data']}' ,  `website` =  '{$_POST['website']}' ,  `website_fb` =  '{$_POST['website_fb']}' ,  `gmap` =  '{$_POST['gmap']}' , `email` =  '{$_POST['email']}' ,  `IM` =  '{$_POST['im']}' ,  `cnae` =  '{$_POST['cnae']}' ,  `crt` =  '{$_POST['crt']}', `abre` = '{$_POST['abre']}', `fecha` = '{$_POST['fecha']}', `frontend` = '{$index_content}' WHERE `id` = '$id' ";
        mysql_query($sql) or die(mysql_error());
        echo (mysql_affected_rows()) ? "<SCRIPT LANGUAGE=\"JavaScript\" TYPE=\"text/javascript\"> alert(\"Dados da empresa alterados com sucesso!\") </script>"
                                     : "<SCRIPT LANGUAGE=\"JavaScript\" TYPE=\"text/javascript\"> alert(\"Houve falha na tentativa de alterar os dados!\") </script>";
        GenericSql::Redirect( $sec=0, $file="../view/company-select.php" );
    }
}
else
{
    die('No direct script access.');
}
?>
