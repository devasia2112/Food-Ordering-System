<?php

class valid
{
	/**
	 * Checks the length of a value
	 *
	 * @param string  $value The value to check
	 * @param integer $maxLength The maximum allowable length of the value
	 * @param integer $minLength [Optional] The minimum allowable length
	 * @return boolean TRUE if the requirements are met, FALSE if not
	 */

	public static function checkLength($value, $maxLength, $minLength = 0)
	{
		if (!(strlen($value) > $maxLength) && !(strlen($value) < $minLength)) {
			return true;
		} else {
			return false;
		}
	}



	/**
	 * Compares two values for equality
	 *
	 * @param string  $value1 First value to compare
	 * @param string  $value2 Second value to compare
	 * @param boolean $caseSensitive [Optional] TRUE if compare is case sensitive
	 * @return boolean TRUE if the values are equal and FALSE if not
	 */

	public static function compare($value1, $value2, $caseSensitive = false)
	{
		if ($caseSensitive) {
			return ($value1 ==  $value2 ? true : false);
		} else {
			if (strtoupper($value1) ==  strtoupper($value2)) {
				return true;
			} else {
				return false;
			}
		}
	}



	/**
	 * Converts any value of any datatype into boolean (true or false)
	 *
	 * @param any $value Value to analyze for TRUE or FALSE
	 * @param any $includeTrueValue (Optional) return TRUE if the value equals this
	 * @param any $includeFalseValue (Optional) return FALSE if the value equals this
	 * @return boolean Returns TRUE or FALSE
	 */

	public static function getBooleanValue($value, $includeTrueValue = null, $includeFalseValue = null) {

		if (!(is_null($includeTrueValue)) && $value == $includeTrueValue) {
			return true;
		} elseif (!(is_null($includeFalseValue)) && $value == $includeFalseValue) {
			return false;
		} else {
			if (gettype($value) == "boolean") {
				if ($value == true) {
					return true;
				} else {
					return false;
				}
			} elseif (is_numeric($value)) {
				if ($value > 0) {
					return true;
				} else {
					return false;
				}
			} else {
				$cleaned = strtoupper(trim($value));
				
				if ($cleaned == "ON") {
					return true;
				} elseif ($cleaned == "SELECTED" || $cleaned == "CHECKED") {
					return true;
				} elseif ($cleaned == "YES" || $cleaned == "Y") {
					return true;
				} elseif ($cleaned == "TRUE" || $cleaned == "T") {
					return true;
				} else {
					return false;
				}
			}
		}
	}



	/**
	 * Get the value for a cookie by the cookie name
	 *
	 * @param string  $name The name of the cookie
	 * @param string  $default (Optional) A default if the value is empty
	 * @return string The cookie value
	 */

	public static function getCookieValue($name, $default = '')
	{
		if (isset($_COOKIE[$name]))
		{
			return $_COOKIE[$name];
		} else {
			return $default;
		}
	}



	/**
	 * Returns the name of the current page
	 *
	 * @return string The page name
	 */

	public static function getCurrentPageName($lowercase = false) {
		$return = substr($_SERVER["SCRIPT_NAME"],
				 strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
		return ($lowercase ? strtolower($return) : $return);
	}



	/**
	 * Returns the name of the current URL
	 *
	 * @return string The URL path
	 */

	public static function getCurrentPageURL($lowercase = false) {
		$pageURL = 'http';
		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
		}
		return ($lowercase ? strtolower($pageURL) : $pageURL);
	}
	
	

	/**
	 * Returns the value if one exists, otherwise returns a default value
	 * (This also works on NULL values)
	 *
	 * @param string  $name The value to check
	 * @param string  $default A default if the value is empty
	 * @return string Returns the original value unless this value is
	 *                empty - in which the default is returned
	 */

	public static function getDefaultOnEmpty($value, $default) {
		if (self::hasValue($value)) {
			return $value;
		} else {
			return $default;
		}
	}



	/**
	 * Get a POST or GET value by a form element name
	 *
	 * @param string  $name The name of the POST or GET data
	 * @param string  $default (Optional) A default if the value is empty
	 * @return string The value of the form element
	 */

