<?php
if (!headers_sent()) {
	// Basic security headers
	header('X-Content-Type-Options: nosniff');
	header('X-Frame-Options: SAMEORIGIN');
	header('Referrer-Policy: strict-origin-when-cross-origin');
	header('Permissions-Policy: geolocation=(), microphone=(), camera=()');
	// If this page is sensitive (auth/account), keep:
	header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
	header('Pragma: no-cache');

	// Content Security Policy (CSP) - start with Report-Only if you want to avoid breakage
	// This is a "starter" CSP; you may need to adjust for analytics, fonts, CDNs, etc.
	//header("Content-Security-Policy: default-src 'self'; base-uri 'self'; form-action 'self'; frame-ancestors 'self'; object-src 'none';");
	$csp = implode('; ', [
		"default-src 'self'",
		"base-uri 'self'",
		"form-action 'self'",
		"frame-ancestors 'self'",
		"object-src 'none'",

		// Scripts: self + nonce + approved CDNs
		"script-src 'self' https://cdnjs.cloudflare.com https://maps.googleapis.com https://www.googletagmanager.com https://www.google-analytics.com https://cdn.jsdelivr.net",

		// Styles: ideally use nonce too; keep unsafe-inline only if you must
		"style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://fonts.googleapis.com https://cdnjs.cloudflare.com",

		// If you load fonts (Google Fonts, etc.)
		"font-src 'self' https://fonts.gstatic.com data:",

		// Images (analytics pixels often use data:)
		"img-src 'self' data: https://www.google-analytics.com https://stats.g.doubleclick.net",

		// Analytics / fetch / XHR / beacons
		"connect-src 'self' https://www.google-analytics.com https://stats.g.doubleclick.net",

		// Iframes (add only what you actually embed)
		"frame-src 'self' https://www.googletagmanager.com",

		"child-src 'self' https://www.googletagmanager.com",
	]);

	header("Content-Security-Policy-Report-Only: {$csp}");

	
	//header("Content-Security-Policy-Report-Only: default-src 'self'; base-uri 'self'; form-action 'self'; frame-ancestors 'self'; object-src 'none';");
	
}

$rmEnvSet = isset($_ENV['RUN_MODE']);
$amEnvSet = isset($_ENV['AUTH_MODE']);
define('ENVIRONMENT', $rmEnvSet ? $_ENV['RUN_MODE'] : 'production');
define('AUTHENV', $amEnvSet ? $_ENV['AUTH_MODE'] : 'production');

if (ENVIRONMENT == 'development' || ENVIRONMENT == 'dev') {
    error_reporting(E_ALL&~E_NOTICE);
    ini_set("display_errors", 1);
    ini_set("display_startup_errors", 1);
}
	
	$config = parse_ini_file(__DIR__ . "/config.ini");
	$GLOBALS["urlbase"] = $config["urlbase"];

	// DB CONFIG
	define('DB_HOST', $config["DB_HOST"]);
	define('DB_USER', $config["DB_USER"]);
	define('DB_PASS', $config["DB_PASS"]);
	define('DB_NAME', $config["DB_NAME"]);

	// LIFELINE ENDPOINT KEY
	define('ENDPOINT_KEY', $config["ENDPOINT_KEY"]);

	// LIFELINE ENDPOINT KEY
	define('OFFER_KEY', $config["OFFER_KEY"]);
	
	// App root 
	define('APPROOT',dirname(dirname(__FILE__)));

	// URL Root
	// define ('URLROOT',$config["baseurl"]);
	define('URLROOT', $config["urlbase"]);  
	
	// Site Name
	define('SITENAME', 'LinkupMobile');

	// Files URL Root
	//define('FILESROOT', $config['FILESROOT']);

	// Number From ReplyCX
	define('FROM_NUMBER_REPLYCX', '18338441190');

	//tAX API CONFIG
	define('TAXCLIENT_NUMBER', $config['TAXCLIENT_NUMBER']);
	define('TAXVALIDATION_KEY', $config['TAXVALIDATION_KEY']);

	define('CARD_ENCRYPTION_KEY', $config['CARD_ENCRYPTION_KEY']);

	define('GOOGLE_MAPS_API_KEY', $config['google_maps_api_key']);
	

/* AUTHORIZE.NET CONFIGURATION */
if (AUTHENV == 'test' || AUTHENV == 'Test') {

	define('API_LOGIN_ID', $config['AUTHSANDBOX_LOGIN_ID']);

	define('TRANSACTION_KEY', $config['AUTHSANDBOX_TRANSACTION_KEY']);

	define('APIURL', $config['AUTHSANDBOX_APIURL']);

	define('ACCEPTURL', $config['AUTHSANDBOX_ACCEPTURL']);

	define('CLIENT_KEY', $config['AUTHSANDBOX_CLIENT_KEY']);

} else {
	
	define('API_LOGIN_ID', $config['AUTHLIVE_LOGIN_ID']);

	define('TRANSACTION_KEY', $config['AUTHLIVE_TRANSACTION_KEY']);

	define('APIURL', $config['AUTHLIVE_APIURL']);

	define('ACCEPTURL', $config['AUTHLIVE_ACCEPTURL']);

	define('CLIENT_KEY', $config['AUTHLIVE_CLIENT_KEY']);

}

/* PAYPAL CONFIGURATION */
define('ProPayPal', 0);

if (ProPayPal) {
	define("PayPalClientId", $config['PAYPALLIVE_CLIENT_ID']);

	define("PayPalSecret", $config['PAYPALLIVE_SECRET']);

	define("PayPalBaseUrl", $config['PAYPALLIVE_BASEURL']);

	define("PayPalENV", "sandbox");
	
} else {
	define("PayPalClientId", $config['PAYPALSANDBOX_CLIENT_ID']);

	define("PayPalSecret", $config['PAYPALSANDBOX_SECRET']);

	define("PayPalBaseUrl", $config['PAYPALSANDBOX_BASEURL']);

	define("PayPalENV", "c");

}
	
	