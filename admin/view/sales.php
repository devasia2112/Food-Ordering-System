<?php
require("../bootstrap.php");
defined('SYSPATH_ADMIN') or die('No direct script access.');
include('../../includes/config/config.php');
include('../../includes/Sql/sql.class.php');
include_once('jcart/jcart.php');
include('../..' . SYSPATH_LANG );
session_start();
?><!DOCTYPE html>
<html lang="en">
  <head>
  	<meta charset="utf-8">
    <title>POS</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	<!-- upload -->
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/jquery.form.js"></script>
	<script type="text/javascript" src="../../scripts/general-functions.js"></script>
	<script type="text/javascript" src="../js/form.js"></script>

<!-- jcart files -->
	<link rel="stylesheet" type="text/css" media="screen, projection" href="../../style.css" />
	<link rel="stylesheet" type="text/css" media="screen, projection" href="jcart/css/jcart.css" />
<!-- jcart files -->

<!-- autocomplete -->
<script type="text/javascript" src="../controller/autoComplete/jquery-1.2.1.pack.js"></script>
<script type="text/javascript">
	function lookup(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			$.post("../controller/autoComplete/rpc.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					$('#autoSuggestionsList').html(data);
				}
			});
		}
	} // lookup

	function fill(thisValue) {
		$('#inputString').val(thisValue);
		setTimeout("$('#suggestions').hide();", 200);
	}

    function showUser(str)
    {
        alert(str);
        if (str=="")
        {
          document.getElementById("txtHint").innerHTML="";
          return;
        }
        if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp=new XMLHttpRequest();
        }
        else
        {// code for IE6, IE5
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
          if (xmlhttp.readyState==4 && xmlhttp.status==200)
          {
            document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
          }
        }
        xmlhttp.open("GET","../controller/autoComplete/getcustomer.inc.php?q="+str,true);
        xmlhttp.send();
    }
</script>
<!-- autocomplete -->



	<!-- Le styles -->
    <link href="../bootstrap.css" rel="stylesheet">
    <style type="text/css">
		body {
			padding-top: 75px;
		}
		.preview{
			width:200px;
			border:solid 1px #dedede;
			padding:10px;
		}
		#preview{
			color:#cc0000;
			font-size:12px
		}
	    .suggestionsBox {
		    position: relative;
		    left: 30px;
		    margin: 10px 0px 0px 0px;
		    width: 500px;
		    background-color: #212427;
		    -moz-border-radius: 7px;
		    -webkit-border-radius: 7px;
		    border: 2px solid #000;
		    color: #fff;
	    }

	    .suggestionList {
		    margin: 0px;
		    padding: 0px;
	    }

	    .suggestionList li {
		    margin: 0px 20px 3px 20px;
		    padding: 3px;
		    cursor: pointer;
	    }

	    .suggestionList li:hover {
		    background-color: #efefef;
	    }
    </style>
    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../favicon2.ico">
  </head>


  <body>
	<div class="content">


    <div class="topbar">
      <div class="topbar-inner">
        <div class="container-fluid">
          <a class="brand" ><img src="<?=SYSPATH_SERVER_LOGO;?>" height="50"></a>
          <p class="pull-right">Logado como <a href="#"><?php echo $_SESSION["admin_display_name"]; ?></a></p>
        </div>
      </div>
    </div>


	<div class="row">
	 <div class="span13">


<!-- content -->


		<script type="text/javascript" src="jcart/js/jquery-1.4.4.min.js"></script>
		<script type="text/javascript" src="jcart/js/jcart.min.js"></script>



		<div id="sidebar-admin">
			<div id="jcart"><?php $jcart->display_cart();?></div>
		</div>


		<?php $arr_count_prod = GenericSql::getNumberOfProducts( ); ?>


<div style="width:900px; height:600px; background-color:#F2F2F2; overflow:auto;">
<!-- products from database -->
		<table cellpadding="3" cellspacing="3" style="border:solid 1px #f0f0e7; font-size:13px;">

			<?php
				$array_total_products = GenericSql::getNumberOfProductsByCategory( $category=0 );
				$total = $array_total_products[0]['total'];

				if ( $total >= 1 )
				{
					$array_products = GenericSql::getProductsByCategory( $category=0 );


					// start line before for
					echo '<tr style="background-color:'.$color.';" >';


					for ($i=0;$i<$total;$i++)
					{
						// creates the grid --- simple and easy solution
						if ($i == 4) echo "<tr>";
						if ($i == 12) echo "<tr>";
						if ($i == 20) echo "<tr>";
						if ($i == 28) echo "<tr>";
						if ($i == 36) echo "<tr>";

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
	                    	<form method="post" action="" class="jcart">

								<input type="hidden" name="jcartToken" value="<?php echo $_SESSION['jcartToken'];?>" />
								<input type="hidden" name="my-item-url" value="" />

								<td valign="top" style="padding-left:10px; padding-top:6px; padding-bottom:6px;">

									<?=$product_code;?> - <input type="hidden" name="my-item-name" value="<?=$product_name;?>" /> <?=$product_name;?>  - <?=$product_size_name;?>  <br />
									<img src="../uploads/<?=$product_image;?>" style="padding:2px; border:1px solid #CCC;" width="150" height="135" onmouseover="showPicture(event, '../uploads/<?=$product_image;?>');" onmouseout="document.getElementById('div_box').style.display='none'; document.getElementById('div_box2').style.display='none'; document.getElementById('div_box').innerHTML='';" />

									<input type="text" name="my-item-qty" value="1" class="span1" />
									<input type="submit" name="my-add-button" value="+" class="btn success" />

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
												<td>
													<input type="hidden" name="my-item-id" value="<?=$atributes_id;?>" />
													<input type="hidden" name="my-item-price" value="<?=$price;?>" />
												</td>
											</tr>

									 <? } ?>
									</table>

								</td>

							</form>

						<!-- customizado -->
						<?php
						// creates the grid
						if ($i == 7) echo "</tr>";
						if ($i == 15) echo "<tr>";
						if ($i == 23) echo "<tr>";
						if ($i == 31) echo "<tr>";
						if ($i == 39) echo "<tr>";

				 }


				echo '</tr>';


				}
				else
				{
                    echo "<br />";
					echo "<center>" . WARNING_NO_PRODUCTS_BY_CATEGORY . "</center>";
                    echo "<br />";
				}
				?>

        </table>
<!-- products from database -->
</div>


<!-- content -->

	</div>
	</div>
	</div>
    </div>

  </body>
</html>
