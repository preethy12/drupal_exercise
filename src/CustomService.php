<?php

namespace Drupal\preethy_exercise;

use Drupal\Core\Config\ConfigFactory;
//when we want to use multipletimes

/**
 * Class CustomService.
 *
 * @package Drupal\preethy_exercise\Services
 */
class CustomService {

  /**
   * Configuration Factory.
   *
   * @var \Drupal\Core\Config\ConfigFactory
   */
  protected $configFactory;

  /**
   * Constructor.
   */
  public function __construct(ConfigFactory $configFactory) {
    $this->configFactory = $configFactory;
  }

  /**
   * Gets my setting.
   */
  public function getName() {
    $config = $this->configFactory->get('preethy_exercise.settings');
    return $config->get('fullname');//will return the name when we submit the form
  }

}