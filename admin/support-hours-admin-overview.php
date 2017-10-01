<?php

/**
* Provide a page that can be seen from editor to admin. Shows all the time entries.
*
* @link       http://basedonline.nl
* @since      1.0.0
*
* @package    Support_Hours
* @subpackage Support_Hours/admin
*/
?>
<?php
  // load options and functions.
  $options = get_option($this->plugin_name);
  $bought_hours = $options['bought_hours'];
  $workFields = $options['workFields'];
  include_once( 'partials/support-hours-functions.php' );
?>
<div class="wrap">
  <h2><?php echo esc_html(get_admin_page_title()); ?></h2>
</div>


<?php if ( $workFields ) : ?>
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
        // loop the $workFields. Show all. 
        foreach ( array_reverse($workFields) as $field ) {
      ?>
        <tr>
          <td><?php if(!empty($field['used'])) echo $field['date'] ?></td>
          <td><?php if(!empty($field['used'])) echo $field['description'] ?></td>
          <td><?php if(!empty($field['used'])) echo $field['used'] ?></td>
        </tr>
        <?php
      }
      ?>
    </tbody>
  </table>
  <div class="">
    <span class="bold"><?php _e('Total', $this->plugin_name); ?></span>:
    <?php echo AddTime($workFields); ?> <?php _e('hours used of', $this->plugin_name); ?>
    <?php echo $bought_hours; ?> <?php _e('hours', $this->plugin_name); ?>
  </div>
<?php endif;?>
