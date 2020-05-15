<?php

namespace Drupal\ui_suite_bootstrap_demo_tools\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Field\Plugin\Field\FieldFormatter\StringFormatter as CoreStringFormatter;
use Drupal\ui_suite_bootstrap_demo_tools\Plugin\HelpersSettingsTrait;

/**
 * Plugin implementation of the 'ddsl_string' formatter.
 *
 * @FieldFormatter(
 *   id = "ddsl_string",
 *   label = @Translation("String [custom]"),
 *   field_types = {
 *     "string"
 *   },
 *   quickedit = {
 *     "editor" = "plain_text"
 *   }
 * )
 */
class StringFormatter extends CoreStringFormatter {

  use HelpersSettingsTrait;

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    $options = parent::defaultSettings();
    $options = self::getHtmlElementDefault($options, 'p');
    return $options;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $form = parent::settingsForm($form, $form_state);
    $settings = $this->getSettings();
    $options = ['span', 'p', 'h1', 'h2', 'h3', 'h4', 'h5'];
    $form = $this->getHtmlElementForm($form, $settings, $options);
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = parent::settingsSummary();
    $settings = $this->getSettings();
    $summary = $this->getHtmlElementSummary($summary, $settings);
    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];
    $url = NULL;
    if ($this->getSetting('link_to_entity')) {
      $url = $items->getEntity()->toUrl();
    }
    $html_element = $this->getSetting('html_element');

    foreach ($items as $item) {

      // Set the value.
      $value = $item->getString();

      // Set the HTML element.
      $element = [
        '#type' => 'html_tag',
        '#tag' => $html_element,
        '#value' => $value,
      ];
      if ($url) {
        $element = [
          '#type' => 'html_tag',
          '#tag' => $html_element,
          [
            '#type' => 'link',
            '#title' => $value,
            '#url' => $url,
          ],
        ];
      }
      $elements[] = $element;
    }

    return $elements;
  }

}
