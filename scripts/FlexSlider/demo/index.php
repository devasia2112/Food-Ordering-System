<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
	<meta content="charset=utf-8">
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
	
	<!-- FlexSlider CSS call -->
	<link rel="stylesheet" href="scripts/FlexSlider/flexslider.css" type="text/css" media="screen" />
	<!-- FlexSlider CSS call -->
	
	<!-- FlexSlider Modernizr -->
	<script src="scripts/FlexSlider/demo/js/modernizr.js"></script>
	<!-- FlexSlider Modernizr -->
  
</head>


	<!-- FlexSlider -->
		<div class="flexslider">
			<ul class="slides">
			
				<?php
				$arr = explode(",", $array_company['slider']);
				$cnt = count($arr)-1;
				if( $cnt>=1 ) { for($i=0;$i<$cnt;$i++) { echo '<li><img src="admin/view/plupload/uploads/' . $arr[$i] . '" /></li>'; } } 
				else { echo "no images found!"; }
				?>
				
			</ul>
		</div>

		<!-- jQuery -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.min.js">\x3C/script>')</script>

		<!-- FlexSlider -->
		<script defer src="scripts/FlexSlider/jquery.flexslider.js"></script>

		<script type="text/javascript">
		$(window).load(function() {
		$('.flexslider').flexslider({
			animation: "slide"
		});
		});
		</script>
	<!-- FlexSlider -->


</body>
</html>
