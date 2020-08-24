<?php

/**
 * Provide a admin widget for the plugin
 *
 *
 * @link       http://basedonline.nl
 * @since      1.0.0
 *
 * @package    Support_Hours
 * @subpackage Support_Hours/admin
 */

$user_ID = get_current_user_id();
$i = 0;
global $pagenow;
if (!empty($users) && !empty($email) && !empty($workFields[0]['date'])) :
  include_once('partials/widget/widget-clock.php');
  include_once('partials/widget/worktable.php');
  include_once('partials/common/bottom-message.php');
elseif (empty($users) || empty($email)) :
  include_once('partials/common/notice-configure.php');
else :
  include_once('partials/common/notice-no-hours.php');
endif;
