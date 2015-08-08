<?php require("../../bootstrap.php");
defined('SYSPATH_ADMIN') or die('No direct script access.');
include('../../../includes/config/config.php');
include('../../../includes/Sql/sql.class.php');
session_start();

$q = $_GET["q"];
$userdata = mysql_select( '*', products, id, $q);

// Mostra dados do cliente para confirmação visual
echo "<br /><table border='0' width='100%'>
				<tr><th colspan=7><b>Dados do Item</b></th></tr>
				<tr bgcolor='efefef' align='left'>
				    <th>ID</th>
				    <th>CODE</th>
				    <th>NAME</th>
				</tr>
				<tr bgcolor='efefef' align='left'>
				    <th>Desc.:</th>
				    <th></th>
				    <th></th>
				</tr>";
				echo "<tr>";
				echo "<td>" . $userdata['id'] . "</td>";
				echo "<td>" . $userdata['product_code'] . "</td>";
				echo "<td>" . $userdata['name'] . "</td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>" . $userdata['description'] . "</td>";
				echo "<td></td>";
				echo "<td></td>";
				echo "</tr>";
echo "</table>";
?>
