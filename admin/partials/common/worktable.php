<?php if ( $workFields ) : ?>
  <h3><?php _e('Activities', $this->plugin_name); ?></h3>
  <table class="worktable" width="100%">
    <thead>
      <tr>
        <th width="20%"><?php _e('Date', $this->plugin_name); ?></th>
        <th width="50%"><?php _e('Description', $this->plugin_name); ?></th>
        <th width="30%"><?php _e('Time used', $this->plugin_name); ?></th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ( $workFields as $field ) { ?>
        <tr>
          <td><?php if(!empty($field['used'])) echo $field['date'] ?></td>
          <td><?php if(!empty($field['used'])) echo $field['description'] ?></td>
          <td>
            <span class="time-type-icon">
              <?php echo ($field['type'] == 'time-added') ? '+' : '-'; ?>
            </span>
            <?php if(!empty($field['used'])) echo $field['used'] ?>
          </td>
        </tr>
        <?php
      }
      ?>
    </tbody>
  </table>
  <div class="total">
    <span class="bold"><?php _e('Total', $this->plugin_name); ?></span>:
    <?php  echo AddTime($workFields, 'time-used'); ?> / <?php echo AddTime($workFields, 'time-added'); ?>
  </div>
<?php endif;?>
