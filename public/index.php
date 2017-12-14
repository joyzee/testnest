<?php

error_reporting(E_ALL);
define('BASE_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP_PATH', BASE_PATH . 'app' . DIRECTORY_SEPARATOR);
define('HOME_PATH', BASE_PATH . 'public' . DIRECTORY_SEPARATOR);

try {
  require APP_PATH . 'config' . DIRECTORY_SEPARATOR . 'config.php';
  require APP_PATH . 'config' . DIRECTORY_SEPARATOR . 'loader.php';
  
  (new Router())->run();

} catch (Exception $e) {
  http_response_code(500);
  echo $e->getCode() . ' ' . $e->getMessage();
}