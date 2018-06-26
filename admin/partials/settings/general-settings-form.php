<fieldset>
  <p><?php _e( 'Select Support Hours managers', $this->plugin_name); ?>.</p>
  <legend class="screen-reader-text">
    <span><?php _e('Select Support-Hour manager. Warning!  If you do not set yourself as a Support Hours manager, you will loose access to this page until the plugin is disabled and enabled.', $this->plugin_name); ?></span>
  </legend>
  <?php
  $WPusers = get_users( 'orderby=nicename&role=administrator' );
  foreach ( $WPusers as $user ) {
  ?>
    <input type="checkbox" name="<?php echo $this->plugin_name; ?>[users][]" id="<?php echo $this->plugin_name; ?>-users" value="<?php echo $user->ID; ?>" <?php if (!empty($users)) { checked((in_array( $user->ID, $users))); } ?> />
    <label for="<?php echo $this->plugin_name; ?>[users<?php echo $user->ID; ?>]">
      <?php echo $user->display_name; ?>
    </label><br />
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
