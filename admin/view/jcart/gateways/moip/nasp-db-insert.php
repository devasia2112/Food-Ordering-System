<?php
//Include the autoload function
include_once 'autoload.inc.php';

//Uses the MoIPNASP class to persist information in a database
//Instance new object MoIPNASP()
$nasp = new MoIPNASP();

//Set the database informations
$nasp->setDatabase("localhost","delivery","delivery","");

//Insert the informations
$nasp->insertData($_POST);
?>
