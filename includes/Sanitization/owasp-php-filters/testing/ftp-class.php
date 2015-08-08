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

/// see user config setup at start of function

class ftp_dir_chmod {

  /*****************************************/
  /*                                       */
  /* chmod ftp directory uploads           */
  /*                                       */
  /*****************************************/
  //  usage :
  //  $my_ftp_dir_chmod->ftp_writable(777); // change dir to world-writable
  //  $my_ftp_dir_chmod->ftp_writable(775); // change dir back to non-world-writable

  function ftp_writable($chmod) {

    $this->ftp_server_name = "your.ftp.server.name";
    $this->ftp_user_name = "your.ftp.user.name";
    $this->ftp_password = "";
    $this->base_ftp_dir = "www";  // the base dir containing the subdir you want to chmod
    $this->ftp_dir = "nirvana";  //directory name that will contain .htaccess file

    $ftp_connection = ftp_connect("$this->ftp_server_name");
    if ($ftp_connection != 0) {
      $this->ftp_login_step = ftp_login($ftp_connection, "$this->ftp_user_name", "$this->ftp_password");
      //echo "Logging in..<br>";
    } else {
       echo "Error occurred connecting to FTP server: " . $this->ftp_server_name;
       exit();
    }

    if ($this->ftp_login_step != 0) {
      $this->ftp_change_directory = ftp_chdir($ftp_connection, "$this->base_ftp_dir");
      //echo "Changing dir...";
    } else {
      echo "Error occurred logging in to FTP server: " . $this->ftp_server_name;
      exit();
    }

    // what mode?
    $this->chmod = $chmod;
    $this->site_chmod = "chmod ".$this->chmod." ". $this->ftp_dir;

    if ($this->ftp_change_directory != 0) {
      $this->ftp_chmod = ftp_site($ftp_connection, "$this->site_chmod");
   // echo "Attempting chmod of uploads...";
    } else {
      echo "Error occurred changing directory on FTP server:". $this->ftp_server_name;
      exit();
    }

    if ($this->ftp_chmod == 0) {
      echo "Error occurred on CHMOD $chmod uploads command.";
      exit();
    }

}


} // end class