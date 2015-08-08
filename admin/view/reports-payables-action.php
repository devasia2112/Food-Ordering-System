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


###########################################################################################################################

/************** SELECT DAILY OUTGOING *************************
SELECT `paid_date` AS letter, `total` AS frequency FROM `invoice_payable` WHERE status="paid" ORDER BY `paid_date` ASC
***************************************************************/


/************** SELECT MONTHLY OUTGOING GROUPED BY YEAR AND MONTH ******************* 
SELECT YEAR(paid_date),  MONTH(paid_date), SUM(total)
FROM invoice_payable 
WHERE status="paid" 
GROUP BY  YEAR(paid_date),  MONTH(paid_date)

SELECT CONCAT(YEAR(paid_date), " - ", MONTH(paid_date)) as letter, SUM(total) as frequency 
FROM invoice_payable 
WHERE status="paid" 
GROUP BY  YEAR(paid_date),  MONTH(paid_date)

ENTAO E SO EXPORTAR OS DADOS COMO CSV E USAR NO GRAFICO ... PRECISA VER UMA FORMA DE AUTOMATIZAR ISSO.
**************************************************************************************/


/************** SELECT YEARLY OUTGOING GROUPED BY YEAR ******************* 
SELECT YEAR(paid_date), SUM(total)
FROM invoice_payable 
WHERE status="paid" 
GROUP BY  YEAR(paid_date)
**************************************************************************************/

require('../../includes/config/config.php');
require('../../includes/Sql/sql.class.php');


###########################################################################################################################



/*
 * Validation data entry
 *
 */
