<?php

namespace Support_Hours;

?>
<?php if ($workFields) : ?>
  <div class="support-hours-time-table">
	<h3>
	  <?php
		if ($pagenow == 'index.php') :
			_e('Last five activities:', $this->plugin_name);
	  else :
		  _e('Activities:', $this->plugin_name);
	  endif;
		?>
	</h3>

	<table class="worktable" width="100%">
	  <thead>
		<tr class="row-head">
		  <th width="30%"><?php _e('Date', $this->plugin_name); ?></th>
		  <th width="20%"><?php _e('Time', $this->plugin_name); ?></th>
		  <th width="50%"><?php _e('Description', $this->plugin_name); ?></th>
		</tr>
	  </thead>
	  <tbody>
		<?php
		$widget_fields = array_slice($workFields, -5);
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
					echo $field['used'];}
				?>
			</td>
			<td>
			<?php
			if (!empty($field['used'])) {
				echo $field['description'];}
			?>
			</td>
		  </tr>
		<?php } ?>
	  </tbody>
	</table>
	<div class="total">
	  <span class="bold"><?php _e('Total', $this->plugin_name); ?></span>:
	  <?php echo calculate_hours_and_minutes_output($this->used_minutes); ?> / <?php echo calculate_hours_and_minutes_output($this->bought_minutes); ?>
	</div>
  </div>
<?php endif; ?>
