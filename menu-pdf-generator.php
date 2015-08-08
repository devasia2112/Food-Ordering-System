<?php
require("admin/bootstrap.php");
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
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?=TITLE_INDEX;?></title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<script type="text/javascript" src="jcart/js/jquery-1.4.4.min.js"></script>
	<script type="text/javascript" src="scripts/jquery.curvycorners.min.js"></script>
	<link href="stylesheet/stylesheet.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="scripts/jquery-ui-1.8.4.custom.min.js"></script>
	<link href="scripts/jqueryui/css/redmond/jquery-ui-1.8.4.custom.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="scripts/thickbox.js"></script>
	<link href="scripts/thickbox.css" rel="stylesheet" type="text/css" />
	<link rel="SHORTCUT ICON" href="favicon2.ico" />

<!-- script for open dialog box with product description -->
	<link rel="stylesheet" type="text/css" href="scripts/jQueryEasyUI/themes/gray/easyui.css">  
	<link rel="stylesheet" type="text/css" href="scripts/jQueryEasyUI/themes/icon.css">  
	<script type="text/javascript" src="scripts/jQueryEasyUI/jquery.easyui.min.js"></script> 
<!-- script for open dialog box with product description -->

</head>



<body>

<table width="999" border="0" cellpadding="0" cellspacing="0" align="center" id="table990" class="table bg">
<tr><td colspan=5> &nbsp; </td></tr>
<tr><td colspan=5> &nbsp; </td></tr>
<tr>
    <td colspan=5> <img src="images/logo/logo-kinthai.png" /> </td>