	public static function getFormValue($name, $default = '')
	{
		if (isset($_POST[$name]))
		{
			return $_POST[$name];
		} else {
			if (isset($_GET[$name]))
			{
				return $_GET[$name];
			} else {
				return $default;
			}
		}
	}



	/**
	 * Get the value for a request
	 *
	 * @param string  $name The name of the request item
	 * @param string  $default (Optional) A default if the value is empty
	 * @return string The request value
	 */

	public static function getRequestValue($name, $default = '')
	{
		if (isset($_REQUEST[$name]))
		{
			return $_REQUEST[$name];
		} else {
			return $default;
		}
	}



	/**
	 * Get the value for a session by the session name
	 *
	 * @param string  $name The name of the session
	 * @param string  $default (Optional) A default if the value is empty
	 * @return string The session value
	 */

	public static function getSessionValue($name, $default = '')
	{
		if (isset($_SESSION[$name]))
		{
			return $_SESSION[$name];
		} else {
			return $default;
		}
	}



	/**
	 * Get a POST, GET, Session, or Cookie value by name
	 * (in that order - if one doesn't exist, the next is tried)
	 *
	 * @param string  $name The name of the POST, GET, Session, or Cookie
	 * @param string  $default (Optional) A default if the value is empty
	 * @return string The value from that element
	 */

	public static function getValue($name, $default = '')
	{
		if (isset($_POST[$name]))
		{
			return $_POST[$name];
		} else {
			if (isset($_GET[$name]))
			{
				return $_GET[$name];
			} else {
				if (isset($_SESSION[$name]))
				{
					return $_SESSION[$name];
				} else {
					if (isset($_COOKIE[$name]))
					{
						return $_COOKIE[$name];
					} else {
						return $default;
					}
				}
			}
		}
	}



	/**
	 * Checks to see if a variable contains a value
	 *
	 * @param string  $value The value to check
	 * @return boolean TRUE if a value exists, FALSE if empty
	 */

	public static function hasValue($value)
	{
		if (strlen($value) < 1 || is_null($value) || empty($value)) {
			return false;
		} else {
			return true;
		}
	}



	/**
	 * Determines if a string is alpha only
	 *
	 * @param string $value The value to check for alpha (letters) only
	 * @param string $allow Any additional allowable characters
	 * @return boolean
	 */

	public static function isAlpha($value, $allow = '')
	{
		if (preg_match('/^[a-zA-Z' . $allow . ']+$/', $value))
		{
			return true;
		} else {
			return false;
		}
	}



	/**
	 * Determines if a string is alpha only, plus space and brazilian accentuation
	 *
	 * @param string $value The value to check for alpha (letters) only
	 * @param string $allow Any additional allowable characters
	 * @return boolean
	 * Added char unicode to preg_match in march 2012
	 */

