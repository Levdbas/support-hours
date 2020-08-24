<fieldset>
  <h3><?php _e('Select Support Hours managers', $name); ?>:</h3>
  <?php
  $WPusers = get_users('orderby=nicename&role=administrator');
  foreach ($WPusers as $user) {
    ?>
    <label for="<?php echo $name; ?>[users<?php echo $user->ID; ?>]">
      <input type="checkbox" name="<?php echo $name; ?>[users][]" id="<?php echo $name; ?>[users<?php echo $user->ID; ?>]" class="filled-in" value="<?php echo $user->ID; ?>" <?php if (!empty($users)) checked((in_array($user->ID, $users))); ?> />
      <span><?php echo $user->display_name; ?></span>
    </label><br />
  <?php } ?>
</fieldset>
<fieldset>
  <h3><?php _e('E-mail address main Support Hours manager', $name); ?>:</h3>
  <legend class="screen-reader-text">
    <span><?php _e('E-mail address main Support Hours manager', $name); ?>:</span>
  </legend>
  <div class="input-field">
    <input id="email" type="email" class="regular-text regular-text--email validate" id="<?php echo $name; ?>-email" name="<?php echo $name; ?>[email]" value="<?php if (!empty($email)) echo $email; ?>" />
    <label for="email"><?php _e('E-mail', $name); ?></label>
  </div>
</fieldset>