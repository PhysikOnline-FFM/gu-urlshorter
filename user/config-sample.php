<?php
/* This is a sample config file.
 * Edit this file with your own settings and save it as "config.php"
 */

require 'public.config.php';

/*
 ** MySQL settings - You can get this info from your web host
 */

/** MySQL database username */
define( 'YOURLS_DB_USER', 'foo' );

/** MySQL database password */
define( 'YOURLS_DB_PASS', 'bar' );

/** The name of the database for YOURLS */
define( 'YOURLS_DB_NAME', 'baz' );

/** MySQL hostname.
 ** If using a non standard port, specify it like 'hostname:port', eg. 'localhost:9999' or '127.0.0.1:666' */
define( 'YOURLS_DB_HOST', 'localhost' );

/** MySQL tables prefix */
define( 'YOURLS_DB_PREFIX', 'yourls_' );


/** A random secret hash used to encrypt cookies. You don't have to remember it, make it long and complicated. Hint: copy from http://yourls.org/cookie **/
define( 'YOURLS_COOKIEKEY', 'a secret string goes here' );

/** Username(s) and password(s) allowed to access the site. Passwords either in plain text or as encrypted hashes
 ** YOURLS will auto encrypt plain text passwords in this file
 ** Read http://yourls.org/userpassword for more information */
$yourls_user_passwords = array(
	// format is 'username' => 'password',
	// 'user' => 'admin',
	// ...
);


