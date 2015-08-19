<?php
/*
Plugin Name: Random Keywords
Plugin URI: http://yourls.org/
Description: Assign random keywords to shorturls, like bitly (sho.rt/hJudjK)
Version: 1.1
Author: Ozh
Author URI: http://ozh.org/
*/

/* Release History:
*
* 1.0 Initial release
* 1.1 Added: don't increment sequential keyword counter & save one SQL query
* Fixed: plugin now complies to character set defined in config.php
*/

/*
 * Known BUGS (by Sven):
 * The random keywords are not checked for collision in this plugin.
 * There should be a good collision avoidance algorithm by just incrementing
 * $osz_random_keyword['length'] by one when a collision takes place.
 */


global $ozh_random_keyword;

/*
* CONFIG: EDIT THIS
*/

/* Length of random keyword */
$ozh_random_keyword['length'] = 4; # was 5

/*
 * yourls_rnd_string $types:
 * '0' = yourls_get_shorturl_charset(), derzeit Base62 = Lower+Uppercase
 * '1' = only lowercase, no vowels, no confusion with 0/o, 1/l
 * etc.
 * I think we stick to '1' which gives friendly random keys.
 */
$ozh_random_keyword['type'] = '1';

// Generate a random keyword
yourls_add_filter( 'random_keyword', 'ozh_random_keyword' );
function ozh_random_keyword() {
        global $ozh_random_keyword;
        return yourls_rnd_string( $ozh_random_keyword['length'], $ozh_random_keyword['type'] );
}

// Don't increment sequential keyword tracker
yourls_add_filter( 'get_next_decimal', 'ozh_random_keyword_next_decimal' );
function ozh_random_keyword_next_decimal( $next ) {
        return ( $next - 1 );
}

