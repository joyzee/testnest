<?php

class WubookZakClient extends WubookClient {

  const XMLRPCURL = 'https://wubook.net/zxrvs/';
  const PAYMENT_TYPE_TO_CHANNEL = 1;
  const PAYMENT_TYPE_BY_CARD = 2;
  const PAYMENT_TYPE_IN_CASH = 3;
  const PAYMENT_TYPE_BY_BANK_TRANSFER = 4;
  const PAYMENT_TYPE_BY_CHECK = 5;
  const PAYMENT_TYPE_BY_OTHER = 6;
  const DOCUMENT_TYPE_DNI = 'D';
  const DOCUMENT_TYPE_PASSPORT = 'P';
  const DOCUMENT_TYPE_DRIVING_LICENCE = 'C';
  const DOCUMENT_TYPE_IDENTITY_CARD = 'I';
  const DOCUMENT_TYPE_SPANISH_RESIDENCE_PERMIT = 'N';
  const DOCUMENT_TYPE_UE_RESIDENCE_PERMIT = 'X';

//*********************  
// Authentication functions +
//*********************  

  public function acquire_token() {
    $params = [
      $this->user,
      $this->password,
      $this->provider_key,
    ];
    $this->send_request(__FUNCTION__, $params);
    $this->token = $this->response[1];
  }

  public function release_token() {
    $this->send_request(__FUNCTION__, [$this->token]);
  }

  public function is_token_valid() {
    $this->send_request(__FUNCTION__, [$this->token]);
  }

  public function provider_info() {
    $this->send_request(__FUNCTION__, [$this->token]);
  }

//*********************  
// Authentication functions +
//*********************  

  public function dateofserver() {
    $params = [
      $this->token,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function warning($msg_warning) {
    $params = [
      $this->token,
      $msg_warning,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

//*********************  
// Authentication functions +
//*********************   

  public function fetch_account() {
    $params = [
      $this->token,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function fetch_properties() {
    $params = [
      $this->token,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function fetch_property($lcode) {
    $params = [
      $this->token,
      $lcode,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function update_property($lcode, $dict) {
    $params = [
      $this->token,
      $lcode,
      $dict,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

//*********************  
// Bookings functions
//*********************    

  public function fetch_reservation($lcode, $codeVoucher) {
    $params = [
      $this->token,
      $lcode,
      $codeVoucher,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function fetch_reservations($lcode, $day_in, $day_out) {
    $params = [
      $this->token,
      $lcode,
      $day_in,
      $day_out,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function fetch_reservations_day($lcode, $day) {
    $params = [
      $this->token,
      $lcode,
      $day,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function checkin($lcode, $rid) {
    $params = [
      $this->token,
      $lcode,
      $rid,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function checkout($lcode, $rid) {
    $params = [
      $this->token,
      $lcode,
      $rid,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function fetch_extra($lcode) {
    $params = [
      $this->token,
      $lcode,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function add_extra_to_reserve($lcode, $rid, $eid, $n, $o = null) {
    $params = [
      $this->token,
      $lcode,
      $rid,
      $eid,
      $n,
      $o,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function add_payment($lcode, $rid, $type_of_payment, $amount) {
    $params = [
      $this->token,
      $lcode,
      $rid,
      $type_of_payment,
      $amount,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

//**********************  
// Prices functions +
//**********************

  public function fetch_plans($lcode) {
    $params = [
      $this->token,
      $lcode,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

//**********************  
// Availability functions +-
//**********************

  public function fetch_availability($lcode, $dfrom, $dto, $room = null) {
    $params = [
      $this->token,
      $lcode,
      $dfrom,
      $dto,
      $room,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function fetch_room($lcode, $room_code = null) {
    $params = [
      $this->token,
      $lcode,
      $room_code,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

//**********************  
// Occupancy functions
//**********************

  public function fetch_occupancy($lcode, $rcode) {
    $params = [
      $this->token,
      $lcode,
      $rcode,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

//**********************  
// Customers functions
//**********************

  public function add_customer($lcode, $data) {
    $params = [
      $this->token,
      $lcode,
      $data,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function fetch_customer($lcode, $data) {
    $params = [
      $this->token,
      $lcode,
      $data,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function update_customer($lcode, $ccode, $data) {
    $params = [
      $this->token,
      $lcode,
      $ccode,
      $data,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

//**********************  
// Invoices functions
//**********************

  public function fetch_headers_invoice($lcode) {
    $params = [
      $this->token,
      $lcode,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function add_invoice($lcode, $rid, $header_id = null) {
    $params = [
      $this->token,
      $lcode,
      $rid,
      $header_id,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function fetch_invoices($lcode, $rid) {
    $params = [
      $this->token,
      $lcode,
      $rid,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

}
