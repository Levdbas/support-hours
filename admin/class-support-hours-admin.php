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
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}
	public function options_update()
	{
		register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
	}
	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{
		$current_page = get_current_screen()->base;

		if (in_array($current_page, array('toplevel_page_support-hours', 'support-hours_page_support-hours-settings', 'dashboard'))) :
			wp_enqueue_style($this->plugin_name, plugins_url($this->plugin_name) . '/dist/styles/support-hours-admin.css', array(), $this->version, 'all');
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

		if (in_array($current_page, array('toplevel_page_support-hours', 'support-hours_page_support-hours-settings', 'dashboard'))) :
			wp_enqueue_script($this->plugin_name, plugins_url($this->plugin_name) . '/dist/scripts/support-hours-admin.js', array('jquery'), $this->version, false);
		endif;
	}
	public function add_plugin_admin_menu()
	{

		add_menu_page(
			__('Support Hours overview', $this->plugin_name),
			__('Support Hours', $this->plugin_name),
			'publish_pages',
			'support-hours',
			array($this, 'display_plugin_page'),
			'dashicons-clock'
		);

		add_submenu_page(
			'support-hours',
			__('Support Hours overview', $this->plugin_name),
			__('Overview', $this->plugin_name),
			'publish_pages',
			'support-hours',
			array($this, 'display_plugin_page')
		);

		add_submenu_page(
			'support-hours',
			__('Support Hours settings', $this->plugin_name),
			__('Settings', $this->plugin_name),
			'manage_options',
			'support-hours-settings',
			array($this, 'display_plugin_setup_page')
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
		$settings_link = array(
			'<a href="' . admin_url('admin.php?page=support-hours-settings') . '">' . __('Settings', $this->plugin_name) . '</a>',
		);
		return array_merge($settings_link, $links);
	}
	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */

	public function display_plugin_page()
	{
		include_once('support-hours-admin-functions.php');
		include_once('support-hours-admin-overview.php');
	}
	public function display_plugin_setup_page()
	{
		include_once('support-hours-admin-settings.php');
	}


	public static function support_hours_date_compare($a, $b)
	{
		$t1 = strtotime($a['date']);
		$t2 = strtotime($b['date']);
		return $t1 - $t2;
	}

	public function validate($input)
	{
		$valid = array();
		$valid['users'] = array();

		$valid['email'] = sanitize_email($input['email']);

		if (isset($input['users'])) :
			$valid['users'] = $input['users'];
		endif;

		if (!isset($input['workFields']) || $input['workFields'] == null) {
			$input['workFields'] = null;
		} else {
			usort($input['workFields'], array('Support_Hours_Admin', 'support_hours_date_compare'));
		}

		$valid['workFields'] = $input['workFields'];
		return $valid;
	}


	function support_hours_add_dashboard_widgets()
	{
		if (current_user_can('publish_pages')) {
			wp_add_dashboard_widget(
				'support_hours_dashboard_widget',
				__('Support Hours', $this->plugin_name),
				array($this, 'support_hours_dashboard_widget_function')
			);
			global $wp_meta_boxes;
			$normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];
			$support_hours_dashboard_widget_backup = array('support_hours_dashboard_widget' => $normal_dashboard['support_hours_dashboard_widget']);
			unset($normal_dashboard['support_hours_dashboard_widget']);
			$sorted_dashboard = array_merge($support_hours_dashboard_widget_backup, $normal_dashboard);
			$wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
		}
	}
	function support_hours_dashboard_widget_function()
	{
		include_once('support-hours-admin-functions.php');
		include_once('support-hours-admin-widget.php');
	}
}
