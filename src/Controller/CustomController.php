<?php

namespace Drupal\preethy_exercise\Controller;

// Base class for controller.
use Drupal\Core\Controller\ControllerBase;
use Drupal\preethy_exercise\CustomService;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * To include custom_service.
 */
class CustomController extends ControllerBase {
  /**
   * The customservice.
   *
   * @var \Drupal\preethy_exercise\CustomService
   */
  protected $customService;

  /**
   * Dependency injection.
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('custom_service')
    );
  }

  /**
   * Constructor.
   */
  public function __construct(CustomService $customService) {
    $this->customService = $customService;
  }

  /**
   * Function demo.
   */
  public function hello() {
    // Defining the rendering function.
    $data = $this->customService->getName();
    return [
    // Rendering the template.
      '#theme' => 'block_plugin_template',
    // Service value is passed.
      '#message' => $data,
    // Setting the hexcode color.
      '#hexcode' => '#a54170',
    ];
  }

}