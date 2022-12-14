<?php

/**
 * Partial is shown underneath the widget and on the overview page.
 *
 * @link       https://basedonline.nl
 * @since      1.0.0
 *
 * @package    Support_Hours
 * @subpackage Support_Hours/views
 */

namespace Support_Hours;

global $pagenow;
$managers = Support_Hours_Data::get_managers();

$current_user_id = get_current_user_id();
if (!empty($managers) && in_array($current_user_id, $managers) && !empty(Support_Hours_Data::get_workfields())) : ?>
	<div class="support-hours-notices">

		<a class="button button-primary" href="<?php echo esc_attr(admin_url('admin.php?page=support-hours-settings')); ?>"><?php esc_html_e('Add new activity', 'support-hours'); ?></a>
		<?php if (current_user_can('publish_pages') && 'index.php' == $pagenow) : ?>
			<a class="button button-secondary" href="<?php echo esc_attr(admin_url('admin.php?page=support-hours')); ?>"><?php esc_html_e('View all activities', 'support-hours'); ?></a>
		<?php endif; ?>

	<?php
elseif (!empty($managers) && in_array($current_user_id, $managers)) :
	if ('admin.php' == $pagenow) :
		$message = __('No activities added yet.', 'support-hours');
		Support_Hours_Admin::the_notice($message);
	endif;
	?>
		<a class="button button-primary" href="<?php echo esc_attr(admin_url('admin.php?page=support-hours-settings')); ?>"><?php esc_html_e('Add first activity', 'support-hours'); ?></a>
	<?php
endif;
	?>

	<?php
	if ('index.php' == $pagenow) {

		$percentage = Support_Hours_Data::get_time_output('used_time_in_percentage');
		$welcome    = __('Hi', 'support-hours') . ' ' . wp_get_current_user()->display_name . ', ';

		if (100 == $percentage) {
			$message = __('your Support Hours are used.', 'support-hours');
			Support_Hours_Admin::the_notice($welcome . $message, 'notice-error');
		} elseif ($percentage >= 80) {
			$message = __('your Support Hours are almost used.', 'support-hours');
			Support_Hours_Admin::the_notice($welcome . $message, 'notice-warning');
		} else {
			$message = __('you have plenty of hours left.', 'support-hours');
			Support_Hours_Admin::the_notice($welcome . $message, 'notice-success');
		}
	?>
		<a class="button button-primary" href="mailto:<?php echo esc_attr(Support_Hours_Data::get_email()); ?>?SUBJECT=<?php esc_html_e('Order Support Hours', 'support-hours'); ?> - <?php echo esc_attr(bloginfo('name')); ?>"><?php esc_html_e('Order Support Hours', 'support-hours'); ?></a>

	<?php } ?>
	</div>