<?php
 
namespace Drupal\my_form\Controller;
 
class MyModuleController{
    public function test() {
    $element = array(
      '#markup' => 'Hello World!',
    );
    return $element;
  }
}