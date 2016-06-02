<?php
require('../../includes/config/config.php');
require('../../includes/Sql/sql.class.php');
require('../../includes/data.php');
require('../../includes/phpass-0.3/PasswordHash.php');
include('../../includes/Validation/validation.class.php');

if (isset($_POST['email']))
{
    //$id = (int)$_POST['customer-id'];
    foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); }

    # Try to use stronger but system-specific hashes, with a possible fallback to
    # the weaker portable hashes.
    $hasher            = new PasswordHash(8, FALSE);
    $_POST['new_password'] = $hasher->HashPassword( $_POST['new_password'] );

    $sql = "UPDATE `customers` SET `password` = '{$_POST['new_password']}' WHERE `email` = '{$_POST['email']}'";
    mysql_query($sql) or die(mysql_error());
    echo (mysql_affected_rows()) ? "<SCRIPT LANGUAGE=\"JavaScript\" TYPE=\"text/javascript\"> alert(\"A sua senha foi alterada com sucesso!\") </script>"
                                 : "<SCRIPT LANGUAGE=\"JavaScript\" TYPE=\"text/javascript\"> alert(\"Falha na tentativa de alterar a senha!\") </script>";

		###### Dispara email avisando que houve UPDATE de cliente, solução paliativa, futuramente precisa fazer o UPDATE do sistema de retaguarda B2STOK ######
		######START######
		$Name = "customer-change-pwd"; 								//senders name
		$email = "sistema@".$_SERVER['SERVER_NAME']; 						//senders e-mail adress
		$recipient = "sistema@".$_SERVER['SERVER_NAME']; 					//recipient
		$mail_body = "SQL Query: " . $sql; 						//mail body
		$subject = $_SERVER['SERVER_NAME'] . " WEBSITE - Customer Update"; 		//subject
		$header = "From: ". $Name . " <" . $email . ">\r\n"; 	//optional headerfields
		@mail($recipient, $subject, $mail_body, $header);		//SendMail
		#######END#######

	// it do not run inside the overlay.. ;D  then redirect back to begin
	GenericSql::Redirect($sec=0, $file="../../cadastro-usuario?endereco=" . $_POST['endereco'] . "&id=" . $_POST['id'] );
	echo "A senha foi atualizada com sucesso!";
}
else
{
    die('No direct script access.');
}
?>
