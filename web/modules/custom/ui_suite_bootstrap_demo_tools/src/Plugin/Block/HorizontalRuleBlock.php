<?php

namespace Drupal\ui_suite_bootstrap_demo_tools\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'ddsp_horizontal_rule' Block.
 *
 * @Block(
 *   id = "ddsp_horizontal_rule",
 *   admin_label = @Translation("Horizontal Rule [custom]"),
 * )
 */
class HorizontalRuleBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#type' => 'html_tag',
      '#tag' => 'hr',
    ];
  }

}