</tr>
<tr><td colspan=5> &nbsp; </td></tr>
<tr><td colspan=5> &nbsp; </td></tr>
<tr>
    <td> &nbsp; </td>
	<td valign="top">

        <?php $_SESSION['category_id'] = Url::urlDec( $_SESSION['category_id'] );  // Decode Category ID (URL) ?>

		
		<!-- food container - products listed here -->
		<table width="100%" cellpadding="3" cellspacing="0" style="border:solid 1px #f0f0e7; font-size:13px;">
			
			
			<tr style="background-color:#f0f0e7; visibility:show;">
				<td><b><?=TABLE_TR_PHOTO;?></b></td>
				<td><b><?=TABLE_TR_CODE;?></b></td>
				<td><b><?=TABLE_TR_NAME;?></b></td>
				<td><b><?=TABLE_TR_SIZE;?></b></td>
				<td><b><?=TABLE_TR_PRICE;?></b></td>
			</tr>
			  
			<?php
				$array_total_products = GenericSql::getNumberOfProductsByCategory( $_SESSION['category_id'] );
				$total = $array_total_products[0]['total'];
				
				if ( $total >= 1 )
				{
					$array_products = GenericSql::getAllProductsMenu( );   //getProductsByCategory( $_SESSION['category_id'] );
					
					//print "<pre>";print_r( $array_products );print "</pre>";
					foreach( $array_products as $prod ) {
						
						$product_id          = $prod['id'];
						$product_code        = $prod['product_code'];
						$product_image       = $prod['image'];
						$product_name        = $prod['name'];
						$product_description = $prod['description'];
						
						if ($alternate == "1") {
							$color       = "#ffffff";  //#F5F3F3
							$alternate   = "2";
						} else {
							$color       = "#ffffff";  //#FFFCFD
							$alternate   = "1";
						}
						
						if ( $prod['categ_id'] ) { ?>
						
						      <?php if ( $product_code == 100 )   { ?>
						    
							<tr style="background-color:<?=$color;?>;" >
							  <td colspan=5>
							    <div class="round_bar" style="background-color:#<?=$_SESSION['category_color'];?>; font-size:18px; font-weight:bold; color:#<?=$_SESSION['category_font_color'];?>;"> 
								<?=$prod['categ_name'];?>
							    </div>
							  </td>
							</tr>
						    
						      <?php } ?>
						      
						      
						      <?php if ( $product_code == 200 )  { ?>
						    
							<tr style="background-color:<?=$color;?>;" ><td colspan=5>&nbsp;</td></tr>
							<tr style="background-color:<?=$color;?>;" >
							  <td colspan=5>
							    <div class="round_bar" style="background-color:#<?=$_SESSION['category_color'];?>; font-size:18px; font-weight:bold; color:#<?=$_SESSION['category_font_color'];?>;"> 
								<?=$prod['categ_name'];?>
							    </div>
							  </td>
							</tr>
						    
						      <?php } ?>
						      
						      
						      <?php if ( $product_code == 300 )   { ?>
						    
							<tr style="background-color:<?=$color;?>;" ><td colspan=5>&nbsp;</td></tr>
							<tr style="background-color:<?=$color;?>;" >
							  <td colspan=5>
							    <div class="round_bar" style="background-color:#<?=$_SESSION['category_color'];?>; font-size:18px; font-weight:bold; color:#<?=$_SESSION['category_font_color'];?>;"> 
								<?=$prod['categ_name'];?> 
							    </div>
							  </td>
							</tr>
						    
						      <?php } ?>
						      
						      
						      <?php if (  $product_code == 401 )   { ?>
						    
							<tr style="background-color:<?=$color;?>;" ><td colspan=5>&nbsp;</td></tr>
							<tr style="background-color:<?=$color;?>;" >
							  <td colspan=5>
							    <div class="round_bar" style="background-color:#<?=$_SESSION['category_color'];?>; font-size:18px; font-weight:bold; color:#<?=$_SESSION['category_font_color'];?>;"> 
								<?=$prod['categ_name'];?> 
							    </div>
							  </td>
							</tr>
						    
						      <?php } ?>
						      
						      
						      <?php if (  $product_code == 500 )   { ?>
						    
							<tr style="background-color:<?=$color;?>;" ><td colspan=5>&nbsp;</td></tr>
							<tr style="background-color:<?=$color;?>;" >
							  <td colspan=5>
							    <div class="round_bar" style="background-color:#<?=$_SESSION['category_color'];?>; font-size:18px; font-weight:bold; color:#<?=$_SESSION['category_font_color'];?>;"> 
								<?=$prod['categ_name'];?> 
							    </div>
							  </td>
							</tr>
						    
						      <?php } ?>
						      
						      
						      <?php if (  $product_code == 600 )   { ?>
						    	
							<tr style="background-color:<?=$color;?>;" ><td colspan=5>&nbsp;</td></tr>
							<tr style="background-color:<?=$color;?>;" >
							  <td colspan=5>
							    <div class="round_bar" style="background-color:#<?=$_SESSION['category_color'];?>; font-size:18px; font-weight:bold; color:#<?=$_SESSION['category_font_color'];?>;"> 
								<?=$prod['categ_name'];?> 
							    </div>
							  </td>
							</tr>
						    
						      <?php } ?>
						      
						      
						      <?php if (  $product_code == 700 )   { ?>
						    
							<tr style="background-color:<?=$color;?>;" ><td colspan=5>&nbsp;</td></tr>
							<tr style="background-color:<?=$color;?>;" >
							  <td colspan=5>
							    <div class="round_bar" style="background-color:#<?=$_SESSION['category_color'];?>; font-size:18px; font-weight:bold; color:#<?=$_SESSION['category_font_color'];?>;"> 
								<?=$prod['categ_name'];?> 
							    </div>
							  </td>
							</tr>
						    
						      <?php } ?>
						      
						      
						      <?php if (  $product_code == 801 )   { ?>
						    
							<tr style="background-color:<?=$color;?>;" ><td colspan=5>&nbsp;</td></tr>
							<tr style="background-color:<?=$color;?>;" >
							  <td colspan=5>
							    <div class="round_bar" style="background-color:#<?=$_SESSION['category_color'];?>; font-size:18px; font-weight:bold; color:#<?=$_SESSION['category_font_color'];?>;"> 
								<?=$prod['categ_name'];?> 
							    </div>
							  </td>
							</tr>
						    
						      <?php } ?>
						      
						      
						      <?php if (  $product_code == 900 )   { ?>
						    
							<tr style="background-color:<?=$color;?>;" ><td colspan=5>&nbsp;</td></tr>
							<tr style="background-color:<?=$color;?>;" >
							  <td colspan=5>
							    <div class="round_bar" style="background-color:#<?=$_SESSION['category_color'];?>; font-size:18px; font-weight:bold; color:#<?=$_SESSION['category_font_color'];?>;"> 
								<?=$prod['categ_name'];?> 
							    </div>
							  </td>
							</tr>
						    
						      <?php } ?>
						      
						      
						      <?php if (  $product_code == 1000 )   { ?>
						    
							<tr style="background-color:<?=$color;?>;" ><td colspan=5>&nbsp;</td></tr>
							<tr style="background-color:<?=$color;?>;" >
							  <td colspan=5>
							    <div class="round_bar" style="background-color:#<?=$_SESSION['category_color'];?>; font-size:18px; font-weight:bold; color:#<?=$_SESSION['category_font_color'];?>;"> 
								<?=$prod['categ_name'];?> 
							    </div>
							  </td>
							</tr>
						    
						      <?php } ?>
						      
						      
						      <?php if (  $product_code == 1101 )   { ?>
						    
							<tr style="background-color:<?=$color;?>;" ><td colspan=5>&nbsp;</td></tr>
							<tr style="background-color:<?=$color;?>;" >
							  <td colspan=5>
							    <div class="round_bar" style="background-color:#<?=$_SESSION['category_color'];?>; font-size:18px; font-weight:bold; color:#<?=$_SESSION['category_font_color'];?>;"> 
								<?=$prod['categ_name'];?> 
							    </div>
							  </td>
							</tr>
						    
						      <?php } ?>
						      
						      
						      <?php if (  $product_code == 1201 )   { ?>
						    
							<tr style="background-color:<?=$color;?>;" ><td colspan=5>&nbsp;</td></tr>
							<tr style="background-color:<?=$color;?>;" >
							  <td colspan=5>
							    <div class="round_bar" style="background-color:#<?=$_SESSION['category_color'];?>; font-size:18px; font-weight:bold; color:#<?=$_SESSION['category_font_color'];?>;"> 
								<?=$prod['categ_name'];?> 
							    </div>
							  </td>
							</tr>
						    
						      <?php } ?>


						      <?php if (  $product_code == 1501 )   { ?>
						    
							<tr style="background-color:<?=$color;?>;" ><td colspan=5>&nbsp;</td></tr>
							<tr style="background-color:<?=$color;?>;" >
							  <td colspan=5>
							    <div class="round_bar" style="background-color:#<?=$_SESSION['category_color'];?>; font-size:18px; font-weight:bold; color:#<?=$_SESSION['category_font_color'];?>;"> 
								<?=$prod['categ_name'];?> 
							    </div>
							  </td>
							</tr>
						    
						      <?php } ?>


						
						<?php } ?>
						
						<!-- custom products -->
						<tr style="background-color:<?=$color;?>;" >
								
								<td valign="top" style="padding-left:10px;">
									<img src="admin/uploads/<?=$product_image;?>" style="padding:2px; border:1px solid #CCC;" width="250" onmouseover="showPicture(event, 'admin/uploads/<?=$product_image;?>');" onmouseout="document.getElementById('div_box').style.display='none'; document.getElementById('div_box2').style.display='none'; document.getElementById('div_box').innerHTML='';" />
								</td>
								<td valign="top" style="line-height:16px; padding-top:6px;">
								  <?=$product_code;?>
								  <!-- item-id was here -->
								</td>
								<td valign="top" style="line-height:16px; padding-top:6px;" width="500">
									<a href="javascript:void(0)" class="easyui-link" onclick="$('#<?=$product_code;?>').dialog('open')">
										<?=$product_name;?> 
									</a> <br />
										<?=$product_description;?>
									<div id="<?=$product_code;?>" class="easyui-dialog" title="<?=$product_code;?> - <?=$product_name;?>" closed="true" style="width:400px;height:250px; padding:10px" data-options="resizable:true,modal:true">
										<?=$product_description;?>
									</div>
									
									<table border='0' cellspacing='0' cellpadding='0' width='100%' onmouseover='this.style.cursor="default"'>
									  <tr>
									    <?php
									    $array_total_atributes = GenericSql::getNumberOfProductsAtributes( $product_id );
									    $total_atributes = $array_total_atributes[0]['total'];
									    for ($m=0;$m<$total_atributes;$m++) {
										$groupby=1;
										$array_products_atributes = GenericSql::getProductsByAtributes( $product_id, $groupby );
										$atributes 		= $array_products_atributes[$m]['atributes'];
										$recommended 	= $array_products_atributes[$m]['recommended'];
										$wine_id 	    = $array_products_atributes[$m]['wine_id']; ?>
									  
										<td align="left">
										    <?php for($h=0;$h<$atributes;$h++) {
											    echo $chilly = '<img src="images/chili.png" >';
										    } ?> &nbsp;&nbsp;&nbsp; 
										    <?php if ( $recommended == 1 ) {
											    echo $chef = '<img src="images/chef_hat.jpg" align="absmiddle" title="'.LBL_CHEF_RECOMMENDATION.'" />';
										    }
											// here we pair the wine based in the type of dish
											if( $wine_id != 0 ) {
												
												// query wine list
												$array_wine_list = GenericSql::getWineListByID( $wine_id );

												// choose the right logo here --- white wine or red wine
												if( $array_wine_list[0][wine_color] == 2 ) {
													echo $wine = '<img src="images/white-wine.png" align="absmiddle" title="' . $array_wine_list[0][type] . '" alt="' . $array_wine_list[0][type] . '" height="18" >';
												} 
												if( $array_wine_list[0][wine_color] == 1 ) {
													echo $wine = '<img src="images/red-wine.png" align="absmiddle" title="' . $array_wine_list[0][type] . '" alt="' . $array_wine_list[0][type] . '" height="18" >';
												}

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
												case 4:
													$product_size_name = "300ml";    // custom size enter by hand --- ALL product_size with value 4 will from now on assume 300ml as value!
													break;
											}
											
										?>
											

											<tr>
												<td align="left">
													<span onclick="check_option('<?=$product_id;?>', '<?=$j+1;?>')"> <?=$product_size_name;?> </span>
												</td>
											</tr>
											
											
									      <? } ?>
										
										
									</table>
								</td>
								<td align="left" onclick="check_option('<?=$product_id;?>', '<?=$j+1;?>')"> <?=LBL_CURRENCY;?> <?=$price;?></td>

						</tr>
						<!-- customizado -->
						
				 <? 
				 }
				}
				else
				{
				    echo "<br />";
				    echo "<center><img src='images/Mascote.png' /></center>";
				    echo "<center>" . WARNING_NO_PRODUCTS_BY_CATEGORY . "</center>";
				    echo "<br />";
				}
				
			?>
			
			
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
	<td width="0">&nbsp;</td>
	<td valign="top" width="0" style="padding-right:0px;">
		
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
		</script>
		
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
