<?php

if (!empty($users) && in_array($user_ID, $users) && !empty($workFields[0]['date'])) : ?>
  <div class="support-hours-notices">

    <a class="button button-primary" href="<?php echo admin_url('admin.php?page=support-hours-settings'); ?>"><?php _e('Add new activity', $this->plugin_name); ?></a>
    <?php if (count($workFields) >= 5 && current_user_can('publish_pages') && $pagenow == 'index.php') : ?>
      <a class="button button-secondary" href="<?php echo admin_url('admin.php?page=support-hours'); ?>"><?php _e('View all activities', $this->plugin_name); ?></a>
    <?php endif; ?>

  <?php elseif (!empty($users) && in_array($user_ID, $users)) :
  if ($pagenow == 'admin.php') :
    $message = __('No activities added yet.', $this->plugin_name);
    sh_the_notice($message);
  endif; ?>
    <a class="button button-primary" href="<?php echo admin_url('admin.php?page=support-hours-settings'); ?>"><?php _e('Add first activity', $this->plugin_name); ?></a>
  <?php
endif;
if ($pagenow == 'index.php') :
  $percentage = percentage($workFields, $used_minutes, $bought_minutes);
  $welcome  =   __('Hi', $this->plugin_name) . ' ' . wp_get_current_user()->display_name . ', ';

  if ($percentage == 100) {
    $message = __('your Support Hours are used.', $this->plugin_name);
    sh_the_notice($welcome . $message);
  } elseif ($percentage >= 80) {
    $message = __('your Support Hours are almost used.', $this->plugin_name);
    sh_the_notice($welcome . $message);
  } else {
    $message = __('you have plenty of hours left.', $this->plugin_name);
    sh_the_notice($welcome . $message, 'notice-success');
  } ?>
    <a class="button button-primary" href="mailto:<?php echo $email; ?>'?SUBJECT=<?php _e('Order Support Hours', $this->plugin_name); ?> - <?php echo bloginfo('name'); ?>"><?php _e('Order Support Hours', $this->plugin_name); ?></a>
  </div>
<?php endif; ?>