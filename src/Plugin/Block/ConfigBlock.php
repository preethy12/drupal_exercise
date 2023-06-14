<?php

namespace Drupal\preethy_exercise\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Entity\EntityFieldManagerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides simple block for d4drupal.
 *
 * @Block (
 * id = "preethy_exercise",
 * admin_label = "Config Plugin Block"
 * )
 */
class ConfigBlock extends BlockBase implements ContainerFactoryPluginInterface {

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
   * Rendering the dependency injection.
   */
  public function build() {
    // Render function.
    $form = $this->entityFieldManager->getForm('\Drupal\preethy_exercise\Form\CustomConfigForm');
    return $form;
  }

}
