# Food-Ordering-System

  Food Ordering System - is a system to control small restaurants that work with the home-delivery system, this system is an attempt to minimize some common problems encountered in the procedures of this type of company, we are offering this software without warranty, use as desired, change according to your needs and do not forget to contribute to improving the project, if you find any bug open an issue. There are still a lot to be done and with time I believe we can create a standard software for this type of company. This piece of software is far from compete with the industry related, but for many out there, that can not afford the high prices of proprietary software, here is an humble option. Enjoy.

# Installation

  Install the database scheme (create a new user, password and database - default name is delivery)

  Edit your config file in `/includes/config/config.php`

  Edit you config.ini file in `/includes/config/config.ini`

  Adjust path in /admin/bootstrap.php (WEBROOT essential) and /login/globals.php

  All filenames in the webroot need to be in the .htaccess file, otherwise it will be redirected to 404 page not found.
    (it works in the directory level only --> /admin/files may not work and you should create a new .htaccess file in there.)


# Embedding a cart functionalities to your websites

  If you have two or more websites offering the same product, I mean the same item from your stock, then you can embed this interface in your websites.
   `Delivery/menu-pcs` (Important: All changes made in `menu.php` should be made in `menu-pcs.php`)
