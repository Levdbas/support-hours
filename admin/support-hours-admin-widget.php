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
if(!empty($users) && !empty($email)):

  include_once( 'partials/widgets/widget-clock.php' );

  if ( !empty($workFields[0]['date']) ) :

    include_once( 'partials/common/worktable.php' );

  endif;

  include_once( 'partials/common/bottom-message.php' );

  elseif(empty($users) || empty($email) || $bought_minutes == '0'):

    include_once( 'partials/common/configure-plugin-notice.php' );

  else: ?>

  <div class="warning-message notice support-hours-notice inline notice-warning notice-alt">
    <p><?php _e( 'No Support Hours bought yet.', $this->plugin_name); ?></p>
  </div>
  <a class="button button-primary"  href="mailto:<?php echo $email; ?>'?SUBJECT=<?php  _e('Order Support Hours', $this->plugin_name); ?> - <?php echo bloginfo('name'); ?>">
    <?php _e('Order Support Hours', $this->plugin_name); ?>
  </a>

<?php endif; ?>
