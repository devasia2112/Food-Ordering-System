<?php
/*
 * Verifica o nome do servidor e redireciona para a conexão correta
 * Dados para conexão com o MySQL LOCAL/REMOTO
 * Caso usado em cliente, essa configuraçao de conexão precisa ser modificada manualmente.
 *
 * Path do sistema
 *
 */


# Turn off all error reporting
error_reporting(0);

# recebe o ip/nome do servidor
$server = $_SERVER['SERVER_ADDR'];			            // IP do servidor
$server_name = "https://" . $_SERVER['SERVER_NAME'];		// Nome do Servidor
$mysql_conn_type = 0;                                   // 0 = MySQL Extension 1 = MySQLi API Extension 2 = MySQL PDO


# Absolute Path ( cuidado ao usar - isso retorna ex.: /home/public/app/folder/ ou c:/app/dir/ )
if (DIRECTORY_SEPARATOR=='/') {
	$absolute_path = dirname(__FILE__).'/';
} else {
	$absolute_path = str_replace('\\', '/', dirname(__FILE__)).'/';
}


# Relative Path - Parse ini file with sections
$ini_array = parse_ini_file( "config.ini", true );
$_SESSION['path'] = $ini_array['path'];
#URL completa da instalação
$root_installation	= "https://" . $_SERVER['SERVER_NAME'] . $_SESSION['path'];


# call language of the site here (testing)
include  "../lang/en-us.php";


/*
* Opções para servidores locais - Rodar na intranet
*
*/
 
if ($server == "127.0.0.1") 
{
	# ID da Conexão local
	$connec  = 1;

	$host    = "localhost";				//Servidor
	$user    = "root";				//Usuário
	$pass    = "cyber2065";					//Senha
	$bd      = "delivery";				//Base de Dados

    # Facebook APP config
    $fb_appId   = "390355847666796";
    $fb_secret  = "cada6cdc26e4f4c56e45079923c7fa9a";
}



/*
* Verify type of connection
*
*/
if ( $mysql_conn_type == 0) {
     # Conecta no servidor do IP encontrado
     $conn = mysql_connect($host, $user, $pass);
     mysql_set_charset('utf8',$conn);
     mysql_select_db($bd);
} else if ( $mysql_conn_type == 1) {
     $mysqli = new mysqli( $host, $user, $pass, $bd );
     if ($mysqli->connect_errno) {
        echo "Failed to connect to data base: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
     }
} else if ( $mysql_conn_type == 2) {
    die("not yet!");
} else {
    die("A connection method in the config file was not provided.");
}
?>
