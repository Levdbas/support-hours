<fieldset>
  <span class="currentDate"><?php echo date_i18n("d-m-Y"); ?></span>
  <table id="repeatable-fieldset-one" class="worktable">

    <thead>
      <tr class="row-head">

        <th><?php _e('Type', $name); ?></th>
        <th><?php _e('Date', $name); ?></th>
        <th><?php _e('Time', $name); ?></th>
        <th><?php _e('Description', $name); ?></th>
        <th></th>
      </tr>
    </thead>

    <tbody>
      <?php if ( $workFields ):
        foreach ( $workFields as $field ) {
          include( 'work-table-fields.php' );
          $i++;	}
        else:
          include( 'work-table-fields.php' );
        endif; ?>
      </tbody>
    </table>
    <a href="#" class="repeat button button-secondary">
      <?php _e('Add activity', $name); ?>
    </a>
    <?php submit_button(__( 'Save all changes', $name), 'primary','submit', true); ?>
  </fieldset>
