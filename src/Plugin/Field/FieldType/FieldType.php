<?php

namespace Drupal\preethy_exercise\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Define the "field type".
 *
 * @FieldType(
 *   id = "field_type",
 *   label = @Translation("Field Type"),
 *   description = @Translation("Desc for Field Type"),
 *   category = @Translation("Text"),
 *   default_widget = "field_widget",
 *   default_formatter = "Field_formatter",
 * )
 */
class FieldType extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    // Define the database schema for the field type.
    return [
      'columns' => [
        'value' => [
          'type' => 'varchar',
          'length' => $field_definition->getSetting("length"),
        ],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultStorageSettings() {
    // Set default storage settings for the field type.
    return [
      'length' => 255,
    ] + parent::defaultStorageSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function storageSettingsForm(array &$form, FormStateInterface $form_state, $has_data) {
    // Build the form for configuring the storage settings of the field type.
    $element = [];

    $element['length'] = [
      '#type' => 'number',
      '#title' => t("Length of your text"),
      '#required' => TRUE,
      '#default_value' => $this->getSetting("length"),
    ];
    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultFieldSettings() {
    // Set default field settings for the field type.
    return [
      'moreinfo' => "More info default value",
    ] + parent::defaultFieldSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function fieldSettingsForm(array $form, FormStateInterface $form_state) {
    // Build the form for configuring the field settings of the field type.
    $element = [];
    $element['moreinfo'] = [
      '#type' => 'textfield',
      '#title' => 'More information about this field',
      '#required' => TRUE,
      '#default_value' => $this->getSetting("moreinfo"),
    ];
    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    // Define the field properties for the field type.
    $properties['value'] = DataDefinition::create('string')->setLabel(t("Name"));

    return $properties;
  }

}
