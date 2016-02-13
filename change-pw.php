<?php
include_once dirname(__FILE__) . '/login/globals.php';
include_once dirname(__FILE__) . '/login/src/util/validators.php';
include dirname(__FILE__) . "/includes/config/config.php";
include dirname(__FILE__) . "/admin/bootstrap.php";
include dirname(__FILE__) . "/includes/lang/en-us.php";
include dirname(__FILE__) . "/includes/Sql/sql.class.php";
include dirname(__FILE__) . "/login/src/util/PasswordHash.php";

# Turn off all error reporting
error_reporting(0);

session_start();
$results = array();

if(isset($_SESSION['results']))
{
  $results = $_SESSION['results'];
  $msg = $_SESSION['msg'];
  unset($_SESSION['results']);
  unset($_SESSION['msg']);
  session_destroy();
}

if ( isset($_GET) and (!empty($_GET['email'])) ) {


  //print_r( $response );

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="">
    <meta name="keywords" content="comida tailandesa,thai food delivery,food delivery,food delivery services,online food delivery,lunch delivery,dinner delivery,thai food,tailandesa,tailandês,tailandes,janta tailandesa,almoço tailandês,entrega de comida tailandesa,thai delivery">
    <script type="text/javascript" src="scripts/jquery.min.js"></script>
    <script type="text/javascript" src="scripts/jquery.curvycorners.min.js"></script>
    <link type="text/css" href="stylesheet/stylesheet.css" rel="stylesheet" />
    <script type="text/javascript" src="scripts/jquery-ui-1.8.4.custom.min.js"></script>
    <link href="scripts/jqueryui/css/redmond/jquery-ui-1.8.4.custom.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="scripts/thickbox.js"></script>
    <link href="scripts/thickbox.css" rel="stylesheet" type="text/css" />

    <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" ></script>  -->
    <script src="scripts/jquery.min.js" ></script>
    <script type="text/javascript">
	    $(document).ready(function () {
	      var validatePassword = $('#validatePassword');
	      var validateNewPassword = $('#validateNewPassword');
	      $('#new_password').blur(function() {
		    var t = this;
		    validateNewPassword.removeClass('error').removeClass('success').html('<img src="login/view/images/ajax.gif" height="16" width="16" /> validating');

		    $.ajax({
		      url: 'login/src/util/ajax.php',
		      data: 'action=checkPassword&password=' + t.value,
		      dataType: 'json',
		      type: 'post',
		      success: function (j) {
			if(j.ok){
			    validateNewPassword.html('<img src="login/view/images/accept.png"/>').removeClass('error').addClass('success');
			}
			else{
			    validateNewPassword.html('<img src="login/view/images/exclamation.png"/> '+j.msg).removeClass('success').addClass('error');
			}
		      }
		    });
	      });
	    });
    </script>
</head>



<body>

    <div style="height:0px; overflow:hidden;"></div>
    <table border="0" cellspacing="1" cellpadding="0" align="center" class="table bg">
      <tr>
        <td width="638" id="left_column" valign="top">
            <div class="container">
		<div class="hero-unit">
		  <h2><img border=0 height=75 src="images/Mascote.png" /> <?=LBL_UPDATE_PASSWORD;?></h2>

		</div>
                <table class="cadastro-cliente" border=0>
		  <tr>
		    <td>

		      <div id="wrapper">
			<form id="signup" method="post" action="admin/model/customer-change-pwd.php">
			  <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>" />
			  <input type="hidden" name="endereco" value="<?php echo $_GET['endereco']; ?>" />
			  <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />

			  <?php echo show_errors( $results, $msg ); ?>

			  <!-- <label for="email"><?=LBL_ACTUAL_PASSWORD;?></label> <br/>
			  <input type="password" id="password" name="password" maxlength="30" required value=""/>
			  <span id="validatePassword"><?php //if ($error) { echo $error['msg']; } ?></span><br/><br/> -->
			  <label for="email"><?=LBL_PASSWORD;?></label> <br/>
			  <input type="password" id="new_password" name="new_password" maxlength="30" required value=""/>
			  <span id="validateNewPassword"><?php if ($error) { echo $error['msg']; } ?></span><br/><br/>
			  <input type="submit" value="<?=LBL_UPDATE;?>" id="signup_btn" name="signup_btn" />
			</form>
		      </div>

		    </td>
		  </tr>
                </table>
            </div>
        </td>
      </tr>

      <tr><td colspan=3>&nbsp;</td></tr>
      <tr>
	<td colspan=3>
	  <div style="background-color:#dcdcdc; height:1px; overflow:hidden; margin-top:20px; margin-bottom:10px;" class="table bg"></div>
	</td>
      </tr>

    </table>


</body>
</html>
