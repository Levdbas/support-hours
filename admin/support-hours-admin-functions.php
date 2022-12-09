<?php

/**
 * Provided helper functuions for the Support Hours plugin
 *
 * @link       https://basedonline.nl
 * @since      1.4.0
 *
 * @package    Support_Hours
 * @subpackage Support_Hours/admin
 */

namespace Support_Hours;

$name          = $this->plugin_name;

$work_fields    = self::$work_fields;
$used_minutes   = self::$total_used_minutes;
$bought_minutes = self::$total_bought_minutes;

/**
 * Echo the notice in html.
 *
 * @param  string $message              The message to display.
 * @param  string $notice_class     The class of the notice.
 */
function the_notice($message, $notice_class = 'notice-alt')
{
	$notice = '';
	$notice .= '<div class="warning-message notice support-hours-notice inline ' . $notice_class . '">';
	$notice .= '<p>' . $message . '</p>';
	$notice .= '</div>';

	echo wp_kses_post($notice);
}
