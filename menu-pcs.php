<?php
include_once('jcart/jcart.php');
require("admin/bootstrap.php");
include( dirname(__FILE__) . SYSPATH_LANG );
defined('SYSPATH_ADMIN') or die('No direct script access.');

##################FROM _header-inc.php######################
if (!isset($_SESSION)) @session_start();
if ( empty( $_SESSION['PCS']['order_id'] )) die("sua sess&atilde;o expirou!");
//if (empty($_SESSION['path'])) { $web_root = WEBROOT; } else { $web_root = $_SESSION['path']; }
if (!empty($_SESSION['path'])) $web_root = $_SESSION['path']; else $web_root = WEBROOT;
include_once $_SERVER['DOCUMENT_ROOT'] . $web_root . "/login/globals.php";
#----URL ENCODE DECODE---------------
include ROOTDIR . DIRROOT . "/includes/_url.php";
#----URL ENCODE DECODE---------------
include ROOTDIR . DIRROOT . "/includes/config/config.php";
include ROOTDIR . DIRROOT . "/includes/config/config-aux.php";
require ROOTDIR . DIRROOT . "/includes/Sql/sql.class.php";
include ROOTDIR . DIRROOT . "/includes/lang/pt-br.php";
include ROOTDIR . DIRROOT . "/includes/data.php";
include CLASSES . "/User.php";

$array_categories   = GenericSql::getCategories( );
$total_categ        = GenericSql::getTotalNumberOfCategories( );
$array_empresa      = GenericSql::getEmpresa( );

// Charge Delivery is in session and has public access
$_SESSION['valor_entrega'] = $array_empresa['valor_entrega'];
$_SESSION['company_id'] = $array_empresa['id'];
##################FROM _header-inc.php######################

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?=TITLE_INDEX;?></title>
	<meta name="description" content="">
	<meta name="keywords" content="">

	<script type="text/javascript" src="jcart/js/jquery-1.4.4.min.js"></script>
