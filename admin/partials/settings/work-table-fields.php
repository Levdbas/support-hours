<tr class="repeating" data-number="<?php echo $i; ?>">

  <td class="remove">
    <a class="button remove-row" href="#">-</a>
  </td>

  <td data-th="<?php _e('Date', $name); ?>">
    <input type="text" placeholder="dd-mm-yyyy" class="regular-text date" id="<?php echo $name; ?>-workFields-date" name="<?php echo $name; ?>[workFields][<?php echo $i; ?>][date]" value="<?php if(!empty($field['date'])) { echo $field['date']; } ?>"/>
    <button class="today button button-secondary"><?php _e('Today', $name); ?></button>
  </td>

  <td data-th="<?php _e('Description', $name); ?>">
    <input type="text" placeholder="<?php _e('Description of the activity', $name); ?>" class="regular-text description" id="<?php echo $name; ?>-workFields-description" name="<?php echo $name; ?>[workFields][<?php echo $i; ?>][description]" value="<?php if(!empty($field['description'])) echo $field['description'] ?>"/>
  </td>

  <td data-th="<?php _e('Time used', $name); ?>">
    <input type="text" placeholder="00:00" class="regular-text time" id="<?php echo $name; ?>-workFields-used" name="<?php echo $name; ?>[workFields][<?php echo $i; ?>][used]" value="<?php if(!empty($field['used'])) echo $field['used'] ?>" />
  </td>

  <td data-th="<?php _e('test', $name); ?>">

  <fieldset class="test">
  <label for="<?php echo $name; ?>[workFields][<?php echo $i; ?>][type][used]"><?php _e('Time used', $name); ?></label>
  <input id="<?php echo $name; ?>[workFields][<?php echo $i; ?>][type][used]" type="radio" value="time-used" name="<?php echo $name; ?>[workFields][<?php echo $i; ?>][type]" <?php checked('time-used', $field['type'], true); ?> >
  <label for="<?php echo $name; ?>[workFields][<?php echo $i; ?>][type][added]"><?php _e('Time added', $name); ?></label>
  <input id="<?php echo $name; ?>[workFields][<?php echo $i; ?>][type][added]" type="radio" value="time-added" name="<?php echo $name; ?>[workFields][<?php echo $i; ?>][type]"  <?php checked('time-added', $field['type'], true); ?>>
</fieldset>
  </td>
</tr>
