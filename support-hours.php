<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://basedonline.nl
 * @since             1.0.0
 * @package           Support_Hours
 *
 * @wordpress-plugin
 * Plugin Name:       Support Hours
 * Plugin URI:        http://basedonline.nl
 * Description:       The support-hours plugin can be used to give your customers insight on the status of their pre-paid support hours.
 * Version:           1.2.1
 * Author:            Erik van der Bas
 * Author URI:        http://basedonline.nl
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       support-hours
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-support-hours-activator.php
 */
function activate_support_hours() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-support-hours-activator.php';
	Support_Hours_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-support-hours-deactivator.php
 */
function deactivate_support_hours() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-support-hours-deactivator.php';
	Support_Hours_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_support_hours' );
register_deactivation_hook( __FILE__, 'deactivate_support_hours' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-support-hours.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_support_hours() {

	$plugin = new Support_Hours();
	$plugin->run();

}
run_support_hours();
