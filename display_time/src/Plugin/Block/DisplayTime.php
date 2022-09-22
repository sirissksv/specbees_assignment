<?php

namespace Drupal\display_time\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\display_time\CustomTimeService;
/**
 * Provides a display time block.
 *
 * @Block(
 *   id = "display_time",
 *   admin_label = @Translation("Display Time"),
 * )
 */

class DisplayTime extends BlockBase implements ContainerFactoryPluginInterface {
  
    protected $gettimezone;
  /**
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   * @param \Drupal\Core\Session\AccountInterface $account
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, CustomTimeService $gettimezone) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->gettimezone = $gettimezone;
   
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('display_time.custom_time_service')
    );
  }
  
  /**
   * {@inheritdoc}
   */
  public function build() {
    // $build = [];
    $time = $this->gettimezone->getUserTimeZone();
    $config = \Drupal::config('timezone.adminsettings');  
    $country = $config->get('country');
    $city = $config->get('city');
    return array(
      '#theme' => 'display_time_template',
      '#country' => $country,
      '#city' => $city,
      '#time' => $time,
       '#cache' => [
          'max-age' => 30,
          'tags' => ['user: administer'],   // for dependencies on data managed by Drupal, like entities & configuration.
          'contexts' => ['user'],
        ],
  );
    // $build['display_time_block']['#markup'] = '<p>Your Location is' . $country .' , ' . $city . $time.'</p>';

    // return $build;
  }

}
