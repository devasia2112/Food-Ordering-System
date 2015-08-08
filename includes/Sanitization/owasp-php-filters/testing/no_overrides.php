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
// delete .htaccess file if it exists.

include "filename.php";
include "ftp-class.php";
$my_ftp_dir_chmod = new ftp_dir_chmod;

if (file_exists($filename)) {
        //print "The file $filename exists";
        $my_ftp_dir_chmod->ftp_writable(777);
        system("rm -f $filename");
        header('Location: index.php');
        exit;
} else {
        $my_ftp_dir_chmod->ftp_writable(775);
        header('Location: index.php');
        exit;
}

?>