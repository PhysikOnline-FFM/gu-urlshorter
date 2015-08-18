<?php
/**
 * This file shall collect public YOURLS settings for the GU url shortener.
 * It contains everything from config.php except
 *
 *   - the database configuration (secret YOURLS_DB_PASS!)
 *   - the $yourls_user_passwords (secret passwords!)
 *   - the YOURLS_COOKIEKEY (secret string!)
 *
 * (c) 2015 OSS - The TinyGU team / PhysikOnline Uni Frankfurt
 **/

/*
 ** Site options
 */

/** YOURLS installation URL -- all lowercase and with no trailing slash.
 ** If you define it to "http://site.com", don't use "http://www.site.com" in your browser (and vice-versa) */

// TODO: Possibly install the allow-aliases plugin: https://code.google.com/p/yourls-allow-aliases/source/browse/trunk/allow-aliases/plugin.php
define( 'YOURLS_SITE', 'http://shorten.physikelearning.de' );

/** Timezone GMT offset */
define( 'YOURLS_HOURS_OFFSET', +1 ); 

/** YOURLS language or "locale".
 ** Change this setting to "localize" YOURLS (use a translation instead of the default English). A corresponding .mo file
 ** must be installed in the user/language directory.
 ** See http://yourls.org/translations for more information */
// This is not that important as we adapted any frontend pages anyway.
define( 'YOURLS_LANG', '' ); 

/** Allow multiple short URLs for a same long URL
 ** Set to true to have only one pair of shortURL/longURL (default YOURLS behavior)
 ** Set to false to allow multiple short URLs pointing to the same long URL (bit.ly behavior) */
define( 'YOURLS_UNIQUE_URLS', false );

/** Private means the Admin area will be protected with login/pass as defined below.
 ** Set to false for public usage (eg on a restricted intranet or for test setups)
 ** Read http://yourls.org/privatepublic for more details if you're unsure */
define( 'YOURLS_PRIVATE', true );

// Make statistics about links public, eg. http://tinygu.de/1+
define('YOURLS_PRIVATE_INFOS', false);

// The list of allowed domains, for the host whitelisting plugin.
$allowed_domains = array(
	array(
		'domain'   => 'uni-frankfurt.de',
		'desc'     => 'Alle Seiten innerhalb der Uni Frankfurt',
		
		// TODO: list shorturl links instead which demonstrate correct links, eg.
		// '2 4b 58' => tinygu.de/domain-examples/2, tinygu.de/domain-examples/4b
		//           => resolved to http://www.uni-frankfurt.de/5732900..., ....
		'examples' => array(
			'http://www.uni-frankfurt.de/57329000',
			'https://olat.server.uni-frankfurt.de/olat/url/RepositoryEntry/2205515779',
			'http://www.starkerstart.uni-frankfurt.de/38104304/Struktur',
			'https://qis.server.uni-frankfurt.de/qisserver/rds;jsessionid=401078494F39D93694F3D25C4E0F6792.waldmarie01?state=user&type=8&topitem=lectures&breadCrumbSource=portal',
		)
	),
	array(
		'domain'  => 'goethe-university-frankfurt.de',
		'desc'    => 'Englischsprachige Seiten im CMS der Goethe-Universität',
	),
	array(
		'domain'  => 'hebis.de',
		'desc'    => 'Hessischer Bibliotheksverbund (intensiv genutzt durch Universitätsbibliothek)',
	),
);

# This does not yet work. 

#/* Simple role-based access controls (RBAC) for YOURLS */
#$authmgr_role_assignment = array(
#	// Role Administrator: No Limits
#	'administrator' => array('sven', 'sven2'),
#	// Editor: Cannot manage plugins
#	'editor' => array('my-close-friend'),
#	// Contributor: Cannot manage plugins, edit URLs or delete URLs
#	'contributor' => array(),
#);
#
#/* Set whole Uni Frankfurt as access to be granted */
#$authmgr_contributor_ipranges = array(
#	'141.2.0.0/16',
#);

/** Debug mode to output some internal information
 ** Default is false for live site. Enable when coding or before submitting a new issue */
define( 'YOURLS_DEBUG', false );
	
/*
 ** URL Shortening settings
 */

/** URL shortening method: 36 or 62 */
define( 'YOURLS_URL_CONVERT', 36 );
/*
 * 36: generates all lowercase keywords (ie: 13jkm)
 * 62: generates mixed case keywords (ie: 13jKm or 13JKm)
 * Stick to one setting. It's best not to change after you've started creating links.
 */

/** 
* Reserved keywords (so that generated URLs won't match them)
* Define here negative, unwanted or potentially misleading keywords.
*/
$yourls_reserved_URL = array(
	'porn', 'faggot', 'sex', 'nigger', 'fuck', 'cunt', 'dick', 'gay',
);

/*
 ** Personal settings would go after here.
 */

function gu_user_is_in_university_network() {
	// you may have to use HTTP_X_FORWARDED_FOR here dependening
	// on your PHP and proxy setup
	$client_ip = $_SERVER['REMOTE_ADDR'];
	$block = '141.2.0.0/16'; // Goethe University Frankfurt
	return cidr_match($client_ip, $block);
}



// Match IPv4 to subnet, from http://stackoverflow.com/a/594134
function cidr_match($ip, $range) {
	list ($subnet, $bits) = explode('/', $range);
	$ip = ip2long($ip);
	$subnet = ip2long($subnet);
	$mask = -1 << (32 - $bits);
	$subnet &= $mask; # nb: in case the supplied subnet wasn't correctly aligned
	return ($ip & $mask) == $subnet;
}
