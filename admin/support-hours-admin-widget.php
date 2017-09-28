<?php

/**
* Provide a admin area view for the plugin
*
* This file is used to markup the admin-facing aspects of the plugin.
*
* @link       http://basedonline.nl
* @since      1.0.0
*
* @package    Support_Hours
* @subpackage Support_Hours/admin/partials
*/

if(!empty($users) && !empty($bought_hours)):
  $user_ID = get_current_user_id();
  include_once( 'partials/support-hours-admin-widget-clock.php' );
  include_once( 'partials/support-hours-admin-widget-hourTable.php' );
  include_once( 'partials/support-hours-admin-widget-bottomMessage.php' );
elseif(empty($users)):
?>

  <p>
    <a class="button button-primary button-hero load-customize hide-if-no-customize" href="<?php echo admin_url( 'admin.php?page=support-hours-settings' ); ?>">
      <?php _e( 'Configure plugin!', $this->plugin_name); ?>
    </a>
  </p>

<?php else: ?>

  <h4>
    <?php _e( 'No support Hours bought', $this->plugin_name); ?>.
  </h4>
  <p>
    <?php _e( 'Contact me via', $this->plugin_name); ?> <a href="mailto:<?php echo $email;?>"><?php echo $email;?></a>
  </p>

<?php endif; ?>
