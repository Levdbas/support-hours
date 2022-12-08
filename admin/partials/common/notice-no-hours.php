<?php

/**
 * Partial when there are no hours available.
 *
 * @link       https://basedonline.nl
 * @since      1.0.0
 *
 * @package    Support_Hours
 * @subpackage Support_Hours/partials
 */

namespace Support_Hours;

$message = __('No Support Hours bought yet.', 'support-hours');
the_notice($message, 'notice-warning');
?>
<a class="button button-primary" href="mailto:<?php echo esc_attr($this->email); ?>?SUBJECT=<?php esc_html_e('Order Support Hours', 'support-hours'); ?> - <?php echo esc_attr(bloginfo('name')); ?>">
  <?php esc_html_e('Order Support Hours', 'support-hours'); ?>
</a>
