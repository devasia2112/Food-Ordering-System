<?php
require('../../includes/config/config.php');
require('../../includes/Sql/sql.class.php');
$result = mysql_query("set names 'utf-8'");
$sql = "SELECT * FROM recipe WHERE id='{$_GET['id']}'";
$result = mysql_query( $sql ) or trigger_error(mysql_error());

####################################### TEMPLATE ########################################

$msg = file('../template/template-print-recipe.html'); //, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES
foreach($msg as $m) { $mensagem = $mensagem.urldecode($m); }

	while( $row = mysql_fetch_array( $result )) {

		foreach($row AS $key => $value) { $row[$key] = stripslashes($value); }

		$recipe_id = $row['id'];
		$recipe_title = $row['recipe_title'];
		$recipe_ingredients = $row['ingredients'];
		$recipe_for_marinade = $row['for_marinade'];
		$recipe_for_paste = $row['for_paste'];
		$recipe_for_sauce = $row['for_sauce'];
		$recipe_for_stirfry = $row['for_stirfry'];
		$recipe_for_steam = $row['for_steam'];
		$recipe_for_wrapping = $row['for_wrapping'];
		$recipe_seasoning = $row['seasoning'];
		$recipe_dressing = $row['dressing'];
		$recipe_garnishing = $row['garnishing'];
		$recipe_accompaniment = $row['accompaniment'];
		$recipe_method = $row['method'];
		$recipe_author = $row['recipe_author'];
		$recipe_contact = $row['recipe_contact'];


	//<!-- ingredients -->
/*
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
*/
	//<!-- ingredients -->
		
		
	}

$mensagem = str_replace("#RECIPE_ID#", $recipe_id, $mensagem);
$mensagem = str_replace("#RECIPE_TITLE#", $recipe_title, $mensagem);
$mensagem = str_replace("#RECIPE_INGREDIENTS#", $recipe_ingredients, $mensagem);
$mensagem = str_replace("#RECIPE_FOR_MARINADE#", $recipe_for_marinade, $mensagem);
$mensagem = str_replace("#RECIPE_FOR_PASTE#", $recipe_for_paste, $mensagem);
$mensagem = str_replace("#RECIPE_FOR_SAUCE#", $recipe_for_sauce, $mensagem);
$mensagem = str_replace("#RECIPE_FOR_STIRFRY#", $recipe_for_stirfry, $mensagem);
$mensagem = str_replace("#RECIPE_FOR_STEAM#", $recipe_for_steam, $mensagem);
$mensagem = str_replace("#RECIPE_FOR_WRAPPING#", $recipe_for_wrapping, $mensagem);
$mensagem = str_replace("#RECIPE_SEASONING#", $recipe_seasoning, $mensagem);
$mensagem = str_replace("#RECIPE_DRESSING#", $recipe_dressing, $mensagem);
$mensagem = str_replace("#RECIPE_GARNISHING#", $recipe_garnishing, $mensagem);
$mensagem = str_replace("#RECIPE_ACCOMPANIMENT#", $recipe_accompaniment, $mensagem);
$mensagem = str_replace("#RECIPE_METHOD#", $recipe_method, $mensagem);
$mensagem = str_replace("#RECIPE_AUTHOR#", $recipe_author, $mensagem);
$mensagem = str_replace("#RECIPE_CONTACT#", $recipe_contact, $mensagem);

print $mensagem;

####################################### TEMPLATE ########################################
?>
