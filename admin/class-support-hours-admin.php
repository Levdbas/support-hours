<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://basedonline.nl
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
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Plugin options
	 *
	 * @since    1.7.0
	 * @access   private
	 * @var      string    $this->options    The plugin options saved in the database.
	 */
	private $options;

	/**
	 * Support Hours Managers
	 *
	 * @since    1.7.0
	 * @access   private
	 * @var      array   $managers  allowed users to manage Support Hours
	 */
	private $managers;

	/**
	 * Support Hours E-mail address
	 *
	 * @since    1.7.0
	 * @access   private
	 * @var     $email  Email address used to order more hours.
	 */
	private $email = false;

	/**
	 * Support Hours work_fields
	 *
	 * @since    1.7.0
	 * @access   private
	 * @var      string   $work_fields all work fields
	 */
	public static $work_fields = [];

	/**
	 * Support Hours used_minutes
	 *
	 * @since    1.7.0
	 * @access   private
	 * @var      int   All used minutes
	 */
	private $used_minutes = 0;

	/**
	 * Support Hours bought_minutes
	 *
	 * @since    1.7.0
	 * @access   private
	 * @var      int   All bought minutes
	 */
	private $bought_minutes = 0;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
		$this->options     = get_option($plugin_name);

		if (!empty($this->options['users'])) {
			$this->managers = $this->options['users'];
		}

		if (isset($this->options['email'])) {
			$this->email = $this->options['email'];
		}

		if (isset($this->options['workFields'])) {
			self::$work_fields    = $this->options['workFields'];
			$this->used_minutes   = $this->add_time_entries('time-used');
			$this->bought_minutes = $this->add_time_entries('time-added');
			self::$work_fields    = self::date_validation(self::$work_fields);
		}
	}

	public function options_update()
	{
		register_setting($this->plugin_name, 'support-hours', [$this, 'validate']);
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{
		$current_page = get_current_screen()->base;

		if (in_array($current_page, ['toplevel_page_support-hours', 'support-hours_page_support-hours-settings', 'dashboard'])) :
			wp_enqueue_style($this->plugin_name, SH_PLUGIN_DIR_URI . 'dist/styles/support-hours-admin.css', [], $this->version, 'all');
		endif;
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{
		$current_page = get_current_screen()->base;

		if (in_array($current_page, ['toplevel_page_support-hours', 'support-hours_page_support-hours-settings', 'dashboard'])) :
			wp_enqueue_script($this->plugin_name, SH_PLUGIN_DIR_URI . 'dist/scripts/support-hours-admin.js', ['jquery'], $this->version, false);
		endif;
	}

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

		add_submenu_page(
			'support-hours',
			__('Support Hours test', 'support-hours'),
			__('Settings', 'support-hours'),
			'publish_pages',
			'support-hours-test',
			[$this, 'display_plugin_table']
		);
	}

	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */
	public function add_action_links($links)
	{
		/*
		*  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
		*/
		$settings_link = [
			'<a href="' . admin_url('admin.php?page=support-hours-settings') . '">' . __('Settings', 'support-hours') . '</a>',
		];
		return array_merge($settings_link, $links);
	}
	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */

	public function display_plugin_page()
	{
		include_once 'support-hours-admin-functions.php';
		include_once 'support-hours-admin-overview.php';
	}

	public function display_plugin_table()
	{
		$wp_list_table = new Link_List_Table($this->plugin_name);
		$wp_list_table->prepare_items();
		$wp_list_table->display();
	}

	public function display_plugin_setup_page()
	{
		include_once 'support-hours-admin-settings.php';
	}

	public static function date_compare($a, $b)
	{
		$t1 = strtotime($a['date']);
		$t2 = strtotime($b['date']);
		return $t1 - $t2;
	}

	/**
	 * Date convert function.
	 *
	 * Function that converts the dd-mm-yyyy dates stored in the database to yyyy-mm-dd
	 * This is needed because the date input field only takes dates in yyyy-mm-dd
	 *
	 * @param array $work_fields
	 * @since 1.8
	 * @return void
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
		include_once 'support-hours-admin-functions.php';
		include_once 'support-hours-admin-widget.php';
	}

	/**
	 * Checks the workfields array for the time fields. Adds all timefields and returns them.
	 * If no workfields and therefore no time fields are filled, returns 00:00
	 *
	 * @since   1.4
	 * @param   string $type          Can be used or bought.
	 * @return  string                Returns full hours format or total minutes of used or bought hours.
	 */
	private function add_time_entries($type)
	{
		$minutes = 0;

		if (null == self::$work_fields) {
			return $minutes;
		}

		if (!isset(self::$work_fields[0]['type'])) {
			return $minutes;
		}

		$filtered_fields = array_filter(
			self::$work_fields,
			function ($var) use ($type) {
				return ($var['type'] == $type);
			}
		);

		foreach ($filtered_fields as $time) {
			if ('' !== $time['type']) {
				list($hour, $minute) = explode(':', $time['used']);
				$minutes += $hour * 60;
				$minutes += $minute;
			}
		}

		return $minutes;
	}
}
