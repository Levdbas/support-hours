<?php

namespace Support_Hours;

?>
<?php if ($work_fields) : ?>
	<div class="support-hours-time-table">
		<h3>
			<?php
			if ($pagenow == 'index.php') :
				esc_html_e('Last five activities:', 'support-hours');
			else :
				esc_html_e('Activities:', 'support-hours');
			endif;
			?>
		</h3>

		<table class="worktable" width="100%">
			<thead>
				<tr class="row-head">
					<th width="30%"><?php esc_html_e('Date', 'support-hours'); ?></th>
					<th width="20%"><?php esc_html_e('Time', 'support-hours'); ?></th>
					<th width="50%"><?php esc_html_e('Description', 'support-hours'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$widget_fields = array_slice($work_fields, -5);
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
		</table>
		<div class="total">
			<span class="bold"><?php esc_html_e('Total', 'support-hours'); ?></span>:
			<?php echo calculate_hours_and_minutes_output($this->used_minutes); ?> / <?php echo calculate_hours_and_minutes_output($this->bought_minutes); ?>
		</div>
	</div>
<?php endif; ?>
