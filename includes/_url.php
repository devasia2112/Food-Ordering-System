<?php
/*
 * Classe Url
 * Description: Encode and Decode URLs
 * Date: 09-07-2012
 * Coder: Costa, Fernando
 * 
 * Observation: NO.
 * Parameters: YES, Data to be encoded.
 *
 */
 
class Url
{

	public static function urlEnc( $data )
	{
        // Encode URLs 
        return base64_encode(urlencode( $data ));
    }



	public static function urlDec( $data )
	{
        // Decode URLs encoded
        return urldecode(base64_decode( $data ));
    }

}
