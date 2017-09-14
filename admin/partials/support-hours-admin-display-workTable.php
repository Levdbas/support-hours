<?php
$i = 0;
?>
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

    <?php if ( $workFields ) : foreach ( $workFields as $field ) {  ?>

      <tbody>
        <tr class="repeating">

          <td class="remove">
            <a class="button remove-row" href="#">-</a>
          </td>

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
      </tbody>

      <?php $i++;	} else : ?>

        <tbody>
          <tr class="repeating">

            <td class="remove">
              <a class="button remove-row" href="#">-</a>
            </td>

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
        </tbody>

      <?php endif; ?>

    </table>
    <a href="#" class="repeat button button-primary"><?php _e('Add row', $this->plugin_name); ?></a><?php submit_button(__( 'Save all changes', $this->plugin_name), 'primary','submit', TRUE); ?>
  </fieldset>
