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
  protected function getEditableConfigNames() {
    return [
      static::CONFIGNAME,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config(static::CONFIGNAME);
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

    $form['college'] = [
      '#type' => 'textfield',
      '#title' => 'College',
      '#default_value' => $config->get("college"),
    ];

    return parent::buildForm($form, $form_state);
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
