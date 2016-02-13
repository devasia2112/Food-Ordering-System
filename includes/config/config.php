<?php
# Turn off all error reporting
error_reporting(0);
//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

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

/* PREVENTING SESSION HIJACKING - Prevents javascript XSS attacks aimed to steal the session ID */
ini_set('session.cookie_httponly', 1);  // cookie set with HttpOnly flag enabled
/* PREVENTING SESSION FIXATION - Session ID cannot be passed through URLs */
ini_set('session.use_only_cookies', 1);
/* Uses a secure connection (HTTPS) if possible */
ini_set('session.cookie_secure', 1);



# set your timezone here - do not rely o the servers timezone
date_default_timezone_set('Asia/Bangkok'); //America/Sao_Paulo
setlocale(LC_MONETARY, 'th_TH'); //pt_BR



# recebe o ip/nome do servidor
$server             = $_SERVER['SERVER_ADDR'];		    // IP do servidor
$server_name        = "https://" . $_SERVER['SERVER_NAME'];   // Nome do Servidor
$mysql_conn_type    = 0;                                      // 0 = MySQL Extension 1 = MySQLi API Extension 2 = MySQL PDO


# Absolute Path ( cuidado ao usar - isso retorna ex.: /home/public/app/folder/ ou c:/app/dir/ )
if(DIRECTORY_SEPARATOR=='/')
{
    $absolute_path  = dirname(__FILE__).'/';
}
else
{
    $absolute_path  = str_replace('\\', '/', dirname(__FILE__)).'/';
}


# Relative Path - Parse ini file with sections
$ini_array          = parse_ini_file("config.ini", true);
$_SESSION['path']   = $ini_array['path'];
$root_installation  = "https://" . $_SERVER['SERVER_NAME'] . $_SESSION['path']; /* #URL completa da instalação */


# call language of the site here (testing)
include  "../lang/en-us.php";


/*
* Call localserver configs
*
*/
if($server == "127.0.0.1")
{
    # ID da Conexão local
    $connec  = 1;
    $host    = "localhost";
    $user    = "delivery";
    $pass    = "delivery";
    $bd      = "delivery";

    # Facebook APP config
<<<<<<< HEAD
    $fb_appId   = "<here>";
    $fb_secret  = "<here>";
=======
    $fb_appId   = "";
    $fb_secret  = "";
>>>>>>> 94fa5834579039c28101bd65f99e4c04d3bf3bbe
}



/*
* Verify type of connection
* 0 = old mysql connection
* 1 = Mysqli conection
* 2 = ADO
*/
if($mysql_conn_type == 0)
{
     # Conecta no servidor do IP encontrado
     $conn = mysql_connect($host, $user, $pass);
     mysql_set_charset('utf8',$conn);
     mysql_select_db($bd);
}
elseif($mysql_conn_type == 1)
{
     $mysqli = new mysqli( $host, $user, $pass, $bd );
     if ($mysqli->connect_errno) {
        echo "Failed to connect to data base: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
     }
}
elseif($mysql_conn_type == 2)
{
    die("ADO not yet!");
}
else
{
    die("A connection method was not properly defined.");
}

//ob_end_flush();
?>
