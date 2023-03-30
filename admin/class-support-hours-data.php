<?php

/**
 * Holds the class for generating the admin data.
 *
 * @link       https://basedonline.nl
 * @since      1.0.0
 *
 * @package    Support_Hours
 * @subpackage Support_Hours/admin
 */

namespace Support_Hours;

/**
 * FGenerates the admin data.
 *
 * @package    Support_Hours
 * @subpackage Support_Hours/admin
 * @author     Erik van der Bas <erik@basedonline.nl>
 */
class Support_Hours_Data
{


	/**
	 * Plugin options
	 *
	 * @since    1.7.0
	 * @access   private
	 * @var      string    $this->options    The plugin options saved in the database.
	 */
	private $options;


	/**
	 * Support Hours E-mail address
	 *
	 * @since    1.7.0
	 * @access   private
	 * @var     $email  Email address used to order more hours.
	 */
	private static string $email = '';

	/**
	 * Support Hours Managers
	 *
	 * @since    1.7.0
	 * @access   private
	 * @var      array   $managers  allowed users to manage Support Hours
	 */
	private static $managers;


	/**
	 * Support Hours work_fields
	 *
	 * @since    1.7.0
	 * @access   private
	 * @var      array   $work_fields all work fields
	 */
	private static $work_fields = [];



	/**
	 * Support Hours used_minutes
	 *
	 * @since    1.7.0
	 * @access   private
	 * @var      int   All used minutes
	 */
	private static $total_used_minutes = 0;

	/**
	 * Support Hours bought_minutes
	 *
	 * @since    1.7.0
	 * @access   private
	 * @var      int   All bought minutes
	 */
	private static int $total_bought_minutes = 0;

	/**
	 * Support Hours last_added_time
	 *
	 * @since    1.7.0
	 * @access   private
	 * @var      int   Last added time.
	 */
	private static int $last_added_time = 0;


	/**
	 * Support Hours time_output
	 * Holds all the data for the time output.
	 *
	 * @var array
	 */
	private static array $time_output = [];

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 */
	public function __construct()
	{
		$this->options     = get_option('support-hours');

		if (!empty($this->options['users'])) {
			self::$managers = $this->options['users'];
		}

		if (isset($this->options['email'])) {
			self::$email = $this->options['email'];
		}

		if (!empty($this->options['workFields'])) {

			$first_work_field = $this->options['workFields'][0];

			if (empty($first_work_field['date']) || empty($first_work_field['used'])) {
				return;
			}

			self::$work_fields          = $this->options['workFields'];
			self::$total_used_minutes   = $this->add_time_entries('time-used');
			self::$total_bought_minutes = $this->add_time_entries('time-added');
			self::$last_added_time      = $this->set_last_added_time();
			$this->set_time_output();
		}
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

		if (empty(self::$work_fields)) {
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
			if ('' !== $time['type'] && !empty($time['used'])) {
				list($hour, $minute) = explode(':', $time['used']);
				$minutes += $hour * 60;
				$minutes += $minute;
			}
		}

		return $minutes;
	}

	/**
	 * Sets the last added time.
	 *
	 * @since   2.0.0
	 * @return  int     Returns the last added time in minutes.
	 */
	private function set_last_added_time()
	{
		$minutes = 0;

		if (empty(self::$work_fields)) {
			return $minutes;
		}

		$work_fields_inverted = array_reverse(self::$work_fields);
		$key                  = array_search('time-added', array_column($work_fields_inverted, 'type')); // searching for the last time-added value in key 'type'

		if (false === $key) {
			return $minutes;
		}

		$time                = $work_fields_inverted[$key]['used']; // take our time in HH:MM format from the field
		list($hour, $minute) = explode(':', $time); // explode the time
		$minutes += $hour * 60; // hours to minutes, add them to minutes
		$minutes += $minute; // add minutes to total as well.

		return $minutes;
	}

