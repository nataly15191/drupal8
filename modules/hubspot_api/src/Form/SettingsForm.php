<?php

namespace Drupal\hubspot_api\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure HubSpot API settings.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'hubspot_api_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'hubspot_api.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('hubspot_api.settings');

    $form['access_key'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Access Key'),
      '#default_value' => $config->get('access_key'),
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->configFactory->getEditable('hubspot_api.settings')
      ->set('access_key', $form_state->getValue('access_key'))
      ->save();

    parent::submitForm($form, $form_state);
  }
}
