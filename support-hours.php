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
 * Version:           1.4
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

function uninstall_support_hours() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-support-hours-uninstaller.php';
	Support_Hours_Uninstaller::uninstall();
}

register_activation_hook( __FILE__, 'activate_support_hours' );
register_deactivation_hook( __FILE__, 'deactivate_support_hours' );
register_uninstall_hook(__FILE__, 'uninstall_support_hours');


function supportHours_plugin_notice() {
	global $current_user;
	$options = get_option('support-hours');
	$class = 'notice notice-warning is-dismissible';
	$first = __( 'Support Hours uses a new system to store hours. Do not forget to input the old hours into the new system. Amount of old hours need to be set:', 'support-hours' );
	$user_id = $current_user->ID;
	if (!get_user_meta($user_id, 'supportHours_plugin_notice_ignore')) { ?>

		<div class="<?php echo $class ?>">
			<p>
				<?php echo $first; ?>
				<?php echo $options['used_hours']; ?>
				<a href="?my-plugin-ignore-notice"><?php _e('I understand. Dismiss this notice.', 'support-hours'); ?></a>
			</p>
		</div>
	<?php }
}
//add_action('admin_notices', 'supportHours_plugin_notice');

function supportHours_plugin_notice_ignore() {
	global $current_user;
	$user_id = $current_user->ID;
	if (isset($_GET['my-plugin-ignore-notice'])) {
		add_user_meta($user_id, 'supportHours_plugin_notice_ignore', 'true', true);
	}
}
add_action('admin_init', 'supportHours_plugin_notice_ignore');

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
