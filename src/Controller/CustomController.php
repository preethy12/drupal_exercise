<?php

namespace Drupal\preethy_exercise\Controller;

use Drupal\your_module_name\CustomServiceInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Drupal\Core\Controller\ControllerBase;

/**
 * This is the controller for block plugin template.
 */
class CustomController extends ControllerBase {
  /**
   * The custom service.
   *
   * @var \Drupal\preethy_exercise\CustomService
   */

  /**
   * Creating custom service.
   */
  public function __construct(CustomServiceInterface $customService) {
    $this->customService = $customService;
  }

  /**
   * Return the service.
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('preethy_exercise.custom_service')
    );
  }

  /**
   * Gets called when the route is matched.
   */
  public function hello() {
    $data = $this->customService->getName();
    return [
      '#theme' => "block_plugin_template",
      '#text' => $data,
      '#hexcode' => '#800080',
    ];

  }

}
