<?php
require('../../includes/config/config.php');
require('../../includes/Sql/sql.class.php');

if (isset($_POST['id']))
{
    $id = (int) $_POST['id'];
    if (isset($_POST['submitted']))
    {
        foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); }
        $index_content = htmlspecialchars($_POST['content'], ENT_QUOTES);
        $sql = "UPDATE `empresa` SET `frontend1` = '{$index_content}' WHERE `id` = '$id' ";
        mysql_query($sql) or die(mysql_error());
        echo (mysql_affected_rows()) ? "<SCRIPT LANGUAGE=\"JavaScript\" TYPE=\"text/javascript\"> alert(\"Success!\") </script>"
                                     : "<SCRIPT LANGUAGE=\"JavaScript\" TYPE=\"text/javascript\"> alert(\"Failed!\") </script>";
        GenericSql::Redirect( $sec=0, $file="../home.php" );
    }
}
else
{
    die('No direct script access.');
}
?>
