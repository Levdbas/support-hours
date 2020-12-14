<?php

namespace Support_Hours;

$name = $this->plugin_name;
$options = $this->options;
$current_color = get_user_option('admin_color');

$workFields = $this->work_fields;
$used_minutes = $this->used_minutes;
$bought_minutes = $this->bought_minutes;



/**
 * Searches our $workFields array for the last bought hours.
 * @since
 * @param  array   $workFields      The workfields from this plugin, contains bought and used hours
 * @return int                      Last bought hours in minute format
 */
function last_bought($workFields)
{
  $minutes = 0;
  if ($workFields != null) {
    $workFields = array_reverse($workFields); // invert array so we can search DESC
    $key = array_search('time-added', array_column($workFields, 'type')); // searching for the last time-added value in key 'type'

    if ($key !== false) : // if there is a key!
      $time = $workFields[$key]['used']; // take our time in HH:MM format from the field
      list($hour, $minute) = explode(':', $time); // explode the time
      $minutes += $hour * 60; // hours to minutes, add them to minutes
      $minutes += $minute; // add minutes to total as well.
    endif;
  }
  return $minutes;
}


function calculate_minutes_output($workFields, $used_minutes, $bought_minutes)
{
  $last_bought_minutes = last_bought($workFields);
  $bought_minus_last = $bought_minutes -  $last_bought_minutes;
  $minutes_to_spent = $bought_minutes - $used_minutes;


  // NOTE: calculates used hours
  if ($used_minutes > $bought_minus_last) {
    $used_minutes = $used_minutes - $bought_minus_last;
  } else {
    $used_minutes = $used_minutes;
  }

  // NOTE: calculates bought hours
  if ($minutes_to_spent < $last_bought_minutes) {
    $bought_minutes = $last_bought_minutes;
  } else {
    $bought_minutes = $bought_minutes;
  }

  return [
    'used_minutes' => $used_minutes,
    'bought_minutes' => $bought_minutes
  ];
}

function calculate_hours_and_minutes_output($minutes)
{
  $hours = floor($minutes / 60);
  $minutes -= $hours * 60;
  return sprintf('%02d:%02d', $hours, $minutes);
}

/**
 * function to strip the hours displayed in the clock of minutes if the hour is round.
 * @since
 * @param  [type] $minutes minutes, can be bought or used
 * @return string Retunrs full hour without zeros
 */
function maybe_hide_minutes($minutes)
{
  $time = sprintf("%02d:%02d", floor($minutes / 60), $minutes % 60);

  if ($minutes % 60 == 0) :
    $time = $minutes / 60;
  endif;

  return $time;
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
function widget_output($workFields, $used_minutes, $bought_minutes)
{
  $minutes = calculate_minutes_output($workFields, $used_minutes, $bought_minutes);

  $widget_hours = maybe_hide_minutes($minutes['used_minutes']) . ' / ' . maybe_hide_minutes($minutes['bought_minutes']);
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
function percentage($workFields, $used_minutes, $bought_minutes)
{

  $minutes = calculate_minutes_output($workFields, $used_minutes, $bought_minutes);

  $percentage = $minutes['used_minutes'] * 100 / $minutes['bought_minutes'];
  if ($percentage > 100) {
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
function font_size($used_minutes, $bought_minutes)
{
  $size = 'small';

  if ($used_minutes % 60 == 0 && $bought_minutes < 5940) :
    $size = 'big';
  endif;

  return 'sh-gauge__text--' . $size;
}


function get_notice($message, $notice_class = 'notice-alt')
{
  $notice = '';
  $notice .= '<div class="warning-message notice support-hours-notice inline ' . $notice_class . '">';
  $notice .= '<p>' . $message . '</p>';
  $notice .= '</div>';

  return $notice;
}

function the_notice($message, $notice_class = 'notice-alt')
{
  echo get_notice($message, $notice_class);
}
