<?php

namespace Support_Hours;

if (!class_exists('WP_List_Table')) {
	require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

class Link_List_Table extends \WP_List_Table
{
	public $plugin_name;

	/**
	 * Constructor, we override the parent to pass our own arguments
	 * We usually focus on three parameters: singular and plural labels, as well as whether the class supports AJAX.
	 */
	function __construct($plugin_name)
	{
		$this->plugin_name = $plugin_name;
		parent::__construct(
			[
				'singular' => 'wp_list_text_link', // Singular label
				'plural' => 'wp_list_test_links', // plural label, also this well be one of the table css class
				'ajax'   => false, // We won't support Ajax for this table
			]
		);
	}

	function extra_tablenav($which)
	{
		if ($which == 'top') {
			// The code that goes before the table is here
			echo "Hello, I'm before the table";
		}
		if ($which == 'bottom') {
			// The code that goes after the table is there
			echo "Hi, I'm after the table";
		}
	}

	/**
	 * Define the columns that are going to be used in the table
	 *
	 * @return array $columns, the array of columns to use with the table
	 */
	function get_columns()
	{
		return $columns = [
			'col_link_id' => __('ID'),
			'col_link_name' => __('Name'),
			'col_link_url' => __('Url'),
			'col_link_description' => __('Description'),
			'col_link_visible' => __('Visible'),
		];
	}

	/**
	 * Decide which columns to activate the sorting functionality on
	 *
	 * @return array $sortable, the array of columns that can be sorted by the user
	 */
	public function get_sortable_columns()
	{
		return $sortable = [
			'col_link_id' => 'link_id',
			'col_link_name' => 'link_name',
			'col_link_visible' => 'link_visible',
		];
	}

	/**
	 * Prepare the table with different parameters, pagination, columns and table elements
	 */
	function prepare_items()
	{
		global $wpdb, $_wp_column_headers;
		$screen = get_current_screen();

		$work_fields = Support_Hours_Admin::$work_fields;

		/*
		-- Ordering parameters -- */
		// Parameters that are going to be used to order the result
		$orderby = !empty($_GET['orderby']) ? \mysql_real_escape_string($_GET['orderby']) : 'ASC';
		$order = !empty($_GET['order']) ? \mysql_real_escape_string($_GET['order']) : 0;

		if (!empty($orderby) & !empty($order)) {
			$query .= ' ORDER BY ' . $orderby . ' ' . $order;
		}

		/*
		-- Pagination parameters -- */
		// Number of elements in your table?
		$totalitems = count($work_fields);
		// How many to display per page?
		$perpage = 5;
		// Which page is this?
		$paged = !empty($_GET['paged']) ? \mysql_real_escape_string($_GET['paged']) : 0;
		// Page Number
		if (empty($paged) || !is_numeric($paged) || $paged <= 0) {
			$paged = 1;
		} //How many pages do we have in total?

		$totalpages = ceil($totalitems / $perpage); // adjust the query to take pagination into account

		if (!empty($paged) && !empty($perpage)) {
			$offset = ($paged - 1) * $perpage;
			$query .= ' LIMIT ' . (int) $offset . ',' . (int) $perpage;
		}
		/* -- Register the pagination -- */
		$this->set_pagination_args(
			[
				'total_items' => $totalitems,
				'total_pages' => $totalpages,
				'per_page' => $perpage,
			]
		);
		// The pagination links are automatically built according to those parameters

		/* -- Register the Columns -- */
		$columns = $this->get_columns();
		$_wp_column_headers[$screen->id] = $columns;

		/* -- Fetch the items -- */
		$this->items = $work_fields;
	}

	function display_rows()
	{

		// Get the records registered in the prepare_items method
		$work_fields = $this->items;
		$name = $this->plugin_name;
		// Get the columns registered in the get_columns and get_sortable_columns methods
		list($columns, $hidden) = $this->get_column_info();
		$user_ID = get_current_user_id();
		$i = 0;
		if ($work_fields) :
			$first = false;
			foreach ($work_fields as $field) {
				include('partials/settings/work-table-fields.php');
				$i++;
			}
		else :
			$first = true;
			include('partials/settings/work-table-fields.php');
		endif;
	}
}
