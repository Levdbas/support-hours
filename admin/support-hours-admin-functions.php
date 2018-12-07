<?php

$options = get_option($this->plugin_name);
$name = $this->plugin_name;
$users = $options['users'];
$email = $options['email'];
//$static_time = $options['bought_hours'];
$current_color = get_user_option( 'admin_color' );
$workFields = $options['workFields'];

$used_minutes = AddTime($workFields, 'time-used', 'minutes');
$bought_minutes = AddTime($workFields, 'time-added', 'minutes');

/*
// NOTE: temp function to transform first set of hours to new hour system.
function transform_fixed_time($static_time, $workFields, $name, $options){
if($options['bought_hours'] != '00:00'){
echo "<h3>". __('Update of Support Hours complete, please refresh page', $name)."</h3>";
$newdata =  array (
'date' => date('d-m-Y'),
'description' => __('First bought time - added by Support Hours', $name),
'used' => $static_time,
'type' => 'time-added'
);
array_unshift($options['workFields'], $newdata);
//$options = array_diff_key($options, ['bought_hours' => "xy"]);

$options['workFields'] = array_map(function($arr){
return $arr + ['type' =>'time-used'];
}, $options['workFields']);

update_option($name, $options);
}
}
echo transform_fixed_time($static_time, $workFields, $name, $options);
*/

/**
 * Transforms $minutes to HH:MM
 * @since
 * @param  int $minutes minutes, can be bought or used
 * @return string          HH:MM
 */
function minutestoTime($minutes){
  return sprintf("%02d:%02d", floor($minutes/60), $minutes%60);  // 01:37
}

/**
 * function to strip the hours displayed in the clock of minutes if the hour is round.
 * @since
 * @param  [type] $minutes minutes, can be bought or used
 * @return string Retunrs full hour without zeros
 */
function minutestoTimeRound($minutes) {
  if($minutes % 60 == 0):
    $time = $minutes/60;
  else:
    $time = minutestoTime($minutes);
  endif;
  return $time;
}



/**
 * Checks the workfields array for the time fields. Adds all timefields and returns them.
 * If no workfields and therefore no time fields are filled, returns 00:00
 * @since   1.4
 * @param   array   $workFields   The workfields from this plugin, contains bought and used hours
 * @param   string  $type         can be used or bought
 * @param   string  $returns      if minutes returns total minutes
 * @return  string                Returns full hours format or total minutes of used or bought hours
 */
function AddTime($workFields, $type, $returns = null) {
  $output = 0;
  $minutes = 0;
  if($workFields != null){
    if(isset($workFields[0]['type'])):
      $workFields = array_filter($workFields, function ($var) use ($type) {
        return ($var['type'] == $type);
      });
      foreach ($workFields as $time) {
        //  Check if the field is not empty. Else stay with 0.
        if($time['type'] !== ""){
          list($hour, $minute) = explode(':', $time['used']);
          $minutes += $hour * 60;
          $minutes += $minute;
        }
      }
      if($returns == 'minutes'):
        $output =  $minutes;
      else:
        $hours = floor($minutes / 60);
        $minutes -= $hours * 60;
        $time = sprintf('%02d:%02d', $hours, $minutes);
        $output = $time;
      endif;
    endif;
  }
  return $output;
}



/**
 * Searches our $workFields array for the last bought hours.
 * @since
 * @param  array   $workFields      The workfields from this plugin, contains bought and used hours
 * @return int                      Last bought hours in minute format
 */
function last_bought($workFields){
  $minutes = 0;
  if($workFields != null){
    $workFields = array_reverse($workFields); // invert array so we can search DESC
    $key = array_search('time-added', array_column($workFields, 'type')); // searching for the last time-added value in key 'type'

    if($key !== false): // if there is a key!
      $time = $workFields[$key]['used']; // take our time in HH:MM format from the field
      list($hour, $minute) = explode(':', $time); // explode the time
      $minutes += $hour * 60; // hours to minutes, add them to minutes
      $minutes += $minute; // add minutes to total as well.
    endif;
    
  }
  return $minutes;
}



