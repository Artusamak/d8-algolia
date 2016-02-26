<?php


namespace Drupal\algolia\Controller;

use Drupal\Core\Controller\ControllerBase;

class Listing extends ControllerBase {
  public function listData() {
    require __DIR__ . '/../../vendor/autoload.php';

    $add_data = FALSE;

    $client = new \AlgoliaSearch\Client("6T7TAEXYR7", "9c6a7cb89b5a893392beb5efa31ab195");

    if ($add_data) {
      $data = array();
      $index = $client->initIndex('nodes');
      // Use the node manager.
      $nodes = entity_load_multiple('node');
      foreach ($nodes as $node) {
        $tags = array();
        $node_data = array();
        $node_data['objectID'] = $node->id();
        $node_data['title'] = $node->getTitle();
        $node_data['author'] = $node->getOwner()->getAccountName();
        $node_data['creation_date'] = (integer) $node->getCreatedTime();
        foreach ($node->get('field_tags')->referencedEntities() as $element) {
          $tags[] = $element->getName();
        }
        $node_data['tags'] = $tags;
        $data[] = $node_data;
      }
      $index->saveObjects($data);
      $index->setSettings(array(
        'attributesToIndex' => array('title', 'tags', 'author'),
        'attributesForFaceting' => array('tags', 'author', 'creation_date'),
        'ranking' => array('exact', 'words', 'typo', 'attribute', 'desc(creation_date)', 'proximity', 'custom'),
      ));
    }
    $content = [
      '#attached' => [
        'library' => [
          'algolia/algolia.libsearch'
        ]
      ],
      '#theme' => 'algolia_search',
    ];
    return $content;
  }
}
