<?php require("../bootstrap-admin.php");
defined('SYSPATH_ADMIN') or die('No direct script access.');
require('../../includes/config/config.php');
require('../../includes/Sql/sql.class.php');

session_start();

/*
 * Subject: Algoritimo de formação de preço de venda
 * 
 * Developed by: Fernando Costa To: KINTHAI - Autêntica Cozinha Tailandesa
 * Date: 28 sep 2012
 */
error_reporting(0);

if ( isset( $_POST ) and !empty( $_POST ) and $_SESSION['submited'] == 1 )
{
	//print"<pre>";print_r($_POST);print"</pre>";
	$cnt = count($_POST['ingrediente']);
	$prato = $_POST['prato'];

    /* 
    * Calculo de quantidade usada do item - isso precisa ser feito um a um com todos os ingredientes que compoem o prato 
    * O calculo esta sendo feito baseado na NF de compra(s) do(s) fornecedor(es)  
    * Observação: Caso exista varias NF cada item precisa ser calculado e somado para chegar ao valor final de custo usado no prato.
    */    
    $n=0;
    foreach ( $_POST as $post )
    {
		// Equação do calculo -- onde $vi => Valor por Item
		//echo $_POST[medida][$n];
		$vi += ( ( $_POST[vti][$n] / $_POST[qtp][$n] ) * $_POST[qup][$n] );
		$n +=1;
    }
    

    for ( $ii=0;$ii<$cnt;$ii++ )
    {
		$item_value = ( ( $_POST[vti][$ii] / $_POST[qtp][$ii] ) * $_POST[qup][$ii] );
		$ingredient = $_POST['ingrediente'][$ii];
		$unit       = $_POST['medida'][$ii];
		$qup        = $_POST['qup'][$ii];
		
		GenericSql::insertFactSheet( $prato, $item_value, $ingredient, $unit, $qup );
	}


    #---------------------------------------------------------------------------------------


    /*
    * Calculo Final do Preço de Venda
    *
    */
    $cam 	= $vi;				# Custo de aquisição de mercadoria  						# R$  ESSE É O VALOR DA SOMATÓRIA DO VALOR DO ITEM $vi
    $icms 	= $_POST['icms'];	# Incidência de ICMS sobre o faturamento					# %
    $frete 	= $_POST['frete'];	# Incidência de Frete										# %
    $icsf 	= $_POST['ics'];	# Incidência de contribuições sobre o faturamento			# %
    $iefsf 	= $_POST['iefsf'];	# Incidência de encargos financeiros sobre o faturamento	# %
    $icsf2 	= $_POST['icsf2'];	# Incidência de comissões sobre o faturamento				# %
    $iodsf 	= $_POST['iodsf'];	# Incidência de outras despesas sobre o faturamento			# %
    $pldsf 	= $_POST['pldsf'];	# Porcentagem de lucro definido sobre o faturamento			# %
    $tispv 	= 0;				# Incidências sobre o preço de venda						# %  INICIA ZERADO

      // Soma total de incidencias e lucro desejado em porcentagem sobre o preço de venda
      $tispv = ( $icms + $icsf + $iefsf + $icsf + $iodsf + $pldsf );

      // Resumo da composição do PVu (Preço de venda Unitario)
      $camp = ( 100 - $tispv );																# Custo de aquisição da mercadoria em porcentagem (%) 
      $tpv  = ( $camp + $tispv );															# Total do preço de venda

      // Equação do preço de venda unitário
      $pvu  = 0;																			# Preço de Venda Unitário
      $temp = ( 1 - ( $tispv / 100 ) );
      $pvu  = ( $cam / $temp );

    /* DISPLAY */
    $display = '<br />Valor Total dos Itens (NF) que compoem o prato (R$): ' . number_format($vi, 4, '.', '');
    $display .= '<hr style="background-color:#fff; border:#000 1px dashed; border-style: none none dashed; color:#fff;" />';
    $display .= 'Custo de aquisi&ccedil;&atilde;o da mercadoria (R$): ' . number_format($cam, 4, '.', '');
    $display .= '<br />Custo de aquisi&ccedil;&atilde;o da mercadoria em porcentagem (%): ' . number_format($camp, 2, '.', '');
    $display .= '<br />Total de Incid&ecirc;ncias sobre o pre&ccedil;o de venda (%): ' . number_format($tispv, 2, '.', '');
    $display .= '<br />Total do pre&ccedil;o de venda (%): ' . number_format($tpv, 2, '.', '');
    $display .= '<br />Margem de Lucro (%): ' . number_format($pldsf, 2, '.', '');
    $display .= '<hr style="background-color:#fff; border:#000 1px dashed; border-style: none none dashed; color:#fff;" />';
    $display .= '<b>Pre&ccedil;o de Venda Unit&aacute;rio (R$): </b>' . number_format($pvu, 2, '.', '');
    $display .= '<hr style="background-color:#fff; border:#000 1px dashed; border-style: none none dashed; color:#fff;" />';
	$display .= "<br />Ficha T&eacute;cnica de Produ&ccedil;&atilde;o gravado com sucesso no banco de dados.";
	
	/* Gravar no banco o novo preço de venda desse prato */
	GenericSql::insertSalePrice( $prato, $icms, $frete, $icsf, $iefsf, $icsf2, $iodsf, $pldsf, $vi, $pvu);

	$display .= "<br />Pre&ccedil;o de venda final gravado com sucesso no banco de dados.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link href="../bootstrap.css" rel="stylesheet">
	<style type="text/css">
		body {
		padding-top: 60px;
		}
	</style>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.0/jquery.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function() 
	{
		$("#add").click(function() {
			$('#mytable tbody:last').clone(true).insertAfter('#mytable tbody:last');
			return false;
		});

		$("#remove").click(function() {
			$("#mytable tbody:last").each(function() {this.reset();});
			return false;
		});
	});
	</script>
	<script type="text/javascript" src="../../scripts/general-functions.js"></script>	
