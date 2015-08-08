<?php
include( "../../../includes/config/config.php" ;

try 
{
    $dbh = new PDO("mysql:host=$host;dbname=$bd", $user, $pass);
}
catch(PDOException $e)
{
    echo $e->getMessage();
}

?>
