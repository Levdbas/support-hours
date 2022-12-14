<?php

/**
 * Partial for the settigns page.
 *
 * @link       https://basedonline.nl
 * @since      1.0.0
 *
 * @package    Support_Hours
 * @subpackage Support_Hours/views
 */

namespace Support_Hours;

$administrators = get_users('orderby=nicename&role=administrator');
$managers = Support_Hours_Data::get_managers();
$email = Support_Hours_Data::get_email();
?>

<table class="form-table" role="presentation">

	<tbody>
		<tr>
			<th scope="row"><?php esc_html_e('Support Hours managers', 'support-hours'); ?></th>
			<td>
				<fieldset>
					<?php

					foreach ($administrators as $administrator) {
					?>
						<label for="<?php echo esc_attr($name); ?>[users<?php echo esc_attr($administrator->ID); ?>]">
							<?php $user_checked = !empty($managers) ? in_array($administrator->ID, $managers) : false; ?>
							<input type="checkbox" name="<?php echo esc_attr($name); ?>[users][]" id="<?php echo esc_attr($name); ?>[users<?php echo esc_attr($administrator->ID); ?>]" class="filled-in" value="<?php echo esc_attr($administrator->ID); ?>" <?php checked($user_checked); ?> />
							<span><?php echo esc_html($administrator->display_name); ?></span>
						</label><br />
					<?php } ?>
				</fieldset>
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="email"><?php esc_html_e('E-mail address main Support Hours manager', 'support-hours'); ?></label>
			</th>
			<td>
				<fieldset>
					<div class="">
						<?php $value_email = !empty($email) ? $email : ''; ?>
						<input id="email" type="email" class="validate regular-text" id="<?php echo esc_attr($name); ?>-email" name="<?php echo esc_attr($name); ?>[email]" value="<?php echo esc_attr($value_email); ?>" />
					</div>
				</fieldset>
			</td>
		</tr>
	</tbody>
</table>