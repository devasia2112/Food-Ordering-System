<?php
/*
 * Subject: Algoritimo de formação de preço de venda
 * 
 * Developed by: Fernando Costa To: KINTHAI - Autêntica Cozinha Tailandesa
 * Date: 28 sep 2012
 */
error_reporting(0);

if (isset( $_POST ) and !empty( $_POST ))
{
    /* 
    * Calculo de quantidade usada do item - isso precisa ser feito um a um com todos os ingredientes que compoem o prato 
    * O calculo esta sendo feito baseado na NF de compra(s) do(s) fornecedor(es)  
    * Observação: Caso exista varias NF cada item precisa ser calculado e somado para chegar ao valor final de custo usado no prato.
    */
    $n=0;
    foreach ( $_POST as $post )
    {
	// Equação do calculo -- onde $vi => Valor por Item
	echo $_POST[medida][$n];
	$vi += ( ( $_POST[vti][$n] / $_POST[qtp][$n] ) * $_POST[qup][$n] );
	$n +=1;
    }


    #---------------------------------------------------------------------------------------


    /*
    * Calculo Final do Preço de Venda
    *
    */
    $cam 	= $vi;			# Custo de aquisição de mercadoria  				# R$  ESSE É O VALOR DA SOMATÓRIA DO VALOR DO ITEM $vi
    $icms 	= $_POST['icms'];	# Incidência de ICMS sobre o faturamento			# %
    $frete 	= $_POST['frete'];	# Incidência de Frete						# %
    $icsf 	= $_POST['ics'];	# Incidência de contribuições sobre o faturamento		# %
    $iefsf 	= $_POST['iefsf'];	# Incidência de encargos financeiros sobre o faturamento	# %
    $icsf2 	= $_POST['icsf2'];	# Incidência de comissões sobre o faturamento			# %
    $iodsf 	= $_POST['iodsf'];	# Incidência de outras despesas sobre o faturamento		# %
    $pldsf 	= $_POST['pldsf'];	# Porcentagem de lucro definido sobre o faturamento		# %
    $tispv 	= 0;			# Incidências sobre o preço de venda				# %  INICIA ZERADO

      // Soma total de incidencias e lucro desejado em porcentagem sobre o preço de venda
      $tispv = ( $icms + $icsf + $iefsf + $icsf + $iodsf + $pldsf );

      // Resumo da composição do PVu (Preço de venda Unitario)
      $camp = ( 100 - $tispv );	# Custo de aquisição da mercadoria em porcentagem (%) 
      $tpv = ( $camp + $tispv );	# Total do preço de venda

      // Equação do preço de venda unitário
      $pvu = 0;	# Preço de Venda Unitário
      $temp = ( 1 - ( $tispv / 100 ) );
      $pvu = ( $cam / $temp );

    /* DISPLAY */
    echo '<br />Valor Total dos Itens (NF) que compoem o prato (R$): ' . number_format($vi, 4, '.', '');
    echo '<hr style="background-color:#fff; border:#000 1px dashed; border-style: none none dashed; color:#fff;" />';
    echo 'Custo de aquisi&ccedil;&atilde;o da mercadoria (R$): ' . number_format($cam, 4, '.', '');
    echo '<br />Custo de aquisi&ccedil;&atilde;o da mercadoria em porcentagem (%): ' . number_format($camp, 2, '.', '');
    echo '<br />Total de Incid&ecirc;ncias sobre o pre&ccedil;o de venda (%): ' . number_format($tispv, 2, '.', '');
    echo '<br />Total do pre&ccedil;o de venda (%): ' . number_format($tpv, 2, '.', '');
    echo '<br />Margem de Lucro (%): ' . number_format($pldsf, 2, '.', '');
    echo '<hr style="background-color:#fff; border:#000 1px dashed; border-style: none none dashed; color:#fff;" />';
    echo '<b>Pre&ccedil;o de Venda Unit&aacute;rio (R$): </b>' . number_format($pvu, 2, '.', '');

    die;	//end of calc
}
?>


<!DOCTYPE html>
<head>
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
</head>

<body>

<code>
<fieldset><legend>Informa&ccedil;&otilde;es</legend>
  <ul>
    <li> Preencher os campos da Ficha T&eacute;cnica (Caso seja mais de um item clique em +) </li>
    <li> Unidade Padr&atilde;o de Medida do Sistema: Quilo (1 kg, 1000 g) e Litro (1 L, 1000 ml) </li>
    <li> Taxas Geralmente j&aacute; inclusas na NF </li>
    <li> <a target="_blank" href="http://www.convertworld.com/pt/massa/Quilograma.html">Conversor Medidas</a> </li>
    <li> </li>
    <li> Forma&ccedil;&atilde;o de pre&ccedil;o: Apenas preencher frete quando o mesmo n&atilde;o constar na NF de compra dos items.</li>
    <li> </li>
  </ul>
</fieldset>
</code>

<br /><br /> <a id="add"> + </a> <a id="remove"> - </a> <br /><br />

<fieldset><legend><b>Ficha T&eacute;cnica e Forma&ccedil;&atilde;o do Pre&ccedil;o de Venda. (Calculo do valor da quantidade usada do item)</b></legend>

  <form name="pv" method="post" action="">

    <h4>Ficha T&eacute;cnica <small>(Baseado na NF ou CF)</small></h4>  </td>

    <table id="mytable" width="100%" border="0" cellspacing="0" cellpadding="2">
      <tbody>
	<tr>
	  <td width=45%> Valor Total do Item por 1 Quilo ou 1 Litro </td>
	  <td> <input type="text" name="vti[]" value="" /> </td>
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
	  <td> 	<input type="text" name="qtp[]" value="1000" /> <small>Sempre 1 unidade padr&atilde;o</small> </td>
	</tr>
	<tr>
	  <td> Quantidade Usada do Produto (g ou ml) </td>
	  <td>  <input type="text" name="qup[]" value="" /> <small>Caso maior que 1 unidade padr&atilde;o ent&atilde;o alterar qtde total do produto (INT).</small> </td>
	</tr>
	<tr>
	  <td colspan=2> <hr style="background-color:#fff; border:#000 1px dashed; border-style: none none dashed; color:#fff;" /> </td>
	</tr>
      </tbody>
    </table>

    <table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr>
	<td width=45%> <h4>Forma&ccedil;&atilde;o do Pre&ccedil;o de Venda</h4> </td>
	<td>  </td>
      </tr>
      <tr>
	<td width=45%> Incid&ecirc;ncia de ICMS sobre o faturamento </td>
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
	<td colspan=2> <hr style="background-color:#fff; border:#000 1px dashed; border-style: none none dashed; color:#fff;" /> </td>
      </tr>
    </table>

    <input type="submit" name="btn-calc" value="Calcular" />

  </form>

</fieldset>

</body>
</html>