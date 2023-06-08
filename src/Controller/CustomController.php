<?php

namespace Drupal\preethy_exercise\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * This is the controller for block plugin template.
 */
class CustomController extends ControllerBase {

  /**
   * Gets called when the route is matched.
   */
  public function hello() {
    $data = \Drupal::service("custom_service")->getName();
    return [
      '#theme' => "block_plugin_template",
      '#text' => $data,
      '#hexcode' => '#800080',
    ];

  }

}
