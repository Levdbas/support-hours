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
      include_once( 'partials/support-hours-admin-widget-workTable.php' );
    endif;
    include_once( 'partials/support-hours-admin-widget-bottomMessage.php' );
    elseif(empty($users) || empty($email)):
      ?>
      <p>
        <a class="button button-primary button-hero load-customize hide-if-no-customize" href="<?php echo admin_url( 'admin.php?page=support-hours-settings' ); ?>">
          <?php _e( 'Configure plugin!', $this->plugin_name); ?>
        </a>
      </p>
    <?php endif; ?>
  </div>
