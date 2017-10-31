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
  <?php
  if(!empty($users) && (!empty($bought_hours) || $bought_hours == '00:00' ) && !empty($email)):
    $user_ID = get_current_user_id();
    $i = 0;

    if ( !empty($workFields[0]['date']) ) :
      include_once( 'partials/support-hours-admin-overview-workTable.php' );
    endif;

    include_once( 'partials/support-hours-admin-widget-bottomMessage.php' );

    elseif(empty($users) || empty($email)):

      include_once( 'partials/support-hours-admin-configure-plugin-notice.php' );
      
    endif; ?>

  </div>