<!-- <script type="text/javascript" src="scripts/jQueryEasyUI/jquery-1.8.0.min.js"></script>  Strang not work ;(  -->

	<script type="text/javascript" src="scripts/jquery.curvycorners.min.js"></script>
	<link href="stylesheet/stylesheet.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="scripts/jquery-ui-1.8.4.custom.min.js"></script>
	<link href="scripts/jqueryui/css/redmond/jquery-ui-1.8.4.custom.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="scripts/thickbox.js"></script>
	<link href="scripts/thickbox.css" rel="stylesheet" type="text/css" />
	<link rel="SHORTCUT ICON" href="favicon2.ico" />
	<script>
	$(function() {
		flag = 0;
		$("a.header").each(function() {
			loc = window.location.href;
			url = $(this).attr("href");
			if (loc.indexOf(url) > -1) {
				if (loc[loc.length-1]=="menu.php") {
					if (url=="menu.php")
						$(this).css("color", "yellow");
				}
				else if (url!="menu.php") {
					$(this).css("color", "yellow");
				}
			}
		});
	});
	</script>


<!-- script for open dialog box with product description -->
	<link rel="stylesheet" type="text/css" href="scripts/jQueryEasyUI/themes/gray/easyui.css">  
	<link rel="stylesheet" type="text/css" href="scripts/jQueryEasyUI/themes/icon.css">  
	<script type="text/javascript" src="scripts/jQueryEasyUI/jquery.easyui.min.js"></script> 
<!-- script for open dialog box with product description -->
    

<!-- script for cart -->
	<script type="text/javascript">
	function resizePreview(){
	  var preview = $("#preview");
	  //preview.height($(window).height() - preview.offset().top - 2);
	}

	$(function(){
	  var preview = $("#preview");
	  resizePreview();
		
	  $(window).scroll(function() {
		var scrollTop = Math.min($(this).scrollTop(), preview.height()+preview.parent().offset().top) - 2;
		preview.css("margin-top", scrollTop + "px");
	  });
		
	  $(window).resize(resizePreview);
	});
	</script>
    <link rel="stylesheet" type="text/css" media="screen, projection" href="jcart/css/jcart.css" />
<!-- end script for cart -->
</head>


<!-- top menu category -->
<?php require("_top-menu-category.php"); ?>
<!-- top menu category -->


<body>

<table width="999" border="0" cellpadding="0" cellspacing="0" align="center" id="table990" class="table bg">
<tr>
    <td> &nbsp; </td>
	<td valign="top">

        <?php $_SESSION['category_id'] = Url::urlDec( $_SESSION['category_id'] );  // Decode Category ID (URL) ?>

        <?php if ( isset( $_SESSION['category_id'] ) and  empty( $_SESSION['category_id'] )) { ?>

            <?php if ( !isset( $_SESSION['category_color'] ) and  empty( $_SESSION['category_color'] )) $_SESSION['category_color'] = "D9D4C6"; ?>

		    <div class="round_bar" style="background-color:#<?=$_SESSION['category_color'];?>; font-size:18px; font-weight:bold;"> 
                <?=$_SESSION['category_name'];?> 
                <a href="javascript:void(0);" onclick="window.location.href='menu-print.php';" style="float:right; font-size:14px; color:#666;"> <?=LBL_DOWNLOAD_MENU;?> </a> <br />
            </div>

        <?php } else { ?>

		    <div class="round_bar" style="background-color:#<?=$_SESSION['category_color'];?>; font-size:18px; font-weight:bold; color:#<?=$_SESSION['category_font_color'];?>;"> 
                <?=$_SESSION['category_name'];?> 
                <a href="javascript:void(0);" onclick="window.location.href='menu-print.php';" style="float:right; font-size:14px; color:#<?=$_SESSION['category_font_color'];?>;"> <?=LBL_DOWNLOAD_MENU;?> </a>
            </div>

        <?php } ?>
		
		<!-- food container - products listed here -->
		<table width="100%" cellpadding="3" cellspacing="0" style="border:solid 1px #f0f0e7; font-size:13px;">
			
			
			<?php
			if ( isset( $_SESSION['category_id'] ) and  empty( $_SESSION['category_id'] ))
			{
				echo "<center><img src='images/Mascote.png' /></center>";
				echo WARNING_CHOOSE_MENU;
			}
			else
			{ ?>

			<tr style="background-color:#f0f0e7; visibility:show;">
				<td width="100">&nbsp;</td>
				<td width="30"><b><?=TABLE_TR_CODE;?></b></td>
				<td width="150"><b><?=TABLE_TR_NAME;?></b></td>
				<td width="125"><b><?=TABLE_TR_SIZE;?></b></td>
				<td width="80"><b><?=TABLE_TR_QUANTITY;?></b></td>
			</tr>

			<?php	
				$array_total_products = GenericSql::getNumberOfProductsByCategory( $_SESSION['category_id'] );
				$total = $array_total_products[0]['total'];
				
				if ( $total >= 1 )
				{
					$array_products = GenericSql::getProductsByCategory( $_SESSION['category_id'] );
					for ($i=0;$i<$total;$i++)
					{
						$product_id    = $array_products[$i]['id'];
						$product_code  = $array_products[$i]['product_code'];
						$product_image = $array_products[$i]['image'];
						$product_name  = $array_products[$i]['name'];
						$product_description = $array_products[$i]['description'];
						
						
						if ($alternate == "1") 
						{
							$color 	   = "#ffffff";		// #F5F3F3
							$alternate = "2";
						} 
						else 
						{
							$color 	   = "#F5F3F3";
							$alternate = "1";
						}						
						
					 ?>
						
						<!-- custom products -->
						<tr style="background-color:<?=$color;?>;" >
							<form method="post" action="" class="jcart">
								<input type="hidden" name="jcartToken" value="<?php echo $_SESSION['jcartToken'];?>" />
								<input type="hidden" name="my-item-url" value="" />
								
								<td valign="top" style="padding-left:10px;">
									<img src="admin/uploads/<?=$product_image;?>" style="padding:2px; border:1px solid #CCC;" width="100" onmouseover="showPicture(event, 'admin/uploads/<?=$product_image;?>');" onmouseout="document.getElementById('div_box').style.display='none'; document.getElementById('div_box2').style.display='none'; document.getElementById('div_box').innerHTML='';" />
								</td>
								<td valign="top" style="line-height:16px; padding-top:6px;">
								
								<?=$product_code;?>
								<!-- item-id was here -->
								
								</td>
								<td valign="top" style="line-height:16px; padding-top:6px;">
									<input type="hidden" name="my-item-name" value="<?=$product_name;?>" /> 
									<a href="javascript:void(0)" class="easyui-link" onclick="$('#<?=$product_code;?>').dialog('open')">
										<?=$product_name;?> 
									</a> <br />
									<div id="<?=$product_code;?>" class="easyui-dialog" title="<?=$product_code;?> - <?=$product_name;?>" closed="true" style="width:400px;height:250px; padding:10px" data-options="resizable:true,modal:true">
										<?=$product_description;?>
									</div>
									
									<table border='0' cellspacing='0' cellpadding='0' width='100%' onmouseover='this.style.cursor="default"'>
										<tr>
										<?php
										$array_total_atributes = GenericSql::getNumberOfProductsAtributes( $product_id );
										$total_atributes = $array_total_atributes[0]['total'];
										for ($m=0;$m<$total_atributes;$m++)
										{
											$groupby=1;
											$array_products_atributes = GenericSql::getProductsByAtributes( $product_id, $groupby );
											$atributes 		= $array_products_atributes[$m]['atributes'];
											$recommended 	= $array_products_atributes[$m]['recommended'];
											
										 ?>
										 
											<td align="left">
												<?
												for($h=0;$h<$atributes;$h++)
												{
													echo $chilly = '<img src="images/chili.png" >';
												}
												?>
											</td>
											<td align="right"> 
												<?
												if ( $recommended == 1 ) 
												{
													echo $chef = '<img src="images/chef_hat.jpg" align="absmiddle" title="'.LBL_CHEF_RECOMMENDATION.'" />';
												}
												?>
											</td>
											
									 <? } ?>
									 
										</tr>
										
									</table>
									
									
									<div style="height:5px; overflow:hidden;"></div>
								</td>
								<td valign="top" align="right" style="padding-top:6px;">
									<table border='0' cellspacing='0' cellpadding='0' width='100%' onmouseover='this.style.cursor="default"'>
										
										<?php
										$array_total_atributes = GenericSql::getNumberOfProductsAtributes( $product_id );
										$total_atributes = $array_total_atributes[0]['total'];
										for ($j=0;$j<$total_atributes;$j++)
										{
											$groupby = 0;
											$array_products_atributes = GenericSql::getProductsByAtributes( $product_id, $groupby );
											$atributes_id	= $array_products_atributes[$j]['id'];
											$atributes 		= $array_products_atributes[$j]['atributes'];
											$recommended 	= $array_products_atributes[$j]['recommended'];
											$product_size 	= $array_products_atributes[$j]['product_size'];
											$price 			= $array_products_atributes[$j]['price'];
											
											# Naming sizes here
											switch ($product_size)
											{
												case 1:
													$product_size_name = LBL_PRODUCT_SIZE_SMALL;
													break;
												case 2:
													$product_size_name = LBL_PRODUCT_SIZE_MEDIUM;
													break;
												case 3:
													$product_size_name = LBL_PRODUCT_SIZE_BIG;
													break;
											}
											
										 ?>
											

											<tr>
												<td align="left">
													<input type="hidden" name="my-item-id" value="<?=$atributes_id;?>" /> 
													<input type="radio" value="<?=$price;?>" name="my-item-price" id="item_details_<?=$product_id;?>_<?=$j+1;?>" class="details_98" />
													<span onclick="check_option('<?=$product_id;?>', '<?=$j+1;?>')"> <?=$product_size_name;?> </span>
												</td>
												<td align="right" onclick="check_option('<?=$product_id;?>', '<?=$j+1;?>')"> <?=LBL_CURRENCY;?> <?=$price;?></td>
											</tr>
											
											
									 <? } ?>
										
										
									</table>
								</td>
								<td valign="top" style="padding-top:6px;">
									<input type="text" name="my-item-qty" value="1" size="3" />
									<!-- <input type="submit" name="my-add-button" value="Add" class="button" />  -->
									<sub><input type="image" name="my-add-button" src="images/icons/button-plus.gif" value="Add" /></sub>
								</td>
							</form>
						</tr>
						<!-- customizado -->
						
				 <? } 
					
					
				}
				else
				{
				    echo "<br />";
				    echo "<center><img src='images/Mascote.png' /></center>";
				    echo "<center>" . WARNING_NO_PRODUCTS_BY_CATEGORY . "</center>";
				    echo "<br />";
				}
				
			} ?>
			
			
		</table>
		<!-- food container - products listed here -->
		
		
		<script>
		function check_option(item_id, option_id) 
		{
			$(".details_"+item_id).attr("checked", false);
			$("#item_details_"+item_id+"_"+option_id).attr("checked", true);
			$("#item_option_"+item_id).val(option_id);
		}
		</script>
		
		
		<!-- subtitles -->
		<div style="height:15px; overflow:hidden;"></div>
		<img src="images/chili.png" align="absmiddle" title="<?=LBL_SPICY1;?>" /> = 
		<span style="color:#ff0000; font-weight:bold;"><?=LBL_SPICY1;?></span> &nbsp; &nbsp; &nbsp; &nbsp; 

		<img src="images/chili.png" align="absmiddle" title="<?=LBL_SPICY2;?>" />
		<img src="images/chili.png" align="absmiddle" title="<?=LBL_SPICY2;?>" /> = 
		<span style="color:#ff0000; font-weight:bold;"><?=LBL_SPICY2;?></span> &nbsp; &nbsp; &nbsp; &nbsp; 

		<img src="images/chili.png" align="absmiddle" title="<?=LBL_SPICY3;?>" />
		<img src="images/chili.png" align="absmiddle" title="<?=LBL_SPICY3;?>" />
		<img src="images/chili.png" align="absmiddle" title="<?=LBL_SPICY3;?>" /> = 
		<span style="color:#ff0000; font-weight:bold;"><?=LBL_SPICY3;?></span>

		<div style="height:8px; overflow:hidden;"></div>

		<img src="images/chef_hat.jpg" align="absmiddle" title="<?=LBL_CHEF_RECOMMENDATION;?>" /> = 
		<span style="color:#993399; font-weight:bold;"><?=LBL_CHEF_RECOMMENDATION;?></span>
		<!-- subtitles -->

		
	</td>
	<td width="20">&nbsp;</td>
	<td valign="top" width="300" style="padding-right:4px;">
		
		
		<!-- cart -->
		<div id="preview" name="preview">
			
			<div id="jcart"><?php $jcart->display_cart(); ?></div>

			<!-- validate ZIPCODE -->
			<div id="cart"></div>
			<script>
			function cart_update() {
				$.post("cart-zipcode.php", {}, function(data) {
					$("#cart").html(data);
				});
			}
			function cart_delete(id, item_pos) {
				if (typeof(item_pos) == 'undefined') item_post = 0;
				$.post("cart-zipcode.php", {'delete_id': id, 'item_pos': item_pos}, function(data) {
					$("#cart").html(data);
				});
			}
			function cart_add(id, qty, option_id) {
				if (typeof(option_id) == 'undefined') option_id = 0;
				$.post("cart-zipcode.php", {'item_id': id, 'qty': qty, 'option_id': option_id}, function(data) {
					$("#cart").html(data);
				});
			}
			$(function() {
				cart_update();
			});
			</script>
			<!-- validate ZIPCODE -->

		</div>
		<!-- end cart -->
		
		
		<script>
		/* radius for TITLE_SUBMENU */
		$(function() {
			settings = {
				tl: { radius: 10 },
				tr: { radius: 10 },
				bl: { radius: 10 },
				br: { radius: 10 },
				antiAlias: true,
				autoPad: true
			}
			$(".round_bar")
			.css("padding-top", "10px")
			.css("padding-bottom", "10px")
			.css("padding-left", "15px")
			.css("padding-right", "10px")
			.corner(settings);
		});
		/* radius for TITLE_SUBMENU */
		
		/* border image overlay */
		function showPictureBorder(mx, my) {
			if (document.getElementById('div_box').innerHTML!='') {
				if (document.getElementById('div_box').offsetWidth<50)
					setTimeout('showPictureBorder('+mx+', '+my+');', 20);
				else {
					document.getElementById('div_box2').style.cssText='z-index:1; padding:5px; position:absolute; left:'+(mx+25)+'px; top:'+(my-25)+'px; display:block; background-color:#333333; filter: alpha(opacity=50); -moz-opacity: .5; align:center; valign:center; width: '+document.getElementById('div_box').offsetWidth+'px; height: '+document.getElementById('div_box').offsetHeight+'px;';
				}
			}
			else {
				document.getElementById('div_box2').style.cssText='display:none;';
			}
		}
		/* border image overlay */
		
		/* show image on mouse over event */
		function showPicture(evt, filename) {
			var div_box=document.getElementById('div_box');
			div_box.innerHTML='<div style="padding:3px; background-color:#FFFFFF;"><img src="'+filename+'" /></div>';
			var mx = mouseX(evt);
			var my = mouseY(evt);
			document.getElementById('div_box').style.cssText='position:absolute; left:'+(mx+30)+'px; top:'+(my-20)+'px; display:block; align:center; valign:center; z-index:2;';
			if (document.getElementById('div_box').offsetWidth>50) {
				showPictureBorder(mx, my);
			}
			else {
				setTimeout('showPictureBorder('+mx+', '+my+');', 20);
			}
		}
		function mouseX(evt) {
			if (evt.pageX) return evt.pageX;
			else if (evt.clientX)
				return evt.clientX + (document.documentElement.scrollLeft ?
				document.documentElement.scrollLeft :
				document.body.scrollLeft);
			else return null;
		}
		function mouseY(evt) {
			if (evt.pageY) return evt.pageY;
			else if (evt.clientY)
				return evt.clientY + (document.documentElement.scrollTop ?
				document.documentElement.scrollTop :
				document.body.scrollTop);
			else return null;
		}
		function objPos(obj){
			objlft=obj.offsetLeft;
			objtop=obj.offsetTop;
			while(obj.offsetParent!=null){
				obj2=obj.offsetParent;
				objlft+=obj2.offsetLeft;
				objtop+=obj2.offsetTop;
				obj=obj2;
			}
			return [objlft,objtop];
		}
		/* show image on mouse over event */
		</script>
		
		
		<!-- cart -->
		<script type="text/javascript" src="jcart/js/jcart.min.js"></script>
		<!-- cart -->
		
		<!-- after bellow the cart -->
		<span id="div_box" style="display:none;"></span>
		<span id="div_box2" style="display:none;"></span>
		<!-- after bellow the cart -->
		
	</td>
    </tr>

    <tr><td colspan=6>&nbsp;</td></tr>
    <tr><td colspan=6>&nbsp;</td></tr>
  </table>

  
	</td>
  </tr>
</table>


</body>
</html>