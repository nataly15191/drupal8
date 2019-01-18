<?php

namespace Drupal\hubspot_api;

use Drupal\Core\Config\ConfigFactoryInterface;
use SevenShores\Hubspot\Factory;

/**
 * Hubspot API Manager
 */
class Manager {

  /**
   * The config for HubSpot.
   *
   * @var \Drupal\Core\Config\ImmutableConfig
   */
  protected $config;

  /**
   * Constructs a new HubSpot service instance.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The config factory.
   */
  public function __construct(ConfigFactoryInterface $config_factory) {
    $this->config = $config_factory->get('hubspot_api.settings');
  }

  /**
   * {@inheritdoc}
   */
  public function getHandler() {
    $key = $this->config->get('access_key');
    if (empty($key)) {
      // THROW ERROR HERE
      return NULL;
    }

    return Factory::create($key);
  }

}
