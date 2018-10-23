<?php
/* start session here will compromise the checkout page */

# Error reporting:
#error_reporting(E_ALL^E_NOTICE);
error_reporting(E_ALL);

# Filesystem paths - Absolute Path (/var/www/your_site/admin/) or Relative URI (http://your_site/admin/)
if (DIRECTORY_SEPARATOR == '/')
{
	$relative_path = dirname(__FILE__) . '/';
	define("SYSPATH_ADMIN", $relative_path);  // relative path
}
else
{
	$relative_path = str_replace('\\', '/', dirname(__FILE__)) . '/';
	define("SYSPATH_ADMIN", $relative_path); // relative path
}
#print "<pre>"; print_r($_SESSION); print "</pre>";

# Relative URI Path ( may return http://domain.tld/Your-Folder/)
define( "WEBROOT", "" );                                                                // Protocol used (http/https)
define( "SYSPATH_PROTOCOL", "http://" );                                                // Protocol used (http/https)
define( "SYSPATH_SERVER_NAME", $_SERVER['SERVER_NAME'] );                               // Server Name
define( "SYSPATH_SERVER_ROOT", $_SERVER['SERVER_NAME'] . WEBROOT );                     // Root Folder
define( "SYSPATH_SERVER_ADMIN_ROOT", $_SERVER['SERVER_NAME'] . WEBROOT . "/admin" );    // Root Admin Folder
define( "SYSPATH_SERVER_VIEW", SYSPATH_SERVER_ADMIN_ROOT . "/view/" );                  // Admin View Folder
define( "SYSPATH_SERVER_MODEL", SYSPATH_SERVER_ADMIN_ROOT . "/model/" );                // Admin Model Folder
define( "SYSPATH_SERVER_CONTROLLER", SYSPATH_SERVER_ADMIN_ROOT . "/controller/" );      // Admin Controller Folder

#----admin-logo----------------------------------------------------------------------------------------------------------
define( "SYSPATH_SERVER_LOGO", SYSPATH_PROTOCOL . SYSPATH_SERVER_ROOT . "/images/logo/logo-kinthai.png");          // Admin Controller Folder
#----admin-logo----------------------------------------------------------------------------------------------------------

#----lang----------------------------------------------------------------------------------------------------------
#------THE FILE jcart/config.php ALWAYS WORKS AS A PAIR WITH A LANG FILE, WHATEVER LANG IS BEING USED!-------------
define( "SYSPATH_LANG", "/includes/lang/en-us.php");          // Lang of the system
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
	$script_name = basename($_SERVER['SCRIPT_FILENAME']);
	if(basename($_SERVER['SCRIPT_NAME']) === $script_name)
		$BASE_URL = $_SERVER['SCRIPT_NAME'];
	else if(basename($_SERVER['PHP_SELF']) === $script_name)
		$BASE_URL = $_SERVER['PHP_SELF'];
	else if(isset($_SERVER['ORIG_SCRIPT_NAME']) && basename($_SERVER['ORIG_SCRIPT_NAME']) === $script_name)
		$BASE_URL = $_SERVER['ORIG_SCRIPT_NAME'];
	else if(($pos = strpos($_SERVER['PHP_SELF'],'/'.$script_name)) !== false)
		$BASE_URL = substr($_SERVER['SCRIPT_NAME'],0,$pos) . '/' . $script_name;
	else if(isset($_SERVER['DOCUMENT_ROOT']) && strpos($_SERVER['SCRIPT_FILENAME'],$_SERVER['DOCUMENT_ROOT']) === 0)
		$BASE_URL = str_replace('\\','/',str_replace($_SERVER['DOCUMENT_ROOT'],'',$_SERVER['SCRIPT_FILENAME']));
	else
		die('Http Request is unable to determine the entry script URL.');

	return $BASE_URL;
}
?>
