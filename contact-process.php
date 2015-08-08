<?php
require("admin/bootstrap.php");
include( dirname(__FILE__) . SYSPATH_CONNECTION );
include( dirname(__FILE__) . SYSPATH_LANG );
require_once ("includes/PHPMailer/class.phpmailer.php");
require("includes/Sql/sql.class.php");



/*
 * BASIC POST sanitization
 */

foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); }



/*
 * Call data from database
 */

$mail           = new PHPMailer(true); //defaults to using php "mail()"; the true param means it will throw exceptions on errors, which we need to catch
$array_empresa  = GenericSql::getEmpresa( );



/*
 * Print the order on the screen to confirm purposes
 */

$order_data = '<center><pre>';
$order_data .= '<a href="menu"><img src="images/logo/'.$array_empresa[logotipo].'" /></a><br />';
$order_data .= '<br />------------------------------------------------------------------------------------------<br />';
$order_data .= '<b> '.GENERAL_CONTACT_FORM.' </b>';
$order_data .= '<br />------------------------------------------------------------------------------------------<br />';
$order_data .= '<table width="500">';
$order_data .= '<tr><td>'.LBL_CUSTOMER_NAME.':</td>     <td> ' . $_POST[feedback_name] . ' </td></tr>';
$order_data .= '<tr><td>'.LBL_CUSTOMER_PHONE1.':</td>   <td> ' . $_POST[feedback_contact] . ' </td></tr>';
$order_data .= '<tr><td>'.LBL_CUSTOMER_EMAIL.':</td>    <td> ' . $_POST[feedback_email] . ' </td></tr>';
$order_data .= '<tr><td>'.LBL_CUSTOMER_SUBJECT.':</td>  <td> ' . $_POST[feedback_subject] . ' </td></tr>';
$order_data .= '<tr><td>'.LBL_CUSTOMER_COMMENT.':</td>  <td> ' . $_POST[feedback_comment] . ' </td></tr>';
$order_data .= '</table>';
$order_data .= '------------------------------------------------------------------------------------------<br />';
$order_data .= '</pre></center>';
print $order_data;   // print the receipt on screen



/*
 * Send email to company (mail come from website user)
 */
//echo 'TO ' . $array_empresa['email'] . ' - FROM '. $_POST['feedback_email'];
try 
{
    $mail->AddReplyTo($_POST['feedback_email'], $_POST['feedback_name']);
    $mail->AddAddress($array_empresa['email'], $array_empresa['nome_fantasia']);                //TO
    $mail->SetFrom($array_empresa['email'], $array_empresa['nome_fantasia']);                   //FROM
    $mail->AddReplyTo($_POST['feedback_email'], $_POST['feedback_name']);
    $mail->Subject = $array_empresa['nome_fantasia'] . ' - ' . GENERAL_CONTACT_FORM . ' - ' . $_POST['feedback_name'];
    $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
    $mail->MsgHTML($order_data);
    $mail->AddAttachment('images/logo/logo_oficial.png');                                       // attachment
    //$mail->AddAttachment('images/phpmailer_mini.gif'); // attachment
    $mail->Send();
    echo "<center><pre><img src='images/icons/check-alt.png' /><br />" . MAIL_SENT_SUCCESS . $array_empresa['tel1'] . " <br /></pre></center> \n";
}
catch (phpmailerException $e)
{
    echo $e->errorMessage(); //Pretty error messages from PHPMailer
}
catch (Exception $e)
{
    echo $e->getMessage(); //Boring error messages from anything else!
}



/*
 * Send back to contact form
 */

//GenericSql::Redirect($sec=60, $file="contato.php");
?>
