<?php
require('../../includes/config/config.php');
require('../../includes/Sql/sql.class.php');

if( isset( $_GET['submitted'] ) and $_GET['submitted'] == 1 ) {

	if( $_POST ) {

		# Basic Sanitization
		//foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); }
		$values = array_map('mysql_real_escape_string', array_values($_POST));
		$keys   = array_keys($_POST);

		try {

			# INSERT RECIPE MUST BE BASED IN THE LANGUAGE CHOICE IN THE INTERFACE (Ex.: Thai, Portugues, English, ..)
			mysql_query('INSERT INTO `recipe` (`'.implode('`,`', $keys).'`) VALUES (\''.implode('\',\'', $values).'\')') or trigger_error(mysql_error());

		} catch (Exception $e) {

			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}

		echo "<SCRIPT LANGUAGE=\"JavaScript\" TYPE=\"text/javascript\"> alert(\"A dados da receita foram gravados com sucesso! \") </script>";
	}
	GenericSql::Redirect($sec=1, $file="../view/recipe-select.php");

} else {

	echo "no direct access.";

}
?>
