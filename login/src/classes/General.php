<?php
/*
 * General Classes
 */

class General
{

	/*
     *  Provide a default redirect 
     */

	public static function Redirect($sec, $file)
	{
		if (!headers_sent())
		{
		  header( "refresh:$sec;url=$file" ); 
		}
		else if (headers_sent())
		{
			echo '<noscript>';
			echo '<meta http-equiv="refresh" content="'.$sec.';url='.$file.'" />';
			echo '</noscript>';
		}
		else
		{
			echo '<script type="text/javascript">';
			echo 'window.location.href="'.$file.'";';
			echo '</script>';
		}
	}
}