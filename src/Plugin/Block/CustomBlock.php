<?php

namespace Drupal\preethy_exercise\Plugin\Block;

use Drupal\Core\Entity\EntityFieldManagerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Drupal\Core\Block\BlockBase;

/**
 * Provides simple block for d4drupal.
 *
 * @Block (
 * id = "custom_general",
 * admin_label = "Custom Plugin Block"
 * )
 */
class CustomBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('entity_field.manager')
    );
  }

  /**
   * The entity field manager.
   *
   * @var \Drupal\Core\Entity\EntityFieldManagerInterface
   */
  protected $entityFieldManager;

  /**
   * Creating constructor to accept the EntityFieldManagerInterface.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, EntityFieldManagerInterface $entityFieldManager) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->entityFieldManager = $entityFieldManager;
  }

  /**
   * Render function.
   */
  public function build() {
    // Render function.
    $form = \Drupal::formBuilder()->getForm('\Drupal\preethy_exercise\Form\CustomForm');
    return $form;

  }

}
