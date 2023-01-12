<?php

namespace Drupal\gavias_webform_element\Element;

use Drupal\Core\Render\Element;
use Drupal\Core\Render\Element\FormElement;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element\Textfield;

/**
 * @FormElement("gavias_webform_auto_text")
 *
 */
class GaviasWebformAutoText extends Textfield {

  /**
   * {@inheritdoc}
   */
  public function getInfo() {
    $class = get_class($this);
    $info = parent::getInfo();
    $info['#pre_render'][] = [$class, 'preRenderGaviasWebformAutoText'];
    $info['#process'][] = [$class, 'processValueGaviasWebfromAutoText'];
    return $info;
  }

  public static function preRenderGaviasWebformAutoText($element) {
    static::setAttributes($element, ['gavias-webform-auto-text-element']);
    return $element;
  }
  
  public static function processValueGaviasWebfromAutoText(&$element, FormStateInterface $form_state, &$complete_form) {
    $title = \Drupal::request()->query->get('title');
    if ($title && !empty($title)) {
      $element['#value'] = $title;
    }
    return $element;
  }
}
