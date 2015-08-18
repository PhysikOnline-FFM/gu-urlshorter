<?php
/*
Plugin Name: 404 if no short URL
Plugin URI: 
Description: Modified after https://github.com/YOURLS/YOURLS/issues/1869
Author: Sven Koeppel
*/

yourls_add_action( 'redirect_keyword_not_found', 'my404' );

function my404( $data ) {
	$shorturl = $data[0];
	include_once dirname(__FILE__).'/../../404.php';
	show404($shorturl);
	exit;
}
