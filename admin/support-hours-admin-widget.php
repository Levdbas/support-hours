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

if(!empty($users) && (!empty($bought_minutes) || $bought_minutes == '0' ) && !empty($email)):

  include_once( 'partials/widgets/widget-clock.php' );

  if ( !empty($workFields[0]['date']) ) :

    include_once( 'partials/widgets/widget-worktable.php' );

  endif;

  include_once( 'partials/common/bottom-message.php' );

  elseif(empty($users) || empty($email)):

    include_once( 'partials/common/configure-plugin-notice.php' );

  else: ?>

    <h4>
      <?php _e( 'No support Hours bought', $this->plugin_name); ?>.
    </h4>
    <p>
      <?php _e( 'Contact me via', $this->plugin_name); ?> <a href="mailto:<?php echo $email;?>"><?php echo $email;?></a>
    </p>

  <?php endif; ?>
