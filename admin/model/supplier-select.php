<?php
require('../../includes/config/config.php');
require('../../includes/Sql/sql.class.php');

$result = mysql_query("SELECT `fornecedor`.*, `tb_paises`.`nome` AS countryName, `tb_cidades`.`nome` AS cityName, `tb_estados`.`nome` AS stateName FROM `fornecedor` LEFT JOIN tb_paises ON tb_paises.id=fornecedor.pais LEFT JOIN tb_estados ON tb_estados.id=fornecedor.estado LEFT JOIN tb_cidades ON tb_cidades.id=fornecedor.cidade  ") or trigger_error(mysql_error());
while($row = mysql_fetch_array($result)){
    foreach($row AS $key => $value) { $row[$key] = stripslashes($value); }
        echo "<tr>";
        echo "<td valign='top'>" . nl2br( $row['nome_fantasia']) . "</td>";
        echo "<td valign='top'>" . nl2br( $row['endereco']) . "</td>";
        echo "<td valign='top'>" . nl2br( $row['numero']) . "</td>";
        echo "<td valign='top'>" . nl2br( $row['bairro']) . "</td>";
        echo "<td valign='top'>" . nl2br( $row['complemento']) . "</td>";
        echo "<td valign='top'>" . nl2br( $row['countryName']) . "</td>";
        echo "<td valign='top'>" . nl2br( $row['stateName']) . "</td>";
        echo "<td valign='top'>" . nl2br( $row['cityName']) . "</td>";
        echo "<td valign='top'>" . nl2br( $row['cep']) . "</td>";
        echo "<td valign='top'>" . nl2br( $row['doc_valido1']) . "</td>";
        echo "<td valign='top'>" . nl2br( $row['doc_valido2']) . "</td>";
        echo "<td valign='top'>" . nl2br( $row['tel1']) . "</td>";
        echo "<td valign='top'>" . nl2br( $row['resp1']) . "</td>";
        echo "<td valign='top'>
		<a href=supplier-update.php?id={$row['id']}><img src='../../images/icons/pen-fill.png' title='Editar' alt='Editar'></a>
		<a href=../model/supplier-delete.php?id={$row['id']} onclick=\"return confirm('Deseja realmente excluir os dados desse fornecedor?');\"><img src='../../images/icons/delete_cross.png' title='Excluir' alt='Excluir'></a>
		<a href={$row['gmap']}><img height=16 src='../../images/icons/grey/globe.png' title='Visualizar Mapa' alt='Visualizar Mapa'></a>
	      </td>";
        echo "</tr>";
}
?>
