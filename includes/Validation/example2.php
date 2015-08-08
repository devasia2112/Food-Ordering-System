<?php
include("validation.class.php");

//Compare two values
$test1 = "apples";
$test2 = "oranges";
if (valid::compare($test1, $test2)) {
    echo "match<br />";
} else {
    echo "no match<br />";
}

//Get a POST or GET the same way without errors or isset
echo "POST/GET: " . valid::getFormValue("NameOfFormElement") . "<br />";

//Get a session variable without errors or isset
echo "Session: " . valid::getSessionValue("VariableName") . "<br />";

//Get a cookie without errors or isset
echo "Cookie: " . valid::getCookieValue("CookieName") . "<br />";

//Get a cookie, post, get, or session variable without errors or isset
echo valid::getValue("ValueName");

//If the value is empty, blank, or null, then give a default value
echo valid::getDefaultOnEmpty(null, "default value") . "<br />";
echo valid::getDefaultOnEmpty("123", "default value") . "<br />";

//Test to see if a value has been set or is blank
$test1 = "some text";
$test2 = "";
$test3 = null;
if (valid::hasValue($test1)) {
    echo "a value exists<br />";
} else {
    echo "no value<br />";
}

//Check for alpha only (no numbers or symbols)
$test1 = "abcdefg";
$test2 = "a1 bc";
$test3 = null;
if (valid::isAlpha($test1)) {
    echo "alpha<br />";
} else {
    echo "not alpha<br />";
}

//Check for alpha numeric
$test1 = "abc123";
$test2 = "a1 bc";
$test3 = null;
if (valid::isAlphaNumeric($test1)) {
    echo "alpha-numeric<br />";
} else {
    echo "not alpha-numeric<br />";
}

//Check for a valid date
$test1 = "1-2-03";
$test2 = "10/11/12";
$test3 = "June 14, 2007";
if (valid::isDate($test3)) {
    echo "date<br />";
} else {
    echo "not date<br />";
}

//Check for a valid email address
$test1 = "some.person@email.com";
$test2 = "asdf";
if (valid::isEmail($test1)) {
    echo "email<br />";
} else {
    echo "not email<br />";
}

//Check for a valid URL
$test1 = "http://www.google.com";
$test2 = "myserver.net";
if (valid::isInternetURL($test1)) {
    echo "URL<br />";
} else {
    echo "not URL<br />";
}

//Check for a valid IP address
$test1 = "10.20.30.40";
if (valid::isIPAddress($test1)) {
    echo "IP address<br />";
} else {
    echo "not IP address<br />";
}

//Check for a number
$test1 = "12345";
$test2 = "asdf";
if (valid::isNumber($test1)) {
    echo "number<br />";
} else {
    echo "not number<br />";
}

//Check for a state code
$test1 = "TX";
$test2 = "Texas";
if (valid::isStateAbbreviation($test1)) {
    echo "state code<br />";
} else {
    echo "not state code<br />";
}

//Check for an unsigned number (no minus sign)
$test1 = "12345";
$test2 = "-6789";
if (valid::isUnsignedNumber($test1)) {
    echo "unsigned number<br />";
} else {
    echo "not unsigned number<br />";
}

//Check for the length of a string
$test1 = "abc";
$test2 = "abcdefgh";
if (valid::checkLength($test1, 3)) {
    echo "good length<br />";
} else {
    echo "bad length<br />";
}

//Check to see if this string is too long
$test = "abcd";
if (valid::isTooLong($test, 3)) {
    echo "too long";
} else {
    echo "good length";
}


echo '<hr />';

$value = "áçôres são avó";
if (valid::isAlphaPlus($value))
{
	echo 1;
}
else
{
	echo 0;
}




?>
