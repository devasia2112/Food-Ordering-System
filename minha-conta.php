<?php
include("includes/Sql/sql.class.php");
session_start();
if ( isset( $_SESSION['IDCUSTOMER'] ) and !empty( $_SESSION['IDCUSTOMER'] ))
{
	GenericSql::Redirect($sec=0, $file="Cliente/");
}
else
{
	GenericSql::Redirect($sec=0, $file="log-in");
}
