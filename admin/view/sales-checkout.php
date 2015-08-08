<?php require("../bootstrap-admin.php");
defined('SYSPATH_ADMIN') or die('No direct script access.');
include('../../includes/config/config.php');
include('../../includes/Sql/sql.class.php');
include('../..' . SYSPATH_LANG );
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>PDV CHECKOUT</title>
    <meta name="description" content="">
    <meta name="author" content="deepcell.org">
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
			padding-top: 60px;
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

	<!--Requirement jQuery-->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<!--Load Script and Stylesheet -->
	<script type="text/javascript" src="jQueryDatetimePicker/jquery.simple-dtpicker.js"></script>
	<link type="text/css" href="jQueryDatetimePicker/jquery.simple-dtpicker.css" rel="stylesheet" />
	<!---->

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

	<div class="hero-unit">
	  <h1>PDV - Checkout</h1>
	  <p>Finalizar compra via telefone, chat ou balc&atilde;o. Preencha todo o formul&aacute;rio para finalizar o pedido e gerar a fatura.</p>
	</div>
	<div class="row">
	<div class="span13">



<!-- content -->



        <fieldset><legend>Finalizar Venda</legend>
	    <div>

		    <form method="post" action="checkout-pos.php" name="salescheckout">

                <input type="hidden" name="admin_salescheckout" value="proccess" />

			    <div class="clearfix">
				    <label for="xlInput">Cliente: </label>
                    <div class="input">
				       <input type="text" name="customer_id" value="" id="inputString" placeholder="digite" onkeyup="lookup(this.value);" onblur="fill();" class="span3" /> 
                            <!-- onchange="showUser(this.value);" -->
                        <a href="customers-insert.php" class="btn" title="Add New Customer"> + </a> &nbsp;&nbsp;&nbsp;
			        </div>
			    </div>
			    <div class="suggestionsBox" id="suggestions" style="display: none;">
				    <img src="../controller/autoComplete/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
				    <div class="suggestionList" id="autoSuggestionsList">
					    &nbsp;
				    </div>
			    </div>

			    <div class="clearfix"> <hr /> </div>

	<!-- new -->
			    <div class="clearfix">
				    <label for="xlInput">Data Agendamento: </label>
                    <div class="input">
				       <input type="text" name="data_agendamento" value="" id="inputString" placeholder="" class="span3" />
						<script type="text/javascript">
							$(function(){
								$('*[name=data_agendamento]').appendDtpicker();
							});
						</script>
			        </div>
			    </div>
	<!-- new -->

	<!-- new -->
				<div class="clearfix">
		        <label id="optionsRadio">Entrega/Retirada:</label>
		        <div class="input">
		          <ul class="inputs-list">
		            <li>
		              <label>
		                <input checked="" name="options" value="delivery" type="radio">
		                <span>Entrega via transporte da empresa ou de terceiro (Delivery).</span>
		              </label>
		            </li>
		            <li>
		              <label>
		                <input name="options" value="takeaway" type="radio">
		                <span>Cliente retira no local (Take Away).</span>
		              </label>
		            </li>
		          </ul>
		        </div>
		      	</div>
	<!-- new -->

	<!-- new -->
				<div class="clearfix">
		        <label for="prependedInput2">Cupom</label>
		        <div class="input">
		          <div class="input-prepend">
		            <label class="add-on"><input name="cupom" id="cupom_yes" value="yes" type="checkbox"></label>
		            <input class="mini" id="cupom_numero" name="cupom_numero" size="16" placeholder="n. cupom" type="text">
		            <input class="mini" id="cupom_desconto" name="cupom_desconto" size="16" placeholder="valor desconto" type="text">
		          </div>
		        </div>
		      	</div>
	<!-- new -->

			    <div class="clearfix"> <hr /> </div>

			    <div class="clearfix">
			        <div class="clearfix">
				        <label for="xlInput">Forma de Pagamento:  </label>
                        <div class="input">
                        <select name="payment_type">
                            <option value="0"> Select </option>
                            <option value="tef" disabled> TEF </option>
                            <option value="moip" disabled> MoIP </option>
                            <option value="paypal"> PayPal</option>
                            <option value="credit_card"> Cart&atilde;o de Cr&eacute;dito </option>
                            <option value="cash"> Dinheiro </option>
                        </select> &nbsp;&nbsp;&nbsp;
                        </div>
                </div>

			    <div class="clearfix">
                    <label for="xlInput">Observa&ccedil;&atilde;o: </label>
                    <div class="input">
                        <textarea class="span10" name="observation_order"></textarea>
                    </div>
                </div>

			    <div class="clearfix">
                    <label for="xlInput">  </label>
                    <div class="input">
                        <input type="submit" value="Finalizar Pedido" class="btn success"> &nbsp;&nbsp;&nbsp;
                    </div>
                </div>

		    </form>
	    </div>
        </fieldset>



<!-- content -->


	</div>
	</div>
        <?php include("../footer.php"); ?>
	</div>
    </div>
    
  </body>
</html>
