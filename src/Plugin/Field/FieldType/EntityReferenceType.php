<?php

namespace Drupal\preethy_exercise\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Define the "entity_reference_type" field type.
 *
 * @FieldType(
 *   id = "entity_reference_type",
 *   label = @Translation("Entity Reference Type"),
 *   description = @Translation("Custom field type for entity references."),
 *   category = @Translation("Reference"),
 *    default_formatter = "custom_entity_reference_formatter",
 * )
 */
class EntityReferenceType extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    // Define the database schema for the field type.
    return [
      'columns' => [
        'target_id' => [
          'type' => 'int',
          'unsigned' => TRUE,
        ],
      ],
      'indexes' => [
        'target_id' => ['target_id'],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultStorageSettings() {
    // Set default storage settings for the field type.
    return [
      'target_type' => 'reference_entity',
    ] + parent::defaultStorageSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function storageSettingsForm(array &$form, FormStateInterface $form_state, $has_data) {
    // Build the form for configuring the storage settings of the field type.
    $element = [];

    // Add storage settings specific to your custom field type if needed.

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultFieldSettings() {
    // Set default field settings for the field type.
    return [
      'target_bundles' => [],
    ] + parent::defaultFieldSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function fieldSettingsForm(array $form, FormStateInterface $form_state) {
    // Build the form for configuring the field settings of the field type.
    $element = [];

    // Add field settings specific to your custom field type if needed.

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    // Define the field properties for the field type.
    $properties['target_id'] = DataDefinition::create('integer')
      ->setLabel(t('Target ID'));

    return $properties;
  }

}