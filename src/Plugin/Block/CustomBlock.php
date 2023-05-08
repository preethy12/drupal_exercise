<?php

 namespace Drupal\preethy_exercise\Plugin\Block;

 use Drupal\Core\Block\BlockBase;
 use Drupal\Core\Form\FormStateInterface;

/**
  * Provides simple block for d4drupal.
  * @Block (
  * id = "custom_general",
  * admin_label = "Custom Plugin Block"
  * )
  */

  class CustomBlock extends BlockBase{
    /**
     * {@inheritdoc}
     */

    public function build() {
        #render function
        $form =\Drupal::formBuilder()->getForm('\Drupal\preethy_exercise\Form\CustomForm');
        return $form;

      }



  }
