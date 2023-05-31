<?php

namespace Drupal\preethy_exercise\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Link;

class DependentDropDown extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'dependent_dropdown_Form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
# return value of the location() method, which provides options for the first dropdown field (category).
    $opt = $this->location();
    $cat = $form_state->getValue('category') ?: 'none';
    $avai = $form_state->getValue('availableitems') ?: 'none';
    $form['category'] = [
        '#type' => 'select',
        '#title' => ' select country',
        '#options' => $opt,
        'default_value' => $cat,
        '#ajax' => [
            'callback' => '::DropdownCallback',
            'wrapper' => 'field-container',
            'event' => 'change'
        ]
    ];
    $form['availableitems'] = [
        '#type' => 'select',
        '#title' => ' select state',
        '#options' =>static::availableItems($cat),
        '#default_value' => !empty($form_state->getValue('availableitems')) ? $form_state->getValue('availableitems') : 'none',
        '#prefix' => '<div id="field-container"',
        '#suffix' => '</div>',
        '#ajax' => [
          'callback' => '::DropdownCallback',
          'wrapper' => 'dist-container',
          'event' => 'change'
      ]
    ];
    $form['district'] = [
          '#type' => 'select',
          '#title' => ' select district',
          '#options' =>static::district($avai),
          '#default_value' => !empty($form_state->getValue('district')) ? $form_state->getValue('district') : '',
          '#prefix' => '<div id="dist-container"',
          '#suffix' => '</div>',
    ];
    $form['submit'] = [
        '#type' => 'submit',
        '#value' => 'Submit',
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $trigger = (string) $form_state->getTriggeringElement()['#value'];
    if ($trigger != 'submit') {
        $form_state->setRebuild();
    }
  }
  #This method is the AJAX callback function that is triggered when the category or available items dropdowns change.

  public function DropdownCallback(array &$form, FormStateInterface $form_state) {
    $triggering_element = $form_state->getTriggeringElement();
    $triggering_element_name = $triggering_element['#name'];


    if ($triggering_element_name === 'category') {
      return $form['availableitems'];
    }
    elseif ($triggering_element_name === 'availableitems') {
      return $form['district'];
    }


  }

  public function location() {
    return [
        'none' => '-none-',
        'india' => 'india',
        'Australia' => 'Australia',
    ];
  }
//function that provides list of option for the Country.

  public function availableItems($cat) {
    switch ($cat) {
        case 'india':
            $opt = [
                'karnataka' => 'karnataka',
                'Bihar' => 'Bihar',
            ];
        break;
        case 'Australia':
          $opt = [
              'Victoria' => 'Queensland',
              'Western Australia' => 'Western Australia',
          ];
      break;

        default:
          $opt = ['none' => '-none-'];
        break;
    }
    return $opt;
  }
//function that provides list of option for the states.
  public function district($avai) {
    switch($avai) {
      case 'karnataka':
        $opt = [
          'kodagu' => 'kodagu',
          'Mysore' => 'Mysore',
          'mangalore' => 'mangalore',
        ];
      break;
      case 'Bihar':
        $opt = [
          'Muzzafarpur' => 'Muzzafarpur',
          'Aurangabad' => 'aurangabad',
        ];
      break;
      case 'Victoria':
        $opt=[
          'Geelong'=>'Geelong',
          'kalkallo'=>'kalkallo',
          'lara'=>'lara',
        ];
        break;
        default:
          $opt = ['none' => '-none-'];
        break;
    }
    return $opt;
  }



}