<?php

/**
 * Partial for the work tabel fields
 *
 * @link       https://basedonline.nl
 * @since      1.0.0
 *
 * @package    Support_Hours
 * @subpackage Support_Hours/views
 */

?>
<tr class="repeating" data-number="<?php echo esc_attr($i); ?>">

	<td class="column-primary">

		<fieldset class="type-switch">
			<label for="<?php echo esc_attr($name); ?>[workFields][<?php echo esc_attr($i); ?>][type][used]">
				<?php $time_used_checked = (isset($field['type']) && 'time-used' == $field['type']) ? 'checked="checked"' : ''; ?>
				<input id="<?php echo esc_attr($name); ?>[workFields][<?php echo esc_attr($i); ?>][type][used]" <?php echo false == $first ? 'required' : ''; ?> type="radio" class="radio time-used" value="time-used" name="<?php echo esc_attr($name); ?>[workFields][<?php echo esc_attr($i); ?>][type]" <?php echo esc_attr($time_used_checked); ?>>
				<span><?php esc_html_e('Time used', 'support-hours'); ?></span>
			</label>

			<label for="<?php echo esc_attr($name); ?>[workFields][<?php echo esc_attr($i); ?>][type][added]">
				<?php $time_added_checked = isset($field['type']) && 'time-added' == $field['type'] || true == $first ? 'checked="checked"' : ''; ?>
				<input id="<?php echo esc_attr($name); ?>[workFields][<?php echo esc_attr($i); ?>][type][added]" type="radio" class="radio time-added" value="time-added" name="<?php echo esc_attr($name); ?>[workFields][<?php echo esc_attr($i); ?>][type]" <?php echo esc_attr($time_added_checked); ?>>
				<span><?php esc_html_e('Time added', 'support-hours'); ?></span>
			</label>
		</fieldset>
		<button type="button" class="toggle-row"></button>
	</td>

	<td data-th="<?php esc_html_e('Date', 'support-hours'); ?>" data-colname="<?php esc_html_e('Date', 'support-hours'); ?>">
		<?php $date_value = !empty($field['date']) ? $field['date'] : ''; ?>
		<input type="date" <?php echo false == $first ? 'required' : ''; ?> class="regular-text date validate sh-datepicker" id="<?php echo esc_attr($name); ?>-workFields-date" name="<?php echo esc_attr($name); ?>[workFields][<?php echo esc_attr($i); ?>][date]" value="<?php echo esc_attr($date_value); ?>" />
	</td>

	<td data-th="<?php esc_html_e('Time', 'support-hours'); ?>" data-colname="<?php esc_html_e('Time', 'support-hours'); ?>">
		<?php $used_value = !empty($field['used']) ? $field['used'] : ''; ?>
		<input type="time" placeholder="00:00" class="regular-text time validate" id="<?php echo esc_attr($name); ?>-workFields-used" name="<?php echo esc_attr($name); ?>[workFields][<?php echo esc_attr($i); ?>][used]" <?php echo false == $first ? 'required' : ''; ?> value="<?php echo esc_attr($used_value); ?>" />
	</td>

	<td data-th="<?php esc_html_e('Description', 'support-hours'); ?>" data-colname="<?php esc_html_e('Description', 'support-hours'); ?>">
		<?php $description_value = !empty($field['description']) ? $field['description'] : ''; ?>
		<input type="text" <?php echo false == $first ? 'required' : ''; ?> placeholder="<?php esc_html_e('Description of the activity', 'support-hours'); ?>" class="regular-text description validate" id="<?php echo esc_attr($name); ?>-workFields-description" name="<?php echo esc_attr($name); ?>[workFields][<?php echo esc_attr($i); ?>][description]" value="<?php echo esc_attr($description_value); ?>" />
	</td>
	<td class="remove">
		<a class="remove-item remove-row"><span class="dashicons dashicons-trash"></span></a>
	</td>
</tr>