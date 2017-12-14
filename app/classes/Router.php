<?php

class Router {

  protected $uri;
  protected $controller;
  protected $action;
  protected $rqparams;
  protected $uriparams;
  protected $method;
  protected $headers;
  protected $post;
  protected $get;
  protected $cookie;

  public function __construct() {
    $this->uri = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_CALLBACK, ['options' => function ($str, $split = '?') {
        return strtok($str, $split);
      }]);
    $this->method = filter_input(INPUT_SERVER, 'REQUEST_METHOD');
    $segments = explode('/', trim($this->uri, '/'), 3);
    $this->controller = isset($segments[0]) ? $segments[0] : null;
    $this->action = isset($segments[1]) ? $segments[1] : null;
    $this->uriparams = isset($segments[2]) ? explode('/', $segments[2]) : null;
    $this->get = filter_input_array(INPUT_GET, FILTER_DEFAULT);
    $this->post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $this->cookie = filter_input_array(INPUT_COOKIE, FILTER_DEFAULT);
    $this->rqparams = file_get_contents('php://input');
    $this->headers = array_change_key_case(apache_request_headers());
  }

  function run() {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, HEAD');
    header('Cache-Control: no-cache');
    header('Pragma: no-cache');
    try {
      $content_type = isset($this->headers['content-type']) ? $this->headers['content-type'] : null;
      $json_data = json_decode($this->rqparams, true);
      $errorno = json_last_error();
      $error = json_last_error_msg();
      $class = isset(Config::routes[$this->controller]) ? Config::routes[$this->controller] : null;
      $method_exist = is_callable([$class, $this->action]);

      if ($content_type === 'application/json' and $this->method === 'POST' and isset($class) and $method_exist and $errorno === 0) {
        $client = new $class(Config::UserName, Config::Password, Config::pKey);
        $client->acquire_token();
        call_user_func_array([$client, $this->action], $json_data);
        $response = $client->getJSONResult();
        header('Content-Type: application/json; charset=utf-8');
        header('Content-Length: ' . strlen($response));
        echo $response;
      } else {
        $msg = 'Wrong request. Accept POST request on URI in /xmlrpcapi/method/ format with JSON data (should match wubook api).';
        http_response_code(400);
        header('Content-Type: application/json; charset=utf-8');
        $response = ($errorno !== 0) ? sprintf('{"errorno":%d,"errormsg":"%s"}', $errorno, $error) :
          sprintf('{"errorno":%d,"errormsg":"%s"}', PHP_INT_MIN, $msg);
        header('Content-Length: ' . strlen($response));
        echo $response;
      }
    } catch (WubookClientExeption $e) {
      http_response_code(502);
      header('Content-Type: application/json; charset=utf-8');
      $response = sprintf('{"errorno":%d,"errormsg":"%s"}', $e->getCode(), addslashes($e->getMessage()));
      header('Content-Length: ' . strlen($response));
      echo $response;
    }
  }

  public function __destruct() {
    
  }

}
