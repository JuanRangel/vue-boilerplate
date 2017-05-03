<?php


/**
 * The plugin bootstrap file
 *
 * @link              http://github.com/vsellis/vsellis-slider
 * @since             1.0.0
 * @package           vsellis-slider
 *
 * @wordpress-plugin
 * Plugin Name:       Vue Boilerplate
 * Plugin URI:        http://github.com/vsellis/vue-boilerplate
 * Description:       The vue-boilerplate plugin.
 * Version:           1.0.0
 * Author:            Vsellis
 * Author URI:        http://vsellis.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       vue-boilerplate
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require plugin_dir_path(__FILE__) . 'inc/VueBoilerplate.php';

function runVueBoilerplate() {
    $plugin = new VueBoilerplate();
}

runVueBoilerplate();