	public static function isAlphaPlus($value)
	{
		/* 
		HEX CHAR CODE - UNICODE STANDARD 6.1
		Ref.: http://unicode.org/charts/PDF/U0080.pdf
		
		LOWER CASE
		----------
		00E0 à	00E8 è	00EC ì	00F2 ò	00F9 ù
		00E1 á	00E9 é	00ED í	00F3 ó	00FA ú
		00E2 â	00EA ê	00EE î	00F4 ô	00FB û
		00E3 ã	00EB ë	00EF ï	00F5 õ	00FC ü
		00E4 ä					00F6 ö
		
		00E7 ç
		
		
		UPPER CASE
		----------
		00C0 À	00C8 È	00CC Ì	00D2 Ò	00D9 Ù
		00C1 Á	00C9 É	00CD Í	00D3 Ó	00DA Ú
		00C2 Â	00CA Ê	00CE Î	00D4 Ô	00DB Û
		00C3 Ã	00CB Ë	00CF Ï	00D5 Õ	00DC Ü
		00C4 Ä					00D6 Ö
		
		00C7 Ç
		
		
		HOW TO USE
		----------
		\x{hex_code}
		/u modifier - turn on the unicode matching mode instead of the default 8-bit matching mode
		PHP will interpret '/[\x{hex_code}]/u' as a UTF-8 string rather than as an ASCII string.
		*/
		
		// New version
                /*
		$pregmatch = preg_match('/[\x{00E0}\x{00E1}\x{00E2}\x{00E3}\x{00E4}\x{00E8}\x{00E9}\x{00EA}\x{00EB}\x{00EC}\x{00ED}\x{00EE}\x{00EF}\x{00F2}\x{00F3}\x{00F4}\x{00F5}\x{00F6}\x{00F9}\x{00FA}\x{00FB}\x{00FC}\x{00E7}\x{00C0}\x{00C1}\x{00C2}\x{00C3}\x{00C4}\x{00C8}\x{00C9}\x{00CA}\x{00CB}\x{00CC}\x{00CD}\x{00CE}\x{00CF}\x{00D2}\x{00D3}\x{00D4}\x{00D5}\x{00D6}\x{00D9}\x{00DA}\x{00DB}\x{00DC}\x{00C7}a-zA-Z ]/u', $value);
		
		if ( $pregmatch )
		{
			return TRUE;
		} 
		else 
		{
			return FALSE;
		}
		*/
		
		
		/* Old Version */
		if (preg_match("/^[àáãâéêíóõôúüça-zÀÁÃÂÉÊÍÓÕÔÚÜÇA-Z ]+$/", $value))
		{
			return true;
		} 
		else 
		{
			return false;
		}
	}



	/**
	 * Determines if a string is alpha-numeric, plus space and brazilian accentuation
	 *
	 * @param string $value The value to check
	 * @return boolean TRUE if there are letters and numbers, FALSE if other
	 */

	public static function isAlphaNumericPlus($value)
	{	
		/* 
		HEX CHAR CODE - UNICODE STANDARD 6.1
		Ref.: http://unicode.org/charts/PDF/U0080.pdf
		
		LOWER CASE
		----------
		00E0 à	00E8 è	00EC ì	00F2 ò	00F9 ù
		00E1 á	00E9 é	00ED í	00F3 ó	00FA ú
		00E2 â	00EA ê	00EE î	00F4 ô	00FB û
		00E3 ã	00EB ë	00EF ï	00F5 õ	00FC ü
		00E4 ä					00F6 ö
		
		00E7 ç
		
		
		UPPER CASE
		----------
		00C0 À	00C8 È	00CC Ì	00D2 Ò	00D9 Ù
		00C1 Á	00C9 É	00CD Í	00D3 Ó	00DA Ú
		00C2 Â	00CA Ê	00CE Î	00D4 Ô	00DB Û
		00C3 Ã	00CB Ë	00CF Ï	00D5 Õ	00DC Ü
		00C4 Ä					00D6 Ö
		
		00C7 Ç
		
		
		HOW TO USE
		----------
		\x{hex_code}
		/u modifier - turn on the unicode matching mode instead of the default 8-bit matching mode
		PHP will interpret '/[\x{hex_code}]/u' as a UTF-8 string rather than as an ASCII string.
		
		*/
		
		
		// New version
		/*
		$pregmatch = preg_match('/[\x{00E0}\x{00E1}\x{00E2}\x{00E3}\x{00E4}\x{00E8}\x{00E9}\x{00EA}\x{00EB}
		\x{00EC}\x{00ED}\x{00EE}\x{00EF}\x{00F2}\x{00F3}\x{00F4}\x{00F5}\x{00F6}\x{00F9}\x{00FA}
		\x{00FB}\x{00FC}\x{00E7}\x{00C0}\x{00C1}\x{00C2}\x{00C3}\x{00C4}\x{00C8}\x{00C9}\x{00CA}
		\x{00CB}\x{00CC}\x{00CD}\x{00CE}\x{00CF}\x{00D2}\x{00D3}\x{00D4}\x{00D5}\x{00D6}
		\x{00D9}\x{00DA}\x{00DB}\x{00DC}\x{00C7}a-zA-Z0-9 ]/u', $value);
		
		if ( $pregmatch )
		{
			return true;
			echo 1;
		} 
		else 
		{
			return false;
			echo 2;
		}
		*/
		
		/* old version */
		if (preg_match("/^[àáãâéêíóõôúüça-zÀÁÃÂÉÊÍÓÕÔÚÜÇA-Z0-9 \.']+$/", $value))
		{
			return true;
		} else {
			return false;
		}
		
	}



