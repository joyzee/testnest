<?php

$uri = urldecode(
        parse_url(filter_input(INPUT_SERVER, 'REQUEST_URI'), PHP_URL_PATH)
);
if ($uri !== '/' && file_exists(__DIR__ . '/public' . $uri)) {
  return false;
}

require __DIR__ . '/public/index.php';
