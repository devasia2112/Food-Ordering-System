<?php
if (isset($_SESSION) and empty($_SESSION['admin_access']))
{
	$redir_url = SYSPATH_PROTOCOL . SYSPATH_SERVER_ADMIN_ROOT . "/login-form/";
	if (!headers_sent())
	{
		header( "refresh:0;url=" . $redir_url );
		die('Admin Access Required!');
	}
	else
	{
		echo '<noscript>';
		echo '<meta http-equiv="refresh" content="0;url=' . $redir_url . '" />';
		echo '</noscript>';
		echo '<script type="text/javascript">';
		echo 'window.location.href="' . $redir_url . '";';
		echo '</script>';
		die('Admin Access Required!');
	}
}
?>
<script language="JavaScript">
function abrir(w,h,URL)
{
  var width = w;
  var height = h;
  var left = (screen.width/2)-(w/2);
  var top = (screen.height/2)-(h/2);
  window.open(URL,'janela', 'width='+width+', height='+height+', top='+top+', left='+left+', scrollbars=yes, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=no');
}
</script>

    <div class="topbar">
      <div class="topbar-inner">
        <div class="container-fluid">
          <a href="<?php echo SYSPATH_PROTOCOL.SYSPATH_SERVER_ADMIN_ROOT; ?>/home.php" class="brand"><img src="<?=SYSPATH_SERVER_LOGO;?>" height="45"></a>
          <p class="pull-right">logged in as <a href="#"><?php echo $_SESSION["admin_display_name"]; ?></a></p>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="sidebar">
        <div class="well">
          <h5><?php echo MENU_TITLE_1; ?></h5>
          <ul>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>logo-upload.php"><?php echo MENU_TITLE_1_1; ?></a></li>
						<li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>slider-upload.php"><?php echo MENU_TITLE_1_2; ?></a></li>
						<li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>howto-order.php"><?php echo MENU_TITLE_1_3; ?></a></li>
						<li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>terms.php"><?php echo MENU_TITLE_1_4; ?></a></li>
						<li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>privacy.php"><?php echo MENU_TITLE_1_5; ?></a></li>
						<li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>find-us.php"><?php echo MENU_TITLE_1_6; ?></a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>company.php"><?php echo MENU_TITLE_1_7; ?></a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>#"><?php echo MENU_TITLE_1_8; ?></a></li>
          </ul>
          <h5><?php echo MENU_TITLE_2; ?></h5>
          <ul>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>category.php"><?php echo MENU_TITLE_2_1; ?></a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>products.php"><?php echo MENU_TITLE_2_2; ?></a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>#"><?php echo MENU_TITLE_2_3; ?></a></li>
				    <li><a href="javascript:abrir('600','200','<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_ROOT;?>/products-generate-file-pdf.php');"><?php echo MENU_TITLE_2_4; ?></a></li>
				    <li><a href="javascript:abrir('1200','700','<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_ROOT;?>/menu-pdf-generator.php');"><?php echo MENU_TITLE_2_5; ?></a></li>
          </ul>
          <h5><?php echo MENU_TITLE_3; ?></h5>
          <ul>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>customers.php"><?php echo MENU_TITLE_3_1; ?></a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>orders-select.php"><?php echo MENU_TITLE_3_2; ?></a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>orders-select-paid.php"><?php echo MENU_TITLE_3_3; ?></a></li>
          </ul>
          <h5><?php echo MENU_TITLE_4; ?></h5>
          <ul>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>supplier.php"><?php echo MENU_TITLE_4_1; ?></a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>supplier-orders.php"><?php echo MENU_TITLE_4_2; ?></a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>supplier-orders-history.php"><?php echo MENU_TITLE_4_3; ?></a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>supplier-credit-available.php"><?php echo MENU_TITLE_4_4; ?></a></li>
          </ul>

          <h5><?php echo MENU_TITLE_5; ?></h5><code><?php echo MENU_TITLE_5_a; ?></code>
          <ul>
						<li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>#"><?php echo MENU_TITLE_5_1; ?></a></li>
						<li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>#"><?php echo MENU_TITLE_5_2; ?></a></li>
						<li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>#"><?php echo MENU_TITLE_5_3; ?></a></li>
						<li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>#"><?php echo MENU_TITLE_5_4; ?></a></li>
          </ul>
          <h5><?php echo MENU_TITLE_6; ?></h5><code><?php echo MENU_TITLE_6_a; ?></code>
          <ul>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>#">PAF-ECF</a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>#">NF-e</a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>#">Taxas</a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>#">Impostos</a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>#">Importa&ccedil;&atilde;o de XML de NF-e de entrada</a></li>
          </ul>
          <h5><?php echo MENU_TITLE_7; ?></h5>
          <ul>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>#"><?php echo MENU_TITLE_7_1; ?></a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>#"><?php echo MENU_TITLE_7_2; ?></a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>#"><?php echo MENU_TITLE_7_3; ?></a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>reports-receivables-action.php?action=a"><?php echo MENU_TITLE_7_4; ?></a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>reports-receivables-action.php?action=d"><?php echo MENU_TITLE_7_5; ?></a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>reports-receivables-action.php?action=m"><?php echo MENU_TITLE_7_6; ?></a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>reports-receivables-action.php?action=y"><?php echo MENU_TITLE_7_7; ?></a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>reports-payables.php"><?php echo MENU_TITLE_7_8; ?></a></li>
						<li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>reports-payables-action.php?action=mpp"><?php echo MENU_TITLE_7_9; ?></a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>reports-payables-receivables.php?action=m"><?php echo MENU_TITLE_7_10; ?></a></li>
          </ul>
          <h5><?php echo MENU_TITLE_8; ?></h5>
          <ul>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>accounts.php"><?php echo MENU_TITLE_8_1; ?></a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>stok.php"><?php echo MENU_TITLE_8_2; ?></a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>factsheet.php"><?php echo MENU_TITLE_8_3; ?></a></li> <!-- Ficha T&eacute;cnica -->
            <li><a href="javascript:abrir('1320','700','<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>sales.php');"><?php echo MENU_TITLE_8_4; ?></a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>gateway.php"><?php echo MENU_TITLE_8_5; ?></a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>credit-card.php"><?php echo MENU_TITLE_8_6; ?></a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>support.php"><?php echo MENU_TITLE_8_7; ?></a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>#"><?php echo MENU_TITLE_8_8; ?></a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>#"><?php echo MENU_TITLE_8_9; ?></a></li>
          </ul>
          <h5><?php echo MENU_TITLE_9; ?></h5>
          <ul>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>logout.php"><?php echo MENU_TITLE_9_1; ?></a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>#"><?php echo MENU_TITLE_9_2; ?></a></li>
          </ul>
        </div>
      </div>
