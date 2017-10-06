<?php

/**
* Settings page of Support Hours
*
* @link       http://basedonline.nl
* @since      1.4.0
*
* @package    Support_Hours
* @subpackage Support_Hours/admin
*/
?>
<?php
  $options = get_option($this->plugin_name);
  $bought_hours = $options['bought_hours'];
  $users = $options['users'];
  $email = $options['email'];
  $workFields = $options['workFields'];
  $user_ID = get_current_user_id();
  $i = 0;
?>
<div class="wrap">
  <?php  if (empty($users) || (!empty($users) && in_array($user_ID, $users))) { ?>
    <h2><?php echo esc_html(get_admin_page_title()); ?></h2>
    <form method="post" name="cleanup_options" action="options.php">
      <?php
      settings_fields($this->plugin_name);
      do_settings_sections($this->plugin_name);
      include_once( 'partials/support-hours-admin-settings-textFields.php' );
      include_once( 'partials/support-hours-admin-settings-workTable.php' );
      ?>
    </form>
  <?php } else {?>
    <p>
      <?php _e( 'You do not have access to this page because you are not a Support Hours manager. Please disable and enable this plugin if you need access again.', $this->plugin_name); ?>
    </p>
  <?php } ?>
</div>
