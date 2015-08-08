<?php
session_start(); # estranhamente o checkout não funciona quando a chamada de sessao é habilitada aqui!!! isso custou 3 dias para descobrir o bug!!

// Error reporting:
error_reporting(E_ALL^E_NOTICE);

# Filesystem paths
# Absolute Path ( cuidado ao usar - isso retorna ex.: /home/public/app/folder/ ou c:/app/dir/ )
if ( DIRECTORY_SEPARATOR == '/' )
{
	$absolute_path = dirname(__FILE__) . '/';
	define( "SYSPATH_ADMIN",$absolute_path );
}
else
{
	$absolute_path = str_replace('\\', '/', dirname(__FILE__)) . '/';
	define( "SYSPATH_ADMIN",$absolute_path );
}

//print_r($_SESSION['admin_access']);
//print "<pre>";print_r($_SESSION);print "</pre>";die;



# URL Paths
# Relative Path ( Isso deve retornar http://domain.tld/Your-Folder/)
define( "SYSPATH_PROTOCOL", "http://" );                                                // Protocol used (http/https)
define( "SYSPATH_SERVER_NAME", $_SERVER['SERVER_NAME'] );                               // Server Name
define( "SYSPATH_SERVER_ROOT", $_SERVER['SERVER_NAME'] . "/Delivery" );                 // Root Folder
define( "SYSPATH_SERVER_ADMIN_ROOT", $_SERVER['SERVER_NAME'] . "/Delivery/admin" );     // Root Admin Folder
define( "SYSPATH_SERVER_VIEW", SYSPATH_SERVER_ADMIN_ROOT . "/view/" );                  // Admin View Folder
define( "SYSPATH_SERVER_MODEL", SYSPATH_SERVER_ADMIN_ROOT . "/model/" );                // Admin Model Folder
define( "SYSPATH_SERVER_CONTROLLER", SYSPATH_SERVER_ADMIN_ROOT . "/controller/" );      // Admin Controller Folder

#----admin-logo----------------------------------------------------------------------------------------------------------
define( "SYSPATH_SERVER_LOGO", SYSPATH_PROTOCOL . SYSPATH_SERVER_ROOT . "/images/logo/logo-kinthai.png");          // Admin Controller Folder
#----admin-logo----------------------------------------------------------------------------------------------------------

#----lang----------------------------------------------------------------------------------------------------------
#------THE FILE jcart/config.php ALWAYS WORKS AS A PAIR WITH A LANG FILE, WHATEVER LANG IS BEING USED!-------------
define( "SYSPATH_LANG", "/includes/lang/pt-br.php");          // Lang of the system
#----lang----------------------------------------------------------------------------------------------------------
 
#----connection----------------------------------------------------------------------------------------------------------
define( "SYSPATH_CONNECTION", "/includes/config/config.php");          // Conecction of the system
#----connection----------------------------------------------------------------------------------------------------------



/**
 * Returns the relative URL of the entry script.
 * The implementation of this method referenced Zend_Controller_Request_Http in Zend Framework.
 * @return string the relative URL of the entry script.
 */
function getScriptUrl()
{
	$scriptName=basename($_SERVER['SCRIPT_FILENAME']);
	if(basename($_SERVER['SCRIPT_NAME'])===$scriptName)
			$BASE_URL=$_SERVER['SCRIPT_NAME'];
	else if(basename($_SERVER['PHP_SELF'])===$scriptName)
			$BASE_URL=$_SERVER['PHP_SELF'];
	else if(isset($_SERVER['ORIG_SCRIPT_NAME']) && basename($_SERVER['ORIG_SCRIPT_NAME'])===$scriptName)
			$BASE_URL=$_SERVER['ORIG_SCRIPT_NAME'];
	else if(($pos=strpos($_SERVER['PHP_SELF'],'/'.$scriptName))!==false)
			$BASE_URL=substr($_SERVER['SCRIPT_NAME'],0,$pos).'/'.$scriptName;
	else if(isset($_SERVER['DOCUMENT_ROOT']) && strpos($_SERVER['SCRIPT_FILENAME'],$_SERVER['DOCUMENT_ROOT'])===0)
			$BASE_URL=str_replace('\\','/',str_replace($_SERVER['DOCUMENT_ROOT'],'',$_SERVER['SCRIPT_FILENAME']));
	else
			die('Http Request is unable to determine the entry script URL.');

	return $BASE_URL;
}

?>