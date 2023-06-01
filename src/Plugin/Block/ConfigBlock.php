<?php

 namespace Drupal\preethy_exercise\Plugin\Block;

 use Drupal\Core\Block\BlockBase;
 use Drupal\Core\Form\FormStateInterface;

/**
  * Provides simple block for d4drupal.
  * @Block (
  * id = "preethy_exercise",
  * admin_label = "Config Plugin Block"
  * )
  */

  class ConfigBlock extends BlockBase{
    /**
     * {@inheritdoc}
     */

    public function build() {
        #render function
        $form =\Drupal::formBuilder()->getForm('\Drupal\preethy_exercise\Form\CustomConfigForm');
        return $form;

      }



  }