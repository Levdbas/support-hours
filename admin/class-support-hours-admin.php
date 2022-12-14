<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://basedonline.nl
 * @since      1.0.0
 *
 * @package    Support_Hours
 * @subpackage Support_Hours/admin
 */

namespace Support_Hours;

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Support_Hours
 * @subpackage Support_Hours/admin
 * @author     Erik van der Bas <erik@basedonline.nl>
 */
class Support_Hours_Admin
{




	/**
	 * Register options for plugin and set's up data.
	 * Hooked in class-support-hours.php
	 *
	 * @return void
	 */
	public function admit_init()
	{
		register_setting(Support_Hours::PLUGIN_NAME, 'support-hours', [$this, 'validate']);
		new Support_Hours_Data();
	}

	/**
	 * Register the stylesheets for the admin area.
	 * Hooked in class-support-hours.php
	 *
	 * @return void
	 */
	public function enqueue_styles()
	{
		$current_page = get_current_screen()->base;

		if (in_array($current_page, ['toplevel_page_support-hours', 'support-hours_page_support-hours-settings', 'dashboard'])) :
			wp_enqueue_style(Support_Hours::PLUGIN_NAME, SH_PLUGIN_DIR_URI . 'dist/styles/support-hours-admin.css', [], Support_Hours::VERSION, 'all');
		endif;
	}

	/**
	 * Register the JavaScript for the admin area.
	 * Hooked in class-support-hours.php
	 *
	 * @return void
	 */
	public function enqueue_scripts()
	{
		$current_page = get_current_screen()->base;
		if (in_array($current_page, ['toplevel_page_support-hours', 'support-hours_page_support-hours-settings', 'dashboard'])) :
			wp_enqueue_script(Support_Hours::PLUGIN_NAME, SH_PLUGIN_DIR_URI . 'dist/scripts/support-hours-admin.js', ['jquery'], Support_Hours::VERSION, false);
		endif;
	}

	/**
	 * Add plugin pages to admin menu.
	 * Hooked in class-support-hours.php
	 *
	 * @return void
	 */
	public function add_plugin_admin_menu()
	{

		add_menu_page(
			__('Support Hours overview', 'support-hours'),
			__('Support Hours', 'support-hours'),
			'publish_pages',
			'support-hours',
			[$this, 'display_plugin_page'],
			'dashicons-clock'
		);

		add_submenu_page(
			'support-hours',
			__('Support Hours overview', 'support-hours'),
			__('Overview', 'support-hours'),
			'publish_pages',
			'support-hours',
			[$this, 'display_plugin_page']
		);

		add_submenu_page(
			'support-hours',
			__('Support Hours settings', 'support-hours'),
			__('Settings', 'support-hours'),
			'publish_pages',
			'support-hours-settings',
			[$this, 'display_plugin_setup_page']
		);
	}

	/**
	 * Add settings action link to the plugins page.
	 * Hooked in class-support-hours.php
	 *
	 * @param array $links of plugin.
	 * @return array Updated links.
	 */
	public function add_action_links($links)
	{
		$settings_link = [
			'<a href="' . admin_url('admin.php?page=support-hours-settings') . '">' . __('Settings', 'support-hours') . '</a>',
		];
		return array_merge($settings_link, $links);
	}

	/**
	 * Render the home page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_page()
	{
		include_once 'views/support-hours-admin-overview.php';
	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_setup_page()
	{
		include_once 'views/support-hours-admin-settings.php';
	}

	/**
	 * Helper function to sort entries by date.
	 *
	 * @param  array $a Timeslot a.
	 * @param  array $b Timeslot b.
	 * @return int   Difference between the two dates.
	 */
	public static function date_compare($a, $b)
	{
		$t1 = strtotime($a['date']);
		$t2 = strtotime($b['date']);
		return $t1 - $t2;
	}

	/**
	 * Date convert function.
	 *
	 * Function that converts the dd-mm-yyyy dates stored in the database to yyyy-mm-dd.
	 * This is needed because the date input field only takes dates in yyyy-mm-dd.
	 *
	 * @param array $work_fields The work fields.
	 * @since 1.8
	 * @return array $work_fields validated.
	 */
	public static function date_validation($work_fields)
	{
		foreach ($work_fields as $key => $workfield) {
			if (isset($workfield['date'])) {
				$date = $workfield['date'];
				$d    = \DateTime::createFromFormat('d-m-Y', $date);

				if ($d) {
					$work_fields[$key]['date'] = $d->format('Y-m-d');
				}
			}
		}
		return $work_fields;
	}

	/**
	 * Validates the user input
	 *
	 * @param  array $input The user input.
	 * @return array $input The validated user input.
	 */
	public function validate($input)
	{
		$valid          = [];
		$valid['users'] = [];

		$valid['email'] = sanitize_email($input['email']);

		if (isset($input['users'])) :
			$valid['users'] = $input['users'];
		endif;

		if (!isset($input['workFields']) || null == $input['workFields']) {
			$input['workFields'] = null;
		} else {
			usort($input['workFields'], ['Support_Hours\Support_Hours_Admin', 'date_compare']);
			$input['workFields'] = self::date_validation($input['workFields']);
		}

		$valid['workFields'] = $input['workFields'];

		return $valid;
	}

	/**
	 * Hook into the 'wp_dashboard_setup' action to register the dashboard widget.
	 *
	 * @return void
	 */
	public function add_dashboard_widget()
	{
		if (current_user_can('publish_pages')) {
			add_meta_box(
				'support_hours_dashboard_widget',
				__('Support Hours', 'support-hours'),
				[$this, 'widget_compose'],
				'dashboard',
				'normal',
				'high'
			);
		}
	}

	/**
	 * Creates the widget content.
	 *
	 * @return void
	 */
	public function widget_compose()
	{
		include_once 'views/support-hours-admin-widget.php';
	}


	/**
	 * Echo the notice in html.
	 *
	 * @param  string $message              The message to display.
	 * @param  string $notice_class     The class of the notice.
	 */
	public static function the_notice($message, $notice_class = 'notice-alt')
	{
		$notice = '';
		$notice .= '<div class="warning-message notice support-hours-notice inline ' . $notice_class . '">';
		$notice .= '<p>' . $message . '</p>';
		$notice .= '</div>';

		echo wp_kses_post($notice);
	}
}
