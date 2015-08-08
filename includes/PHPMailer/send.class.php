<?php

class Send {

	public function sendMail( $arr_mail ) {

		$mail = new PHPMailer(true); //defaults to using php "mail()"; the true param means it will throw exceptions on errors, which we need to catch
		try {
			$mail->AddAddress( $arr_mail['email'], $arr_mail['name'] );
			$mail->SetFrom( $arr_mail['system_email'], $arr_mail['system_from_name'] );
			$mail->AddReplyTo( $arr_mail['system_email'], $arr_mail['system_from_name'] );
			$mail->Subject = $arr_mail['subject'];
			$mail->AltBody = 'TheBeeService.com'; // optional - MsgHTML will create an alternate automatically
			$mail->MsgHTML( $arr_mail['message'] );
			$mail->AddAttachment( $arr_mail['attachment'] );      // attachment
			$mail->CharSet = "UTF-8";
			//$mail->AddAttachment('images/phpmailer_mini.gif'); // attachment
			$mail->Send();
			return "Message Sent OK";
		} catch ( phpmailerException $e ) {
			echo $e->errorMessage(); //Pretty error messages from PHPMailer
		} catch ( Exception $e ) {
			echo $e->getMessage(); //Boring error messages from anything else!
		}
	}



}
?>