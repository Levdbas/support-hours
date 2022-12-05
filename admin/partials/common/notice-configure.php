<?php

namespace Support_Hours;

$message = __('Support Hours is not configured.', $this->plugin_name);

the_notice($message, 'notice-warning');
?>
<p>
  <a class="button button-primary" href="<?php echo admin_url('admin.php?page=support-hours-settings'); ?>">
    <?php _e('Configure plugin!', $this->plugin_name); ?>
  </a>
</p>