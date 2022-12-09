<?php

/**
 * Provide a page that can be seen from editor to admin. Shows all the time entries.
 *
 * @link       https://basedonline.nl
 * @since      1.4.0
 *
 * @package    Support_Hours
 * @subpackage Support_Hours/admin
 */

namespace Support_Hours;

global $pagenow;

?>
<div class="wrap">
	<h2><?php echo esc_html(get_admin_page_title()); ?></h2>
	<p>
		<?php esc_html_e('A complete overview of all activities.', 'support-hours'); ?>
	</p>
	<?php
	if (!empty($this->managers) && '0' !== $bought_minutes && !empty($this->email)) :
		$current_user_id = get_current_user_id();
		$i = 0;

		if (!empty($work_fields[0]['date'])) :
			?>
			<table class="wp-list-table widefat fixed striped users">
				<thead>
					<tr>
						<th scope="col" class="column-primary"><?php esc_html_e('Date', 'support-hours'); ?></th>
						<th scope="col "><?php esc_html_e('Time', 'support-hours'); ?></th>
						<th scope="col "><?php esc_html_e('Description', 'support-hours'); ?></th>
					</tr>
				</thead>

				<tbody id="the-list" data-wp-lists="list:user">

					<?php
					$widget_fields = $work_fields;
					if ('index.php' == $pagenow) :
						$widget_fields = array_slice($work_fields, -5);
					endif;
					foreach ($widget_fields as $field) {
						?>
						<tr>
							<td class="column-primary">
								<?php
								$format = get_option('date_format');
								if (!empty($field['used'])) {
									echo esc_html(date_i18n($format, strtotime($field['date'])));
								}
								?>
								<button type="button" class="toggle-row"></button>
							</td>
							<td data-colname="<?php esc_html_e('Date', 'support-hours'); ?>">
								<span class="time-type-icon">
									<?php echo ('time-added' == $field['type']) ? '+' : '-'; ?>
								</span>
								<?php
								if (!empty($field['used'])) {
									echo esc_html($field['used']);
								}
								?>
							</td>
							<td data-colname="<?php esc_html_e('Description', 'support-hours'); ?>">
								<?php
								if (!empty($field['description'])) {
									echo esc_html($field['description']);
								}
								?>
							</td>
						</tr>
					<?php } ?>
				</tbody>

				<tfoot>
					<tr>
						<th class="column-primary" scope="col"><?php esc_html_e('Date', 'support-hours'); ?></th>
						<th scope="col"><?php esc_html_e('Time', 'support-hours'); ?></th>
						<th scope="col"><?php esc_html_e('Description', 'support-hours'); ?></th>
					</tr>
				</tfoot>
			</table>

			<div class="tablenav sh-tablenav bottom">
				<div class="total">
					<span class="bold"><?php esc_html_e('Total', 'support-hours'); ?></span>:
					<?php echo esc_html(calculate_hours_and_minutes_output($this->used_minutes)); ?> / <?php echo esc_html(calculate_hours_and_minutes_output($this->bought_minutes)); ?>
				</div>
			</div>
			<?php
		endif;

		include_once('partials/common/bottom-message.php');

	elseif (empty($this->managers) || empty($this->email)) :
		include_once('partials/common/notice-configure.php');

	else :
		include_once('partials/common/notice-no-hours.php');

	endif;
	?>
</div>
