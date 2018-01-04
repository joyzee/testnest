<?php
namespace wubook;

class WubookWiredClient extends WubookClient {

  const XMLRPCURL = 'https://wubook.net/xrws/';
  const ROOM_TYPE_ROOM = 1;
  const ROOM_TYPE_APARTMENT = 2;
  const ROOM_TYPE_BEDS_NUMBER = 3;
  const ROOM_TYPE_BEDS = 4;
  const ROOM_TYPE_BUNGALOW = 5;
  const ROOM_TYPE_TENT = 6;
  const ROOM_TYPE_VILLA = 7;
  const ROOM_TYPE_CHALET = 8;
  const BOARD_TYPE_BREAKFAST = 'bb';
  const BOARD_TYPE_FULL_BOARD = 'fb';
  const BOARD_TYPE_HALF_BOARD = 'hb';
  const BOARD_TYPE_NO_BOARD = 'nb';
  const BOARD_TYPE_ALL_INCLUSIVE = 'ai';
  const DTYPE_STATIC_INCREASE = 2;
  const DTYPE_PERCENTAGE_INCREASE = 1;
  const DTYPE_PERCENTAGE_DECREASE = -1;
  const DTYPE_STATIC_DECREASE = -2;
  const POLICY_SHOW_CLAUSES_TOO = 0;
  const POLICY_SHOW_ONLY_RULE = 1;
  const POLICY_SHOW_ONLY_CLAUSES = 2;
  const POLICY_TYPE_FIRST_NIGHT = 1;
  const POLICY_TYPE_AMOUNT_PERCENTAGE = 2;
  const POLICY_TYPE_FIRST_NIGHT_AND_PERCENTAGE = 3;
  const POLICY_TYPE_NO_PENALTY = 4;
  const POLICY_TYPE_ENTIRE_AMOUNT = 5;
  const POLICY_TYPE_NOT_REFUNDABLE_SOFT = 6;
  const POLICY_TYPE_NOT_REFUNDABLE_HARD = 7;

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
// Room functions +-
//*********************

