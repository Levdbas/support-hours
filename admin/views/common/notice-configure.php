<?php

/**
 * Partial when the plugin is not configured.
 *
 * @link       https://basedonline.nl
 * @since      1.0.0
 *
 * @package    Support_Hours
 * @subpackage Support_Hours/views
 */

namespace Support_Hours;

$message = __('Support Hours is not configured.', 'support-hours');

Support_Hours_Admin::the_notice($message, 'notice-warning');
?>
<p>
  <a class="button button-primary" href="<?php echo esc_attr(admin_url('admin.php?page=support-hours-settings')); ?>">
    <?php esc_html_e('Configure plugin', 'support-hours'); ?>
  </a>
</p>