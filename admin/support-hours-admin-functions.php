<?php

$options = get_option($this->plugin_name);
$users = $options['users'];
$email = $options['email'];
$current_color = get_user_option( 'admin_color' );
$workFields = $options['workFields'];
$used_hours = AddTime($workFields, 'time-used');
$bought_hours = AddTime($workFields, 'time-added');


// function to explode on hours and calculates them to minutes.
function hoursToMinutes($hours){
  $minutes = 0;
  if (strpos($hours, ':') !== false)
  {
    list($hours, $minutes) = explode(':', $hours);
  }
  return $hours * 60 + $minutes;
}

// function to strip the hours displayed in the clock of minutes if the hour is round.
function minuszeros($hours2) {
  $minutes = 0;
  if (preg_match("/0+([1-9]:)/", $hours2) == true) {
    $hours2 = ltrim($hours2, '0');
  } elseif(preg_match("/00:00/", $hours2) == true){
    $hours2 = substr($hours2, 1);
  }
  if (strpos($hours2, ':00') !== false) {
    list($hours2, $minutes) = explode(':', $hours2);
  }
  return $hours2;
}

/*
Checks the workfields for the time fields. Adds all timefields and returns them.
If no workfields and therefore no time fields are filled, returns 00:00
*/

function AddTime($workFields, $returns) {
  if($workFields != null){
    $minutes = 0;
    foreach ($workFields as $time) {
      //  Check if the field is not empty. Else stay with 0.
      if($time['used'] !== ""){
        if($returns == 'all'){
          list($hour, $minute) = explode(':', $time['used']);
          $minutes += $hour * 60;
          $minutes += $minute;
        } elseif($time['type'] == $returns){
          list($hour, $minute) = explode(':', $time['used']);
          $minutes += $hour * 60;
          $minutes += $minute;
        }

      }
    }
    $hours = floor($minutes / 60);
    $minutes -= $hours * 60;
    $time = sprintf('%02d:%02d', $hours, $minutes);

    return $time;
  } else{
    return "00:00";
  }
}

function last_bought($workFields){
  if($workFields != null){
    $workFields =array_reverse($workFields);
    $key = array_search('time-added', array_column($workFields, 'type'));
    $output = $workFields[$key]['used'];
  }
  return $output;
}


function widget_output($workFields, $used_hours, $bought_hours, $output_type){
  $hours_to_spent = $bought_hours - $used_hours;
  $last_bought_hours = last_bought($workFields);

  // NOTE: calculates spent hours
  if($used_hours > $last_bought_hours){
    $used_hours = $used_hours - $last_bought_hours;
  } else{
    $used_hours = $used_hours;
  }
  // NOTE: returns hours left
  if($hours_to_spent < $last_bought_hours){
    $bought_hours = $last_bought_hours;
  } else{
    $bought_hours = $bought_hours;
  }

  // calculates percentage.
  $percentage = percentage($used_hours, $bought_hours);

  $left_display = minuszeros($used_hours);
  $right_display = minuszeros($bought_hours);
  $widget_hours = $left_display.' / '.$right_display;

  switch ($output_type) {
    case 'time':
      $output = $widget_hours;
      break;
      case 'percentage':
        $output = $percentage;
        break;
    default:
      // code...
      break;
  }
  return $output;
}

function percentage($used_hours, $bought_hours){
  $used_hours_calc = hoursToMinutes($used_hours);
  $bought_hours_calc = hoursToMinutes($bought_hours);

  if($used_hours_calc > $bought_hours_calc){
    $used_hours = $bought_hours;
  }
  if(!empty($bought_hours_calc)){
    $percentage = $used_hours_calc * 100 / $bought_hours_calc;
    if($percentage > 100){
      $percentage = 100;
    }
    $percentage = round($percentage);
    return $percentage;
  }
}


// set of vars used in different files and functions.




function font_size($used_hours){
  if (strpos($used_hours, ':') !== false){
    $size = 'small';
  } else{
    $size = 'big';
  }
  return $size;
}



?>
