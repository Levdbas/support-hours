<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://basedonline.nl
 * @since      1.0.0
 *
 * @package    Support_Hours
 * @subpackage Support_Hours/includes
 */

namespace Support_Hours;

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Support_Hours
 * @subpackage Support_Hours/includes
 * @author     Erik van der Bas <erik@basedonline.nl>
 */
class Support_Hours_Deactivator
{

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate()
	{
		// Get entire array
		$options = get_option('support-hours');
		// Alter the options array appropriately
		$options['users'] = '';
		// Update entire array
		update_option('support-hours', $options);
	}
}
