<?php

/**
 * Provide a page that can be seen from editor to admin. Shows all the time entries.
 *
 * @link       http://basedonline.nl
 * @since      1.4.0
 *
 * @package    Support_Hours
 * @subpackage Support_Hours/admin
 */
global $pagenow;

?>
<div class="wrap">
  <h2><?php echo esc_html(get_admin_page_title()); ?></h2>
  <p>
    <?php _e('A complete overview of all activities.', $this->plugin_name); ?>
  </p>
  <?php
  if (!empty($users) && $bought_minutes !== '0' && !empty($email)) :
    $user_ID = get_current_user_id();
    $i = 0;

    if (!empty($workFields[0]['date'])) :
  ?>
      <table class="wp-list-table widefat fixed striped users">
        <thead>
          <tr>
            <th scope="col" class="column-primary"><?php _e('Date', $this->plugin_name); ?></th>
            <th scope="col "><?php _e('Time', $this->plugin_name); ?></th>
            <th scope="col "><?php _e('Description', $this->plugin_name); ?></th>
          </tr>
        </thead>

        <tbody id="the-list" data-wp-lists="list:user">

          <?php
          $widget_fields = $workFields;
          if ($pagenow == 'index.php') :
            $widget_fields = array_slice($workFields, -5);
          endif;
          foreach ($widget_fields as $field) { ?>
            <tr>
              <td><?php if (!empty($field['used'])) echo $field['date'] ?></td>
              <td>
                <span class="time-type-icon">
                  <?php echo ($field['type'] == 'time-added') ? '+' : '-'; ?>
                </span>
                <?php if (!empty($field['used'])) echo $field['used'] ?>
              </td>
              <td><?php if (!empty($field['used'])) echo $field['description'] ?></td>
            </tr>
          <?php } ?>
        </tbody>

        <tfoot>
          <tr>
            <th scope="col column-primary"><?php _e('Date', $this->plugin_name); ?></th>
            <th scope="col column-primary"><?php _e('Time', $this->plugin_name); ?></th>
            <th scope="col column-primary"><?php _e('Description', $this->plugin_name); ?></th>
          </tr>
        </tfoot>
      </table>

      <div class="tablenav bottom">
        <div class="total">
          <span class="bold"><?php _e('Total', $this->plugin_name); ?></span>:
          <?php echo AddTime($workFields, 'time-used'); ?> / <?php echo AddTime($workFields, 'time-added'); ?>
        </div>
      </div>
  <?php
    endif;

    include_once('partials/common/bottom-message.php');

  elseif (empty($users) || empty($email)) :
    include_once('partials/common/notice-configure.php');

  else :
    include_once('partials/common/notice-no-hours.php');

  endif;
  ?>
</div>