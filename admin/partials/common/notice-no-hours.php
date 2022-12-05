<?php

namespace Support_Hours;

$message = __('No Support Hours bought yet.', 'support-hours');
the_notice($message, 'notice-warning');
?>
<a class="button button-primary" href="mailto:<?php echo $this->email; ?>?SUBJECT=<?php _e('Order Support Hours', 'support-hours'); ?> - <?php echo bloginfo('name'); ?>">
  <?php _e('Order Support Hours', 'support-hours'); ?>
</a>