</head>

<body>

<?php include("../menu.php"); ?>

  <div class="content">

	 <?php if ( isset( $_POST ) and !empty( $_POST ) and $_SESSION['submited'] == 1 ) { ?>
		
		<br /><br />
		<div class="alert-message warning">
			<p><span class="label success">Sucesso</span><br /> 
			<h3>Informa&ccedil;&atilde;o Detalhada do Pre&ccedil;o de Venda</h3>
			<?php echo $display; ?> 
			</p>
		</div>

		<?php $_SESSION['submited'] = 0; unset($_SESSION['submited']); // Destroy form session ?>
		<?php //GenericSql::Redirect($sec="5", $file="gen-sale-price.php"); ?>
	 
	 <?php } else { ?>

		<div class="hero-unit">
			<h2>Informa&ccedil;&otilde;es</h2>
			<ul>
				<li> Preencher os campos da Ficha T&eacute;cnica (Caso seja mais de um item clique em +) </li>
				<li> Unidade Padr&atilde;o de Medida do Sistema: Quilo (1 kg, 1000 g) e Litro (1 L, 1000 ml) </li>
				<li> Taxas Geralmente j&aacute; inclusas na NF </li>
				<li> <a target="_blank" href="http://www.convertworld.com/pt/massa/Quilograma.html">Conversor Medidas</a> </li>
				<li> Forma&ccedil;&atilde;o de pre&ccedil;o: Apenas preencher frete quando o mesmo n&atilde;o constar na NF de compra dos items.</li>
				<li> Ap&oacute;s clicar no bot&atilde;o "Calcular Pre&ccedil;o de Venda" uma simula&ccedil;&atilde;o vai ser gerada, para oficializar esse novo valor, clique em "Gravar Novo Pre&ccedil;o de Venda".</li>
			</ul>
		</div>

		<a id="add" class="btn primary"> (+) Adicionar Ingrediente </a> <a id="remove" class="btn danger"> (-) Remover Ingrediente </a> <br /><br />

		<div class="row">
		  <div class="span16">
		  
			<h4>Ficha T&eacute;cnica e Forma&ccedil;&atilde;o do Pre&ccedil;o de Venda. 
			<small>(C&aacute;lculo do valor da quantidade do item usada no prato)<small></h4>
			<hr style="background-color:#fff; border:#999 1px dashed; border-style: none none dashed; color:#fff;" />

			<form name="pv" method="post" action="">
				
				<?php $_SESSION['submited'] = 1; ?>
				
				<table width="100%" border="0" cellspacing="0" cellpadding="2">
				<tr>
				<td width=45%> <h4>Produto Final (Prato A La Carte)</h4> </td>
				<td>  </td>
				</tr>
				<tr>
				<td width=45%> Prato  </td>
				<td> 
					<?php
						$arr = GenericSql::getAllProducts( );
						foreach ($arr as $key=>$val) $opt .= "<option value='" . $val['id'] . "'>" . $val[product_code] .' - '. $val[name] . "</option>";
					?>
					<select name="prato"> 
						<option value="">select</option>
						<?php echo $opt; ?>
					</select> 
				</td>
				</tr>
				</table>
				<hr style="background-color:#fff; border:#999 1px dashed; border-style: none none dashed; color:#fff;" />


				<table id="mytable" width="100%" border="0" cellspacing="0" cellpadding="2">
				<tbody>
					<tr>
						<td><h4>Ficha T&eacute;cnica <small>(Baseado na NF ou CF)</small></h4></td>
					</tr>
					<tr>
						<td> Ingrediente (Item) </td>
						<td>
							<?php
								$arr2 = GenericSql::getAllIngredients( );
								foreach ($arr2 as $key2=>$val2) $opt2 .= "<option value='" . $val2['id'] . "'>" . $val2[name] . ' | Estoque: ' . $val2[stock_level] . ' ' . $val2[unit] . ' | Pre&ccedil;o: ' . $val2[unit_cost] . "</option>";
							?>
							<select name="ingrediente[]"> 
								<option value="">select</option>
								<?php echo $opt2; ?>
							</select> 
						</td>
					</tr>					
					<tr>
						<td width=45%> Valor Total do Item por 1 Quilo ou 1 Litro (R$)</td>
						<td> <input type="text" name="vti[]" value="" onkeypress="return(currencyFormat(this,'','.',event))" /> <a href="#" onClick="MyWindow=window.open('jqueryCalculator/calc/','MyWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,width=280,height=360,left=250,top=250'); return false;"> <img src="../../images/icons/calculator.png" /></a> </td>
					</tr>
					<tr>
						<td> Unidade de Medida (g ou ml) </td>
						<td>  
							<select name="medida[]"> 
								<option value="">select</option>
								<option value="g">Grama</option>
								<option value="ml">Mililitro</option> 
							</select> 
						</td>
					</tr>
					<tr>
						<td> Quantidade Total do Produto (g ou ml) </td>
						<td> 	<input type="text" name="qtp[]" value="1000" onkeypress="return isNumberKey(event)" /> <br /><small><i>Sempre 1 unidade padr&atilde;o</i></small> </td>
					</tr>
					<tr>
						<td> Quantidade Usada do Produto (g ou ml) </td>
						<td>  <input type="text" name="qup[]" value="" onkeypress="return isNumberKey(event)" /> <br /><small><i>Caso maior que 1 unidade padr&atilde;o ent&atilde;o alterar qtde total do produto (INT).</i></small> </td>
					</tr>
					<tr>
						<td colspan=2> <hr style="background-color:#fff; border:#999 1px dashed; border-style: none none dashed; color:#fff;" /> </td>
					</tr>
				</tbody>
				</table>

				<hr />
				<table width="100%" border="0" cellspacing="0" cellpadding="2">
				<tr>
				<td width=45%> <h4>Forma&ccedil;&atilde;o do Pre&ccedil;o de Venda</h4> </td>
				<td>  </td>
				</tr>
				<tr>
				<td width=45%> Incid&ecirc;ncia de ICMS sobre o faturamento (%) </td>
				<td> <input type="text" name="icms" value="" /> </td>
				</tr>
				<tr>
				<td> Incid&ecirc;ncia de Frete (%) </td>
				<td> <input type="text" name="frete" value="" /> </td>
				</tr>
				<tr>
				<td> Incid&ecirc;ncia de contribui&ccedil;&otilde;es sobre o faturamento (%) </td>
				<td> <input type="text" name="icsf" value="" /> </td>
				</tr>
				<tr>
				<td> Incid&ecirc;ncia de encargos financeiros sobre o faturamento (%) </td>
				<td> <input type="text" name="iefsf" value="" /> </td>
				</tr>
				<tr>
				<td> Incid&ecirc;ncia de comiss&otilde;es sobre o faturamento (%) </td>
				<td> <input type="text" name="icsf2" value="" /> </td>
				</tr>
				<tr>
				<td> Incid&ecirc;ncia de outras despesas sobre o faturamento (%) </td>
				<td> <input type="text" name="iodsf" value="" /> </td>
				</tr>
				<tr>
				<td> Porcentagem de lucro definido sobre o faturamento (%) </td>
				<td> <input type="text" name="pldsf" value="" /> </td>
				</tr>
				<tr>
				<td colspan=2> <hr /> </td>
				</tr>
				</table>

				<input type="submit" name="btn-calc" value="Calcular Pre&ccedil;o de Venda" class="btn success" />

			</form>

		  </div>
		</div>
		
	 <?php } ?>
	 
	<?php include("../footer.php"); ?>
	
  </div>
	 
</body>
</html>