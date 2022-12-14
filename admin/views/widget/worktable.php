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

$total = Support_Hours_Data::get_time_output('time_full');

?>
<?php if (Support_Hours_Data::get_workfields()) : ?>
	<div class="support-hours-time-table">
		<h3>
			<?php
			esc_html_e('Last five activities:', 'support-hours');
			?>
		</h3>

		<table class="worktable" width="100%">


			<thead>
				<tr class="row-head">
					<th class="column-primary" width="30%"><?php esc_html_e('Date', 'support-hours'); ?></th>
					<th width="20%"><?php esc_html_e('Time', 'support-hours'); ?></th>
					<th width="50%"><?php esc_html_e('Description', 'support-hours'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$entries = array_slice(Support_Hours_Data::get_workfields(), -5);
				$format = get_option('date_format');
				foreach ($entries as $entry) {
				?>
					<tr>
						<td class="column-primary">
							<?php

							if (!empty($entry['used'])) {
								echo esc_html(date_i18n($format, strtotime($entry['date'])));
							}
							?>

						</td>
						<td>
							<span class="time-type-icon">
								<?php echo ('time-added' == $entry['type']) ? '+' : '-'; ?>
							</span>
							<?php
							if (!empty($entry['used'])) {
								echo esc_html($entry['used']);
							}
							?>
						</td>
						<td>
							<?php
							if (!empty($entry['used'])) {
								echo esc_html($entry['description']);
							}
							?>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
		<div class="total">
			<span class="bold"><?php esc_html_e('Total', 'support-hours'); ?></span>:
			<?php echo esc_html($total); ?>
		</div>
	</div>
<?php endif; ?>