<?php

namespace Drupal\preethy_exercise\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Implements the example form.
 */
class CountryStateDistrictForms extends FormBase {
  /**
   * The Messenger service.
   *
   * @var Drupal\Core\Database\Connection
   */
  protected $database;

  /**
   * Constructs InviteByEmail .
   *
   * @param \Drupal\Core\Database\Connection $database
   *   The database service.
   */
  public function __construct(Connection $database) {
    $this->database = $database;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database'),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'dropdown_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $country_id = $form_state->getValue("country");

    $state_id = $form_state->getValue("state");

    $form['country'] = [
      // Is of type select.
      '#type' => 'select',
      // Title.
      '#title' => 'CHOOSE COUNTRY',
      // Will give the list of country.
      '#options' => $this->getCountryOptions(),
      '#empty_option'  => '-select-',
      '#ajax' => [
      // Function defined for ajax.
        'callback' => '::dropdownCallback',
      // Specifies id that will be updated with ajax response.
        'wrapper' => 'field-container',
      // Since it of type select.
        'event' => 'change',
      ],
    ];

    // Creating a form for state.
    $form['state'] = [
    // Is of type select.
      '#type' => 'select',
    // Title.
      '#title' => 'CHOOSE STATE',
    // Will return list of state.
      '#options' => $this->getStateOptions($country_id),
      '#empty_option'  => '-select-',
      '#prefix' => '<div id="field-container"',
      '#suffix' => '</div>',
      '#ajax' => [
    // Function defined for ajax.
        'callback' => '::dropdownCallback',
    // Specifies id that will be updated with ajax response.
        'wrapper' => 'dist-container',
    // Since it of type select.
        'event' => 'change',
      ],
    ];

    // Creating a form for district.
    $form['district'] = [
    // Is of type select.
      '#type' => 'select',
    // Title.
      '#title' => 'CHOOSE DISTRICT',
    // Will return list of district.
      '#options' => $this->getDistrictOptions($state_id),
      '#empty_option'  => '-select-',
      '#prefix' => '<div id="dist-container"',
      '#suffix' => '</div>',
    ];
    // Submitting the form.
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
    // Submit form.
    // Value will be stored.
    $trigger = (string) $form_state->getTriggeringElement()['#value'];
    if ($trigger != 'submit') {
      // If value is not submitted it will be triggered.
      $form_state->setRebuild();
    }
  }

  /**
   * Function for ajax dropdown.
   */
  public function dropdownCallback(array &$form, FormStateInterface $form_state) {
    // This has a ajax callback which will be.
    // Triggered when value of dropdown changes.
    // Getting the getTriggeringElement.
    $triggering_element = $form_state->getTriggeringElement();
    $triggering_element_name = $triggering_element['#name'];

    if ($triggering_element_name === 'country') {
      // Lists the state for the particular country.
      return $form['state'];
    }
    elseif ($triggering_element_name === 'state') {
      // Lists the district for the particular state.
      return $form['district'];
    }

  }

  /**
   * Function to retrieve country options.
   */
  public function getCountryOptions() {
    $query = $this->database->select('country', 'c');
    $query->fields('c', ['id', 'name']);
    $result = $query->execute();
    $options = [];

    foreach ($result as $row) {
      $options[$row->id] = $row->name;
    }
    return $options;
  }

  /**
   * Function to retrieve state options.
   */
  public function getStateOptions($country_id) {
    $query = $this->database->select('state', 's');
    $query->fields('s', ['id', 'country_id', 'name']);
    $query->condition('s.country_id', $country_id);
    $result = $query->execute();
    $options = [];

    foreach ($result as $row) {
      $options[$row->id] = $row->name;
    }
    return $options;
  }

  /**
   * Function to retrieve district options.
   */
  public function getDistrictOptions($state_id) {
    $query = $this->database->select('district', 'd');
    $query->fields('d', ['id', 'state_id', 'name']);
    $query->condition('d.state_id', $state_id);
    $result = $query->execute();
    $options = [];

    foreach ($result as $row) {
      $options[$row->id] = $row->name;
    }
    return $options;
  }

}