	/**
	 * Convert Alpha Special to Alpha and truncate the string in the 35o char
	 * USED UNIQUELY IN NOTA FISCAL BRAZIL
	 * @param string  $value The value to check and convert
	 * @return a string with the value converted
	 */

	public static function AlphaSpecialToAlpha( $value )
	{
                $palavra = ereg_replace( "[^a-zA-Z0-9-]", " ", strtr( $value, "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ", "aaaaeeiooouucAAAAEEIOOOUUC" ) );
                $len = strlen( $palavra );

                if ( $len > 35 )
                {
                    $palavra = mb_strimwidth( $palavra, 0, 35 );
                }
                else if ( $len < 35 )
                {
                    //$add_space_to = ( 35 - $len );
                    $palavra = str_pad( $palavra, 35 );
                }
                else
                {
                    return FALSE;
                }
                
                return mb_strtoupper( $palavra );
        }



	/**
	 * Determines if a string is alpha-numeric
	 *
	 * @param string $value The value to check
	 * @return boolean TRUE if there are letters and numbers, FALSE if other
	 */

	public static function isAlphaNumeric($value)
	{
		if (preg_match("/^[A-Za-z0-9 ]+$/", $value))
		{
			return true;
		} else {
			return false;
		}
	}



	/**
	 * Determines if a string is a brazilian zip code
	 *
	 * @param string $value The value to check
	 * @return boolean TRUE if there are numbers, FALSE if other
	 */

	public static function isBrazilianZipCode($value)
	{
		if (preg_match("/^[0-9\-]+$/", $value))
		{
			return true;
		} else {
			return false;
		}
	}



	/**
	 * Determines if a string is a brazilian phone
	 *
	 * @param string $value The value to check
	 * @return boolean TRUE if there are numbers, FALSE if other
	 */

	public static function isBrazilianPhone($value)
	{
		if (preg_match("/^[0-9\-]+$/", $value))
		{
			return true;
		} else {
			return false;
		}
	}



	/**
	 * Determines if a string is a brazilian document valid (CPF)
	 *
	 * @param string $cpf The value to check
	 * @return boolean TRUE if there are a valid brazilian document, FALSE if other
	 */

        function isBrazilianValidCPF($cpf)
        {
                $nulos = array("12345678909","22222222222","33333333333",
                                           "44444444444","55555555555","66666666666","77777777777",
                                           "88888888888","99999999999","00000000000");

                // Retira todos os caracteres que nao sejam 0-9
                $cpf = ereg_replace("[^0-9]", "", $cpf);

                //Retorna falso se houver letras no cpf
                if (!(ereg("[0-9]",$cpf))) return false;

                //Retorna falso se o cpf for nulo
                if( in_array($cpf, $nulos) ) return false;

                //Calcula o penultimo digito verificador
                $acum = 0;
                for($i=0;  $i<9; $i++) { $acum += $cpf[$i] * (10 - $i); }

                $x = $acum % 11;
                $acum = ($x>1) ? (11 - $x) : 0;

                // Retorna falso se o digito calculado eh diferente do passado na string
                if ($acum != $cpf[9]){ return false; }

                //Calcula o ultimo digito verificador
                $acum = 0;
                for ($i=0; $i<10; $i++){ $acum += $cpf[$i] * (11 - $i); }

                $x = $acum % 11;
                $acum = ($x > 1) ? (11 - $x) : 0;
                // Retorna falso se o digito calculado eh diferente do passado na string
                if ( $acum != $cpf[10]){ return false; }

                // Retorna verdadeiro se o cpf for valido
                return true;
        }



