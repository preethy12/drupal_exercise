<?php

namespace Drupal\preethy_exercise\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Create customForm Table.
 */
class CustomForm extends FormBase {

  /**
   * Generated form id.
   */
  public function getFormId() {
    return 'custom_form_user_details';
  }

  /**
   * Build form generates form.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['firstname'] = [
      '#type' => 'textfield',
      '#title' => 'First Name',
      '#required' => TRUE,
      '#placeholder' => 'First Name',
    ];
    $form['email'] = [
      '#type' => 'textfield',
      '#title' => 'Email',
    ];
    $form['gender'] = [
      '#type' => 'select',
      '#title' => 'Gender',
      '#options' => [
        'male' => 'Male',
        'female' => 'Female',
      ],
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => 'Submit',
    ];
    return $form;

  }

  /**
   * CustomForm stored in database.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    \Drupal::messenger()->addMessage("User Details Submitted Successfully");
    \Drupal::database()->insert("user_details")->fields([
      'firstname' => $form_state->getValue("firstname"),
      'email' => $form_state->getValue("email"),
      'gender' => $form_state->getValue("gender"),
    ])->execute();

  }

}
