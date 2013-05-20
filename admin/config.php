<?php
$baseUrl = $_SERVER['HTTP_HOST'];
$basePath = array_reverse(explode('/', __FILE__));
$basePath = array_merge($basePath, array());
unset($basePath[0]);
unset($basePath[1]);
$basePath = implode(array_reverse($basePath), '/');

// HTTP
define('HTTP_SERVER', 'http://' . $baseUrl . '/admin/');
define('HTTP_CATALOG', 'http://' . $baseUrl . '/');
define('HTTP_IMAGE', 'http://' . $baseUrl . '/image/');

// HTTPS
define('HTTPS_SERVER', 'https://' . $baseUrl . '/admin/');
define('HTTPS_CATALOG', 'https://' . $baseUrl . '/');
define('HTTPS_IMAGE', 'https://' . $baseUrl . '/image/');

// DIR
define('DIR_APPLICATION', $basePath . '/admin/');
define('DIR_SYSTEM', $basePath . '/system/');
define('DIR_DATABASE', $basePath . '/system/database/');
define('DIR_LANGUAGE', $basePath . '/admin/language/');
define('DIR_TEMPLATE', $basePath . '/admin/view/template/');
define('DIR_CONFIG', $basePath . '/system/config/');
define('DIR_IMAGE', $basePath . '/image/');
define('DIR_CACHE', $basePath . '/system/cache/');
define('DIR_DOWNLOAD', $basePath . '/download/');
define('DIR_LOGS', $basePath . '/system/logs/');
define('DIR_CATALOG', $basePath . '/catalog/');

// DB
define('DB_DRIVER', 'mysql');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'c17doc');
define('DB_PASSWORD', 'doc.km.ua');
define('DB_DATABASE', 'c17doc');
define('DB_PREFIX', '');
?>
