<table width="300" border="0" cellpadding="3" cellspacing="0" style="background-color:#FFF;">
  <tr>
    <td colspan="4" style="background-color:#cccccc; height:3px; overflow:hidden;"></td>
  </tr>
  <tr style="background-color:#F0F0E7;">
    <td colspan="4" style="padding-left:10px; padding-right:10px;">

	<?php
	# Turn off all error reporting
	error_reporting(0);

	if (!isset($_SESSION)) session_start();
	if (isset($_SESSION['zipcode']))
	{
	    // Check ZIPCODE against the data base
	    $zipcode = $_SESSION['zipcode'];
	    require "includes/config/config.php";
	    require "includes/Sql/sql.class.php";

  		/* trabalhar com a faixa de cep para itajai e balneario direto no codigo
  		http://www.buscacep.correios.com.br/servicos/dnec/menuAction.do?Metodo=menuFaixaCep
  		Itajaí                88300-001 a 88319-999
  		Balneário Camboriú    88330-001 a 88339-999
  		*/

		  // Olhar o metodo getDeliveryArea( $zipcode ) a faixa de CEP permitido esta sendo controlada nele..
	    $arr_area = GenericSql::getDeliveryArea($database, $zipcode);

	    if ( $arr_area == 0 ) {

	      // Allow Checkout is used in jcart checkout cart
	      $_SESSION['allow_checkout'] = null;
	      //unset($_SESSION['allow_checkout']);
	      $_SESSION['allow_checkout'] = 0; ?>

	      <small>* Validate your Zipcode ->
	      <a href="javascript:void(0);" onclick="tb_show('ZIPCODE Here', 'change-zipcode.php?item_id=&amp;item_pos=&amp;KeepThis=true&amp;TB_iframe=true&amp;height=100&amp;width=250', false);"> HERE </a>

	      <?php die( "<br />Unfortunately we not deliver to your area.<br />But you can still browse our menu. " );

	    } else {

	      $_SESSION['allow_checkout'] = null;
	      //unset($_SESSION['allow_checkout']);
	      $_SESSION['allow_checkout'] = 1;

	    } ?>

	  <small>* Your Zipcode ->
	  <a href="javascript:void(0);" onclick="tb_show('Informar CEP', 'change-zipcode.php?item_id=&amp;item_pos=&amp;KeepThis=true&amp;TB_iframe=true&amp;height=100&amp;width=250', false);"> <?=$_SESSION['zipcode'];?> </a>
	  &nbsp;&nbsp; <a onClick="window.location.reload()"><img src="images/icons/loop-alt.png" height=8 border=0 title="Refresh" alt="Refresh" /></a>

	<?php } // Essa condicao e usada exclusivamente para compras de personal chef services (PCS)
	elseif ( !empty( $_SESSION['PCS']['order_id'] )) {

	      $_SESSION['allow_checkout'] = null;
	      $_SESSION['allow_checkout'] = 1;

	} else { ?>

	  <small>* Enter with your zipcode ->
	  <a href="javascript:void(0);" onclick="tb_show('ZIPCODE', 'change-zipcode.php?item_id=&amp;item_pos=&amp;KeepThis=true&amp;TB_iframe=true&amp;height=100&amp;width=250', false);"> HERE </a>

	<?php } ?>

      </small>
    </td>
  </tr>
</table>
