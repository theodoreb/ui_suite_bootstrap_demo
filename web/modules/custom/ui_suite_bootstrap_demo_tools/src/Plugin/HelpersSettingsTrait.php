<?php

namespace Drupal\ui_suite_bootstrap_demo_tools\Plugin;

/**
 * Helpers not directly related to Bootstrap documentation.
 */
trait HelpersSettingsTrait {

  /**
   * Defines the default settings for this plugin.
   *
   * See also:
   * Drupal\Component\Plugin\ConfigurablePluginInterface::defaultConfiguration()
   * See also: Drupal\Core\Plugin\PluginSettingsInterface::defaultSettings()
   * See also: Drupal\views\Plugin\views\PluginBase::defineOptions(), kind of.
   *
   * @return array
   *   A list of default settings, keyed by the setting name.
   */
  protected static function getHtmlElementDefault(array $options, $value = '', $prefix = '') {
    $options[$prefix . 'html_element'] = $value;
    return $options;
  }

  /**
   * Returns a form to configure settings.
   *
   * See also:
   * - Drupal\Core\Plugin\PluginFormInterface::buildConfigurationForm()
   * - Drupal\Core\Field\FormatterInterface::settingsForm()
   * - Drupal\views\Plugin\views\ViewsPluginInterface::buildOptionsForm()
   *
   * @return array
   *   The form elements for the settings.
   */
  protected function getHtmlElementForm(array $form, array $settings, array $options = [], $prefix = '') {
    $options = array_combine($options, $options);
    $form[$prefix . 'html_element'] = [
      '#type' => 'select',
      '#title' => $this->t('@prefix HTML Element', ['@prefix' => $prefix]),
      '#default_value' => $settings[$prefix . 'html_element'],
      '#options' => $options,
    ];
    return $form;
  }

  /**
   * Returns a short summary for the settings.
   *
   * See also: Drupal\Core\Field\FormatterInterface::settingsSummary()
   *
   * @return string[]
   *   A short summary of the formatter settings.
   */
  protected function getHtmlElementSummary(array $summary, array $settings, $prefix = '') {
    $summary[] = $this->t('Inside a @element element', ['@element' => $settings[$prefix . 'html_element']]);
    return $summary;
  }

}
