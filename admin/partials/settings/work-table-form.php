<fieldset>
  <span class="currentDate"><?php echo date_i18n("d-m-Y"); ?></span>
  <table id="repeatable-fieldset-one" class="worktable">

    <thead>
      <tr class="row-head">

        <th class="support-hours-col col-type"><?php _e('Type', $name); ?></th>
        <th class="support-hours-col col-date"><?php _e('Date', $name); ?></th>
        <th class="support-hours-col col-time"><?php _e('Time', $name); ?></th>
        <th class="support-hours-col col-description"><?php _e('Description', $name); ?></th>
        <th></th>
      </tr>
    </thead>

    <tbody>
      <?php
      if ( $workFields ):
        $first = false;
        foreach ( $workFields as $field ) {
          include( 'work-table-fields.php' );
          $i++;
        }
      else:
        $first = true;
        include( 'work-table-fields.php' );
      endif;
      ?>
    </tbody>
  </table>
  <p><em><?php _e('Activities will be sorted by date on save', $name); ?>.</em></p>
  <a href="#" class="repeat button button-secondary">
    <?php _e('Add activity', $name); ?>
  </a>
  <?php submit_button(__( 'Save', $name), 'primary','submit', true); ?>
</fieldset>
