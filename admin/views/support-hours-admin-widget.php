<?php

/**
 * Provide an admin widget for the plugin
 *
 * @link       https://basedonline.nl
 * @since      1.0.0
 *
 * @package    Support_Hours
 * @subpackage Support_Hours/admin
 */

namespace Support_Hours;

$mail = Support_Hours_Data::get_email();
$managers = Support_Hours_Data::get_managers();

if (!empty($managers) && !empty($mail) && !empty(Support_Hours_Data::get_workfields())) :
	include_once('widget/widget-clock.php');
	include_once('widget/worktable.php');
	include_once('common/bottom-message.php');
elseif (empty($managers) || empty($mail)) :
	include_once('common/notice-configure.php');
else :
	include_once('common/notice-no-hours.php');
endif;
