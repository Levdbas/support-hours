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
  function hoursToMinutes($hours)
  {
    $minutes = 0;
    if (strpos($hours, ':') !== false)
    {
        list($hours, $minutes) = explode(':', $hours);
    }
    return $hours * 60 + $minutes;
  }
  function minuszeros($hours2)
  {
    $minutes = 0;
    if (preg_match("/0+([1-9])/", $hours2) == true) {
      $hours2 = ltrim($hours2, '0');
    }elseif(preg_match("/00:00/", $hours2) == true){
      $hours2 = substr($hours2, 1);
    }
    if (strpos($hours2, ':00') !== false) {
        list($hours2, $minutes) = explode(':', $hours2);
    }
    return $hours2;
  }

  $options = get_option($this->plugin_name);
  $used_hours_calc = hoursToMinutes($options['used_hours']);
  $used_hours = new DateTime($options['used_hours']);
  $used_hours = $used_hours->format('H:i');
  $used_hours= minuszeros($used_hours);
  $bought_hours_calc = hoursToMinutes($options['bought_hours']);
  $bought_hours = new DateTime($options['bought_hours']);
  $bought_hours = $bought_hours->format('H:i');
  $bought_hours= minuszeros($bought_hours);
  $current_color = get_user_option( 'admin_color' );
  if (strpos($used_hours, ':') !== false){
    $size = 'small';
  } else{
    $size = 'big';
  }
  if($used_hours_calc > $bought_hours_calc){
    $used_hours = $bought_hours;
  }

  $email = $options['email'];
  if(!empty($bought_hours_calc)){
    $percentage = $used_hours_calc * 100 / $bought_hours_calc;
    $percentage = round($percentage)/100;
  }
?>
<?php if(!empty($bought_hours_calc)) { ?>
    <div class="outerCircle">
      <div class="circle <?php echo $current_color;?>" id="circle" data-Circle="<?php echo $percentage; ?>">
        <div class="arc_q"></div>
        <div class="inner">
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
          <?php echo __( 'Support hours used.', 'support-hours'); ?><br />
        <?php } elseif($percentage > 0.8) {?>
          <?php echo __( 'Support hours almost used.', 'support-hours'); ?><br />
      <?php } else {?>
        <?php echo __( 'Need more support hours?', 'support-hours'); ?><br />
      <?php } ?>
      <?php echo __( 'Contact me via', 'support-hours'); ?>
      <a href="mailto:<?php echo $email;?>"><?php echo $email;?></a>
    </p>
<?php } else { ?>
  <?php if(empty($email)){ ?>
    <p>
      <a href="<?php echo admin_url( 'options-general.php?page=support-hours' ); ?>"><?php echo __( 'Configure plugin!', 'support-hours'); ?></a>
    </p>
<?php } else{ ?>
  <h4><?php echo __( 'No support Hours bought', 'support-hours'); ?></h4>
  <p>
    <?php echo __( 'Contact me via', 'support-hours'); ?>
    <a href="mailto:<?php echo $email;?>"><?php echo $email;?></a>
  </p>
<?php } } ?>
