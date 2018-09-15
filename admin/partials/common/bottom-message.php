<?php if(!empty($users) && in_array($user_ID, $users) && !empty($workFields[0]['date'])): ?>
<div class="support-hours-notices">

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
    $welcome  =   __('Hi '). wp_get_current_user()->display_name . ', ';
    $closeing = '<span class="screen-reader-text">(opens in a new window)</span>';
    $closeing .= '<a class="support-hours-mail" href="mailto:'. $email.'?SUBJECT='. __('Support hours', $this->plugin_name).'">';
    $closeing .= '<span aria-hidden="true" class="dashicons dashicons-email"></span>';
    $closeing .= $email;
    $closeing .=' </a>';
    ?>
  </p>
  <?php  if($percentage == 100) {?>
      <div class="update-message notice inline notice-error notice-alt">
      <p>
      <?php
      echo $welcome;
       _e( 'your Support hours are used. <br /> If you need more support hours you can get in contact via', $this->plugin_name);
       echo ' '.$closeing;
        ?>
     </p>
     </div>
    <?php } elseif($percentage >= 80) {?>
      <div class="warning-message notice inline notice-warning notice-alt">
      <p>
        <?php
          echo $welcome;
         _e( 'your Support hours are almost used.<br /> If you need more support hours you can get in contact via', $this->plugin_name);
         echo ' '.$closeing;
         ?>
       </p>
       </div>
    <?php } else {?>
      <div class="update-message notice inline notice-alt updated-message notice-success">
      <p>
        <?php
          echo $welcome;
         _e( "you have plenty of hours left, but you can always get in contact via", $this->plugin_name);
         echo ' '.$closeing;
          ?>
      </p>
      </div>
    <?php } ?>

</div>
<?php endif; ?>
