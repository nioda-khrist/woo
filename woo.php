<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              woo.com
 * @since             1.0.0
 * @package           Woo
 *
 * @wordpress-plugin
 * Plugin Name:       woo
 * Plugin URI:        woo
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            woo
 * Author URI:        woo.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woo
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WOO_VERSION', '1.0.0' );

// create constant to create path to the main url
define( 'WOO_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// create absolute path of the folder
define( 'WOO_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woo-activator.php
 */
function activate_woo() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo-activator.php';
	// create a new instance of a class
	$activator = new Woo_Activator();
	// with this new instance . activate the function
	$activator->activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woo-deactivator.php
 */
function deactivate_woo() {
	// import the file
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo-activator.php';
	// create a new instance of the class
	$activator = new Woo_Activator();

	// import the file 
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo-deactivator.php';
	// create a new instance of the class with the activator class parameter
	$deactivator = new Woo_Deactivator($activator);
	// call the activate function
	$deactivator->deactivate();
}

register_activation_hook( __FILE__, 'activate_woo' );
register_deactivation_hook( __FILE__, 'deactivate_woo' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-woo.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_woo() {

	$plugin = new Woo();
	$plugin->run();

}
run_woo();
