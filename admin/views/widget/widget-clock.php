<?php

/**
 * Widget for the dashboard.
 *
 * @link       https://basedonline.nl
 * @since      1.0.0
 *
 * @package    Support_Hours
 * @subpackage Support_Hours/views
 */

namespace Support_Hours;

$percentage = Support_Hours_Data::get_time_output('used_time_in_percentage');
$stroke  = Support_Hours_Data::get_time_output('stroke_dasharray');
$modifier = Support_Hours_Data::get_time_output('text_size');
?>
<style>
	body {
		--sh-stroke: <?php echo esc_attr($stroke); ?>;
	}
</style>
<div class="sh-gauge" role="heading" aria-level="2" data-percent="<?php echo esc_attr($percentage); ?>">
	<a href="<?php echo esc_attr(admin_url('admin.php?page=support-hours')); ?>" class="sh-gauge__wrapper sh-gauge__wrapper--average">
		<div class="sh-gauge__svg-wrapper">
			<svg viewBox="0 0 120 120" class="sh-gauge__svg">
				<circle class="sh-gauge__base" r="56" cx="60" cy="60"></circle>
				<circle class="sh-gauge__arc" stroke="#d2d3d4" transform="rotate(-90 60 60)" r="56" cx="60" cy="60" data-stroke="<?php echo esc_attr($stroke); ?>"></circle>
				<line class="sh-gauge__overlay" x1="60" y1="60" x2="60" y2="60"></line>
			</svg>
		</div>
		<div class="sh-gauge__percentage">
			<span class="sh-gauge__text sh-gauge__text--<?php echo esc_html($modifier); ?>">
				<?php echo esc_html(Support_Hours_Data::get_time_output('time_simplified')); ?>
				<br class="smallbr" />
				<?php esc_html_e('hours', 'support-hours'); ?>
				<br class='bigbr' />
				<?php esc_html_e('used', 'support-hours'); ?>
			</span>
		</div>
	</a>
</div>