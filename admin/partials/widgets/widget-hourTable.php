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
      $i = 0;
      foreach ( array_reverse($workFields) as $field ) { ?>
        <tr>
          <td><?php if(!empty($field['used'])) echo $field['date'] ?></td>
          <td><?php if(!empty($field['used'])) echo $field['description'] ?></td>
          <td><?php if(!empty($field['used'])) echo $field['used'] ?></td>
        </tr>
        <?php
        $i++;
        if ($i >= 5){
          break;
        }
      }
      ?>
    </tbody>
  </table>
  <?php if(!empty($users) && in_array($user_ID, $users)): ?>
    <a class="button button-primary" href="<?php echo admin_url( 'admin.php?page=support-hours-settings' ); ?>"><?php _e('Add new activity', $this->plugin_name); ?></a>
  <?php endif;?>
  <?php if($i >= 5 && current_user_can('publish_pages')): ?>
    <a class="button button-secondary" href="<?php echo admin_url( 'admin.php?page=support-hours' ); ?>"><?php _e('View all acitivities', $this->plugin_name); ?></a>
  <?php endif; ?>
  <div class="total"><span class="bold"><?php _e('Total', $this->plugin_name); ?></span>: <?php echo AddTime($workFields); ?></div>
<?php elseif(!empty($users) && in_array($user_ID, $users)): ?>
  <a class="button button-secondary" href="<?php echo admin_url( 'admin.php?page=support-hours-settings' ); ?>"><?php _e('Add first acitivity', $this->plugin_name); ?></a>
<?php endif;?>
