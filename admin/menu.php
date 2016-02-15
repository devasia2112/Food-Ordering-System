<?php
//require("bootstrap-admin.php");  is not required here
//print_r($_SESSION); die;

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
          <a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_ADMIN_ROOT;?>/home.php" class="brand"><img src="<?=SYSPATH_SERVER_LOGO;?>" height="45"></a>
          <p class="pull-right">Logado como <a href="#"><?php echo $_SESSION["admin_display_name"]; ?></a></p>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="sidebar">
        <div class="well">
          <h5>Configura&ccedil;&otilde;es</h5>
          <ul>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>logo-upload.php">FrontEnd::Logotipo</a></li>
						<li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>slider-upload.php">FrontEnd::Slider - Imagens</a></li>
						<li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>howto-order.php">FrontEnd::Howto Order</a></li>
						<li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>terms.php">FrontEnd::Terms</a></li>
						<li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>privacy.php">FrontEnd::Privacy</a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>company.php">Cadastro da Empresa</a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>#">Op&ccedil;&otilde;es de e-mail</a></li>
          </ul>
          <h5>Catalogo (menu)</h5>
          <ul>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>category.php">Categorias</a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>products.php">Produtos</a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>#">Cupoms Discontos</a></li>
	    <li><a href="javascript:abrir('600','200','<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_ROOT;?>/products-generate-file-pdf.php');">Gerar Menu PDF (Publico)</a></li>
	    <li><a href="javascript:abrir('1200','700','<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_ROOT;?>/menu-pdf-generator.php');">Gerar Menu para Clientes</a></li>
          </ul>
          <h5>Clientes</h5>
          <ul>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>customers.php">Cadastro de Clientes</a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>orders-select.php">Pedidos de Clientes para Baixar</a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>orders-select-paid.php">Pedidos de Clientes Pagos</a></li>
          </ul>
          <h5>Fornecedores</h5>
          <ul>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>supplier.php">Cadastro de Fornecedores</a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>supplier-orders.php">Pedidos para Fornecedores</a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>supplier-orders-history.php">Hist&oacute;rico de Pedidos</a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>supplier-credit-available.php">Credito com Fornecedores</a></li>
          </ul>



          <h5>Localiza&ccedil;&atilde;o </h5>
          <ul>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>#">Moedas</a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>#">Idiomas</a></li>
          </ul>
          <h5>Fiscal</h5>
          <ul>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>#">PAF-ECF</a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>#">NF-e</a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>#">Taxas</a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>#">Impostos</a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>#">Importa&ccedil;&atilde;o de XML de NF-e de entrada</a></li>
          </ul>
          <h5>Relat&oacute;rios</h5>
          <ul>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>#">Clientes Online</a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>#">Pedidos por Clientes</a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>#">Produtos Vizualizados</a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>#">Produtos Mais Vendidos</a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>reports-receivables-action.php?action=a">Contas a Receber (Pagas/Pendentes)</a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>reports-receivables-action.php?action=d">Venda Di&aacute;ria</a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>reports-receivables-action.php?action=m">Venda Mensal</a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>reports-receivables-action.php?action=y">Venda Anual</a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>reports-payables.php">Contas a Pagar</a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>reports-payables-receivables.php?action=m">Contas a Pagar & Receber</a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>reports-payables-action.php?action=mpp">Contas a Pagar (Pendentes & Pagas)</a></li>
          </ul>
          <h5>Ferramentas de Gest&atilde;o</h5>
          <ul>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>accounts.php">Contas (Receita & Despesa)</a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>stok.php">Controle de Estoque</a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>factsheet.php">Ficha T&eacute;cnica</a></li>
            <li><a href="javascript:abrir('1320','700','<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>sales.php');">Vendas (PDV)</a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>gateway.php">Gateways</a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>credit-card.php">Cart&otilde;es de Cr&eacute;dito</a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>support.php">Atendimento</a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>#">Database Backup</a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>#">Newsletter</a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>#">Idiomas</a></li>
          </ul>
          <h5>Acessos</h5>
          <ul>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>logout.php">Logout</a></li>
            <li><a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_VIEW;?>#">Logs</a></li>
          </ul>
        </div>
      </div>
