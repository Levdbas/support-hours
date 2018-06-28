<?php if(!empty($users) && in_array($user_ID, $users) && !empty($workFields[0]['date'])): ?>

  <a class="waves-effect waves-light btn" href="<?php echo admin_url( 'admin.php?page=support-hours-settings' ); ?>"><?php _e('Add new activity', $this->plugin_name); ?></a>

  <?php if($i >= 5 && current_user_can('publish_pages')): ?>
    <a class="button button-secondary" href="<?php echo admin_url( 'admin.php?page=support-hours' ); ?>"><?php _e('View all acitivities', $this->plugin_name); ?></a>
  <?php endif; ?>

<?php elseif(!empty($users) && in_array($user_ID, $users)):  ?>

  <a class="button button-secondary" href="<?php echo admin_url( 'admin.php?page=support-hours-settings' ); ?>"><?php _e('Add first acitivity', $this->plugin_name); ?></a>

<?php endif; ?>
<?php if ($pagenow == 'index.php'):
  $percentage = widget_output($workFields, $used_hours, $bought_hours, 'percentage');
  ?>
<p>
  <?php if($percentage == 100) {?>
    <?php _e( 'Support hours used.', $this->plugin_name); ?><br />
  <?php } elseif($percentage >= 80) {?>
    <?php _e( 'Support hours almost used', $this->plugin_name); ?>.<br />
  <?php } else {?>
    <?php _e( 'Need more support hours', $this->plugin_name); ?>?<br />
  <?php } ?>
  <?php _e( 'Contact me via', $this->plugin_name); ?>
  <span class="screen-reader-text">(opens in a new window)</span>
  <a href="mailto:<?php echo $email;?>">
    <span aria-hidden="true" class="dashicons dashicons-email"></span>
    <?php echo $email;?>
  </a>
</p>
<?php endif; ?>
