<?php

namespace Drupal\ui_suite_bootstrap_demo_tools\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\advanced_text_formatter\Plugin\Field\FieldFormatter\AdvancedTextFormatter;
use Drupal\ui_suite_bootstrap_demo_tools\Plugin\HelpersSettingsTrait;

/**
 * Plugin implementation of the 'ddsl_text' formatter.
 *
 * @FieldFormatter(
 *   id = "ddsl_text",
 *   label = @Translation("Text [custom]"),
 *   field_types = {
 *     "text",
 *     "text_long",
 *     "text_with_summary",
 *   }
 * )
 */
class TextFormatter extends AdvancedTextFormatter {

  use HelpersSettingsTrait;

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    $options = parent::defaultSettings();
    $options = self::getHtmlElementDefault($options, 'span');
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
    $elements = parent::viewElements($items, $langcode);
    $html_element = $this->getSetting('html_element');
    if ($html_element !== '') {
      $build = [];
      foreach ($elements as $element) {
        $build[] = [
          '#type' => 'html_tag',
          '#tag' => $html_element,
          0 => $element,
        ];
      }
      return $build;
    }
    return $elements;
  }

}
