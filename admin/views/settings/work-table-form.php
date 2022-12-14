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

?>

<fieldset>
	<span class="currentDate"><?php echo esc_html(date_i18n('d-m-Y')); ?></span>
	<table id="repeatable-fieldset-one" class="worktable wp-list-table widefat fixed striped table-view-list pages">

		<thead>
			<tr class="row-head">

				<th class="support-hours-col col-type column-primary"><?php esc_html_e('Type', 'support-hours'); ?></th>
				<th class="support-hours-col col-date"><?php esc_html_e('Date', 'support-hours'); ?></th>
				<th class="support-hours-col col-time"><?php esc_html_e('Time', 'support-hours'); ?></th>
				<th class="support-hours-col col-description"><?php esc_html_e('Description', 'support-hours'); ?></th>
				<th width="50px"></th>
			</tr>
		</thead>

		<tbody>
			<?php
			if (Support_Hours_Data::get_workfields()) {
				$first = false;
				foreach (Support_Hours_Data::get_workfields() as $field) {
					include('work-table-fields.php');
					$i++;
				}
			} else {
				$first = true;
				include('work-table-fields.php');
			}
			?>
		</tbody>
	</table>
	<p><em><?php esc_html_e('Activities will be sorted by date on save', 'support-hours'); ?>.</em></p>
	<a href="#" class="repeat button button-secondary">
		<?php esc_html_e('Add activity', 'support-hours'); ?>
	</a>
	<?php submit_button(__('Save', 'support-hours'), 'primary', 'submit', true); ?>
</fieldset>