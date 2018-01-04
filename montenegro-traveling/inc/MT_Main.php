<?php

if (!defined('WPINC')) {
  exit;
}

class MT_Main {

  public static function run() {

    add_action('plugins_loaded', function () {
      load_plugin_textdomain('montenegro-traveling', false, PLUGIN_TEXTDOMAIN);
    });

    add_action('wp_enqueue_scripts', [__CLASS__, 'enqueue_scripts']);

    add_action('admin_enqueue_scripts', [__CLASS__, 'enqueue_scripts']);

    MT_Settings::init();
    MT_AJAX::init();
    MT_Hotel::init();
    MT_Room::init();


  }

  public static function enqueue_scripts() {
    $admin = current_action() === 'admin_enqueue_scripts';
//    wp_enqueue_style('jquery-ui-css', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
//    wp_enqueue_style('style-plugin-css', 'https://www.w3schools.com/w3css/4/w3.css');
//    wp_enqueue_style('style-open-sans-font', 'https://fonts.googleapis.com/css?family=Open+Sans');
//    wp_enqueue_style('style-material-icons', 'https://fonts.googleapis.com/icon?family=Material+Icons');
//    wp_enqueue_style('style-font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
    if ($admin) {
      wp_enqueue_style('mt-plugin-admin-css', PLUGIN_CSS . 'admin.css');
    }
    if (!$admin) {
      wp_enqueue_script('jquery');
    }
    if ($admin) {
      wp_enqueue_script('mt-plugin-admin-js', PLUGIN_JS . 'admin.js');
    }
    if (!$admin) {
      wp_enqueue_script('mt-plugin-front-js', PLUGIN_JS . 'front.js');
    }
  }

  public static function activate($network_wide) {
    
  }

  public static function deactivate($network_wide) {
    flush_rewrite_rules();
  }

}
