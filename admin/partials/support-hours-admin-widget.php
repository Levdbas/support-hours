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
  $percentage = $used_hours * 100 / $bought_hours;
  $percentage = round($percentage);
?>
<?php if(!empty($used_hours)) { ?>
<div class="c100 big p<?php echo $percentage; ?>">
  <span><?php if(!empty($used_hours)) echo $used_hours; ?> / <?php if(!empty($bought_hours)) echo $bought_hours; ?> <?php echo __( 'hour', 'support-hours'); ?></span>
  <div class="slice">
    <div class="bar"></div>
    <div class="fill"></div>
  </div>
</div>
<div class="clear">
</div>
<?php } else { ?>
  <h4><?php echo __( 'No support hours bought', 'support-hours'); ?></h4>
  <p>
    <?php echo __( 'Contact me via', 'support-hours'); ?>
    <a href="mailto:erik@basedonline.nl">erik@basedonline.nl</a>
  </p>

<?php } ?>
