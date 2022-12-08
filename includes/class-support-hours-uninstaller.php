<?php

/**
 * Fired during plugin removal
 *
 * @link       https://basedonline.nl
 * @since      1.0.0
 *
 * @package    Support_Hours
 * @subpackage Support_Hours/includes
 */

namespace Support_Hours;

/**
 * Fired during plugin removal.
 *
 * This class defines all code necessary to run during the plugin's removal.
 *
 * @since      1.0.0
 * @package    Support_Hours
 * @subpackage Support_Hours/includes
 * @author     Erik van der Bas <erik@basedonline.nl>
 */
class Support_Hours_Uninstaller
{

	/**
	 * Remove option.
	 *
	 * Remove plugin option on removal of plugin.
	 *
	 * @since    1.7.0
	 */
	public static function uninstall()
	{
		$option = get_option('support-hours');
		delete_option($option);
	}
}
