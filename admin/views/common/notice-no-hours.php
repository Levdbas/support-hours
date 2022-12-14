<?php

/**
 * Partial when there are no hours available.
 *
 * @link       https://basedonline.nl
 * @since      1.0.0
 *
 * @package    Support_Hours
 * @subpackage Support_Hours/views
 */

namespace Support_Hours;

$message = __('No Support Hours bought yet.', 'support-hours');
Support_Hours_Admin::the_notice($message, 'notice-warning');
?>
<a class="button button-primary" href="mailto:<?php echo esc_attr(Support_Hours_Data::get_email()); ?>?SUBJECT=<?php esc_html_e('Order Support Hours', 'support-hours'); ?> - <?php echo esc_attr(bloginfo('name')); ?>">
  <?php esc_html_e('Order Support Hours', 'support-hours'); ?>
</a>