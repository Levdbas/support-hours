<fieldset>
  <p><?php _e( 'Select Support Hours managers', $name); ?>.</p>
  <legend class="screen-reader-text">
    <span>
      <?php _e('Select Support-Hour manager. Warning!  If you do not set yourself as a Support Hours manager, you will loose access to this page until the plugin is disabled and enabled.', $name); ?>
    </span>
  </legend>
  <?php
  $WPusers = get_users( 'orderby=nicename&role=administrator' );
  foreach ( $WPusers as $user ) {
  ?>
    <input type="checkbox" name="<?php echo $name; ?>[users][]" id="<?php echo $name; ?>-users" value="<?php echo $user->ID; ?>" <?php if (!empty($users)) { checked((in_array( $user->ID, $users))); } ?> />
    <label for="<?php echo $name; ?>[users<?php echo $user->ID; ?>]">
      <?php echo $user->display_name; ?>
    </label><br />
  <?php } ?>
  <p><?php _e( 'Warning! If you do not set yourself as a Support Hours manager, you will loose access to this page until the plugin is disabled and enabled.', $name); ?></p>
</fieldset>
<fieldset>
  <p><?php _e( 'E-Mail adress main Support Hours manager', $name); ?>:</p>
  <legend class="screen-reader-text">
    <span><?php _e('E-Mail adress main Support Hours manager', $name); ?>:</span>
  </legend>
  <input type="text" class="regular-text" id="<?php echo $name; ?>-bought_hours" name="<?php echo $name; ?>[email]" value="<?php if(!empty($email)) echo $email; ?>"/>
</fieldset>
