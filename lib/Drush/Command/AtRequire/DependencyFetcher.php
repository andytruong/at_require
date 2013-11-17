<?php
namespace Drupal\at_require\Drush\Command\AtRequire;

class DependencyFetcher {
  private $name;
  private $info;

  public function __construct($name, $info) {
    $this->name = $name;
    $this->info = $info;
  }

  public function fetch() {
    return $this->fetchWithConfirmation();
  }

  /**
   * Fetch dependency, if it's existing:
   *   0. Cancel
   *   1. Update
   *   2. Download in site directory
   */
  private function fetchWithConfirmation() {
    $contrib_destination = $this->getContribDestination();
    $this->_fetchDependency($contrib_destination);
  }

  private function getDestination() {
    if ($this->info['type']  === 'module')   return 'modules';
    if ($this->info['type']  === 'theme')    return 'themes';
    if ($this->info['type']  === 'library')  return 'libraries';
  }

  private function getContribDestination() {
    $path = 'sites/all/' . $this->getDestination() . '/' . $this->name;
    if (!is_dir($path)) {
      return 'sites/all';
    }

    $path = conf_path() . $this->getDestination() . '/' . $this->name;
    if (!is_dir($path)) {
      return conf_path();
    }
  }

  private function _fetchDependency($contrib_destination = 'sites/all') {
    $this->info += array(
      'type' => $this->info['type'],
      'destination' => $this->getDestination(),
      'name' => $this->name,
      'build_path' => DRUPAL_ROOT,
      'make_directory' => DRUPAL_ROOT,
      'contrib_destination' => $this->getContribDestination(),
      'directory_name' => $this->name,
    );

    $class = \DrushMakeProject::getInstance('AtRequire_Library', $this->info);
    $class->make();
  }
}