	/**
	 * Determines if a string is a brazilian document valid (CNPJ)
	 *
	 * @param string $cnpj The value to check
	 * @return boolean TRUE if there are a valid brazilian document, FALSE if other
	 */

        function isBrazilianValidCNPJ($cnpj)
        {
            $cnpj = addcslashes($cnpj, "\n");
            // Valid Format
            if(!preg_match("/^\d{2}\.?\d{3}\.?\d{3}\/?\d{4}-?\d{2}$/", $cnpj))
            {
                return false;
             }

            // Clear != digit
            $cnpj = preg_replace("/[^\d]/", '', $cnpj);

            if (strlen($cnpj) != 14)
            {
                return false;
            }
            elseif ($cnpj == '00000000000000')
            {
                return false;
            }
            elseif ($cnpj == '11111111111111')
            {
                return true;
            }
            else
            {
                $number[0]  = intval(substr($cnpj, 0, 1));
                $number[1]  = intval(substr($cnpj, 1, 1));
                $number[2]  = intval(substr($cnpj, 2, 1));
                $number[3]  = intval(substr($cnpj, 3, 1));
                $number[4]  = intval(substr($cnpj, 4, 1));
                $number[5]  = intval(substr($cnpj, 5, 1));
                $number[6]  = intval(substr($cnpj, 6, 1));
                $number[7]  = intval(substr($cnpj, 7, 1));
                $number[8]  = intval(substr($cnpj, 8, 1));
                $number[9]  = intval(substr($cnpj, 9, 1));
                $number[10] = intval(substr($cnpj, 10, 1));
                $number[11] = intval(substr($cnpj, 11, 1));
                $number[12] = intval(substr($cnpj, 12, 1));
                $number[13] = intval(substr($cnpj, 13, 1));

                $sum = $number[0]*5+$number[1]*4+$number[2]*3+$number[3]*2+
                $number[4]*9+$number[5]*8+$number[6]*7+$number[7]*6+
                $number[8]*5+$number[9]*4+$number[10]*3+$number[11]*2;

                $sum -= (11*(intval($sum/11)));

                if ($sum == 0 || $sum == 1)
                {
                    $result1 = 0;
                }
                else
                {
                    $result1 = 11-$sum;
                }

                if ($result1 == $number[12])
                {
                    $sum  = $number[0]*6+$number[1]*5+$number[2]*4+$number[3]*3+
                    $number[4]*2+$number[5]*9+$number[6]*8+$number[7]*7+
                    $number[8]*6+$number[9]*5+$number[10]*4+$number[11]*3+
                    $number[12]*2;
                    $sum -= (11*(intval($sum/11)));
                    if ($sum == 0 || $sum == 1)
                    {
                        $result2 = 0;
                    }
                    else
                    {
                        $result2 = 11-$sum;
                    }

                    if ($result2 == $number[13])
                    {
                        return true;
                    }
                    else
                    {
                        return false;
                    }
                }
                else
                {
                    return false;
                }
            }
        }



	/**
	 * Determines if a string contains a valid date
	 *
	 * @param string $value The value to inspect
	 * @return boolean TRUE if the value is a date, FALSE if not
         *
         * #Update 1
         * Month and Day Validation -
         *      Month can't be major than 12
         *      Day can't be major than 31
         * Next Update:
         *      Ver possibilidade de trabalhar com a função checkdate()
         *      Veja exemplos abaixo:
         *          var_dump(checkdate(12, 31, 2000));      // output bool(true)
         *          var_dump(checkdate(2, 29, 2001));       // output bool(false)
         *
         */

	public static function isDate($value)
	{
		$year = date('Y', strtotime($value));
                $month = date('m', strtotime($value));
                $day = date('d', strtotime($value));

		if ($year == "1969" || $year <= "1970" || $year == '')
		{
			return false;
		} else {
			return true;
		}
                if ($month > "12" || $month == "00" || $month == "0" || $month == '')
                {
                        return false;
                } else {
			return true;
		}
                if ($day > "31" || $day == "00" || $day == "0" || $day == '')
                {
                        return false;
                } else {
			return true;
		}
	}



