<?php

/**
 * Provide a page that can be seen from editor to admin. Shows all the time entries.
 *
 * @link       http://basedonline.nl
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
					if ($pagenow == 'index.php') :
						$widget_fields = array_slice($work_fields, -5);
					endif;
					foreach ($widget_fields as $field) {
						?>
						<tr>
							<td>
								<?php
								$format = get_option('date_format');
								if (!empty($field['used'])) {
									echo date_i18n($format, strtotime($field['date']));
								}
								?>
							</td>
							<td>
								<span class="time-type-icon">
									<?php echo ($field['type'] == 'time-added') ? '+' : '-'; ?>
								</span>
								<?php
								if (!empty($field['used'])) {
									echo $field['used'];
								}
								?>
							</td>
							<td>
								<?php
								if (!empty($field['used'])) {
									echo $field['description'];
								}
								?>
							</td>
						</tr>
					<?php } ?>
				</tbody>

				<tfoot>
					<tr>
						<th scope="col column-primary"><?php esc_html_e('Date', 'support-hours'); ?></th>
						<th scope="col column-primary"><?php esc_html_e('Time', 'support-hours'); ?></th>
						<th scope="col column-primary"><?php esc_html_e('Description', 'support-hours'); ?></th>
					</tr>
				</tfoot>
			</table>

			<div class="tablenav sh-tablenav bottom">
				<div class="total">
					<span class="bold"><?php esc_html_e('Total', 'support-hours'); ?></span>:
					<?php echo calculate_hours_and_minutes_output($this->used_minutes); ?> / <?php echo calculate_hours_and_minutes_output($this->bought_minutes); ?>
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
