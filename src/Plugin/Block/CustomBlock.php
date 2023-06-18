<?php

namespace Drupal\preethy_exercise\Plugin\Block;

// Using this as base class for the block.
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormBuilderInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a simple block for custom form.
 *
 * @Block(
 * id="custom_form_example",
 * admin_label="custom form block",
 * )
 */
class CustomBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The form builder service.
   *
   * @var \Drupal\Core\Form\FormBuilderInterface
   */
  protected $formBuilder;

  /**
   * Constructs a HelloBlock object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin ID for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Form\FormBuilderInterface $form_builder
   *   The form builder.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, FormBuilderInterface $form_builder) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->formBuilder = $form_builder;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    // Instantiate this block class.
    return new static($configuration, $plugin_id, $plugin_definition,
      // Load the service required to construct this class.
      $container->get('form_builder')
    );
  }

  /**
   * {@inheritDoc}
   */
  public function build() {
    // This service will return customform in the block.
    $form = $this->formBuilder->getForm('Drupal\preethy_exercise\Form\CustomForm');
    return $form;
  }

}