	/**
	 * Determines if a string contains a valid date
	 *
	 * @param string $value The value to inspect
	 * @return boolean TRUE if the value is a date, FALSE if not
	 */

	public static function isFullDate($value)
	{
		$t = strtotime($value);
		$conv = date("d/m/Y",$t+(0*3600)); # in brazilian format d/m/Y, you can change to whatever format you need to validate
		if ($conv == $value) {
			return TRUE;
		} else { 
			return FALSE; 
		}
	}



	/**
	 * Check for a valid email address
	 *
	 * @param string $email The value to validate as an email address
	 * @return boolean TRUE if it is a valid email address, FALSE if not
	 */

	public static function isEmail($email)
	{
		if (filter_var($email, FILTER_VALIDATE_EMAIL))
		{			
			return true;
		} else {
			return false;
		}
	}



	/**
	 * Checks to see if a variable contains no value (not even a zero)
	 *
	 * @param string  $value The value to check
	 * @return boolean TRUE if a value exists, FALSE if empty
	 */

	public static function isEmpty($value)
	{
		if (strlen($value) < 1 || is_null($value)) {
			return true;
		} else {
			return false;
		}
	}



	/**
	 * Checks for a valid internet URL
	 *
	 * @param string $value The value to check
	 * @return boolean TRUE if the value is a valid URL, FALSE if not
	 */

	public static function isInternetURL($value)
	{
		if (preg_match("/^http(s)?:\/\/([\w-]+\.)+[\w-]+(\/[\w- .\/?%&=]*)?$/i", $value))
		{
			return true;
		} else {
			return false;
		}
	}



	/**
	 * Checks for a valid IP Address
	 *
	 * @param string $value The value to check
	 * @return boolean TRUE if the value is an IP address, FALSE if not
	 */

	public static function isIPAddress($value)
	{
		$pattern = "/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/i";
		if (preg_match($pattern, $value))
		{
			return true;
		} else {
			return false;
		}
	}



	/**
	 * Checks to see if a variable is a number
	 *
	 * @param integer $number The value to check
	 * @return boolean TRUE if the value is a number, FALSE if not
	 */

	public static function isNumber($number)
	{
		if (preg_match("/^\-?\+?[0-9e1-9]+$/", $number))
		{
			return true;
		} else {
			return false;
		}
	}



	/**
	 * Checks for a two character state abbreviation
	 *
	 * @param string $value The value to inspect
	 * @return boolean TRUE if the value is a 2 letter state abbreviation
	 *                 FALSE if the value is anything else
	 */

	public static function isStateAbbreviation($value)
	{
		if (preg_match("/^[A-Z][A-Z]$/i", $value))
		{
			return true;
		} else {
			return false;
		}
	}



	/**
	 * Check to see if a string length is too long
	 *
	 * @param string $value The string value to check
	 * @param integer $maximumLength The maximum allowed length
	 * @return boolean TRUE if the length is too long
	 *                 FALSE if the length is acceptable
	 */

	public static function isTooLong($value, $maximumLength) {
		if (self::checkLength($value, $maximumLength)) {
			return false;
		} else {
			return true;
		}
	}



	/**
	 * Check to see if a string length is too short
	 *
	 * @param string $value The string value to check
	 * @param integer $maximumLength The minimum allowed length
	 * @return boolean TRUE if the length is too short
	 *                 FALSE if the length is acceptable
	 */

	public static function isTooShort($value, $minimumLength) {
		  if (strlen($value) < $minimumLength) {
			return false;
		} else {
			return true;
		}
	}



	/**
	 * Checks to see if a variable is an unsigned number
	 *
	 * @param integer $number The value to inspect
	 * @return boolean TRUE if the value is a number without a sign
	 *                 and FALSE if a sign exists
	 */

	public static function isUnsignedNumber($number)
	{
		if (preg_match("/^\+?[0-9]+$/", $number))
		{
			return true;
		} else {
			return false;
		}
	}







}
?>
