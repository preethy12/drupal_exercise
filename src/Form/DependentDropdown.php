<?php

namespace Drupal\preethy_exercise\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Database\Connection;

/**
 * Creates DropdownForm.
 */
class DependentDropdown extends FormBase {

  /**
   * The database connection.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $database;

  /**
   * Constructs a new DependentDropdown object.
   *
   * @param \Drupal\Core\Database\Connection $database
   *   The database connection.
   */
  public function __construct(Connection $database) {
    $this->database = $database;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database')
    );
  }

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
    // Returns value of the location() method,
    // which provides options for the first dropdown field (category).
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
        'event' => 'change',
      ],
    ];
    $form['availableitems'] = [
      '#type' => 'select',
      '#title' => ' select state',
      '#options' => static::availableItems($cat),
      '#default_value' => !empty($form_state->getValue('availableitems')) ? $form_state->getValue('availableitems') : 'none',
      '#prefix' => '<div id="field-container"',
      '#suffix' => '</div>',
      '#ajax' => [
        'callback' => '::DropdownCallback',
        'wrapper' => 'dist-container',
        'event' => 'change',
      ],
    ];
    $form['district'] = [
      '#type' => 'select',
      '#title' => ' select district',
      '#options' => static::district($avai),
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

  /**
   * AJAX callback method that gets called when available items dropdown change.
   */
  public function dropdownCallback(array &$form, FormStateInterface $form_state) {
    $triggering_element = $form_state->getTriggeringElement();
    $triggering_element_name = $triggering_element['#name'];

    if ($triggering_element_name === 'category') {
      return $form['availableitems'];
    }
    elseif ($triggering_element_name === 'availableitems') {
      return $form['district'];
    }

  }

  /**
   * Function that provides list of options for country.
   */
  public function location() {
    return [
      'none' => '-none-',
      'india' => 'india',
      'Australia' => 'Australia',
    ];
  }

  /**
   * Function that provides list of option for the states.
   */
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

  /**
   * Function that provides list of option for the district.
   */
  public function district($avai) {
    switch ($avai) {
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
        $opt = [
          'Geelong' => 'Geelong',
          'kalkallo' => 'kalkallo',
          'lara' => 'lara',
        ];
        break;

      default:
        $opt = ['none' => '-none-'];
        break;
    }
    return $opt;
  }

}
