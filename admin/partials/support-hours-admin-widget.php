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
<?php
  $options = get_option($this->plugin_name);
  $bought_hours = $options['bought_hours'];
  $used_hours = $options['used_hours'];
  if($used_hours > $bought_hours){
    $used_hours = $bought_hours;
  }
  if($used_hours == 00) {
    $used_hours_view = 0;
  } else{
    $used_hours_view = $used_hours;
  }

  $email = $options['email'];
  if(!empty($bought_hours)){
    $percentage = $used_hours * 100 / $bought_hours;
    $percentage = round($percentage)/100;
  }
?>
<?php if(!empty($bought_hours)) { ?>
    <div class="outerCircle">
      <div class="circle" id="circle" data-Circle="<?php echo $percentage; ?>">
        <div class="arc_q"></div>
        <div class="inner">
          <div class="innerCicle">
            <span class="textHolder">
              <span class="text"><?php if(!empty($used_hours)) echo $used_hours_view; ?> / <?php if(!empty($bought_hours)) echo $bought_hours; ?> <?php echo __( 'hour', 'support-hours'); ?><br /><?php echo __( 'used', 'support-hours'); ?></span>
            </span>
          </div>
        </div>
          <div class="outer">
          </div>
          <div class="center">
          </div>
          <div class="arc_q"></div>
          <div class="arc_q"></div>
          <div class="arc_q"></div>
        <div class="cover"></div>
      </div>
    </div>
    <p>
      <?php if($percentage == 1) {?>
          <?php echo __( 'Support-hours used.', 'support-hours'); ?><br />
        <?php } elseif($percentage == 1) {?>
          <?php echo __( 'Support-hours almost used.', 'support-hours'); ?><br />
      <?php } else {?>
        <?php echo __( 'Need more support-hours?', 'support-hours'); ?><br />
      <?php } ?>
      <?php echo __( 'Contact me via', 'support-hours'); ?>
      <a href="mailto:<?php echo $email;?>"><?php echo $email;?></a>
    </p>
<?php } else { ?>
  <h4><?php echo __( 'No support-hours bought', 'support-hours'); ?></h4>
  <p>
    <?php echo __( 'Contact me via', 'support-hours'); ?>
    <a href="mailto:<?php echo $email;?>"><?php echo $email;?></a>
  </p>

<?php } ?>
