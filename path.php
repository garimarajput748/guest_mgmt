<?php

/**
 * refs for more info : https://wp-mix.com/php-absolute-path-document-root-base-url/
 */
// server protocol
$protocol = empty($_SERVER['HTTPS']) ? 'http' : 'https';
// domain name
$domain = $_SERVER['SERVER_NAME'];
// server port
$port = $_SERVER['SERVER_PORT'];
$disp_port = ($protocol == 'http' && $port == 80 || $protocol == 'https' && $port == 443) ? '' : ":$port";

$base_url = "guest_mgmt"; // update your project folder name 

// put em all together to get the complete base URL
$url = "${protocol}://${domain}${disp_port}/${base_url}/";


// directory path 
define("SITE_ROOT_DIR_PATH", __DIR__ . "/");
define("ASSETS_DIR", SITE_ROOT_DIR_PATH . "assets/"); //assets/
define("VENDOR_DIR", ASSETS_DIR . "vendor/"); //assets/vendor/

// directory path in http
define("BASE_URL", $url); //http URL
define("ASSETS_HTTP", BASE_URL . "assets/"); //assets/
define("IMAGES_HTTP", ASSETS_HTTP . "img/"); //img dir
define("VENDOR_HTTP", ASSETS_HTTP . "vendor/"); //assets/vendor/
