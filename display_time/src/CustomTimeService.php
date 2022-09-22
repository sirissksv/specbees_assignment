<?php
namespace Drupal\display_time;
/**
* @file providing the service that return current timezone
*
*/

/**
 * Class CustomTimeService.
 */
class CustomTimeService {
  
  /**
   * Return timezone of the selected location from form
   */
  public function getUserTimeZone(){

    $timezone = $config->get('timezone');

    $date = new \DateTime("now", new \DateTimeZone($timezone) );

    $new_timestamp = clone $date;

    $today = $new_timestamp->format("j, M Y - g:i ,a");

    $today = explode(',', $today);

    $current_time = $today[0].'th'.$today[1].strtoupper($today[2]);

    return $current_time;
    
  }
}
