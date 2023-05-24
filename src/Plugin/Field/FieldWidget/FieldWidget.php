<?php

namespace Drupal\preethy_exercise\Plugin\Field\FieldWidget;

use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;


/**
 * Define the "field type".
 *
 * @FieldWidget(
 *   id = "field_widget",
 *   label = @Translation(" Field Widget"),
 *   description = @Translation("Desc for Field Widget"),
 *   field_types = {
 *     "field_type"
 *   }
 * )
 */
class FieldWidget extends WidgetBase {

    /**
     * {@inheritdoc}
     */

     public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
     #If the value doesn't exist or is null, an empty string is assigned
        $value = isset($items[$delta]->value) ? $items[$delta]->value : "";
     #initializes the $element variable with the existing value of $element and adds an array of settings and attributes to it. The + operator is used to merge the arrays.
        $element = $element + [
            '#type' => 'textfield',
            '#suffix' => "<span>" . $this->getFieldSetting("moreinfo") . "</span>",
            '#default_value' => $value,
            '#attributes' => [
                'placeholder' => $this->getSetting('placeholder'),
            ],
        ];
        return ['value' => $element];
     }

     /**
      * {@inheritdoc}
      */
      public static function defaultSettings() {
        # returns an array of default settings for the class
        return [
            'placeholder' => 'default',
        ] + parent::defaultSettings();
      }

      /**
       * {@inheritdoc}
       */
      public function settingsForm(array $form, FormStateInterface $form_state) {
        $element['placeholder'] = [
            '#type' => 'textfield',
            '#title' => 'Placeholder text',
            '#default_value' => $this->getSetting('placeholder'),
        ];
        return $element;
      }

      /**
       * {@inheritdoc}
       */
      public function settingsSummary() {
        $summary = [];
        $summary[] = $this->t("placeholder text: @placeholder", array("@placeholder" => $this->getSetting("placeholder")));
        return $summary;
      }


}