<?php

namespace Drupal\preethy_exercise\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;


/**
 * Define the  field formatter".
 *
 * @FieldFormatter(
 *   id = "Field_formatter",
 *   label = @Translation("Field Formatter"),
 *   description = @Translation("Desc for  Field Formatter"),
 *   field_types = {
 *     "field_type"
 *   }
 * )
 */


class FieldFormatter extends FormatterBase {

    /**
     * {@inheritdoc}
     */
    public static function defaultSettings() {
        return [
            'concat' => 'Concat with ',
        ] + parent::defaultSettings();
    }

    /**
     * {@inheritdoc}
     */

    public function settingsForm(array $form, FormStateInterface $form_state) {
        $form['concat'] =[
            '#type' => 'textfield',
            '#title' => 'Concatenate with',
            '#default_value' => $this->getSetting('concat'),
        ];
        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function settingsSummary() {
        $summary = [];
        $summary[] = $this->t("concatenate with : @concat", ["@concat" => $this->getSetting('concat')]);
        return $summary;
    }

    /**
     * {@inheritdoc}
     */

     public function viewElements(FieldItemListInterface $items, $langcode) {
        $element = [];

        foreach ( $items as $delta => $item) {
            $element[$delta] = [
                '#markup' => $this->getSetting('concat') . $item->value,
            ];
        }
        return $element;
     }

}
