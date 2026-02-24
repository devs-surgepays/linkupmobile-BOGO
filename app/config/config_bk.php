<?php
$rmEnvSet = isset($_ENV['VAL_X']);
$rmEnvSet = isset($_ENV['RUN_MODE']);
$amEnvSet = isset($_ENV['AUTH_MODE']);
//define('ENVIRONMENT', $rmEnvSet ? $_ENV['RUN_MODE'] : 'development');
//define('AUTHENV', $amEnvSet ? $_ENV['AUTH_MODE'] : 'development');
define('ENVIRONMENT', $rmEnvSet ? $_ENV['RUN_MODE'] : 'test');
define('AUTHENV', $amEnvSet ? $_ENV['AUTH_MODE'] : 'test');

if (ENVIRONMENT == 'test' || ENVIRONMENT == 'test') {
  /* error_reporting(E_ALL & ~E_NOTICE);
  ini_set("display_errors", 1);
  ini_set("display_startup_errors", 1); */
}


// DB Configs
define('DB_HOST', 'localhost');

define('DB_USER', 'parichutelinkupm_ambassprogram');

define('DB_PASS', 'fMhuvRmR^6cy');

define('DB_NAME', 'parichutelinkupm_ambassador');


// App Root
define('APPROOT', dirname(dirname(__FILE__)));

// URL Root
define('URLROOT', 'https://parichute.linkupmobile.com/');

// Site Name
define('SITENAME', 'Parichute LinkupMobile');

// App Version
define('APPVERSION', '1.0.0');


/* AUTHORIZE.NET CONFIGURATION */
if (AUTHENV == 'test' || AUTHENV == 'Test') {
  define('API_LOGIN_ID', '8q35FqpYa');
  define('TRANSACTION_KEY', '4uNJ2266n86Z7vax');
  define('APIURL', "https://apitest.authorize.net/xml/v1/request.api");
  define('ACCEPTURL', 'https://jstest.authorize.net/v3/AcceptUI.js');
  define('CLIENT_KEY', '58pq995B8GtcL9vwN3xFCB3AjDyksvU8vyv3Ud48uP5yqS2R4vP6P37MgGDyG9uh');
} else {
  define('API_LOGIN_ID', '5Pe73vSVSr');
  define('TRANSACTION_KEY', '87Nn47cdM925aYDh');
  define('APIURL', "https://api.authorize.net/xml/v1/request.api");
  define('ACCEPTURL', 'https://js.authorize.net/v3/AcceptUI.js');
  define('CLIENT_KEY', '6833L85HxkBKE6eLLmYaLEbXfP33Cej35ENz2rmSsUWR2CZuW56fzrG4cv29g6WW');
}
/* if (AUTHENV == 'test' || AUTHENV == 'Test') {
  define('API_LOGIN_ID', '8q35FqpYa');
  define('TRANSACTION_KEY', '4uNJ2266n86Z7vax');
  define('APIURL', "https://apitest.authorize.net/xml/v1/request.api");
  define('ACCEPTURL', 'https://jstest.authorize.net/v3/AcceptUI.js');
  define('CLIENT_KEY', '58pq995B8GtcL9vwN3xFCB3AjDyksvU8vyv3Ud48uP5yqS2R4vP6P37MgGDyG9uh');
} else {
  define('API_LOGIN_ID', '5Pe73vSVSr');
  define('TRANSACTION_KEY', '7935pK6b32Tg6mP5');
  define('APIURL', "https://api.authorize.net/xml/v1/request.api");
  define('ACCEPTURL', 'https://js.authorize.net/v3/AcceptUI.js');
  define('CLIENT_KEY', '6833L85HxkBKE6eLLmYaLEbXfP33Cej35ENz2rmSsUWR2CZuW56fzrG4cv29g6WW');
} */

/* PAYPAL CONFIGURATION */
define('ProPayPal', 0);

if (ProPayPal) {

  //define("PayPalClientId", "AcrYdzKh-b3CqTgNpOX9s4vhjgoATJTviAr4PDi_e3BckvgDZObztHVgLDT8-9hDUZ52yrrnGMqhLjvw");

  //define("PayPalSecret", "EBqyPJ5vYj_75bYsCVU1LQl_b-MomrG-eSzaaOkYuDzUZ8GiCIAZjadJcPbvvZqYEMksejX4sQ5yH5gL");

  define("PayPalClientId", "AXyMc1hm0tp3HXYIRHL8QR6WSaePRSugKIDGvJhy9KnMkVytA9zTDe-Uv6pgSJ2VPOGWGJo_B_--v8pq");

  define("PayPalSecret", "EGXqleXPPifFjOhem8yi8JpkQ7lsZk6puHhFJpNGNd1LVMyzQZ485Hjt7F3kxdo2PRwwA8XP9RCDvLQs");

  define("PayPalBaseUrl", "https://myaccount.linkupmobile.com/payment");

  define("PayPalENV", "production");

} else {

  define("PayPalClientId", "AaEdd9_xmI0A7KhxIcXRlbd4sVj-zZ0oUwPEcNF51geeaS9_Q2M6ZrTw_R18GWH0WxfVLJOiLmLa1Lvq");

  define("PayPalSecret", "EGHlTeCaxLPkQuGw_nRr4Vu4bwSqbjesWYFDs1r22913h453VN8Vs1T1vY5FRQqoLv54nR9gtpBcfRlR");

  define("PayPalBaseUrl", "https://myaccount.linkupmobile.com/payment");

  define("PayPalENV", "sandbox");

}