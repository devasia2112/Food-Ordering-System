<?php

	//$d = date('d') - 1;
	//echo $yesterday = date('Y-m-') . $d;

	//echo date("y");
?>



<?php
/*
session_start();

$sessionvars['name'] = "John";
$sessionvars['age'] = "43";
$sessionvars['gender'] = "Male";
$sessionvars['email'] = "john.doe@example.com";

$_SESSION['arvars'] = $sessionvars;
unset($sessionvars);

echo $_SESSION['arvars']['name']."<br>";
echo $_SESSION['arvars']['age']."<br>";
echo $_SESSION['arvars']['gender']."<br>";
echo $_SESSION['arvars']['email']."<br>";
*/
?>

<?
function GUID()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

print GUID();
?>



<?php
/*
$dbFile = 'name'.date('H').'.sql.gz';
$dbHost = ''; // Database Host
$dbUser = ''; // Database Username
$dbPass = ''; // Database Password
exec( 'mysqldump --host="'.$dbHost.'" --user="'.$dbUser.'" --password="'.$dbPass.'" --add-drop-table "/www/portal/TEMP" | gzip > "'.$dbFile.'"' );
*/
?>


<?php
/*
   require("class.phpmailer.php");

   header("Content-type: text/plain");

   // --- MySQL et path --------------------------------------------------------
   $mysql_host     = '';
   $mysql_username = '';
   $mysql_password = '';
   $mysql_db       = '';
   $mail_to1        = '';
   $mail_to1_name   = '';
   $mail_to2        = '';
   $mail_to2_name   = '';
   // --------------------------------------------------------------------------


   $fname = '' . $mysql_db . '_' . strftime('%Y%m%d-%H%M%S') . '.sql.gz';
   echo "Backing up to $fname\n";
   echo system('mysqldump --host=' . $mysql_host . ' --user=' . $mysql_username . ' --password=' . $mysql_password . ' ' . $mysql_db . ' | gzip >' . $fname);


   $mail = new PHPMailer();
   $mail->SetLanguage("en", "language/");
   $mail->From = 'E-Ephi System';
   $mail->FromName = 'Sistema E-Ephi';
   $mail->AddAddress($mail_to1, $mail_to1_name);
   $mail->AddAddress($mail_to2, $mail_to2_name);
   $mail->WordWrap = 50;         // set word wrap to 50 characters
   $mail->IsHTML(false);         // set email format to plain text
   $mail->Subject = 'Backup MySQL - ' . strftime('%x %X');
   $mail->Body    = 'Backup di�rio do banco de dados do Sistema E-Ephi';

   if (!$mail->AddAttachment($fname)) // add attachments
   {
      echo 'Erreur : ' . $mail->ErrorInfo . "\n";
      $mail->Body .= "\n" . 'Erreur : ' . $mail->ErrorInfo;
   }

   if (!$mail->Send())
   {
      echo 'Message could not be sent. <p>';
      echo 'Mailer Error: ' . $mail->ErrorInfo;
      exit;
   }

   echo 'Message has been sent';
   unlink($fname);
   exit;

*/



   // --- MySQL et path --------------------------------------------------------
   $mysql_host     = '';
   $mysql_username = '';
   $mysql_password = '';
   $mysql_db       = '';
   // --------------------------------------------------------------------------


	$backupFile = $mysql_db . date("Y-m-d-H-i-s")  . '.gz';
	$command = "mysqldump --opt -h $mysql_host -u $mysql_username -p $mysql_password $mysql_db | gzip > /www/$backupFile";
	$output = system($command);

	if($output==''){ echo ' bad output '; }
	else { echo ' good output '; }



?>
