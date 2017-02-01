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
  $users = $options['users'];
  $email = $options['email'];
  
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
  if(!empty($bought_hours_calc)){
    $percentage = $used_hours_calc * 100 / $bought_hours_calc;
    $percentage = round($percentage);
  }
 ?>
