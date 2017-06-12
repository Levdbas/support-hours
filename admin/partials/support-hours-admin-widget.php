<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://basedonline.nl
 * @since      1.0.0
 *
 * @package    Support_Hours
 * @subpackage Support_Hours/admin/partials
 */
?>
<?php if(!empty($users) && !empty($bought_hours)) { ?>
<div class="progress-bar position <?php echo $current_color;?>" data-percent="<?php echo $percentage; ?>">
  <div class="background">
    <div class="rotate"></div>
  </div>
  <div class="left"></div>
  <div class="right"></div>
  <div class="innerCicle">
    <span class="textHolder">
      <span class="text <?php echo $size; ?>">
        <?php echo $used_hours; ?> / <?php if(!empty($bought_hours)) echo $bought_hours; ?>
        <br class="smallbr" />
        <?php if($size == "small"){
          echo "<br class='bigbr' />";
        } ?>
        <?php _e( 'hours', $this->plugin_name); ?>
        <?php if($size == "big"){
          echo "<br class='bigbr' />";
        } ?>
        <?php _e( 'used', $this->plugin_name); ?>
      </span>
    </span>
  </div>
</div>
    <?php
    if ( $workFields ) : ?>
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
      <?php foreach ( $workFields as $field ) { ?>
        <tr>
          <td><?php if(!empty($field['used'])) echo $field['date'] ?></td>
          <td><?php if(!empty($field['used'])) echo $field['description'] ?></td>
          <td><?php if(!empty($field['used'])) echo $field['used'] ?></td>
        </tr>
      <?php } ?>
    </tbody>
      </table>
      <h4 class="total"><span class="bold"><?php _e('Total', $this->plugin_name); ?></span>: <?php echo AddTime($workFields); ?></h4>
    <?php endif;?>
    <p>
      <?php if($percentage == 100) {?>
          <?php _e( 'Support hours used.', $this->plugin_name); ?><br />
        <?php } elseif($percentage >= 80) {?>
          <?php _e( 'Support hours almost used.', $this->plugin_name); ?><br />
      <?php } else {?>
        <?php _e( 'Need more support hours?', $this->plugin_name); ?><br />
      <?php } ?>
      <?php _e( 'Contact me via', $this->plugin_name); ?>
      <a href="mailto:<?php echo $email;?>"><?php echo $email;?></a>
    </p>
<?php } else { ?>
  <?php if(empty($users)){ ?>
    <p>
      <a class="button button-primary button-hero load-customize hide-if-no-customize" href="<?php echo admin_url( 'options-general.php?page=support-hours' ); ?>"><?php _e( 'Configure plugin!', $this->plugin_name); ?></a>
    </p>
<?php } else{ ?>
  <h4><?php _e( 'No support Hours bought', $this->plugin_name); ?></h4>
  <p>
    <?php _e( 'Contact me via', $this->plugin_name); ?>
    <a href="mailto:<?php echo $email;?>"><?php echo $email;?></a>
  </p>
<?php } } ?>
