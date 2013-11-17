<?php

namespace Drupal\at_require\Drush\Command;

use \Drupal\at_require\Drush\Command\AtRequire\DependenciesFetcher;

class AtRequire {
  /**
   * Get supported modules.
   */
  private function getModules() {
    $modules = array();
    foreach (at_modules('at_base') as $module) {
      $file = DRUPAL_ROOT . '/' . drupal_get_path('module', $module) . '/config/at_require.yml';
      if (file_exists($file)) {
        $modules[] = $module;
      }
    }
    return $modules;
  }

  public function execute() {
    foreach ($this->getModules() as $module) {
      at_id(new DependenciesFetcher($module))->fetch();
    }
  }
}
