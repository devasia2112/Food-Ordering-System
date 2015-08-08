<?php
session_start();

###EXEC-LOGIN###
require('../../includes/config/config.php');
require('../../includes/Sql/sql.class.php');

// Error reporting:
error_reporting(E_ALL^E_NOTICE);

// This is the URL your users are redirected, when registered succesfully:
$redirectURL = '../home.php';


$user 	= mysql_real_escape_string($_SESSION['email']);
$pass 	= $_SESSION['password'];
$passw 		= md5($pass);
$resultado 	= mysql_query("SELECT * FROM admin_users");
unset($_SESSION['email']);
unset($_SESSION['password']);


while ($linha = mysql_fetch_array($resultado)) 
{
	if ( ( $user == $linha["user_email"] ) && ( $passw == $linha["user_pass"] ) )
	{
		session_start();
		$_SESSION["admin_id"]       	= $linha["id"];
		$_SESSION["admin_access"]       = $linha["user_email"];
		$_SESSION["admin_display_name"] = $linha["display_name"];
		$_SESSION["admin_sessid"] 	= session_id(); session_regenerate_id();
		$_SESSION["admin_ip"] 		= $_SERVER['REMOTE_ADDR'];
		$_SESSION["admin_user_agent"] 	= $_SERVER['HTTP_USER_AGENT'];
		
		// Gravando log de acesso no sistema Fazer no futuro
		//include_once("acessoLogIn.php");
		
		// JSON success response. Returns the redirect URL:
		header("refresh:0;url={$redirectURL}");
		//echo '{"status":2,"redirectURL":"'.$redirectURL.'"}';
		exit;
	}
	else
	{
		header("refresh:0;url=index.php?login=1");
		exit;
	}
}
###EXEC-LOGIN###
?>