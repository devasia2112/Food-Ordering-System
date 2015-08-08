<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/Office/globals.php';
include_once CONF.'/config.php';
include_once UTIL.'/validators.php';

	if (@$_REQUEST['action'] == 'checkUsername' && isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
	    echo json_encode(checkUsername($_REQUEST['username'], $dbh));
	    exit; 
	}
	
	if (@$_REQUEST['action'] == 'checkEmail' && isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
	    echo json_encode(checkEmail($_REQUEST['email'], $dbh));
	    exit;
	}
	
?>
