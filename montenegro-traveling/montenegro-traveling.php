<?php

/**
 * Plugin Name:       Montenegro Traveling
 * Plugin URI:        https://wordpress.org/plugins/
 * Description:       Plugin implements montenegro traveling site functional.
 * Version:           1.0.0
 * Author:            Igor Ivanenko
 * Author URI:        https://wordpress.org/plugins/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       montenegro-traveling
 * Domain Path:       /languages

{Plugin Name} is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

{Plugin Name} is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with {Plugin Name}. If not, see {License URI}.
 */

if (!defined('WPINC')) {
  exit;
}

define(CURRENT_PLUGIN_DIR, plugin_dir_path(__FILE__));
define(CURRENT_PLUGIN_URL, plugin_dir_url(__FILE__));
define(PLUGIN_INC, CURRENT_PLUGIN_DIR . 'inc/');
define(PLUGIN_TEXTDOMAIN, CURRENT_PLUGIN_DIR . 'lang/');
define(COMPOSER_LOADER, CURRENT_PLUGIN_DIR . 'vendor/autoload.php');
define(PLUGIN_IMAGES, CURRENT_PLUGIN_URL . 'img/');
define(PLUGIN_CSS, CURRENT_PLUGIN_URL . 'css/');
define(PLUGIN_JS, CURRENT_PLUGIN_URL . 'js/');

function __autoload($class) {
  $classPath = PLUGIN_INC . $class . '.php';
  if (!class_exists($class, false) and file_exists($classPath)) {
    include $classPath;
  }
}

spl_autoload_register('__autoload', false, true);

if (file_exists(COMPOSER_LOADER)) {
  require_once COMPOSER_LOADER;
}

register_activation_hook(__FILE__, array('MT_Main', 'activate'));
register_deactivation_hook(__FILE__, array('MT_Main', 'deactivate'));

MT_Main::run();