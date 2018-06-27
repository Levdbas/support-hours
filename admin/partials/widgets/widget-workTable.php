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
<div class="total">
  <span class="bold"><?php _e('Total spent', $this->plugin_name); ?></span>
  <span>: <?php  echo $bought_hours; /*echo AddTime($workFields); */ ?></span>
</div>
