<?php

namespace Drupal\spotify_releases\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ApiKeysForm.
 */
class ApiKeysForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'spotify_releases.apikeys',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'api_keys_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('spotify_releases.apikeys');
    $form['clientid'] = [
      '#type' => 'textfield',
      '#title' => 'Client ID',
      '#description' => 'Ingrese el Client ID del perfil de la pagina de Spotify',
      '#default_value' => $config->get('clientid'),
    ];
    $form['secretkey'] = [
      '#type' => 'textfield',
      '#title' => 'Client Secret',
      '#description' => 'Ingrese el Client Secret del perfil de la pagina de Spotify',
      '#default_value' => $config->get('secretkey'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('spotify_releases.apikeys')
      ->set('clientid', $form_state->getValue('clientid'))
      ->set('secretkey', $form_state->getValue('secretkey'))
      ->save();
  }

}