  public function fetch_rooms($lcode, $ancillary = 0) {
    $params = [
      $this->token,
      $lcode,
      $ancillary = 0,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function new_room($lcode, $woodoo, $name, $beds, $defprice, $avail, $shortname, $defboard, $names = null, $descriptions = null, $boards = null, $rtype = null, $min_price = null, $max_price = null) {
    $params = [
      $this->token,
      $lcode,
      $woodoo,
      $name,
      $beds,
      $defprice,
      $avail,
      $shortname,
      $defboard,
      $names,
      $descriptions,
      $boards,
      $rtype,
      $min_price,
      $max_price,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function new_virtual_room($lcode, $rid, $woodoo, $name, $beds, $children, $defprice, $shortname, $defboard, $names = null, $descriptions = null, $boards = null, $dec_avail = null, $min_price = null, $max_price = null) {
    $params = [
      $this->token,
      $lcode,
      $rid,
      $woodoo,
      $name,
      $beds,
      $children,
      $defprice,
      $shortname,
      $defboard,
      $names,
      $descriptions,
      $boards,
      $dec_avail,
      $min_price,
      $max_price,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function mod_room($lcode, $rid, $name, $beds, $defprice, $avail, $shortname, $defboard, $names = null, $descriptions = null, $boards = null, $min_price = null, $max_price = null, $rtype = null, $woodoo_only = null) {
    $params = [
      $this->token,
      $lcode,
      $rid,
      $name,
      $beds,
      $defprice,
      $avail,
      $shortname,
      $defboard,
      $names,
      $descriptions,
      $boards,
      $min_price,
      $max_price,
      $rtype,
      $woodoo_only,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function mod_virtual_room($lcode, $rid, $name, $beds, $children, $defprice, $short, $defboard, $names = null, $descriptions = null, $boards = null, $dec_avail = null, $min_price = null, $max_price = null, $woodoo_only = null) {
    $params = [
      $this->token,
      $lcode,
      $rid,
      $name,
      $beds,
      $children,
      $defprice,
      $short,
      $defboard,
      $names,
      $descriptions,
      $boards,
      $dec_avail,
      $min_price,
      $max_price,
      $woodoo_only,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function del_room($lcode, $rid) {
    $params = [
      $this->token,
      $lcode,
      $rid,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function room_images($lcode, $rid) {
    $params = [
      $this->token,
      $lcode,
      $rid,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function push_update_activation($lcode, $url = '') {
    $params = [
      $this->token,
      $lcode,
      $url,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function push_update_url($lcode) {
    $params = [
      $this->token,
      $lcode,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

//*********************
//Availability function +
//*********************
  public function update_avail($lcode, $dfrom, $rooms) {
    $params = [
      $this->token,
      $lcode,
      $dfrom,
      $rooms,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function update_sparse_avail($lcode, $rooms) {
    $params = [
      $this->token,
      $lcode,
      $rooms,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function fetch_rooms_values($lcode, $dfrom, $dto, $rooms = null) {
    $params = [
      $this->token,
      $lcode,
      $dfrom,
      $dto,
      $rooms,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

//*********************
//Prices function
//*********************

  public function add_pricing_plan($lcode, $name, $daily = 1) {
    $params = [
      $this->token,
      $lcode,
      $name,
      $daily,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function add_vplan($lcode, $name, $pid, $dtype, $value) {
    $params = [
      $this->token,
      $lcode,
      $name,
      $pid,
      $dtype,
      $value,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function del_plan($lcode, $pid) {
    $params = [
      $this->token,
      $lcode,
      $pid,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function update_plan_name($lcode, $pid, $name) {
    $params = [
      $this->token,
      $lcode,
      $pid,
      $name,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function get_pricing_plans($lcode) {
    $params = [
      $this->token,
      $lcode,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function update_plan_rack($lcode, $pid, $rack) {
    $params = [
      $this->token,
      $lcode,
      $pid,
      $rack,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function mod_vplans($lcode, $plans) {
    $params = [
      $this->token,
      $lcode,
      $plans,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function update_plan_prices($lcode, $pid, $dfrom, $prices) {
    $params = [
      $this->token,
      $lcode,
      $pid,
      $dfrom,
      $prices,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function fetch_plan_prices($lcode, $pid, $dfrom, $dto, $rooms = []) {
    $params = [
      $this->token,
      $lcode,
      $pid,
      $dfrom,
      $dto,
      $rooms,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function convert_to_daily_plan($lcode, $pid) {
    $params = [
      $this->token,
      $lcode,
      $pid,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function update_plan_periods($lcode, $pid, $periods) {
    $params = [
      $this->token,
      $lcode,
      $pid,
      $periods,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function delete_periods($lcode, $pid, $delperiods) {
    $params = [
      $this->token,
      $lcode,
      $pid,
      $delperiods,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

//*********************  
// Restriction functions +-
//*********************

  public function rplan_add_rplan($lcode, $name, $compact) {
    $params = [
      $this->token,
      $lcode,
      $name,
      $compact,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function rplan_rplans($lcode) {
    $params = [
      $this->token,
      $lcode,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function rplan_del_rplan($lcode, $rpid) {
    $params = [
      $this->token,
      $lcode,
      $rpid,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function rplan_rename_rplan($lcode, $rpid, $name) {
    $params = [
      $this->token,
      $lcode,
      $rpid,
      $name,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function rplan_update_rplan_rules($lcode, $pid, $rules) {
    $params = [
      $this->token,
      $lcode,
      $pid,
      $rules,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function rplan_update_rplan_values($lcode, $pid, $dfrom, $values) {
    $params = [
      $this->token,
      $lcode,
      $pid,
      $dfrom,
      $values,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function rplan_get_rplan_values($lcode, $dfrom, $dto, $rpids = []) {
    $params = [
      $this->token,
      $lcode,
      $dfrom,
      $dto,
      $rpids,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

//*********************
//Reservation functions +-
//********************* 

  public function push_activation($lcode, $url, $test = 0) {
    $params = [
      $this->token,
      $lcode,
      $url,
      $test,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function push_url($lcode) {
    $params = [
      $this->token,
      $lcode,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function fetch_new_bookings($lcode, $ancillary = 0, $mark = 1) {
    $params = [
      $this->token,
      $lcode,
      $ancillary,
      $mark,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function mark_bookings($lcode, $reservations = []) {
    $params = [
      $this->token,
      $lcode,
      $reservations,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function fetch_bookings($lcode, $dfromv = null, $dto = null, $oncreated = 1, $ancillary = 0) {
    $params = [
      $this->token,
      $lcode,
      $dfromv,
      $dto,
      $oncreated,
      $ancillary,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function fetch_bookings_codes($lcode, $dfrom, $dto, $oncreated = 1) {
    $params = [
      $this->token,
      $lcode,
      $dfrom,
      $dto,
      $oncreated,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function fetch_booking($lcode, $rcode, $ancillary = 0) {
    $params = [
      $this->token,
      $lcode,
      $rcode,
      $ancillary,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function get_fount_symbols() {
    $params = [
      $this->token,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

//*********************
//Channel functions 
//*********************  

  public function get_channels_info() {
    $params = [
      $this->token,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function get_otas($lcode) {
    $params = [
      $this->token,
      $lcode,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function tag_ota($lcode, $chid, $tag) {
    $params = [
      $this->token,
      $lcode,
      $chid,
      $tag,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function new_ota($lcode, $ctype, $tag) {
    $params = [
      $this->token,
      $lcode,
      $ctype,
      $tag,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function ota_running($lcode, $chid) {
    $params = [
      $this->token,
      $lcode,
      $chid,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function fetch_rsrv_errors($lcode) {
    $params = [
      $this->token,
      $lcode,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function bcom_start_procedure($lcode, $chid, $bhid) {
    $params = [
      $this->token,
      $lcode,
      $chid, 
      $bhid,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function bcom_confirm_activation($lcode, $chid) {
    $params = [
      $this->token,
      $lcode,
      $chid,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function bcom_init_channel($lcode, $chid, $currency) {
    $params = [
      $this->token,
      $lcode,
      $chid, 
      $currency,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function bcom_rooms_rates($lcode, $chid) {
    $params = [
      $this->token,
      $lcode,
      $chid
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function bcom_set_room_mapping($lcode, $chid, $rmap, $singlemap) {
    $params = [
      $this->token,
      $lcode,
      $chid, 
      $rmap, 
      $singlemap,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function bcom_set_rate_mapping($lcode, $chid, $rmap) {
    $params = [
      $this->token,
      $lcode,
      $chid, 
      $rmap,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function bcom_read_allotments($lcode, $chid, $dfrom, $days) {
    $params = [
      $this->token,
      $lcode,
      $chid, 
      $dfrom, 
      $days,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function bcom_notify_noshow($lcode, $rcode) {
    $params = [
      $this->token,
      $lcode,
      $rcode,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function bcom_notify_invalid_cc($lcode, $rcode) {
    $params = [
      $this->token,
      $lcode,
      $rcode,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function exp_start_procedure($lcode, $chid, $ehid) {
    $params = [
      $this->token,
      $lcode,
      $chid, 
      $ehid,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function exp_vat_models() {
    $params = [
      $this->token,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function exp_init_channel($lcode, $chid, $currency, $fee, $vat_taxes) {
    $params = [
      $this->token,
      $lcode,
      $chid, 
      $currency, 
      $fee, 
      $vat_taxes,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function exp_rooms_rates($lcode, $chid) {
    $params = [
      $this->token,
      $lcode,
      $chid,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function exp_set_room_mapping($lcode, $chid, $rmap, $allots) {
    $params = [
      $this->token,
      $lcode,
      $chid, 
      $rmap, 
      $allots,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function exp_set_rate_mapping($lcode, $chid, $rmap) {
    $params = [
      $this->token,
      $lcode,
      $chid, 
      $rmap,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function exp_set_preferences($lcode, $chid, $hct, $minstay_error_behaviour, $minstay_type, $last_rate) {
    $params = [
      $this->token,
      $lcode,
      $chid, 
      $hct, 
      $minstay_error_behaviour, 
      $minstay_type, 
      $last_rate,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function woodoo_suspended_commands($lcode) {
    $params = [
      $this->token,
      $lcode,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function woodoo_executed_commands($lcode, $day, $id_channel = false) {
    $params = [
      $this->token,
      $lcode,
      $day, 
      $id_channel,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function woodoo_cancel_suspended($lcode, $trackings) {
    $params = [
      $this->token,
      $lcode,
      $trackings,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function woodoo_relaunch_suspended($lcode, $trackings) {
    $params = [
      $this->token,
      $lcode,
      $trackings,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function last_room_channels($lcode, $up_channels) {
    $params = [
      $this->token,
      $lcode,
      $up_channels,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function woodoo_basic_yield($lcode, $up_channels) {
    $params = [
      $this->token,
      $lcode,
      $up_channels,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

//*********************
//Policies functions +-
//*********************  
  /**
   * 
   * @param int $lcode
   * @param int $ancillary
   */
  public function fetch_policies($lcode, $ancillary = 0) {
    $params = [
      $this->token,
      $lcode,
      $ancillary,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function new_policy($lcode, $name, $pshow, $ptype, $value = null, $days = null, $descrs = []) {

    $params = [
      $this->token,
      $lcode,
      $name,
      $pshow,
      $ptype,
      $value,
      $days,
      $descrs,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function mod_policy($lcode, $pid, $name, $pshow, $ptype, $value = null, $days = null, $descrs = []) {
    $params = [
      $this->token,
      $lcode,
      $pid,
      $name,
      $pshow,
      $ptype,
      $value,
      $days,
      $descrs,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function del_policy($lcode, $pid) {
    $params = [
      $this->token,
      $lcode,
      $pid,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function fetch_policy_calendar($lcode, $dfrom, $dto) {
    $params = [
      $this->token,
      $lcode,
      $dfrom,
      $dto,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function set_policy_calendar($lcode, $pid, $dfrom, $dto) {
    $params = [
      $this->token,
      $lcode,
      $pid,
      $dfrom,
      $dto,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

//*********************
//Extras functions +-
//********************* 

  public function fetch_opportunities($lcode, $dfrom, $dto, $ancillary = 0) {
    $params = [
      $this->token,
      $lcode,
      $dfrom,
      $dto,
      $ancillary,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function new_opportunity($lcode, $name, $active, $perday, $extra, $price, $how, $dfrom, $dto, $wdays = [], $rooms = [], $names = [], $descrs = []) {
    $params = [
      $this->token,
      $lcode,
      $name, 
      $active, 
      $perday, 
      $extra, 
      $price, 
      $how, 
      $dfrom, 
      $dto, 
      $wdays, 
      $rooms, 
      $names, 
      $descrs,
    ];
    $this->send_request(__FUNCTION__, $params);    
  }

  public function mod_opportunity($lcode, $oid, $name, $active, $perday, $extra, $price, $how, $dfrom, $dto, $wdays, $rooms, $names, $descrs) {
    $params = [
      $this->token,
      $lcode,
      $oid, 
      $name, 
      $active, 
      $perday, 
      $extra, 
      $price, 
      $how, 
      $dfrom, 
      $dto, 
      $wdays, 
      $rooms, 
      $names, 
      $descrs,
    ];
    $this->send_request(__FUNCTION__, $params);    
  }

  public function del_opportunity($lcode, $oid) {
    $params = [
      $this->token,
      $lcode,
      $oid,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function fetch_soffers($lcode, $dfrom, $dto, $ancillary = 0) {
    $params = [
      $this->token,
      $lcode,
      $dfrom,
      $dto,
      $ancillary,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function new_soffer($lcode, $name, $ddp, $id_policy, $dtype, $dvalue, $apply_to, $guarantee, $deposit, $dfrom, $dto, $wdays, $wdays_type, $must_advance, $max_advance, $must_stay, $max_stay, $must_rooms, $must_opps, $must_type, $nations = [], $periods = [], $names = [], $descrs = [], $rplan = null) {
    $params = [
      $this->token,
      $lcode,
      $name, 
      $ddp, 
      $id_policy, 
      $dtype, 
      $dvalue, 
      $apply_to, 
      $guarantee, 
      $deposit, 
      $dfrom, 
      $dto, 
      $wdays, 
      $wdays_type, 
      $must_advance, 
      $max_advance, 
      $must_stay, 
      $max_stay, 
      $must_rooms, 
      $must_opps, 
      $must_type, 
      $nations, 
      $periods, 
      $names, 
      $descrs, 
      $rplan,
    ];
    $this->send_request(__FUNCTION__, $params);    
  }

  public function mod_soffer($lcode, $sid, $name = null, $ddp = null, $id_policy = null, $dtype = null, $dvalue = null, $apply_to = null, $guarantee = null, $deposit = null, $dfrom = null, $dto = null, $wdays = null, $wdays_type = null, $must_advance = null, $max_advance = null, $must_stay = null, $max_stay = null, $must_rooms = null, $must_opps = null, $must_type = null, $nations = null, $periods = null, $names = [], $descrs = [], $rplan = null) {
    $params = [
      $this->token,
      $lcode,
      $sid, 
      $name, 
      $ddp, 
      $id_policy, 
      $dtype, 
      $dvalue, 
      $apply_to, 
      $guarantee, 
      $deposit, 
      $dfrom, 
      $dto, 
      $wdays, 
      $wdays_type, 
      $must_advance, 
      $max_advance, 
      $must_stay, 
      $max_stay, 
      $must_rooms, 
      $must_opps, 
      $must_type, 
      $nations, 
      $periods, 
      $names, 
      $descrs, 
      $rplan,
    ];
    $this->send_request(__FUNCTION__, $params);    
  }

  public function del_soffer($lcode, $sid) {
    $params = [
      $this->token,
      $lcode,
      $sid
    ];
    $this->send_request(__FUNCTION__, $params);
  }

//*********************
//Transaction functions +
//*********************  

  public function balance_transactions() {
    $params = [
      $this->token,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function balance_details($transaction_id) {
    $params = [
      $this->token,
      $transaction_id,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

//*********************
//Corporate functions +-
//*********************

  public function corporate_fetch_accounts($acode = '') {
    $params = [
      $this->token,
      $acode,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function corporate_get_providers_info($acodes = []) {
    $params = [
      $this->token,
      $acodes,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function corporate_fetch_channels($lcode) {
    $params = [
      $this->token,
      $lcode,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function corporate_get_channels($filters) {
    $params = [
      $this->token,
      $filters,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function corporate_fetchable_properties() {
    $params = [
      $this->token,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function corporate_new_property($lodg, $woodoo_only, $acode) {
    $params = [
      $this->token,
      $lodg,
      $woodoo_only,
      $acode,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function corporate_new_account_and_property($lodg, $woodoo_only, $account) {
    $params = [
      $this->token,
      $lodg,
      $woodoo_only,
      $account,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function corporate_renew_booking($lcode, $months, $pretend = 1) {
    $params = [
      $this->token,
      $lcode,
      $months,
      $pretend,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function corporate_renew_channels($lcode, $channels, $pretend = 1) {
    $params = [
      $this->token,
      $lcode,
      $channels,
      $pretend,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function corporate_set_autorenew_wb($lcode, $v) {
    $params = [
      $this->token,
      $lcode,
      $v,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function corporate_set_autorenew_wo($lcode, $lchans, $v) {
    $params = [
      $this->token,
      $lcode,
      $lchans,
      $v,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function corporate_balance_transactions() {
    $params = [
      $this->token,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

  public function corporate_balance_details($transaction_id) {
    $params = [
      $this->token,
      $transaction_id,
    ];
    $this->send_request(__FUNCTION__, $params);
  }

}
