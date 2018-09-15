<?php

/**
 * Fired during plugin activation
 *
 * @link       http://basedonline.nl
 * @since      1.0.0
 *
 * @package    Support_Hours
 * @subpackage Support_Hours/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Support_Hours
 * @subpackage Support_Hours/includes
 * @author     Erik van der Bas <erik@basedonline.nl>
 */
class Support_Hours_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		/*
		function sample_admin_notice__error() {
			$options = get_option($this->plugin_name);
			$class = 'notice notice-warning is-dismissible';
			$first = __( 'Support Hours uses a new system to store hours. Do not forget to input the old hours into the new system. Amount of old hours need to be set:', 'sample-text-domain' );
			?>
			<div class="<?php echo $class ?>">
				<p>
					<?php echo $first; ?>
					<?php echo $options['used_hours']; ?>
				</p>
			</div>
			<?php }
			add_action( 'admin_notices', 'sample_admin_notice__error' );
		*/
	}

}
