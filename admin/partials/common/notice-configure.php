<?php

namespace Support_Hours;

$message = __('Support Hours is not configured.', 'support-hours');

the_notice($message, 'notice-warning');
?>
<p>
  <a class="button button-primary" href="<?php echo admin_url('admin.php?page=support-hours-settings'); ?>">
	<?php esc_html_e('Configure plugin!', 'support-hours'); ?>
  </a>
</p>
