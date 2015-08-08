<?php
/*
 * Interface for tests purposes only
 *
 */
require("includes/config/config-aux.php");
require("includes/Sql/mysqli.class.php");
require("includes/Sql/sql.class.php");

$mysqli = MysqliConnect();
echo GenericMysqli::mysqliSelect( $mysqli, $table="clientes", $id=31 );

if (!$res = GenericSql::b2stokTruncateOrders( $mysqli )) echo "FAIL TRUNCATE ORDERS"; else echo "TRUNCATE ORDERS WAS DONE!";
?>