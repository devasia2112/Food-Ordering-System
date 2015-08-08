<?php require("admin/bootstrap.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?=TITLE_INDEX;?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="Cadastro de Cliente - Kinthai">
    <meta name="keywords" content="">
    <script type="text/javascript" src="scripts/jquery.min.js"></script>
    <script type="text/javascript" src="scripts/jquery.curvycorners.min.js"></script>
    <link type="text/css" href="stylesheet/stylesheet.css" rel="stylesheet" />
    <script type="text/javascript" src="scripts/jquery-ui-1.8.4.custom.min.js"></script>
    <link href="scripts/jqueryui/css/redmond/jquery-ui-1.8.4.custom.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="scripts/thickbox.js"></script>
    <link href="scripts/thickbox.css" rel="stylesheet" type="text/css" />
    <link rel="SHORTCUT ICON" href="favicon2.ico" />
    <script type="text/javascript" src="admin/js/combo.js"></script>
    <script type="text/javascript">
    function isNumberKey(evt)
    {
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))
	    return false;

	return true;
    }
    
    
	function numberFormat(fld, milSep, decSep, e) 
	{
		var sep = 0;
		var key = '';
		var i = j = 0;
		var len = len2 = 0;
		var strCheck = '0123456789';
		var aux = aux2 = '';
		var whichCode = (window.Event) ? e.which : e.keyCode;
		
		if (whichCode == 13 || whichCode == 8 || whichCode == 0) return true;
		key = String.fromCharCode(whichCode);  // Get key value from key code
		if (strCheck.indexOf(key) == -1) return false;  // Not a valid key
		len = fld.value.length;
		for(i = 0; i < len; i++)
		if ((fld.value.charAt(i) != '0') && (fld.value.charAt(i) != decSep)) break;
		aux = '';
		for(; i < len; i++)
		if (strCheck.indexOf(fld.value.charAt(i))!=-1) aux += fld.value.charAt(i);
		aux += key;
		len = aux.length;
		if (len == 0) fld.value = '';
		if (len == 1) fld.value = '0'+ decSep + '0' + aux;
		if (len == 2) fld.value = '0'+ decSep + aux;
		if (len > 2) 
		{
			aux2 = '';
			for (j = 0, i = len - 3; i >= 0; i--) 
			{
				if (j == 3) {
					aux2 += milSep;
					j = 0;
				}
				aux2 += aux.charAt(i);
				j++;
			}
			fld.value = '';
			len2 = aux2.length;
			for (i = len2 - 1; i >= 0; i--)
			fld.value += aux2.charAt(i);
			fld.value += decSep + aux.substr(len - 2, len);
		}
		return false;
	}
    
    
    
    function formatar_mascara(src, mascara) {
	    var campo = src.value.length;
	    var saida = mascara.substring(0,1);
	    var texto = mascara.substring(campo);
	    if(texto.substring(0,1) != saida) {
		    src.value += texto.substring(0,1);
	    }
    }
    function AddHiddenValue(oForm) {
	var strValue = document.getElementById("cidade").value;
	//alert("value: " + strValue);
	var oHidden = document.createElement("input");
	oHidden.name = "town";
	oHidden.value = strValue;
	oForm.appendChild(oHidden);
    }
    $(function() {
	    flag = 0;
	    $("a.header").each(function() {
		    loc = window.location.href;
		    url = $(this).attr("href");
		    if (loc.indexOf(url) > -1) {
			    if (loc[loc.length-1]=="pedido-grupos") {
				    if (url=="pedido-grupos")
					    $(this).css("color", "yellow");
			    }
			    else if (url!="pedido-grupos") {
				    $(this).css("color", "yellow");
			    }
		    }
	    });
    });
    </script>

    <script src="scripts/jquery.tools.min.js"></script>
    <link rel="stylesheet" type="text/css" href="stylesheet/overlay-apple.css"/>    
</head>


<!-- overlayed element -->
<div class="apple_overlay" id="overlay">
  <!-- the external content is loaded inside this tag -->
  <div class="contentWrap"></div>
</div>
<!-- make all links with the 'rel' attribute open overlays -->
<script>
$(function() {
	// if the function argument is given to overlay,
	// it is assumed to be the onBeforeLoad event listener
	$("a[rel]").overlay({
		mask: '#000',
		effect: 'apple',
		onBeforeLoad: function() {
			// grab wrapper element inside content
			var wrap = this.getOverlay().find(".contentWrap");
			// load the page specified in the trigger
			wrap.load(this.getTrigger().attr("href"));
		}
	});
});
</script>
<!-- overlayed element - end -->


<!-- header -->
<?php include("_header.inc.php"); ?>
<!-- header -->

