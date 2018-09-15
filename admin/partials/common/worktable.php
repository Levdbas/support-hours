<?php if ( $workFields ) : ?>
  <div class="support-hours-time-table">
    <h3>
      <?php
      if ($pagenow == 'index.php'):
        _e('Last five entries', $this->plugin_name);
      else:
        _e('Activities', $this->plugin_name);
      endif;
      ?>
    </h3>

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
        $i = 0;
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
          if ($pagenow != 'index.php'):
            $i++;
            if ($i >= 5){
              break;
            }
          endif;
        }
        ?>
      </tbody>
    </table>
    <div class="total">
      <span class="bold"><?php _e('Total', $this->plugin_name); ?></span>:
      <?php  echo AddTime($workFields, 'time-used'); ?> / <?php echo AddTime($workFields, 'time-added'); ?>
    </div>
  </div>
<?php endif;?>
