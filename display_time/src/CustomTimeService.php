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

    $config = \Drupal::config('timezone.adminsettings');  
    
    $timezone = $config->get('timezone');
   
    $date = new \DateTime("now", new \DateTimeZone($timezone) );

    $today = explode(',' ,date("j, M Y - g:i ,a", strtotime($date))); 

    $current_time = $today[0].'th'.$today[1].strtoupper($today[2]);

    return $current_time;
  }
}