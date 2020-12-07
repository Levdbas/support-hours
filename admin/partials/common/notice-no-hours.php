<?php

namespace Support_Hours;

$message = __('No Support Hours bought yet.', $this->plugin_name);
the_notice($message, 'notice-warning');
?>
<a class="button button-primary" href="mailto:<?php echo $email; ?>'?SUBJECT=<?php _e('Order Support Hours', $this->plugin_name); ?> - <?php echo bloginfo('name'); ?>">
  <?php _e('Order Support Hours', $this->plugin_name); ?>
</a>