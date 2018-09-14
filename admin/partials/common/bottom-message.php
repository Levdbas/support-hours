<?php if(!empty($users) && in_array($user_ID, $users) && !empty($workFields[0]['date'])): ?>

  <a class="button button-primary" href="<?php echo admin_url( 'admin.php?page=support-hours-settings' ); ?>"><?php _e('Add new activity', $this->plugin_name); ?></a>

  <?php if($i >= 5 && current_user_can('publish_pages')): ?>
    <a class="button button-secondary" href="<?php echo admin_url( 'admin.php?page=support-hours' ); ?>"><?php _e('View all acitivities', $this->plugin_name); ?></a>
  <?php endif; ?>

<?php elseif(!empty($users) && in_array($user_ID, $users)):  ?>
  <?php if ($pagenow == 'admin.php'): ?>
    <h1 class="support-hours-notice"><?php _e( 'No time entries added.', $this->plugin_name); ?></h1>
  <?php endif; ?>
  <a class="button button-secondary" href="<?php echo admin_url( 'admin.php?page=support-hours-settings' ); ?>"><?php _e('Add first acitivity', $this->plugin_name); ?></a>
<?php
 endif;
if ($pagenow == 'index.php'):
  $percentage = percentage($used_minutes, $bought_minutes);
  ?>
<p>
  <?php
  $welcome = __('Hi ').wp_get_current_user()->display_name . ', ';
  if($percentage == 100) {?>
    <p class="support-hours-notice support-hours-notice--warning">
    <?php
    echo $welcome;
     _e( 'your Support hours are used.', $this->plugin_name); ?><br />
    </p>
  <?php } elseif($percentage >= 80) {?>
    <p class="support-hours-notice support-hours-notice--notice">
      <?php
      echo $welcome;
       _e( 'your Support hours are almost used', $this->plugin_name); ?>.
    </p>
  <?php } else {?>
    <p class="support-hours-notice support-hours-notice--normal">
    <?php
      echo $welcome;
     _e( "you have plenty of hours left!", $this->plugin_name); ?>
    </p>
  <?php } ?>
  <?php _e( 'Get in contact via', $this->plugin_name); ?>
  <span class="screen-reader-text">(opens in a new window)</span>
  <a href="mailto:<?php echo $email;?>?SUBJECT=<?php _e('Support hours', $this->plugin_name) ?>">
    <span aria-hidden="true" class="dashicons dashicons-email"></span>
    <?php echo $email;?>
  </a>
</p>
<?php endif; ?>
