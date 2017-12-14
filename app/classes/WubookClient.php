<?php

class WubookClient {
  const XMLRPCURL = null; //need to override in child class
  const HEADERS = ['Content-Type' => 'text/xml', 'Accept' => 'text/xml',
    'Accept-Charset' => 'UTF8', 'Connection' => 'Keep-Alive',];
  protected $user;
  protected $password;
  protected $provider_key;
  protected $token;
  protected $lcode;
  protected $response;
  protected $httpResponse;
  protected $ch;
  
  /**
   * 
   * @param string $user
   * @param string $pass
   * @param string $pkey
   * @param int $lcode
   */
  public function __construct($user, $pass, $pkey, $lcode = null) {
    $this->user = $user;
    $this->password = $pass;
    $this->provider_key = $pkey;
    $this->lcode = $lcode;
    $this->response = [];
    $this->ch = curl_init();
    curl_setopt($this->ch, CURLOPT_URL, static::XMLRPCURL);
    curl_setopt($this->ch, CURLOPT_POST, true);
    curl_setopt($this->ch, CURLOPT_ENCODING, 'gzip,deflate');
    curl_setopt($this->ch, CURLOPT_USERAGENT, 'Wubook XML-RPC Client');
    curl_setopt($this->ch, CURLOPT_HEADER, self::HEADERS);
    curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, 8);
    curl_setopt($this->ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($this->ch, CURLOPT_HEADER, false);
    curl_setopt($this->ch, CURLOPT_NOBODY, false);
    curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($this->ch, CURLOPT_MAXREDIRS, 5);
    curl_setopt($this->ch, CURLOPT_AUTOREFERER, true);
    curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, 0);
  }

  public function __destruct() {
    curl_close($this->ch);
  }
  
  /**
   * 
   * @param string $rpc
   * @param Array $params 
   * @throws Exception
   */
  protected function send_request($rpc, $params) {
    $postdata = xmlrpc_encode_request($rpc, $params);
    curl_setopt($this->ch, CURLOPT_POSTFIELDS, $postdata);
    $this->httpResponse = curl_exec($this->ch);
    $errno = curl_errno($this->ch);
    $error = curl_error($this->ch);
    if (0 !== $errno) {
      throw new WubookClientExeption($error, $errno);
    }
    $this->response = xmlrpc_decode($this->httpResponse);
    if (is_array($this->response) && xmlrpc_is_fault($this->response)) {
      throw new WubookClientExeption($this->response['faultString'], $this->response['faultCode']);
    }
    if ($this->response[0] !== 0) {
      throw new WubookClientExeption($this->response[1], $this->response[0]);
    }
  }
  
  /**
   * 
   * @return array | null
   */
  public function getArrayResult() {
    return $this->response;
  }
  
  /**
   * 
   * @return string
   */
  public function getJSONResult() {
    $json = json_encode($this->response);
    if ($json === false) {
      throw new WubookClientExeption(json_last_error_msg(), json_last_error());
    }
    return  $json;
  }
}
