<?php

namespace Drupal\preethy_exercise\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Function to create custom link.
 */
class CustomModalLink extends ControllerBase {

  /**
   * Generates a link that opens a modal dialog when clicked.
   */
  public function modalLink() {
    $build['#attached']['library'][] = 'core/drupal.dialog.ajax';
    $build = [
      '#markup' => '<a href="/drupal/drupal-10.0.3/get-user/details" class="use-ajax" data-dialog-type="modal">Click here</a>',
    ];
    return $build;
  }

}
