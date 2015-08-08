<?php 
echo "<select name='town' id='cidade'>"; 
echo "<option value='0'>[selecione]</option>"; 

include("includes/config/config.php");

$sql = "SELECT tb_cidades.nome, tb_cidades.id FROM tb_cidades INNER JOIN tb_estados ON tb_cidades.uf=tb_estados.uf WHERE tb_cidades.uf='".$_GET["uf"]."'";
$resultado = mysql_query($sql); 
while ($linha = mysql_fetch_array($resultado))
{ 
    if ( $_GET["cid"] == $linha["id"] ) 
    {
    	$sel = "selected";
    }
    else
    {
    	$sel = "";
    }
	echo "<option value='$linha[id]' $sel>$linha[nome]</option>";
} 
echo "</select>"; 
?>
