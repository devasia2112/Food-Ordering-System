<?php
# Turn off all error reporting
error_reporting(0);

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
    $user    = "root";
    $pass    = "cyber2065";
    $bd      = "delivery";

    # Facebook APP config
    $fb_appId   = "390335584376656g796";
    $fb_secret  = "cadda6cdc2d6e4f4c56ge450799g23c7fa9a";
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
?>
