<?php
if (!isset($_SESSION)) @session_start();
if (!empty($_SESSION['path'])) $web_root = $_SESSION['path']; else $web_root = WEBROOT;
include_once $_SERVER['DOCUMENT_ROOT'] . $web_root . "/login/globals.php";
include ROOTDIR . DIRROOT . "/includes/_url.php";   /* URL ENCODE DECODE */
include ROOTDIR . DIRROOT . "/includes/config/config.php";
require ROOTDIR . DIRROOT . "/includes/Sql/sql.class.php";
include ROOTDIR . DIRROOT . "/includes/data.php";
include CLASSES . "/User.php";
include(dirname(__FILE__) . SYSPATH_LANG);

$array_categories   = GenericSql::getCategories();
$total_categ        = GenericSql::getTotalNumberOfCategories();
$array_company      = GenericSql::getEmpresa();
$linkfollow_heredoc = HTTPS . SERVER_NAME . DIRROOT;

// Delivery Charge is in session and has public access
$_SESSION['valor_entrega'] = $array_company['valor_entrega'];
$_SESSION['company_id'] = $array_company['id'];

if (isset($_SESSION['IDCUSTOMER']) and !empty($_SESSION['IDCUSTOMER']))
{
    $array_customer = GenericSql::getCustomerById( $_SESSION['IDCUSTOMER'] );


    if (SYSPATH_LANG == "/includes/lang/pt-br.php")
    {
	$session_customer_show .= <<<XYZ
	    <div class="headerChatLoged">
	        <div class="headerChatHelp"><a href="JavaScript:void(0)" onclick="var url=\''. {$linkfollow_heredoc} .'/Suporte/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </a></div>
  		<div class="headerLoged"><a href="' . {$linkfollow_heredoc} . "/customer-data" .'" class="headerSigup">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></div>
      <div class="headerZipcodeLoged">
        <a title="{$_SESSION[zipcode]}" href="javascript:void(0);" onclick="tb_show(\'Inform your ZIPCODE.\', \'{$linkfollow_heredoc}/change-zipcode.php?item_id=&amp;item_pos=&amp;KeepThis=true&amp;TB_iframe=true&amp;height=100&amp;width=250\', false);"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </a>
      </div>
  		<div class="headerLogout"><a href="'. {$linkfollow_heredoc} .'/log-out">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></div>
	    </div>
XYZ;

    }
    else
    {
	$session_customer_show .= <<<XYZ
	    <div class="headerChatLogedEN">
	        <div class="headerChatHelp"><a target="_blank" href="{$linkfollow_heredoc}/Suporte/"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </a></div>
		<div class="headerLoged"><a href="{$linkfollow_heredoc}/customer-data" class="headerSigup">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></div>
		<div class="headerZipcodeLoged">
      <a title="{$_SESSION[zipcode]}" href="javascript:void(0);" onclick="tb_show(\'Inform your ZIPCODE.\', \'{$linkfollow_heredoc}/change-zipcode.php?item_id=&amp;item_pos=&amp;KeepThis=true&amp;TB_iframe=true&amp;height=100&amp;width=250\', false);"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </a>
    </div>
		<div class="headerLogout"><a href="{$linkfollow_heredoc}/log-out">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></div>
	    </div>
XYZ;

      //echo $link = '<a class="link_1" href="javascript:void(0);" onclick="tb_show(\'Show Data\', \'Cliente/customer-data.php?item_id=&amp;item_pos=&amp;KeepThis=true&amp;TB_iframe=true&amp;height=600&amp;width=990\', false);"><img height="16" title="' . VIEW_DATA . '" src="images/icons/free-vector-user-interface-icons/PNG/eye.png" /></a>';
    }
}
else
{
    if (SYSPATH_LANG == "/includes/lang/pt-br.php")
    {
	$session_customer_show .= <<<XYZ
	    <div class="headerChat">
                <div class="headerChatHelp"><a href="{$linkfollow_heredoc}/Suporte/"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </a></div>
		<div class="headerSigup"><a href="{$linkfollow_heredoc}/log-in" class="headerSigup"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </a></div>
		<div class="headerZipcode"><a href="javascript:void(0);" onclick="tb_show(\'Informar CEP\', \'{$linkfollow_heredoc}/change-zipcode.php?item_id=&amp;item_pos=&amp;KeepThis=true&amp;TB_iframe=true&amp;height=100&amp;width=250\', false);"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </a> </div>
	    </div>
XYZ;

    }
    else
    {
	$session_customer_show .= <<<XYZ
	    <div class="headerChatEN">
		<div class="headerChatHelp"><a href="{$linkfollow_heredoc}/Suporte/"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </a></div>
		<div class="headerSigup"><a href="{$linkfollow_heredoc}/log-in" class="headerSigup"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </a></div>
		<div class="headerZipcode"><a href="javascript:void(0);" onclick="tb_show(\'Informar CEP\', \'{$linkfollow_heredoc}//change-zipcode.php?item_id=&amp;item_pos=&amp;KeepThis=true&amp;TB_iframe=true&amp;height=100&amp;width=250\', false);"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </a> </div>
	    </div>
XYZ;

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


<!-- top header : logotipo; tel; infos; right menu -->
<div>
	<table width="997" border="0" cellpadding="0" cellspacing="0" align="center" id="table990" class="table bg">
		<tr>
			<td width="410" valign="top">  <!-- https://placehold.it/350x120 -->
				<a href="<?php echo $linkfollow_heredoc; ?>/index" class="top_header_hide"><img src="<?php echo $linkfollow_heredoc; ?>/images/logo/<?=$array_company['logotipo'];?>" height="120" border="0"></a>
			</td>
			<td valign="top">

			    <div align="right">
			      <table>
			        <tr>
			          <td>
				        <?=$session_customer_show;?>
			          </td>
			          <td>&nbsp;&nbsp;&nbsp;</td>
			          <td>

						<!-- validate ZIPCODE -->
						<!-- <div id="cart"></div> -->
						<script type="text/javascript">
						function cart_update() {
							$.post("<?php echo $linkfollow_heredoc; ?>/cart-zipcode.php", {}, function(data) {
								$("#cart").html(data);
							});
						}
						function cart_delete(id, item_pos) {
							if (typeof(item_pos) == 'undefined') item_post = 0;
							$.post("<?php echo $linkfollow_heredoc; ?>/cart-zipcode.php", {'delete_id': id, 'item_pos': item_pos}, function(data) {
								$("#cart").html(data);
							});
						}
						function cart_add(id, qty, option_id) {
							if (typeof(option_id) == 'undefined') option_id = 0;
							$.post("<?php echo $linkfollow_heredoc; ?>/cart-zipcode.php", {'item_id': id, 'qty': qty, 'option_id': option_id}, function(data) {
								$("#cart").html(data);
							});
						}
						$(function() { cart_update();});
						</script>
						<!-- validate ZIPCODE -->

			          </td>
			        </tr>
			      </table>
			    </div>

				<table border="0" cellspacing="0" cellpadding="0">
					<tr class="top_header_hide">
						<td valign="top" height="77" align="right" style="font-size:24px; line-height:28px; font-weight:bold; color:#FFFFFF;">
							<div class="top_header_open_time">
								<div style="font-size:32px; font-weight:normal; color:#333; text-shadow: 2px 2px 5px #999; 3px 3px 5px red;"><img src="<?php echo $linkfollow_heredoc; ?>/images/Cell-Phone.png" /> <?=LBL_CALL_NOW;?> <?=$array_company['tel1'];?> &nbsp;&nbsp; </div> <br />
								<div style="font-size:32px; font-weight:normal; color:#333; text-shadow: 2px 2px 5px #999; 3px 3px 5px red;"> <?=LBL_OPEN_DAILY_FROM;?>
								  <? echo strftime("%H:%M", strtotime($array_company['abre']));?> <?=LBL_OPEN_DAILY_TO;?>
								  <? echo strftime("%H:%M", strtotime($array_company['fecha']));?> &nbsp;&nbsp;
								</div>
							</div>
						</td>
					</tr>
					<tr> <!-- style="border-radius:5px; -moz-border-radius:5px; -webkit-border-radius: 5px; border:solid black 0px; background:#000;" -->
						<td>
							<link rel="stylesheet" type="text/css" href="<?php echo $linkfollow_heredoc; ?>/scripts/superfish/css/superfish.css" media="screen">
							<script type="text/javascript" src="<?php echo $linkfollow_heredoc; ?>/scripts/superfish/js/hoverIntent.js"></script>
							<script type="text/javascript" src="<?php echo $linkfollow_heredoc; ?>/scripts/superfish/js/superfish.js"></script>
							<script type="text/javascript">jQuery(function(){jQuery('ul.sf-menu').superfish();});</script>
              <?php if (basename($_SERVER['PHP_SELF']) == "menu.php") $position = 'absolute'; else $position = 'absolute'; ?>
							<div style="position:<?php echo $position; ?>; z-index:-1; background:#000000; overflow:hidden; width:100%; height:40px;" id="blackbar_id">&nbsp;</div>
							<table border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td valign="top">
										<a class="header" style="width:0px; margin-right:45px;"></a>
									</td>
									<td><img src="<?php echo $linkfollow_heredoc; ?>/images/left_round_old.jpg"></td>
									<td valign="top">
										<a class="header" href="<?php echo $linkfollow_heredoc; ?>/index"><?=MENU_HOME;?></a>
									</td>
									<td valign="top">
										<a class="header" href="<?php echo $linkfollow_heredoc; ?>/how-to-order" style="margin-right:0px; background-color:#000; "><?=MENU_HOW_TO_ORDER;?></a>
									</td>
									<td valign="top">
										<ul class="sf-menu">
											<li>
												<a href="<?php echo $linkfollow_heredoc; ?>/menu" class="header_submenu_menu"><?=MENU_MENU;?></a>

												<!--- not used at this moment
												<ul>
													<li><a href="<?php echo $linkfollow_heredoc; ?>/menu" class="header_submenu_submenu"><?=MENU_MENU_ALACARTE;?></a></li>
													<li><a href="<?php echo $linkfollow_heredoc; ?>/404/" class="header_submenu_submenu"><?=MENU_MENU_COMBO_SET;?></a></li>
													<li><a href="<?php echo $linkfollow_heredoc; ?>/pedido-grupos" class="header_submenu_submenu"><?=MENU_MENU_ORDER_FOR_GROUP;?></a></li>
												</ul>
												------->

											</li>
										</ul>
									</td>
									<td valign="top">
										<a class="header" href="<?php echo $linkfollow_heredoc; ?>/map" style="margin-right:0px; background-color:#000; "><?=MENU_DINE_IN;?></a>
									</td>
								</tr>
							</table>

							<script>
							function set_black_bar() { $("#blackbar_id").css("width", $("body").width() - $("#blackbar_id").offset().left);}
							$(function() { set_black_bar();setInterval('set_black_bar();', 1000);});
							</script>

						</td>
					</tr>
				</table>

			</td>
		</tr>
	</table>
</div>
<!-- top header : logotipo; tel; infos; right menu -->
