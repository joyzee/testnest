<?php

spl_autoload_register(function ($class) {
  if (!class_exists($class) 
    and (file_exists($classPath = BASE_PATH . $class . '.php') 
    or file_exists($classPath = APP_PATH . 'classes' . DIRECTORY_SEPARATOR . $class . '.php'))) {
    require $classPath;
  }
});

require BASE_PATH . 'vendor/autoload.php';
