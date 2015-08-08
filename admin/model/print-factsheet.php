<?php
require('../../includes/config/config.php');
require('../../includes/Sql/sql.class.php');
$result = mysql_query("set names 'utf-8'");
$sql = "SELECT sp.id as spid, sp.product_id, sp.cost_value, sp.final_price, sp.datetime, \n"
    . " p.name, f.ingredient, f.unit, f.qup, f.vi, f.datetime, i.id AS ingredID, i.name AS ingredName, i.unit_cost, i.scale_unit \n"
    . "FROM `sale_price` sp \n"
    . "LEFT JOIN products p ON p.id = sp.product_id \n"
    . "LEFT JOIN factsheet f ON f.final_product = sp.product_id \n"
    . "LEFT JOIN ingredients i ON i.id = f.ingredient \n"
    . "WHERE f.final_product = '{$_GET['product_id']}' \n"
    . "ORDER BY sp.final_price DESC ";
    
$result = mysql_query( $sql ) or trigger_error(mysql_error());



####################################### TEMPLATE ########################################

$msg = file('../template/template-ficha-tecnica.html'); //, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES
foreach($msg as $m) { $mensagem = $mensagem.urldecode($m); }


	while( $row = mysql_fetch_array( $result )) {

		foreach($row AS $key => $value) { $row[$key] = stripslashes($value); }

		$product_name = $row['name'];
		$incidencias = $row['incidencias'];
		$cost_value = $row['cost_value'];
		$final_price = $row['final_price'];
		$datetime = $row['datetime'];
		$product_id = $row['product_id'];
		$ingredient_id = $row['ingredID'];
		$ingredient = $row['ingredName'];
		$unit = $row['unit'];
		$qup = $row['qup'];
		$vi = $row['vi'];
		$unit_cost = $row['unit_cost'];
		$scale_unit = $row['scale_unit'];

	/*
		$mensagem = str_replace("#INGREDIENTE-ID#", $ingredient_id, $mensagem);
		$mensagem = str_replace("#QUANTIDADE#", $qup, $mensagem);
		$mensagem = str_replace("#UNIDADE#", $unit, $mensagem);
		$mensagem = str_replace("#INGREDIENTE#", $ingredient, $mensagem);
		$mensagem = str_replace("#PRECOUNITARIO#", $unit_cost, $mensagem);
		$mensagem = str_replace("#PRECOTOTAL#", $vi, $mensagem);
		$mensagem = str_replace("#DATA#", $datetime, $mensagem);
	*/	
	//<!-- ingredients -->
		$tr .= '
			<TR>
				<TD STYLE="border-top: 1px solid #181615; border-left: 1px solid #181615; border-right: 1px solid #181615" HEIGHT=18 ALIGN=CENTER VALIGN=MIDDLE SDVAL="20" SDNUM="1033;"><B><FONT FACE="Verdana">  </FONT></B> '.$ingredient_id.' </TD>
				<TD STYLE="border-top: 1px solid #181615; border-left: 1px solid #181615; border-right: 1px solid #181615" ALIGN=LEFT><B><FONT FACE="Verdana"><BR></FONT></B> '.$qup.' </TD>
				<TD STYLE="border-top: 1px solid #181615; border-left: 1px solid #181615; border-right: 1px solid #181615" ALIGN=LEFT><B><FONT FACE="Verdana"><BR></FONT></B> '.$unit.' </TD>
				<TD STYLE="border-top: 1px solid #181615; border-left: 1px solid #181615; border-right: 1px solid #181615" ALIGN=LEFT><B><FONT FACE="Verdana"><BR></FONT></B> '.$ingredient.' </TD>
				<TD STYLE="border-top: 1px solid #181615; border-left: 1px solid #181615" ALIGN=LEFT><B><FONT FACE="Verdana"><BR></FONT></B>  </TD>
				<TD STYLE="border-top: 1px solid #181615; border-left: 1px solid #181615; border-right: 1px solid #181615" ALIGN=LEFT><B><FONT FACE="Verdana"><BR></FONT></B> '.$scale_unit.' '.$unit.' - '.$unit_cost.' </TD>
				<TD STYLE="border-top: 1px solid #181615; border-left: 1px solid #181615; border-right: 1px solid #181615" ALIGN=LEFT><B><FONT FACE="Verdana"><BR></FONT></B> '.$vi.' </TD>
				<TD STYLE="border-top: 1px solid #181615; border-left: 1px solid #181615; border-right: 1px solid #181615" ALIGN=LEFT><B><FONT FACE="Verdana"><BR></FONT></B>  </TD>
				<TD STYLE="border-top: 1px solid #181615; border-left: 1px solid #181615; border-right: 1px solid #181615" ALIGN=LEFT><B><FONT FACE="Verdana"><BR></FONT></B>  </TD>
			</TR>';
	//<!-- ingredients -->
		
		
	}

$mensagem = str_replace("#PRATO#", $product_name, $mensagem);
// TR TABLE
$mensagem = str_replace("#TR#", $tr, $mensagem);
$mensagem = str_replace("#PRECOCUSTO#", $cost_value, $mensagem);
$mensagem = str_replace("#PRECOVENDA#", $final_price, $mensagem);
$mensagem = str_replace("#DATA#", $datetime, $mensagem);

print $mensagem;

####################################### TEMPLATE ########################################
?>