	/**
	 * Sets the time output.
	 * This is used in the several views to display the time usage.
	 *
	 * @since   2.0.0
	 * @return  void
	 */
	public function set_time_output()
	{
		$bought_time_without_last = self::$total_bought_minutes - self::$last_added_time;
		$leftovers                = $bought_time_without_last - self::$total_used_minutes < 0 ? 0 : $bought_time_without_last - self::$total_used_minutes;
		$remaining_time           = self::$total_bought_minutes - self::$total_used_minutes;
		$bought_minutes_output    = self::$last_added_time + $leftovers;

		$used_minutes_output      = self::$total_used_minutes - $bought_time_without_last;
		$overusage                = self::$total_bought_minutes - self::$total_used_minutes;
		$percentage               = 0;

		if ($leftovers > 0) {
			$used_minutes_output = $bought_time_without_last - self::$total_used_minutes - $leftovers;
		}

		if ($overusage < 0) {
			$used_minutes_output = abs($overusage - self::$last_added_time);
		}

		if (0 !== $used_minutes_output && 0 !== $bought_minutes_output) {
			$percentage = $used_minutes_output * 100 / $bought_minutes_output;
			$percentage = $percentage > 100 ? 100 : $percentage;
			$percentage = floor($percentage);
		}

		$bought_time_in_hours_minutes = $this->convert_minutes_to_hours_minutes($bought_minutes_output);
		$used_time_in_hours_minutes   = $this->convert_minutes_to_hours_minutes($used_minutes_output);
		$text_size = 0 == $used_minutes_output % 60 && $bought_minutes_output < 5940 ? 'big' : 'small';

		self::$time_output = [
			/* 			'debug' => [
				'used_minutes'            => $used_minutes_output,
				'bought_minutes'          => $bought_minutes_output,
				'leftovers'               => $leftovers,
				'remaining_time'          => $remaining_time,
				'last_added_time'         => self::$last_added_time,
				'total_used_minutes'      => self::$total_used_minutes,
				'total_bought_minutes'    => self::$total_bought_minutes,
				'used_time_in_hours'      => $used_time_in_hours_minutes,
				'bought_time_in_hours'    => $bought_time_in_hours_minutes,
				'percentage'              => $percentage,
				'text_size'               => $text_size,
			], */
			'used_time_in_percentage' => $percentage,
			'time_full'               => $used_time_in_hours_minutes . ' / ' . $bought_time_in_hours_minutes,
			'time_total'              => $this->convert_minutes_to_hours_minutes(self::$total_used_minutes) . ' / ' . $this->convert_minutes_to_hours_minutes(self::$total_bought_minutes),
			'time_simplified'         => $this->maybe_hide_minutes($used_minutes_output) . ' / ' . $this->maybe_hide_minutes($bought_minutes_output),
			'stroke_dasharray'        => ($percentage * 352) / 100,
			'text_size'               => $text_size,
		];
	}

	/**
	 * Converts minutes to hours and minutes.
	 *
	 * @since   2.0.0
	 * @param   int $minutes The minutes to convert.
	 * @return  string       Returns the converted time in HH:MM format.
	 */
	private function convert_minutes_to_hours_minutes($minutes)
	{
		$hours = floor($minutes / 60);
		$minutes -= $hours * 60;
		return sprintf('%02d:%02d', $hours, $minutes);
	}

	/**
	 * Used to simplify the time output.
	 *
	 * @param  int $minutes The minutes to convert.
	 * @return string updated time maybe without minutes.
	 */
	private function maybe_hide_minutes($minutes)
	{

		$time = $this->convert_minutes_to_hours_minutes($minutes);

		if (0 == $minutes % 60) :
			$time = $minutes / 60;
		endif;

		return $time;
	}

	/**
	 * Get time output
	 *
	 * @param  string $type The type of time output we want to get.
	 * @throws \Exception   Throws an exception if the type is not found in the time output array.
	 * @return mixed        Returns the time output if found, otherwise throws an exception.
	 */
	public static function get_time_output($type)
	{
		if (!key_exists($type, self::$time_output)) {
			throw new \Exception('Type ' . $type . ' not found in time output array.');
		}

		return self::$time_output[$type];
	}

	/**
	 * Returns the work fields.
	 *
	 * @return array
	 */
	public static function get_workfields()
	{
		return self::$work_fields;
	}

	/**
	 * Returns the e-mail address.
	 *
	 * @return struing
	 */
	public static function get_email()
	{
		return self::$email;
	}

	/**
	 * Returns the managers.
	 *
	 * @return array
	 */
	public static function get_managers()
	{
		return self::$managers;
	}

	/**
	 * Returns the total bought time.
	 *
	 * @return int
	 */
	public static function get_bought_time()
	{
		return self::$total_bought_minutes;
	}
}
