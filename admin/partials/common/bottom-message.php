<?php if(!empty($users) && in_array($user_ID, $users) && !empty($workFields[0]['date'])): ?>
  <div class="support-hours-notices">

    <a class="button button-primary" href="<?php echo admin_url( 'admin.php?page=support-hours-settings' ); ?>"><?php _e('Add new activity', $this->plugin_name); ?></a>

    <?php if($i >= 5 && current_user_can('publish_pages')): ?>
      <a class="button button-secondary" href="<?php echo admin_url( 'admin.php?page=support-hours' ); ?>"><?php _e('View all activities', $this->plugin_name); ?></a>
    <?php endif; ?>

  <?php elseif(!empty($users) && in_array($user_ID, $users)):  ?>
    <?php if ($pagenow == 'admin.php'): ?>
      <div class="warning-message notice inline notice-warning notice-alt">
        <p><?php _e( 'No activities added yet.', $this->plugin_name); ?></p>
      </div>
    <?php endif; ?>
    <a class="button button-primary" href="<?php echo admin_url( 'admin.php?page=support-hours-settings' ); ?>"><?php _e('Add first activity', $this->plugin_name); ?></a>
    <?php
  endif;
  if ($pagenow == 'index.php'):
    $percentage = percentage($used_minutes, $bought_minutes);
    ?>
    <p>
      <?php
      $welcome  =   __('Hi', $this->plugin_name).' '. wp_get_current_user()->display_name . ', ';
      ?>
    </p>
    <?php  if($percentage == 100) {?>
      <div class="warning-message notice inline notice-error notice-alt">
        <p>
          <?php
          echo $welcome;
          _e( 'your Support Hours are used.', $this->plugin_name);
          ?>
        </p>
      </div>
    <?php } elseif($percentage >= 80) {?>
      <div class="warning-message notice inline notice-warning notice-alt">
        <p>
          <?php
          echo $welcome;
          _e( 'your Support Hours are almost used.', $this->plugin_name);
          ?>
        </p>
      </div>
    <?php } else {?>
      <div class="warning-message notice inline notice-alt notice-message notice-success">
        <p>
          <?php
          echo $welcome;
          _e( "you have plenty of hours left.", $this->plugin_name);
          ?>
        </p>
      </div>
    <?php } ?>
    <a class="button button-primary"  href="mailto:<?php echo $email; ?>'?SUBJECT=<?php  _e('Order Support Hours', $this->plugin_name); ?> - <?php echo bloginfo('name'); ?>"><?php _e('Order Support Hours', $this->plugin_name); ?></a>
  </div>
<?php endif; ?>
