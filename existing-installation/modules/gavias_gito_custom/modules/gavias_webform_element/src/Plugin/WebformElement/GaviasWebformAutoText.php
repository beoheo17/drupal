<?php

namespace Drupal\gavias_webform_element\Plugin\WebformElement;

use Drupal\Core\Form\FormStateInterface;
use Drupal\webform\WebformSubmissionInterface;
use Drupal\Core\Render\Element\Textfield;
/**
 * Provides a 'webform_auto_text' element.
 *
 * @WebformElement(
 *   id = "gavias_webform_auto_text",
 *   label = @Translation("Gavias Auto Text"),
 *   description = @Translation("Provides a form element for auto text get from $_GET['title']."),
 *   category = @Translation("Gavias Elements"),
 *   multiline = TRUE,
 * )
 */
class GaviasWebformAutoText extends \Drupal\webform\Plugin\WebformElement\TextField {

  /**
   * {@inheritdoc}
   */
  public function getDefaultProperties() {
    $default_properties = parent::getDefaultProperties();
    return $default_properties;
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);
    return $form;
  }
}
