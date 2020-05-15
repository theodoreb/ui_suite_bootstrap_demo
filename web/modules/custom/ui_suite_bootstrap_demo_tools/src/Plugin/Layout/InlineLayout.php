<?php

namespace Drupal\ui_suite_bootstrap_demo_tools\Plugin\Layout;

use Drupal\Core\Layout\LayoutDefault;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\PluginFormInterface;
use Drupal\ui_suite_bootstrap_demo_tools\Plugin\HelpersSettingsTrait;

/**
 * Inline Layout.
 *
 * @Layout(
 *   id = "ddsp_inline",
 *   label = "Inline [DDSP]",
 *   category = "Columns: 1",
 *   template = "templates/layout--inline",
 *   regions = {
 *     "main" = {
 *       "label" = @Translation("Main content"),
 *     }
 *   },
 *   icon_map = {
 *     {"main"},
 *   },
 * )
 */
class InlineLayout extends LayoutDefault implements PluginFormInterface {

  use HelpersSettingsTrait;

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    $options = parent::defaultConfiguration();
    $options = self::getHtmlElementDefault($options);
    return $options;
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildConfigurationForm($form, $form_state);
    $settings = $this->configuration;
    $options = ['span', 'p', 'h1', 'h2', 'h3', 'h4', 'h5'];
    $form = $this->getHtmlElementForm($form, $settings, $options);
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateConfigurationForm(array &$form, FormStateInterface $form_state) {
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    $this->configuration = $form_state->getValues();
  }

}
