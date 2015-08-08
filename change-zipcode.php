<?php @session_start(); if ( isset( $_SESSION['IDCUSTOMER'] ) and !empty( $_SESSION['IDCUSTOMER'] )) { ?>
<?php
include "includes/config/config.php";
require "includes/Sql/sql.class.php";
include "includes/lang/pt-br.php";
$row = GenericSql::getCustomerById( $_SESSION['IDCUSTOMER'] );
?>

  <form action="#" method="post">
  <table border="0" cellspacing="0" cellpadding="3" width="100%">
    <tr>
      <td align="right"><small>ZIPCODE&nbsp;here: </small></td>
      <td>&nbsp;</td>
      <td><input type="text" style="width:75px;" name="postal" id="postal" maxlength="9" value="<?php echo $row['zipcode']; ?>" title="<?php echo INFO_CEP; ?>" alt="<?php echo INFO_CEP; ?>" readonly /></td>
      <td><input type="submit" value="Change" name="BtnChangePostal" /></td>
    </tr>
  </table>
  <script>setTimeout("document.getElementById('postal').focus();", 500);</script>

  
<?php } else { ?>


  <form action="#" method="post">
  <table border="0" cellspacing="0" cellpadding="3" width="100%">
    <tr>
      <td align="right"><small>ZIPCODE: </small></td>
      <td width="7">&nbsp;</td>
      <td><input type="text" style="width:75px;" name="postal" id="postal" maxlength="9" value="" /></td>
      <td><input type="submit" value="Change" name="BtnChangePostal" /></td>
    </tr>
  </table>
  <script>setTimeout("document.getElementById('postal').focus();", 500);</script>


<?php } if ($_POST) { $_SESSION['zipcode'] = $_POST['postal']; } ?>
