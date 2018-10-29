<?php

/**
* Provide a page that can be seen from editor to admin. Shows all the time entries.
*
* @link       http://basedonline.nl
* @since      1.4.0
*
* @package    Support_Hours
* @subpackage Support_Hours/admin
*/
global $pagenow;
?>
<div class="wrap">
  <h2><?php echo esc_html(get_admin_page_title()); ?></h2>
  <p>
    <?php  _e( 'A complete overview of all activities.', $this->plugin_name); ?>
  </p>
  <?php
  if(!empty($users) && $bought_minutes !== '0' && !empty($email)):
    $user_ID = get_current_user_id();
    $i = 0;

    if ( !empty($workFields[0]['date']) ) :
      include_once( 'partials/common/worktable.php' );
    endif;

    include_once( 'partials/common/bottom-message.php' );

    elseif(empty($users) || empty($email)):
      include_once( 'partials/common/notice-configure.php' );

    else:
      include_once( 'partials/common/notice-no-hours.php' );

    endif;
?>
  </div>
