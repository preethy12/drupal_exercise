<?php

namespace Drupal\preethy_exercise\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Messenger\MessengerInterface;

/**
 * Creates table.
 */
class CustomConfigForm extends ConfigFormBase {

  /**
   * Settings Variable.
   */
  const CONFIGNAME = "preethy_exercise.settings";

  /**
   * The messenger service.
   *
   * @var \Drupal\Core\Messenger\MessengerInterface
   */
  protected $messenger;

  /**
   * CustomConfigForm constructor.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The configuration factory.
   * @param \Drupal\Core\Messenger\MessengerInterface $messenger
   *   The messenger service.
   */
  public function __construct(ConfigFactoryInterface $config_factory, MessengerInterface $messenger) {
    parent::__construct($config_factory);
    $this->messenger = $messenger;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory'),
      $container->get('messenger')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return "preethy_exercise_settings";
  }

  /**
   * {@inheritdoc}
   */

  /**
   * Retrieves the configuration names that are.
   */

  /**
   * Editable for a specific entity or configuration form.
   */
  protected function getEditableConfigNames() {
    // Custom method specific to the class you are referring to.
    return [
      static::CONFIGNAME,
    ];
    /* returns an array with a single element, static::CONFIGNAME. The static:: keyword is used to refer to the current class, and CONFIGNAME is a constant defined within that class.*/
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config(static::CONFIGNAME); /* retrieves a configuration object based on the value of static::CONFIGNAME config() is a method used for accessing configuration objects.static::CONFIGNAME is a reference to a class constant or a static property that holds the name of the configuration object.*/
    $form['fullname'] = [
      '#type' => 'textfield',
      '#title' => ' <span>Fullname</span>',
      '#attached' => [
        'library' => [
          'preethy_exercise/css_lib',
        ],
      ],
      '#default_value' => $config->get("fullname"),
    ];

    $form['email'] = [
      '#type' => 'email',
      '#title' => 'Email',
      '#default_value' => $config->get("email"),
    ];
    $form['phone_number'] = [
      '#type' => 'tel',
      '#title' => 'phone number',
    ];
    $form['college'] = [
      '#type' => 'textfield',
      '#title' => 'College',
      '#default_value' => $config->get("college"),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * Function for form validation.
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if (strlen($form_state->getValue('phone_number')) < 5) {
      $form_state->setErrorByName('phone_number', $this->t('The phone number is too short. Please enter a full phone number.'));
    }

    $email = $form_state->getValue('email');

    if (empty($email)) {
      $form_state->setErrorByName('email', $this->t('Email is required.'));
    }
    elseif (!preg_match(' /^[\w\-\.]+@[\w\-\.]+\.\w+$/', $email)) {
      $form_state->setErrorByName('email', $this->t('Please enter a valid email address.'));
    }

  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config(static::CONFIGNAME)
      ->set("fullname", $form_state->getValue('fullname'))
      ->set("email", $form_state->getValue('email'))
      ->set("college", $form_state->getValue('college'))
      ->save();

    $this->messenger->addStatus($this->t('The configuration options have been saved.'));
  }

}
