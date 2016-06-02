<?php
require('../../includes/config/config.php');
require('../../includes/Sql/sql.class.php');
require('../../includes/data.php');

if (isset($_POST['customer-id']))
{
    $id = (int)$_POST['customer-id'];
    foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); }

    # Convert date to mysql format only in case of the lang of the system is set to pt-br
	if( SYSPATH_LANG == "/includes/lang/pt-br.php" ) {
		$birthday = sqltobr($_POST['birthday']);
	} else {
		$birthday = $_POST['birthday'];
	}

    $sql = "UPDATE `customers` SET  `name` = '{$_POST['name']}', `valid_document` = '{$_POST['valid_document']}', `birthday` = '$birthday', `street` = '{$_POST['street']}', `number` = '{$_POST['number']}', `complement` = '{$_POST['complement']}', `suburb` = '{$_POST['suburb']}', `state` = '{$_POST['state']}', `town` = '{$_POST['town']}',  `zipcode` = '{$_POST['zipcode']}', `phone_one` = '{$_POST['phone_one']}', `phone_two` = '{$_POST['phone_two']}', `accepted` = '{$_POST['accepted']}' WHERE `id` = '$id'";
    mysql_query( $sql ) or die(mysql_error());
    echo( mysql_affected_rows()) ? "<SCRIPT LANGUAGE=\"JavaScript\" TYPE=\"text/javascript\"> alert(\" Data was update successfully! \") </script>"
                                 : "<SCRIPT LANGUAGE=\"JavaScript\" TYPE=\"text/javascript\"> alert(\" Something went wrong. Your data was not update! \") </script>";

		###### Dispara email avisando que houve UPDATE de cliente, solução paliativa, futuramente precisa fazer o UPDATE do sistema de retaguarda B2STOK ######
		######START######
		$Name = "customer-update"; 								//senders name
		$email = "sistema@".$_SERVER['SERVER_NAME']; 						//senders e-mail adress
		$recipient = "sistema@".$_SERVER['SERVER_NAME']; 					//recipient
		$mail_body = "SQL Query: " . $sql; 						//mail body
		$subject = $_SERVER['SERVER_NAME'] . " WEBSITE - Customer Update"; 		//subject
		$header = "From: ". $Name . " <" . $email . ">\r\n"; 	//optional headerfields
		@mail($recipient, $subject, $mail_body, $header);		//SendMail
		#######END#######

	GenericSql::Redirect($sec=0, $file="../../checkout");
}
else
{
    die('No direct script access.');
}
?>
