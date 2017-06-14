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
        <p><?php _e( 'Select Support Hours managers', $this->plugin_name); ?>.</p>
        <legend class="screen-reader-text"><span><?php _e('Select Support-Hour manager. Warning!  If you do not set yourself as a Support Hours manager, you will loose access to this page until the plugin is disabled and enabled.', $this->plugin_name); ?></span></legend>
        <?php $WPusers = get_users( 'orderby=nicename&role=administrator' ); foreach ( $WPusers as $user ) { ?>
          <input type="checkbox" name="<?php echo $this->plugin_name; ?>[users][]" id="<?php echo $this->plugin_name; ?>-users" value="<?php echo $user->ID; ?>" <?php if (!empty($users)) { checked((in_array( $user->ID, $users))); } ?> />
          <label for="<?php echo $this->plugin_name; ?>[users<?php echo $user->ID; ?>]"><?php echo $user->display_name; ?></label><br />
        <?php } ?>
        <p><?php _e( 'Warning! If you do not set yourself as a Support Hours manager, you will loose access to this page until the plugin is disabled and enabled.', $this->plugin_name); ?></p>
        </fieldset>
        <fieldset>
          <p><?php _e( 'E-Mail adress main Support Hours manager', $this->plugin_name); ?>:</p>
          <legend class="screen-reader-text"><span><?php _e('E-Mail adress main Support Hours manager', $this->plugin_name); ?>:</span></legend>
          <input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-bought_hours" name="<?php echo $this->plugin_name; ?>[email]" value="<?php if(!empty($email)) echo $email; ?>"/>
        </fieldset>
        <fieldset>
          <p><?php _e( 'Amount of bought Support Hours', $this->plugin_name); ?>:</p>
          <legend class="screen-reader-text"><span><?php _e('Amount of bought Support Hours', $this->plugin_name); ?>:</span></legend>
          <input type="text" placeholder="00:00" class="regular-text time" id="<?php echo $this->plugin_name; ?>-bought_hours" name="<?php echo $this->plugin_name; ?>[bought_hours]" value="<?php if(!empty($bought_hours)) echo $bought_hours; ?>"/>
          <span class="emsg hidden"><?php _e( 'Please enter a valid time', $this->plugin_name); ?></span>
        </fieldset>
        <fieldset>
          <span class="currentDate"><?php echo date_i18n("d-m-Y"); ?></span>
          <table id="repeatable-fieldset-one" class="rwd-table">
          	<thead>
          		<tr>
          			<th></th>
          			<th><?php _e('Date', $this->plugin_name); ?></th>
          			<th><?php _e('Description', $this->plugin_name); ?></th>
                <th><?php _e('Time used', $this->plugin_name); ?></th>
          		</tr>
          	</thead>
          <tbody>
          <?php
          $i = 0;
        	if ( $workFields ) :
        		foreach ( $workFields as $field ) {
          ?>
          <tr class="repeating">
            <td class="remove"><a class="button remove-row" href="#">-</a></td>
            <td data-th="<?php _e('Date', $this->plugin_name); ?>">
              <input type="text" placeholder="dd-mm-yyyy" class="regular-text date" id="<?php echo $this->plugin_name; ?>-workFields-date" name="<?php echo $this->plugin_name; ?>[workFields][<?php echo $i; ?>][date]" value="<?php if(!empty($field['date'])) { echo $field['date']; } ?>"/>
              <button class="today button button-primary"><?php _e('Today', $this->plugin_name); ?></button>
            </td>
            <td data-th="<?php _e('Description', $this->plugin_name); ?>">
              <input type="text" placeholder="<?php _e('Description of the activity', $this->plugin_name); ?>" class="regular-text description" id="<?php echo $this->plugin_name; ?>-workFields-description" name="<?php echo $this->plugin_name; ?>[workFields][<?php echo $i; ?>][description]" value="<?php if(!empty($field['description'])) echo $field['description'] ?>"/>
            </td>
            <td data-th="<?php _e('Time used', $this->plugin_name); ?>">
              <input type="text" placeholder="00:00" class="regular-text time" id="<?php echo $this->plugin_name; ?>-workFields-used" name="<?php echo $this->plugin_name; ?>[workFields][<?php echo $i; ?>][used]" value="<?php if(!empty($field['used'])) echo $field['used'] ?>" />
            </td>
          </tr>
        <?php   $i++;	} else : ?>
          <tr class="repeating">
            <td class="remove"><a class="button remove-row" href="#">-</a></td>
            <td data-th="<?php _e('Date', $this->plugin_name); ?>">
              <input type="text" placeholder="dd-mm-yyyy" class="regular-text date" id="<?php echo $this->plugin_name; ?>-workFields-date" name="<?php echo $this->plugin_name; ?>[workFields][<?php echo $i; ?>][date]" value=""/>
              <button class="today button button-primary"><?php _e('Today', $this->plugin_name); ?></button>
            </td>
            <td  data-th="<?php _e('Description', $this->plugin_name); ?>">
              <input type="text" placeholder="<?php _e('Description of the activity', $this->plugin_name); ?>" class="regular-text description" id="<?php echo $this->plugin_name; ?>-workFields-description" name="<?php echo $this->plugin_name; ?>[workFields][<?php echo $i; ?>][description]" value=""/>
            </td>
            <td data-th="<?php _e('Time used', $this->plugin_name); ?>">
              <input type="text" placeholder="00:00" class="regular-text time" id="<?php echo $this->plugin_name; ?>-workFields-used" name="<?php echo $this->plugin_name; ?>[workFields][<?php echo $i; ?>][used]" value="" />
            </td>
          </tr>
          <?php endif; ?>
      </tbody>
      </table>
</fieldset>
        <a href="#" class="repeat button button-primary"><?php _e('Add row', $this->plugin_name); ?></a><?php submit_button(__( 'Save all changes', $this->plugin_name), 'primary','submit', TRUE); ?>
      </form>
      <?php } else {?>
        <p>
          <?php _e( 'You do not have access to this page because you are not a Support Hours manager. Please disable and enable this plugin if you need access again.', $this->plugin_name); ?>
        </p>
        <?php } ?>
      </div>
