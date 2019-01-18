<?php

namespace Drupal\my_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class MyForm extends FormBase {
  
  
  public function getFormId() {
    return 'my_form';
  }
  
  
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['name'] = array(
      '#type' => 'textfield',
      '#title' => 'First name',
      '#required' => TRUE
    );
    $form['first_name'] = array(
      '#type' => 'textfield',
      '#title' => 'Last name',
      '#required' => TRUE
    );
    $form['last_name'] = array(
      '#type' => 'textfield',
      '#title' => 'Subject',
      '#required' => TRUE
    );
    $form['message'] = array(
      '#type' => 'textarea',
      '#title' => 'Message',
      '#required' => TRUE
    );
    $form['email'] = array(
      '#type' => 'email',
      '#title' => $this->t('Your e-mail address'),
      '#required' => TRUE
    );
    $form['button'] = array(
      '#type' => 'submit',
      '#value' => 'Submit'
    );
  return $form;
  }
   
  
  public function validateForm(array &$form, FormStateInterface $form_state) {    
    print_r($form_state->getValue('email'));
    if (strpos($form_state->getValue('email'), '.com') === FALSE) {
        
       $form_state->setErrorByName('email', 'E-mail is incorrect!');
   
    }
    
  }
   
 /* 
  public function submitForm(array &$form, FormStateInterface $form_state) {    
    drupal_set_message($this->t('Your email address is @email', array('@email' => $form_state['values']['email'])));
  }
  
  public function submitForm(array &$form, FormStateInterface $form_state) {
  $title = $form_state->getValue('title');
  drupal_set_message(t('Вы ввели: %title.', ['%title' => $title]));
 }
 */
 public function submitForm(array &$form, FormStateInterface $form_state) {
     
    $message = $form_state->getValue('message');

    $message = wordwrap($message, 70, "\r\n");
    
    $subject = $form_state->getValue('subject');

    $res = mail('nataly.ismailova@mail.ru', $subject, $message);
    
    if($res) {
        
        \Drupal::logger('my_form')->notice('Mail is sent. E-mail: '.$form_state->getValue('email'));
    
        drupal_set_message('E-mail is sent!');

    }
    
  }

   
}