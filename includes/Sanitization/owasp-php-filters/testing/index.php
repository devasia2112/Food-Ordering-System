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

<h3>Nirvana Test</h3>
<?php

// get register_globals ini setting - jp
$register_globals = ini_get('register_gobals');
if ($register_globals == TRUE) { define("REGISTER_GLOBALS", 1); } else { define("REGISTER_GLOBALS", 0); }

// get magic_quotes_gpc ini setting - jp
$magic_quotes = (bool) ini_get('magic_quotes_gpc');
if ($magic_quotes == TRUE) { define("MAGIC_QUOTES", 1); } else { define("MAGIC_QUOTES", 0); }
?>

<table name='table' cellspacing='1' cellpadding='3' border='1'>
 <tr>
  <td>
  <?php

// env info
echo "   <b>Server:</b> " . $_SERVER["SERVER_NAME"] . "<br />\n";
echo "   <b>Server Software:</b> " . $_SERVER["SERVER_SOFTWARE"] . " on Linux<br />\n";
echo "   <b>PHP Version:</b> " . phpversion() . "<br />\n";
echo "   <b>Register Globals:</b> " . REGISTER_GLOBALS . "<br />\n";
echo "   <b>Magic Quotes GPC:</b> " . MAGIC_QUOTES . "<br />\n";

?>
</td>
<td align='center' valign='top'>

 <?php


 if (MAGIC_QUOTES == 0) {
         echo "<form name='q_on' action='qon.php' method='post'><input type='submit' name='submit' value=' Turn Magic Quotes On ' /></form>";
} else {
        echo  "<form name='q_off' action='qoff.php' method='post'><input type='submit' name='submit' value=' Turn Magic Quotes Off ' /></form>";
}
?>
<br />
<!-- form name='nooverrides' action='no_overrides.php' method='post'>
 <input type='submit' name='submit' value=' Delete .htaccess file ' />
</form><br / -->
</td>
</tr>
</table><br /><hr><br />
<form name='submit' action='sanitize.php' method='post'>
<b>NONE:</b> <input type='radio' name='flag' value='NONE' /><br />
<B>PARANOID:</B> <input type='radio' name='flag' value='PARANOID' /><br />
<B>SQL:</B> <input type='radio' name='flag' value='SQL' checked='checked' /><br />
<B>SYSTEM:</B> <input type='radio' name='flag' value='SYSTEM' /><br />
<B>HTML:</B> <input type='radio' name='flag' value='HTML' /><br />
<B>INT:</B> <input type='radio' name='flag' value='INT' /><br />
<B>FLOAT:</B> <input type='radio' name='flag' value='FLOAT' /><br />
<B>LDAP:</B> <input type='radio' name='flag' value='LDAP' /><br />
<B>UTF8:</B> <input type='radio' name='flag' value='UTF8' /><br />
<B>Test String:</B> <input type='text' size='35' name='test_str' />
<input type='submit' name='submit' value=' Submit ' />
<input type='reset' name='reset' value=' Reset ' /><br />
</form>

</body>
</html>