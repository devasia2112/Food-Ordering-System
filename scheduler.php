<?php
if( $_SERVER['REQUEST_METHOD'] == "POST" ) {
	if (!isset($_SESSION)) session_start();
	$_SESSION['agenda_checkout'] = $_REQUEST['agenda'];
	echo "<br /><small>Agendado com sucesso para: " . $_REQUEST['agenda'] . "</small>";
	die;
}
?>

<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" type="text/css" href="scripts/jquery.datetimepicker.css"/>

<form method="post" action="">
<input type="text" name="agenda" id="datetimepicker3"/><br />
<div align=right><input type="submit" value="Agendar" /></a>
</form>

<script src="scripts/jquery.js"></script>
<script src="scripts/jquery.datetimepicker.js"></script>
<script>
$('#datetimepicker3').datetimepicker({
	lang:'pt',
	allowTimes:['10:00','10:30','11:00','11:30','12:00','12:30','13:00','13:30','14:00','14:30','15:00','15:30','16:00','16:30','17:00','17:30','18:00','18:30','19:00','19:30','20:00','20:30','21:00','21:30','22:00','22:30','23:00','23:30'],
	// minTime:0,   //use only if maxDate is enabled for a day only
	//formatDate:'Y-m-d 00:00:00',
	minDate:0, // yesterday is minimum date
	maxDate:'+1970/01/14', // and tommorow is maximum date calendar
	inline:true
});
</script>
