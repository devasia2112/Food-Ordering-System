<?php
include('db.php');
session_start();
$session_id='1'; //$session id
?>
<html>
<head>
<title></title>
</head>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>

<script type="text/javascript" >
$(document).ready(function() {
	$('#photoimg').live('change', function(){ 
		$("#preview").html('');
		$("#preview").html('<img src="loader.gif" alt="Uploading...."/>');
		$("#imageform").ajaxForm({target: '#preview'}).submit();
	});
}); 
</script>

<style>
body
{
font-family:arial;
}
.preview
{
width:200px;
border:solid 1px #dedede;
padding:10px;
}
#preview
{
color:#cc0000;
font-size:12px
}
</style>
<body>


<div style="width:600px">
<form id="imageform" method="post" enctype="multipart/form-data" action='ajaximage.php'>
Upload your image <input type="file" name="photoimg" id="photoimg" />
</form>
<div id='preview'>
</div>
</div>


</body>
</html>
