<?php

namespace Support_Hours;

if (!empty($this->managers) && in_array($user_ID, $this->managers) && !empty($work_fields[0]['date'])) : ?>
  <div class="support-hours-notices">

    <a class="button button-primary" href="<?php echo admin_url('admin.php?page=support-hours-settings'); ?>"><?php esc_html_e('Add new activity', 'support-hours'); ?></a>
    <?php if (count($work_fields) >= 5 && current_user_can('publish_pages') && 'index.php' == $pagenow) : ?>
      <a class="button button-secondary" href="<?php echo admin_url('admin.php?page=support-hours'); ?>"><?php esc_html_e('View all activities', 'support-hours'); ?></a>
    <?php endif; ?>

  <?php elseif (!empty($this->managers) && in_array($user_ID, $this->managers)) :
  if ('admin.php' == $pagenow) :
    $message = __('No activities added yet.', 'support-hours');
    the_notice($message);
  endif; ?>
    <a class="button button-primary" href="<?php echo admin_url('admin.php?page=support-hours-settings'); ?>"><?php esc_html_e('Add first activity', 'support-hours'); ?></a>
  <?php
endif;
if ('index.php' == $pagenow) :
  $percentage = percentage($work_fields, $used_minutes, $bought_minutes);
  $welcome    = __('Hi', 'support-hours') . ' ' . wp_get_current_user()->display_name . ', ';

  if (100 == $percentage) {
    $message = __('your Support Hours are used.', 'support-hours');
    the_notice($welcome . $message, 'notice-error');
  } elseif ($percentage >= 80) {
    $message = __('your Support Hours are almost used.', 'support-hours');
    the_notice($welcome . $message, 'notice-warning');
  } else {
    $message = __('you have plenty of hours left.', 'support-hours');
    the_notice($welcome . $message, 'notice-success');
  } ?>
    <a class="button button-primary" href="mailto:<?php echo $this->email; ?>?SUBJECT=<?php esc_html_e('Order Support Hours', 'support-hours'); ?> - <?php echo bloginfo('name'); ?>"><?php esc_html_e('Order Support Hours', 'support-hours'); ?></a>
  </div>
<?php endif; ?>