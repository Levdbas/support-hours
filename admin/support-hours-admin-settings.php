<?php

/**
* Settings page of Support Hours
*
* @link       http://basedonline.nl
* @since      1.4.0
*
* @package    Support_Hours
* @subpackage Support_Hours/admin
*/
?>
<?php
$name = $this->plugin_name;
$options = get_option($name);
$users = $options['users'];
$email = $options['email'];
$workFields = $options['workFields'];
$limit = 10; // number of rows in page
$work_entries = count($workFields);
$num_of_pages = ceil( $work_entries / $limit );
$pagenum = isset( $_GET['pagenumber'] ) ? absint( $_GET['pagenumber'] ) : 1;
$output = array_slice($workFields, $limit * $pagenum - $limit, $limit, true);


$user_ID = get_current_user_id();
$i = $limit * $pagenum - $limit;
?>
<div class="wrap">
  <h2><?php echo esc_html(get_admin_page_title()); ?></h2>
  <?php  if (empty($users) || (!empty($users) && in_array($user_ID, $users))) { ?>

    <form method="post" name="cleanup_options" action="options.php" class="support-hours-settings shs">
      <?php
      settings_fields($name);
      do_settings_sections($name);
      include_once( 'partials/settings/general-settings-form.php' );
      include_once( 'partials/settings/work-table-form.php' );
        ?>
      </form>
    <?php } else {?>
      <h3>
        <?php _e( 'You do not have access to this page because you are not a Support Hours manager. Please disable and enable the plugin to reset user access.', $name); ?>
      </h3>
    <?php } ?>
  </div>
