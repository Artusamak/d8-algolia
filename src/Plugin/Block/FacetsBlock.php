<?php

namespace Drupal\algolia\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Call to visit' block.
 *
 * @Block(
 *   id = "algolia_facets",
 *   admin_label = @Translation("Algolia: Facets"),
 * )
 */
class FacetsBlock extends BlockBase {
  public function build() {
    return array(
      '#theme' => 'algolia_categories',
    );
  }
}
