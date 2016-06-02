<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/Delivery/login/globals.php';
include $_SERVER['DOCUMENT_ROOT'] . '/Delivery/includes/config/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/Delivery/login/src/config/config.php';
include CLASSES . '/User.php';
include DAO . '/UserDao.php';
include_once UTIL . '/validators.php';
include UTIL . '/PasswordHash.php';
include $_SERVER['DOCUMENT_ROOT'] . '/Delivery/includes/PHPMailer/class.phpmailer.php';
include $_SERVER['DOCUMENT_ROOT'] . '/Delivery/includes/PHPMailer/send.class.php';

$validation = array();
$email = trim($_POST['email']);
$dao = new UserDao($dbh);
$sendmail = new Send( );                           //instantiate class Send --- used to send mail after finish checkout  ;)

// Report all PHP errors to debug
//error_reporting(E_ALL);

$validation = 1;
if($validation == 1)
{
	session_start();
	$_SESSION['result'] = 'success';
	$_SESSION['msg'] = 'A recupera&ccedil;&atilde;o da senha foi enviada para o seu email.';
	session_commit();

	$hasher = new PasswordHash(8, FALSE);

	// Update password
	$new_password = $hasher->generatePassword($length = 12, $add_dashes = false, $available_sets = 'luds');
	$hash = $hasher->HashPassword($new_password);
	// Update user password
	$dbh->exec("UPDATE customers SET password = '{$hash}' WHERE email = '{$email}'");



	#### Preenche o template
	$msg = file( '../../../includes/PHPMailer/template_password_recovery.html.php' ); //, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES
	foreach( $msg as $m ) {
		$mensagem = $mensagem.urldecode($m);
	}
	$mensagem = str_replace("#PWD#", $new_password, $mensagem);
	#### Preenche o template



	/*
	 * Send email to customer with the new password
	 */
	try
	{
	    // Sendmail with new password
	    $arr_mail_new_password = array(
		    "email"		=> $email, //customer's email
		    "system_email"	=> "no-reply@".$_SERVER['SERVER_NAME'],
		    "system_from_name"	=> $_SERVER['SERVER_NAME']." SYSTEM",
		    "subject"		=> "Password Recovery",
		    "message"		=> $mensagem,
		    "message_template"	=> "../../../includes/PHPMailer/template_password_recovery.html.php",
		    "message_template"	=> $mensagem,
		    "attachment"	=> "../../../images/logo/logo_oficial.png"
	    );
	    $re = $sendmail->sendMail( $arr_mail_new_password );
	}
	catch (phpmailerException $e)
	{
	    echo $e->errorMessage(); //Pretty error messages from PHPMailer
	}
	catch (Exception $e)
	{
	    echo $e->getMessage(); //Boring error messages from anything else!
	}

	print "<center>" . $mensagem . "</center>";
	//echo '<script type="text/javascript">window.location.href="../../../sig-in";</script>';
}
else
{
	session_start();
	$_SESSION['result'] = 'error';
	$_SESSION['msg']    = 'The password can't be recovered.';
	session_commit();

	print "<center>" . $_SESSION['result'] . ": " . $_SESSION['msg'] . "</center>";
}
?>
