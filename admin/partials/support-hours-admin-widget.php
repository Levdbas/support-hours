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
 //swidgetDisplay();
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
        <?php echo __( 'hours', 'support-hours'); ?>
        <?php if($size == "big"){
          echo "<br class='bigbr' />";
        } ?>
        <?php echo __( 'used', 'support-hours'); ?>
      </span>
    </span>
  </div>
</div>
    <p>
      <?php if($percentage == 100) {?>
          <?php echo __( 'Support hours used.', 'support-hours'); ?><br />
        <?php } elseif($percentage >= 80) {?>
          <?php echo __( 'Support hours almost used.', 'support-hours'); ?><br />
      <?php } else {?>
        <?php echo __( 'Need more support hours?', 'support-hours'); ?><br />
      <?php } ?>
      <?php echo __( 'Contact me via', 'support-hours'); ?>
      <a href="mailto:<?php echo $email;?>"><?php echo $email;?></a>
    </p>
<?php } else { ?>
  <?php if(empty($users)){ ?>
    <p>
      <a class="button button-primary button-hero load-customize hide-if-no-customize" href="<?php echo admin_url( 'options-general.php?page=support-hours' ); ?>"><?php echo __( 'Configure plugin!', 'support-hours'); ?></a>
    </p>
<?php } else{ ?>
  <h4><?php echo __( 'No support Hours bought', 'support-hours'); ?></h4>
  <p>
    <?php echo __( 'Contact me via', 'support-hours'); ?>
    <a href="mailto:<?php echo $email;?>"><?php echo $email;?></a>
  </p>
<?php } } ?>
