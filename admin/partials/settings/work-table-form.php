<fieldset>
  <span class="currentDate"><?php echo date_i18n("d-m-Y"); ?></span>
  <table id="repeatable-fieldset-one" class="rwd-table">

    <thead>
      <tr>
        <th></th>
        <th><?php _e('Date', $name); ?></th>
        <th><?php _e('Description', $name); ?></th>
        <th><?php _e('Time used', $name); ?></th>
      </tr>
    </thead>
    <tbody>
    <?php if ( $workFields ) : foreach ( $workFields as $field ) {  ?>


        <tr class="repeating">

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

        </tr>

      <?php $i++;	} else : ?>

          <tr class="repeating">

            <td class="remove">
              <a class="button remove-row" href="#">-</a>
            </td>

            <td data-th="<?php _e('Date', $name); ?>">
              <input type="text" placeholder="dd-mm-yyyy" class="regular-text date" id="<?php echo $name; ?>-workFields-date" name="<?php echo $name; ?>[workFields][<?php echo $i; ?>][date]" value=""/>
              <button class="today button button-primary"><?php _e('Today', $name); ?></button>
            </td>

            <td  data-th="<?php _e('Description', $name); ?>">
              <input type="text" placeholder="<?php _e('Description of the activity', $name); ?>" class="regular-text description" id="<?php echo $name; ?>-workFields-description" name="<?php echo $name; ?>[workFields][<?php echo $i; ?>][description]" value=""/>
            </td>

            <td data-th="<?php _e('Time used', $name); ?>">
              <input type="text" placeholder="00:00" class="regular-text time" id="<?php echo $name; ?>-workFields-used" name="<?php echo $name; ?>[workFields][<?php echo $i; ?>][used]" value="" />
            </td>

          </tr>

      <?php endif; ?>
      </tbody>
    </table>
    <a href="#" class="repeat button button-secondary"><?php _e('Add activity', $name); ?></a><?php submit_button(__( 'Save all changes', $name), 'primary','submit', true); ?>
  </fieldset>
