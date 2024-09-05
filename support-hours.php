<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://basedonline.nl
 * @since             1.0.0
 * @package           Support_Hours
 *
 * @wordpress-plugin
 * Plugin Name:       Support Hours
 * Plugin URI:        https://basedonline.nl
 * Description:       Use Support hours to give yourself and your clients insights on the status of pre-paid work.
 * Version:           2.2.2
 * Author:            Erik van der Bas
 * Author URI:        https://basedonline.nl
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       support-hours
 * Domain Path:       /languages
 */

namespace Support_Hours;

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

define('SH_PLUGIN_DIR_URI', plugin_dir_url(__FILE__));

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-support-hours-activator.php
 */
function activate_support_hours()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-support-hours-activator.php';
	Support_Hours_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-support-hours-deactivator.php
 */
function deactivate_support_hours()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-support-hours-deactivator.php';
	Support_Hours_Deactivator::deactivate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-support-hours-deactivator.php
 */
function remove_support_hours()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-support-hours-uninstaller.php';
	Support_Hours_Uninstaller::uninstall();
}

register_activation_hook(__FILE__, __NAMESPACE__ . '\\activate_support_hours');
register_deactivation_hook(__FILE__, __NAMESPACE__ . '\\deactivate_support_hours');
register_uninstall_hook(__FILE__, __NAMESPACE__ . '\\remove_support_hours');


/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-support-hours.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_support_hours()
{

	$plugin = new Support_Hours();
	$plugin->run();
}
run_support_hours();
