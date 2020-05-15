<?php

namespace Drupal\ui_suite_bootstrap_demo_tools\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\Plugin\Field\FieldFormatter\NumericFormatterBase as CoreNumericFormatterBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\ui_suite_bootstrap_demo_tools\Plugin\HelpersSettingsTrait;

/**
 * Parent plugin for decimal and integer formatters.
 */
abstract class NumericFormatterBase extends CoreNumericFormatterBase {

  use HelpersSettingsTrait;

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    $options = parent::defaultSettings();
    $options = self::getHtmlElementDefault($options, 'p');
    $options = self::getHtmlElementDefault($options, 'p', 'suffix_');
    $options['classes'] = '';
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
    $options = ['span', 'small'];
    $form = $this->getHtmlElementForm($form, $settings, $options, 'suffix_');
    $form['suffix_html_element']['#states'] = [
      'visible' => [
        ':input[name="settings[formatter][settings][prefix_suffix]"]' => ['checked' => TRUE],
      ],
    ];
    $form['classes'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Classes for suffixes'),
      '#description' => $this->t('You can add many values using spaces as separators'),
      '#default_value' => $this->getSetting('classes'),
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = parent::settingsSummary();
    $settings = $this->getSettings();
    $summary = $this->getHtmlElementSummary($summary, $settings);
    $summary = $this->getHtmlElementSummary($summary, $settings, 'suffix_');
    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];
    $settings = $this->getFieldSettings();

    foreach ($items as $delta => $item) {
      $output = [
        '#plain_text' => $this->numberFormat($item->value),
      ];

      // Account for prefix and suffix.
      if ($this->getSetting('prefix_suffix')) {
        $prefixes = isset($settings['prefix']) ? array_map(['Drupal\Core\Field\FieldFilteredMarkup', 'create'], explode('|', $settings['prefix'])) : [''];
        $suffixes = isset($settings['suffix']) ? array_map(['Drupal\Core\Field\FieldFilteredMarkup', 'create'], explode('|', $settings['suffix'])) : [''];
        $prefix = [
          '#plain_text' => (count($prefixes) > 1) ? $this->formatPlural($item->value, $prefixes[0], $prefixes[1]) : $prefixes[0],
        ];
        $suffix_classes = explode(' ', $this->getSetting('classes'));
        $suffix = [
          '#type' => 'html_tag',
          '#tag' => $this->getSetting('suffix_html_element'),
          '#value' => (count($suffixes) > 1) ? $this->formatPlural($item->value, $suffixes[0], $suffixes[1]) : $suffixes[0],
          '#attributes' => [
            'class' => $suffix_classes,
          ],
        ];
        $output = [$prefix, $output, $suffix];
      }
      // Output the raw value in a content attribute if the text of the HTML
      // element differs from the raw value (for example when a prefix is used).
      if (isset($item->_attributes) && $item->value != $output) {
        $item->_attributes += ['content' => $item->value];
      }

      $elements[$delta] = [
        '#type' => 'html_tag',
        '#tag' => $this->getSetting('html_element'),
        0 => $output,
      ];
    }

    return $elements;
  }

}
