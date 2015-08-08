<?php
/*
 * Mysqli Classes - Hold all mysqli queries
 * Date: 29 Oct 2012 12:35:36
 * Coder: Fernando Costa
 * 
 * Observation: Use file /Delivery/includes/config/config-aux.php to connect with the server
 */

class GenericMysqli
{
	/* Mysqli Select Method */
	public static function mysqliSelect( $mysqli, $table, $id ) 
	{
		$query = "SELECT * FROM {$table} WHERE CodigoCliente='{$id}'";
		if (!($stmt = $mysqli->prepare( $query ))) {
			return $res = "Error: Prepare";
		}
		if (!$stmt->execute()) {
			return $res = "Error: Execute";
		}
		$res = $stmt->get_result();
		$row = $res->fetch_assoc();
		
		printf("ID = %s (%s)\n", $row['CodigoCliente'], gettype($row['CodigoCliente']));
		printf("Nome = %s (%s)\n", $row['NomeDaEmpresa'], gettype($row['NomeDaEmpresa']));
	}
	
	
	
	/* Mysqli Insert Method */
	public static function mysqliInsert() 
	{
		
	}
	
	
	
	/* Mysqli Update Method */
	public static function mysqliUpdate() 
	{
		
	}
	
	
	
	/* Mysqli Delete Method */
	public static function mysqliDelete() 
	{
		
	}
	
	
}