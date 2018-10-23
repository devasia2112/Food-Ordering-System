<?php
# Turn off all error reporting
#error_reporting(0);
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

//ob_start();
/* CACHE CONTROL via headers - we do not need cache for now! */
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.

// SECURITY HTTP HEADERS - read more: http://zinoui.com/blog/security-http-headers
/* Security HTTP Headers - X-Frame-Options / This http header helps avoiding clickjacking attacks. Browser support is as follow: IE 8+, Chrome 4.1+, Firefox 3.6.9+, Opera 10.5+, Safari 4+.  */
header("X-Frame-Options: sameorigin"); //possible values -> deny, sameorigin and allow-from: DOMAIN
/* Security HTTP Headers -  X-XSS-Protection / Use this header to enable browser built-in XSS Filter. It prevent cross-site scripting attacks. X-XSS-Protection header is supported by IE 8+, Chrome and Safari.  */
header("X-XSS-Protection: 1; mode=block"); // possible values -> 0, 1 and mode=block (in case of attack the browser will prevent the page to load)
/* Security HTTP Headers - X-Content-Type-Options / This http header is supported by IE and Chrome, and prevents attacks based on MIME-type mismatch. The only possible value is nosniff. If your server returns X-Content-Type-Options: nosniff in the response, the browser will refuse to load the styles and scripts in case they have an incorrect MIME-type. */
header("X-Content-Type-Options: nosniff"); //
/* Security HTTP Headers - Strict-Transport-Security / To take advantage of this security header, the current webpage must be accessed over HTTPS. In this case the Strict-Transport-Security header force secure connections to the server. This prevents losing session data stored in cookies. Also prevents users to access website in case the server's TLS certificate is not trusted. Browser support: IE 11+, Chrome 4+, Firefox 4+, Opera 12+, Safari 7+.  */
header("Strict-Transport-Security: max-age=31536000");
/* Security HTTP Headers - Content-Security-Policy / This header could affect your website in many ways, so be careful when using it. The configuration below allows loading scripts, XMLHttpRequest (AJAX), images and styles from same domain and nothing else. Browser support: Edge 12+, Firefox 4+, Chrome 14+, Safari 6+, Opera 15+  */
//header("Content-Security-Policy: default-src 'none'; script-src 'self'; connect-src 'self'; img-src 'self'; style-src 'self';");

if (session_status() !== PHP_SESSION_ACTIVE)
{
  /* PREVENTING SESSION HIJACKING - Prevents javascript XSS attacks aimed to steal the session ID */
  ini_set('session.cookie_httponly', 1);  // cookie set with HttpOnly flag enabled
  /* PREVENTING SESSION FIXATION - Session ID cannot be passed through URLs */
  ini_set('session.use_only_cookies', 1);
  /* Uses a secure connection (HTTPS) if possible */
  ini_set('session.cookie_secure', 1);
}

# set your timezone here - do not rely o the servers timezone
date_default_timezone_set('America/Sao_Paulo'); //America/Sao_Paulo , Asia/Bangkok
setlocale(LC_MONETARY, 'pt_BR'); //pt_BR


/*
* call https://medoo.in/ to use PDO as default
*/
#echo realpath(__DIR__ . '/..') . '/Sql/Medoo.php';
require(realpath(__DIR__ . '/..') . '/Sql/Medoo.php');
// Using Medoo namespace
use Medoo\Medoo;


/*
* ip or name server
*/
$server             = $_SERVER['SERVER_ADDR'];		            // ip
$server_name        = "http://" . $_SERVER['SERVER_NAME'];   // name server
$mysql_conn_type    = 2;                                      // 0 = MySQL Extension 1 = MySQLi API Extension 2 = MySQL PDO


# Absolute Path ( return /home/public/app/folder/ or c:/app/dir/ )
if (DIRECTORY_SEPARATOR=='/')
{
    $absolute_path  = dirname(__FILE__).'/';
}
else
{
    $absolute_path  = str_replace('\\', '/', dirname(__FILE__)).'/';
}


/*
* Relative Path - Parse ini file with sections
*/
$ini_array          = parse_ini_file("config.ini", true);
$_SESSION['path']   = $ini_array['path'];
$root_installation  = "https://" . $_SERVER['SERVER_NAME'] . $_SESSION['path']; /* #URL completa da instalação */


# call language of the site here (testing) it must e called in the bootstrap-admin file
//include  "../lang/en-us.php";


/*
* Call localserver configs
*/
if ($server == "127.0.0.1")
{
    # ID da Conexão local
    $host    = "localhost";
    $user    = "delivery";
    $pass    = "abracadabra";
    $bd      = "delivery";

    # Facebook APP config
    $fb_appId   = "";
    $fb_secret  = "";
    $fb_appId   = "";
    $fb_secret  = "";
    $fb_appId   = "";
    $fb_secret  = "";
}


/*
* Verify type of connection
* 0 = old mysql          - connection deprecated in PHP7+
* 1 = Mysqli conection   - under development
* 2 = PDO                - under development
*/
if ($mysql_conn_type == 0)
{
     # Conecta no servidor do IP encontrado
     $conn = mysql_connect($host, $user, $pass);
     mysql_set_charset('utf8',$conn);
     mysql_select_db($bd);
}
elseif($mysql_conn_type == 1)
{
     $mysqli = new mysqli( $host, $user, $pass, $bd );
     if ($mysqli->connect_errno)
     {
        echo "Failed to connect to data base: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
     }
}
elseif($mysql_conn_type == 2)
{
    $database = new Medoo([
    	// required
    	'database_type' => 'mysql',
    	'database_name' => $bd,
    	'server' => $host,
    	'username' => $user,
    	'password' => $pass,
    	// [optional]
    	'charset' => 'utf8mb4',
    	'collation' => 'utf8mb4_general_ci',
    	'port' => 3306,
    	// [optional] Table prefix
    	//'prefix' => 'PREFIX_',
    	// [optional] Enable logging (Logging is disabled by default for better performance)
    	'logging' => false,
    	// [optional] MySQL socket (shouldn't be used with server and port)
    	//'socket' => '/tmp/mysql.sock',
    	// [optional] driver_option for connection, read more from http://www.php.net/manual/en/pdo.setattribute.php
    	//'option' => [PDO::ATTR_CASE => PDO::CASE_NATURAL],
    	// [optional] Medoo will execute those commands after connected to the database for initialization
    	//'command' => ['SET SQL_MODE=ANSI_QUOTES'],
    ]);
}
else
{
    die("A connection method was not properly defined.");
}
?>
