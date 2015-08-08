<?php
//Include the autoload function
include_once 'autoload.inc.php';

//Uses the MoIPNASP class to persist information in a database
//Instance new object MoIPNASP()
$nasp = new MoIPNASP();

//Set the database informations
$nasp->setDatabase("mysql.deepcell.org","deepcell04","deepcell04","cyber2065");

//Insert the informations
$nasp->insertData($_POST);
?>
