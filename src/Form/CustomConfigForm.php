<?php

namespace Drupal\preethy_exercise\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Creates table.
 */
class CustomConfigForm extends ConfigFormBase {

  /**
   * Settings Variable.
   */
  const CONFIGNAME = "preethy_exercise.settings";

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
    $config = $this->config(static::CONFIGNAME);
    $config->set("fullname", $form_state->getValue('fullname'));
    $config->set("email", $form_state->getValue('email'));
    $config->set("college", $form_state->getValue('college'));
    $config->save();
  }

}
