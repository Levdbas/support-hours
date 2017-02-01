<?php

/**
* Provide a admin area view for the plugin
*
* This file is used to markup the admin-facing aspects of the plugin.
*
* @link       http://basedonline.nl
* @since      1.0.0
*
* @package    Support_Hours
* @subpackage Support_Hours/admin/partials
*/
?>
<?php
$options = get_option($this->plugin_name);
$bought_hours = $options['bought_hours'];
$used_hours = $options['used_hours'];
$users = $options['users'];
$email = $options['email'];
$workFields = $options['workFields'];
?>
<div class="wrap">
  <?php
  $user_ID = get_current_user_id();
  if (empty($users) || (!empty($users) && in_array($user_ID, $users))) {
    ?>
    <h2><?php echo esc_html(get_admin_page_title()); ?></h2>
    <form method="post" name="cleanup_options" action="options.php">
      <?php
      settings_fields($this->plugin_name);
      do_settings_sections($this->plugin_name);
      ?>
      <fieldset>
        <p><?php echo __( 'Select Support Hours managers', 'support-hours'); ?>.</p>
        <legend class="screen-reader-text"><span><?php _e('Select Support-Hour manager. Warning!  If you do not set yourself as a Support Hours manager, you will lose acces to this page until the plugin is disabled and enabled.', $this->plugin_name); ?></span></legend>
        <?php $WPusers = get_users( 'orderby=nicename&role=administrator' ); foreach ( $WPusers as $user ) { ?>
          <input type="checkbox" name="<?php echo $this->plugin_name; ?>[users][]" id="<?php echo $this->plugin_name; ?>-users" value="<?php echo $user->ID; ?>" <?php if (!empty($users)) { checked((in_array( $user->ID, $users))); } ?> />
          <label for="<?php echo $this->plugin_name; ?>[users<?php echo $user->ID; ?>]"><?php echo $user->display_name; ?></label><br />
        <?php } ?>
        <p><?php echo __( 'Warning! If you do not set yourself as a Support Hours manager, you will lose acces to this page until the plugin is disabled and enabled.', 'support-hours'); ?></p>
        </fieldset>
        <fieldset>
          <p><?php echo __( 'E-Mail adress main Support Hours manager', 'Support Hours'); ?>:</p>
          <legend class="screen-reader-text"><span><?php _e('E-Mail adress main Support Hours manager', $this->plugin_name); ?>:</span></legend>
          <input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-bought_hours" name="<?php echo $this->plugin_name; ?>[email]" value="<?php if(!empty($email)) echo $email; ?>"/>
        </fieldset>
        <fieldset>
          <p><?php echo __( 'Amount of bought Support Hours', 'support-hours'); ?>:</p>
          <legend class="screen-reader-text"><span><?php _e('Amount of bought Support Hours', $this->plugin_name); ?>:</span></legend>
          <input type="text" placeholder="00:00" class="regular-text time" id="<?php echo $this->plugin_name; ?>-bought_hours" name="<?php echo $this->plugin_name; ?>[bought_hours]" value="<?php if(!empty($bought_hours)) echo $bought_hours; ?>"/>
          <span class="emsg hidden"><?php echo __( 'Please enter a valid time', 'support-hours'); ?></span>
        </fieldset>

        <fieldset>
          <p><?php echo __( 'Amount of used Support Hours', 'support-hours'); ?>:</p>
          <legend class="screen-reader-text"><span><?php _e('Amount of used Support Hours', $this->plugin_name); ?>:</span></legend>
          <input type="text" placeholder="00:00" class="regular-text time" id="<?php echo $this->plugin_name; ?>-used_hours" name="<?php echo $this->plugin_name; ?>[used_hours]" value="<?php if(!empty($used_hours)) echo $used_hours; ?>"/>
          <span class="emsg hidden"><?php echo __( 'Please enter a valid time', 'support-hours'); ?></span>
        </fieldset>

        <fieldset>
          <table id="repeatable-fieldset-one" width="100%">
	<thead>
		<tr>
			<th width="2%"></th>
			<th width="30%">datum</th>
			<th width="68%">beschrijving</th>
      <th width="60%">tijd</th>
			<th width="2%"></th>
		</tr>
	</thead>
<tbody>
          <?php
          $i = 0;
          	if ( $workFields ) :
          		foreach ( $workFields as $field ) {
                $i++
          ?>
          <tr>
            <td><a class="button remove-row" href="#">-</a></td>
            <td>
              <input type="text" placeholder="dd-mm-yy" class="regular-text date" id="<?php echo $this->plugin_name; ?>-workFields-date" name="<?php echo $this->plugin_name; ?>[workFields][date_<?php echo $i; ?>]" value="<?php if(!empty($options['workFields']['date_'.$i])) { echo $options['workFields']['date_'.$i]; } else { echo date("d-m-y");} ?>"/>
            </td>
            <td>
              <input type="text" placeholder="beschrijving van de werkzaamheden" class="regular-text description" id="<?php echo $this->plugin_name; ?>-workFields-description" name="<?php echo $this->plugin_name; ?>[workFields][description_<?php echo $i; ?>]" value="<?php if(!empty($options['workFields']['description_'.$i])) echo $options['workFields']['description_'.$i] ?>"/>
            </td>
            <td>
              <input type="text" placeholder="00:00" class="regular-text time" id="<?php echo $this->plugin_name; ?>-workFields-used" name="<?php echo $this->plugin_name; ?>[workFields][used_<?php echo $i; ?>]" value="<?php if(!empty($options['workFields']['used_'.$i])) echo $options['workFields']['used_'.$i] ?>" />
            </td>
          </tr>
        </fieldset>
        <?php
		}
	else :
		// show a blank one
?>
	<tr>
		<td><a class="button remove-row" href="#">-</a></td>
    <td>
      <input type="text" placeholder="00:00" class="regular-text time" id="<?php echo $this->plugin_name; ?>-workFields-time" name="<?php echo $this->plugin_name; ?>[workFields][used_<?php echo $i; ?>]" value="test"/>
    </td>
    <td><a class="sort">|||</a></td>
	</tr>
</tbody>
</table>
<?php endif; ?>

        <?php submit_button(__( 'Save all changes', 'support-hours'), 'primary','submit', TRUE); ?>
      </form>
      <?php } else {?>
        <p>
          <?php echo __( 'You do not have access to this page because you are not a Support Hours manager. Please disable and enable this plugin if you need access again.', 'support-hours'); ?>
        </p>
        <?php } ?>
      </div>
