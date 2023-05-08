<?php

namespace Drupal\preethy_exercise\Controller;

use Drupal\Core\Controller\ControllerBase;

class CustomController extends ControllerBase {


    #gets called when the route is matched.
    public function hello() {
$data=\Drupal::service("custom_service")->getName();
        return[
           '#theme' => "block_plugin_template",
           '#text' =>  $data,
           '#hexcode' =>'#800080',
     ];

     }


}