<?php

namespace Drupal\ui_suite_bootstrap_demo_tools\Plugin\Field\FieldFormatter;

/**
 * Plugin implementation of the 'number_integer' formatter.
 *
 * The 'Default' formatter is different for integer fields on the one hand, and
 * for decimal and float fields on the other hand, in order to be able to use
 * different settings.
 *
 * @FieldFormatter(
 *   id = "ddsp_number_integer",
 *   label = @Translation("Default [DDSP]"),
 *   field_types = {
 *     "integer"
 *   }
 * )
 */
class IntegerFormatter extends NumericFormatterBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      'thousand_separator' => '',
      'prefix_suffix' => TRUE,
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  protected function numberFormat($number) {
    return number_format($number, 0, '', $this->getSetting('thousand_separator'));
  }

}
