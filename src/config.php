<?php

 
// ----------------- ROUTER

$route_vars = array
	(
		'articles_page' => 'info',
		'letter_page' => 'records',
		'blog' => 'blog',
		'sitemap_xml' => 'sitemap.xml',
		'key_page' => 'key',

		# subItem pages:
		'full_review' => 'a-z-review',
		'update_page' => 'update-record', // domain.com/update
		'tools_link' => 'setsend', // redirect page for tools list
		'whois_raw' => 'record-whois', // domain.com/whois-raw
		'tld_alternatives' => 'record-tlds', // domain.com/tld-alternatives
	);


// ----------------- TEXT CONSTANTS



define('DB_NAME','tickets');
define('DB_USER','slim');
define('DB_PASS','slim');
define('DB_CHARSET','utf8'); 
define('DB_PORT', 3306); 
define('DB_HOST', 'localhost'); 