if ( isset( $_GET ) ) {


  if ( $_GET['action'] == "d" ) {


		$query = "SELECT `paid_date` AS letter, `total` AS frequency FROM `invoice_payable` WHERE status='paid' ORDER BY `paid_date` ASC";
		$result = mysql_query( $query );
		$array_invoices = array();
		while( $row = mysql_fetch_array( $result )) {
			$array_invoices[] = array( "letter"=>$row[letter], "frequency"=>$row[frequency] );
		}
		file_put_contents( "_invoice_payable_daily.tsv", "letter\tfrequency\n", FILE_APPEND | LOCK_EX );
		foreach( $array_invoices as $arr => $value ) {
			file_put_contents( "_invoice_payable_daily.tsv", $value[letter] . "\t" . $value[frequency] . "\n", FILE_APPEND | LOCK_EX  );
		}
		rename("_invoice_payable_daily.tsv", "invoice_payable_daily.tsv");
	  
		$data_file = "invoice_payable_daily.tsv";

    
  } elseif ( $_GET['action'] == "m" ) {


		$query = "SELECT CONCAT(YEAR(paid_date), '-', MONTH(paid_date)) as letter, SUM(total) as frequency 
					FROM invoice_payable 
					WHERE status='paid'  
					GROUP BY  YEAR(paid_date),  MONTH(paid_date) ";
		$result = mysql_query( $query );
		$array_invoices = array();
		while( $row = mysql_fetch_array( $result )) {
			$array_invoices[] = array( "letter"=>$row[letter], "frequency"=>$row[frequency] );
		}
		file_put_contents( "_invoice_payable_monthly.tsv", "letter\tfrequency\n", FILE_APPEND | LOCK_EX );
		foreach( $array_invoices as $arr => $value ) {
			file_put_contents( "_invoice_payable_monthly.tsv", $value[letter] . "\t" . $value[frequency] . "\n", FILE_APPEND | LOCK_EX  );
		}
		rename("_invoice_payable_monthly.tsv", "invoice_payable_monthly.tsv");
	  
		$data_file = "invoice_payable_monthly.tsv";


	/* monthly paid and pending */
  } elseif ( $_GET['action'] == "mpp" ) {


		$query = "SELECT CONCAT( YEAR( due_date ) , '-', MONTH( due_date ) ) AS letter, SUM( total ) AS frequency
					FROM invoice_payable 
					WHERE STATUS = 'paid' 
					OR STATUS = 'pending' 
					GROUP BY YEAR( due_date ) , MONTH( due_date ) ";
		$result = mysql_query( $query );
		$array_invoices = array();
		while( $row = mysql_fetch_array( $result )) {
			$array_invoices[] = array( "letter"=>$row[letter], "frequency"=>$row[frequency] );
		}
		file_put_contents( "_invoice_payable_monthly_pp.tsv", "letter\tfrequency\n", FILE_APPEND | LOCK_EX );
		foreach( $array_invoices as $arr => $value ) {
			file_put_contents( "_invoice_payable_monthly_pp.tsv", $value[letter] . "\t" . $value[frequency] . "\n", FILE_APPEND | LOCK_EX  );
		}
		rename("_invoice_payable_monthly_pp.tsv", "invoice_payable_monthly_pp.tsv");
	  
		$data_file = "invoice_payable_monthly_pp.tsv";

    
  } elseif ( $_GET['action'] == "y" ) {


		$query = "SELECT YEAR(paid_date) as letter, SUM(total) as frequency 
					FROM invoice_payable 
					WHERE status='paid' 
					GROUP BY  YEAR(paid_date)";
		$result = mysql_query( $query );
		$array_invoices = array();
		while( $row = mysql_fetch_array( $result )) {
			$array_invoices[] = array( "letter"=>$row[letter], "frequency"=>$row[frequency] );
		}
		file_put_contents( "_invoice_payable_yearly.tsv", "letter\tfrequency\n", FILE_APPEND | LOCK_EX );
		foreach( $array_invoices as $arr => $value ) {
			file_put_contents( "_invoice_payable_yearly.tsv", $value[letter] . "\t" . $value[frequency] . "\n", FILE_APPEND | LOCK_EX  );
		}
		rename("_invoice_payable_yearly.tsv", "invoice_payable_yearly.tsv");
	  
		$data_file = "invoice_payable_yearly.tsv";

    
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

<!--
    <div class="topbar">
      <div class="topbar-inner">
        <div class="container-fluid">
          <a href="<?=SYSPATH_PROTOCOL.SYSPATH_SERVER_ADMIN_ROOT;?>/home.php" class="brand"><img src="<?=SYSPATH_SERVER_LOGO;?>" height="36"></a>
          <p class="pull-right">Logado como <a href="#"><?php echo $_SESSION["admin_display_name"]; ?></a></p>
        </div>
      </div>
    </div>
-->    
    
    <div class="content">
      <div class="row">
	<div class="span2">&nbsp;</div>
	<div class="span13">
	  <div><?php echo $error; ?></div>
	</div>
      </div>
    </div>
      


    <script src="../js/d3.v3.min.js"></script>
    <script src="../js/d3.tip.min.js"></script>
    <script>
    var margin = {top: 40, right: 20, bottom: 30, left: 75},
	width = 1300 - margin.left - margin.right,
	height = 500 - margin.top - margin.bottom;

    var formatPercent = d3.format("0");

    var x = d3.scale.ordinal()
	.rangeRoundBands([0, width], .1);

    var y = d3.scale.linear()
	.range([height, 0]);

    var xAxis = d3.svg.axis()
	.scale(x)
	.orient("bottom");

    var yAxis = d3.svg.axis()
	.scale(y)
	.orient("left")
	.tickFormat(formatPercent);

    var tip = d3.tip()
      .attr('class', 'd3-tip')
      .offset([-10, 0])
      .html(function(d) {
	return "<strong>Saida:</strong> <span style='color:red'>R$ " + d.frequency + "</span> <br> <strong>Data:</strong> <span style='color:red'> " + d.letter + "</span>";
      })

    var svg = d3.select("body").append("svg")
	.attr("width", width + margin.left + margin.right)
	.attr("height", height + margin.top + margin.bottom)
      .append("g")
	.attr("transform", "translate(" + margin.left + "," + margin.top + ")");

    svg.call(tip);

    d3.tsv("<?php echo $data_file; ?>", type, function(error, data) {
      x.domain(data.map(function(d) { return d.letter; }));
      y.domain([0, d3.max(data, function(d) { return d.frequency; })]);

      svg.append("g")
	  .attr("class", "x axis")
	  .attr("transform", "translate(0," + height + ")")
	  .call(xAxis);

      svg.append("g")
	  .attr("class", "y axis")
	  .call(yAxis)
	.append("text")
	  .attr("transform", "rotate(-90)")
	  .attr("y", 6)
	  .attr("dy", ".71em")
	  .style("text-anchor", "end")
	  .text("Frequency");

      svg.selectAll(".bar")
	  .data(data)
	.enter().append("rect")
	  .attr("class", "bar")
	  .attr("x", function(d) { return x(d.letter); })
	  .attr("width", x.rangeBand())
	  .attr("y", function(d) { return y(d.frequency); })
	  .attr("height", function(d) { return height - y(d.frequency); })
	  .on('mouseover', tip.show)
	  .on('mouseout', tip.hide)

    });
    function type(d) {
      d.frequency = +d.frequency;
      return d;
    }
    </script>


</body>
</html>
