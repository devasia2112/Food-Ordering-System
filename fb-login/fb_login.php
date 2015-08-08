<?php
function generateString($length=9, $strength=1) 
{
	$vowels = 'aeuy';
	$consonants = 'bdghjmnpqrstvzaeuy';
	if ($strength == 1) 
    {
		$consonants .= 'BDGHJLMNPQRSTVWXZ';
	}
	if ($strength == 2) 
    {
		$vowels .= "AEUY";
	}
	if ($strength == 4) 
    {
		$consonants .= '23456789';
	}
	if ($strength == 8) 
    {
		$consonants .= '@#$%';
	}
 
	$wrd = '';
	$alt = time() % 2;
	for ($i = 0; $i < $length; $i++) 
    {
		$wrd .= $consonants[(rand() % strlen($consonants))];
		$alt = 0;
	}
	return $wrd;
}

if(!isset($_SESSION))session_start();
require('src/facebook.php');
require('../includes/config/config.php');
require('../includes/Sql/sql.class.php');
require('../includes/phpass-0.3/PasswordHash.php');

$facebook   = new Facebook(array('appId'=>$fb_appId, 'secret'=>$fb_secret, 'cookie'=>true,));
$session    = $facebook->getSession();
$me         = null;

if ($session) 
{
    try 
    {
        $uid    = $facebook->getUser();
        $me     = $facebook->api('/me');
    } 
    catch (FacebookApiException $e) 
    {
        error_log($e);
    }
}

if ($me) 
{
    $logoutUrl  = $facebook->getLogoutUrl();
} 
else 
{
    $loginUrl   = $facebook->getLoginUrl();
}
?>

<html>
  <head>
    <style type="text/css">
      body {font-family: Trebuchet MS; font-size:12px }
    </style>
  </head>
  <body>

    <?php if ($me): ?>

        You have been successfully logged into facebook. [<a href="<?php echo $logoutUrl; ?>">Logout</a>]
        <h1>User Details</h1>

        <?php
        mysql_connect($host, $user, $pass);
        mysql_select_db($bd);
        if(!mysql_fetch_array(mysql_query("SELECT id FROM customers WHERE email='".$me['email']."'")))
        {
            $name = $me['first_name'] . " " . $me['last_name'];     // join fisrt name and last name in one unique name separated by space

            # Try to use stronger but system-specific hashes, with a possible fallback to
            # the weaker portable hashes.
            $t_hasher = new PasswordHash(8, FALSE);
            $hash = $t_hasher->HashPassword(generateString());

	        mysql_query( "INSERT INTO customers SET name='".$name."', email='".$me['email']."', registered_in = now(), password='".$hash."'" );
	        echo '<div style="color:green"><pre>User has been successfully registered.</pre></div>';

            // After insert in the database we create a session with the values to be used in the user profile in ckeckout
            if (!isset($_SESSION)) { session_start(); }
            $fb_array = array( 
                        "profile_pic"   => "https://graph.facebook.com/" . $me['username'] . "/picture", 
                        "first_name"    => $me['first_name'], 
                        "last_name"     => $me['last_name'], 
                        "email"         => $me['email'] 
                        );
            //$_SESSION['fb_arrays'] = $fb_array;   // not working with sessions 0_o
        }
        ?>

		<table>
			<tr>
				<td valign="top">
					<img src="https://graph.facebook.com/<?php echo $me['username']; ?>/picture">
				</td>
				<td valign="top">
					<b>Name:</b> <?php echo $me['first_name']." ".$me['last_name']; ?><br/>
					<b>Email:</b> <?php echo $me['email']; ?>
				</td>
			</tr>
		</table>

        <?php GenericSql::Redirect($sec=0, $file='../login.php?user='.$me['email']); ?>

    <?php else: ?>

        <div>
            <pre>You are currently not logged in. If not redirect to facebook, then click <a href="<?php echo $loginUrl; ?>">here</a> to login using facebook connect.</pre>
        </div>
        <?php //GenericSql::Redirect($sec=0, $file=$loginUrl); ?>

    <?php endif; ?>

	</body>
</html>
