<?php

$options = get_option($this->plugin_name);
$name = $this->plugin_name;
$users = $options['users'];
$email = $options['email'];
$static_time = $options['bought_hours'];
$current_color = get_user_option( 'admin_color' );
$workFields = $options['workFields'];

$used_minutes = AddTime($workFields, 'time-used', 'minutes');
$bought_minutes = AddTime($workFields, 'time-added', 'minutes');

//$used_hours = AddTime($workFields, 'time-used');
//$bought_hours = AddTime($workFields, 'time-added');

// NOTE: temp function to transform first set of hours to new hour system.
function transform_fixed_time($static_time, $workFields, $name, $options){
  if($options['bought_hours'] != '00:00'){
    $newdata =  array (
      'date' => date('d-m-Y'),
      'description' => __('First bought time - added by Support Hours', $name),
      'used' => $static_time,
      'type' => 'time-added'
    );
    array_unshift($options['workFields'] , $newdata);
    $options = array_diff_key($options, ['bought_hours' => "xy"]);
    update_option($name, $options);
  }
}
echo transform_fixed_time($static_time, $workFields, $name, $options);

function minutestoTime($minutes){
  return sprintf("%02d:%02d", floor($minutes/60), $minutes%60);  // 01:37
}
// function to strip the hours displayed in the clock of minutes if the hour is round.
function minutestoTimeRound($minutes) {
  if($minutes %60 == 0):
    $time = $minutes/60;
  else:
    $time = minutestoTime($minutes);
  endif;
  return $time;
}

/*
Checks the workfields for the time fields. Adds all timefields and returns them.
If no workfields and therefore no time fields are filled, returns 00:00
*/

function AddTime($workFields, $type, $returns = null) {
  if($workFields != null){
    $minutes = 0;

    $workFields = array_filter($workFields, function ($var) use ($type) {
        return ($var['type'] == $type);
    });

    foreach ($workFields as $time) {
      //  Check if the field is not empty. Else stay with 0.
      if($time[$type] !== ""){
        list($hour, $minute) = explode(':', $time['used']);
        $minutes += $hour * 60;
        $minutes += $minute;
      }
    }
    if($returns == 'minutes'):
      return $minutes;
    else:
      $hours = floor($minutes / 60);
      $minutes -= $hours * 60;
      $time = sprintf('%02d:%02d', $hours, $minutes);
      return $time;
    endif;
  } else{
    return "00:00";
  }
}

function last_bought($workFields){
  if($workFields != null){
    $workFields = array_reverse($workFields);
    $key = array_search('time-added', array_column($workFields, 'type'));
    $time = $workFields[$key]['used'];
    list($hour, $minute) = explode(':', $time);
    $minutes += $hour * 60;
    $minutes += $minute;
  }
  return $minutes;
}


function widget_output($workFields, $used_minutes, $bought_minutes){
  $minutes_to_spent = $bought_minutes - $used_minutes;
  $last_bought_minutes = last_bought($workFields);
  // NOTE: calculates spent hours

  if($used_minutes > $last_bought_minutes){
    $used_minutes = $last_bought_minutes - $used_minutes;
  } else{
    $used_minutes = $used_minutes;
  }
  // NOTE: returns hours left
  if($minutes_to_spent < $last_bought_minutes){
    $bought_minutes = $last_bought_minutes;
  } else{
    $bought_minutes = $bought_minutes;
  }
  $widget_hours = minutestoTimeRound($used_minutes).' / '.minutestoTimeRound($bought_minutes);
  return $widget_hours;
}

function percentage($used_minutes, $bought_minutes){

  if($used_minutes > $bought_minutes){
    $used_hours = $bought_hours;
  }
  if(!empty($bought_minutes)){
    $percentage = $used_minutes * 100 / $bought_minutes;
    if($percentage > 100){
      $percentage = 100;
    }
    $percentage = round($percentage);
    return $percentage;
  }
}


// function to control the font size
function font_size($used_hours){
  if (strpos($used_hours, ':') !== false){
    $size = 'small';
  } else{
    $size = 'big';
  }
  return $size;
}



?>