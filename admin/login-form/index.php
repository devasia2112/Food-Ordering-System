<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="styles.css" />
</head>

<body>
<div id="carbonForm">
	<h2>&nbsp;&nbsp;<sub><img src="img/lock.png" /></sub>&nbsp;&nbsp;Admin Panel - Login</h2>

    <form action="login-submit.php" method="post" id="signupForm">
		<div class="fieldContainer">
			<div class="formRow">
				<div class="label">
					<label for="email">Email:</label>
				</div>
				
				<div class="field">
					<input type="text" name="email" id="email" />
				</div>
			</div>
			<div class="formRow">
				<div class="label">
					<label for="password">Password:</label>
				</div>
				
				<div class="field">
					<input type="password" name="password" id="pass" />
				</div>
			</div>
		</div> 
		<div class="signupButton">
			<input type="submit" name="submit" id="submit" value="Signup" />
		</div>
    </form>
        
</div>


<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>

</body>
</html>
