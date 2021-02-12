<tr class="repeating" data-number="<?php echo $i; ?>">

  <td>

    <fieldset class="type-switch">
      <label for="<?php echo $name; ?>[workFields][<?php echo $i; ?>][type][used]">
        <input id="<?php echo $name; ?>[workFields][<?php echo $i; ?>][type][used]" required type="radio" class="radio time-used" value="time-used" name="<?php echo $name; ?>[workFields][<?php echo $i; ?>][type]" <?php if (isset($field['type']) && 'time-used' == $field['type']) echo 'checked="checked"'; ?>>
        <span><?php _e('Time used', $name); ?></span>
      </label>

      <label for="<?php echo $name; ?>[workFields][<?php echo $i; ?>][type][added]">
        <input id="<?php echo $name; ?>[workFields][<?php echo $i; ?>][type][added]" type="radio" class="radio time-added" value="time-added" name="<?php echo $name; ?>[workFields][<?php echo $i; ?>][type]" <?php if (isset($field['type']) && 'time-added' == $field['type'] || $first == true) echo 'checked="checked"'; ?>>
        <span><?php _e('Time added', $name); ?></span>
      </label>
    </fieldset>
  </td>

  <td data-th="<?php _e('Date', $name); ?>">
    <input type="date" class="regular-text date validate sh-datepicker" id="<?php echo $name; ?>-workFields-date" name="<?php echo $name; ?>[workFields][<?php echo $i; ?>][date]" value="<?php if (!empty($field['date'])) {
                                                                                                                                                                                            echo $field['date'];
                                                                                                                                                                                          } ?>" required />
  </td>

  <td data-th="<?php _e('Time', $name); ?>">
    <input type="time" placeholder="00:00" class="regular-text time validate" id="<?php echo $name; ?>-workFields-used" name="<?php echo $name; ?>[workFields][<?php echo $i; ?>][used]" required value="<?php if (!empty($field['used'])) echo $field['used'] ?>" />
  </td>

  <td data-th="<?php _e('Description', $name); ?>">
    <input type="text" required placeholder="<?php _e('Description of the activity', $name); ?>" class="regular-text description validate" id="<?php echo $name; ?>-workFields-description" name="<?php echo $name; ?>[workFields][<?php echo $i; ?>][description]" value="<?php if (!empty($field['description'])) echo $field['description'] ?>" />
  </td>

  <td class="remove">
    <a class="remove-row btn-floating btn-small waves-effect waves-light"><span class="material-icons dashicons dashicons-minus"></span></a>
  </td>
</tr>