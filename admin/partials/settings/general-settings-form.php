<fieldset>
  <h3><?php _e('Select Support Hours managers', $name); ?>:</h3>
  <?php
  $administrators = get_users('orderby=nicename&role=administrator');
  foreach ($administrators as $administrator) {
  ?>
    <label for="<?php echo $name; ?>[users<?php echo $administrator->ID; ?>]">
      <input type="checkbox" name="<?php echo $name; ?>[users][]" id="<?php echo $name; ?>[users<?php echo $administrator->ID; ?>]" class="filled-in" value="<?php echo $administrator->ID; ?>" <?php if (!empty($this->managers)) checked((in_array($administrator->ID, $this->managers))); ?> />
      <span><?php echo $administrator->display_name; ?></span>
    </label><br />
  <?php } ?>
</fieldset>
<fieldset>
  <h3><?php _e('E-mail address main Support Hours manager', $name); ?>:</h3>
  <legend class="screen-reader-text">
    <span><?php _e('E-mail address main Support Hours manager', $name); ?>:</span>
  </legend>
  <div class="">
    <label for="email"><?php _e('E-mail', $name); ?></label>
    <input id="email" type="email" class="components-text-control__input validate" id="<?php echo $name; ?>-email" name="<?php echo $name; ?>[email]" value="<?php if (!empty($this->email)) echo $this->email; ?>" />
  </div>
</fieldset>