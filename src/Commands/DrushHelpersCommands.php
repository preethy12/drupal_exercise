<?php

namespace Drupal\preethy_exercise\Commands;

use Consolidation\OutputFormatters\StructuredData\RowsOfFields;
use Drush\Commands\DrushCommands;
use Drupal\Core\Entity\EntityTypeManagerInterface;

/**
 * DrushHelperCommands to get node id and title.
 */
class DrushHelpersCommands extends DrushCommands {

  /**
   * Entity manager service.
   *
   * @var Drupal\Core\Entity\EntityTypeManagerInterface $entityManager
   */
  public function __construct(EntityTypeManagerInterface $entityTypeManager) {
    $this->entityManager = $entityTypeManager;
    parent::__construct();
  }

  /**
   * Command that returns a list of all node id and title for article.
   *
   * @field-labels
   *  id: Id
   *  title:title
   * @default-fields id,title
   *
   * @usage drush-helpers:article-node
   *   Returns all article node
   *
   * @command drush-helpers:article-node
   * @aliases article-node
   *
   * @return \Consolidation\OutputFormatters\StructuredData\RowsOfFields
   *   This is about loading nodes.
   */
  public function loadFirstTenNodes() {
    // The loadByProperties() method is used to load nodes of type 'article'
    // entityTypeManager() to get the storage handler for node entity type.
    // getStorage('node') returns an instance of storage
    // handler for specified entity type.
    $nodes = \Drupal::entityTypeManager()->getStorage('node')->loadByProperties(['type' => 'article']);
    $rows = [];
    foreach ($nodes as $node) {
      $rows[] = [
      // Get the id.
        'id' => $node->id(),
      // Get the title.
        'title' => $node->getTitle(),
      ];
    }
    return new RowsOfFields($rows);
  }

}
