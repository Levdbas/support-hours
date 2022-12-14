<?php

/**
 * Settings page of Support Hours
 *
 * @link       https://basedonline.nl
 * @since      1.4.0
 *
 * @package    Support_Hours
 * @subpackage Support_Hours/admin
 */

namespace Support_Hours;

$name            = Support_Hours::PLUGIN_NAME;
$current_user_id = get_current_user_id();
$i               = 0;
$managers = Support_Hours_Data::get_managers();


?>
<div class="wrap">
	<h2><?php echo esc_html(get_admin_page_title()); ?></h2>
	<?php if (empty($managers) || (!empty($managers) && in_array($current_user_id, $managers))) { ?>

		<form method="post" name="cleanup_options" action="options.php" class="support-hours-settings shs">
			<?php
			settings_fields('support-hours');
			do_settings_sections('support-hours');
			include_once 'settings/general-settings-form.php';
			include_once 'settings/work-table-form.php';
			?>
		</form>
	<?php } else { ?>
		<h3>
			<?php esc_html_e('You do not have access to this page because you are not a Support Hours manager. Please disable and enable the plugin to reset user access.', 'support-hours'); ?>
		</h3>
	<?php } ?>
</div>