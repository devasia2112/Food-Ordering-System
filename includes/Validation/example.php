<?php
/*
 This example assumes you are coming from a form using GET or POST.
 We will also check to make sure these values aren't longer than
 the database fields and have proper types. The $problem variable
 can be passed back to show what fields should be corrected or can
 be used to validate to protect against SQL injection hacks. The
 nice thing about using getFormValue is that it doesn't require the
 form value to exist and does not care if you use GET or POST.
 Also, getCookieValue and getSessionValue don't require the values
 to previously exist and will not give errors. If the element does
 not exist, then only a blank string is returned.

 There is no need to create an object with this class. All methods
 are static and are proceeded by the class name and two colons:
 valid::methodName
*/

include("validation.class.php");

// Let's check the POST or GET data and validate
$problem = "";
if (! valid::hasValue(valid::getFormValue("FullName"))) {
    $problem .= "First name is required<br />";
}
if (valid::isTooLong(valid::getFormValue("FullName"), 50)) {
    $problem .= "First name is too long<br />";
}
if (! valid::isEmail(valid::getFormValue("Email"))) {
    $problem .= "You must provide a valid email address<br />";
}
if (valid::isTooLong(valid::getFormValue("Email"), 255)) {
    $problem .= "Your email address is too long<br />";
}
if (! valid::isUnsignedNumber(valid::getFormValue("Zip"))) {
    $problem .= "You must provide a valid zip code<br />";
}
if (! valid::checkLength(valid::getFormValue("Zip"), 5, 5)) {
    $problem .= "Zip code is not 5 digits<br />";
}




// If there were any problems then show them
if (valid::hasValue($problem)) {
    echo $problem;
} else {
    echo "Data Validation Passed";
}






?>