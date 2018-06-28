<tr class="repeating" data-number="<?php echo $i; ?>">

  <td class="remove">
     <a class="remove-row btn-floating btn-small waves-effect waves-light"><span class="material-icons dashicons dashicons-trash"></span></a>
  </td>

  <td data-th="<?php _e('Date', $name); ?>">
    <input type="text" placeholder="dd-mm-yyyy" class="regular-text date datepicker" id="<?php echo $name; ?>-workFields-date" name="<?php echo $name; ?>[workFields][<?php echo $i; ?>][date]" value="<?php if(!empty($field['date'])) { echo $field['date']; } ?>"/>
  </td>

  <td data-th="<?php _e('Description', $name); ?>">
    <input type="text" placeholder="<?php _e('Description of the activity', $name); ?>" class="regular-text description" id="<?php echo $name; ?>-workFields-description" name="<?php echo $name; ?>[workFields][<?php echo $i; ?>][description]" value="<?php if(!empty($field['description'])) echo $field['description'] ?>"/>
  </td>

  <td data-th="<?php _e('Time used', $name); ?>">
    <input type="text" placeholder="00:00" class="regular-text time timepicker" id="<?php echo $name; ?>-workFields-used" name="<?php echo $name; ?>[workFields][<?php echo $i; ?>][used]" value="<?php if(!empty($field['used'])) echo $field['used'] ?>" />
  </td>

  <td data-th="<?php _e('test', $name); ?>">

  <fieldset class="test">
  <label for="<?php echo $name; ?>[workFields][<?php echo $i; ?>][type][used]">
    <input id="<?php echo $name; ?>[workFields][<?php echo $i; ?>][type][used]" type="radio" value="time-used" name="<?php echo $name; ?>[workFields][<?php echo $i; ?>][type]" <?php checked('time-used', $field['type'], true); ?> >
    <span><?php _e('Time used', $name); ?></span>
  </label>

  <label for="<?php echo $name; ?>[workFields][<?php echo $i; ?>][type][added]">
  <input id="<?php echo $name; ?>[workFields][<?php echo $i; ?>][type][added]" type="radio" value="time-added" name="<?php echo $name; ?>[workFields][<?php echo $i; ?>][type]"  <?php checked('time-added', $field['type'], true); ?>>
  <span><?php _e('Time added', $name); ?></span>
</label>
</fieldset>
  </td>
</tr>
