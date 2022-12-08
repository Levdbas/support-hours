<?php

/**
 * Partial for the settigns page.
 *
 * @link       https://basedonline.nl
 * @since      1.0.0
 *
 * @package    Support_Hours
 * @subpackage Support_Hours/partials
 */

?>
<fieldset>
	<h3><?php esc_html_e('Select Support Hours managers', 'support-hours'); ?>:</h3>
	<?php
	$administrators = get_users('orderby=nicename&role=administrator');
	foreach ($administrators as $administrator) {
		?>
		<label for="<?php echo esc_attr($name); ?>[users<?php echo esc_attr($administrator->ID); ?>]">
			<?php $user_checked = !empty($this->managers) ? in_array($administrator->ID, $this->managers) : false; ?>
			<input type="checkbox" name="<?php echo esc_attr($name); ?>[users][]" id="<?php echo esc_attr($name); ?>[users<?php echo esc_attr($administrator->ID); ?>]" class="filled-in" value="<?php echo esc_attr($administrator->ID); ?>" <?php checked($user_checked); ?> />
			<span><?php echo esc_html($administrator->display_name); ?></span>
		</label><br />
	<?php } ?>
</fieldset>
<fieldset>
	<h3><?php esc_html_e('E-mail address main Support Hours manager', 'support-hours'); ?>:</h3>
	<legend class="screen-reader-text">
		<span><?php esc_html_e('E-mail address main Support Hours manager', 'support-hours'); ?>:</span>
	</legend>
	<div class="">
		<label for="email"><?php esc_html_e('E-mail', 'support-hours'); ?></label>

		<?php $value_email = !empty($this->email) ? $this->email : ''; ?>
		<input id="email" type="email" class="components-text-control__input validate" id="<?php echo esc_attr($name); ?>-email" name="<?php echo esc_attr($name); ?>[email]" value="<?php echo esc_attr($value_email); ?>" />
	</div>
</fieldset>
