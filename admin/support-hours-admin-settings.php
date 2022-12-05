<?php

namespace Support_Hours;

/**
 * Settings page of Support Hours
 *
 * @link       http://basedonline.nl
 * @since      1.4.0
 *
 * @package    Support_Hours
 * @subpackage Support_Hours/admin
 */

$name       = $this->plugin_name;
$options    = $this->options;
$work_fields = $this::$work_fields;
$current_user_id    = get_current_user_id();
$i          = 0;

?>
<div class="wrap">
	<h2><?php echo esc_html(get_admin_page_title()); ?></h2>
	<?php if (empty($this->managers) || (!empty($this->managers) && in_array($current_user_id, $this->managers))) { ?>

		<form method="post" name="cleanup_options" action="options.php" class="support-hours-settings shs">
			<?php
			settings_fields('support-hours');
			do_settings_sections('support-hours');
			include_once 'partials/settings/general-settings-form.php';
			include_once 'partials/settings/work-table-form.php';
			?>
		</form>
	<?php } else { ?>
		<h3>
			<?php esc_html_e('You do not have access to this page because you are not a Support Hours manager. Please disable and enable the plugin to reset user access.', 'support-hours'); ?>
		</h3>
	<?php } ?>
</div>
