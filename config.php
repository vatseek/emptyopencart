<?php

$baseUrl = $_SERVER['HTTP_HOST'];

$basePath = array_reverse(explode('/', __FILE__));
$basePath = array_merge($basePath, array());
unset($basePath[0]);
$basePath = implode(array_reverse($basePath), '/');

// HTTP
define('HTTP_SERVER', 'http://'.$baseUrl.'/');
define('HTTP_IMAGE', 'http://'.$baseUrl.'/image/');
define('HTTP_ADMIN', 'http://'.$baseUrl.'/admin/');

// HTTPS
define('HTTPS_SERVER', 'https://'.$baseUrl.'/');
define('HTTPS_IMAGE', 'https://'.$baseUrl.'/image/');

// DIR
define('DIR_APPLICATION', $basePath . '/catalog/');
define('DIR_SYSTEM', $basePath . '/system/');
define('DIR_DATABASE', $basePath . '/system/database/');
define('DIR_LANGUAGE', $basePath . '/catalog/language/');
define('DIR_TEMPLATE', $basePath . '/catalog/view/theme/');
define('DIR_CONFIG', $basePath . '/system/config/');
define('DIR_IMAGE', $basePath . '/image/');
define('DIR_CACHE', $basePath . '/system/cache/');
define('DIR_DOWNLOAD', $basePath . '/download/');
define('DIR_LOGS', $basePath . '/system/logs/');

// DB
define('DB_DRIVER', 'mysql');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'user');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'lovlya_co');
define('DB_PREFIX', '');
?>