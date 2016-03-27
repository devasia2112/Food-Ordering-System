<?php
include('../../includes/config/config.php');
include('../../includes/Sql/sql.class.php');
$array_empresa = GenericSql::getEmpresa();
?>
<footer><p>&copy; <?php echo $array_empresa['nome_fantasia']; ?> - <?php echo date("Y"); ?> </p></footer>
