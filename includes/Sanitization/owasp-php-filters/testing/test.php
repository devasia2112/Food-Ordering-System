<?php
/*
 * Copyright (c) 2002,2003 Free Software Foundation
 * developed under the custody of the
 * Open Web Application Security Project
 * (http://www.owasp.org)
 *
 * This file is part of the PHP Filters.
 * PHP Filters is free software; you can redistribute it and/or modify it 
 * under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * PHP Filters is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 * 
 * If you are not able to view the LICENSE, which should
 * always be possible within a valid and working PHP Filters release,
 * please write to the Free Software Foundation, Inc.,
 * 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 * to get a copy of the GNU General Public License or to report a
 * possible license violation.
 */
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Nirvana Test</title>

</head>
<body>

<h3>Nirvana Test Suite</h3>
<hr>
<br />
<?php

// set test flag here
$flags = $_POST["flag"];

$test_str = $_POST["test_str"];

// env info
echo "<b>Server:</b> " . $_SERVER["SERVER_NAME"] . "<br />\n";
echo "<b>Server Software:</b> " . $_SERVER["SERVER_SOFTWARE"] . " on Linux<br />\n";
echo "<b>PHP Version:</b> " . phpversion() . "<br />\n";
echo "<b>Register Globals:</b> " . REGISTER_GLOBALS . "<br />\n";
echo "<b>Magic Quotes GPC:</b> " . MAGIC_QUOTES . "<br />\n";
echo "<b>Nirvana Test Flag:</b> " . $flags . "<br />\n";
echo "<br /><hr><br />";

// get flags. (yes it must be done this way unfortunately)
switch ($flags) {
    case 'PARANOID':
        $flags = 1;
        break;
    case 'SQL':
        $flags = 2;
        break;
    case 'SYSTEM':
        $flags = 4;
        break;
    case 'HTML':
        $flags = 8;
        break;
    case 'INT':
        $flags = 16;
        break;
    case 'FLOAT':
        $flags = 32;
        break;
    case 'LDAP':
        $flags = 64;
        break;
    case 'UTF8':
        $flags = 128;
        break;
    case 'NONE':
        $flags = 128;
        break;
    default: //none
        $flags = "NONE";
        break;
}

// print test string , sanitize, then print post-sanitized version of str
echo "<b>Test String was:</b> " . $test_str . "<br />\n";
if ($flags != "") {
        $new_str = sanitize($test_str, $flags, $min='', $max='');
} else {
        $new_str = $test_str;
}

echo "<b>Sanitized:</b> " . $new_str . "<br />\n";
echo "<a href='index.php'>return</a></br />\n";

?>
<a href="javascript:d=window.open();d.document.open('text/plain').write(document.body.outerHTML);">View Page Source</a>
</body>
</html>