/**
 * To not overcluther the interface we only show the time you actually care about in the widget.
 * If multiple time hours are bought, and most of it was spent, we only want to see the
 * last bought hours and the hours left calculated against that.
 * This function is used to return all used minutes minus all the minutes prior to the last bought hours
 * so we can display the used hours correctly. Used in percentage() and widget_output()
 * @since
 * @param  array   $workFields      The workfields from this plugin, contains bought and used hours
 * @param  int     $bought_minutes  Total bought minutes
 * @return int                      minutes
 */
function bought_minus_last($workFields, $bought_minutes){
  $output = 0;

  if($workFields != null){
    $output = $bought_minutes - last_bought($workFields);
  }

  return $output;
}




/**
 * This function is being used to display the hours in the widget.
 * Output depends on time spent, time bought and time bought the last time.
 * @since 1.4
 * @param  array  $workFields     The workfields from this plugin, contains bought and used hours
 * @param  int    $used_minutes   Total used minutes
 * @param  int    $bought_minutes Total bought minutes
 * @return string                 Returns hours in HH:MM format or HH format where the first is used time, the second the bought time.
 */
function widget_output($workFields, $used_minutes, $bought_minutes){
  $bought_minus_last = bought_minus_last($workFields, $bought_minutes);
  $minutes_to_spent = $bought_minutes - $used_minutes;
  $last_bought_minutes = last_bought($workFields);

  // NOTE: calculates used hours
  if($used_minutes > $bought_minus_last){
    $used_minutes = $used_minutes - $bought_minus_last;
  } else{
    $used_minutes = $used_minutes;
  }

  // NOTE: calculates bought hours
  if($minutes_to_spent < $last_bought_minutes){
    $bought_minutes = $last_bought_minutes;
  } else{
    $bought_minutes = $bought_minutes;
  }

  $widget_hours = minutestoTimeRound($used_minutes).' / '.minutestoTimeRound($bought_minutes);
  return $widget_hours;
}




/**
 * used for calculating the hours left in the notices
 * and in the widget to animate the circle.
 * @since
 * @param  array  $workFields     The workfields from this plugin, contains bought and used hours
 * @param  int    $used_minutes   Total used minutes
 * @param  int    $bought_minutes Total bought minutes
 * @return int                    Calculated percentage
 */
function percentage($workFields, $used_minutes, $bought_minutes){

  $bought_minus_last = bought_minus_last($workFields, $bought_minutes);
  $minutes_to_spent = $bought_minutes - $used_minutes;
  $last_bought_minutes = last_bought($workFields);

  // NOTE: calculates used hours
  if($used_minutes > $bought_minus_last){
    $used_minutes = $used_minutes - $bought_minus_last;
  } else{
    $used_minutes = $used_minutes;
  }

  // NOTE: calculates bought hours
  if($minutes_to_spent < $last_bought_minutes){
    $bought_minutes = $last_bought_minutes;
  } else{
    $bought_minutes = $bought_minutes;
  }

  $percentage = $used_minutes * 100 / $bought_minutes;
  if($percentage > 100){
    $percentage = 100;
  }
  $percentage = round($percentage);
  return $percentage;

}



/**
 * Control the font size of the time in the widget
 * big font size if time doesn't include :00 (minutes)
 * and bought hours are less then 99 hours. Otherwise UI will be too cluttered.
 * @since
 * @param  int    $used_minutes   Total used minutes
 * @param  int    $bought_minutes Total bought minutes
 * @return string                 small or big, this is used in our css to display the correct font size
 */
function font_size($used_minutes, $bought_minutes){
  $size = 'small';

  if($used_minutes %60 == 0 && $bought_minutes < 5940):
    $size = 'big';
  endif;

  return $size;
}



?>