<?php
// IMPORTANTE: OLHAR O ARQUIVO global-register.php -> complemento para o cadastro do cliente
if (!isset($_SESSION)) session_start();
if (isset($_GET['add']) && $_GET['add'] == 1) 
{  
    // Creates a session here to control the redirect, if it comes from checkout must comeback to checkout otherwise redirect to default page
    $_SESSION['CHECKOUT_ADD_CUSTOMER'] = $_GET['add'];
}
?>


<body>

    <div style="height:0px; overflow:hidden;"></div>
    <table width="999" border="0" cellpadding="0" cellspacing="0" align="center" id="table990" class="table bg">
      <tr>
        <td width="636" id="left_column" valign="top">



      <div class="container">
		<div class="hero-unit">
          <h2><?=H2_CUSTOMER_REGISTER;?></h2>
                <?=TXT_H2_CUSTOMER;?>            
        </div>



        <!-- Aviso resultado do registro -->
        <?php
        if( isset($_SESSION['MSGOK']) && $_SESSION['MSGOK']==1 ) 
        {
            if (isset($_SESSION['CHECKOUT_ADD_CUSTOMER']) && $_SESSION['CHECKOUT_ADD_CUSTOMER'] == 1)
            {
                GenericSql::Redirect($sec=0, $file="checkout");
                die();
            }
            //GenericSql::Redirect($sec=0, $file="checkout.php");
            //die();
            $st = "success"; 
            $msg = MSG_CUSTOMER_REGISTER_SUCCESS; 
            ?>
                <center>
                <div class="alert-message <?=$st;?>" style="width:92%;">
                    <p><strong>Avisos!</strong> <?=$msg;?> </p>
                </div>
                </center>
            <?
            unset( $_SESSION['MSGOK'] );           
            //GenericSql::Redirect($sec=3, $file="menu");
        } 
        else 
        {
            $st = "error"; 
            $msg = MSG_CUSTOMER_REGISTER_ERROR; 
            if (isset($_SESSION['MSGOK']))
            {
            ?>
                <center>
                <div class="alert-message <?=$st;?>" style="width:92%;">
                    <p><strong>Avisos!</strong> <?=$msg;?> </p>
                </div>
                </center>
            <?
            }
            unset( $_SESSION['MSGOK'] );
        }
        ?>
        <!-- Aviso resultado do registro -->


        <!-- Aviso de erro no registro -->
        <?php
        if( isset($_GET['msg']) && !empty($_GET['msg']) ) 
        { ?>
                <center>
                <div class="alert-message error" style="width:92%;">
                    <p align="left"><strong> <?php echo LBL_WARNING; ?> </strong><br /> <?=urldecode(base64_decode($_GET['msg']));?> </p>
                </div>
                </center>
        <?
        }
        ?>
        <!-- Aviso de erro no registro -->


        <?php
        // UPDATE :: $_GET['endereco'] comes from jcart.php
        if (isset($_GET['endereco']) and $_GET['endereco'] == "atualizar")
        {
			if (isset($_GET['id']) and !empty($_GET['id'])) 
			{
				$customer_id 		= Url::urlDec( $_GET['id'] );
				
				// Query customer data by email to fill the fields in the form
				$customers_data     = GenericSql::mysql_select($fieldsarray="*", $table="customers", $uniquefield="id", $uniquevalue=$customer_id);
				
				$form_action_file   = "customer-update.php";
				$field_readonly     = "readonly";
				$field_password     = "<a href='change-pw?email=" . $customers_data['email'] . "&endereco=" . $_GET['endereco'] . "&id=" . $_GET['id'] . "' rel='#overlay'>".LBL_UPDATE_PASSWORD."</a>";
			}
			else
			{
				// Query customer data by email to fill the fields in the form
				$customers_data     = GenericSql::mysql_select($fieldsarray="*", $table="customers", $uniquefield="email", $uniquevalue=$_SESSION['USER_EMAIL']);
				$customer_id        = $customers_data['id'];    //customer ID
				$form_action_file   = "customer-update.php";
				$field_readonly     = "readonly";
				$field_password     = "<a href='change-pw?email=" . $customers_data['email'] . "&endereco=" . $_GET['endereco'] . "&id=" . $_GET['id'] . "' rel='#overlay'>".LBL_UPDATE_PASSWORD."</a>";
			}
        }
        else    // INSERT
        {
            $form_action_file   = "customer-insert.php";
            $field_readonly     = LBL_USED_FOR_SYSTEM_LOGIN;
            $field_password     = '<input type="password" maxlength="15" name="password" size="20" class="span4" />';
        }
        ?>

		<form method="post" action="admin/model/<?=$form_action_file;?>" onsubmit="AddHiddenValue(this);">

			<!-- DADOS PESSOAIS -->
            <input type="hidden" name="customer-id" value="<?=$customer_id;?>" />
            <table class="cadastro-cliente">
				<tr>
                    <td colspan=4><h3><?=LBL_CUSTOMER_PERSONAL_DATA;?></h3></td>
                </tr>
				<tr>
                    <td align="right" class="cadastro-cliente-td">*<?=LBL_CUSTOMER_NAME;?></td>
                    <td class="cadastro-cliente-td">
                        <input type="text" maxlength="55" name="name" size="20" class="span8" value="<?=$customers_data['name'];?>" /></td>
				    <td align="right" class="cadastro-cliente-td"><?=LBL_CUSTOMER_VALID_DOCUMENT;?></td>
                    <td class="cadastro-cliente-td">
                        <input type="text" maxlength="14" name="valid_document" size="20" class="span3" value="<?=$customers_data['valid_document'];?>" /> <small><?php echo LBL_CUSTOMER_VALID_DOCUMENT_ONLY_NUM_LETTER; ?></small> </td>
                </tr>
				<tr>
                    <td align="right" class="cadastro-cliente-td">*<?=LBL_CUSTOMER_EMAIL;?></td>
                    <td class="cadastro-cliente-td">
                        <div class="input-prepend">
                            <span class="add-on"></span>
                            <input id="prependedInput" class="span7" type="text" size="20" name="email" value="<?=$customers_data['email'];?>" <?=$field_readonly;?> />
                            <?=$field_readonly;?>
                        </div>
                    </td>
				    <td class="cadastro-cliente-td" align="right">*<?=LBL_CUSTOMER_PASSWORD;?></td>
                    <td class="cadastro-cliente-td"><?=$field_password;?></td>
                </tr>

				<?php if( SYSPATH_LANG == "/includes/lang/pt-br.php" ) { ?>

					<tr>
		                <td class="cadastro-cliente-td" align="right"><?=LBL_CUSTOMER_BIRTHDAY_DATE;?></td>
		                <td  class="cadastro-cliente-td" colspan=3> 
		                    <input type="text" maxlength="10" name="birthday" size="20" onkeypress="formatar_mascara(this, '##-##-####')" class="span3" value="<?php if (!empty($customers_data['birthday'])) echo sqltobr($customers_data['birthday']); else echo ""; ?>"/> <small>(DD-MM-AAAA)</small>
		                </td>
		            </tr>

				<?php } else { ?>

					<tr>
		                <td class="cadastro-cliente-td" align="right"><?=LBL_CUSTOMER_BIRTHDAY_DATE;?></td>
		                <td  class="cadastro-cliente-td" colspan=3> 
		                    <input type="text" maxlength="10" name="birthday" size="20" onkeypress="formatar_mascara(this, '####-##-##')" class="span3" value="<?php if (!empty($customers_data['birthday'])) echo $customers_data['birthday']; else echo ''; ?>"/> <small>(YYYY-MM-DD)</small>
		                </td>
		            </tr>

				<?php } ?>

            </table>
			<!-- DADOS PESSOAIS -->


			<!-- INFORMACOES DO ENDERECO -->
            <table class="cadastro-cliente">
				<tr>
                    <td class="cadastro-cliente-td" colspan=6><h3><?=LBL_CUSTOMER_ADDRESS_INFORMATION;?> </h3></td>
                </tr>
				<tr>
                    <td class="cadastro-cliente-td" align="right">*<?=LBL_CUSTOMER_STREET;?></td>
                    <td class="cadastro-cliente-td" colspan=5>
                        <input type="text" maxlength="100" name="street" size="94" class="span15" value="<?=$customers_data['street'];?>" /></td>
                </tr>
				<tr>
                    <td class="cadastro-cliente-td" align="right">*<?=LBL_CUSTOMER_NUMBER;?></td>      
                    <td class="cadastro-cliente-td">
                        <input type="text" maxlength="14" name="number" size="20" class="span3" value="<?=$customers_data['number'];?>" /></td>
				    <td class="cadastro-cliente-td" align="right"><?=LBL_CUSTOMER_MISC;?></td> 
                    <td class="cadastro-cliente-td">
                        <input type="text" maxlength="24" name="complement" size="20" value="<?=$customers_data['complement'];?>" /></td>
				    <td class="cadastro-cliente-td" align="right">*<?=LBL_CUSTOMER_SUBURB;?></td>
                    <td class="cadastro-cliente-td">
                        <input type="text" maxlength="24" name="suburb" size="20" value="<?=$customers_data['suburb'];?>" /></td>
                </tr>
				<tr>



				<?php if( SYSPATH_LANG == "/includes/lang/pt-br.php" ) { ?>

				
					<!-- START COMBO estado/cidade -->
		                <?php if (!isset($_SESSION)) session_start(); ?>
						<td class="cadastro-cliente-td" align="right">*<?=LBL_CUSTOMER_STATE;?></td>
		                <td class="cadastro-cliente-td" align="right">
							<select name="state">
								<option value="0"><?=LBL_CUSTOMER_STATE_DEFAULT_TXT;?></option>
								<?php GenericSql::getBrazilianStates( $customers_data['state'] ); ?>
							</select>
						</td>
						<td class="cadastro-cliente-td" align="right"> *<?=LBL_CUSTOMER_TOWN;?> </td>
						<td class="cadastro-cliente-td" align="right">
							<select name="town">
								<option value="0"><?=LBL_CUSTOMER_TOWN_DEFAULT_TXT;?></option>
								<?php GenericSql::getBrazilianCities( $customers_data['town'] ); ?>
							</select>
						</td>
					<!-- END COMBO -->


				<?php } else { ?>


					<!-- START COMBO estado/cidade -->
		                <?php if (!isset($_SESSION)) session_start(); ?>
						<td class="cadastro-cliente-td" align="right">*<?=LBL_CUSTOMER_STATE;?></td>
		                <td class="cadastro-cliente-td" align="right">
							<input type="text" name="state" value="<?php echo $customers_data['state']; ?>">
						</td>
						<td class="cadastro-cliente-td" align="right"> *<?=LBL_CUSTOMER_TOWN;?> </td>
						<td class="cadastro-cliente-td" align="right">
							<input type="text" name="town" value="<?php echo $customers_data['town']; ?>">
						</td>
					<!-- END COMBO -->


				<?php } ?>


				
                    <td class="cadastro-cliente-td" align="right">*<?=LBL_CUSTOMER_ZIPCODE;?></td>   
                    <td class="cadastro-cliente-td" align="right">
                        <input type="text" name="zipcode" size="20" onkeypress="return(numberFormat(this,'','',event))" maxlength="8" value="<?=$customers_data['zipcode'];?>" title="<?=TITLE_CEP_INFO;?>" alt="<?=TITLE_CEP_INFO;?>"  /></td>
				</tr>
				<tr>
                    <td class="cadastro-cliente-td" align="right">*<?=LBL_CUSTOMER_PHONE1;?></td>
                    <td class="cadastro-cliente-td">
                        <input type="text" maxlength="12" name="phone_one" size="20"  onkeypress="formatar_mascara(this, '##-####-####')" class="span5" value="<?=$customers_data['phone_one'];?>" /> </td>
                    <td class="cadastro-cliente-td" align="right"><?=LBL_CUSTOMER_PHONE2;?></td>
                    <td class="cadastro-cliente-td" colspan=3>
                        <input type="text" maxlength="12" name="phone_two" size="20" onkeypress="formatar_mascara(this, '##-####-####')" class="span5" value="<?=$customers_data['phone_two'];?>" /> </td>
                </tr>
            </table>		
		    <!-- INFORMACOES DO ENDERECO -->

            <table class="cadastro-cliente">
                <tr>
                    <td colspan=3> <br /> </td>
                </tr>
				<tr>
                    <td class="cadastro-cliente-td" width="55%">
                        <div class="input-prepend">
                            <label class="add-on"><input type="checkbox" value="1" name="accepted" /></label>
                            <label class="add-on"> <?=LBL_CUSTOMER_TERMS_CONDITIONS;?> </label>
                        </div>
                    </td>
                    <td class="cadastro-cliente-td">
                        <?=LBL_CUSTOMER_FIELDS_MUST_HAVE;?> 
                    </td>
                </tr>
                <tr>
                    <td colspan=3> <br /> </td>
                </tr>
				<tr>
				    <td class="cadastro-cliente-td"><input type='submit' value="<?=LBL_CUSTOMER_BTN_REGISTER;?>" class="btn success" /></td>
                    <td class="cadastro-cliente-td"> &nbsp; </td>
                </tr>


		    </table>

		</form>
    </div>



        </td>
    </tr>


    <tr><td colspan=3>&nbsp;</td></tr>
    <tr>
        <td colspan=3> 
            <div style="background-color:#dcdcdc; height:1px; overflow:hidden; margin-top:20px; margin-bottom:10px;" class="table bg"></div>
        </td>
    </tr>
    <tr><td colspan=3>&nbsp;</td></tr>
</table>


<!-- footer -->
<?php require("_footer.inc.php"); ?>
<!-- footer -->


  </body>
</html>
