<?php require("../bootstrap-admin.php");defined('SYSPATH_ADMIN') or die('No direct script access.');
/*
* Check login first
*/
if (isset($_SESSION) and empty($_SESSION['admin_access'])) {

    if (!headers_sent()) {

	header( "refresh:0;url=login-form/" );
	die('Admin Access Required!');

    } else {

	echo '<noscript>';
	echo '<meta http-equiv="refresh" content="0;url=login-form/" />';
	echo '</noscript>';
	echo '<script type="text/javascript">';
	echo 'window.location.href="login-form/";';
	echo '</script>';
	die('Admin Access Required!');
    }
}
require('../../includes/config/config.php');
require('../../includes/Sql/sql.class.php');

###########################################################################################################################



/*
 * Validation data entry
 *
 */
if ( isset( $_GET ) ) {


  if ( $_GET['action'] == "d" ) {

		$data_file = "invoice_receivable_daily.tsv";
		$data_file2 = "invoice_payable_daily.tsv";

		// contas a pagar
		echo "<h2>SA&Iacute;DAS</h2>";
		echo "<iframe frameBorder='0' scrolling='no' width='100%' height='575' src='reports-payables-action.php?action=d'></iframe><br />";
		// contas a receber
		echo "<br><h2>ENTRADAS</h2>";
		echo "<iframe frameBorder='0' scrolling='no' width='100%' height='575' src='reports-receivables-action.php?action=d'></iframe>";


  } elseif ( $_GET['action'] == "m" ) {

		$data_file = "invoice_receivable_monthly.tsv";
		$data_file2 = "invoice_payable_monthly.tsv";

		// contas a pagar
		echo "<h2>SA&Iacute;DAS</h2>";
		echo "<iframe frameBorder='0' scrolling='no' width='100%' height='575' src='reports-payables-action.php?action=m'></iframe><br />";
		// contas a receber
		echo "<br><h2>ENTRADAS</h2>";
		echo "<iframe frameBorder='0' scrolling='no' width='100%' height='575' src='reports-receivables-action.php?action=a'></iframe>";

  } elseif ( $_GET['action'] == "y" ) {

		$data_file = "invoice_receivable_yearly.tsv";
		$data_file2 = "invoice_payable_yearly.tsv";

		// contas a pagar
		echo "<h2>SA&Iacute;DAS</h2>";
		echo "<iframe frameBorder='0' scrolling='no' width='100%' height='575' src='reports-payables-action.php?action=y'></iframe><br />";
		// contas a receber
		echo "<br><h2>ENTRADAS</h2>";
		echo "<iframe frameBorder='0' scrolling='no' width='100%' height='575' src='reports-receivables-action.php?action=y'></iframe>";

  } elseif ( $_GET['action'] == "a" ) {

		$data_file = "invoice_receivable_monthly_all.tsv";

  } else {

	$error = "error: parameters does not match";

  }


} elseif ( isset( $_POST ) ) {

    $error = "error: no POST allowed here";

} else {

    $error = "error: parameters does not match";
}
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
  <head>
    <title>Reports</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!-- Le styles -->
    <link href="../bootstrap.css" rel="stylesheet">
    <style type="text/css">
      //body { font: 10px sans-serif; }
      body {
        padding-top: 60px;
      }
      .axis path,
      .axis line {
	fill: none;
	stroke: #000;
	shape-rendering: crispEdges;
      }
      .bar {
	fill: orange;
      }
      .bar:hover {
	fill: orangered ;
      }
      .x.axis path {
	display: none;
      }
      .d3-tip {
	line-height: 1;
	font-weight: bold;
	padding: 12px;
	background: rgba(0, 0, 0, 0.8);
	color: #fff;
	border-radius: 2px;
      }
      /* Creates a small triangle extender for the tooltip */
      .d3-tip:after {
	box-sizing: border-box;
	display: inline;
	font-size: 10px;
	width: 100%;
	line-height: 1;
	color: rgba(0, 0, 0, 0.8);
	content: "\25BC";
	position: absolute;
	text-align: center;
      }
      /* Style northward tooltips differently */
      .d3-tip.n:after {
	margin: -1px 0 0 0;
	top: 100%;
	left: 0;
      }
   </style>
  </head>

<body>

    <div class="topbar">
      <div class="topbar-inner">
        <div class="container-fluid">
          <a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_ADMIN_ROOT;?>/home.php" class="brand"><img src="<?=SYSPATH_SERVER_LOGO;?>" height="36"></a>
          <p class="pull-right">Logado como <a href="#"><?php echo $_SESSION["admin_display_name"]; ?></a></p>
        </div>
      </div>
    </div>


    <div class="content">
      <div class="row">
	<div class="span2">&nbsp;</div>
	<div class="span13">
	  <div><?php echo $error; ?></div>
	</div>
      </div>
    </div>






</body>
</html>
