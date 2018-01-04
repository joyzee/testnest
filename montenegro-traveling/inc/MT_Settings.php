<?php

if (!defined('WPINC')) {
  exit;
}

class MT_Settings {

  public static function init() {

    add_action('admin_menu', function () {

      add_menu_page(
        'Montenegro Traveling settings', //название страницы настроек
        'MT Settings', // название пункта меню
        'manage_options', //уровень привлегий(доступа)
        'MT_plugin',  //идентификатор меню настроек
        function () {
          if (!current_user_can('manage_options')) {
            return;
          }
          ?>
          <div class="wrap">
            <?php echo settings_errors() ?>
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            <form action="options.php" method="post">
              <?php
               settings_fields('MT_plugin');
              ?>
              <h2 class="nav-tab-wrapper">
			        <span class="nav-tab nav-tab-active" data-tab="tab-1">General</span>
			        <span class="nav-tab" data-tab="tab-2">Hotel</span>
			        <span class="nav-tab" data-tab="tab-3">Rooms</span>
			        <span class="nav-tab" data-tab="tab-4">Tax</span>
			        </h2>

              <div id="tab-1" class="tab-content">
                <?php echo do_settings_sections('MT_plugin'); ?>
              </div>
              <div id="tab-2" class="tab-content">
                <p>under development</p>
              </div>
              <div id="tab-3" class="tab-content">
                <p>under development</p>
              </div>
              <div id="tab-4" class="tab-content">
                <p>under development</p>
              </div>

              <?php
               submit_button('Save Settings');
              ?>
            </form>
          </div>
          <?php
        }, //функция отриовки страницы настроек
        'dashicons-admin-settings', //иконка
        30 //индекс позиции в меню
       );

    });

    add_action('admin_init', function () {

       register_setting('MT_plugin', 'MT_plugin_settings');

       add_settings_section(
          'MT_plugin_section1', // ид секции
          'Main settings', //название секции
          function ($args) {
             echo '<p class="description">Input wubook credentials.</p>';
          },
          'MT_plugin' //ид меню
       );

       add_settings_field(
          'MT_user_name', //ид опции
          'User name', //название опции
          function ($args) {
            $setting = get_option('MT_plugin_settings');
            echo sprintf('<input type="text" name="MT_plugin_settings[user_name]" id="%s" class="regular-text" value="%s">',
              esc_attr($args['label_for']),
              isset($setting['user_name']) ? esc_attr($setting['user_name']) : '');
          }, //
          'MT_plugin', //ид меню
          'MT_plugin_section1', //ид секции
          ['label_for' => 'MT_user_name']
       );

       add_settings_field(
          'MT_password', //ид опции
          'Password', //название опции
          function ($args) {
            $setting = get_option('MT_plugin_settings');
            echo sprintf('<input type="text" name="MT_plugin_settings[password]" id="%s" class="regular-text" value="%s">',
                esc_attr($args['label_for']),
                isset($setting['password']) ? esc_attr($setting['password']) : '');
          }, //
          'MT_plugin', //ид меню
          'MT_plugin_section1', //ид секции
          ['label_for' => 'MT_password']
      );

      add_settings_field(
          'MT_provider_key', //ид опции
          'Provider key', //название опции
          function ($args) {
            $setting = get_option('MT_plugin_settings');
            echo sprintf('<input type="text" name="MT_plugin_settings[provider_key]" id="%s" class="large-text" value="%s">',
                esc_attr($args['label_for']),
                isset($setting['provider_key']) ? esc_attr($setting['provider_key']) : '');
          }, //
          'MT_plugin', //ид меню
          'MT_plugin_section1', //ид секции
          ['label_for' => 'MT_provider_key']
      );
          
        add_settings_field(
          'MT_lcode', //ид опции
          'Lcode', //название опции
          function ($args) {
            $setting = get_option('MT_plugin_settings');
            echo sprintf('<input type="text" name="MT_plugin_settings[lcode]" id="%s" class="regular-text" value="%s">',
                esc_attr($args['label_for']),
                isset($setting['lcode']) ? esc_attr($setting['lcode']) : '');
          }, //
          'MT_plugin', //ид меню
          'MT_plugin_section1', //ид секции
          ['label_for' => 'MT_lcode']
      );

    });

  }

}