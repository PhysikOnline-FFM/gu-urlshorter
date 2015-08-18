<?php
/*
Plugin Name: Whitelist Domains
Plugin URI: 
Description:  Allow URLs based on whitelisted Domain list
Author: Sven Koeppel
Author URI: https://th.physik.uni-frankfurt.de/~koeppel
*/


// No direct call
if( !defined( 'YOURLS_ABSPATH' ) ) die();

// Hook the custom function into the 'shunt_add_new_link' event
yourls_add_filter( 'shunt_add_new_link', 'svenk_check_whitelisted_domain' );


// Get whitelisted domains from YOURLS options feature and compare with current domain address
function svenk_check_whitelisted_domain( $success, $url, $keyword, $title ) {
	/* This filter works like that: Return $success if everything is fine,
	   return something else or die if not.
	   Unfortunately the filter is called *before* the URL is escaped properly,
	   so we have to do this twice (https://github.com/YOURLS/YOURLS/blob/master/includes/functions.php#L185). */
	$url = yourls_escape( yourls_sanitize_url( yourls_encodeURI($url) ) );
	$url_host = parse_url($url, PHP_URL_HOST);

	if(!$url_host) {
		// we cannot even determine the host part of the $url, fail silently.
		// This more or less replaces Line191 in the functions.php file.
		# yourls_die('During Whitelist check, cannot determine host of URL', 'Forbidden', 403);
		return array('status'=>'fail', 'code'=>'error:nourl',
			'message'=>'During whitelist check, cannot determine host of URL. Probably missing or malformed URL',
			'errorCode' => 400);
	}

	/* make sure this is present: The configuration of whitelisted domains */
	global $allowed_domains;

	foreach($allowed_domains as $allowed_domain) {
		if(isset($allowed_domain['regexp'])) {
			// check if this whitelist entry catches the $url_host by regexp
			if(preg_match($allowed_domain['regexp'], $url_host))
				return $success;
		} elseif(isset($allowed_domain['domain'])) {
			// check if this whitelist entry allows the $url_host by domain end test
			if(svenk_endsWith($url_host, $allowed_domain['domain']))
				return $success;
		}
	}

	/* URL is not whitelisted. Fail verbosely */
	return array('status' => 'fail', 'code'=>'error:whitelist',
		'message'=>'This domain is not whitelisted.', 'errorCode'=> 400);
	#yourls_die('This domain is not whitelisted', 'Forbidden', 403);
}

function svenk_endsWith($haystack, $needle) {
    // search forward starting from end minus needle length characters
    return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
}

