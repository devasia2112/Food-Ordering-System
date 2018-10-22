<?php
include( '../../includes/config/config.php' );
include( '../../includes/Sql/sql.class.php' );
include( '../../includes/data.php' );
include( '../../includes/phpass-0.3/PasswordHash.php' );
include( '../../includes/Validation/validation.class.php' );
include( '../bootstrap.php' );
include( '../../' . SYSPATH_LANG );

session_start();

if ($_POST)
{
    // Escapes special characters in a string for use in an SQL statement
    // foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); }
    $n=0;

	try
	{
	    # Remove Hidden Field (Here is not useful)
	    unset( $_POST['customer-id'] );

	    # Try to use stronger but system-specific hashes, with a possible fallback to
	    # the weaker portable hashes.
	    $t_hasher           = new PasswordHash(8, FALSE);
	    $_POST['password']  = $t_hasher->HashPassword( $_POST['password'] );

	    # Convert date to mysql format only in case of the lang of the system is set to pt-br
		if( SYSPATH_LANG == "/includes/lang/pt-br.php" ) {
			$_POST['birthday']  = sqltobr( $_POST['birthday'] );
		}

	    # Inputs Validation
	    # NAME
	    if (valid::isAlphaPlus( $_POST['name'] )){}
	    else {
			//$msg = "O campo NOME n&atilde;o pode ser vazio<br />";
			$msg = MSG_CUSTOMER_INSERT_NAME;
			$n += 1;
	    }
	    # EMAIL
	    if (valid::isEmail( $_POST['email'] )){}
	    else {
			//$msg .= "O campo EMAIL n&atilde;o pode ser vazio ou &eacute; inv&aacute;lido.<br />";
			$msg .= MSG_CUSTOMER_INSERT_EMAIL;
			$n += 1;
	    }
	    # BIRTHDAY  not required but good to send promotions in the birthday!
	    if (valid::isDate( $_POST['birthday'] )){}
	    else {
			//$msg .= "O campo DATA DE NASCIMENTO n&atilde;o pode ser vazio ou &eacute; inv&aacute;lido.<br />";
			//$msg .= MSG_CUSTOMER_INSERT_BIRTHDAY;
			//$n += 1;
	    }
	    # PASSWORD
	    if (valid::hasValue( $_POST['password'] )){}
	    else {
			//$msg .= "O campo SENHA n&atilde;o pode ser vazio. <br />";
			$msg .= MSG_CUSTOMER_INSERT_PASSWORD;
			$n += 1;
	    }
	    # STREET
	    if (valid::checkLength( $_POST['street'], $maxLength = 32, $minLength = 5 )){}
	    else {
			//$msg .= "O campo RUA/AV. n&atilde;o pode ser vazio, Min. de 5 e Max. de 32 carcteres <br />";
			$msg .= MSG_CUSTOMER_INSERT_ADDRESS;
			$n += 1;
	    }
	    # STREET NUMBER
	    if (valid::checkLength( $_POST['number'], $maxLength = 8, $minLength = 1 )){}
	    else {
			//$msg .= "O campo NUMERO n&atilde;o pode ser vazio, Min. de 1 e Max. de 8 carcteres <br />";
			$msg .= MSG_CUSTOMER_INSERT_NUMBER;
			$n += 1;
	    }
	    # SUBURB
	    if (valid::checkLength( $_POST['suburb'], $maxLength = 25, $minLength = 2 )){}
	    else {
			//$msg .= "O campo BAIRRO n&atilde;o pode ser vazio, Min. de 2 e Max. de 25 carcteres <br />";
			$msg .= MSG_CUSTOMER_INSERT_SUBURB;
			$n += 1;
	    }
	    # ZIPCODE
	    if (valid::checkLength( $_POST['zipcode'], $maxLength = 8, $minLength = 5 )){}
	    else {
			//$msg .= "O campo CEP n&atilde;o pode ser vazio, Min. de 8 e Max. de 8 caracteres <br />";
			$msg .= MSG_CUSTOMER_INSERT_ZIPCODE;
			$n += 1;
	    }
	    # TOWN
	    if (valid::hasValue( $_POST['town'] )){}
	    else {
			//$msg .= "O campo CIDADE n&atilde;o pode ser vazio. <br />";
			$msg .= MSG_CUSTOMER_INSERT_TOWN;
			$n += 1;
	    }
	    # STATE
	    if (valid::hasValue( $_POST['state'] )){}
	    else {
			//$msg .= "O campo ESTADO n&atilde;o pode ser vazio. <br />";
			$msg .= MSG_CUSTOMER_INSERT_STATE;
			$n += 1;
	    }
	    # PHONE
	    if (valid::isBrazilianZipCode($_POST['phone_one'])){}
	    else {
			//$msg .= "O campo TELEFONE n&atilde;o pode ser vazio, o formato correto xx-xxxx-xxxx <br />";
			$msg .= MSG_CUSTOMER_INSERT_PHONE_1;
			$n += 1;
	    }
	    # TERMS & CONDITIONS
	    if (valid::hasValue( $_POST['accepted'] )){}
	    else {
			//$msg .= "O campo TERMOS & CONDI&Ccedil;&Otilde;ES n&atilde;o pode ser vazio. <br />";
			$msg .= MSG_CUSTOMER_INSERT_TERMS;
			$n += 1;
	    }

	    # In case of problems with register, then redirect back to customer's register
	    if ( $n >= 1 || !empty($n) )
	    {
  			if ( isset($_POST['submitted']) and $_POST['submitted'] == 1 ) {
  				// aqui vamos marcar algumas variaveis que nao precisamos validar na area admin
  				$accepted = $_POST['accepted'];
  				unset( $_POST['accepted'] );
  				unset( $_POST['doc'] );
  			} else {
  				GenericSql::Redirect($sec=5, $file="../../customer-registration?msg=" . base64_encode( urlencode( $msg ) ) );
  				die( '<center><br><img src="../../images/loading.gif"></center>' );
  			}
	    }

	    $submitted = $_POST['submitted'];
	    unset($_POST['submitted']);
	    unset($_POST['country']);	//nao usado nas interfaces cliente / admin

	    # Basic Sanitization
	    $values = array_values($_POST);
	    $keys   = array_keys($_POST);
      $last_insert_id = GenericSql::setCustomer($database, $values, $keys);

	    $_SESSION['IDCUSTOMER'] = $last_insert_id;    //Last Insert Customer ID, used with B2Stok.  DO NOT FORGET to unset it in the checkout page
	    $_SESSION['MSGOK'] = 1;

		if (isset($submitted) and $submitted == 1)
    {
		    GenericSql::Redirect($sec=3, $file="../view/customers-select.php");
		    die( '<center><br /><img src="../../images/loading.gif">' );
		}
    else
    {
		    GenericSql::Redirect($sec=5, $file="../../customer-registration");
		    die( '<center><img src="../../images/loading.gif">' );
		}
	}
	catch (Exception $e)
	{
	    echo 'ERRO INSERT: ',  $e->getMessage(), "\n";
	    $_SESSION['MSGOK'] = 0;
	    GenericSql::Redirect($sec=5, $file="../../customer-registration");
	}
}
else
{
    die('No direct script access.');
}
?>
