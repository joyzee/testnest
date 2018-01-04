<?php

use wubook\WubookClientExeption;

if (!defined('WPINC')) {
  exit;
}

class MT_AJAX {
  
  public static function add_ajax($action, callable $fn) {
    add_action('wp_ajax_' . $action, function () use ($fn) {
      check_ajax_referer(NONCE_KEY, 'jxnonce', true);
      wp_send_json($fn());
    });
    add_action('wp_ajax_nopriv_' . $action, function () use ($fn) {
      check_ajax_referer(NONCE_KEY, 'jxnonce', true);
      wp_send_json($fn());
    });
  }
  
  public static function ajax_prep() {
    add_action('wp_enqueue_scripts', [__CLASS__, 'enqueue_scripts']);
    add_action('admin_enqueue_scripts', [__CLASS__, 'enqueue_scripts']);
  }
  
  public static function enqueue_scripts () {
    wp_enqueue_script('mt-plugin-ajax-js', PLUGIN_JS . 'ajax.js', [], false, true);
    wp_localize_script('mt-plugin-ajax-js', '$jx', [
      'ajaxurl' => admin_url('admin-ajax.php'),
      'jxnonce' => wp_create_nonce(NONCE_KEY),
    ]);
  }

  public static function init() {
    self::ajax_prep();
    self::add_ajax('wubook', function () {
      $apis = [
        'wired' => 'wubook\WubookWiredClient',
        'zak' => 'wubook\WubookZakClient',
      ];
      $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
      $api = $post['api'];
      $class = isset($apis[$api]) ? $apis[$api] : null;
      $method = $post['method'];
      $data = $post['data'];
      $class_exist = class_exists($class, true);
      $method_exist = is_callable([$class, $method]);
      $resp['errorno'] = 0;
      $resp['errormsg'] = '';
      $resp['data'] = null;
      $opt = get_option('MT_plugin_settings');
      try {
        if ($class_exist and $method_exist) {
          $client = new  $class($opt['user_name'], $opt['password'], $opt['provider_key']);
          $client->acquire_token();
          call_user_func_array([$client, $method], $data);
          $resp['data'] = $client->getArrayResult()[1];
        } else {
          $resp['errorno'] = -1;
          $resp['errormsg'] = sprintf('Method: "%s" or API: "%s" not exist', $method, $api);
        }
      } catch (WubookClientExeption $e) {
          $resp['errorno'] = $e->getCode();
          $resp['errormsg'] = $e->getMessage();
      }
      return $resp;    
    });
  }

}