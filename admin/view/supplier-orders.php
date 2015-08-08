<?php require("../bootstrap-admin.php");
defined('SYSPATH_ADMIN') or die('No direct script access.');
include('../../includes/config/config.php');
include('../../includes/Sql/sql.class.php');
session_start();
?><!DOCTYPE html>
<html lang="en">
  <head>
    <title>...</title>
    <meta name="description" content="Software Development">
    <meta name="author" content="deepcell.org">
    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	<!-- upload -->  
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/jquery.form.js"></script>

	<script type="text/javascript" src="../../scripts/general-functions.js"></script>
	<script type="text/javascript" src="../js/form.js"></script>

	
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
		
		
		$("#hide").click(function(){
		  $("p").hide();
		});
		$("#show").click(function(){
		  $("p").show();
		});
	});
	</script>
	
	
	<!-- Le styles -->
    <link href="../bootstrap.css" rel="stylesheet">
    <style type="text/css">
		body {
			padding-top: 60px;
		}
		.preview{
			width:200px;
			border:solid 1px #dedede;
			padding:10px;
		}
		#preview{
			color:#cc0000;
			font-size:12px
		}	  
    </style>

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../favicon2.ico">
    
	<!--Requirement jQuery-->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<!--Load Script and Stylesheet -->
	<script type="text/javascript" src="jQueryDatetimePicker/jquery.simple-dtpicker.js"></script>
	<link type="text/css" href="jQueryDatetimePicker/jquery.simple-dtpicker.css" rel="stylesheet" />
	<!---->
        
  </head>


  <body>
	<?php include("../menu.php"); ?>
	<div class="content">
	<div class="hero-unit">
	  <h1>Pedidos de Fornecedores</h1>
	  <p>Cadastre aqui todos os pedidos de fornecedores de Produtos e Servi&ccedil;os.</p>
	  <p>Obs.: 1-Ao cadastrar um novo pedido de compra para o fornecedor, uma fatura em contas a pagar com status pendente sera gerada.
	  2-Evitar gravar Tipos de Itens diferentes no mesmo pedido.</p>
	</div>
	<div class="row">
	<div class="span15">

	    <form method="post" action="../model/supplier-orders.php">

		<table>
			<input type="hidden" name="submitted" value="1" />
			<div id="alert"></div>

			<tr><td align="right">&nbsp;</td><td></td></tr>
			<tr>
				<td align="right">Plano de Contas (Usado no Faturamento)</td><td>
				<select name="plano_contas" id="plano_contas">
				      <option value="0"> &nbsp;&nbsp;&nbsp;&nbsp; [selecione] </option>
				      <?php GenericSql::getAccountingPlan( ); ?>
				</select>
				</td>
			</tr>
			<tr>
				<td align="right">Fornecedor</td><td>
				<select name="fornecedor" id="fornecedor">
				      <option value="0"> &nbsp;&nbsp;&nbsp;&nbsp; [selecione] </option>
				      <?php GenericSql::getSuppliers( ); ?>
				</select>
				</td>
			</tr>
			<tr>
			  <td align="right">Data</td>
			  <td>
			    <input type="text" maxlength="256" name="date" id="date" /> 
			    <script type="text/javascript">
				    $(function(){
					    $('*[name=date]').appendDtpicker();
				    });
			    </script>
			  </td>
			</tr>
			<tr>
			  <td align="right">Prazo Fornecimento</td>
			  <td>
			    <input type="text" maxlength="256" name="prazo_fornecimento" id="prazo_fornecimento" /> 
			    <script type="text/javascript">
				    $(function(){
					    $('*[name=prazo_fornecimento]').appendDtpicker();
				    });
			    </script>
			  </td>
			</tr>
			<tr>
			  <td align="right">Prazo Pagamento</td>
			  <td>
			    <input type="text" maxlength="256" name="prazo_pagamento" id="prazo_pagamento" /> 
			    <script type="text/javascript">
				    $(function(){
					    $('*[name=prazo_pagamento]').appendDtpicker();
				    });
			    </script>
			  </td>
			</tr>
			<tr>
				<td align="right">Metodo Pagamento</td><td>
				<select name="metodo_pgto" id="metodo_pgto">
				      <option value="0"> &nbsp;&nbsp;&nbsp;&nbsp; [selecione] </option>
				      <option value="boleto">Boleto</option>
				      <option value="deposito">Deposito</option>
				      <option value="cartao">Cartao</option>
				      <option value="cheque">Cheque</option>
				</select>
				</td>
			</tr>
			<tr>
				<td align="right">Empresa</td><td>
				<select name="empresa" id="empresa">
				      <option value="0"> &nbsp;&nbsp;&nbsp;&nbsp; [selecione] </option>
				      <option value="1">Kinthai 1</option>
				      <option value="2">2</option>
				</select>
				</td>
			</tr>
			<tr>
				<td align="right">Caixa</td><td>
				<select name="caixa" id="caixa">
				      <option value="0"> &nbsp;&nbsp;&nbsp;&nbsp; [selecione] </option>
				      <option value="1">Caixa 1</option>
				      <option value="2">Caixa 2</option>
				</select>
				</td>
			</tr>
			<tr>
			  <td align="right">Descri&ccedil;&atilde;o (Consta na Fatura)</td>
			  <td>
			    <input type="text" maxlength="256" name="desc" id="desc" /> 
			  </td>
			</tr>

			
			<tr><td colspan="2">&nbsp; </td></tr>
			
			
			<tr><td colspan="2">
			  <a id="add" class="btn primary"> (+) Adicionar Item ao Pedido </a> <a id="remove" class="btn danger"> (-) Remover Item do Pedido </a> <br /><br />
			</td></tr>
		</table>
		
		
		
		<table id="mytable">
		    <tbody>  
			<tr>
				<td align="right">Tipo do Item</td><td>
				<select name="item_tipo[]" id="item_tipo">
				      <option value="0"> &nbsp;&nbsp;&nbsp;&nbsp; [selecione] </option>
				      <option value="ingredient" id="hide">Ingredientes</option>
				      <option value="services" id="hide">Servicos</option>
				      <option value="fixed assets" id="show">Ativo Permanente (fixed assets)</option>
				      <option value="current assets" id="hide">Ativo Circulante (current assets)</option>
				      <option value="operational expenses" id="hide">Despesa Operacional (operational expenses)</option>
				      
				</select>
				</td>
			</tr>
			<tr>
				<td><p> Ativo Permanente </p></td>
				<td><p> <input type="text" name="fixed_assets" value="" /> </p></td>
			</tr>
			
			<tr>
				<td align="right">Item Cadastrado </td><td>
				<select name="item_id[]" id="item_id">
				      <option value="0"> &nbsp;&nbsp;&nbsp;&nbsp; [selecione] </option>
				      <?php $ret = GenericSql::getAllIngredients( ); ?>
				      <?php $c = count($ret); for ($i=0;$i<=$c;$i++) { $opt .= "<option value='".$ret[$i][id]."'>".$ret[$i][name]."</option>"; } ?>
				      <?php echo $opt; ?>
				</select> <small><i>Usar apenas se o tipo do item for ingrediente</i> </small>
				</td>
			</tr>
			<tr>
			  <td align="right">Quantidade</td>
			  <td>
			    <input type="text" maxlength="256" name="quantidade[]" id="quantidade" /> 
			  </td>
			</tr>
			<tr>
				<td align="right">Unid. Medida</td><td>
				<select name="unid_medida[]" id="unid_medida">
				      <option value="0"> &nbsp;&nbsp;&nbsp;&nbsp; [selecione] </option>
				      <option value="metros">Gramas</option>
				      <option value="metros">Metro</option>
				      <option value="peca">Pe&ccedil;a</option>
				      <option value="unidade">Unidade</option>
				      <option value="caixa">Caixa</option>
				      <option value="litro">Litro</option>
				</select>
				</td>
			</tr>
			<tr>
			  <td align="right">Pre&ccedil;o Unit&aacute;rio</td>
			  <td>
			    <input type="text" maxlength="256" name="preco_unitario[]" id="preco_unitario" /> 
			  </td>
			</tr>
			<tr>
			  <td colspan=2>
			    <hr style="background-color:#fff; border:#999 1px dashed; border-style: none none dashed; color:#fff;" />
			  </td>
			</tr>
		    </tbody>
		</table>
			
			
			
		<table>	
			<tr><td colspan="2" align="center">
				<input type="submit" value="Cadastrar Pedido" name="submit" id="submit" class="btn success" /></td>
			</tr>
		</table>
	
	</form>

      
	</div>
	</div>
        <?php include("../footer.php"); ?>
	</div>
    </div>

  </body>
</html>